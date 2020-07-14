<?php

namespace App\Models;

use App\Models\Traits\TableName;
use App\Models\Traits\TranslationTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Item.
 *
 * @property int $id
 * @property int $status
 * @property string $img
 * @property int $category_id
 * @property string $name
 * @property string $title
 * @property ItemPrices $prices
 * @property Category $category
 * @property string $description
 * @package namespace App\Models;
 */
class Item extends Model implements Transformable
{
    use TransformableTrait, TableName, TranslationTable;


    /**
     * Related model that stores translations for the model.
     *
     * @var string
     */
    protected $translatableModel = ItemTranslations::class;

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

    /**
     * The accessors to append to the model's array form..
     *
     * @var array
     */
    protected $appends = [
        'name',
        'title',
        'description',
        'prices_data',
    ];

    /**
     * The languages that belong to the article item.
     *
     * @return BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, ItemTranslations::getTableName(), 'source_id');
    }

    /**
     * Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany(ItemPrices::class);
    }

    /**
     * Prices get
     *
     * @return array
     */
    public function getPricesDataAttribute()
    {
        $prices = [];

        foreach ($this->prices as $price) {
            if ($price) {
                Arr::set($prices, $price->currency_name, $price->price);
            }
        }
        return $prices;
    }

    /**
     * Get translated name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        if ($trans = $this->translate('name')) {
            return $trans;
        }
        return '';
    }

    /**
     * Get translated title.
     *
     * @return string
     */
    public function getTitleAttribute()
    {
        if ($trans = $this->translate('title')) {
            return $trans;
        }
        return '';
    }

    /**
     * Get translated description.
     *
     * @return string
     */
    public function getDescriptionAttribute()
    {
        if ($trans = $this->translate('description')) {
            return $trans;
        }
        return '';
    }
}
