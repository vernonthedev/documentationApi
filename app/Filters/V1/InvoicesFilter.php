<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter{
    // allowed query operators that can be used on the relevant variables names or table columns
    protected $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq','lt','gt','lte','gte'],
        'status' => ['eq','ne'],
        'billedDate' => ['eq','lt','gt','lte','gte'],
        'paidDate' => ['eq','lt','gt','lte','gte'],
    ];

    // map the postalCode to the postal_code column in the db table
    protected $columnMap = [
        'customerId' => 'customer_id',
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date'
    ];

    // map the named operators to their symbols
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!=',
    ];    

}



















?>