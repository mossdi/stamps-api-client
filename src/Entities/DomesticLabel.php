<?php

namespace Panacea\Stamps\Entities;

use Exception;
use Panacea\Stamps\Dto\AddOns;
use Panacea\Stamps\Dto\Address;
use Panacea\Stamps\Dto\CreateIndiciumResponse;
use Panacea\Stamps\Dto\Rate;
use Panacea\Stamps\Enums\AddOnType;
use Panacea\Stamps\Providers\StampsSoapClient;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;

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
    public function __construct()
    {
        $this->stampsSoapClient = new StampsSoapClient();

        $this->packageType = PackageType::PACKAGE;
        $this->serviceType = ServiceType::FC;
        $this->imageType = ImageType::PNG;
        $this->shipDate = date('Y-m-d');
    }

    /**
     * @return Address
     */
    public function getFrom(): Address
    {
        return $this->from;
    }

    /**
     * @param Address $from
     * @return DomesticLabel
     */
    public function setFrom(Address $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Address
     */
    public function getTo(): Address
    {
        return $this->to;
    }

    /**
     * @param Address $to
     * @return DomesticLabel
     */
    public function setTo(Address $to): self
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSampleOnly(): bool
    {
        return $this->isSampleOnly;
    }

    /**
     * @param bool $isSampleOnly
     * @return DomesticLabel
     */
    public function setIsSampleOnly(bool $isSampleOnly): self
    {
        $this->isSampleOnly = $isSampleOnly;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowPrice(): bool
    {
        return $this->showPrice;
    }

    /**
     * @param bool $showPrice
     * @return DomesticLabel
     */
    public function setShowPrice(bool $showPrice): self
    {
        $this->showPrice = $showPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getWeightOz(): float
    {
        return $this->weightOz;
    }

    /**
     * @param float $weightOz
     * @return DomesticLabel
     */
    public function setWeightOz(float $weightOz): self
    {
        $this->weightOz = $weightOz;
        return $this;
    }

    /**
     * @return string
     */
    public function getImageType(): string
    {
        return $this->imageType;
    }

    /**
     * @param string $imageType
     * @return DomesticLabel
     */
    public function setImageType(string $imageType): self
    {
        $this->imageType = $imageType;
        return $this;
    }

    /**
     * @return string
     */
    public function getPackageType(): string
    {
        return $this->packageType;
    }

    /**
     * @param string $packageType
     * @return DomesticLabel
     */
    public function setPackageType(string $packageType): self
    {
        $this->packageType = $packageType;
        return $this;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @param string $serviceType
     * @return DomesticLabel
     */
    public function setServiceType(string $serviceType): self
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return string
     */
    public function getShipDate(): string
    {
        return $this->shipDate;
    }

    /**
     * @param string $shipDate
     * @return DomesticLabel
     */
    public function setShipDate($shipDate): self
    {
        $this->shipDate = $shipDate;
        return $this;
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
     * @return mixed
     */
    public function cancel()
    {
        return $this->stampsSoapClient->cancelIndicium($this->stampsTxID);
    }
}
