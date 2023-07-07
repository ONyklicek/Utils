<?php

use PHPUnit\Framework\TestCase;
use ONyklicek\Utils\Str;

class StrTest extends TestCase
{
    public function testReplace()
    {
        $this->assertEquals('Hello world', Str::make('Bay world')->replace('Bay', 'Hello')->get());
        $this->assertEquals('Hello world', Str::make('Is my world')->replace('Is my', 'Hello')->get());
        $this->assertEquals('Hello world', Str::make('Ahoj světe')->replace(['Ahoj' => 'Hello', 'světe' => 'world'])->get());
        $this->assertEquals('Hello my sunny world', Str::make('Hello můj slunečný světe')->replace(['můj', 'slunečný', 'světe'], ['my', 'sunny', 'world'])->get());

    }

    public function testRemove()
    {
        $this->assertEquals('Hello world', Str::make('Hello my world')->remove('my ')->get());
        $this->assertEquals('Hello world', Str::make('Hello my  world')->remove('MY', false, true)->get());
        $this->assertEquals('Hello world', Str::make('Hello my world')->remove('MY ', false)->get());
        $this->assertEquals('Hello', Str::make('Hello my world')->remove(['my', 'world'], false)->removeSpace()->get());
        $this->assertEquals('Hello world', Str::make('Hello my red world')->remove(['my', 'red'])->removeSpace()->get());
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

    public function testRemoveSpace()
    {
        $this->assertEquals('Hello world', Str::make('  Hello     world   ')->removeSpace()->get());
    }

    public function testIsSnakeCase()
    {
        $this->assertFalse(Str::make('helloWorld')->isSnakeCase());
        $this->assertTrue(Str::make('hello_world')->isSnakeCase());
        $this->assertFalse(Str::make('hello__world')->isSnakeCase());
        $this->assertFalse(Str::make('hello   WOrld')->isSnakeCase());
        $this->assertFalse(Str::make('hello_World')->isSnakeCase());
        $this->assertFalse(Str::make('hello___World')->isSnakeCase());
    }

    public function testIsCamelCase()
    {
        $this->assertTrue(Str::make('helloWorld')->isCamelCase());
        $this->assertFalse(Str::make('hello_world')->isCamelCase());
        $this->assertFalse(Str::make('hello world')->isCamelCase());
        $this->assertFalse(Str::make('hello    world')->isCamelCase());
        $this->assertFalse(Str::make('hello_World')->isCamelCase());
        $this->assertFalse(Str::make('Hello__:#$#My:_World')->isCamelCase());
        $this->assertTrue(Str::make('helloMyWorld')->isCamelCase());
    }

    public function testToSnakeCase()
    {
        $this->assertEquals('hello_world', Str::make('Hello_: :#--_World')->toSnake()->get());
        $this->assertEquals('hello_my_world', Str::make('helloMyWorld')->toSnake()->get());
    }

    public function testToCamelCase()
    {
        $this->assertEquals('helloWorld', Str::make('Hello_: :#--_World')->toCamel()->get());
        $this->assertEquals('helloMyWorld', Str::make('Hello_: :my#--_World')->toCamel()->get());
        $this->assertEquals('helloMyWorld', Str::make('hello_my_world')->toCamel()->get());
    }

    public function testContains()
    {
        $this->assertTrue(Str::make('Hello world')->contains('hello', false));
        $this->assertTrue(Str::make('Hello world')->contains(['hello', 'world'], false));
        $this->assertFalse(Str::make('Hello world')->contains(['hello', 'my']));
        $this->assertFalse(Str::make('Hello world')->contains('my'));
    }

    public function testIsKebabCase()
    {
        $this->assertTrue(Str::make('hello-world')->isKebab());
        $this->assertFalse(Str::make('hello_world')->isKebab());
        $this->assertFalse(Str::make('hello world')->isKebab());
        $this->assertFalse(Str::make('HelloWorld')->isKebab());
        $this->assertFalse(Str::make('HelLLo_-_world')->isKebab());
    }

    public function testToKebabCase()
    {
        $this->assertEquals('hello-world', Str::make('hello world')->toKebab()->get());
        $this->assertEquals('hello-world', Str::make('HelloWorld')->toKebab()->get());
        $this->assertEquals('hello-world', Str::make('Hello_..#.-World')->toKebab()->get());
        $this->assertEquals('hello-world', Str::make('Hello---World')->toKebab()->get());
        $this->assertEquals('hello-world', Str::make('Hello_world')->toKebab()->get());
        $this->assertEquals('hello-my-world', Str::make('Hello.my.world')->toKebab()->get());
    }

    public function testLength()
    {
        $this->assertEquals(11, Str::make('Hello world')->length());
    }

    public function testPregMatch()
    {
        $this->assertEquals([0 => 'ab', 'foo' => 'a', 1 => 'a', 'bar' => 'b', 2 => 'b'], Str::make('ab')->pregMatch('/(?P<foo>a)*(?P<bar>b)/'));
    }

    public function testPregReplace()
    {
        $this->assertEquals('The bear black slow jumps over the lazy dog.', Str::make('The quick brown fox jumps over the lazy dog.')->pregReplace(['/quick/', '/brown/', '/fox/'], ['bear', 'black', 'slow']));
        $this->assertEquals('Hello world', Str::make('Hello    world')->pregReplace('~\s{2,}~', ' '));
    }

    public function testReverse()
    {
        $this->assertEquals('Hello', Str::make('olleH')->reverse()->get());
    }

    public function testWords()
    {
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non semper libero...', Str::make('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non semper libero, id tincidunt libero.')->words(12)->get() );
        $this->assertEquals('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non semper libero, id...', Str::make('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non semper libero, id tincidunt libero.')->words(13)->get() );
    }

    public function testWorldsCount()
    {
        $this->assertEquals(18, Str::make('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec ex id elit feugiat vulputate ut nec nulla.')->wordsCount());
    }

    public function testAfter()
    {
        $this->assertEquals('Hello my amazing world', Str::make('Hello my amazing world')->after('blue')->get());
        $this->assertEquals('amazing world', Str::make('Hello my amazing world')->after('my', true)->get());
        $this->assertEquals(' amazing world', Str::make('Hello my amazing world')->after('my')->get());
        $this->assertEquals('user_calendar', Str::make('id_user_calendar')->after('_')->get());
        $this->assertEquals('calendar', Str::make('id_user_calendar')->after('user_')->get());
        $this->assertEquals('/Controler/Core/User', Str::make('App/Core/Controler/Core/User')->after('Core')->get());
    }

    public function testAfterLast()
    {
        //$this->assertEquals('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->afterLast('blue')->get());
        $this->assertEquals('laoreet dolore magna aliquam erat volutpat.', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->afterLast('ut', true)->get());
        $this->assertEquals(' laoreet dolore magna aliquam erat volutpat.', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->afterLast('ut', )->get());
        $this->assertEquals('/Class/Control', Str::make('App/Service/Prov/Class/Control')->afterLast('Prov', )->get());
        $this->assertEquals('/User', Str::make('App/Core/Controler/Core/User')->afterLast('Core')->get());
        $this->assertEquals('calendar', Str::make('id_user_calendar')->afterLast('_')->get());
    }

    public function testBefore()
    {
        //$this->assertEquals('Hello my amazing world', Str::make('Hello my amazing world')->before('blue')->get());
        $this->assertEquals('Hello', Str::make('Hello mylle my amazing world')->before('my', true)->get());
        $this->assertEquals('Hello ', Str::make('Hello mylle my  amazing world')->before('my')->get());
        $this->assertEquals('id_user_', Str::make('id_user_calendar')->before('calendar')->get());
        $this->assertEquals('id', Str::make('id_user_calendar')->before('_')->get());
        $this->assertEquals('id_', Str::make('id_user_calendar_user')->before('user')->get());
        $this->assertEquals('App/', Str::make('App/Core/Controller/Core/User')->before('Core')->get());
    }

    public function testBeforeLast()
    {
        $this->assertEquals('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->beforeLast('blue')->get());
        $this->assertEquals('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->beforeLast('ut', true)->get());
        $this->assertEquals('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ', Str::make('Lorem ipsum dolor dolor dolor sit amet ut, consectetuer adipiscing elit. Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.')->beforeLast('ut', )->get());
        $this->assertEquals('App/Core/Controller/', Str::make('App/Core/Controller/Core/User')->beforeLast('Core')->get());
        $this->assertEquals('id_user', Str::make('id_user_calendar')->beforeLast('_')->get());
        $this->assertEquals('id_user_', Str::make('id_user_calendar')->beforeLast('calendar')->get());
    }
}
