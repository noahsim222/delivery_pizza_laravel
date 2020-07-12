<?php

namespace App\Presenters;

use App\Transformers\CurrencyTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CurrencyPresenter.
 *
 * @package namespace App\Presenters;
 */
class CurrencyPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CurrencyTransformer();
    }
}
