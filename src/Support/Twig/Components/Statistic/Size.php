<?php

namespace App\Support\Twig\Components\Statistic;

enum Size: string {
	case Default = 'default';
	case Wide = 'wide';

	public function getClass(): string {
		return match($this) {
			self::Default => 'max-w-[33%] text-center',
			self::Wide => 'max-w-[58%]',
		};
	}
}
