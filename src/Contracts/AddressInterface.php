<?php

namespace Panacea\Stamps\Contracts;

/**
 * Interface for creating a mailing address.
 */
interface AddressInterface
{
    /**
     * @param string $fullName
     * @return $this
     */
    public function setFullName(string $fullName): static;

    /**
     * @return string
     */
    public function getFullName(): string;

    /**
     * @param string $address1
     * @return $this
     */
    public function setAddress1(string $address1): static;

    /**
     * @return string
     */
    public function getAddress1(): string;

    /**
     * @param string $address2
     * @return $this
     */
    public function setAddress2(string $address2): static;

    /**
     * @return string
     */
    public function getAddress2(): string;

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): static;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state): static;

    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode): static;

    /**
     * @return string
     */
    public function getZipcode(): string;

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country = 'US'): static;

    /**
     * @return string
     */
    public function getCountry(): string;
}
