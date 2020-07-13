<?php

namespace App\Models;

use App\Models\Traits\TableName;
use App\Models\Traits\TranslationTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @property string $icon
 * @property string $name
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait, TableName, TranslationTable;

    /**
     * Related model that stores translations for the model.
     *
     * @var string
     */
    protected $translatableModel = CategoryTranslations::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'icon',
	];


    /**
     * The accessors to append to the model's array form..
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];

    /**
     * The languages that belong to the article item.
     *
     * @return BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, CategoryTranslations::getTableName(), 'source_id');
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
}
