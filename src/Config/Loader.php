<?php

declare(strict_types=1);

namespace Handlr\Config;

use Dotenv\Dotenv;

class Loader
{
    public static function load(string $configPath): void
    {
        $dotenv = Dotenv::createImmutable(dirname($configPath) . '/../');
        $dotenv->load();

        // Load configuration file
        $config = require $configPath; // NOSONAR

        // Pass the loaded config to the Config class
        Config::load($config);
    }
}
