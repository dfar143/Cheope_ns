<?php
$rootDir = dirname( __FILE__ ) . "/..";
chdir($rootDir);
require_once("./fw/Std_level_menu.class.php");

class ClassHasAttributeTest extends PHPUnit_Framework_TestCase
{
    public function testFailure()
    {
        $this->assertClassHasAttribute('gesPage', 'Std_level_menu');
    }
}
?>