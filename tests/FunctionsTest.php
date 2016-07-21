<?php

namespace tests;

use Drips\Utils\OutputBuffer;
use PHPUnit_Framework_TestCase;

class FunctionsTest extends PHPUnit_Framework_TestCase
{
    /**
     * Testet ob die Funktion array_extract entsprechend die Inhalte des Arrays extrahiert
     *
     * @dataProvider arrayProvider
     */
    public function testArrayExtract($array, $extract, $result)
    {
        $this->assertEquals(array_extract($array, $extract), $result);
    }

    /**
     * Testet ob die Funktion zum Registrieren von Class-Aliasen entsprechend funktioniert und die Klasse anschließend
     * verfügbar ist.
     */
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
                array('a' => 1, 'b' => 2, 'c' => 3),
                array('a', 'b'),
                array('a' => 1, 'b' => 2)
            ),
            array(
                array('a' => 1, 'b' => 2, 'c' => 3),
                array('a', 'b', 'c'),
                array('a' => 1, 'b' => 2, 'c' => 3)
            ),
            array(
                array('a' => 1, 'b' => 2, 'c' => 3),
                array(),
                array()
            ),
            array(
                array('a' => 1, 'b' => 2, 'c' => 3),
                array('d'),
                array()
            )
        );
    }
}
