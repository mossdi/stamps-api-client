<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class TrackShipmentResponse extends BaseDto
{
    private TrackingEvents $trackingEvents;

    public function __construct(TrackingEvents $trackingEvents)
    {
        $this->setTrackingEvents($trackingEvents);
    }

    public function getTrackingEvents(): TrackingEvents
    {
        return $this->trackingEvents;
    }

    public function toArray(): array
    {
        return [
            'TrackingEvents' => $this->getTrackingEvents()->toArray(),
        ];
    }

    protected static function instanceFromArray($trackShipmentResponse): static
    {
        return new static(TrackingEvents::instance($trackShipmentResponse['TrackingEvents']));
    }

    protected static function instanceFromSoap($trackShipmentResponse): static
    {
        return new static(TrackingEvents::instance($trackShipmentResponse->TrackingEvents));
    }

    private function setTrackingEvents(TrackingEvents $trackingEvents): void
    {
        $this->trackingEvents = $trackingEvents;
    }
}
