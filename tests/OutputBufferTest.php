<?php

namespace tests;

use Drips\Utils\OutputBuffer;
use PHPUnit_Framework_TestCase;

class OutputBufferTest extends PHPUnit_Framework_TestCase
{
    public function testOB()
    {
        $content = 'Hello World!';
        $ob = new OutputBuffer();
        $ob->start();
        echo $content;
        $this->assertEquals($content, $ob->end());
        $this->assertEquals($content, $ob->getContent());
    }
}
