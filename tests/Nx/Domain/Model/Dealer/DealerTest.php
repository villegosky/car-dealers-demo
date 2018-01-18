<?php

namespace NxTest\Domain\Model\Dealer;

use Nx\Domain\Model\Address\Address;
use Nx\Domain\Model\Dealer\Dealer;
use Nx\Domain\Model\Dealer\Name;

class DealerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Dealer
     */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new Dealer(
            new Name('name'),
            new Address(
                'number',
                'street',
                'locality',
                'region',
                'postalCode'
            )
        );
    }

    /** @test */
    public function should_return_a_new_instance_from_array()
    {
        $this->SUT = Dealer::fromArray([
            'name'    => 'Tesla Montreal',
            'address' => [
                'number'     => '4000',
                'street'     => 'boul Saint-Laurent',
                'locality'   => 'Montreal',
                'region'     => 'QC',
                'postalCode' => 'H2H 1Z1',
            ]
        ]);

        $this->assertInstanceOf(Dealer::class, $this->SUT);
    }
}