<?php

namespace Unite\Transactions\Http\Controllers;

use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\Transactions\Http\Requests\UpdateRequest;
use Unite\Transactions\TransactionRepository;

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
     * Update
     *
     * @param $id
     * @param \Unite\Transactions\Http\Requests\UpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateRequest $request)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        $data = $request->all();

        $object->update($data);

        return $this->successJsonResponse();
    }

    /**
     * Delete
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $this->repository->delete($id);

        return $this->successJsonResponse();
    }
}
