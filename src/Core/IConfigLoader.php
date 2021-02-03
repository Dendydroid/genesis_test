<?php

namespace App\Core;

interface IConfigLoader
{
    public function load(): array;
}