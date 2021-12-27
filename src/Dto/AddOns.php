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
     * @param $addOns
     * @return $this
     */
    protected static function instanceFromSoap($addOns): self
    {
        $addOnsList = [];

        foreach ($addOns as $key => $value) {
            $addOnsList[$key] = $value;
        }

        return new self($addOnsList);
    }

    /**
     * @param $addOns
     * @return $this
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
     * @return AddOns
     */
    private function setAddOnsList(array $addOnsList): AddOns
    {
        $this->addOnsList = $addOnsList;
        return $this;
    }
}
