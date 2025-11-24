<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Lead;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
	ChoiceType,
	CountryType,
	EmailType,
	TelType,
	TextareaType,
	TextType,
	SubmitType,
};

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\{DynamicFormBuilder, DependentField};

class LeadType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder = new DynamicFormBuilder($builder);

		$builder
			->add('forename', TextType::class, [
				'label' => 'First',
			])
			->add('surname', TextType::class, [
				'label' => 'Last',
			])
			->add('email', EmailType::class, [
				'label' => 'Email',
			])
			->add('phone', TelType::class, [
				'label' => 'Telephone',
			])
			->add('existingCustomer', ChoiceType::class, [
				'label' => 'Are you an existing customer?',
				'expanded' => true,
				'multiple' => false,
				'choices' => [
					'Yes' => true,
					'No' => false,
				],
				'data' => false,
			])
			->add('company', TextType::class, [
				'label' => 'Company',
			])
			->add('role', TextType::class, [
				'label' => 'Job Title',
			])
			->add('country', CountryType::class, [
				'label' => 'Country',
				'placeholder' => 'Select your country...',
			])
			->addDependent('employees', 'existingCustomer', function (DependentField $field, ?bool $existingCustomer) {
				if ($existingCustomer === true) {
					$field->add(TextType::class, [
						'label' => 'Number of Employees',
					]);
				}
			})
			->add('comments', TextareaType::class, [
				'label' => 'Comments',
				'required' => false,
			])
			->add('submit', SubmitType::class, [
				'label' => 'Request your quote',
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => Lead::class,
		]);
	}
}
