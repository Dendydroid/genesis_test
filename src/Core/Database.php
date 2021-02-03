<?php

namespace App\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\ORMException;

class Database
{
    private array $options;
    private EntityManager $entityManager;

    public function __construct($app = null)
    {
        if(!$app)
        {
            $config = Config::getInstance(APP_PATH);
        }else{
            $config = app()->get("config");
        }

        $this->options = $config->get("database.connection");

        $doctrineConfig = Setup::createAnnotationMetadataConfiguration([$config->get("database.entities.path")], $config->get("app.debug.mode"));

        $entityManager = EntityManager::create($this->options, $doctrineConfig);

        $this->setEntityManager($entityManager);
    }

    public function setEntityManager(EntityManager $entityManager): static
    {
        $this->entityManager = $entityManager;
        return $this;
    }

    public function getEntityManger(): EntityManager
    {
        return $this->entityManager;
    }
}