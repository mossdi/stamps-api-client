<?php

namespace Panacea\Stamps\Dto;

use Panacea\Stamps\Contracts\BaseDto;
use Panacea\Stamps\Traits\InstanceBehavior;

class AddOnV16 implements BaseDto
{
    use InstanceBehavior;

    /**
     * @var string
     */
    private $addOnType;

    /**
     * @return string
     */
    public function getAddOnType(): string
    {
        return $this->addOnType;
    }

    /**
     * @param string $addOnType
     * @return AddOnV16
     */
    public function setAddOnType(string $addOnType): AddOnV16
    {
        $this->addOnType = $addOnType;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function toSoapArray(): array
    {
        return [
            'AddOnType' => $this->getAddOnType(),
        ];
    }

    /**
     * @inheritDoc
     */
    protected function fillFromSoap($addOnV16): self
    {
        return $this
            ->setAddOnType($addOnV16->AddOnType);
    }

    /**
     * @inheritDoc
     */
    protected function fillFromArray($addOnV16): self
    {
        return $this
            ->setAddOnType($addOnV16['AddOnType']);
    }
}
