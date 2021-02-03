<?php

namespace App\Core;

use Symfony\Component\Finder\Finder;

class FileConfigLoader extends BaseConfigLoader
{
    private string $dynamicConfigPath;
    
    private const DYNAMIC_CONFIG_RELATIVE_PATH = '/config/dynamic/';

    private Finder $finder;

    public function __construct(string $path)
    {
        parent::__construct($path);

        $this->dynamicConfigPath = $this->path . self::DYNAMIC_CONFIG_RELATIVE_PATH;

        $this->finder = new Finder();
    }
    
    public function load(): array
    {
        $configs = [];

        $this->finder->files()->name('*.php');

        foreach ($this->finder->in($this->dynamicConfigPath) as $file)
        {
            $fullPath = $file->getPath() . "/" . $file->getFilename();

            if(file_exists($fullPath))
                $configs[$file->getFilenameWithoutExtension()] = require($fullPath);
        }

        return $configs;
    }
}