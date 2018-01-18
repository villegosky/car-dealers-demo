<?php

namespace Nx\Domain\Model\Dealer;

/**
 * Class Name
 * @package Nx\Domain\Model\Dealer
 */
class Name
{
    private $name;

    /**
     * Name constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $name = trim($name);

        if (empty($name)) {
            throw new \InvalidArgumentException('Dealer[name] can not be empty');
        }

        if (strlen($name) < 2) {
            throw new \InvalidArgumentException('Dealer[name] must have at least 2 chars');
        }

        if (strlen($name) > 64) {
            throw new \InvalidArgumentException('Dealer[name] can not have more than 64 chars');
        }

        $this->name = $name;
    }

    public function __toString()
    {
        return $this->name;
    }
}