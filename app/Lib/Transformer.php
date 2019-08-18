<?php

namespace App\Lib;

use League\Fractal\Manager;

class Transformer extends Manager
{
    /**
     * Transformer constructor.
     */
    public function __construct()
    {
        parent::__construct();
        parent::setSerializer(new TransformerSerializer());
    }
}
