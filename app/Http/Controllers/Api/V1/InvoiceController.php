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
            // else return the filtered customers using the inserted query terms
            return new InvoiceCollection(Invoice::where($queryItems)->paginate());
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
