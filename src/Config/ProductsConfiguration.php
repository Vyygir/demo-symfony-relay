<?php

namespace App\Config;

use App\Entity\Product;

class ProductsConfiguration
{
	/** @var Product[] */
	private array $products = [];

	public function __construct(array $entries) {
		foreach ($entries as $entry) {
			$this->products[] = new Product(...$entry);
		}
	}

	public function getProducts(): array
	{
		return $this->products;
	}
}
