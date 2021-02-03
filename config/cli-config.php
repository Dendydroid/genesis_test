<?php
// replace with file to your own project bootstrap
require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

define("APP_PATH", dirname(__DIR__));

$database = new \App\Core\Database();

$entityManager = $database->getEntityManger();

$entityManager->getConnection()->connect();

return ConsoleRunner::createHelperSet($entityManager);

