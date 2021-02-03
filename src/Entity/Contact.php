<?php

namespace App\Entity;

/**
 * @Entity(repositoryClass="App\Repository\ContactRepository")
 * @Table(name="contacts")
 */
class Contact
{
    /**
     * @id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public int $id;

    /**
     * @Column(type="json", nullable=true)
     */
    public $phones;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public ?string $firstName;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public ?string $lastName;
}