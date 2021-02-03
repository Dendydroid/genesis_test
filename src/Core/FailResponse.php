<?php

namespace App\Core;

use Symfony\Component\Validator\ConstraintViolationList;

class FailResponse
{
    use ErrorsToArray;

    private array $response;

    public function __construct(string $message, ConstraintViolationList | string $errors = "", string $invalidParameter = "")
    {
        if($errors instanceof ConstraintViolationList)
        {
            $errors = self::violationListToArray($errors, $invalidParameter);
        }

        $this->response = [
            "errors" => $errors,
            "data" => $invalidParameter,
            "message" => $message,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}