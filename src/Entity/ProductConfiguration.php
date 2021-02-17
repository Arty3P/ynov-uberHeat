<?php

namespace App\Entity;

use App\Repository\ProductConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductConfigurationRepository::class)
 */
class ProductConfiguration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="configurations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="float")
     */
    private $depth;

    /**
     * @ORM\Column(type="float")
     */
    private $dB1;

    /**
     * @ORM\Column(type="float")
     */
    private $dB2;

    /**
     * @ORM\Column(type="float")
     */
    private $dB5;

    /**
     * @ORM\Column(type="float")
     */
    private $dB10;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getDepth(): ?float
    {
        return $this->depth;
    }

    public function setDepth(float $depth): self
    {
        $this->depth = $depth;

        return $this;
    }

    public function getDB1(): ?float
    {
        return $this->dB1;
    }

    public function setDB1(float $dB1): self
    {
        $this->dB1 = $dB1;

        return $this;
    }

    public function getDB2(): ?float
    {
        return $this->dB2;
    }

    public function setDB2(float $dB2): self
    {
        $this->dB2 = $dB2;

        return $this;
    }

    public function getDB5(): ?float
    {
        return $this->dB5;
    }

    public function setDB5(float $dB5): self
    {
        $this->dB5 = $dB5;

        return $this;
    }

    public function getDB10(): ?float
    {
        return $this->dB10;
    }

    public function setDB10(float $dB10): self
    {
        $this->dB10 = $dB10;

        return $this;
    }
}
