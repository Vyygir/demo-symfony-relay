<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\LeadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
	public function __construct(
		private readonly LeadRepository $leadRepository,
	) {}

	#[Route('/api/leads')]
	public function index(): Response
	{
		$leads = $this->leadRepository->findAll();

		if (!$leads) {
			return $this->json([
				'message' => 'No leads have been created',
			])->setStatusCode(Response::HTTP_NOT_FOUND);
		}

		return $this->json($this->leadRepository->findAll());
	}
}
