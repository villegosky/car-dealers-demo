<?php

namespace Nx\Domain\Model\Address;

/**
 * Class Address
 * @package Nx\Domain\Model\Address
 */
class Address
{
    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $locality;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * Address constructor.
     * @param $number
     * @param $street
     * @param $locality
     * @param $region
     * @param $postalCode
     */
    public function __construct($number, $street, $locality, $region, $postalCode)
    {
        $this->number     = $number;
        $this->street     = $street;
        $this->locality   = $locality;
        $this->region     = $region;
        $this->postalCode = $postalCode;
    }

    /**
     * @param array $data
     * @return Address
     */
    public static function fromArray(array $data)
    {
        if (empty($data['number'])) {
            throw new \InvalidArgumentException('Address[number] is required');
        }

        if (empty($data['street'])) {
            throw new \InvalidArgumentException('Address[street] is required');
        }

        if (empty($data['locality'])) {
            throw new \InvalidArgumentException('Address[locality] is required');
        }

        if (empty($data['region'])) {
            throw new \InvalidArgumentException('Address[region] is required');
        }

        if (empty($data['postalCode'])) {
            throw new \InvalidArgumentException('Address[postalCode] is required');
        }

        return new self(
            $data['number'],
            $data['street'],
            $data['locality'],
            $data['region'],
            $data['postalCode']
        );
    }

    /**
     * @return string
     */
    public function number()
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function street()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function locality()
    {
        return $this->locality;
    }

    /**
     * @return string
     */
    public function region()
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function postalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param Address $address
     * @return bool
     */
    public function isEqualTo(Address $address)
    {
        return $address == $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'number'     => $this->number(),
            'street'     => $this->street(),
            'locality'   => $this->locality(),
            'region'     => $this->region(),
            'postalCode' => $this->postalCode(),
            'inline'     => $this->inline()
        ];
    }

    public function inline()
    {
        return $this->number . ' ' .
            $this->street . ', ' .
            $this->locality . ', ' .
            $this->region  . ' ' .
            $this->postalCode;
    }
}