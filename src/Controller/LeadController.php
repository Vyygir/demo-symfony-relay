<?php

namespace App\Controller;

use App\Entity\Lead;
use App\Service\LeadGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LeadController extends AbstractController
{
	public function __construct(
		private readonly LeadGenerator $leadGenerator,
	) {}

	#[Route('/', name: 'app_lead_index')]
	public function index(): Response
	{
		return $this->render('pages/index.html.twig');
	}

	#[Route('/products', name: 'app_lead_products')]
	public function products(): Response
	{
		return $this->render('pages/products.html.twig');
	}

	#[Route('/details', name: 'app_lead_details')]
	public function details(): Response
	{
		$products = $this->leadGenerator->getProducts();

		if (!$products) {
			return $this->redirectToRoute('app_lead_products');
		}

		return $this->render('pages/details.html.twig');
	}

	#[Route('/thanks', name: 'app_lead_confirmation')]
	public function confirmation(): Response
	{
		$lead = $this->leadGenerator->getLead();

		if (!$lead) {
			return $this->redirectToRoute('app_lead_index');
		}

		$this->leadGenerator->clear();

		return $this->render('pages/confirmation.html.twig', [
			'lead' => $lead,
		]);
	}
}
