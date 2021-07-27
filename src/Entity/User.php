<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="Ce pseudo est déjà pris !")
 * @UniqueEntity(fields={"email"}, message="Cette adresse e-mail est déjà utilisée à un autre compte !")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(min=3, minMessage="Votre prénom est trop court !")
     * @Assert\Regex(pattern = "/^[a-z \.\-'àâäéêëèîïôöùûüç]+$/i", message = "Votre prénom n'est pas correct !")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(min=3, minMessage="Votre nom est trop court !")
     * @Assert\Regex(pattern = "/^[a-z \.\-'àâäéêëèîïôöùûüç]+$/i", message = "Votre nom n'est pas correct !")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name","lastname"})
     * @ORM\Column(type="string", length=20, unique=true)
     * @Assert\Length(min=3, minMessage="Votre pseudo est trop court !")
     * @Assert\Regex(pattern = "/^[a-zA-Z0-9]+$/i", message = "Votre pseudo n'est pas correct !")
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message="Votre adresse e-mail n'est pas correct !")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $mobilePhone;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $country;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editAt;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_SUPER_ADMIN'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=8, minMessage="Un mot de passe doit contenir au moins 8 caractères ! ")
     */
    private $password;

    public function preUpdate()
    {
        $this->surname = ucwords(strtolower($this->lastname));
        $this->name = ucwords(strtolower($this->name));
        $this->email = strtolower($this->email);
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMobilePhone(): ?string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(string $mobilePhone): self
    {
        $this->mobilePhone = $mobilePhone;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @see \Serializable::serialize()
     */ 
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->username,
            $this->password,
            // $this->salt,
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->email,
            $this->password,
            // $this->salt,
        ) = unserialize($serialized);
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getEditAt(): ?\DateTimeInterface
    {
        return $this->editAt;
    }

    public function setEditAt(?\DateTimeInterface $editAt): self
    {
        $this->editAt = $editAt;

        return $this;
    }

}
