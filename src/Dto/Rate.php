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
     * @return Address
     */
    public function getFrom(): Address
    {
        return $this->from;
    }

    /**
     * @param Address $from
     * @return Rate
     */
    public function setFrom(Address $from): Rate
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
     * @return Rate
     */
    public function setTo(Address $to): Rate
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Rate
     */
    public function setAmount(float $amount): Rate
    {
        $this->amount = $amount;
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
     * @return Rate
     */
    public function setServiceType(string $serviceType): Rate
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliverDays(): int
    {
        return $this->deliverDays;
    }

    /**
     * @param int $deliverDays
     * @return Rate
     */
    public function setDeliverDays(int $deliverDays): Rate
    {
        $this->deliverDays = $deliverDays;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeightOz(): int
    {
        return $this->weightOz;
    }

    /**
     * @param int $weightOz
     * @return Rate
     */
    public function setWeightOz(int $weightOz): Rate
    {
        $this->weightOz = $weightOz;
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
     * @return Rate
     */
    public function setPackageType(string $packageType): Rate
    {
        $this->packageType = $packageType;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingDate(): string
    {
        return $this->shippingDate;
    }

    /**
     * @param string $shippingDate
     * @return Rate
     */
    public function setShippingDate(string $shippingDate): Rate
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryDate(): string
    {
        return $this->deliveryDate;
    }

    /**
     * @param string $deliveryDate
     * @return Rate
     */
    public function setDeliveryDate(string $deliveryDate): Rate
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @return AddOns
     */
    public function getAddOns(): AddOns
    {
        return $this->addOns;
    }

    /**
     * @param AddOns $addOns
     * @return Rate
     */
    public function setAddOns(AddOns $addOns): Rate
    {
        $this->addOns = $addOns;
        return $this;
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
     * @inheritDoc
     */
    protected function fillFromSoap($rate): self
    {
        return $this
            ->setFrom(Address::instance($rate->From))
            ->setTo(Address::instance($rate->To))
            ->setAmount($rate->Amount)
            ->setServiceType($rate->ServiceType)
            ->setDeliverDays($rate->DeliverDays)
            ->setWeightOz($rate->WeightOz)
            ->setPackageType($rate->PackageType)
            ->setShippingDate($rate->ShipDate)
            ->setDeliveryDate($rate->DeliveryDate)
            ->setAddOns(AddOns::instance($rate->AddOns));
    }

    /**
     * @inheritDoc
     */
    protected function fillFromArray($rate): self
    {
        return $this
            ->setFrom(Address::instance($rate['From']))
            ->setTo(Address::instance($rate['To']))
            ->setAmount($rate['Amount'])
            ->setServiceType($rate['ServiceType'])
            ->setDeliverDays($rate['DeliverDays'])
            ->setWeightOz($rate['WeightOz'])
            ->setPackageType($rate['PackageType'])
            ->setShippingDate($rate['ShipDate'])
            ->setDeliveryDate($rate['DeliveryDate'])
            ->setAddOns(AddOns::instance($rate['AddOns']));
    }
}
