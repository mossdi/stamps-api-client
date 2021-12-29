<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Exceptions\Exception;
use Panacea\Stamps\Traits\InstanceBehavior;

class TrackShipmentResponse implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var TrackingEvents
     */
    private $trackingEvents;

    /**
     * @param TrackingEvents $trackingEvents
     */
    public function __construct(TrackingEvents $trackingEvents)
    {
        $this->setTrackingEvents($trackingEvents);
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromArray($trackShipmentResponse)
    {
        return new static(TrackingEvents::instance($trackShipmentResponse['TrackingEvents']));
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromSoap($trackShipmentResponse)
    {
        return new static(TrackingEvents::instance($trackShipmentResponse->TrackingEvents));
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'TrackingEvents' => $this->getTrackingEvents()->toArray(),
        ];
    }

    /**
     * @return TrackingEvents
     */
    public function getTrackingEvents(): TrackingEvents
    {
        return $this->trackingEvents;
    }

    /**
     * @param TrackingEvents $trackingEvents
     *
     * @return TrackShipmentResponse
     */
    private function setTrackingEvents(TrackingEvents $trackingEvents): TrackShipmentResponse
    {
        $this->trackingEvents = $trackingEvents;
        return $this;
    }
}
