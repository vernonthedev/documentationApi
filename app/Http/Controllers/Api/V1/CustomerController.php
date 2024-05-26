<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
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
        $queryItems = $filter->transform($request); // Format of the filtering query operands = [['column','operator','value']]

        if(count($queryItems) == 0)
        {
            // if there are no filters or search params inside our get request then return all the customers and paginated
            return new CustomerCollection(Customer::paginate());
        }else
        {
            $customers = Customer::where($queryItems)->paginate();
            // else return the filtered customers using the inserted query terms
            return new CustomerCollection($customers->appends($request->query()));
        }

        // FOR WHEN WE HAVEN'T APPLIED THE FILTERS
        // Modify the output of the customers by using the collection that was customised to the developers needs & requirements
        // return new CustomerCollection(Customer::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //display only one customer
        // return $customer;
        return new CustomerResource($customer); //use the CustomerResource to display the contents within the customer output
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
