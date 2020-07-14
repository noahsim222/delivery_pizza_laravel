<?php

namespace App\Http\Controllers\Api\v1;

use App\Presenters\CategoryPresenter;
use App\Repositories\Contracts\CategoryRepository;
use App\Validators\CategoryValidator;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
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
        $categories = $this->repository->setPresenter(CategoryPresenter::class)->all();

        return response()->json(array_merge([
            'code' => 20000,
        ], $categories));
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
        $category = $this->repository->find($id);

        return response()->json([
            'data' => $category,
        ]);
    }
}
