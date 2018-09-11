<?php

namespace Unite\Transactions\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Transactions\Events\MadeTransaction;
use Unite\Transactions\Http\Resources\TransactionResource;
use Unite\Transactions\Models\Transaction;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Transactions\TransactionRepository;
use Unite\UnisysApi\QueryBuilder\QueryBuilder;
use Unite\UnisysApi\QueryBuilder\QueryBuilderRequest;

/**
 * @resource Transactions
 *
 * Transactions handler
 */
class TransactionController extends Controller
{
    protected $repository;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List
     *
     * @param QueryBuilderRequest $request
     *
     * @return AnonymousResourceCollection|TransactionResource[]
     */
    public function list(QueryBuilderRequest $request)
    {
        $object = QueryBuilder::for($this->repository, $request)->paginate();

        return TransactionResource::collection($object);
    }

    /**
     * Show
     *
     * @param $id
     *
     * @return TransactionResource
     */
    public function show(int $id)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        return new TransactionResource($object);
    }

    /**
     * Cancel
     *
     * @param Transaction $model
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Transaction $model)
    {
        /** @var Transaction $newTransaction */
        $newTransaction = $model->replicate();

        $newTransaction->amount = -1 * abs($model->amount);
        $newTransaction->save();

        event(new MadeTransaction($newTransaction));

        return $this->successJsonResponse();
    }
}
