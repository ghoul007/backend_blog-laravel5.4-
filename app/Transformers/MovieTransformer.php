<?php

namespace App\Transformers;

use App\Movie;
use League\Fractal\TransformerAbstract;

class MovieTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Movie $movie)
    {
        return [
           'id'=>$movie->id,
            'title'=>$movie->title,
            'description'=>$movie->description,
            'date'=>$movie->created_at->toFormattedDateString(),
            'creator'=> fractal($movie->user, new UserTransformer())
        ];
    }
}










