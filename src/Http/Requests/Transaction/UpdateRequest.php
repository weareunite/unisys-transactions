<?php

namespace Unite\Transactions\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Transactions\Models\Transaction;
use Unite\UnisysApi\Rules\PriceAmount;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'              => 'in:'.implode(',', Transaction::getTypes()),
            'source_id'         => 'integer|exists:transaction_sources,id',
            'destination_iban'  => 'string|min:15|max:32',
            'amount'            => [new PriceAmount],
            'variable_symbol'   => 'nullable|numeric|max:10',
            'specific_symbol'   => 'nullable|numeric|max:10',
            'description'       => 'nullable|string|max:250',
            'posted_at'         => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
