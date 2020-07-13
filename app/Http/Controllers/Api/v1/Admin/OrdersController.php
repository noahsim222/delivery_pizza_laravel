<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Services\Contracts\OrderService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderCreateRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Repositories\Contracts\OrderRepository;
use App\Validators\OrderValidator;
use App\Http\Controllers\Api\v1\Controller;

/**
 * Class OrdersController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * @var OrderService
     */
    protected $service;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $repository
     * @param OrderValidator $validator
     * @param OrderService $service
     */
    public function __construct(
        OrderRepository $repository,
        OrderValidator $validator,
        OrderService $service
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
        $orders = $this->repository->all();

        return response()->json([
            'data' => $orders,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $order = $this->service->store($request->all());

            $response = [
                'message' => 'Order created.',
                'data'    => $order->toArray(),
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
        $order = $this->repository->find($id);

        return response()->json([
            'data' => $order,
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
        $order = $this->repository->find($id);

        return response()->json([
            'data' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())
                ->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $order = $this->service->update($id, $request->all());

            $response = [
                'message' => 'Order updated.',
                'data'    => $order->toArray(),
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
            'message' => 'Order deleted.',
            'deleted' => $deleted,
        ]);
    }
}
