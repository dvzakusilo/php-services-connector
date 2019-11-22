<?php
namespace PSRVConnector;

use PSRVConnector\Interfaces\ConnectorInterface;

abstract class Service
{
    public $obConnector;

    public function __construct(ConnectorInterface $obConnector)
    {
        $this->setObConnector($obConnector);
    }

    /**
     * @return ConnectorInterface
     */
    public function getObConnector(): ConnectorInterface
    {
        return $this->obConnector;
    }

    /**
     * @param ConnectorInterface $obConnector
     */
    public function setObConnector(ConnectorInterface $obConnector)
    {
        $this->obConnector = $obConnector;
    }
}
