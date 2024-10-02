<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class Address extends BaseDto
{
    private string $fullName;

    private string $address1;

    private string $city;

    private string $state;

    private string $zipcode;

    private string $country = 'US';

    private string $address2;

    public function __construct(
        string  $fullName,
        string  $address1,
        string  $city,
        string  $state,
        string  $zipcode,
        ?string $country = 'US',
        ?string $address2 = ''
    )
    {
        $this
            ->setFullName($fullName)
            ->setAddress1($address1)
            ->setCity($city)
            ->setState($state)
            ->setZipcode($zipcode)
            ->setCountry($country ?: 'US')
            ->setAddress2($address2 ?: '');
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getAddress1(): string
    {
        return $this->address1;
    }

    public function getAddress2(): string
    {
        return $this->address2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function toArray(): array
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

    protected static function instanceFromSoap($address): static
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

    protected static function instanceFromArray($address): static
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

    private function setFullName(string $fullName): Address
    {
        $this->fullName = $fullName;
        return $this;
    }

    private function setAddress1(string $address1): Address
    {
        $this->address1 = $address1;
        return $this;
    }

    private function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    private function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    private function setState(string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    private function setZipcode(string $zipcode): Address
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    private function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }
}
