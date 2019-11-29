<?php

namespace PSRVConnector\Connectors;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PSRVConnector\Interfaces\ConnectorInterface;

/**
 * Connector to ANY api service by GuzzleHTTP.
 * Class Connector
 * @package PSRVConnector\Connectors
 */
class GuzzleConnector implements ConnectorInterface
{
    /**
     * @var string $sApiKey Secret key for connection to service.
     */
    public $sApiKey = '';
    /**
     * @var string $sMethod Request method.
     */
    public $sMethod = 'POST';
    /**
     * @var string $sBaseUri Uri of service.
     */
    public $sBaseUri = '';
    /**
     * @var string $sUri Relative uri.
     */
    public $sUri = '';
    /**
     * @var array $arHeaders Type of document.
     */
    public $arHeaders = [
        'Content-Type' => 'application/json',
        'Content-Transfer-Encoding' => 'binary',
        'MIME-Version' => '1.0',
    ];
    /**
     * @var string $sSecretKey Key for connection.
     */
    public $sSecretKey = '';

    /**
     * @see \GuzzleHttp\RequestOptions
     * @var array $arOptions Connection params.
     */
    public $arOptions = [];


    /**
     * @var Client $obConnection Connector to service.
     */
    public $obConnection;

    /**
     * Connector constructor.
     * @param array $arParams Array of configs for connection.
     * { @param string $sSecretKey Secret key for connection to service.
     * @internal ['method', 'base_uri', 'headers', 'options'] }}
     */
    public function __construct(
        array $arParams = [
            'api_key' => '',
            'secret_key' => '',
            'method' => '',
            'base_uri' => '',
            'headers' => [],
            'options' => []
        ]
    )
    {
        $this->setArOptions($arParams);
        $this->setSApiKey($arParams['api_key']);
        $this->setSSecretKey($arParams['secret_key']);
        $this->setConnection($arParams);
    }

    /**
     * Method set connection to service.
     * @param array $arParams \GuzzleHttp\RequestOptions.
     */
    public function setConnection(
        array $arParams = []
    )
    {
//        If need reconnect to service.
        if (count($arParams) > 0 || empty($this->obConnection)) {
            $this->setSMethod($arParams['method']);
            $this->setSBaseUri($arParams['base_uri']);
            $this->setArOptions($arParams['options']);
            $this->setArHeaders($arParams['headers']);
            $arParams['base_uri'] = $this->getSBaseUri();
            $obConnection = new Client($arParams);
        }

        $this->obConnection = $obConnection ?? $this->obConnection;
    }

    /**
     * Helper method to execute deferred HTTP requests.
     * @param string $sQuery Text of query.
     * @param string $sUri Relative link.
     * @param string $sMethod Http method. If Empty, then get from global params.
     *
     * @return array
     * @throws GuzzleException
     */
    public function setQuery(string $sQuery, string $sUri = '', string $sMethod = ''): array
    {
        $this->setSUri($sUri);
        $this->setSMethod($sMethod);
        $httpResponse = $this->obConnection->request($this->getSMethod(),
            $this->getSUri(),
            array(
                'headers' => $this->getArHeaders(),
                'body' => $sQuery,
            )
        );
        return ((array)json_decode($httpResponse->getBody()));
    }


    // Getters and Setters //


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
    public function setSApiKey(string $sApiKey = '')
    {
        $this->sApiKey = $sApiKey ?? $this->sApiKey;
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
    public function setSMethod($sMethod)
    {
        $this->sMethod = empty($sMethod) ?  $this->sMethod : $sMethod;
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
    public function setSBaseUri($sBaseUri)
    {
        $this->sBaseUri = $sBaseUri ?? $this->sBaseUri;
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
    public function setArOptions($arOptions = [])
    {
        $this->arOptions = array_merge($arOptions ?? $this->arOptions, $this->arOptions);
    }

    /**
     * @return array
     */
    public function getArHeaders(): array
    {
        return $this->arHeaders;
    }

    /**
     * @param array $arHeaders
     */
    public function setArHeaders($arHeaders = [])
    {
        $this->arHeaders = array_merge($arHeaders ?? $this->arHeaders, $this->arHeaders);
    }

    /**
     * @return string
     */
    public function getSSecretKey(): string
    {
        return $this->sSecretKey;
    }

    /**
     * @param string $sSecretKey
     */
    public function setSSecretKey($sSecretKey)
    {
        $this->sSecretKey = $sSecretKey ?? $this->sSecretKey;
    }

    /**
     * @return string
     */
    public function getSUri(): string
    {
        return $this->sUri;
    }

    /**
     * @param string $sUri
     */
    public function setSUri(string $sUri = '')
    {
        $this->sUri = $sUri ?? $this->sUri;
    }

}
