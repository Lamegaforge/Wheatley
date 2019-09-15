<?php
namespace App\Repositories;

use App\Tweet;
use App\Repositories\Presenters\TweetPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class TweetRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return Tweet::class;
    }
    /**
     * @return array 
     */
    public function presenter()
    {
        return TweetPresenter::class;
    }    
}
