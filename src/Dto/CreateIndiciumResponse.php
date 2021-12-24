<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Entities\LabelFileObject;
use Panacea\Stamps\Traits\InstanceBehavior;

class CreateIndiciumResponse implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var Rate
     */
    private $rate;

    /**
     * @var LabelFileObject
     */
    private $label;

    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $stampsTxID;

    /**
     * @var string
     */
    private $url;

    /**
     * @return Rate
     */
    public function getRate(): Rate
    {
        return $this->rate;
    }

    /**
     * @param Rate $rate
     * @return CreateIndiciumResponse
     */
    public function setRate(Rate $rate): CreateIndiciumResponse
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return LabelFileObject
     */
    public function getLabel(): LabelFileObject
    {
        return $this->label;
    }

    /**
     * @param LabelFileObject $label
     * @return CreateIndiciumResponse
     */
    public function setLabel(LabelFileObject $label): CreateIndiciumResponse
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @param string $trackingNumber
     * @return CreateIndiciumResponse
     */
    public function setTrackingNumber(string $trackingNumber): CreateIndiciumResponse
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStampsTxID(): string
    {
        return $this->stampsTxID;
    }

    /**
     * @param string $stampsTxID
     * @return CreateIndiciumResponse
     */
    public function setStampsTxID(string $stampsTxID): CreateIndiciumResponse
    {
        $this->stampsTxID = $stampsTxID;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return CreateIndiciumResponse
     */
    public function setUrl(string $url): CreateIndiciumResponse
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray(): array
    {
        return [
            'Rate' => $this->getRate()->toSoapArray(),
            'TrackingNumber' => $this->getTrackingNumber(),
            'StampsTxID' => $this->getStampsTxID(),
            'URL' => $this->getUrl(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function fillFromSoap($createIndiciumResponse): self
    {
        return $this
            ->setRate(Rate::instance($createIndiciumResponse->Rate))
            ->setLabel(new LabelFileObject($createIndiciumResponse->URL))
            ->setTrackingNumber($createIndiciumResponse->TrackingNumber)
            ->setStampsTxID($createIndiciumResponse->StampsTxID)
            ->setUrl($createIndiciumResponse->URL);
    }

    /**
     * @inheritDoc
     */
    public function fillFromArray($createIndiciumResponse): self
    {
        return $this
            ->setRate(Rate::instance($createIndiciumResponse['Rate']))
            ->setLabel(new LabelFileObject($createIndiciumResponse['URL']))
            ->setTrackingNumber($createIndiciumResponse['TrackingNumber'])
            ->setStampsTxID($createIndiciumResponse['StampsTxID'])
            ->setUrl($createIndiciumResponse['URL']);
    }
}
