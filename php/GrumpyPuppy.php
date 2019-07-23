<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrumpyPuppyRepository")
 */
class GrumpyPuppy
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $broken;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBroken(): ?float
    {
        return $this->broken;
    }

    public function setBroken(?float $broken): self
    {
        $this->broken = $broken;

        return $this;
    }
}
