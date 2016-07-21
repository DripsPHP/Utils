<?php
/**
 * Created by PhpStorm.
 * User: raffael
 * Date: 21.07.16
 * Time: 13:51
 */

namespace tests;

use Drips\Utils\ClassGenerator;
use PHPUnit_Framework_Testcase;

class ClassGeneratorTest extends PHPUnit_Framework_Testcase
{
    public function testClassGenerator()
    {
        $generator = new ClassGenerator('TestClass');
        $generator->setNamespace('tests');
        $this->assertEquals("<?php\nnamespace tests;\n\rclass TestClass  \n{\n\r\n\r}", $generator->generate(true));
    }

}