<?php

namespace tests;

require_once __DIR__.'/../src/outputbuffer.php';

use PHPUnit_Framework_TestCase;
use Drips\Utils\OutputBuffer;

class OutputBufferTest extends PHPUnit_Framework_TestCase
{
    public function testOB()
    {
        $content = "Hello World!";

        $ob = new OutputBuffer;
        $ob->start();
        echo $content;
        $ob->end();

        $this->assertEquals($content, $ob->getContent());
    }
}
