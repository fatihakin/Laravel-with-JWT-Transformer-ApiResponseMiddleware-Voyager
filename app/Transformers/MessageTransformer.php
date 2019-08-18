<?php

namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;

class MessageTransformer extends TransformerAbstract
{
    const DEFAULT_TYPE = 'default';
    private $resultType = self::DEFAULT_TYPE;

    public function transform($message)
    {
        $initialResult = [
            'message' => $message,
        ];
        if ($this->getResultType()==self::DEFAULT_TYPE){
            $result = $initialResult;
        }else{
            $result=[];
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getResultType(): string
    {
        return $this->resultType;
    }

    /**
     * @param string $resultType
     * @return UserTransformer
     */
    public function setResultType(string $resultType): UserTransformer
    {
        $this->resultType = $resultType;
        return $this;
    }


}
