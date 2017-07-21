<?php

namespace App\Transformers;

use App\Actor;
use League\Fractal\TransformerAbstract;

class ActorTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */

    public function transform(Actor $actor)
    {

        return [
            'id' => $actor->id,
            'name' => $actor->name,
            'age' => $actor->age,
            'date' => $actor->created_at->toFormattedDateString(),
            'movies' => fractal($actor->movies, new MovieTransformer())
        ];

    }

}
