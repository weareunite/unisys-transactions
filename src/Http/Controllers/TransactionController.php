<?php

namespace Unite\Transactions\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Transactions\Http\Resources\TransactionResource;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Transactions\TransactionRepository;
use Unite\UnisysApi\Http\Requests\QueryRequest;

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
     * @param QueryRequest $request
     *
     * @return AnonymousResourceCollection|TransactionResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->with($this->repository->getResourceRelations())->filterByRequest( $request->all() );

        return TransactionResource::collection($object);
    }

    /**
     * Show
     *
     * @param $id
     *
     * @return TransactionResource
     */
    public function show($id)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        return new TransactionResource($object);
    }
}
