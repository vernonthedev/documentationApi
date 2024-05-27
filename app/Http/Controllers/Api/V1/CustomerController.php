<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;    
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Import the customized & allowed queries and apply them to the data when 
        //they are requested
        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request); // Format of the filtering query operands = [['column','operator','value']]

        // incase the request has includeInvoices, make sure we return users that have invoices
        $includeInvoices = $request->query('includeInvoices'); 
        $customers = Customer::where($filterItems);
        if( $includeInvoices ) {
            $customers = $customers->with('invoices');
        }
        // else return the filtered customers using the inserted query terms
        return new CustomerCollection($customers->paginate()->appends($request->query()));

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //save all the api customer data received
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Request $request)
    {
        $includeInvoices = $request->query('includeInvoices'); 

        // incase we would like to show the invoices then we load the method fr the missing invoices
        if($includeInvoices){
            return new CustomerResource($customer->loadMissing('invoices'));
        }


        return new CustomerResource($customer); //use the CustomerResource to display the contents within the customer output
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
