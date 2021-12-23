<?php

namespace Panacea\Stamps\Contracts;

interface Dto
{
    /**
     * @param $data
     * @return mixed
     */
    public function fillFromSoap($data);

    /**
     * @param $data
     * @return mixed
     */
    public function fillFromArray($data);
}