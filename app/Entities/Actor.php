<?php

namespace App\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="movies")
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /** @ORM\Column(type="string", nullable=true) */
    private ?string $Name = null;


}
