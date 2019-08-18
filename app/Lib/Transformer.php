<?php
namespace App\Lib;

use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class Transformer extends Manager
{

    const ITEM = Item::class;
    const COLLECTION = Collection::class;
    /**
     * Transformer constructor.
     */
    public function __construct()
    {
        parent::__construct();
        parent::setSerializer(new TransformerSerializer());
    }

    public function getCreatedData($data){

        return ((new Transformer())->createData(new Item($data, new UserTransformer())))->toArray();
    }



}
