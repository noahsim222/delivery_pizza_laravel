<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ItemPrices.
 *
 * @property Currency $currency
 * @property string $currency_name
 * @property float $price
 * @property int $currency_id
 * @property int $item_id
 * @package namespace App\Models;
 */
class ItemPrices extends Model implements Transformable
{
    use TransformableTrait, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'currency_id',
		'price',
		'item_id',
	];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'currency_name',
    ];

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'currency_name',
        'price',
    ];

    /**
     * Relation currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Relation currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCurrencyNameAttribute()
    {
        return $this->currency->code;
    }

}
