<?php

namespace NxTest\Infrastructure\Persistence\InMemory\Dealer;

use Nx\Domain\Model\Dealer\Dealer;
use Nx\Infrastructure\Persistence\InMemory\Dealer\DealerRepository;
use Nx\Infrastructure\Persistence\InMemory\Dealer\InMemoryDealerRepository;

class InMemoryDealerRepositoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var InMemoryDealerRepository
     */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new InMemoryDealerRepository();
    }

    /** @test */
    public function should_implement_dealer_repository_interface()
    {
        $this->assertInstanceOf(DealerRepository::class, $this->SUT);
    }

    /** @test */
    public function should_add_a_dealer_to_repository()
    {
        // TODO: Do it with reflection
        $this->assertCount(0, $this->SUT->getAll());

        $dealer = Dealer::fromArray([
            'name'    => 'Tesla Montreal',
            'address' => [
                'number'     => '4000',
                'street'     => 'boul Saint-Laurent',
                'locality'   => 'Montreal',
                'region'     => 'QC',
                'postalCode' => 'H2H 1Z1',
            ]
        ]);

        $this->SUT->store($dealer);

        $this->assertCount(1, $this->SUT->getAll());
    }
}