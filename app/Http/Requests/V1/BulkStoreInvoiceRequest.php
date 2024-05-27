<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //only allow authorized users to create a customer
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => ['required','integer'],
            '*.amount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in(['P','B','V','p','b','v'])],
            '*.billedDate' => ['required','date_format:Y-m-d H:i:s'],
            '*.paidDate' => ['date_format:Y-m-d H:i:s','nullable'],

        ];
    }


    // convert the postalCode to the postal_code so that we match the data coming from the api to that in the db
    protected function prepareForValidation()
    {
        $data = [];
        foreach($this->toArray() as $obj){
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['billed_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;

            //add the child array to the data array after the conversion
            $data[] = $obj;
        }

        //combine all the new data with the converted values
        $this->merge($data);
    }
}
