<?php

namespace Unite\Transactions\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Unite\Transactions\Http\Requests\Source\StoreRequest;
use Unite\Transactions\Http\Requests\Source\UpdateRequest;
use Unite\Transactions\Http\Resources\SourceResource;
use Unite\Transactions\SourceRepository;
use Unite\UnisysApi\Http\Controllers\Controller;
use Unite\UnisysApi\Http\Requests\QueryRequest;

/**
 * @resource Transaction Sources
 *
 * Transaction Sources handler
 */
class SourceController extends Controller
{
    protected $repository;

    public function __construct(SourceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * List
     *
     * @param QueryRequest $request
     * @return AnonymousResourceCollection|SourceResource[]
     */
    public function list(QueryRequest $request)
    {
        $object = $this->repository->with(SourceResource::getRelations())->filterByRequest( $request->all() );

        return SourceResource::collection($object);
    }

    /**
     * Show
     *
     * @param $id
     * @return SourceResource
     */
    public function show($id)
    {
        if(!$object = $this->repository->find($id)) {
            abort(404);
        }

        return new SourceResource($object);
    }

    /**
     * Create
     *
     * @param StoreRequest $request
     * @return SourceResource
     */
    public function create(StoreRequest $request)
    {
        $data = $request->all();

        $object = $this->repository->create($data);

        return new SourceResource($object);
    }

    /**
     * Update
     *
     * @param $id
     * @param UpdateRequest $request
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
