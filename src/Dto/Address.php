<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class Address implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zipcode;

    /**
     * @var string
     */
    private $country = 'US';

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     * @return Address
     */
    public function setFullName(string $fullName): Address
    {
        $this->fullName = $fullName;
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
     * @param string $address1
     * @return Address
     */
    public function setAddress1(string $address1): Address
    {
        $this->address1 = $address1;
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
     * @param string $address2
     * @return Address
     */
    public function setAddress2(string $address2): Address
    {
        $this->address2 = $address2;
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
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
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
     * @param string $state
     * @return Address
     */
    public function setState(string $state): Address
    {
        $this->state = $state;
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
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode(string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return array
     */
    public function toSoapArray(): array
    {
        return [
            'FullName' => $this->getFullName(),
            'Address1' => $this->getAddress1(),
            'Address2' => $this->getAddress2(),
            'City' => $this->getCity(),
            'State' => $this->getState(),
            'ZIPCode' => $this->getZipcode()
        ];
    }

    /**
     * @inheritDoc
     */
    protected function fillFromSoap($address): self
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
     * @inheritDoc
     */
    protected function fillFromArray($address): self
    {
        return $this
            ->setFullName($address['FullName'])
            ->setAddress1($address['Address1'])
            ->setAddress2($address['Address2'] ?? '')
            ->setCity($address['City'])
            ->setState($address['State'])
            ->setZipcode($address['ZIPCode']);
    }
}
