<?php

namespace Unite\Transactions\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Unite\Transactions\Models\Transaction;

trait HasTransactions
{
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'subject');
    }

    /**
     * @param array $data
     * @return \Unite\Transactions\Models\Transaction
     */
    public function addTransaction(array $data = [])
    {
        return $this->transactions()->create($data);
    }

    public function removeTransaction($id)
    {
        $this->transactions()->where('id', $id)->delete();
    }

    public function existTransactions()
    {
        return $this->transactions()->exists();
    }

    public function transactionsCount()
    {
        return $this->transactions()->count();
    }

    public function getLatestTransactions(int $limit = null)
    {
        //todo: move it to repository for caching
        $query = $this->transactions()->orderBy('created_at', 'desc');

        if($limit) {
            $query = $query->limit($limit);
        }

        return $query->get();
    }
}
