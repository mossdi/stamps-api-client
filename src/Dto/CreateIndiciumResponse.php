<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\Dto;
use Panacea\Stamps\Entities\Label;

class CreateIndiciumResponse implements Dto
{
    private Rate $rate;
    private Label $label;
    private string $trackingNumber;
    private string $stampsTxID;
    private string $url;

    /**
     * @inheritDoc
     * @return $this
     */
    public function fillFromSoap($createIndiciumResponse): self
    {
        return $this
            ->setRate((new Rate())->fillFromSoap($createIndiciumResponse->Rate))
            ->setLabel(new Label($createIndiciumResponse->URL))
            ->setTrackingNumber($createIndiciumResponse->TrackingNumber)
            ->setStampsTxID($createIndiciumResponse->StampsTxID)
            ->setUrl($createIndiciumResponse->URL);
    }

    /**
     * @inheritDoc
     * @return $this
     */
    public function fillFromArray($createIndiciumResponse): self
    {
        return $this
            ->setRate((new Rate())->fillFromSoap($createIndiciumResponse['Rate']))
            ->setLabel(new Label($createIndiciumResponse['URL']))
            ->setTrackingNumber($createIndiciumResponse['TrackingNumber'])
            ->setStampsTxID($createIndiciumResponse['StampsTxID'])
            ->setUrl($createIndiciumResponse['URL']);
    }

    /**
     * @return Rate
     */
    public function getRate(): Rate
    {
        return $this->rate;
    }

    /**
     * @param Rate $rate
     * @return $this
     */
    public function setRate(Rate $rate): self
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * @param Label $label
     * @return $this
     */
    public function setLabel(Label $label): self
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
     * @return $this
     */
    public function setTrackingNumber(string $trackingNumber): self
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
     * @return $this
     */
    public function setStampsTxID(string $stampsTxID): self
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
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }
}