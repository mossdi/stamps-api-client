<?php

namespace Panacea\Stamps\Entities;

use Exception;
use Panacea\Stamps\Enums\AddOnType;
use Panacea\Stamps\Providers\StampsSoapClient;
use Panacea\Stamps\Dto\CreateIndiciumResponse;
use Panacea\Stamps\Dto\Address;
use Panacea\Stamps\Dto\AddOns;
use Panacea\Stamps\Dto\Rate;

class DomesticLabel
{
    /**
     * Service with client
     *
     * @var StampsSoapClient
     */
    private $stampsSoapClient;

    /**
     * The sender's address.
     *
     * @var Address
     */
    protected $from;

    /**
     * The recipient's address.
     *
     * @var Address
     */
    protected $to;

    /**
     * If true, generates a sample label without real value.
     *
     * @var bool
     */
    protected $isSampleOnly = true;

    /**
     * If true, the price will not be printed on the label.
     *
     * @var bool
     */
    protected $showPrice = false;

    /**
     * The weight of the package in ounces.
     *
     * @var float
     */
    protected $weightOz = 0.0;

    /**
     * The file type of shipping label.
     *
     * @var string
     */
    protected $imageType;

    /**
     * The package type.
     *
     * @var string
     */
    protected $packageType;

    /**
     * The mail service type.
     *
     * @var string
     */
    protected $serviceType;

    /**
     * This is the date the package will be picked up or officially enter the mail system.
     * Defaults to the current date('Y-m-d').
     *
     * @var string
     */
    protected $shipDate;

    /**
     * Can be set when the create method has been called
     *
     * @var string
     */
    protected $stampsTxID;

    /**
     * Constructor
     */
    public function __construct(
        Address $from,
        Address $to,
        float $weightOz,
        string $imageType,
        string $packageType,
        string $serviceType,
        string $shipDate,
        bool $showPrice = false,
        bool $isSampleOnly = true
    ) {
        $this->stampsSoapClient = new StampsSoapClient();

        $this
            ->setFrom($from)
            ->setTo($to)
            ->setWeightOz($weightOz)
            ->setImageType($imageType)
            ->setPackageType($packageType)
            ->setServiceType($serviceType)
            ->setShipDate($shipDate)
            ->setShowPrice($showPrice)
            ->setIsSampleOnly($isSampleOnly);
    }

    /**
     * @return CreateIndiciumResponse
     * @throws Exception
     */
    public function create(): CreateIndiciumResponse
    {
        $rateData = [
            'From' => $this->from->toSoapArray(),
            'To' => $this->to->toSoapArray(),
            'ServiceType' => $this->serviceType,
            'WeightOz' => $this->weightOz,
            'PackageType' => $this->packageType,
            'ShipDate' => $this->shipDate,
        ];

        if (!$this->showPrice) {
            $rateData['AddOns'] = AddOns::instance([
                'AddOnV16' => [
                    'AddOnType' => AddOnType::HIDE_PRICE
                ]
            ]);
        }

        $indiciumResponse = $this->stampsSoapClient->createIndicium(
            Rate::instance($rateData),
            $this->getImageType(),
            $this->isSampleOnly()
        );

        $createIndiciumResponse = CreateIndiciumResponse::instance($indiciumResponse);

        $this->stampsTxID = $createIndiciumResponse->getStampsTxID();

        return $createIndiciumResponse;
    }

    /**
     * @return mixed|void
     */
    public function cancel()
    {
        if ($this->isSampleOnly()) return;
        return $this->stampsSoapClient->cancelIndicium($this->stampsTxID);
    }

    /**
     * @return Address
     */
    public function getFrom(): Address
    {
        return $this->from;
    }

    /**
     * @return Address
     */
    public function getTo(): Address
    {
        return $this->to;
    }

    /**
     * @return bool
     */
    public function isSampleOnly(): bool
    {
        return $this->isSampleOnly;
    }

    /**
     * @return bool
     */
    public function isShowPrice(): bool
    {
        return $this->showPrice;
    }

    /**
     * @return float
     */
    public function getWeightOz(): float
    {
        return $this->weightOz;
    }

    /**
     * @return string
     */
    public function getImageType(): string
    {
        return $this->imageType;
    }

    /**
     * @return string
     */
    public function getPackageType(): string
    {
        return $this->packageType;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @return string
     */
    public function getShipDate()
    {
        return $this->shipDate;
    }

    /**
     * @return string
     */
    public function getStampsTxID(): string
    {
        return $this->stampsTxID;
    }

    /**
     * @param Address $from
     * @return DomesticLabel
     */
    private function setFrom(Address $from): DomesticLabel
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param Address $to
     * @return DomesticLabel
     */
    private function setTo(Address $to): DomesticLabel
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param bool $isSampleOnly
     * @return DomesticLabel
     */
    private function setIsSampleOnly(bool $isSampleOnly): DomesticLabel
    {
        $this->isSampleOnly = $isSampleOnly;
        return $this;
    }

    /**
     * @param bool $showPrice
     * @return DomesticLabel
     */
    private function setShowPrice(bool $showPrice): DomesticLabel
    {
        $this->showPrice = $showPrice;
        return $this;
    }

    /**
     * @param float $weightOz
     * @return DomesticLabel
     */
    private function setWeightOz(float $weightOz): DomesticLabel
    {
        $this->weightOz = $weightOz;
        return $this;
    }

    /**
     * @param string $imageType
     * @return DomesticLabel
     */
    private function setImageType(string $imageType): DomesticLabel
    {
        $this->imageType = $imageType;
        return $this;
    }

    /**
     * @param string $packageType
     * @return DomesticLabel
     */
    private function setPackageType(string $packageType): DomesticLabel
    {
        $this->packageType = $packageType;
        return $this;
    }

    /**
     * @param string $serviceType
     * @return DomesticLabel
     */
    private function setServiceType(string $serviceType): DomesticLabel
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @param string $shipDate
     * @return DomesticLabel
     */
    private function setShipDate($shipDate)
    {
        $this->shipDate = $shipDate;
        return $this;
    }

    /**
     * @param string $stampsTxID
     * @return DomesticLabel
     */
    private function setStampsTxID(string $stampsTxID): DomesticLabel
    {
        $this->stampsTxID = $stampsTxID;
        return $this;
    }
}
