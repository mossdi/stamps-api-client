<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class Rate implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var Address
     */
    private $from;

    /**
     * @var Address
     */
    private $to;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $serviceType;

    /**
     * @var int
     */
    private $deliverDays;

    /**
     * @var int
     */
    private $weightOz;

    /**
     * @var string
     */
    private $packageType;

    /**
     * @var string
     */
    private $shippingDate;

    /**
     * @var string
     */
    private $deliveryDate;

    /**
     * @var AddOns
     */
    private $addOns;

    /**
     * @param Address $from
     * @param Address $to
     * @param float $amount
     * @param string $serviceType
     * @param int $deliverDays
     * @param int $weightOz
     * @param string $packageType
     * @param string $shipDate
     * @param string $deliveryDate
     * @param AddOns $addOns
     */
    public function __construct(
        Address $from,
        Address $to,
        float $amount,
        string $serviceType,
        int $deliverDays,
        int $weightOz,
        string $packageType,
        string $shipDate,
        string $deliveryDate,
        AddOns $addOns
    ) {
        $this
            ->setFrom($from)
            ->setTo($to)
            ->setAmount($amount)
            ->setServiceType($serviceType)
            ->setDeliverDays($deliverDays)
            ->setWeightOz($weightOz)
            ->setPackageType($packageType)
            ->setShippingDate($shipDate)
            ->setDeliveryDate($deliveryDate)
            ->setAddOns($addOns);
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($rate): self
    {
        return new self(
            Address::instance($rate->From),
            Address::instance($rate->To),
            $rate->Amount,
            $rate->ServiceType,
            $rate->DeliverDays,
            $rate->WeightOz,
            $rate->PackageType,
            $rate->ShipDate,
            $rate->DeliveryDate,
            AddOns::instance($rate->AddOns)
        );
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($rate): self
    {
        return new self(
            Address::instance($rate['From']),
            Address::instance($rate['To']),
            $rate['Amount'],
            $rate['ServiceType'],
            $rate['DeliverDays'],
            $rate['WeightOz'],
            $rate['PackageType'],
            $rate['ShipDate'],
            $rate['DeliveryDate'],
            AddOns::instance($rate['AddOns'])
        );
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray(): array
    {
        return [
            'From' => $this->getFrom()->toSoapArray(),
            'To' => $this->getTo()->toSoapArray(),
            'ServiceType' => $this->getServiceType(),
            'DeliverDays' => $this->getDeliverDays(),
            'WeightOz' => $this->getWeightOz(),
            'PackageType' => $this->getPackageType(),
            'ShipDate' => $this->getShippingDate(),
            'DeliveryDate' => $this->getDeliveryDate(),
            'AddOns' => $this->getAddOns()->toSoapArray(),
        ];
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
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    /**
     * @return int
     */
    public function getDeliverDays(): int
    {
        return $this->deliverDays;
    }

    /**
     * @return int
     */
    public function getWeightOz(): int
    {
        return $this->weightOz;
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
    public function getShippingDate(): string
    {
        return $this->shippingDate;
    }

    /**
     * @return string
     */
    public function getDeliveryDate(): string
    {
        return $this->deliveryDate;
    }

    /**
     * @return AddOns
     */
    public function getAddOns(): AddOns
    {
        return $this->addOns;
    }

    /**
     * @param Address $from
     * @return Rate
     */
    private function setFrom(Address $from): Rate
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param Address $to
     * @return Rate
     */
    private function setTo(Address $to): Rate
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param float $amount
     * @return Rate
     */
    private function setAmount(float $amount): Rate
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $serviceType
     * @return Rate
     */
    private function setServiceType(string $serviceType): Rate
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @param int $deliverDays
     * @return Rate
     */
    private function setDeliverDays(int $deliverDays): Rate
    {
        $this->deliverDays = $deliverDays;
        return $this;
    }

    /**
     * @param int $weightOz
     * @return Rate
     */
    private function setWeightOz(int $weightOz): Rate
    {
        $this->weightOz = $weightOz;
        return $this;
    }

    /**
     * @param string $packageType
     * @return Rate
     */
    private function setPackageType(string $packageType): Rate
    {
        $this->packageType = $packageType;
        return $this;
    }

    /**
     * @param string $shippingDate
     * @return Rate
     */
    private function setShippingDate(string $shippingDate): Rate
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @param string $deliveryDate
     * @return Rate
     */
    private function setDeliveryDate(string $deliveryDate): Rate
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @param AddOns $addOns
     * @return Rate
     */
    private function setAddOns(AddOns $addOns): Rate
    {
        $this->addOns = $addOns;
        return $this;
    }
}
