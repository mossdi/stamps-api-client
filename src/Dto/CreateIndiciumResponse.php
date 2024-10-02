<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;
use Mossdi\Stamps\Entities\LabelFileObject;

class CreateIndiciumResponse extends BaseDto
{
    private Rate $rate;

    private LabelFileObject $label;

    private string $trackingNumber;

    private string $stampsTxID;

    private string $url;

    public function __construct(
        Rate            $rate,
        LabelFileObject $label,
        string          $trackingNumber,
        string          $stampsTxID,
        string          $url
    )
    {
        $this
            ->setRate($rate)
            ->setLabel($label)
            ->setTrackingNumber($trackingNumber)
            ->setStampsTxID($stampsTxID)
            ->setUrl($url);
    }

    public function getRate(): Rate
    {
        return $this->rate;
    }

    public function getLabel(): LabelFileObject
    {
        return $this->label;
    }

    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    public function getStampsTxID(): string
    {
        return $this->stampsTxID;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function toArray(): array
    {
        return [
            'Rate' => $this->getRate()->toArray(),
            'TrackingNumber' => $this->getTrackingNumber(),
            'StampsTxID' => $this->getStampsTxID(),
            'URL' => $this->getUrl(),
        ];
    }

    protected static function instanceFromSoap($createIndiciumResponse): static
    {
        return new static(
            Rate::instance($createIndiciumResponse->Rate),
            new LabelFileObject($createIndiciumResponse->URL),
            $createIndiciumResponse->TrackingNumber,
            $createIndiciumResponse->StampsTxID,
            $createIndiciumResponse->URL
        );
    }

    protected static function instanceFromArray($createIndiciumResponse): static
    {
        return new static(
            Rate::instance($createIndiciumResponse['Rate']),
            new LabelFileObject($createIndiciumResponse['URL']),
            $createIndiciumResponse['TrackingNumber'],
            $createIndiciumResponse['StampsTxID'],
            $createIndiciumResponse['URL']
        );
    }

    private function setRate(Rate $rate): CreateIndiciumResponse
    {
        $this->rate = $rate;
        return $this;
    }

    private function setLabel(LabelFileObject $label): CreateIndiciumResponse
    {
        $this->label = $label;
        return $this;
    }

    private function setTrackingNumber(string $trackingNumber): CreateIndiciumResponse
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    private function setStampsTxID(string $stampsTxID): CreateIndiciumResponse
    {
        $this->stampsTxID = $stampsTxID;
        return $this;
    }

    private function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
