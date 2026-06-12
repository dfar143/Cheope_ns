<?php
require_once("phpunit.phar");
$rootDir = dirname( __FILE__ ) . "/..";
chdir($rootDir);

class HtmlDataInterfaceSetAndGetConstructorArgsTest extends
PHPUnit_Framework_TestSuite
{
	var $htmlDataInterfaceName="";
	
	  function __construct($actHtmlDataInterfaceName)
	  {
	  	$this->htmlDataInterfaceName = $actHtmlDataInterfaceName;
	  	require_once("./fw/" . $actHtmlDataInterfaceName . ".class.php"); 
	  }	  
	  public function count()
    {
        return 1;
    }
	  public function run(PHPUnit_Framework_TestResult $result = NULL)
    {
       if ($result === NULL) {
            $result = new PHPUnit_Framework_TestResult;
        }
        $result->startTest($this);
        PHP_Timer::start();
        $stopTime = NULL;
    	  $htmlDataInterfaceName = $this->htmlDataInterfaceName;
        $obj = new $htmlDataInterfaceName(OBJ_NONE,OP_NONE,NUM_0);
        try
        {
         PHPUnit_Framework_Assert::assertEquals(OBJ_NONE,$obj->getObj());
        }
        catch(PHPUnit_Framework_AssertionFailedError $e)
        {
        	$stopTime = PHP_Timer::stop();
        	$result->addFailure($this, $e,$stopTime);
        } 
        catch (Exception $e) 
        {
          $stopTime = PHP_Timer::stop();
          $result->addError($this, $e, $stopTime);
        }
        if ($stopTime === NULL) 
        {
          $stopTime = PHP_Timer::stop();
        }
        $result->endTest($this,$stopTime);      
       return $result;
    }
}


$test1 = new HtmlDataInterfaceSetAndGetConstructorArgsTest("Std_accordion");
$result = PHPUnit_TextUI_TestRunner::run($test1);

?>