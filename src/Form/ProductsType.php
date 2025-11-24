<?php

declare(strict_types=1);

namespace App\Form;

use App\Config\ProductsConfiguration;
use App\Entity\Product;
use App\Service\LeadGenerator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{ChoiceType, SubmitType};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\{Count, NotBlank};

class ProductsType extends AbstractType
{
	public function __construct(
		private readonly ProductsConfiguration $productsConfiguration,
		private readonly LeadGenerator $leadGenerator,
	) {}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('products', ChoiceType::class, [
				'choices' => $this->productsConfiguration->getProducts(),
				'choice_label' => false,
				'choice_value' => fn(Product $product) => $product->getName(),
				'expanded' => true,
				'multiple' => true,
				'required' => true,
				'data' => $this->leadGenerator->getProducts(),
				'constraints' => [
					new Count(min: 1, minMessage: 'Come on now, at least choose one'),
				]
			])
			->add('submit', SubmitType::class, [
				'label' => 'Next',
				'attr' => [
					'class' => '!w-auto button button--default button--large',
				]
			]);
	}
}
