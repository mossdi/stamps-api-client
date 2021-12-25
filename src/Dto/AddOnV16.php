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
     * @param string $addOnType
     */
    public function __construct(string $addOnType)
    {
        $this->setAddOnType($addOnType);
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromSoap($addOnV16): self
    {
        return new static($addOnV16->AddOnType);
    }

    /**
     * @inheritDoc
     */
    protected static function instanceFromArray($addOnV16): self
    {
        return new static($addOnV16['AddOnType']);
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
    private function setAddOnType(string $addOnType): AddOnV16
    {
        $this->addOnType = $addOnType;
        return $this;
    }
}
