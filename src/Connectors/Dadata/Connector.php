<?php

namespace PSRVConnector\Connectors\Dadata;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PSRVConnector\Interfaces\ConnectorInterface;

/**
 * Connector to DaData api service.
 * Class Connector
 * @package PSRVConnector\Connectors\Dadata
 */
class Connector implements ConnectorInterface
{
    /**
     * @var string $sApiKey Secret key for connection to service.
     */
    private $sApiKey = '';
    /**
     * @var string $sMethod Request method.
     */
    private $sMethod = 'GET';
    /**
     * @var string $sBaseUri Uri of service.
     */
    private $sBaseUri = 'https://suggestions.dadata.ru/suggestions/api/4_1/';
    /**
     * @see \GuzzleHttp\RequestOptions
     * @var array $arOptions Connection params.
     */
    private $arOptions = [];


    /**
     * @var Client $obConnection Connector to service.
     */
    private $obConnection;

    /**
     * Connector constructor.
     * @param array $arParams Array of configs for connection.
     * { @internal [api_key, method, base_uri, options] }}
     */
    public function __construct(array $arParams = ['api_key', 'method', 'base_uri', 'options'])
    {
        $this->setSApiKey($arParams['api_key']);
        $this->setSMethod($arParams['method']);
        $this->setSBaseUri($arParams['base_uri']);
        $this->setArOptions($arParams['options']);
    }

    /**
     * Method return connection to service.
     * @param array $arParams \GuzzleHttp\RequestOptions.
     * @return Client|mixed
     * @throws GuzzleException
     */
    public function getConnection(
        array $arParams = []
    ) : Client
    {
        if(count($arParams) > 0) {
            $arParams['base_uri'] = $arParams['base_uri'] ?? $this->getSBaseUri();
            $obConnection = new Client($arParams);
        }

        return $obConnection ?? $this->obConnection;
    }

    public function setQuery(string $sQuery): array
    {
        // TODO: Implement setQuery() method.
        return [];
    }


    // Getters and Setters/


    /**
     * @return string
     */
    public function getSApiKey(): string
    {
        return $this->sApiKey;
    }

    /**
     * @param string $sApiKey
     */
    public function setSApiKey(string $sApiKey)
    {
        $this->sApiKey = !empty($sApiKey) ?? $this->sApiKey;
    }

    /**
     * @return string
     */
    public function getSMethod(): string
    {
        return $this->sMethod;
    }

    /**
     * @param string $sMethod
     */
    public function setSMethod(string $sMethod)
    {
        $this->sMethod = !empty($sMethod) ?? $this->sMethod;
    }

    /**
     * @return string
     */
    public function getSBaseUri(): string
    {
        return $this->sBaseUri;
    }

    /**
     * @param string $sBaseUri
     */
    public function setSBaseUri(string $sBaseUri)
    {
        $this->sBaseUri = !empty($sBaseUri) ?? $this->sBaseUri;
    }

    /**
     * @return array
     */
    public function getArOptions(): array
    {
        return $this->arOptions;
    }

    /**
     * @param array $arOptions
     */
    public function setArOptions(array $arOptions)
    {
        $this->arOptions = array_merge($arOptions, $this->arOptions);
    }

}
