<?php
namespace App\Filters\V1;
use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter{
    // allowed query operators that can be used on the relevant variables names or table columns
    protected $safeParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq','gt','lt']
    ];

    // map the postalCode to the postal_code column in the db table
    protected $columnMap = [
        'postalCode' => 'postal_code'
    ];

    // map the named operators to their symbols
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];

    // function to pass the inserted operators from the browser to the db and run the queries
    public function transform(Request $request)
    {
        $eloQuery = [];

        // we only use the safeparms to make sure that we go the next step of filtering 
        foreach ($this->safeParms as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column, $this->operatorMap[$operator],$query[$operator]];
                }
            }
            
        }
        return $eloQuery;
    }

    

}



















?>