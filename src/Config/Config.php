<?php

declare(strict_types=1);

namespace Handlr\Config;

class Config
{
    protected static array $config = [];

    public static function load(array $config): void
    {
        self::$config = $config;
    }

    public static function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = self::$config;

        foreach ($keys as $keyPart) {
            if (isset($value[$keyPart])) {
                $value = $value[$keyPart];
            } else {
                return $default;
            }
        }

        return $value;
    }
}
