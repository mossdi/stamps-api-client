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
    public function setAddOnV16(AddOnV16 $addOnV16): AddOns
    {
        $this->addOnV16 = $addOnV16;
        return $this;
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
     * @param $addOns
     * @return $this
     */
    protected function fillFromSoap($addOns): self
    {
        return $this
            ->setAddOnV16(AddOnV16::instance($addOns->AddOnV16));
    }

    /**
     * @param $addOns
     * @return $this
     */
    protected function fillFromArray($addOns): self
    {
        return $this
            ->setAddOnV16(AddOnV16::instance($addOns['AddOnV16']));
    }
}
