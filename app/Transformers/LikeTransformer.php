<?php

namespace App\Transformers;

use App\Like;
use League\Fractal\TransformerAbstract;

class LikeTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Like $like)
    {
        return [
            'user' => [
                'id' => $like->user->id,
                'name'=>$like->user->name,
                'liked_date'=>$like->created_at->toFormattedDateString()
            ]
        ];
    }
}



