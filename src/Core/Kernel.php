<?php

declare(strict_types=1);

namespace Handlr\Core;

use Handlr\Database\Db;
use Handlr\Handlers\ErrorHandler;
use Handlr\Handlers\LogHandler;
use Handlr\Log\Log;
use Handlr\Log\Psr3Logger;
use Handlr\Session\DatabaseSessionDriver;
use Handlr\Session\Session;

final class Kernel
{
    private string $appDir;
    private Container $container;
    private Router $router {
        get {
            return $this->router;
        }
    }

    public function __construct(string $appDir) // NOSONAR
    {
        $this->appDir = $appDir;
        $this->container = new Container();
        $this->router = new Router($this->container);

        $this->loadBootstrap();

        $this->registerServices();
        $this->registerGlobalHandlers();

        $this->loadRoutes();
    }

    private function registerServices(): void
    {
        $this->registerLogger();
        $this->registerDatabase();
        $this->registerSession();
    }

    private function registerLogger(): void
    {
        $logFile = $this->appDir . '/logs/app.log';
        $this->container->set(LogHandler::class, static function () use ($logFile) {
            $logger = new Log();
            $logger::setLogger(new Psr3Logger($logFile));
            return new LogHandler($logger);
        });
    }

    private function registerDatabase(): void
    {
        $this->container->set(Db::class, static function () {
            return new Db();
        });
    }

    private function registerSession(): void
    {
        $db = $this->container->get(Db::class);
        $sessionHandler = new DatabaseSessionDriver($db);
        Session::useHandler($sessionHandler);
    }

    private function registerGlobalHandlers(): void
    {
        $this->router->addGlobalHandler(new ErrorHandler());
        $logHandler = $this->container->get(LogHandler::class);
        $this->router->addGlobalHandler($logHandler);
    }

    private function loadBootstrap(): void
    {
        require_once $this->appDir . '/bootstrap.php'; // NOSONAR
    }

    private function loadRoutes(): void
    {
        $router = $this->router; // NOSONAR
        require_once $this->appDir . '/app/routes.php'; // NOSONAR
    }

    public function getRouter(): Router
    {
        return $this->router;
    }
}
