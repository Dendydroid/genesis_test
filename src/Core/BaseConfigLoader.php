<?php

namespace App\Core;

use Exception;

abstract class BaseConfigLoader extends Singleton implements IConfigLoader
{
    protected string $path;

    protected function __construct(string $path = "")
    {
        parent::__construct($path);
    }

}