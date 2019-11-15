<?php


namespace PSRVConnector\Interfaces;


interface ConnectorInterface
{
    /**
     * Initialize new connection.
     * @param array $arParams Array of connection parameters.
     * @return mixed
     */
    public function getConnection(array $arParams = []);

    /**
     * Set query to rest server.
     * @param string $sQuery String to send.
     * @return array
     */
    public function setQuery(string $sQuery) : array;
}
