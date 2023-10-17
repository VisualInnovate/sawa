<?php

namespace App\Exceptions;

use Exception;
use ReflectionClass;

class SawaException extends Exception
{
    protected $data = null;
    protected $object = null;

    public function __construct($data, $object = null)
    {
        parent::__construct('SawaException : ', 1);
        $this->data = $data;
        $this->object = $object ?: $this;
    }

    public function getData()
    {
        $className = (new ReflectionClass($this->object))->getName();
        return [
            $className => $this->data
        ];
    }
}
