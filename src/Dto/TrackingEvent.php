<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Traits\InstanceBehavior;

class TrackingEvent implements \Panacea\Stamps\Contracts\BaseDto
{
    use InstanceBehavior;

    /**
     * @inheritDoc
     */
    static protected function instanceFromArray($trackingEvent)
    {
        // TODO: Implement instanceFromArray() method.
    }

    /**
     * @inheritDoc
     */
    static protected function instanceFromSoap($trackingEvent)
    {
        // TODO: Implement instanceFromSoap() method.
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray()
    {
        // TODO: Implement toSoapArray() method.
    }
}
