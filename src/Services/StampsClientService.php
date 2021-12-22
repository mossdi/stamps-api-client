<?php

namespace Panacea\Stamps\Services;

use Panacea\Stamps\Contracts\AbstractClient;

class StampsClientService extends AbstractClient
{
    /**
     * @param array $labelOptions
     * @return mixed
     */
    public function createIndicium(array $labelOptions)
    {
        $labelOptions['Authenticator'] = $this->getAuthToken();
        return $this->soapClient->CreateIndicium($labelOptions);
    }

    /**
     * @param string $stampsTxID
     * @return mixed
     */
    public function cancelIndicium(string $stampsTxID)
    {
        return $this->soapClient->CancelIndicium([
            'Authenticator' => $this->getAuthToken(),
            'StampsTxID' => $stampsTxID,
        ]);
    }

    /**
     * @param array $address
     * @return mixed
     */
    public function cleanseAddress(array $address)
    {
        return $this->soapClient->CleanseAddress([
            'Authenticator' => $this->getAuthToken(),
            'Address' => $address
        ]);
    }

    /**
     * @param array $rateOptions
     * @return mixed
     */
    public function getRates(array $rateOptions)
    {
        return $this->soapClient->GetRates([
            'Authenticator' => $this->getAuthToken(),
            'Rate' => $rateOptions
        ]);
    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        return $this->soapClient->GetAccountInfo([
            'Authenticator' => $this->getAuthToken()
        ]);
    }
}
