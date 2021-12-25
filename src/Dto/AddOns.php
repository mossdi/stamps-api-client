<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class AddOns implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var AddOnV16
     */
    private $addOnV16;

    /**
     * @param AddOnV16 $addOnV16
     */
    public function __construct(AddOnV16 $addOnV16)
    {
        $this->setAddOnV16($addOnV16);
    }

    /**
     * @param $addOns
     * @return $this
     */
    protected static function instanceFromSoap($addOns): self
    {
        return new self(AddOnV16::instance($addOns->AddOnV16));
    }

    /**
     * @param $addOns
     * @return $this
     */
    protected static function instanceFromArray($addOns): self
    {
        return new self(AddOnV16::instance($addOns['AddOnV16']));
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray(): array
    {
        return [
            'AddOnV16' => $this->getAddOnV16()->toSoapArray(),
        ];
    }

    /**
     * @return AddOnV16
     */
    public function getAddOnV16(): AddOnV16
    {
        return $this->addOnV16;
    }

    /**
     * @param AddOnV16 $addOnV16
     * @return AddOns
     */
    private function setAddOnV16(AddOnV16 $addOnV16): AddOns
    {
        $this->addOnV16 = $addOnV16;
        return $this;
    }
}
