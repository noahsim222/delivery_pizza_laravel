<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Currency.
 *
 * @package namespace App\Models;
 */
class Currency extends Model implements Transformable
{
    use TransformableTrait, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'code',
		'symbol',
		'precision',
		'thousand_separator',
		'decimal_separator',
	];

}
