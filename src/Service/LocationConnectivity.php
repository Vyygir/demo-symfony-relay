<?php

namespace App\Service;

use App\Support\Connectivity\Status;

class LocationConnectivity
{
	/**
	 * Hi.
	 *
	 * You probably expected another API call or remote query execution here,
	 * or something that does a cool thing to identify the connection state of
	 * a physical located based on coordinates.
	 *
	 * Well... no.
	 *
	 * You have to bear in mind, this is a demonstrative application. This
	 * isn't production-ready, nor is it something I'd necessarily be happy
	 * putting _into_ a production environment. What we do here is, quite
	 * simply, take the `Connectivity` enum and then grab a random value
	 * from it.
	 *
	 * That's it.
	 *
	 * There's zero tangible or reasonable rationale for me to both mock and
	 * then implement an API system that's going to be used, at most, maybe
	 * close to a hundred times.
	 *
	 * If you think otherwise then... fine? That's on you, I guess. It sounds
	 * like you've got a lot going on. Maybe feeling discontentful? Or has
	 * something finally sowed discontent? If that is the case then, boy, do I
	 * have what you **need**:
	 *
	 * https://starle.sh
	 *
	 * Come disagree with me. Or agree with me. Read or don't. At the end of
	 * the day, who cares?
	 *
	 * Onto the code...
	 */

	public function getStatus(float $latitude, float $longitude): Status
	{
		/** Oh, look, function arguments! We'll _definitely_ use those... */
		[ $latitude, $longitude ];

		/** I feel like this should take a while... */
		sleep(3);
		
		return Status::random();
	}
}
