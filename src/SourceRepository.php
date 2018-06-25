<?php

namespace Unite\Transactions;

use Unite\UnisysApi\Repositories\Repository;
use Unite\Transactions\Models\Source;

class SourceRepository extends Repository
{
    protected $modelClass = Source::class;
}