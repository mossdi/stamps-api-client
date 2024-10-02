<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class Rate extends BaseDto
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

    private AddOns $addOns;

    public function __construct(
        Address $from,
        Address $to,
        int     $weightOz,
        string  $shipDate,
        string  $serviceType,
        string  $packageType,
        ?string $deliveryDate,
        ?int    $deliverDays,
        ?float  $amount,
        ?AddOns $addOns
    )
    {
        $this
            ->setFrom($from)
            ->setTo($to)
            ->setWeightOz($weightOz)
            ->setShippingDate($shipDate)
            ->setServiceType($serviceType)
            ->setPackageType($packageType)
            ->setDeliveryDate($deliveryDate)
            ->setDeliverDays($deliverDays)
            ->setAmount($amount)
            ->setAddOns($addOns);
    }

    public function getFrom(): Address
    {
        return $this->from;
    }

    public function getTo(): Address
    {
        return $this->to;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getServiceType(): string
    {
        return $this->serviceType;
    }

    public function getDeliverDays(): ?int
    {
        return $this->deliverDays;
    }

    public function getWeightOz(): int
    {
        return $this->weightOz;
    }

    public function getPackageType(): string
    {
        return $this->packageType;
    }

    public function getShippingDate(): string
    {
        return $this->shippingDate;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    public function getAddOns(): AddOns
    {
        return $this->addOns;
    }

    public function toArray(): array
    {
        return [
            'From' => $this->getFrom()->toArray(),
            'To' => $this->getTo()->toArray(),
            'WeightOz' => $this->getWeightOz(),
            'ShipDate' => $this->getShippingDate(),
            'ServiceType' => $this->getServiceType(),
            'PackageType' => $this->getPackageType(),
            'DeliveryDate' => $this->getDeliveryDate(),
            'DeliverDays' => $this->getDeliverDays(),
            'Amount' => $this->getAmount(),
            'AddOns' => $this->getAddOns()->toArray(),
        ];
    }

    protected static function instanceFromSoap($rate): static
    {
        return new static(
            Address::instance($rate->From),
            Address::instance($rate->To),
            $rate->WeightOz,
            $rate->ShipDate,
            $rate->ServiceType,
            $rate->PackageType,
            $rate->DeliveryDate ?? null,
            $rate->DeliverDays ?? null,
            $rate->Amount ?? null,
            !empty($rate->AddOns) ? AddOns::instance($rate->AddOns) : null
        );
    }

    protected static function instanceFromArray($rate): static
    {
        return new static(
            Address::instance($rate['From']),
            Address::instance($rate['To']),
            $rate['WeightOz'],
            $rate['ShipDate'],
            $rate['ServiceType'],
            $rate['PackageType'],
            $rate['DeliveryDate'] ?? null,
            $rate['DeliverDays'] ?? null,
            $rate['Amount'] ?? null,
            !empty($rate['AddOns']) ? AddOns::instance($rate['AddOns']) : null
        );
    }

    private function setFrom(Address $from): Rate
    {
        $this->from = $from;
        return $this;
    }

    private function setTo(Address $to): Rate
    {
        $this->to = $to;
        return $this;
    }

    private function setAmount(?float $amount): Rate
    {
        $this->amount = $amount;
        return $this;
    }

    private function setServiceType(string $serviceType): Rate
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    private function setDeliverDays(?int $deliverDays): Rate
    {
        $this->deliverDays = $deliverDays;
        return $this;
    }

    private function setWeightOz(int $weightOz): Rate
    {
        $this->weightOz = $weightOz;
        return $this;
    }

    private function setPackageType(string $packageType): Rate
    {
        $this->packageType = $packageType;
        return $this;
    }

    private function setShippingDate(string $shippingDate): Rate
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    private function setDeliveryDate(?string $deliveryDate): Rate
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    private function setAddOns(?AddOns $addOns): void
    {
        $this->addOns = $addOns;
    }
}
