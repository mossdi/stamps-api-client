<?php

namespace Panacea\Stamps\Providers;

use Exception;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Contracts\BaseSoapClient;
use Panacea\Stamps\Dto\Address;
use Panacea\Stamps\Dto\Rate;

class StampsSoapClient extends BaseSoapClient
{
    /**
     * @param Rate $rate
     * @param string $imageType
     * @param bool $isSampleOnly
     * @return mixed
     * @throws Exception
     */
    public function createIndicium(Rate $rate, string $imageType = ImageType::PNG, bool $isSampleOnly = true)
    {
        if (!$isSampleOnly) $this->checkAccountBalance();
        $this->cleanseAddress($rate->getFrom());
        $this->cleanseAddress($rate->getTo());

        return $this->getSoapClient()->CreateIndicium([
            'Authenticator' => $this->getAuthToken(),
            'IntegratorTxID' => time(),
            'SampleOnly' => $isSampleOnly,
            'ImageType' => $imageType,
            'Rate' => $rate->toSoapArray()
        ]);
    }

    /**
     * @param string $stampsTxID
     * @return mixed
     */
    public function cancelIndicium(string $stampsTxID)
    {
        return $this->getSoapClient()->CancelIndicium([
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
        $cleanseToAddressResponse = $this->getSoapClient()->CleanseAddress([
            'Authenticator' => $this->getAuthToken(),
            'Address' => $address->toSoapArray()
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new Exception('Invalid address.');
        }
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function getRates(array $options)
    {
        return $this->getSoapClient()->GetRates([
            'Authenticator' => $this->getAuthToken(),
            'Rate' => $options
        ]);
    }

    /**
     * @return mixed
     */
    public function getAccountInfo()
    {
        return $this->getSoapClient()->GetAccountInfo([
            'Authenticator' => $this->getAuthToken()
        ]);
    }

    //================================================================================================================

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
