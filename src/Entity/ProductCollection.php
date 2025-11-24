<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class ProductCollection
{
	#[ORM\Column(type: Types::JSON)]
	private array $items = [];

	/** @return Product[] */
	public function getProducts(): array
	{
		return array_map(fn ($data) => Product::fromArray($data), $this->items);
	}

	public function setProducts(array $products): void
	{
		$this->items = array_map(fn (Product $product) => $product->toArray(), $products);
	}

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
        $this->items = $items;

        return $this;
    }
}
