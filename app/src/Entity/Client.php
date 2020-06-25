<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $national_phone_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $international_phone_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

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

    public function getNationalPhoneNumber(): ?string
    {
        return $this->national_phone_number;
    }

    public function setNationalPhoneNumber(string $national_phone_number): self
    {
        $this->national_phone_number = $national_phone_number;

        return $this;
    }

    public function getInternationalPhoneNumber(): ?string
    {
        return $this->international_phone_number;
    }

    public function setInternationalPhoneNumber(string $international_phone_number): self
    {
        $this->international_phone_number = $international_phone_number;

        return $this;
    }
}
