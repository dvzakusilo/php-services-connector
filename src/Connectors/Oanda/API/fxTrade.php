<?php


namespace PSRVConnector\Connectors\Oanda\API;

/**
 * Methods for work width OAnda
 * Trait fxTrade
 * @package PSRVConnector\Connectors\Oanda\API
 */
trait fxTrade
{
    public function auth()
    {
        $obConnector = parent::getObConnector();
        $obConnector->setConnection(['headers' => ['Authorization' => 'Bearer ' . $obConnector->getSApiKey()]]);
    }

    public function getAccountEndpoint(string $sAccountID = '', string $sTag = '')
    {
        $sUri = 'accounts';
        $sUri .=
            (empty($sAccountID) ? '' : '/' . $sAccountID) .
            (empty($sTag) ? '' : '/' . $sTag);

        return parent::getObConnector()->setQuery('',$sUri);
    }
}
