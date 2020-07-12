<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DeliveryInfo.
 *
 * @package namespace App\Models;
 */
class DeliveryInfo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * Table name
     * @var string
     */
    protected $table = 'delivery_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'delivery_cost',
		'address',
		'customer_phone',
		'customer_name',
		'note',
		'latitude',
		'longitude',
	];

}
