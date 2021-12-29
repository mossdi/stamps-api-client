<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Exceptions\Exception;
use Panacea\Stamps\Traits\InstanceBehavior;

class TrackShipmentResponse implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var TrackingEvent[]
     */
    private $trackingEvents;

    /**
     * @param array $trackingEvents
     */
    public function __construct(array $trackingEvents)
    {
        $this->setTrackingEvents($trackingEvents);
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromArray($trackShipmentResponse)
    {
        return new static($trackShipmentResponse['TrackingEvents']);
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromSoap($trackShipmentResponse)
    {
        return new self(json_decode(json_encode($trackShipmentResponse->TrackingEvents), true));
    }

    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public function toSoapArray()
    {
        throw new Exception('Not implemented');
    }

    /**
     * @return TrackingEvent[]
     */
    public function getTrackingEvents(): array
    {
        return $this->trackingEvents;
    }

    /**
     * @param TrackingEvent[] $trackingEvents
     *
     * @return TrackShipmentResponse
     */
    private function setTrackingEvents(array $trackingEvents): TrackShipmentResponse
    {
        $this->trackingEvents = $trackingEvents;
        return $this;
    }
}
