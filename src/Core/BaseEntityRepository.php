<?php

namespace App\Core;

use Doctrine\ORM\EntityRepository;

abstract class BaseEntityRepository extends EntityRepository
{
    public function save($item)
    {
        $this->_em->persist($item);
        $this->_em->flush();
    }

    public function all(): array
    {
        return $this->findAll();
    }
}