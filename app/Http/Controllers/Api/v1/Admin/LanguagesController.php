<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Repositories\Contracts\LanguageRepository;
use App\Http\Controllers\Api\v1\Controller;

/**
 * Class LanguagesController.
 *
 * @package namespace App\Http\Controllers\Api\v1;
 */
class LanguagesController extends Controller
{
    /**
     * @var LanguageRepository
     */
    protected $repository;

    /**
     * LanguagesController constructor.
     *
     * @param LanguageRepository $repository
     */
    public function __construct(LanguageRepository $repository)
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
        $languages = $this->repository->all();

        return response()->json([
            'data' => $languages,
        ]);
    }

}
