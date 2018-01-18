<?php

namespace Nx\Domain\Model\Listing;

use Nx\Domain\Model\Dealer\Dealer;
use Nx\Domain\Model\Dealer\ListingId;
use Nx\Domain\Model\Vehicle\Vehicle;

/**
 * Class Listing
 * @package Nx\Domain\Model\Listing
 *
 * @Entity
 * @Table("listings")
 */
class Listing
{
    /**
     * @var ListingId
     *
     * @Id
     * @Column(name="id", type="string")
     */
    private $listingId;

    /**
     * @var Dealer
     *
     * @ManyToOne(targetEntity="\Nx\Domain\Model\Dealer\Dealer")
     * @JoinColumn(name="dealerId", referencedColumnName="id")
     */
    private $listingOf;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $title;

    /**
     * @var Vehicle
     *
     * @OneToOne(targetEntity="\Nx\Domain\Model\Vehicle\Vehicle", cascade={"persist","remove"})
     * @JoinColumn(name="vehicleId", referencedColumnName="id")
     */
    private $vehicle;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $description;

    /**
     * @var string
     *
     * @Column(type="integer")
     */
    private $price;

    /**
     * @var int
     *
     * @Column(type="integer")
     */
    private $status;

    /**
     * @var \DateTimeImmutable
     *
     * @Column(type="datetime")
     */
    private $createdOn;

    /**
     * @var \DateTime
     *
     * @Column(type="datetime")
     */
    private $updatedOn;

    /**
     * Listing constructor.
     * @param Title $title
     * @param Vehicle $vehicle
     * @param Description $description
     * @param Price $price
     */
    public function __construct(Title $title, Vehicle $vehicle, Description $description, Price $price)
    {
        $this->listingId = Uuid::uuid4();
        $this->title = $title;
        $this->vehicle = $vehicle;
        $this->description = $description;
        $this->price = $price;
        $this->status = ListingStatus::ACTIVE;
        $this->createdOn = new \DateTimeImmutable();
    }

    /**
     * @param array $data
     * @return Listing
     */
    public static function fromArray(array $data)
    {
        if (empty($data['title'])) {
            throw new \InvalidArgumentException('Listing[title] is required');
        }

        if (empty($data['description'])) {
            throw new \InvalidArgumentException('Listing[description] is required');
        }

        if (empty($data['vehicle'])) {
            throw new \InvalidArgumentException('Listing[vehicle] is required');
        }

        if (empty($data['price'])) {
            throw new \InvalidArgumentException('Listing[price] is required');
        }

        return new self($data['title'], $data['vehicle'], $data['description'], $data['price']);
    }

    /**
     * @return ListingId
     */
    public function listingId()
    {
        return $this->listingId;
    }

    /**
     * @return Dealer
     */
    public function listingOf()
    {
        return $this->listingOf;
    }

    /**
     * @return Title
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return Vehicle
     */
    public function vehicle()
    {
        return $this->vehicle;
    }

    /**
     * @return Description
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @return Price
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function status()
    {
        return $this->status;
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
    public function updatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => (string) $this->listingId(),
            'title' => (string) $this->title(),
            'description' => (string) $this->description(),
            'price' => $this->price(),
            'vehicle' => $this->vehicle()->toArray(),
            'status' => $this->status(),
            'createdOn' => ($createdOn = $this->createdOn()) ? $createdOn->format('Y-m-d h:i:s') : '',
            'updatedOn' => ($updatedOn = $this->updatedOn()) ? $updatedOn->format('Y-m-d h:i:s') : '',
        ];
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        if (isset($data['title']) && ($data['title'] != $this->title())) {
            $this->changeTitle($data['title']);
        }

        if (isset($data['description']) && ($data['description'] != $this->description())) {
            $this->changeDescription($data['description']);
        }

        if (isset($data['status']) && ($data['status'] != $this->status())) {
            $this->changeStatus($data['status']);
        }
    }



    /**
     * @param Title $title
     */
    public function changeTitle(Title $title)
    {
        $this->title = $title;
    }

    /**
     * @param Description $description
     */
    public function changeDescription(Description $description)
    {
        $this->description = $description;
    }

    /**
     * @param int $status
     */
    public function changeStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param Dealer $dealer
     */
    public function setListingOf(Dealer $dealer)
    {
        $this->listingOf = $dealer;
    }

}