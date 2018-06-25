<?php

namespace Unite\Transactions;

use Unite\UnisysApi\Repositories\Repository;
use Unite\Transactions\Models\Transaction;

class TransactionRepository extends Repository
{
    protected $modelClass = Transaction::class;
}