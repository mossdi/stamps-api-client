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
     * @var string
     */
    private $address2;

    /**
     * @param string $fullName
     * @param string $address1
     * @param string $city
     * @param string $state
     * @param string $zipcode
     * @param string|null $country
     * @param string|null $address2
     */
    public function __construct(
        string $fullName,
        string $address1,
        string $city,
        string $state,
        string $zipcode,
        ?string $country = 'US',
        ?string $address2 = ''
    ) {
        $this
            ->setFullName($fullName)
            ->setAddress1($address1)
            ->setCity($city)
            ->setState($state)
            ->setZipcode($zipcode)
            ->setCountry($country ?: 'US')
            ->setAddress2($address2 ?: '');
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($address): self
    {
        return new static(
            $address->FullName,
            $address->Address1,
            $address->City,
            $address->State,
            $address->ZIPCode,
            $address->Country ?? null,
            $address->Address2 ?? null
        );
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($address): self
    {
        return new static(
            $address['FullName'],
            $address['Address1'],
            $address['City'],
            $address['State'],
            $address['ZIPCode'],
            $address['Country'] ?? null,
            $address['Address2'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toSoapArray(): array
    {
        return [
            'FullName' => $this->getFullName(),
            'Address1' => $this->getAddress1(),
            'City' => $this->getCity(),
            'State' => $this->getState(),
            'ZIPCode' => $this->getZipcode(),
            'Country' => $this->getCountry(),
            'Address2' => $this->getAddress2(),
        ];
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $fullName
     *
     * @return Address
     */
    private function setFullName(string $fullName): Address
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @param string $address1
     *
     * @return Address
     */
    private function setAddress1(string $address1): Address
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @param string $address2
     *
     * @return Address
     */
    private function setAddress2(string $address2): Address
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    private function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $state
     *
     * @return Address
     */
    private function setState(string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param string $zipcode
     *
     * @return Address
     */
    private function setZipcode(string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @param string $country
     *
     * @return Address
     */
    private function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }
}
