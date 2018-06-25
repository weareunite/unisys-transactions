<?php

namespace Unite\Transactions\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TransactionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        /** @var \Unite\Transactions\Models\Transaction $this->resource */
        return [
            'id'                        => $this->id,
            'type'                      => $this->type,
            'amount'                    => $this->amount,
            'balance'                   => $this->balance,
            'variable_symbol'           => $this->variable_symbol,
            'specific_symbol'           => $this->specific_symbol,
            'description'               => $this->description,
            'posted_at'                 => (string)$this->posted_at,
            'created_at'                => (string)$this->created_at,
            'transaction_destination'   => new SourceResource($this->transaction_destination),
            'transaction_source'        => new SourceResource($this->transaction_source),
        ];
    }
}
