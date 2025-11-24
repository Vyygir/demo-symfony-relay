<?php

namespace App\Twig\Components;

use App\Form\LeadType;
use App\Service\LeadGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\{AsLiveComponent, LiveAction};
use Symfony\UX\LiveComponent\{ComponentWithFormTrait, DefaultActionTrait};

#[AsLiveComponent]
class DetailsForm extends AbstractController
{
	use ComponentWithFormTrait;
	use DefaultActionTrait;

	public function __construct(
		private LeadGenerator $leadGenerator,
	) {}

	protected function instantiateForm(): FormInterface
	{
		return $this->createForm(LeadType::class);
	}

	#[LiveAction]
	public function submit()
	{
		$this->submitForm();

		$form = $this->getForm();

		if (!$form->isValid()) {
			return null;
		}

		$this->leadGenerator->store($form->getData());
		$this->leadGenerator->save();

		return $this->redirectToRoute('app_lead_confirmation');
	}
}
