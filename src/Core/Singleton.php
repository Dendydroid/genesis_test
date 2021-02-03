<?php

namespace App\Core;

use Exception;

abstract class Singleton
{
    protected static array $instances = [];
    protected string $path;

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception(__CLASS__ . " is a singleton!");
    }

    public static function getInstance(string $path = ""): static
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static($path);
        }

        return self::$instances[$class];
    }

    protected function __construct(string $path = "")
    {
        $this->path = $path;
    }
}