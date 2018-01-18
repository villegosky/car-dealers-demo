<?php

namespace Nx\Domain\Model\Listing;

/**
 * Class Title
 * @package Nx\Domain\Model\Listing
 */
class Title
{
    /**
     * @var string
     */
    private $title;

    /**
     * Name constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $title = trim($title);

        if (empty($title)) {
            throw new \InvalidArgumentException('Listing[title] can not be empty');
        }

        if (strlen($title) < 8) {
            throw new \InvalidArgumentException('Listing[title] must have at least 8 chars');
        }

        if (strlen($title) > 128) {
            throw new \InvalidArgumentException('Listing[title] can not have more than 128 chars');
        }

        $this->title = $title;
    }

    public function __toString()
    {
        return $this->title;
    }
}