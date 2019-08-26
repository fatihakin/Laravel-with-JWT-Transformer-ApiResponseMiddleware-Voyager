<?php

namespace App\Lib;

use App\Transformers\DefaultErrorTransformer;
use App\Transformers\ExceptionTransformer;
use App\Transformers\MessageTransformer;
use Illuminate\Http\Response;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

abstract class ApiExceptionAbstract extends \Exception {

    protected $messages = [];

    public abstract function getStatusKey();

    public abstract function getStatusCode();

    public function __construct(string $message = null, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if ($message)
        {
            $this->setMessages([$message]);
        }
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     * @return ApiExceptionAbstract
     */
    public function setMessages(array $messages): ApiExceptionAbstract
    {
        $this->messages = $messages;
        return $this;
    }
}
