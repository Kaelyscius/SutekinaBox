<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\user", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $messFrom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\user", mappedBy="messageRecived")
     */
    private $messTo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $conten;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    public function __construct()
    {
        $this->messTo = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMessFrom(): ?user
    {
        return $this->messFrom;
    }

    public function setMessFrom(user $messFrom): self
    {
        $this->messFrom = $messFrom;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getMessTo(): Collection
    {
        return $this->messTo;
    }

    public function addMessTo(user $messTo): self
    {
        if (!$this->messTo->contains($messTo)) {
            $this->messTo[] = $messTo;
            $messTo->setMessageRecived($this);
        }

        return $this;
    }

    public function removeMessTo(user $messTo): self
    {
        if ($this->messTo->contains($messTo)) {
            $this->messTo->removeElement($messTo);
            // set the owning side to null (unless already changed)
            if ($messTo->getMessageRecived() === $this) {
                $messTo->setMessageRecived(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getConten(): ?string
    {
        return $this->conten;
    }

    public function setConten(string $conten): self
    {
        $this->conten = $conten;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
