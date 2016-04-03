<?php

namespace tests;

require_once __DIR__.'/../vendor/autoload.php';

use PHPUnit_Framework_TestCase;
use Drips\Utils\Event;

class MyClass extends Event
{
    public static $arg = true;

    public function __construct($arg){
        static::$arg = static::call("newobj", $arg)[0];
    }
}

class EventTest extends PHPUnit_Framework_TestCase
{
    public function testEvent()
    {
        $this->assertTrue(MyClass::$arg);
        MyClass::on("newobj", function($arg){
            return array(!$arg);
        });
        $this->assertTrue(MyClass::$arg);
        $obj = new MyClass(true);
        $this->assertFalse(MyClass::$arg);
    }
}
