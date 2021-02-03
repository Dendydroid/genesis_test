<?php

namespace App\Core;

interface IConfig
{
    public function get(string $key);
}