<?php

declare(strict_types=1);

namespace Handlr\Session;

use SessionHandlerInterface;

class Session
{
    private static ?SessionHandlerInterface $handler = null;

    public static function useHandler(SessionHandlerInterface $handler): void
    {
        self::$handler = $handler;
        session_set_save_handler(self::$handler, true);
    }

    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        if (session_status() !== PHP_SESSION_NONE) {
            session_destroy();
        }
    }
}
