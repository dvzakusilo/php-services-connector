<?php


namespace PSRVConnector\Connectors\Dadata\API;

/**
 * Trait Clean Methods for API of standardization.
 * @package PSRVConnector\Connectors\Dadata\API
 * @see https://dadata.ru/api/clean/
 */
trait Clean
{
    public $sApiCode = 'clean';

    /**
     * Address Standardization API.
     * @see https://dadata.ru/api/clean/address/
     * @param string $sBody Address.
     * @return array
     */
    public function getAddress(string $sBody = '') : array
    {
        return parent::getObConnector()->setQuery($sBody, $this->sApiCode . '/address');

    }
}
