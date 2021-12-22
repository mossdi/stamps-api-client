<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use Panacea\Stamps\Dto\ShippingLabel;

/**
 * Client interface to generate shipping labels.
 */
interface ShippingLabelInterface
{
    /**
     * Generates shipping label and optionally saves to file.
     *
     * @param string|null $filename
     * @return ShippingLabel
     * @throws Exception
     */
    public function create(string $filename = null): ShippingLabel;

    /**
     * @param AddressInterface $from
     * @return self
     */
    public function setFrom(AddressInterface $from): self;

    /**
     * @return AddressInterface
     */
    public function getFrom(): AddressInterface;

    /**
     * @param AddressInterface $to
     * @return self
     */
    public function setTo(AddressInterface $to): self;

    /**
     * @return AddressInterface
     */
    public function getTo(): AddressInterface;

    /**
     * @param bool $flag
     * @return self
     */
    public function setIsSampleOnly(bool $flag): self;

    /**
     * @return bool
     */
    public function getIsSampleOnly(): bool;

    /**
     * @param string $type
     * @return self
     */
    public function setImageType(string $type): self;

    /**
     * @return string
     */
    public function getImageType(): string;

    /**
     * @param string $type
     * @return self
     */
    public function setPackageType(string $type): self;

    /**
     * @return string
     */
    public function getPackageType(): string;

    /**
     * @param string $type
     * @return self
     */
    public function setServiceType(string $type): self;

    /**
     * @return string
     */
    public function getServiceType(): string;

    /**
     * @param float $weight
     * @return self
     */
    public function setWeightOz(float $weight): self;

    /**
     * @return float
     */
    public function getWeightOz(): float;

    /**
     * @param string $date
     * @return self
     */
    public function setShipDate(string $date): self;

    /**
     * @return string
     */
    public function getShipDate(): string;

    /**
     * @param bool $flag
     * @return self
     */
    public function setShowPrice(bool $flag): self;

    /**
     * @return bool
     */
    public function getShowPrice(): bool;
}
