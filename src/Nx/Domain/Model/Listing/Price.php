<?php

namespace Nx\Domain\Model\Listing;

/**
 * Class Amount
 * @package Nx\Domain\Model\Listing
 */
class Price
{
    /**
     * @var int
     */
    private $price;

    /**
     * Name constructor.
     * @param $price
     */
    public function __construct($price)
    {
        $price = trim($price);

        if (empty($price)) {
            throw new \InvalidArgumentException('Listing[price] can not be empty');
        }

        if (!is_numeric($price)) {
            throw new \InvalidArgumentException('Listing[price] must be numeric');
        }

        $this->price = (int) $price;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->price;
    }
}