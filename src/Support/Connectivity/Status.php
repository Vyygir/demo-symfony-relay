<?php

namespace App\Support\Connectivity;

enum Status: string {
	case OnNetwork = 'on';
	case OffNetwork = 'off';
	case Failed = 'failed';

	public static function random(): Status
	{
		return self::cases()[rand(0, count(self::cases()) - 1)];
	}
}
