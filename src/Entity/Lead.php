<?php

namespace App\Entity;

use App\Repository\LeadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LeadRepository::class)]
class Lead
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Embedded(class: Location::class, columnPrefix: 'location_')]
	private ?Location $location = null;

	#[ORM\Embedded(class: ProductCollection::class)]
	private ProductCollection $products;

	#[ORM\Column(length: 50)]
	#[Assert\NotBlank]
	private ?string $forename;

	#[ORM\Column(length: 50)]
	#[Assert\NotBlank]
	private ?string $surname;

	#[ORM\Column(length: 100)]
	#[Assert\Email]
	private ?string $email;

	#[ORM\Column(length: 50)]
	#[Assert\NotBlank]
	private ?string $phone;

	#[ORM\Column(type: Types::BOOLEAN)]
	#[Assert\NotNull]
	private ?bool $existingCustomer = false;

	#[ORM\Column(length: 100)]
	#[Assert\NotBlank]
	private ?string $company;

	#[ORM\Column(length: 50, nullable: true)]
	private ?string $role;

	#[ORM\Column(length: 50)]
	#[Assert\Country]
	private ?string $country;

	#[ORM\Column(length: 50, nullable: true)]
	private ?string $employees;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $comments;

	public function __construct() {
		$this->products = new ProductCollection;
	}

	public function getLocation(): ?Location
	{
		return $this->location;
	}

	public function setLocation(mixed $location): void
	{
		$this->location = $location;
	}

	public function getProducts(): array
	{
		return $this->products->getProducts();
	}

	public function setProducts(array $products): void
	{
		$this->products->setProducts($products);
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function setId(?int $id): void
	{
		$this->id = $id;
	}

	public function getForename(): ?string
	{
		return $this->forename;
	}

	public function setForename(?string $forename): void
	{
		$this->forename = $forename;
	}

	public function getSurname(): ?string
	{
		return $this->surname;
	}

	public function setSurname(?string $surname): void
	{
		$this->surname = $surname;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(?string $email): void
	{
		$this->email = $email;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	public function setPhone(?string $phone): void
	{
		$this->phone = $phone;
	}

	public function isExistingCustomer(): bool
	{
		return $this->existingCustomer;
	}

	public function setExistingCustomer(bool $existingCustomer): void
	{
		$this->existingCustomer = $existingCustomer;
	}

	public function getCompany(): ?string
	{
		return $this->company;
	}

	public function setCompany(?string $company): void
	{
		$this->company = $company;
	}

	public function getRole(): ?string
	{
		return $this->role;
	}

	public function setRole(?string $role): void
	{
		$this->role = $role;
	}

	public function getCountry(): ?string
	{
		return $this->country;
	}

	public function setCountry(?string $country): void
	{
		$this->country = $country;
	}

	public function getEmployees(): ?string
	{
		return $this->employees;
	}

	public function setEmployees(?string $employees): void
	{
		$this->employees = $employees;
	}

	public function getComments(): ?string
	{
		return $this->comments;
	}

	public function setComments(?string $comments): void
	{
		$this->comments = $comments;
	}
}
