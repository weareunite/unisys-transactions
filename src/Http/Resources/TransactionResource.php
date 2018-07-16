<?php

namespace Unite\Transactions\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Unite\Tags\Http\Resources\TagResource;

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
            'variable_symbol'           => (int) $this->variable_symbol,
            'specific_symbol'           => (int) $this->specific_symbol,
            'description'               => $this->description,
            'posted_at'                 => (string)$this->posted_at,
            'created_at'                => (string)$this->created_at,
            'destination_iban'          => $this->destination_iban,
            'source'                    => new SourceResource($this->source),
            'tags'                      => TagResource::collection($this->tags),
        ];
    }
}
