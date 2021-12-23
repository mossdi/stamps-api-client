<?php

namespace Panacea\Stamps\Entities;

use Exception;
use Panacea\Stamps\Dto\Address;
use Panacea\Stamps\Dto\CreateIndiciumResponse;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;
use Panacea\Stamps\Providers\StampsSoapClient;

class Indicium
{
    /**
     * Service with client
     */
    private StampsSoapClient $stampsClientService;

    /**
     * The sender's address.
     */
    protected Address $from;

    /**
     * The recipient's address.
     */
    protected Address $to;

    /**
     * If true, generates a sample label without real value.
     */
    protected bool $isSampleOnly = true;

    /**
     * If true, the price will not be printed on the label.
     */
    protected bool $showPrice = false;

    /**
     * The weight of the package in ounces.
     */
    protected float $weightOz = 0.0;

    /**
     * The file type of shipping label.
     */
    protected string $imageType;

    /**
     * The package type.
     */
    protected string $packageType;

    /**
     * The mail service type.
     */
    protected string $serviceType;

    /**
     * This is the date the package will be picked up or officially enter the mail system.
     * Defaults to the current date('Y-m-d').
     */
    protected string $shipDate;

    /**
     * Constructor
     */
    public function __construct(StampsSoapClient $stampsClientService)
    {
        $this->stampsClientService = $stampsClientService;

        $this->packageType = PackageType::PACKAGE;
        $this->serviceType = ServiceType::FC;
        $this->imageType = ImageType::PNG;
        $this->shipDate = date('Y-m-d');
    }

    /**
     * @return CreateIndiciumResponse
     * @throws Exception
     */
    public function create(): CreateIndiciumResponse
    {
        $rateOptions = [
            'From' => [
                'FullName' => $this->from->getFullName(),
                'Address1' => $this->from->getAddress1(),
                'Address2' => $this->from->getAddress2(),
                'City' => $this->from->getCity(),
                'State' => $this->from->getState(),
                'ZIPCode' => $this->from->getZipcode()
            ],
            'To' => [
                'FullName' => $this->to->getFullName(),
                'Address1' => $this->to->getAddress1(),
                'Address2' => $this->to->getAddress2(),
                'City' => $this->to->getCity(),
                'State' => $this->to->getState(),
                'ZIPCode' => $this->to->getZipcode()
            ],
            'ServiceType' => $this->serviceType,
            'WeightOz' => $this->weightOz,
            'PackageType' => $this->packageType,
            'ShipDate' => $this->shipDate,
            'AddOns' => []
        ];

        if (!$this->showPrice) {
            $rateOptions['AddOns'][] = ['AddOnType' => 'SC-A-HP']; // Hide price on label
        }

        $indiciumResponse = $this->stampsClientService->createIndicium([
            'IntegratorTxID' => time(),
            'SampleOnly' => $this->isSampleOnly,
            'ImageType' => $this->imageType,
            'Rate' => $rateOptions,
        ]);

        return (new CreateIndiciumResponse())->fillFromSoap($indiciumResponse);
    }

    /**
     * @param Address $from
     * @return $this
     */
    public function setFrom(Address $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Address
     */
    public function getFrom(): Address
    {
        return $this->from;
    }

    /**
     * @param Address $to
     * @return $this
     */
    public function setTo(Address $to): self
    {
        $this->to = $to;
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
     * @param bool $flag
     * @return $this
     */
    public function setIsSampleOnly(bool $flag): self
    {
        $this->isSampleOnly = $flag;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSampleOnly(): bool
    {
        return $this->isSampleOnly;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setImageType(string $type): self
    {
        $this->imageType = $type;
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
     * @param string $type
     * @return $this
     */
    public function setPackageType(string $type): self
    {
        $this->packageType = $type;
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
     * @param string $type
     * @return $this
     */
    public function setServiceType(string $type): self
    {
        $this->serviceType = $type;
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
     * @param float $weight
     * @return $this
     */
    public function setWeightOz(float $weight): self
    {
        $this->weightOz = $weight;
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
     * @param string $date
     * @return $this
     */
    public function setShipDate(string $date): self
    {
        $this->shipDate = date('Y-m-d', strtotime($date));
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
     * @param bool $flag
     * @return $this
     */
    public function setShowPrice(bool $flag): self
    {
        $this->showPrice = $flag;
        return $this;
    }

    /**
     * @return bool
     */
    public function getShowPrice(): bool
    {
        return $this->showPrice;
    }
}
