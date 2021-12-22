<?php

namespace Panacea\Stamps\Services;

use Exception;
use Panacea\Stamps\Contracts\AbstractClient;

class StampsClientService extends AbstractClient
{
    /**
     * @param string $apiIntegrationId
     * @param string $apiUserId
     * @param string $apiPassword
     * @param string|null $apiUrl
     * @throws Exception
     */
    public function __construct(
        string $apiIntegrationId,
        string $apiUserId,
        string $apiPassword,
        string $apiUrl
    ) {
        parent::__construct(sprintf('%s?WSDL', $apiUrl));

        $this->setApiIntegrationId($apiIntegrationId);
        $this->setApiUserId($apiUserId);
        $this->setApiPassword($apiPassword);
    }

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
