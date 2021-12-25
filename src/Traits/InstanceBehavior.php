<?php

namespace Panacea\Stamps\Traits;

trait InstanceBehavior
{
    /**
     * @param $data
     *
     * @return static
     */
    public final static function instance($data)
    {
        if (is_array($data)) {
            return static::instanceFromArray($data);
        }

        return static::instanceFromSoap($data);
    }

    /**
     * @param $data
     *
     * @return static
     */
    abstract static protected function instanceFromArray($data);

    /**
     * @param $data
     *
     * @return static
     */
    abstract static protected function instanceFromSoap($data);
}