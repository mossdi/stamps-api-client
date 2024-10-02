<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class TrackingEvents extends BaseDto
{
    /**
     * @var TrackingEvent[]
     */
    private array $trackingEvents;

    public function __construct(TrackingEvent ...$trackingEvents)
    {
        $this->setTrackingEvents(...$trackingEvents);
    }

    /**
     * @return TrackingEvent[]
     */
    public function getTrackingEvents(): array
    {
        return $this->trackingEvents;
    }

    public function toArray(): array
    {
        $trackingEvents = [];

        foreach ($this->getTrackingEvents() as $trackingEvent) {
            $trackingEvents[] = $trackingEvent->toArray();
        }

        return [
            'TrackingEvents' => $trackingEvents,
        ];
    }

    protected static function instanceFromArray($trackingEvents): static
    {
        $events = [];

        foreach ($trackingEvents as $trackingEvent) {
            $events[] = TrackingEvent::instance($trackingEvent);
        }

        return new static(...$events);
    }

    protected static function instanceFromSoap($trackingEvents): static
    {
        return static::instanceFromArray($trackingEvents);
    }

    private function setTrackingEvents(TrackingEvent ...$trackingEvents): void
    {
        $this->trackingEvents = $trackingEvents;
    }
}
