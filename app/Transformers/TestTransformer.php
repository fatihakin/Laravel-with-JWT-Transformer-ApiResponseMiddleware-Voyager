<?php
namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class TestTransformer extends TransformerAbstract
{
    public function transform($data = null)
    {
        return [
            'title'      => 'test'
        ];
    }
}
