<?php

declare(strict_types=1);

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Support\Twig\Components\Statistic\{Colour, Size};

#[AsTwigComponent]
class Statistic
{
	public Colour $colour;
	public Size $size = Size::Default;

	public string $number;
	public string $label;
}
