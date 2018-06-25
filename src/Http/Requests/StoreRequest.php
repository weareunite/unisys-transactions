<?php

namespace Unite\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Transactions\Models\Transaction;

class StoreRequest extends FormRequest
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
            'type'                  => 'required|in:'.implode(',', Transaction::getTypes()),
            'transaction_source_id' => 'required|integer|exists:transaction_sources,id',
            'amount'                => 'required|numeric',
            'variable_symbol'       => 'string|max:250|nullable',
            'specific_symbol'       => 'string|max:250|nullable',
            'description'           => 'string|max:250|nullable',
            'posted_at'             => 'required|date_format:Y-m-d H:s',
        ];
    }
}
