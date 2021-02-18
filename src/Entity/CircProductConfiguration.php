<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CircProductConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CircProductConfigurationRepository::class)
 */
class CircProductConfiguration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $diameter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiameter(): ?float
    {
        return $this->diameter;
    }

    public function setDiameter(float $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }
}
