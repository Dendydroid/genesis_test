<?php

namespace App\Core;

class Config extends Singleton implements IConfig
{
    protected array $configs = [];
    protected ConfigLoader $configLoader;

    protected function __construct(string $appPath)
    {
        parent::__construct($appPath);

        $this->configLoader = ConfigLoader::getInstance($appPath);

        $this->configs = $this->configLoader->load();
    }

    public function get(string $key)
    {
        $keys = explode(".", $key);

        $value = $this->configs[array_shift($keys)];

        foreach ($keys as $key)
        {
            if(isset($value[$key]))
            {
                $value = $value[$key];
            }
        }

        return $value;
    }

    public function __invoke(string $key)
    {
        return $this->get($key);
    }
}