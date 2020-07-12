<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Repositories\Contracts\CurrencyRepository;
use App\Validators\CurrencyValidator;
use App\Http\Controllers\Api\v1\Controller;

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
     * @var CurrencyValidator
     */
    protected $validator;

    /**
     * CurrenciesController constructor.
     *
     * @param CurrencyRepository $repository
     * @param CurrencyValidator $validator
     */
    public function __construct(CurrencyRepository $repository, CurrencyValidator $validator)
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
        $currencies = $this->repository->all();

        return response()->json([
            'data' => $currencies,
        ]);
    }
}
