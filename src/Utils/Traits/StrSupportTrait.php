<?php

declare(strict_types=1);

/**
 * Class StrSupportTrait
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Utils-tool
 * @IDE     PhpStorm
 */

namespace ONyklicek\Utils\Traits;

trait StrSupportTrait
{
    /**
     * Convert to snake case
     *
     * @param string $value
     * @return string
     */
    protected function toSnakeCase(string $value): string
    {
        $snakeCase = (string) preg_replace('/[^a-zA-Z0-9]/', '_', $value);
        $snakeCase = (string)preg_replace('/[A-Z]/', '_$0',  lcfirst($snakeCase));
        $snakeCase = (string) preg_replace('/_{2,}/', '_', $snakeCase);
        return strtolower(string: $snakeCase);
    }

    /**
     * Convert to Camel Case
     * @param string $value
     * @return string
     */
    protected function toCamelCase(string $value): string
    {
        $camelCase = (string) preg_replace('/[^a-zA-Z0-9]/', ' ', $value);
        $camelCase = (string) preg_replace('/[_\s]/', '', ucwords($camelCase));
        return lcfirst($camelCase);
    }

    protected function toKebabCase(string $value): string
    {
        $snakeCase = (string) preg_replace('/[^a-zA-Z0-9]/', '-', $value);
        $snakeCase = (string)preg_replace('/[A-Z]/', '-$0', lcfirst($snakeCase));
        $snakeCase = (string) preg_replace('/-{2,}/', '-', $snakeCase);
        return strtolower(string: $snakeCase);
    }

    /**
     * Removing excess spaces
     *
     * @param string $value
     * @return string
     */
    protected function removalOfSpaces(string $value): string
    {
        return trim((string)preg_replace('~\s{2,}~', ' ', $value));
    }

    /**
     * @param string $character
     * @return int|false
     */
    protected function isPunctuation(string $character): int|false
    {
        return preg_match( '/^[[:punct:]]$/', $character);
    }
}