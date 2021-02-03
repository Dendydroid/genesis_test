<?php

namespace App\Core;

class SuccessResponse
{
    private array $response;

    public function __construct(string $message, $data = "")
    {
        $this->response = [
            "errors" => [],
            "data" => $data,
            "message" => $message,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}