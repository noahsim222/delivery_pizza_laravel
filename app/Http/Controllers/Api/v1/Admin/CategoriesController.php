<?php

namespace App\Http\Controllers\Api\v1\Admin;


use App\Services\Contracts\CategoryService;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Contracts\CategoryRepository;
use App\Validators\CategoryValidator;
use App\Http\Controllers\Api\v1\Controller;

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
     * @var CategoryService
     */
    protected $service;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     * @param CategoryValidator $validator
     * @param CategoryService $service
     */
    public function __construct(
        CategoryRepository $repository,
        CategoryValidator $validator,
        CategoryService $service
    ) {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $categories = $this->repository->all();

        return response()->json([
            'data' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CategoryCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $category = $this->service->store($request->all());

            $response = [
                'message' => 'Category created.',
                'data'    => $category->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);

        return response()->json([
            'data' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $category = $this->service->update($id, $request->all());

            $response = [
                'message' => 'Category updated.',
                'data'    => $category->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->service->delete($id);

        return response()->json([
            'message' => 'Category deleted.',
            'deleted' => $deleted,
        ]);
    }
}
