<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Item;

/**
 * Class ItemTransformer.
 *
 * @package namespace App\Transformers;
 */
class ItemTransformer extends TransformerAbstract
{
    /**
     * Transform the Item entity.
     *
     * @param \App\Models\Item $model
     *
     * @return array
     */
    public function transform(Item $model)
    {
        return [
            'id'          => (int) $model->id,
            'img'         => $model->img,
            'name'        => $model->name,
            'prices'      => $model->prices_data,
            'category'    => $model->category->name,
            'title'       => $model->title,
            'description' => $model->description
        ];
    }
}
