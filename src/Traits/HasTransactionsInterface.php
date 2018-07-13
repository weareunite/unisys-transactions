<?php

namespace Unite\Transactions\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasTransactionsInterface
{
    public function transactions(): MorphMany;

    public function addTransaction(array $data = []);

    public function removeTransaction(int $id);

    public function existTransactions(): bool;

    public function transactionsCount(): int;

    public function getLatestTransactions(int $limit = 20);
}
