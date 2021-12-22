<?php

namespace Panacea\Stamps\Dto;

class ShippingLabel
{
    private string $trackingNumber;
    private string $labelUrl;

    /**
     * @param string $trackingNumber
     * @param string $labelUrl
     */
    public function __construct(
        string $trackingNumber,
        string $labelUrl
    ) {
        $this->trackingNumber = $trackingNumber;
        $this->labelUrl = $labelUrl;
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
    public function getLabelUrl(): string
    {
        return $this->labelUrl;
    }
}