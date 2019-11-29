<?php

use PSRVConnector\Connectors\Dadata\API\Clean;
use PSRVConnector\Connectors\Dadata\Connector;
use PSRVConnector\Connectors\Oanda\API\fxTrade;

require 'vendor/autoload.php';

/**
 * Class TestDadataConnect Custom connector for service.
 */
class TestDadataConnect extends PSRVConnector\Service
{
    /**
     * Use methods DaData API of standardization.
     */
    use Clean;

    public function __construct()
    {
        parent::__construct(new Connector(
                'sApiKey',
                'sSecretKey',
                ['base_uri' => 'https://cleaner.dadata.ru/api/v1/']
            )
        );
    }

    /**
     * Method wrapper example.
     * @param string $sBody
     * @return array
     */
    public function getDatByAddress(string $sBody)
    {
        return $this->getAddress($sBody);
    }
}

//$obTest = new TestDadataConnect();
//var_dump($obTest->getDatByAddress('мск сухонска 11/-89'));


/**
 * Class TestOAndaConnect Example for connection with default connector.
 */
class TestOAndaConnect extends PSRVConnector\Service
{
    /**
     * Use methods DaData API of standardization.
     */
    use fxTrade;

    public function __construct()
    {
        parent::__construct(new PSRVConnector\Connectors\GuzzleConnector(
                [
                    'api_key' => '',
                    'base_uri' => 'https://api-fxpractice.oanda.com/v3/',
                    'method' => 'GET'
                ]
            )
        );

        $this->auth();
    }

}

$obTest = new TestOAndaConnect();
var_dump($obTest->getAccountEndpoint('101-104-1234567-101'));
