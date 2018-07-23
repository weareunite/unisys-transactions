<?php

namespace Unite\Transactions\Http\Resources;

use Unite\UnisysApi\Http\Resources\Resource;

class SourceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Transactions\Models\Source $this->resource */
        return [
            'id'                => $this->id,
            'type'              => $this->type,
            'balance'           => $this->balance,
            'is_bank_account'   => $this->isBankAccount(),
            'name'              => $this->name,
            'short_name'        => $this->short_name,
            'iban'              => $this->iban,
            'bic'               => $this->bic,
            'swift'             => $this->swift,
            'description'       => $this->description,
            'created_at'        => (string)$this->created_at,
        ];
    }
}