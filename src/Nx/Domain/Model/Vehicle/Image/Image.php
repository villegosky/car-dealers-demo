<?php

namespace Nx\Domain\Model\Vehicle\Image;

use Nx\Domain\Model\Vehicle\Vehicle;
use Ramsey\Uuid\Uuid;

/**
 * Class Image
 * @package Nx\Domain\Model\Vehicle\Image
 *
 * @Entity
 * @Table(name="images")
 */
class Image
{
    /**
     * @var int
     *
     * @Id
     * @Column(type="string")
     */
    protected $imageId;

    /**
     * @var \Nx\Domain\Model\Vehicle\Vehicle
     *
     * @ManyToOne(targetEntity="\Nx\Domain\Model\Vehicle\Vehicle")
     * @JoinColumn(name="vehicleId", referencedColumnName="id")
     */
    protected $imageOf;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $url;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    protected $label;

    /**
     * @var \DateTimeImmutable
     *
     * @Column(type="datetime")
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    protected $modifiedOn;

    /**
     * @param array $data
     * @return Image
     */
    public static function fromArray(array $data)
    {
        if (empty($data['fileName'])) {
            throw new \InvalidArgumentException('Image[fileName] is required');
        }

        $newImage = new self($data['fileName']);

        if (isset($data['label'])) {
            $newImage->setLabel($data['label']);
        }

        return $newImage;
    }

    /**
     * Image constructor.
     * @param $url
     * @param $label
     */
    public function __construct($url, $label = null)
    {
        $this->imageId = Uuid::uuid4()->toString();
        $this->url = $url;
        $this->label = $label;
        $this->createdOn = new \DateTimeImmutable();
    }

    /**
     * @return string
     */
    public function imageId()
    {
        return $this->imageId;
    }

    /**
     * @return Vehicle
     */
    public function imageOf()
    {
        return $this->imageOf;
    }

    /**
     * @return string
     */
    public function url()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function createdOn()
    {
        return $this->createdOn;
    }

    /**
     * @return \DateTime
     */
    public function modifiedOn()
    {
        return $this->modifiedOn;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->imageId(),
            'url' => $this->url(),
            'label' => $this->label(),
            'createdOn' => $this->createdOn(),
            'modifiedOn' => $this->modifiedOn()
        ];
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        if (isset($data['label']) && ($data['label'] != $this->label())) {
            $this->setLabel($data['label']);
            // TODO: Log update
        }
    }

    /**
     * @param Vehicle $vehicle
     */
    public function setImageOf(Vehicle $vehicle)
    {
        $this->imageOf = $vehicle;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = (string) $label;
    }
}