<?php

use PSRVConnector\Connectors\Dadata\API\Clean;
use PSRVConnector\Connectors\Dadata\Connector;

require 'vendor/autoload.php';

class TestConnect extends PSRVConnector\Service
{
    use Clean;

    public function __construct()
    {
        parent::__construct(new Connector(
                'cc2ff0b9a19ab1e01e7efb48b7f4f9f56ec8756a',
                '1adaaf711f859b922c8d6327186480faa2bb3a2b',
                ['base_uri' => 'https://cleaner.dadata.ru/api/v1/']
            )
        );
    }

    public function getDatByAddress(string $sBody)
    {
        return $this->getAddress($sBody);
    }
}

$obTest = new TestConnect();
var_dump($obTest->getDatByAddress('мск сухонска 11/-89'));
