<?php

declare(strict_types=1);

/**
 * Class Str
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Utils
 * @IDE     PhpStorm
 */

namespace ONyklicek\Utils;

use JetBrains\PhpStorm\Language;
use JetBrains\PhpStorm\Pure;
use ONyklicek\Attributes\ReturnType;
use ONyklicek\Attributes\TestingStatus;
use ONyklicek\Utils\Traits\StrSupportTrait;

final class Str
{
    use StrSupportTrait;

    /**
     * @var string
     */
    private string $item = "";

    /**
     * @param string $item
     */
    final public function __construct(string $item)
    {
        $this->item = $item;
    }

    /**
     * Convert the given string to lower-case
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function lower(): Str
    {
        $this->item = mb_strtolower($this->item, 'UTF-8');
        return $this;
    }

    /**
     * Convert the given string tu upper-case
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function upper(): Str
    {
        $this->item = mb_strtoupper($this->item, 'UTF-8');
        return $this;
    }

    /**
     * Create a new Str instance.
     *
     * @param string $item
     * @return static
     */
    #[Pure]
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
    #[TestingStatus(TestingStatus::SUCCESS)]
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
     * @param string|array<string> $search
     * @param boolean $caseSensitive
     * @param bool $removeSpace
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function remove(string|array $search, bool $caseSensitive = true, bool $removeSpace = false): Str
    {
        $item = $caseSensitive
            ? str_replace($search, '', $this->item)
            : str_ireplace($search, '', $this->item);

        if($removeSpace){
            $item = $this->removalOfSpaces($item);
        }

        $this->item = $item;
        return $this;
    }

    /**
     * Determine if contains a given string.
     *
     * @param string|array<string> $needles
     * @param bool $caseSensitive
     * @return bool
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function contains(string|array $needles, bool $caseSensitive = true): bool
    {
        foreach((array) $needles as $needle){
            if ($needle !== '' and $caseSensitive
                    ? str_contains($this->item, $needle)
                    : str_contains(mb_strtolower($this->item), $needle)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string|array<string> $needles
     * @param boolean $caseSensitive
     * @return boolean
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function startWith(string|array $needles, bool $caseSensitive = true): bool
    {
        foreach ((array)$needles as $needle) {
            if ((string)$needle !== '' and str_starts_with($caseSensitive ? $this->item : strtolower($this->item), $caseSensitive ? $needle : strtolower($needle) )) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine if a given string ends with a given substring.
     *
     * @param string|array<string> $needles
     * @param bool $caseSensitive
     * @return bool
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function endWith(string|array $needles, bool $caseSensitive = true): bool
    {
        foreach ((array)$needles as $needle) {
            if((string)$needle !== '' and str_ends_with($caseSensitive ? $this->item : strtolower($this->item), $caseSensitive ? $needle : strtolower($needle))){
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
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function title(): Str
    {
        $this->item = mb_convert_case($this->item , MB_CASE_TITLE, "UTF-8");;
        return $this;
    }

    /**
     * Get the item.
     *
     * @return string
     */
    #[ReturnType('string')]
    public function get(): string
    {
        return $this->item;
    }

    /**
     * Removing excess space
     *
     * @return Str $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function removeSpace(): Str
    {
        $this->item = $this->removalOfSpaces($this->item);
        return $this;
    }

    /**
     * Verify that it is a snake case
     *
     * @return bool
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function isSnakeCase(): bool
    {
        if ($this->toSnakeCase($this->item) === $this->item) {
            return true;
        }

        return false;
    }

    /**
     * Verify that it is a camel case
     *
     * @return bool
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function isCamelCase(): bool
    {
        if ($this->toCamelCase($this->item) === $this->item) {
            return true;
        }

        return false;
    }

    /**
     * Verify that is a kebab case
     *
     * @return bool
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('bool')]
    public function isKebab(): bool
    {
        if ($this->toKebabCase($this->item) === $this->item) {
            return true;
        }

        return false;
    }

    /**
     * Convert to snake case
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function toSnake(): Str
    {
        $this->item = $this->toSnakeCase($this->item);
        return $this;
    }

    /**
     * Convert to camel case
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function toCamel(): Str
    {
        $this->item = $this->toCamelCase($this->item);
        return $this;
    }

    /**
     * Convert to kebab case
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function toKebab(): Str
    {
        $this->item = $this->toKebabCase($this->item);
        return $this;

    }

    /**
     * Get string length
     *
     * @param string|null $encoding
     * @return int
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('int')]
    public function length(?string $encoding = 'UTF-8'): int
    {
        return mb_strlen($this->item, $encoding);
    }


    /**
     * Get the number of words a string contains.
     *
     * @param string|null $characters
     * @return int
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    #[ReturnType('int')]
    public function wordsCount(?string $characters = null): int
    {
        return str_word_count($this->item, 0, $characters);
    }

    /**
     * Limit the number of words in a string.
     *
     * @param int $words
     * @param string $end
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function words(int $words = 100 , string $end = '...'): Str
    {
        preg_match('/^\s*+(?:\S++\s*+){1,'.$words.'}/u', $this->item, $matches);

        if (!isset($matches[0]) or mb_strlen($this->item) === mb_strlen($matches[0])) {
            $item = $this->item;
        } else {
            $item = rtrim($matches[0]);
            if(self::isPunctuation(substr($item, -1))){
                $item = substr_replace($item, '', -1).$end;
            } else {
                $item = rtrim($matches[0]).$end;
            }
        }

        $this->item = $item;
        return $this;
    }

    /**
     * Reverse string
     *
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function reverse(): Str
    {
        $this->item = (string) iconv('UTF-32LE', 'UTF-8',strrev((string) iconv('UTF-8', 'UTF-32BE', $this->item)));
        return $this;
    }

    /**
     * Searching in string with regular expression

     *
     * @param string $pattern
     * @param array<string>|string|null $matches
     * @return array<string>|string|null
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function pregMatch(#[Language('RegExp')] string $pattern, array|string $matches = null): array|string|null
    {
         preg_match($pattern, $this->item, $matches);

        return $matches;
    }

    /**
     * Replace with regular expression
     *
     * @param string|array<string> $pattern
     * @param string|array<string> $replacements
     * @return string|array<string>|null
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function pregReplace(#[Language('RegExp')] string|array $pattern, string|array $replacements = ""): array|string|null
    {
        return preg_replace($pattern, $replacements, $this->item);
    }

    /**
     * Returns the part of the text after the first occurrence of the search term.
     * The entire string will be returned if the value does not exist within the string.
     *
     * @param string $needle
     * @param bool $stripWhitespace
     * @return Str
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function after(string $needle, bool $stripWhitespace = false): Str
    {
        if($needle === ''){
            return $this;
        }

        $item = array_reverse(explode($needle, $this->item, 2))[0];
        $this->item = $stripWhitespace ? trim($item) : $item;
        return $this;
    }

    /**
     * Returns the part of the text after the last occurrence of the search term.
     * The entire string will be returned if the value does not exist within the string.
     *
     * @param string $needle
     * @param bool $stripWhitespace
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function afterLast(string $needle, bool $stripWhitespace = false): Str
    {
        if($needle === ''){
            return $this;
        }

        $regex = '/\b' . preg_quote($needle, '/') . '\b/';
        $parts = preg_split($regex, $this->item);

        if(!empty($parts)){
            $item = end($parts);

            if ($regex === '/\b_\b/') {
                $separator = '_';
                $parts = explode($separator, $this->item);
                $item = end($parts);
            }

            $this->item = $stripWhitespace ? trim($item) : $item;
        }

        return $this;
    }

    /**
     * Returns the part of the text before the first occurrence of the search term.
     * The entire string will be returned if the value does not exist within the string.
     *
     * @param string $needle
     * @param bool $stripWhitespace
     * @return $this
     */
    #[TestingStatus(TestingStatus::SUCCESS)]
    public function before(string $needle, bool $stripWhitespace = false): Str
    {
        $regex = '/^(.*?)' . preg_quote($needle, '/') . '/u';
        if (preg_match($regex, $this->item, $matches)) {
            $item = $matches[1] ?? $this->item;
            $this->item = $stripWhitespace ? trim($item) : $item;
        }

        return $this;
    }

    /**
     * Returns the part of the text before the last occurrence of the search term.
     * The entire string will be returned if the value does not exist within the string.
     *
     * @param string $needle
     * @param bool $stripWhitespace
     * @return $this
     */

    #[TestingStatus(TestingStatus::SUCCESS)]
    public function beforeLast(string $needle, bool $stripWhitespace = false): Str
    {
        if($needle === ''){
            return $this;
        }

        $patternWord = '/^(.*?\b)' . preg_quote($needle, '/') . '\b(?!.*\b' . preg_quote($needle, '/') . '\b)/';
        $patternSeparator = '/^(.*?)(?=' . preg_quote($needle, '/') . '(?=[^' . preg_quote($needle, '/') . ']*$))/';
        $pattern = str_contains($this->item, '_') ? $patternSeparator : $patternWord;
        preg_match($pattern, $this->item, $matches);

        if (empty($matches[1])) {
            return $this;
        }

        $this->item = $stripWhitespace ? trim($matches[1]) : $matches[1];
        return $this;
    }

    /**
     * @return $this
     */
    public function between(): Str
    {

        return $this;
    }

    public function toSlug(): Str
    {
        return $this;
    }
}