<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\ItemRepository;
use App\Models\Item;
use App\Validators\ItemValidator;

/**
 * Class ItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ItemRepositoryEloquent extends BaseRepository implements ItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Item::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ItemValidator::class;
    }

    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'category_id'
    ];

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
