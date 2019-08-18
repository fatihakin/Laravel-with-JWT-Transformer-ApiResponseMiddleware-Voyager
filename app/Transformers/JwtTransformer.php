<?php

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class JwtTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        return [
            'token' => $data['token']
        ];
    }

}
