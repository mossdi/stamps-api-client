<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class TrackingEvents implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var TrackingEvent[]
     */
    private $trackingEvents;

    public function __construct(TrackingEvent ...$trackingEvents)
    {
        $this->setTrackingEvents(...$trackingEvents);
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromArray($trackingEvents): self
    {
        $events = [];

        foreach ($trackingEvents as $trackingEvent) {
            $events[] = TrackingEvent::instance($trackingEvent);
        }

        return new static(...$events);
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromSoap($trackingEvents): self
    {
        return static::instanceFromArray($trackingEvents);
    }

    /**
     * @inheritDoc
     */
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

    /**
     * @return TrackingEvent[]
     */
    public function getTrackingEvents(): array
    {
        return $this->trackingEvents;
    }

    /**
     * @param TrackingEvent[] $trackingEvents
     * @return TrackingEvents
     */
    private function setTrackingEvents(TrackingEvent ...$trackingEvents): self
    {
        $this->trackingEvents = $trackingEvents;
        return $this;
    }
}
