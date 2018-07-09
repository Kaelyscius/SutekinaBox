<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registrationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastConnexionDate;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContactInformation", mappedBy="userid")
     */
    private $contactInfo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Message", inversedBy="messTo")
     */
    private $messageRecived;

    public function __construct()
    {
        $this->contactInfo = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getLastConnexionDate(): ?\DateTimeInterface
    {
        return $this->lastConnexionDate;
    }

    public function setLastConnexionDate(\DateTimeInterface $lastConnexionDate): self
    {
        $this->lastConnexionDate = $lastConnexionDate;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|ContactInformation[]
     */
    public function getContactInfo(): Collection
    {
        return $this->contactInfo;
    }

    public function addContactInfo(ContactInformation $contactInfo): self
    {
        if (!$this->contactInfo->contains($contactInfo)) {
            $this->contactInfo[] = $contactInfo;
            $contactInfo->setUserid($this);
        }

        return $this;
    }

    public function removeContactInfo(ContactInformation $contactInfo): self
    {
        if ($this->contactInfo->contains($contactInfo)) {
            $this->contactInfo->removeElement($contactInfo);
            // set the owning side to null (unless already changed)
            if ($contactInfo->getUserid() === $this) {
                $contactInfo->setUserid(null);
            }
        }

        return $this;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return false;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getMessageRecived(): ?Message
    {
        return $this->messageRecived;
    }

    public function setMessageRecived(?Message $messageRecived): self
    {
        $this->messageRecived = $messageRecived;

        return $this;
    }
}
