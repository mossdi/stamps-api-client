<?php

namespace Panacea\Stamps\Contracts;

/**
 * Interface for creating a mailing address.
 */
interface AddressInterface
{
    /**
     * @param string $fullName
     * @return self
     */
    public function setFullName(string $fullName): self;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @param string $address1
     * @return self
     */
    public function setAddress1(string $address1): self;

    /**
     * @return string
     */
    public function getAddress1(): string;

    /**
     * @param string $address2
     * @return self
     */
    public function setAddress2(string $address2): self;

    /**
     * @return string
     */
    public function getAddress2(): string;

    /**
     * @param string $city
     * @return self
     */
    public function setCity(string $city): self;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $state
     * @return self
     */
    public function setState(string $state): self;

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $zipcode
     * @return self
     */
    public function setZipcode(string $zipcode): self;

    /**
     * @return string
     */
    public function getZipcode(): string;

    /**
     * @param string $country
     * @return self
     */
    public function setCountry(string $country = 'US'): self;

    /**
     * @return string
     */
    public function getCountry(): string;
}
