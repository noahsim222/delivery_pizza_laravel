<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderItems.
 *
 * @package namespace App\Models;
 */
class OrderItems extends Model implements Transformable
{
    use TransformableTrait, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'order_id',
		'qty',
		'type',
		'item_id',
	];

}
