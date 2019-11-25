<?php


namespace PSRVConnector\Interfaces;


interface ConnectorInterface
{
    /**
     * Initialize new connection.
     * @param array $arParams Array of connection parameters.
     * @return mixed
     */
    public function setConnection(array $arParams = []);

    /**
     * Set query to rest server.
     * @param string $sQuery String to send.
     * @param string $sUri Relative uri.
     * @return array
     */
    public function setQuery(string $sQuery, string $sUri = '');
}
