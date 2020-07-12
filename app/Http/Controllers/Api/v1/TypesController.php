<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\TypesRepository;

/**
 * Class TypesController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class TypesController extends Controller
{
    /**
     * @var TypesRepository
     */
    protected $repository;

    /**
     * TypesController constructor.
     *
     * @param TypesRepository $repository
     */
    public function __construct(TypesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $types = $this->repository->all();

        return response()->json([
            'data' => $types,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = $this->repository->find($id);

        return response()->json([
            'data' => $type,
        ]);
    }
}
