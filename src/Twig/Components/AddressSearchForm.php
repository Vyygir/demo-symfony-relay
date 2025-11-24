<?php

namespace App\Twig\Components;

use App\Entity\Location;
use App\Form\AddressSearchType;
use App\Service\{LeadGenerator, LocationConnectivity, LocationSearch};
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\{AsLiveComponent, LiveAction, LiveArg, LiveProp};
use Symfony\UX\LiveComponent\{ComponentWithFormTrait, DefaultActionTrait};

#[AsLiveComponent]
class AddressSearchForm extends AbstractController
{
	use DefaultActionTrait;
	use ComponentWithFormTrait;

	public function __construct(
		private LeadGenerator $leadGenerator,
		private readonly LocationSearch $locationSearch,
		private readonly LocationConnectivity $locationConnectivity,
	) {}

	#[LiveProp(writable: true, onUpdated: 'onQueryUpdated')]
	public string $query = '';

	#[LiveProp(writable: true)]
	public ?array $location = null;

	#[LiveProp(writable: true)]
	public bool $isFocused = false;

	#[LiveProp]
	public array $results = [];

	public function onQueryUpdated()
	{
		if (strlen($this->query) < 3) {
			$this->results = [];
			return;
		}

		try {
			$this->results = $this->locationSearch->find($this->query);
		} catch (\Exception) {
			$this->results = [];

			// @todo Logging, obviously, but this is a demo, so...
		}
	}

	#[LiveAction]
	public function selectAddress(#[LiveArg] array $location)
	{
		$this->location = $location;
		$this->query = $location['address'];
		$this->isFocused = false;
		$this->results = [];
	}

	#[LiveAction]
	public function handleFocus()
	{
		$this->isFocused = !$this->isFocused;
	}

	protected function instantiateForm(): FormInterface
	{
		return $this->createForm(AddressSearchType::class);
	}

	#[LiveAction]
	public function submit()
	{
		$this->submitForm();

		$form = $this->getForm();

		if (!$form->isValid() || !$this->location) {
			return;
		}

		$userLocation = new Location(...$this->location);
		$userLocation->setConnectivityStatus(
			$this->locationConnectivity->getStatus(
				$userLocation->getLatitude(),
				$userLocation->getLongitude()
			)
		);

		$this->leadGenerator->setLocation($userLocation);

		return $this->redirectToRoute('app_lead_products');
	}
}
