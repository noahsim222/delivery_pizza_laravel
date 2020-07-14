<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderCreateRequest;
use App\Repositories\Contracts\OrderRepository;
use App\Validators\OrderValidator;

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
     * @param OrderCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function store(OrderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $order = $this->service->store($request->all());

            $response = [
                'code' => 20000,
                'message' => 'Your order has been accepted. The approximate delivery time of the order is 60 minutes',
                'data'    => $order->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'code' => 52000,
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
     * Check order status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStatus(Request $request)
    {
        $no = array_get($request->all(), 'no');
        /** @var Order $order */
        $order = $this->repository->where('no', $no)->first();

        return response()->json([
            'code' => 20000,
            'data' => [
                'status' => $order->status,
                'statusMessage' => order_status_message($order->status)
            ],
        ]);
    }
}
