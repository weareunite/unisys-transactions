<?php

namespace Unite\Transactions\Events;

use Illuminate\Queue\SerializesModels;
use Unite\Transactions\Models\Transaction;

abstract class TransactionEvent
{
    use SerializesModels;

    public $transaction;

    public $type;

    /**
     * Create a new event instance.
     *
     * @param  Transaction $transaction
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }
}