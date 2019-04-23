<?php

declare(strict_types=1);

namespace App\Domain\User\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The mailing address.
 *
 * @see http://schema.org/PostalAddress Documentation on Schema.org
 *
 * @ORM\Entity
 */
class PostalAddress
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    protected $id;

    /**
     * @var string|null The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $addressCountry;

    /**
     * @var string|null The locality. For example, Mountain View.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $addressLocality;

    /**
     * @var string|null The region. For example, CA.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $addressRegion;

    /**
     * @var string|null the post office box number for PO box addresses
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $postOfficeBoxNumber;

    /**
     * @var string|null The postal code. For example, 94043.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $postalCode;

    /**
     * @var string|null The street address. For example, 1600 Amphitheatre Pkwy.
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $streetAddress;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setAddressCountry(?string $addressCountry): self
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function setAddressLocality(?string $addressLocality): self
    {
        $this->addressLocality = $addressLocality;

        return $this;
    }

    public function getAddressLocality(): ?string
    {
        return $this->addressLocality;
    }

    public function setAddressRegion(?string $addressRegion): self
    {
        $this->addressRegion = $addressRegion;

        return $this;
    }

    public function getAddressRegion(): ?string
    {
        return $this->addressRegion;
    }

    public function setPostOfficeBoxNumber(?string $postOfficeBoxNumber): self
    {
        $this->postOfficeBoxNumber = $postOfficeBoxNumber;

        return $this;
    }

    public function getPostOfficeBoxNumber(): ?string
    {
        return $this->postOfficeBoxNumber;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setStreetAddress(?string $streetAddress): self
    {
        $this->streetAddress = $streetAddress;

        return $this;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }
}
