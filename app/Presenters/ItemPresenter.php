<?php

namespace App\Presenters;

use App\Transformers\ItemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ItemPresenter.
 *
 * @package namespace App\Presenters;
 */
class ItemPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ItemTransformer();
    }
}
