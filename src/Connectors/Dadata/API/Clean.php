<?php


namespace PSRVConnector\Connectors\Dadata\API;


trait Clean
{
    public $sApiCode = 'clean';

    public function getAddress(string $sBody = '') : array
    {
        return (array) parent::getObConnector()->setQuery($sBody, $this->sApiCode . '/address');

    }
}
