<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 *
 * @property string $long_name
 * @property string $short_name
 * @package App\Models
 */
class Language extends Model
{
    use SoftDeletes, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the category for the language.
     *
     * @return HasMany
     */
    public function categoryTranslations(): HasMany
    {
        return $this->hasMany(CategoryTranslations::class);
    }

    /**
     * Get the category for the language.
     *
     * @return HasMany
     */
    public function itemTranslations(): HasMany
    {
        return $this->hasMany(ItemTranslations::class);
    }

    /**
     * Get the category for the language.
     *
     * @return HasMany
     */
    public function typeTranslations(): HasMany
    {
        return $this->hasMany(TypeTranslations::class);
    }

}
