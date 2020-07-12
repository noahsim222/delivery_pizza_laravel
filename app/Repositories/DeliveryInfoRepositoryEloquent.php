<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\DeliveryInfoRepository;
use App\Models\DeliveryInfo;
use App\Validators\DeliveryInfoValidator;

/**
 * Class DeliveryInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DeliveryInfoRepositoryEloquent extends BaseRepository implements DeliveryInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DeliveryInfo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DeliveryInfoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
