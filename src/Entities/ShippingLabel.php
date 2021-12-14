<?php

namespace Panacea\Stamps\Entities;

use Exception as ApiException;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;
use Panacea\Stamps\Contracts\AbstractClient;
use Panacea\Stamps\Contracts\AddressInterface;
use Panacea\Stamps\Contracts\ShippingLabelInterface;

/**
 * Client to generate shipping labels.
 */
class ShippingLabel extends AbstractClient implements ShippingLabelInterface
{
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
    protected ImageType $imageType;

    /**
     * The package type.
     */
    protected PackageType $packageType;

    /**
     * The mail service type.
     */
    protected ServiceType $serviceType;

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
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();
        $this->imageType = ImageType::PNG;
        $this->packageType = PackageType::THICK_ENVELOPE;
        $this->serviceType = ServiceType::FC;
        $this->shipDate = date('Y-m-d');
    }

    /**
     * {@inheritdoc}
     */
    public function setFrom(AddressInterface $from): static
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
    public function setTo(AddressInterface $to): static
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
    public function setIsSampleOnly(bool $flag): static
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
    public function setImageType(ImageType $type): static
    {
        $this->imageType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageType(): ImageType
    {
        return $this->imageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setPackageType(PackageType $type): static
    {
        $this->packageType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageType(): PackageType
    {
        return $this->packageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setServiceType(ServiceType $type): static
    {
        $this->serviceType = $type;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceType(): ServiceType
    {
        return $this->serviceType;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeightOz(float $weight): static
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
    public function setShipDate(string $date): static
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
    public function setShowPrice(bool $flag): static
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
    public function create(string $filename = null): string
    {
        // 1. Check account balance

        $accountInfoResponse = $this->soapClient->GetAccountInfo([
            'Authenticator' => $this->getAuthToken()
        ]);

        $availableBalance = (double)$accountInfoResponse->AccountInfo->PostageBalance->AvailablePostage;

        if ($availableBalance < 3) {
            throw new ApiException('Insufficient funds: ' . $availableBalance);
        }

        // 2. Cleanse recipient address

        $cleanseToAddressResponse = $this->soapClient->CleanseAddress([
            'Authenticator' => $this->getAuthToken(),
            'Address' => [
                'FullName' => $this->to->getFullName(),
                'Address1' => $this->to->getAddress1(),
                'Address2' => $this->to->getAddress2(),
                'City' => $this->to->getCity(),
                'State' => $this->to->getState(),
                'ZIPcode' => $this->to->getZipcode()
            ]
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new ApiException('Invalid to address.');
        }

        // 3. Get rates

        $rateOptions = [
            'FromZIPCode' => $this->from->getZipcode(),
            'ToZIPCode' => $this->to->getZipcode(),
            'WeightOz' => $this->weightOz,
            'WeightLb' => '0.0',
            'ShipDate' => $this->shipDate,

            'ServiceType' => $this->serviceType->value,
            'PackageType' => $this->packageType->value,
            'InsuredValue' => '0.0',
            'AddOns' => []
        ];

        if (!$this->showPrice) {
            $rateOptions['AddOns'][] = [
                'AddOnType' => 'SC-A-HP' // Hide price on label
            ];
        }

        $rates = $this->soapClient->GetRates([
            'Authenticator' => $this->getAuthToken(),
            'Rate' => $rateOptions
        ]);

        $rateOptions['Rate']['Amount'] = $rates->Rates->Rate->Amount;

        // 4. Generate label

        $labelOptions = [
            'Authenticator' => $this->getAuthToken(),
            'IntegratorTxID' => time(),
            'SampleOnly' => $this->isSampleOnly,
            'ImageType' => $this->imageType->value,

            'Rate' => $rateOptions,

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
            ]
        ];

        $indiciumResponse = $this->soapClient->CreateIndicium($labelOptions);

        if ($filename) {
            $ch = curl_init($indiciumResponse->URL);
            $fp = fopen($filename, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }

        return $indiciumResponse->URL;
    }
}
