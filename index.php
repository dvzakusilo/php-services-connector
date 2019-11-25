<?php

use PSRVConnector\Connectors\Dadata\API\Clean;
use PSRVConnector\Connectors\Dadata\Connector;

require 'vendor/autoload.php';

/**
 * Class TestConnect
 */
class TestConnect extends PSRVConnector\Service
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

$obTest = new TestConnect();
var_dump($obTest->getDatByAddress('мск сухонска 11/-89'));
