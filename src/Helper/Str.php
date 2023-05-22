<?php

declare(strict_types=1);
/**
 * Class Application
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Helper
 * @IDE     PhpStorm
 */

namespace Helper;

use Traversable;
use function _PHPStan_dec9e435a\RingCentral\Psr7\str;

final class Str
{

    protected string $item = "";

    final public function __construct(string $item)
    {
        $this->item = $item;
    }

    /**
     * Convert the given string to lower-case
     *
     * @return $this
     */
    public function lower(): Str
    {
        $item = mb_strtolower($this->item, 'UTF-8');

        $this->item = $item;
        return $this;
    }

    /**
     * Convert the given string tu upper-case
     *
     * @return $this
     */
    public function upper(): Str
    {
        $item = mb_strtoupper($this->item, 'UTF-8');

        $this->item = $item;
        return $this;
    }

    /**
     * Create a new Str instance if the value isn't one already.
     *
     * @param string $item
     * @return static
     */
    public static function make(string $item = ""): Str
    {
        return new Str($item);
    }

    /**
     * Replace the given value in the given string.
     *
     * @param string|array<string> $search
     * @param string|array<string> $replace
     * @return $this
     */
    public function replace(string|array $search, string|array $replace = ''): Str
    {
        if(is_iterable($search) and empty($replace)){
            $item = $this->item;
            foreach ($search as $key => $value) {
                $item = str_replace($key, $value, $item);
            }
        } else {
            $item = str_replace($search, $replace, $this->item);
        }

        $this->item = $item;
        return $this;
    }

    /**
     * Remove the given value in the given string.
     *
     * @param string|array<string> $value
     * @param boolean $caseSensitive
     * @return $this
     */
    public function remove(string|array $value, bool $caseSensitive = true, bool $removeSpace = false): Str
    {
        if(!is_iterable($value)){
            $value = [$value];
        }

        $item = $this->item;
        foreach ($value as $key){
            $item = $caseSensitive
                ? str_replace($key, '', $item)
                : str_ireplace($key, '', $item);
        }

        $this->item = $item;
        if($removeSpace){
            self::removeSpace();
        }
        return $this;
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string|array<string> $value
     * @param boolean $caseSensitive
     * @return boolean
     */
    public function startWith(string|array $value, bool $caseSensitive = true): bool
    {
        if(!is_iterable($value)) {
            $value = [$value];
        }

        foreach ($value as $key) {
            if ((string)$key !== '' and str_starts_with($caseSensitive ? $this->item : strtolower($this->item), $caseSensitive ? $key : strtolower($key) )) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string|array<string> $value
     * @param bool $caseSencitive
     * @return bool
     */
    public function endWith(string|array $value, bool $caseSencitive = true): bool
    {
        if(!is_iterable($value)){
            $value = [$value];
        }

        foreach ($value as $key) {
            if((string)$key !== '' and str_ends_with($caseSencitive ? $this->item : strtolower($this->item, ), $caseSencitive ? $key : strtolower($key))){
                return true;
            }
        }

        return false;
    }

    /**
     * Convert to Title case
     *
     * @return $this
     */
    public function title(): Str
    {
        $item = mb_convert_case($this->item , MB_CASE_TITLE, "UTF-8");

        $this->item = $item;
        return $this;
    }

    /**
     * Get the item.
     *
     * @return string
     */
    public function get(): string
    {
        return (string) $this->item;
    }


    /**
     * Removing excess space
     *
     * @return Str $this
     */
    public function removeSpace(): Str
    {
        $this->item = trim((string)preg_replace('~\s{2,}~', ' ', $this->item));
        return $this;
    }


    /**
     * @return bool
     */
    public function isSnakeCase(): bool
    {
        $snakeCase = (string)  preg_replace('/\s+/', '_', $this->item);
        $snakeCase = (string)  preg_replace('/(.)(?=[A-Z])/u', '$1_', $snakeCase);
        $snakeCase = strtolower($snakeCase); // Převede vše na malá písmena

        if ($snakeCase === $this->item) {
            return true;
        }

        return false;
    }

    public function isCamelCase(): bool
    {
        $camelCase = (string) str_replace(' ', '', ucwords($this->item));
        $camelCase = (string) str_replace('_', '', $camelCase);
        $camelCase = lcfirst($camelCase);

        if ($camelCase === $this->item) {
            return true;
        }

        return false;
    }
}