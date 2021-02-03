<?php

if(!function_exists('app'))
{
    function app(): \App\Core\IApp
    {
        return \App\Core\App::getInstance(APP_PATH);
    }

    if(!function_exists('config'))
    {
        function config(string $key, $default = [])
        {
            $data = app()->get('config')->get($key);

            return $data ? $data : $default;
        }
    }
}



