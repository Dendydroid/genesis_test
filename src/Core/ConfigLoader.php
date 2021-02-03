<?php

namespace App\Core;

class ConfigLoader extends Singleton implements IConfigLoader
{
    private IConfigLoader $loader;

    public function __construct(string $path)
    {
        parent::__construct($path);
        $this->toFileLoader();
    }

    public function toFileLoader(): static
    {
        $this->loader = FileConfigLoader::getInstance($this->path);
        return $this;
    }

    public function load(): array
    {
        return $this->loader->load();
    }
}