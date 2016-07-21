<?php

namespace tests;

use Drips\Utils\Event;
use PHPUnit_Framework_TestCase;

class MyClass
{
    use Event;
    public static $arg = true;

    public function __construct($arg)
    {
        static::$arg = static::call('newobj', $arg)[0];
    }
}

class EventTest extends PHPUnit_Framework_TestCase
{
    /**
     * Testet ob die Event-Ausführung entsprechend funktioniert
     */
    public function testEvent()
    {
        $this->assertTrue(MyClass::$arg);
        MyClass::on('newobj', function ($arg) {
            return array(!$arg);
        });
        $this->assertTrue(MyClass::$arg);
        $obj = new MyClass(true);
        $this->assertFalse(MyClass::$arg);
    }
}
