<?php

namespace Nx\Domain\Model\Dealer;

use Doctrine\Common\Collections\ArrayCollection;
use Nx\Domain\Model\Address\Address;
use Nx\Domain\Model\Listing\Listing;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Dealer
 * @package Nx\Domain\Model\Dealer
 *
 * @Entity
 * @Table(name="dealers")
 */
class Dealer
{
    /**
     * @var UuidInterface
     *
     * @Id
     * @Column(name="id", type="string")
     */
    private $dealerId;

    /**
     * @var Name
     *
     * @Column(type="string")
     */
    private $name;

    /**
     * @var Address
     *
     * @Column(type="object")
     */
    private $address;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $phone;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $website;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $facebook;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $twitter;

    /**
     * @var string
     *
     * @Column(type="string")
     */
    private $logo;

    /**
     * @var Listing[]
     *
     * @OneToMany(targetEntity="\Nx\Domain\Model\Listing\Listing",
     *     mappedBy="listingOf",
     *     cascade={"persist","remove"},
     *     orphanRemoval=true)
     */
    private $listings;

    /**
     * Dealer constructor.
     * @param Name $name
     * @param Address $address
     */
    public function __construct(Name $name, Address $address)
    {
        $this->dealerId = Uuid::uuid4();
        $this->name     = $name;
        $this->address  = $address;
        $this->phone    = '';
        $this->website  = '';
        $this->facebook = '';
        $this->twitter  = '';
        $this->logo     = '';
    }

    /**
     * @param array $data
     * @return Dealer
     */
    public static function fromArray(array $data)
    {
        if (empty($data['name'])) {
            throw new \InvalidArgumentException('Dealer[name] is required');
        }

        if (empty($data['address'])) {
            throw new \InvalidArgumentException('Dealer[address] is required');
        }

        $newDealer = new self(new Name($data['name']), Address::fromArray($data['address']));

        if (isset($data['phone'])) {
            $newDealer->setPhone($data['phone']);
        }

        if (isset($data['website'])) {
            $newDealer->setWebsite($data['website']);
        }

        if (isset($data['facebook'])) {
            $newDealer->setFacebook($data['facebook']);
        }

        if (isset($data['twitter'])) {
            $newDealer->setTwitter($data['twitter']);
        }

        if (isset($data['logo'])) {
            $newDealer->setLogo($data['logo']);
        }

        return $newDealer;
    }

    /**
     * @return UuidInterface
     */
    public function dealerId()
    {
        return $this->dealerId;
    }

    /**
     * @return Name
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function address(): Address
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function phone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function website(): string
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function facebook(): string
    {
        return $this->facebook;
    }

    /**
     * @return string
     */
    public function twitter(): string
    {
        return $this->twitter;
    }

    /**
     * @return string
     */
    public function logo(): string
    {
        return $this->logo;
    }

    /**
     * @return Listing[]
     */
    public function listings()
    {
        if (null === $this->listings) {
            $this->listings = new ArrayCollection();
        }

        return $this->listings;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = [
            'id'       => (string) $this->dealerId(),
            'name'     => (string) $this->name(),
            'address'  => $this->address->toArray(),
            'phone'    => $this->phone(),
            'website'  => $this->website(),
            'facebook' => $this->facebook(),
            'twitter'  => $this->twitter(),
            'logo'     => $this->logo(),
            'listings' => []
        ];

        foreach ($this->listings() as $listing) {
            $array['listings'][] = $listing->toArray();
        }

        return $array;
    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {
        if (isset($data['name'])) {
            $this->name = new Name($data['name']);
        }

        if (isset($data['address'])) {
            $newAddress = Address::fromArray($data['address']);
            if (!$this->address->isEqualTo($newAddress)) {
                $this->address = $newAddress;
            }
        }
    }

    /**
     * @param $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @param $facebook
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @param $twitter
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @param $logo
     */
    private function setLogo($logo)
    {
        $this->logo = $logo;
    }
}