<?php

namespace Unite\Transactions\Events;

use Unite\UnisysApi\Services\AmountService;

class TransactionCreating extends TransactionEvent
{
    public $type = AmountService::DIRECTION_INCREASE;
}