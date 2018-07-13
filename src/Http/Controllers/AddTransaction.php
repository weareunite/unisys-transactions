<?php

namespace Unite\Transactions\Http\Controllers;

use Unite\Transactions\Events\MadeTransaction;
use Unite\Transactions\Http\Requests\Transaction\StoreRequest;
use Unite\Transactions\Traits\HasTransactionsInterface;

/**
 * @property-read \Unite\UnisysApi\Repositories\Repository $repository
 */
trait AddTransaction
{
    /**
     * Add Transaction
     *
     * Add transaction to model
     *
     * @param int $id
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTransaction(int $id, StoreRequest $request)
    {
        /** @var HasTransactionsInterface $object */
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $transaction = $object->addTransaction( $request->all() );

        event(new MadeTransaction($transaction));

        return $this->successJsonResponse();
    }
}
