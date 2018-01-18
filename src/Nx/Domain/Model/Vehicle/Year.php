<?php

namespace Nx\Domain\Model\Vehicle;

/**
 * Class Year
 * @package Nx\Domain\Model\Vehicle
 */
class Year
{
    /**
     * @var string
     */
    private $value;

    /**
     * Name constructor.
     * @param $year
     */
    public function __construct($year)
    {
        $year = trim($year);

        if (empty($year)) {
            throw new \InvalidArgumentException('Vehicle[year] can not be empty');
        }

        if (strlen($year) <> 4) {
            throw new \InvalidArgumentException('Vehicle[year] must have 4 digits');
        }

        $this->value = $year;
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