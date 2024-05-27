<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Http\Controllers\Controller;  
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use Illuminate\Http\Request;
use App\Filters\V1\InvoicesFilter;
use Illuminate\Support\Arr;
use App\Http\Requests\V1\BulkStoreInvoiceRequest;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Import the customized & allowed queries and apply them to the data when 
        //they are requested
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request); // Format of the filtering query operands = [['column','operator','value']]

        if(count($queryItems) == 0)
        {
            // if there are no filters or search params inside our get request then return all the invoices and paginated
            return new InvoiceCollection(Invoice::paginate());
        }else
        {
            $invoices = Invoice::where($queryItems)->paginate();
            // else return the filtered customers using the inserted query terms
            return new InvoiceCollection($invoices->appends($request->query()));
        }

        // FOR WHEN WE HAVEN'T APPLIED THE FILTERS
        // Modify the output of the invoices by using the collection that was customised to the developers needs & requirements
        // return new InvoiceCollection(Invoice::paginate());
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
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

     /**
     * Accept and store the data received in bulk to the database
     */
    public function bulkStore(BulkStoreInvoiceRequest $request){
        // turn the api inserted data into a collection for easier working with since we can map the 
        //different camelCase vars to their relevant table column fields
        $bulk = collect($request->all())->map(function($arr, $key){
            //remove these fields from the collection incase theyre still in camelCase 
            //but then send them for conversion and modification
            return Arr::except($arr, ['customerId', 'billedDate', 'paidDate']);
        });
        Invoice::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
