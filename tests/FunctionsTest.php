<?php

namespace tests;

use PHPUnit_Framework_TestCase;
use Drips\Utils\OutputBuffer;

class FunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider arrayProvider
     */
    public function testArrayExtract($array, $extract, $result)
    {
        $this->assertEquals(array_extract($array, $extract), $result);
    }

    public function testClassAliase()
    {
        $this->assertTrue(class_exists(OutputBuffer::class));
        $this->assertFalse(class_exists(OB::class));
        class_aliase(['tests\OB' => OutputBuffer::class]);
        $this->assertTrue(class_exists(OB::class));
    }

    public function arrayProvider()
    {
        return array(
            array(
                array("a" => 1, "b" => 2, "c" => 3),
                array("a", "b"),
                array("a" => 1, "b" => 2)
            ),
            array(
                array("a" => 1, "b" => 2, "c" => 3),
                array("a", "b", "c"),
                array("a" => 1, "b" => 2, "c" => 3)
            ),
            array(
                array("a" => 1, "b" => 2, "c" => 3),
                array(),
                array()
            ),
            array(
                array("a" => 1, "b" => 2, "c" => 3),
                array("d"),
                array()
            )
        );
    }
}
