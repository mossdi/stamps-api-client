<?php

namespace Mossdi\Stamps\Dto;

use Mossdi\Stamps\Contracts\BaseDto;

class AddOns extends BaseDto
{
    private array $addOnsList;

    public function __construct(array $addOns)
    {
        $this->setAddOnsList($addOns);
    }

    public function getAddOnsList(): array
    {
        return $this->addOnsList;
    }

    public function toArray(): array
    {
        return $this->getAddOnsList();
    }

    protected static function instanceFromSoap($addOns): static
    {
        return new static(json_decode(json_encode($addOns), true));
    }

    protected static function instanceFromArray($addOns): static
    {
        return new static($addOns);
    }

    private function setAddOnsList(array $addOnsList): void
    {
        $this->addOnsList = $addOnsList;
    }
}
