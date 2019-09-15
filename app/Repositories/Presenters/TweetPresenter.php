<?php

namespace App\Repositories\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\Transformers\TweetTransformer;

class TweetPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TweetTransformer();
    }
}
