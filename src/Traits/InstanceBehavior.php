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
            return (new static())->fillFromArray($data);
        }

        return (new static())->fillFromSoap($data);
    }

    /**
     * @param $data
     *
     * @return static
     */
    abstract protected function fillFromArray($data);

    /**
     * @param $data
     *
     * @return static
     */
    abstract protected function fillFromSoap($data);
}