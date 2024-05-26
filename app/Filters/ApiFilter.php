<?php
namespace App\Filters;
use Illuminate\Http\Request;

class ApiFilter{
    // allowed query operators that can be used on the relevant variables names or table columns
    protected $safeParms = [];


    // map the postalCode to the postal_code column in the db table
    protected $columnMap = [];

    // map the named operators to their symbols
    protected $operatorMap = [];

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



