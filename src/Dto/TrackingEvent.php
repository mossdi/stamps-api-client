<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class TrackingEvent extends BaseDto
{
    private string $timestamp;

    private string $event;

    private string $trackingEventType;

    private string $city;

    private string $state;

    private string $zip;

    private string $country;

    private bool $authorizedAgent;

    public function __construct(
        string $timestamp,
        string $event,
        string $trackingEventType,
        string $city,
        string $state,
        string $zip,
        string $country,
        bool   $authorizedAgent
    )
    {
        $this
            ->setTimestamp($timestamp)
            ->setEvent($event)
            ->setTrackingEventType($trackingEventType)
            ->setCity($city)
            ->setState($state)
            ->setZip($zip)
            ->setCountry($country)
            ->setAuthorizedAgent($authorizedAgent);
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    public function getEvent(): string
    {
        return $this->event;
    }

    public function getTrackingEventType(): string
    {
        return $this->trackingEventType;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getAuthorizedAgent(): string
    {
        return $this->authorizedAgent;
    }

    public function toArray(): array
    {
        return [
            'Timestamp' => $this->getTimestamp(),
            'Event' => $this->getEvent(),
            'TrackingEventType' => $this->getTrackingEventType(),
            'City' => $this->getCity(),
            'State' => $this->getState(),
            'Zip' => $this->getZip(),
            'Country' => $this->getCountry(),
            'AuthorizedAgent' => $this->getAuthorizedAgent(),
        ];
    }

    protected static function instanceFromArray($trackingEvent): static
    {
        return new static(
            $trackingEvent['Timestamp'],
            $trackingEvent['Event'],
            $trackingEvent['TrackingEventType'],
            $trackingEvent['City'],
            $trackingEvent['State'],
            $trackingEvent['Zip'],
            $trackingEvent['Country'],
            $trackingEvent['AuthorizedAgent']
        );
    }

    protected static function instanceFromSoap($trackingEvent): static
    {
        return new static(
            $trackingEvent->Timestamp,
            $trackingEvent->Event,
            $trackingEvent->TrackingEventType,
            $trackingEvent->City,
            $trackingEvent->State,
            $trackingEvent->Zip,
            $trackingEvent->Country,
            $trackingEvent->AuthorizedAgent
        );
    }

    private function setTimestamp(string $timestamp): TrackingEvent
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    private function setEvent(string $event): TrackingEvent
    {
        $this->event = $event;
        return $this;
    }

    private function setTrackingEventType(string $trackingEventType): TrackingEvent
    {
        $this->trackingEventType = $trackingEventType;
        return $this;
    }

    private function setCity(string $city): TrackingEvent
    {
        $this->city = $city;
        return $this;
    }

    private function setState(string $state): TrackingEvent
    {
        $this->state = $state;
        return $this;
    }

    private function setZip(string $zip): TrackingEvent
    {
        $this->zip = $zip;
        return $this;
    }

    private function setCountry(string $country): TrackingEvent
    {
        $this->country = $country;
        return $this;
    }

    private function setAuthorizedAgent(string $authorizedAgent): void
    {
        $this->authorizedAgent = $authorizedAgent;
    }
}
