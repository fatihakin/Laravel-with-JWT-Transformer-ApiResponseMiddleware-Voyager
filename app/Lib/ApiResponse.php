<?php

namespace App\Lib;

use Illuminate\Http\Response;

class ApiResponse
{

    protected $data;
    protected $headers = [];
    protected $status;

    public function __construct($data = null, $status = Response::HTTP_OK)
    {
        $this->setData($data)->setStatus($status);
    }

    public function __toString()
    {
        return '';
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return ApiResponse
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return ApiResponse
     */
    public function setHeaders(array $headers): ApiResponse
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ApiResponse
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


}
