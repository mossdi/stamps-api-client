<?php

namespace Panacea\Stamps\Entities;

use Panacea\Stamps\Contracts\AddressInterface;

/**
 * Class to represent a mailing address for a shipping label.
 */
class Address implements AddressInterface
{
    protected string $fullName;

    protected string $address1;

    protected string $address2;

    protected string $city;

    protected string $state;

    protected string $zipcode;

    protected string $country = 'US';

    /**
     * {@inheritdoc}
     */
    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry(string $country = 'US'): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
