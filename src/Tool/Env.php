<?php
/**
 * Class Application
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Helper
 * @IDE     PhpStorm
 */

namespace Tool;

use Dotenv\Dotenv;
use ArrayAccess;

class Env
{

    public static function loadEnv(string $filename = null): void
    {
        self::boot($filename);
    }

    public static function boot($filename): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__), $filename);
        $dotenv->load();
    }

    public static function getEnv(mixed $key, mixed $default = null): mixed
    {
        if(!empty($_ENV[$key])){
            $envKey = $_ENV[$key];
        } else {
            $envKey = $default;
        }

        return($envKey);
    }
}
