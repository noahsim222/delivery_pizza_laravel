<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\ItemRepository;

/**
 * Class ItemsController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class ItemsController extends Controller
{
    /**
     * @var ItemRepository
     */
    protected $repository;

    /**
     * ItemsController constructor.
     *
     * @param ItemRepository $repository
     */
    public function __construct(ItemRepository $repository)
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
        $items = $this->repository->all();

        return response()->json([
            'data' => $items,
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
        $item = $this->repository->find($id);

        return response()->json([
            'data' => $item,
        ]);
    }
}
