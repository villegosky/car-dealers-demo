<?php

namespace Nx\Domain\Model\Vehicle;

use Doctrine\Common\Collections\ArrayCollection;
use Nx\Domain\Model\Dealer\VehicleId;
use Ramsey\Uuid\Uuid;

/**
 * Class Vehicle
 * @package Nx\Domain\Model\Vehicle
 *
 * @Entity
 * @Table(name="vehicles")
 */
class Vehicle
{
    /**
     * @var VehicleId
     *
     * @Id
     * @Column(name="id", type="string")
     */
    private $vehicleId;

    /**
     * @var Make
     *
     * @Column(type="string")
     */
    private $make;

    /**
     * @var Model
     *
     * @Column(type="string")
     */
    private $model;

    /**
     * @var Year
     *
     * @Column(type="string")
     */
    private $year;

    /**
     * @var Image[]
     *
     * @OneToMany(targetEntity="\Nx\Domain\Model\Vehicle\Image\Image",
     *     mappedBy="imageOf",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true)
     */
    private $images;

    /**
     * Vehicle constructor.
     * @param Make $make
     * @param Model $model
     * @param Year $year
     */
    public function __construct(Make $make, Model $model, Year $year)
    {
        $this->vehicleId = Uuid::uuid4();
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->make() . ' ' . $this->model() . ' ' . $this->year();
    }

    /**
     * @return VehicleId
     */
    public function vehicleId()
    {
        return $this->vehicleId;
    }

    /**
     * @return Make
     */
    public function make()
    {
        return $this->make;
    }

    /**
     * @return Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return Year
     */
    public function year()
    {
        return $this->year;
    }


    public function toArray()
    {
        $array = [
            'id' => $this->vehicleId(),
            'make' => $this->make(),
            'model' => $this->model(),
            'year' => $this->year(),
            'images' => []
        ];

        foreach ($this->images() as $image) {
            $array['images'][] = $image->toArray();
        }

        return $array;
    }

    /**
     * @return ArrayCollection|Image[]
     */
    public function images()
    {
        if (null === $this->images) {
            $this->images = new ArrayCollection();
        }

        return $this->images;
    }

}