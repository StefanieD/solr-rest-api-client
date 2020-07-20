<?php

namespace SolrRestApiClient\Common;

/**
 * Class Factory
 *
 * @package Searchperience\Common
 */
class Factory {

	/**
	 * @param string $hostname
	 * @param int $port
	 * @param string $corePath
	 * @return \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymRepository
	 */
	public static function getSynonymRepository($hostname = 'localhost', $port = 8080, $corePath = 'solr/', $authArray = []) {
		$dataMapper         = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymDataMapper();
		$synonymRepository  = new \SolrRestApiClient\Api\Client\Domain\Synonym\SynonymRepository();
		$synonymRepository->setHostName($hostname);
		$synonymRepository->setPort($port);
		$synonymRepository->setCorePath($corePath);
        $guzzle = self::getPreparedGuzzleClient($synonymRepository->getBaseUrl(), $authArray);
		$synonymRepository->injectRestClient($guzzle);
		$synonymRepository->injectDataMapper($dataMapper);
		$synonymRepository->setRestClientBaseUrl();

		return $synonymRepository;
	}

	/**
	 * @param string $hostname
	 * @param int $port
	 * @param string $corePath
	 * @return \SolrRestApiClient\Api\Client\Domain\StopWord\StopWordRepository
	 */
	public static function getStopWordRepository($hostname = 'localhost', $port = 8080, $corePath = 'solr/', $authArray = []) {
		$dataMapper         = new \SolrRestApiClient\Api\Client\Domain\StopWord\StopWordDataMapper();
		$stopWordRepository  = new \SolrRestApiClient\Api\Client\Domain\StopWord\StopWordRepository();
		$stopWordRepository->setHostName($hostname);
		$stopWordRepository->setPort($port);
		$stopWordRepository->setCorePath($corePath);
		$guzzle = self::getPreparedGuzzleClient($stopWordRepository->getBaseUrl(), $authArray);
		$stopWordRepository->injectRestClient($guzzle);
		$stopWordRepository->injectDataMapper($dataMapper);
		$stopWordRepository->setRestClientBaseUrl();

		return $stopWordRepository;
	}

	/**
	 * @param string $hostname
	 * @param int $port
	 * @param string $corePath
	 * @return \SolrRestApiClient\Api\Client\Domain\ManagedResource\ManagedResourceRepository
	 */
	public static function getManagedResourceRepository($hostname = 'localhost', $port = 8080, $corePath = 'solr/', $authArray = []) {
		$dataMapper = new \SolrRestApiClient\Api\Client\Domain\ManagedResource\ManagedResourceDataMapper();
		$managedResourceRepository = new \SolrRestApiClient\Api\Client\Domain\ManagedResource\ManagedResourceRepository();
		$managedResourceRepository->setHostName($hostname);
		$managedResourceRepository->setPort($port);
		$managedResourceRepository->setCorePath($corePath);
        $guzzle = self::getPreparedGuzzleClient($managedResourceRepository->getBaseUrl(), $authArray);
		$managedResourceRepository->injectRestClient($guzzle);
		$managedResourceRepository->injectDataMapper($dataMapper);
		$managedResourceRepository->setRestClientBaseUrl();

		return $managedResourceRepository;
	}

	/**
	 * @return \GuzzleHttp\Client
	 * @throws Exception\RuntimeException
	 */
	protected static function getPreparedGuzzleClient($baseUrl, $authArray) {
		$options = [
            'base_uri' => $baseUrl,
            'redirect.disable' => true,
        ];

		if (count($authArray)) {
            $options['auth'] = $authArray;
        }

		return new \GuzzleHttp\Client($options);
	}
}