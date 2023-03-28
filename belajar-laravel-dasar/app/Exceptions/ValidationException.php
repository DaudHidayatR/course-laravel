<?php

namespace App\Exceptions;


class ValidationException extends \Exception
{

    public function __construct(string $massage)
    {
        parent::__construct($massage);
    }
}
