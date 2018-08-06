<?php

namespace Unite\Transactions\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Transactions\Events\MadeTransaction;
use Unite\Transactions\Http\Requests\Transaction\StoreRequest;
use Unite\Transactions\Http\Resources\TransactionResource;
use Unite\Transactions\Traits\HasTransactionsInterface;

/**
 * @property-read \Unite\UnisysApi\Repositories\Repository $repository
 */
trait HandleTransaction
{
    /**
     * Add Transaction
     *
     * Add transaction to given model find by model primary id
     *
     * @param int $id
     * @param StoreRequest $request
     *
     * @return TransactionResource
     */
    public function addTransaction(int $id, StoreRequest $request)
    {
        /** @var HasTransactionsInterface $object */
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $transaction = $object->addTransaction( $request->all() );

        event(new MadeTransaction($transaction));

        return new TransactionResource($transaction);
    }

    /**
     * Get latest Transactions
     *
     * Get all transactions order by created desc for given model find by model primary id
     *
     * @param int $id
     *
     * @return AnonymousResourceCollection|TransactionResource[]
     */
    public function allTransactions(int $id)
    {
        /** @var HasTransactionsInterface $object */
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $transactions = $object->getLatestTransactions();

        return TransactionResource::collection($transactions);
    }
}
