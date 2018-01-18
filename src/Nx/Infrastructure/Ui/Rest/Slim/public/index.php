<?php

use Nx\Application\Service\Dealer\DealerService;
use Nx\Domain\Model\Dealer\DealerNotFoundException;
use Nx\Infrastructure\Persistence\Doctrine\Dealer\DoctrineDealerRepository;
use Nx\Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../../../../../../../vendor/autoload.php';

// Settings
$settings = require '../../../../../../../settings.php';

// Application
$app = new Slim\App(['settings' => $settings]);

// Dependencies (Dependency Injection Container)
$container = $app->getContainer();

$container['entityManager'] = function ($c) {
    return EntityManagerFactory::build($c->get('settings')['doctrine']);
};

// Home
$app->get('/', function (Request $request, Response $response) {

    return $response->withJson([
        'name'    => 'CarDealer Api',
        'version' => 'v1'
    ]);
});

// Get Dealer(s)
$app->get('/dealers', function (Request $request, Response $response) {

    $dealerService = new DealerService(
        new DoctrineDealerRepository($this->entityManager)
    );

    try {
        $data = $dealerService->listAllDealers();
    } catch (Exception $e) {
        $response = $response->withStatus(501);
        return $response->withJson(['error' => $e->getMessage() /*'Application Error'*/]);
    }

    return $response->withJson($data);
});

// Get Dealer
$app->get('/dealers/{dealerId}', function (Request $request, Response $response) {

    $dealerId = $request->getAttribute('dealerId');

    $dealerService = new DealerService(
        new DoctrineDealerRepository($this->entityManager)
    );

    try {
        $data = $dealerService->loadDealer($dealerId);
    } catch (DealerNotFoundException $e) {
        $response = $response->withStatus(404);
        return $response->withJson(['error' => $e->getMessage()]);
    } catch (Exception $e) {
        $response->withStatus(501);
        return $response->withJson(['error' => $e->getMessage()]);
    }

    return $response->withJson($data);
});

// Add Dealer
$app->post('/dealers', function (Request $request, Response $response) {

    $dealerService = new DealerService(
        new DoctrineDealerRepository($this->entityManager)
    );

    try {
        $data = $dealerService->addDealer((array)$request->getParsedBody());
    } catch (InvalidArgumentException $e) {
        $response = $response->withStatus(501);
        return $response->withJson(['error' => $e->getMessage()]);
    } catch (Exception $e) {
        $response = $response->withStatus(501);
        return $response->withJson(['error' => $e->getMessage()/*'Application Error'*/]);
    }

    return $response->withJson($data);
});

// Update Dealer
$app->put('/dealers/{dealerId}', function (Request $request, Response $response) {

    $dealerId = $request->getAttribute('dealerId');

    $dealerService = new DealerService(
        new DoctrineDealerRepository($this->entityManager)
    );

    try {
        $data = $dealerService->updateDealer($dealerId, (array)$request->getParsedBody());
    } catch (DealerNotFoundException $e) {
        $response = $response->withStatus(404);
        return $response->withJson(['error' => $e->getMessage()]);
    } catch (Exception $e) {
        $response->withStatus(501);
        return $response->withJson(['error' => 'Application Error']);
    }

    return $response->withJson($data);
});

// Delete Dealer
$app->delete('/dealers/{dealerId}', function (Request $request, Response $response) {

    $dealerId = $request->getAttribute('dealerId');

    $dealerService = new DealerService(
        new DoctrineDealerRepository($this->entityManager)
    );

    try {
        $dealerService->removeDealer($dealerId);
    } catch (DealerNotFoundException $e) {
        $response = $response->withStatus(404);
        return $response->withJson(['error' => $e->getMessage()]);
    } catch (Exception $e) {
        $response->withStatus(501);
        return $response->withJson(['error' => 'Application Error']);
    }

    return $response->withJson(['status' => 'removed']);
});

$app->run();