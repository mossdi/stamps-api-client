<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class AddOns implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var array
     */
    private $addOnsList;

    /**
     * @param array $addOns
     */
    public function __construct(array $addOns)
    {
        $this->setAddOnsList($addOns);
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($addOns): self
    {
        return new self(json_decode(json_encode($addOns), true));
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($addOns): self
    {
        return new self($addOns);
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray(): array
    {
        return $this->getAddOnsList();
    }

    /**
     * @return array
     */
    public function getAddOnsList(): array
    {
        return $this->addOnsList;
    }

    /**
     * @param array $addOnsList
     *
     * @return AddOns
     */
    private function setAddOnsList(array $addOnsList): AddOns
    {
        $this->addOnsList = $addOnsList;
        return $this;
    }
}
