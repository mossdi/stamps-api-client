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
     * @param Rate $rate
     * @param LabelFileObject $label
     * @param string $trackingNumber
     * @param string $stampsTxID
     * @param string $url
     */
    public function __construct(
        Rate $rate,
        LabelFileObject $label,
        string $trackingNumber,
        string $stampsTxID,
        string $url
    ) {
        $this
            ->setRate($rate)
            ->setLabel($label)
            ->setTrackingNumber($trackingNumber)
            ->setStampsTxID($stampsTxID)
            ->setUrl($url);
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($createIndiciumResponse): self
    {
        return new self(
            Rate::instance($createIndiciumResponse->Rate),
            new LabelFileObject($createIndiciumResponse->URL),
            $createIndiciumResponse->TrackingNumber,
            $createIndiciumResponse->StampsTxID,
            $createIndiciumResponse->URL
        );
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($createIndiciumResponse): self
    {
        return new self(
            Rate::instance($createIndiciumResponse['Rate']),
            new LabelFileObject($createIndiciumResponse['URL']),
            $createIndiciumResponse['TrackingNumber'],
            $createIndiciumResponse['StampsTxID'],
            $createIndiciumResponse['URL']
        );
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
     * @return Rate
     */
    public function getRate(): Rate
    {
        return $this->rate;
    }

    /**
     * @return LabelFileObject
     */
    public function getLabel(): LabelFileObject
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @return string
     */
    public function getStampsTxID(): string
    {
        return $this->stampsTxID;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param Rate $rate
     *
     * @return CreateIndiciumResponse
     */
    private function setRate(Rate $rate): CreateIndiciumResponse
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @param LabelFileObject $label
     *
     * @return CreateIndiciumResponse
     */
    private function setLabel(LabelFileObject $label): CreateIndiciumResponse
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param string $trackingNumber
     *
     * @return CreateIndiciumResponse
     */
    private function setTrackingNumber(string $trackingNumber): CreateIndiciumResponse
    {
        $this->trackingNumber = $trackingNumber;
        return $this;
    }

    /**
     * @param string $stampsTxID
     *
     * @return CreateIndiciumResponse
     */
    private function setStampsTxID(string $stampsTxID): CreateIndiciumResponse
    {
        $this->stampsTxID = $stampsTxID;
        return $this;
    }

    /**
     * @param string $url
     *
     * @return CreateIndiciumResponse
     */
    private function setUrl(string $url): CreateIndiciumResponse
    {
        $this->url = $url;
        return $this;
    }
}
