<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProductConfigurationRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *   "rect" = "RectProductConfiguration",
 *   "circ" = "CircProductConfiguration"
 * })
 */
abstract class ProductConfiguration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="configurations", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $product;

    /**
     * @ORM\Column(type="float")
     */
    protected $depth;

    /**
     * @ORM\Column(type="float")
     */
    protected $dB1;

    /**
     * @ORM\Column(type="float")
     */
    protected $dB2;

    /**
     * @ORM\Column(type="float")
     */
    protected $dB5;

    /**
     * @ORM\Column(type="float")
     */
    protected $dB10;

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
