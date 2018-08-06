<?php

namespace Unite\Transactions\Events;

use Unite\UnisysApi\Services\AmountService;

class TransactionSaving extends TransactionEvent
{
    public $type = AmountService::DIRECTION_DECIDE;
}