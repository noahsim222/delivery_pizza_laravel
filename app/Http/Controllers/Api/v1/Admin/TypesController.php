<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Services\Contracts\TypeService;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TypeCreateRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Repositories\Contracts\TypeRepository;
use App\Validators\TypeValidator;
use App\Http\Controllers\Api\v1\Controller;

/**
 * Class TypesController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class TypesController extends Controller
{
    /**
     * @var TypeRepository
     */
    protected $repository;

    /**
     * @var TypeValidator
     */
    protected $validator;

    /**
     * @var TypeService
     */
    protected $service;

    /**
     * TypesController constructor.
     *
     * @param TypeRepository $repository
     * @param TypeValidator $validator
     * @param TypeService $service
     */
    public function __construct(
        TypeRepository $repository,
        TypeValidator $validator,
        TypeService $service
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
        $types = $this->repository->all();

        return response()->json([
            'data' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())
                ->passesOrFail(ValidatorInterface::RULE_CREATE);

            $type = $this->service->store($request->all());

            $response = [
                'message' => 'Types created.',
                'data'    => $type->toArray(),
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
        $type = $this->repository->find($id);

        return response()->json([
            'data' => $type,
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
        $type = $this->repository->find($id);

        return response()->json([
            'data' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $type = $this->service->update($id, $request->all());

            $response = [
                'message' => 'Types updated.',
                'data'    => $type->toArray(),
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
            'message' => 'Types deleted.',
            'deleted' => $deleted,
        ]);
    }
}
