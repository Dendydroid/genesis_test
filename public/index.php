<?php

require_once "../vendor/autoload.php";

define("APP_PATH", dirname(__DIR__));

try{
    $dotenv = new \Symfony\Component\Dotenv\Dotenv();
    $dotenv->load('../.env');

    $app = require_once(__DIR__ . '/../bootstrap/app.php');
    $app->contain('config', \App\Core\Config::getInstance(APP_PATH));
    $app->contain('database', new \App\Core\Database($app));

    $app->run();

}catch (Throwable $exception)
{
    if(config('app.debug.mode'))
    {
        dump("An exception occurred!");
        dd([
            "Message" => $exception->getMessage(),
            "File" => $exception->getFile(),
            "Line" => $exception->getLine(),
        ]);
    }
}
