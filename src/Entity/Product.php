<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier", inversedBy="products")
     */
    private $supplierId;

    private $isSelected;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SutekinaBox", mappedBy="product")
     */
    private $sutekinaBoxes;

    public function __construct()
    {
        $this->sutekinaBoxes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getSupplierId(): ?Supplier
    {
        return $this->supplierId;
    }

    public function setSupplierId(?Supplier $supplierId): self
    {
        $this->supplierId = $supplierId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsSelected()
    {
        return $this->isSelected;
    }

    /**
     * @param mixed $isSelected
     *
     * @return Product
     */
    public function setIsSelected($isSelected)
    {
        $this->isSelected = $isSelected;
        return $this;
    }

    /**
     * @return Collection|SutekinaBox[]
     */
    public function getSutekinaBoxes(): Collection
    {
        return $this->sutekinaBoxes;
    }

    public function addSutekinaBox(SutekinaBox $sutekinaBox): self
    {
        if (!$this->sutekinaBoxes->contains($sutekinaBox)) {
            $this->sutekinaBoxes[] = $sutekinaBox;
            $sutekinaBox->addProduct($this);
        }

        return $this;
    }

    public function removeSutekinaBox(SutekinaBox $sutekinaBox): self
    {
        if ($this->sutekinaBoxes->contains($sutekinaBox)) {
            $this->sutekinaBoxes->removeElement($sutekinaBox);
            $sutekinaBox->removeProduct($this);
        }

        return $this;
    }


}
