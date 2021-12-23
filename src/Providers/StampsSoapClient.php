<?php

namespace Panacea\Stamps\Providers;

use Exception;
use Panacea\Stamps\Contracts\BaseClient;
use Panacea\Stamps\Dto\Address;

class StampsSoapClient extends BaseClient
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
        parent::__construct($apiUrl);

        $this->setApiIntegrationId($apiIntegrationId);
        $this->setApiUserId($apiUserId);
        $this->setApiPassword($apiPassword);
    }

    /**
     * @param array $labelOptions
     * @return mixed
     * @throws Exception
     */
    public function createIndicium(array $labelOptions)
    {
        // 1. Check account balance
        if (!$labelOptions['SampleOnly']) $this->checkAccountBalance();

        // 2. Cleanse recipient address
        $this->cleanseAddress((new Address())->fillFromArray($labelOptions['Rate']['To']));

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
     * @param Address $address
     * @return void
     * @throws Exception
     */
    public function cleanseAddress(Address $address)
    {
        $cleanseToAddressResponse = $this->soapClient->CleanseAddress([
            'Authenticator' => $this->getAuthToken(),
            'Address' => [
                'FullName' => $address->getFullName(),
                'Address1' => $address->getAddress1(),
                'Address2' => $address->getAddress2(),
                'City' => $address->getCity(),
                'State' => $address->getState(),
                'ZIPcode' => $address->getZipcode()
            ]
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new Exception('Invalid to address.');
        }
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

    //================================================================================================================

    /**
     * @return string
     */
    private function getAuthToken(): string
    {
        $response = $this->soapClient->AuthenticateUser([
            'Credentials' => [
                'IntegrationID' => $this->apiIntegrationId,
                'Username' => $this->apiUserId,
                'Password' => $this->apiPassword
            ]
        ]);

        return $response->Authenticator;
    }

    /**
     * @return void
     * @throws Exception
     */
    private function checkAccountBalance()
    {
        $accountInfoResponse = $this->getAccountInfo();
        $availableBalance = (double) $accountInfoResponse->AccountInfo->PostageBalance->AvailablePostage;

        if ($availableBalance < 3) {
            throw new Exception('Insufficient funds: ' . $availableBalance);
        }
    }
}
