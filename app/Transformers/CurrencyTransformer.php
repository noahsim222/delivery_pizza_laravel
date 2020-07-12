<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Currency;

/**
 * Class CurrencyTransformer.
 *
 * @package namespace App\Transformers;
 */
class CurrencyTransformer extends TransformerAbstract
{
    /**
     * Transform the Currency entity.
     *
     * @param \App\Models\Currency $model
     *
     * @return array
     */
    public function transform(Currency $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
