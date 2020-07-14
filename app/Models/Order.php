<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @property int $currency_id
 * @property int $delivery_info_id
 * @property int $user_id
 * @property int $payment_method
 * @property int $total_cost
 * @property int $status
 * @property int $no
 * @package namespace App\Models;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait, TableName;

    /**
     * Accepted to new order
     */
    const STATUS_CANCELLED = -2;

    /**
     * Accepted to new order
     */
    const STATUS_PROCESS = 1;

    /**
     * In process delivery
     */
    const STATUS_DELIVERY = 2;

    /**
     * Completed order
     */
    const STATUS_ACCEPTED = 3;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'currency_id',
		'delivery_info_id',
		'user_id',
		'payment_method',
		'total_cost',
		'status',
		'no',
	];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

}
