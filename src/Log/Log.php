<?php

declare(strict_types=1);

namespace Handlr\Log;

use BadMethodCallException;
use JsonException;
use Psr\Log\LoggerInterface;

/**
 * @method static void emergency($message, array $context = [])
 * @method static void alert($message, array $context = [])
 * @method static void critical($message, array $context = [])
 * @method static void error($message, array $context = [])
 * @method static void warning($message, array $context = [])
 * @method static void notice($message, array $context = [])
 * @method static void info($message, array $context = [])
 * @method static void debug ($message, array $context = [])
 */
class Log
{
    private const array LOG_FUNCTIONS = [
        'emergency',
        'alert',
        'critical',
        'error',
        'warning',
        'notice',
        'info',
        'debug',
    ];

    private static string $basePath = '';

    private static ?LoggerInterface $logger = null;

    /**
     * @throws JsonException
     */
    public static function __callStatic($method, $args)
    {
        if (!in_array($method, self::LOG_FUNCTIONS, true)) {
            throw new BadMethodCallException();
        }

        self::$basePath = dirname($_SERVER['DOCUMENT_ROOT'] ?? '');

        $message = array_shift($args);
        $context = array_shift($args) ?? [];

        $message = self::interpolate($message, $context);
        $message = self::prependInfo($message);

        return self::getLogger()->$method($message, $context);
    }

    /**
     * @throws JsonException
     */
    private static function interpolate($message, array $context = []): string
    {
        if (!is_string($message)) {
            $message = json_encode($message, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        $replace = [];
        foreach ($context as $key => $value) {
            if (!is_string($value)) {
                $value = json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            }
            $replace['{' . $key . '}'] = $value;
        }

        return strtr($message, $replace);
    }

    private static function prependInfo(mixed $message): string
    {
        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        return sprintf(
            '%s @%s #%s: %s',
            str_replace(self::$basePath, '', $stack[1]['file'] ?? ''),
            $stack[2]['function'],
            $stack[1]['line'],
            $message
        );
    }

    private static function getLogger(): LoggerInterface
    {
        if (self::$logger === null) {
            self::setLogger(new Psr3Logger(self::$basePath . '/logs/app.log'));
        }

        return self::$logger;
    }

    public static function setLogger(LoggerInterface $logger): void
    {
        self::$logger = $logger;
    }
}
