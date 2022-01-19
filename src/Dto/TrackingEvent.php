<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class TrackingEvent implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var string
     */
    private $timestamp;

    /**
     * @var string
     */
    private $event;

    /**
     * @var string
     */
    private $trackingEventType;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $country;

    /**
     * @var bool
     */
    private $authorizedAgent;

    /**
     * @param string $timestamp
     * @param string $event
     * @param string $trackingEventType
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $country
     * @param bool $authorizedAgent
     */
    public function __construct(
        string $timestamp,
        string $event,
        string $trackingEventType,
        string $city,
        string $state,
        string $zip,
        string $country,
        bool $authorizedAgent
    ) {
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

    /**
     * @inheritDoc
     */
    static protected function instanceFromArray($trackingEvent): self
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

    /**
     * @inheritDoc
     */
    static protected function instanceFromSoap($trackingEvent): self
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

    /**
     * @inheritDoc
     */
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

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getEvent(): string
    {
        return $this->event;
    }

    /**
     * @return string
     */
    public function getTrackingEventType(): string
    {
        return $this->trackingEventType;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getAuthorizedAgent(): string
    {
        return $this->authorizedAgent;
    }

    /**
     * @param string $timestamp
     *
     * @return TrackingEvent
     */
    private function setTimestamp(string $timestamp): TrackingEvent
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    /**
     * @param string $event
     *
     * @return TrackingEvent
     */
    private function setEvent(string $event): TrackingEvent
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @param string $trackingEventType
     *
     * @return TrackingEvent
     */
    private function setTrackingEventType(string $trackingEventType): TrackingEvent
    {
        $this->trackingEventType = $trackingEventType;
        return $this;
    }

    /**
     * @param string $city
     *
     * @return TrackingEvent
     */
    private function setCity(string $city): TrackingEvent
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $state
     *
     * @return TrackingEvent
     */
    private function setState(string $state): TrackingEvent
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param string $zip
     *
     * @return TrackingEvent
     */
    private function setZip(string $zip): TrackingEvent
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @param string $country
     *
     * @return TrackingEvent
     */
    private function setCountry(string $country): TrackingEvent
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @param string $authorizedAgent
     *
     * @return TrackingEvent
     */
    private function setAuthorizedAgent(string $authorizedAgent): TrackingEvent
    {
        $this->authorizedAgent = $authorizedAgent;
        return $this;
    }
}
