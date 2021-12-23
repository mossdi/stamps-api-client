<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\Dto;

class Rate implements Dto
{
    private Address $from;
    private Address $to;
    private float $amount;
    private string $serviceType;
    private int $deliverDays;
    private int $weightOz;
    private string $packageType;
    private string $shippingDate;
    private string $deliveryDate;

    /**
     * @inheritDoc
     * @return $this
     */
    public function fillFromSoap($rate)
    {
        return $this
            ->setFrom((new Address())->fillFromSoap($rate->From))
            ->setTo((new Address())->fillFromSoap($rate->To))
            ->setAmount($rate->Amount)
            ->setServiceType($rate->ServiceType)
            ->setDeliverDays($rate->DeliverDays)
            ->setWeightOz($rate->WeightOz)
            ->setPackageType($rate->PackageType)
            ->setShippingDate($rate->ShipDate)
            ->setDeliveryDate($rate->DeliveryDate);
    }

    /**
     * @inheritDoc
     * @return $this
     */
    public function fillFromArray($rate): self
    {
        return $this
            ->setFrom((new Address())->fillFromSoap($rate['From']))
            ->setTo((new Address())->fillFromSoap($rate['To']))
            ->setAmount($rate['Amount'])
            ->setServiceType($rate['ServiceType'])
            ->setDeliverDays($rate['DeliverDays'])
            ->setWeightOz($rate['WeightOz'])
            ->setPackageType($rate['PackageType'])
            ->setShippingDate($rate['ShipDate'])
            ->setDeliveryDate($rate['DeliveryDate']);
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
    public function getTo(): Address
    {
        return $this->to;
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
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function setAmount(float $amount): self
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
     * @return $this
     */
    public function setServiceType(string $serviceType): self
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
     * @return $this
     */
    public function setDeliverDays(int $deliverDays): self
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
     * @return $this
     */
    public function setWeightOz(int $weightOz): self
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
     * @return $this
     */
    public function setPackageType(string $packageType): self
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
     * @return $this
     */
    public function setShippingDate(string $shippingDate): self
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
     * @return $this
     */
    public function setDeliveryDate(string $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }
}
