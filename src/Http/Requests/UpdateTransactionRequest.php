<?php

namespace Unite\Transactions\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Unite\Transactions\Models\Transaction;

class UpdateTransactionRequest extends FormRequest
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
        $allRules = [
            'type'                  => 'in:'.implode(',', Transaction::getTypes()),
            'transaction_source_id' => 'integer|exists:transaction_sources,id',
            'destination_iban'      => 'string|min:15|max:32',
            'amount'                => 'numeric',
            'variable_symbol'       => 'numeric|max:10|nullable',
            'specific_symbol'       => 'numeric|max:10|nullable',
            'description'           => 'string|max:250|nullable',
            'paid_at'               => 'date_format:"Y-m-d H:i"',
        ];

        $rules = isset($allRules[$this->name]) ? ['value' => $allRules[$this->name] ] : [];

        return $rules;
    }
}
