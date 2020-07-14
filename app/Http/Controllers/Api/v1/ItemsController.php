<?php

namespace App\Http\Controllers\Api\v1;

use App\Presenters\ItemPresenter;
use App\Repositories\Contracts\ItemRepository;
use Illuminate\Http\Request;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $limit = array_get($data, 'limit', 12);

        $this->repository
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $items = $this->repository
            ->setPresenter(ItemPresenter::class)
            ->orderBy('created_at', 'DESC')
            ->paginate($limit);

        return response()->json(array_merge([
            'code' => 20000,
        ], $items));
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
