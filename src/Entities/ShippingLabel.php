<?php

namespace Panacea\Stamps\Entities;

use Exception as ApiException;
use Panacea\Stamps\Dto\Label;
use Panacea\Stamps\Dto\Rate;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;
use Panacea\Stamps\Contracts\AddressInterface;
use Panacea\Stamps\Contracts\ShippingLabelInterface;
use Panacea\Stamps\Services\StampsClientService;

/**
 * Client to generate shipping labels.
 */
class ShippingLabel implements ShippingLabelInterface
{
    /**
     * Service with client
     */
    private StampsClientService $stampsClientService;

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
     * The sender's address.
     */
    protected AddressInterface $from;

    /**
     * The recipient's address.
     */
    protected AddressInterface $to;

    /**
     * This is the date the package will be picked up or officially enter the mail system.
     * Defaults to the current date('Y-m-d').
     */
    protected string $shipDate;

    /**
     * Constructor
     */
    public function __construct(StampsClientService $stampsClientService)
    {
        $this->stampsClientService = $stampsClientService;

        $this->imageType = ImageType::PNG;
        $this->packageType = PackageType::THICK_ENVELOPE;
        $this->serviceType = ServiceType::FC;
        $this->shipDate = date('Y-m-d');
    }

    /**
     * {@inheritdoc}
     */
    public function setFrom(AddressInterface $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFrom(): AddressInterface
    {
        return $this->from;
    }

    /**
     * {@inheritdoc}
     */
    public function setTo(AddressInterface $to): self
    {
        $this->to = $to;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTo(): AddressInterface
    {
        return $this->to;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsSampleOnly(bool $flag): self
    {
        $this->isSampleOnly = $flag;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsSampleOnly(): bool
    {
        return $this->isSampleOnly;
    }

    /**
     * {@inheritdoc}
     */
    public function setImageType(string $type): self
    {
        $this->imageType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageType(): string
    {
        return $this->imageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setPackageType(string $type): self
    {
        $this->packageType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageType(): string
    {
        return $this->packageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setServiceType(string $type): self
    {
        $this->serviceType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeightOz(float $weight): self
    {
        $this->weightOz = $weight;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeightOz(): float
    {
        return $this->weightOz;
    }

    /**
     * {@inheritdoc}
     */
    public function setShipDate(string $date): self
    {
        $this->shipDate = date('Y-m-d', strtotime($date));
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShipDate(): string
    {
        return $this->shipDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setShowPrice(bool $flag): self
    {
        $this->showPrice = $flag;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShowPrice(): bool
    {
        return $this->showPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $filename = null): \Panacea\Stamps\Dto\ShippingLabel
    {
        // 1. Check account balance

        $accountInfoResponse = $this->stampsClientService->getAccountInfo();
        $availableBalance = (double)$accountInfoResponse->AccountInfo->PostageBalance->AvailablePostage;

        if (!$this->isSampleOnly && $availableBalance < 3) {
            throw new ApiException('Insufficient funds: ' . $availableBalance);
        }

        // 2. Cleanse recipient address

        $cleanseToAddressResponse = $this->stampsClientService->cleanseAddress([
            'FullName' => $this->to->getFullName(),
            'Address1' => $this->to->getAddress1(),
            'Address2' => $this->to->getAddress2(),
            'City' => $this->to->getCity(),
            'State' => $this->to->getState(),
            'ZIPcode' => $this->to->getZipcode()
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new ApiException('Invalid to address.');
        }

        // 3. Generate label

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
            'WeightOz' => $this->weightOz,
            'ShipDate' => $this->shipDate,
            'ServiceType' => $this->serviceType,
            'PackageType' => $this->packageType,
            'AddOns' => []
        ];

        if (!$this->showPrice) {
            $rateOptions['AddOns'][] = [
                'AddOnType' => 'SC-A-HP' // Hide price on label
            ];
        }

        $indiciumResponse = $this->stampsClientService->createIndicium([
            'IntegratorTxID' => time(),
            'SampleOnly' => $this->isSampleOnly,
            'ImageType' => $this->imageType,
            'Rate' => $rateOptions,
        ]);

        $rate = new Rate(
            $indiciumResponse->Rate->Amount
        );

        $label = new Label(
            $indiciumResponse->URL,
            mb_strtolower($this->getImageType())
        );

        if ($filename) {
            $ch = curl_init($indiciumResponse->URL);
            $fp = fopen($filename, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            // TODO: Refactor / Do it without file saving
            $label->setContent(file_get_contents($filename));
        }

        return new \Panacea\Stamps\Dto\ShippingLabel(
            $indiciumResponse->StampsTxID,
            $indiciumResponse->TrackingNumber,
            $label,
            $rate
        );
    }
}
