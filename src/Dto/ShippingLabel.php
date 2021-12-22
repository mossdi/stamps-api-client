<?php

namespace Panacea\Stamps\Dto;

class ShippingLabel
{
    private string $stampsTxID;
    private string $trackingNumber;
    private Label $label;
    private Rate $rate;

    /**
     * @param string $stampsTxID
     * @param string $trackingNumber
     * @param Label $label
     * @param Rate $rate
     */
    public function __construct(
        string $stampsTxID,
        string $trackingNumber,
        Label $label,
        Rate $rate
    ) {
        $this->stampsTxID = $stampsTxID;
        $this->trackingNumber = $trackingNumber;
        $this->label = $label;
        $this->rate = $rate;
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
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @return Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * @return Rate
     */
    public function getRate(): Rate
    {
        return $this->rate;
    }
}