<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DeliveryInfo.
 *
 *
 * @property  int $id
 * @property  float $delivery_cost
 * @property  string $address
 * @property  string $customer_phone
 * @property  string $customer_name
 * @property  string $note
 * @property  string $latitude
 * @property  string $longitude
 * @package namespace App\Models;
 */
class DeliveryInfo extends Model implements Transformable
{
    use TransformableTrait, TableName;

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
