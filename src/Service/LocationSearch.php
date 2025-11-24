<?php

namespace App\Service;

use App\Entity\Location;
use http\Exception\RuntimeException;
use Symfony\Component\Serializer\Normalizer\UnwrappingDenormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationSearch
{
	private const ENDPOINT = 'https://photon.komoot.io/api/';
	private const DEFAULT_RESULT_LIMIT = 10;

	public function __construct(
		private HttpClientInterface $client,
	) {}

	public function find(string $query, int $limit = self::DEFAULT_RESULT_LIMIT): array
	{
		$response = $this->client->request('GET', self::ENDPOINT, [
			'query' => [
				'q' => htmlspecialchars($query),
				'limit' => $limit,
			],
		]);

		if ($response->getStatusCode() !== 200) {
			throw new RuntimeException("Didn't get a valid status from the location API");
		}

		if ($response->getHeaders()['content-type'][0] !== 'application/json') {
			throw new RuntimeException("Didn't get a valid content type from the location API");
		}

		return $this->parse($response->getContent());
	}

	private function parse(string $json): array
	{
		$results = json_decode($json, true);

		if (json_last_error() !== JSON_ERROR_NONE) {
			throw new RuntimeException("Unable to parse location results");
		}

		if (!is_array($results) || empty($results['features'])) {
			return [];
		}

		// @todo Not huge on this; needs cleaning up to prevent warnings.
		return array_map(
			fn (array $location) => [
				'address' => $this->getLocationAddressLine($location),
				'city' => $location['properties']['city'] ?? '',
				'postcode' => $location['properties']['postcode'] ?? '',
				'country' => $location['properties']['country'],
				'latitude' => $location['geometry']['coordinates'][1],
				'longitude' => $location['geometry']['coordinates'][0]
			],
			$results['features']
		);
	}

	private function getLocationAddressLine(array $location): string
	{
		return match ($location['properties']['type']) {
			'house' => sprintf('%s %s', $location['properties']['housenumber'], $location['properties']['street']),
			default => $location['properties']['name'],
		};
	}
}
