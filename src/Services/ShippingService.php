<?php

namespace Mossdi\Stamps\Services;

use Exception;
use Mossdi\Stamps\Dto\Address;
use Mossdi\Stamps\Dto\CreateIndiciumResponse;
use Mossdi\Stamps\Dto\Rate;
use Mossdi\Stamps\Dto\TrackShipmentResponse;
use Mossdi\Stamps\Enums\AddOnType;
use Mossdi\Stamps\Enums\ImageType;
use Mossdi\Stamps\Enums\PackageType;
use Mossdi\Stamps\Enums\ServiceType;
use Mossdi\Stamps\Providers\StampsSoapClient;

class ShippingService
{
    private StampsSoapClient $stampsSoapClient;

    public function __construct()
    {
        $this->stampsSoapClient = new StampsSoapClient();
    }

    /**
     * @throws Exception
     */
    public function createDomesticLabel(
        Address $from,
        Address $to,
        string  $shipDate,
        float   $weightOz,
        bool    $isSampleOnly = false,
        bool    $showPrice = false,
        string  $imageType = ImageType::PDF->value,
        string  $packageType = PackageType::PACKAGE->value,
        string  $serviceType = ServiceType::FC->value
    ): CreateIndiciumResponse
    {
        $rateData = [
            'From' => $from->toArray(),
            'To' => $to->toArray(),
            'ServiceType' => $serviceType,
            'WeightOz' => $weightOz,
            'PackageType' => $packageType,
            'ShipDate' => $shipDate,
        ];

        if (!$showPrice) {
            $rateData['AddOns']['AddOnV1'] = ['AddOnType' => AddOnType::HIDE_PRICE->value];
        }

        $createIndiciumResponse = $this->stampsSoapClient
            ->createIndicium(Rate::instance($rateData), $imageType, $isSampleOnly);

        return CreateIndiciumResponse::instance($createIndiciumResponse);
    }

    public function cancelLabel(string $stampsTxId): void
    {
        $this->stampsSoapClient->cancelIndicium($stampsTxId);
    }

    public function trackShipment(string $stampsTxId): TrackShipmentResponse
    {
        $trackShipmentResponse = $this->stampsSoapClient->trackShipment($stampsTxId);
        return TrackShipmentResponse::instance($trackShipmentResponse);
    }
}
