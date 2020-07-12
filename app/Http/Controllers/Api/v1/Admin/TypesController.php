<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TypesCreateRequest;
use App\Http\Requests\TypesUpdateRequest;
use App\Repositories\Contracts\TypesRepository;
use App\Validators\TypesValidator;
use App\Http\Controllers\Api\v1\Controller;

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
     * @var TypesValidator
     */
    protected $validator;

    /**
     * TypesController constructor.
     *
     * @param TypesRepository $repository
     * @param TypesValidator $validator
     */
    public function __construct(TypesRepository $repository, TypesValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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
     * @param  TypesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TypesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $type = $this->repository->create($request->all());

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
     * @param  TypesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TypesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $type = $this->repository->update($request->all(), $id);

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
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'Types deleted.',
            'deleted' => $deleted,
        ]);
    }
}
