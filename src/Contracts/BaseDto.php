<?php

namespace Panacea\Stamps\Contracts;

interface BaseDto
{
    /**
     * @param $data
     *
     * @return static
     */
    public static function instance($data);

    /**
     * @return array
     */
    public function toSoapArray();
}