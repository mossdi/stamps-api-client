<?php

namespace Panacea\Stamps\Contracts;

use Exception;
use Panacea\Stamps\Enums\ImageType;
use Panacea\Stamps\Enums\PackageType;
use Panacea\Stamps\Enums\ServiceType;

/**
 * Client interface to generate shipping labels.
 */
interface ShippingLabelInterface
{
    /**
     * Generates shipping label and optionally saves to file.
     *
     * @param string|null $filename
     * @return string The URL to the generated label.
     * @throws Exception
     */
    public function create(string $filename = null): string;

    /**
     * @param AddressInterface $from
     * @return $this
     */
    public function setFrom(AddressInterface $from): static;

    /**
     * @return AddressInterface
     */
    public function getFrom(): AddressInterface;

    /**
     * @param AddressInterface $to
     * @return $this
     */
    public function setTo(AddressInterface $to): static;

    /**
     * @return AddressInterface
     */
    public function getTo(): AddressInterface;

    /**
     * @param bool $flag
     * @return $this
     */
    public function setIsSampleOnly(bool $flag): static;

    /**
     * @return bool
     */
    public function getIsSampleOnly(): bool;

    /**
     * @param ImageType $type
     * @return $this
     */
    public function setImageType(ImageType $type): static;

    /**
     * @return ImageType
     */
    public function getImageType(): ImageType;

    /**
     * @param PackageType $type
     * @return $this
     */
    public function setPackageType(PackageType $type): static;

    /**
     * @return PackageType
     */
    public function getPackageType(): PackageType;

    /**
     * @param ServiceType $type
     * @return $this
     */
    public function setServiceType(ServiceType $type): static;

    /**
     * @return ServiceType
     */
    public function getServiceType(): ServiceType;

    /**
     * @param float $weight
     * @return $this
     */
    public function setWeightOz(float $weight): static;

    /**
     * @return float
     */
    public function getWeightOz(): float;

    /**
     * @param string $date
     * @return $this
     */
    public function setShipDate(string $date): static;

    /**
     * @return string
     */
    public function getShipDate(): string;

    /**
     * @param bool $flag
     * @return $this
     */
    public function setShowPrice(bool $flag): static;

    /**
     * @return bool
     */
    public function getShowPrice(): bool;
}
