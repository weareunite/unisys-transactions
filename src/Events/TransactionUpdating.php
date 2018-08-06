<?php

namespace Unite\Transactions\Events;

use Unite\UnisysApi\Services\AmountService;

class TransactionUpdating extends TransactionEvent
{
    public $type = AmountService::DIRECTION_DECIDE;
}