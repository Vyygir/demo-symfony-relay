<?php

namespace App\Service;

use App\Repository\LeadRepository;
use Doctrine\ORM\EntityManagerInterface;
use RuntimeException;
use App\Entity\{Lead, Location, Product};
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;

class LeadGenerator
{
	private ?Session $session;
	private ?Lead $lead;

	/** @var Product[] */
	private array $products;
	private ?Location $location;

	public function __construct(
		private readonly RequestStack $requestStack,
		private EntityManagerInterface $entityManager,
	) {
		$this->session = $this->requestStack->getSession();
		$this->lead = $this->session->get('user_lead', null);
		$this->products = $this->session->get('user_products', []);
		$this->location = $this->session->get('user_location', null);
	}

	public function getLocation(): ?Location
	{
		return $this->location;
	}

	public function setLocation(Location $location): void
	{
		$this->location = $location;
		$this->session->set('user_location', $location);
	}

	public function getProducts(): array
	{
		return $this->products;
	}

	public function setProducts(array $products): void
	{
		$this->products = $products;
		$this->session->set('user_products', $products);
	}

	public function getLead(): ?Lead
	{
		return $this->lead ?? null;
	}

	public function store(Lead $lead): void
	{
		$this->lead = $lead;
		$this->lead->setProducts($this->products);

		if ($this->location) {
			$this->lead->setLocation($this->location);
		}

		$this->session->set('user_lead', $lead);
	}

	public function save(): void
	{
		if (!$this->lead) {
			throw new RuntimeException('Attempted to save before lead was set');
		}

		$this->entityManager->persist($this->lead);
		$this->entityManager->flush();
	}

	public function clear(): void
	{
		$this->session->remove('user_products');
		$this->session->remove('user_location');

		$this->lead = null;
		$this->products = [];
		$this->location = null;
	}
}
