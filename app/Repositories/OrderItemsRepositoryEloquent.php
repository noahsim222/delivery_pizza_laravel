<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\OrderItemsRepository;
use App\Models\OrderItems;
use App\Validators\OrderItemsValidator;

/**
 * Class OrderItemsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderItemsRepositoryEloquent extends BaseRepository implements OrderItemsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderItems::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderItemsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
