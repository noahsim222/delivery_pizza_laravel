<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Item.
 *
 * @property int $id
 * @property int $status
 * @property string $img
 * @property int $category_id
 * @package namespace App\Models;
 */
class Item extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * Status inactive
     */
    const STATUS_DRAFT = 0;

    /**
     * Status active
     */
    const STATUS_ENABLED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'status',
		'img',
		'category_id',
	];

}
