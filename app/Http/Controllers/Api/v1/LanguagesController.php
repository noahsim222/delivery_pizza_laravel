<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\Contracts\LanguageRepository;

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
