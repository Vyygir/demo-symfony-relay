<?php

namespace App\Entity;

use http\Exception\InvalidArgumentException;

/**
 * Barebones because, really, these are static. We just load them from a config
 * file. I'd imagine, in the real scenario, we probably could've wired this up
 * to a back-end that wasn't inherited through WordPress, purely for client
 * management.
 */
class Product
{
	public function __construct(
		private readonly string $name,
		private readonly string $description,
	) {}

	public function getName(): string
	{
		return $this->name;
	}

	public function getDescription(): string
	{
		return $this->description;
	}

	public function toArray(): array
	{
		return [
			'name' => $this->getName(),
			'description' => $this->getDescription(),
		];
	}

	public static function fromArray(array $data): self
	{
		if (!isset($data['name']) || !isset($data['description'])) {
			throw new InvalidArgumentException('Missing required key(s) to create Product: name, description');
		}

		return new self($data['name'], $data['description']);
	}
}
