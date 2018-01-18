<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Nx\Infrastructure\Persistence\Doctrine\EntityManagerFactory;

require __DIR__ . '/vendor/autoload.php';

$settings = require __DIR__ . '/settings.php';

return ConsoleRunner::createHelperSet(EntityManagerFactory::build($settings['doctrine']));