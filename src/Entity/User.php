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
     * @ORM\Column(type="datetime", nullable=true)
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

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->registrationDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     *
     * @return \App\Entity\User
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     *
     * @return \App\Entity\User
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return \App\Entity\User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return \App\Entity\User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    /**
     * @param \DateTimeInterface $registrationDate
     *
     * @return \App\Entity\User
     */
    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastConnexionDate(): ?\DateTimeInterface
    {
        return $this->lastConnexionDate;
    }

    public function setLastConnexionDate($timestamp = 'now'): self
    {
        $this->lastConnexionDate = new \DateTime($timestamp);
        return $this;
    }

    /**
     * @return array|null
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     *
     * @return \App\Entity\User
     */
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

    /**
     * @param \App\Entity\ContactInformation $contactInfo
     *
     * @return \App\Entity\User
     */
    public function addContactInfo(ContactInformation $contactInfo): self
    {
        if (!$this->contactInfo->contains($contactInfo)) {
            $this->contactInfo[] = $contactInfo;
            $contactInfo->setUserid($this);
        }

        return $this;
    }

    /**
     * @param \App\Entity\ContactInformation $contactInfo
     *
     * @return \App\Entity\User
     */
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

    /**
     * @return \App\Entity\Message|null
     */
    public function getMessageRecived(): ?Message
    {
        return $this->messageRecived;
    }

    /**
     * @param \App\Entity\Message|null $messageRecived
     *
     * @return \App\Entity\User
     */
    public function setMessageRecived(?Message $messageRecived): self
    {
        $this->messageRecived = $messageRecived;

        return $this;
    }




}
