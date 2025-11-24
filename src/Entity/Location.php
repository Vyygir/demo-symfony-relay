<?php

namespace App\Entity;

use App\Support\Connectivity\Status;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Location
{
	#[ORM\Column(type: Types::STRING, enumType: Status::class, nullable: true)]
	private ?Status $connectivityStatus = null;

	#[ORM\Column(nullable: true)]
	private ?string $address = null;

	#[ORM\Column(nullable: true)]
	private ?string $city = null;

	#[ORM\Column(nullable: true)]
	private ?string $postcode = null;

	#[ORM\Column(nullable: true)]
	private ?string $country = null;

	#[ORM\Column(nullable: true)]
	private ?float $latitude = null;

	#[ORM\Column(nullable: true)]
	private ?float $longitude = null;

	public function __construct(
		?string $address = null,
		?string $city = null,
		?string $postcode = null,
		?string $country = null,
		?float $latitude = null,
		?float $longitude = null,
	) {
		$this->address = $address;
		$this->city = $city;
		$this->postcode = $postcode;
		$this->country = $country;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	public function getAddress(): string
	{
		return $this->address;
	}

	public function setAddress(string $address): void
	{
		$this->address = $address;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function setCity(string $city): void
	{
		$this->city = $city;
	}

	public function getPostcode(): string
	{
		return $this->postcode;
	}

	public function setPostcode(string $postcode): void
	{
		$this->postcode = $postcode;
	}

	public function getCountry(): string
	{
		return $this->country;
	}

	public function setCountry(string $country): void
	{
		$this->country = $country;
	}

	public function getLatitude(): float
	{
		return $this->latitude;
	}

	public function getLongitude(): float
	{
		return $this->longitude;
	}

	public function getConnectivityStatus(): ?Status
	{
		return $this->connectivityStatus;
	}

	public function setConnectivityStatus(Status $connectivityStatus): void
	{
		$this->connectivityStatus = $connectivityStatus;
	}

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}
