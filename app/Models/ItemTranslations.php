<?php

namespace App\Models;

use App\Models\Traits\TableName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ItemTranslations.
 *
 * @package namespace App\Models;
 */
class ItemTranslations extends Model implements Transformable
{
    use TransformableTrait, TableName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'title',
		'description',
		'source_id',
		'language_id',
	];


    /**
     * Get the content item that owns the translation.
     *
     * @return BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Get the language that owns the translation.
     *
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
