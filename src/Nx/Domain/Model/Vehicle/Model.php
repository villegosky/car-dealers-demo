<?php

namespace Nx\Domain\Model\Vehicle;

/**
 * Class Model
 * @package Nx\Domain\Model\Vehicle
 */
class Model
{
    /**
     * @var string
     */
    private $value;

    /**
     * Name constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $model = trim($model);

        if (empty($model)) {
            throw new \InvalidArgumentException('Vehicle[model] can not be empty');
        }

        if (strlen($model) < 1) {
            throw new \InvalidArgumentException('Vehicle[model] must have at least 1 chars');
        }

        if (strlen($model) > 32) {
            throw new \InvalidArgumentException('Vehicle[model] can not have more than 32 chars');
        }

        $this->value = $model;
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