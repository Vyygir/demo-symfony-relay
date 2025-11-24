<?php

namespace App\Twig\Components;

use App\Form\ProductsType;
use App\Service\LeadGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class ProductsForm extends AbstractController
{
	use ComponentWithFormTrait;
	use DefaultActionTrait;

	public function __construct(
		private readonly LeadGenerator $leadGenerator,
	) {}

	protected function instantiateForm(): FormInterface
	{
		return $this->createForm(ProductsType::class);
	}

	#[LiveAction]
	public function submit()
	{
		$this->submitForm();

		$form = $this->getForm();

		if (!$form->isValid()) {
			return;
		}

		$data = $form->getData();
		$this->leadGenerator->setProducts($data['products']);

		return $this->redirectToRoute('app_lead_details');
	}
}
