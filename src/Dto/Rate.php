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
     * @param int $weightOz
     * @param string $shipDate
     * @param string $serviceType
     * @param string $packageType
     * @param string|null $deliveryDate
     * @param int|null $deliverDays
     * @param float|null $amount
     * @param AddOns|null $addOns
     */
    public function __construct(
        Address $from,
        Address $to,
        int $weightOz,
        string $shipDate,
        string $serviceType,
        string $packageType,
        ?string $deliveryDate,
        ?int $deliverDays,
        ?float $amount,
        ?AddOns $addOns
    ) {
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

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($rate): self
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

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($rate): self
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

    /**
     * @inheritDoc
     */
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
    public function getAmount(): ?float
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
     * @return int|null
     */
    public function getDeliverDays(): ?int
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
     * @return string|null
     */
    public function getDeliveryDate(): ?string
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
     *
     * @return Rate
     */
    private function setFrom(Address $from): Rate
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param Address $to
     *
     * @return Rate
     */
    private function setTo(Address $to): Rate
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param float|null $amount
     *
     * @return Rate
     */
    private function setAmount(?float $amount): Rate
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $serviceType
     *
     * @return Rate
     */
    private function setServiceType(string $serviceType): Rate
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @param int|null $deliverDays
     *
     * @return Rate
     */
    private function setDeliverDays(?int $deliverDays): Rate
    {
        $this->deliverDays = $deliverDays;
        return $this;
    }

    /**
     * @param int $weightOz
     *
     * @return Rate
     */
    private function setWeightOz(int $weightOz): Rate
    {
        $this->weightOz = $weightOz;
        return $this;
    }

    /**
     * @param string $packageType
     *
     * @return Rate
     */
    private function setPackageType(string $packageType): Rate
    {
        $this->packageType = $packageType;
        return $this;
    }

    /**
     * @param string $shippingDate
     *
     * @return Rate
     */
    private function setShippingDate(string $shippingDate): Rate
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @param string|null $deliveryDate
     *
     * @return Rate
     */
    private function setDeliveryDate(?string $deliveryDate): Rate
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    /**
     * @param AddOns|null $addOns
     *
     * @return Rate
     */
    private function setAddOns(?AddOns $addOns): Rate
    {
        $this->addOns = $addOns;
        return $this;
    }
}
