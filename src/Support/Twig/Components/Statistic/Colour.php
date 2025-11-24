<?php

namespace App\Support\Twig\Components\Statistic;

enum Colour: string {
	case Dark = 'dark';
	case Light = 'light';

	public function getClass(): string {
		return match($this) {
			self::Dark => 'bg-zinc-950/65 border-zinc-950/0 text-white',
			self::Light => 'border-white/80 text-white',
		};
	}
}
