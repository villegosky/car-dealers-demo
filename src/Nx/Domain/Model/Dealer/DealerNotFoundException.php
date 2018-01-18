<?php

namespace Nx\Domain\Model\Dealer;

/**
 * Class DealerNotFoundException
 * @package Nx\Domain\Model\Dealer
 */
class DealerNotFoundException extends \Exception
{
    const MESSAGE = 'Dealer of ID(%s) not found';

    /**
     * @param $dealerId
     * @return DealerNotFoundException
     */
    public static function forId($dealerId)
    {
        return new self(sprintf(self::MESSAGE, $dealerId));
    }
}