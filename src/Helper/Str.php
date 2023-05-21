<?php
/**
 * Class Application
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Helper
 * @IDE     PhpStorm
 */

namespace Helper;

use Traversable;
use JetBrains\PhpStorm\Pure;

class Str
{

    protected string $item = "";

    #[Pure] public function __construct($item)
    {
        $this->item = self::getStringItem($item);
    }

    /**
     * Convert the given string to lower-case
     *
     * @return $this
     */
    public function lower(): object
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
    public function upper()
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
    public static function make(string $item = ""): static
    {
        return new static($item);
    }

    /**
     * Replace the given value in the given string.
     *
     * @param string $search
     * @param string $replace
     * @return $this
     */
    public function replace($search, $replace)
    {
        $item = str_replace($search, $replace, $this->item);

        $this->item = $item;
        return $this;
    }

    /**
     * Remove the given value in the given string.
     *
     * @param string value
     * @param boolean $caseSensitive
     * @return $this
     */
    public function remove($value, $caseSensitive = true)
    {

        $item = $caseSensitive
            ? str_replace($value, '', $this->item)
            : str_ireplace($value, '', $this->item);

        $this->item = $item;
        return $this;
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param array|string $value
     * @param $caseSensitive boolean
     * @return bool
     */
    public function startWith(array|string $value, bool $caseSensitive = true): bool
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
     * @param array|string $value
     * @param bool $caseSencitive
     * @return bool
     */
    public function endWith(array|string $value, bool $caseSencitive = true): bool
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
    public function title()
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
     * @param $item
     * @return string
     */
    protected function getStringItem($item): string
    {
        if (is_string($item)) {
            return $item;
        }

        return (string) $item;
    }
}