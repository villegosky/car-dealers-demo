<?php

namespace Nx\Domain\Model\Vehicle;

/**
 * Class Make
 * @package Nx\Domain\Model\Vehicle
 */
class Make
{
    /**
     * @var string
     */
    private $value;

    /**
     * Name constructor.
     * @param $make
     */
    public function __construct($make)
    {
        $make = trim($make);

        if (empty($make)) {
            throw new \InvalidArgumentException('Vehicle[make] can not be empty');
        }

        if (strlen($make) < 2) {
            throw new \InvalidArgumentException('Vehicle[make] must have at least 2 chars');
        }

        if (strlen($make) > 32) {
            throw new \InvalidArgumentException('Vehicle[make] can not have more than 32 chars');
        }

        $this->value = $make;
    }

    public function __toString()
    {
        return $this->value;
    }

    public function value()
    {
        return $this->value;
    }
}