<?php

namespace Panacea\Stamps\Contracts;

interface Dto
{
    /**
     * @param $data
     * @return mixed
     */
    public function fillFromRaw($data);
}