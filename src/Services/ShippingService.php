<?php

namespace Panacea\Stamps\Services;

use Exception;
use Panacea\Stamps\Dto\Rate;
use Panacea\Stamps\Dto\Address;
use Panacea\Stamps\Dto\CreateIndiciumResponse;
use Panacea\Stamps\Dto\TrackShipmentResponse;
use Panacea\Stamps\Providers\StampsSoapClient;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;
use Panacea\Stamps\Enums\AddOnType;
use Panacea\Stamps\Enums\ImageType;

class ShippingService
{
    /**
     * Service with client
     *
     * @var StampsSoapClient
     */
    private $stampsSoapClient;

    public function __construct()
    {
        $this->stampsSoapClient = new StampsSoapClient();
    }

    /**
     * @param Address $from
     * @param Address $to
     * @param string $shipDate
     * @param float $weightOz
     * @param bool $isSampleOnly
     * @param bool $showPrice
     * @param string $imageType
     * @param string $packageType
     * @param string $serviceType
     *
     * @return CreateIndiciumResponse
     *
     * @throws Exception
     */
    public function createDomesticLabel(
        Address $from,
        Address $to,
        string $shipDate,
        float $weightOz,
        bool $isSampleOnly = false,
        bool $showPrice = false,
        string $imageType = ImageType::PDF,
        string $packageType = PackageType::PACKAGE,
        string $serviceType = ServiceType::FC
    ): CreateIndiciumResponse
    {
        $rateData = [
            'From' => $from->toSoapArray(),
            'To' => $to->toSoapArray(),
            'ServiceType' => $serviceType,
            'WeightOz' => $weightOz,
            'PackageType' => $packageType,
            'ShipDate' => $shipDate,
        ];

        if (!$showPrice) {
            $rateData['AddOns']['AddOnV1'] = ['AddOnType' => AddOnType::HIDE_PRICE];
        }

        $createIndiciumResponse = $this->stampsSoapClient
            ->createIndicium(Rate::instance($rateData), $imageType, $isSampleOnly);

        return CreateIndiciumResponse::instance($createIndiciumResponse);
    }

    /**
     * @param string $stampsTxId
     *
     * @return void
     */
    public function cancelLabel(string $stampsTxId): void
    {
        $this->stampsSoapClient->cancelIndicium($stampsTxId);
    }

    /**
     * @param string $stampsTxId
     *
     * @return TrackShipmentResponse
     */
    public function trackShipment(string $stampsTxId): TrackShipmentResponse
    {
        $trackShipmentResponse = $this->stampsSoapClient->trackShipment($stampsTxId);
        return TrackShipmentResponse::instance($trackShipmentResponse);
    }
}
