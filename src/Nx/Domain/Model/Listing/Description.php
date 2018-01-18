<?php

namespace Nx\Domain\Model\Listing;

/**
 * Class Description
 * @package Nx\Domain\Model\Listing
 */
class Description
{
    /**
     * @var string
     */
    private $description;

    /**
     * Name constructor.
     * @param $description
     */
    public function __construct($description)
    {
        $description = trim($description);

        if (empty($description)) {
            throw new \InvalidArgumentException('Listing[description] can not be empty');
        }

        if (strlen($description) < 8) {
            throw new \InvalidArgumentException('Listing[description] must have at least 8 chars');
        }

        $this->description = (string) $description;
    }

    public function __toString()
    {
        return $this->description;
    }
}