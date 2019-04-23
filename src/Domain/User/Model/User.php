<?php

namespace App\Domain\User\Model;

use App\Domain\Shared\ValueObject\AggregateRoot;
use App\Domain\User\ValueObject\UserId;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\User\Repository\UserRepository")
 */
class User extends AggregateRoot implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="userId", nullable=false)
     * @var UserId
     */
    protected $uuid;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null an additional name for a User, can be used for a middle name
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $additionalName;

    /**
     * @var PostalAddress physical address of the item
     *
     * @ORM\OneToOne(targetEntity="App\Domain\User\Model\PostalAddress")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $address;

    /**
     * @var DateTimeInterface|null date of birth
     *
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date
     */
    protected $birthDate;

    /**
     * @var string|null Family name. In the U.S., the last name of an User. This can be used along with givenName instead of the name property.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $familyName;

    /**
     * @var string|null Gender of the User. While http://schema.org/Male and http://schema.org/Female may be used, text strings are also acceptable for people who do not identify as a binary gender.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $gender;

    /**
     * @var string|null nationality of the User
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $nationality;

    public function __construct(UserId $userId, string $email)
    {
        parent::__construct($userId);

        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
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

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}