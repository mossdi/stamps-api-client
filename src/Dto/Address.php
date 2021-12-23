<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\Dto;

class Address implements Dto
{
    private string $fullName;
    private string $address1;
    private string $address2;
    private string $city;
    private string $state;
    private string $zipcode;
    private string $country = 'US';

    /**
     * @param $address
     * @return $this
     */
    public function fillFromRaw($address): self
    {
        return $this
            ->setFullName($address->FullName)
            ->setAddress1($address->Address1)
            ->setAddress2($address->Address2 ?? '')
            ->setCity($address->City)
            ->setState($address->State)
            ->setZipcode($address->ZIPCode);
    }

    /**
     * @param string $fullName
     * @return $this
     */
    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $address1
     * @return $this
     */
    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string|null $address2
     * @return $this
     */
    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $city
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $state
     * @return $this
     */
    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $zipcode
     * @return $this
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $country
     * @return $this
     */
    public function setCountry(string $country = 'US'): self
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
