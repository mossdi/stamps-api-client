<?php

namespace Mossdi\Stamps\Providers;

use Exception;
use Mossdi\Stamps\Contracts\BaseSoapClient;
use Mossdi\Stamps\Dto\Address;
use Mossdi\Stamps\Dto\Rate;
use Mossdi\Stamps\Enums\ImageType;

class StampsSoapClient extends BaseSoapClient
{
    /**
     * @throws Exception
     */
    public function createIndicium(
        Rate   $rate,
        string $imageType = ImageType::PNG->value,
        bool   $isSampleOnly = true
    ): mixed
    {
        if (!$isSampleOnly) $this->checkAccountBalance();
        $this->cleanseAddress($rate->getFrom());
        $this->cleanseAddress($rate->getTo());

        return $this->getSoapClient()->CreateIndicium([
            'Authenticator' => $this->getAuthToken(),
            'IntegratorTxID' => time(),
            'SampleOnly' => $isSampleOnly,
            'ImageType' => $imageType,
            'Rate' => $rate->toArray()
        ]);
    }

    public function cancelIndicium(string $stampsTxID): mixed
    {
        return $this->getSoapClient()->CancelIndicium([
            'Authenticator' => $this->getAuthToken(),
            'StampsTxID' => $stampsTxID,
        ]);
    }

    public function trackShipment(string $stampsTxID): mixed
    {
        return $this->getSoapClient()->TrackShipment([
            'Authenticator' => $this->getAuthToken(),
            'StampsTxID' => $stampsTxID,
        ]);
    }

    /**
     * @throws Exception
     */
    public function cleanseAddress(Address $address): void
    {
        $cleanseToAddressResponse = $this->getSoapClient()->CleanseAddress([
            'Authenticator' => $this->getAuthToken(),
            'Address' => $address->toArray()
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new Exception('Invalid address.');
        }
    }

    public function getRates(array $options): mixed
    {
        return $this->getSoapClient()->GetRates([
            'Authenticator' => $this->getAuthToken(),
            'Rate' => $options
        ]);
    }

    public function getAccountInfo(): mixed
    {
        return $this->getSoapClient()->GetAccountInfo([
            'Authenticator' => $this->getAuthToken()
        ]);
    }

    /**
     * @throws Exception
     */
    private function checkAccountBalance(): void
    {
        $accountInfoResponse = $this->getAccountInfo();
        $availableBalance = (double)$accountInfoResponse->AccountInfo->PostageBalance->AvailablePostage;

        if ($availableBalance < 3) {
            throw new Exception('Insufficient funds: ' . $availableBalance);
        }
    }
}
