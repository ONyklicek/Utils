<?php
/**
 * Class Application
 *
 * @autor   Ondrej Nyklicek <ondrejnykicek@icloud.com>
 * @project Helper
 * @IDE     PhpStorm
 */

namespace Helper\Helper;

use Helper\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{

    public function testReplace()
    {
        $this->assertEquals('Hello world', Str::make('Bay world')->replace('Bay', 'Hello')->get());
        $this->assertEquals('Hello world', Str::make('Is my world')->replace('Is my', 'Hello')->get());

    }

    public function testRemove()
    {
        $this->assertEquals('Hello world', Str::make('Hello my world')->remove('my ')->get());
        $this->assertEquals('Hello world', Str::make('Hello my world')->remove('MY ', false)->get());

    }

    public function testStartWith()
    {
        $this->assertEquals('true', Str::make('Hello world')->startWith('Hello'));
        $this->assertEquals('true', Str::make('Hello world')->startWith('hello', false));
        $this->assertEquals('true', Str::make('Hello world')->startWith(['world', 'bay', 'hello'], false));
    }

    public function testEndWith()
    {
        $this->assertEquals('true', Str::make('Hello world')->endWith('world'));
        $this->assertEquals('true', Str::make('Hello world')->endWith('WorLd', false));
        $this->assertEquals('true', Str::make('Hello world')->endWith(['world', 'bay', 'hello'], false));
    }

    public function testTitle()
    {
        $this->assertEquals('Title First Page', Str::make('Title first page')->title()->get());
        $this->assertEquals('Title First Page', Str::make('Title FIRST page')->title()->get());
    }

    public function testLower()
    {
        $this->assertEquals('title first page', Str::make('Title first page')->lower()->get());
        $this->assertEquals('title first page', Str::make('Title FIRST page')->lower()->get());
    }

    public function testUpper()
    {
        $this->assertEquals('TITLE FIRST PAGE', Str::make('Title first page')->upper()->get());
        $this->assertEquals('TITLE FIRST PAGE', Str::make('Title FIRST page')->upper()->get());
    }
}
