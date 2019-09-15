<?php

namespace App\Repositories\Transformers;

use App\Tweet;
use League\Fractal\TransformerAbstract;

class TweetTransformer extends TransformerAbstract
{
    public function transform(Tweet $tweet)
    {
        return $tweet->toArray();
    }
}
