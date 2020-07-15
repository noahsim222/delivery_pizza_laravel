<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

/**
 * Class CategoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{
    /**
     * Transform the Category entity.
     *
     * @param \App\Models\Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'id'          => (int) $model->id,
            'name'        => $model->name,
            'icon'        => $model->icon,
            'itemsCount'  => $model->items()->count(),
        ];
    }
}
