<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\CurrencyRepository;

/**
 * Class CurrenciesController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class CurrenciesController extends Controller
{
    /**
     * @var CurrencyRepository
     */
    protected $repository;

    /**
     * CurrenciesController constructor.
     *
     * @param CurrencyRepository $repository
     */
    public function __construct(CurrencyRepository $repository)
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
        $currencies = $this->repository->all();

        return response()->json([
            'data' => $currencies,
        ]);
    }
}
