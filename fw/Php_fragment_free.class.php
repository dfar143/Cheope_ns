<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");
require_once("generic.const.php");


class Php_fragment_free extends Html_formatted_interface
{		
 private $phpFragment=STRING_NULL;
 private $globalHtmlWriter = null;
 private $globalThis = null;
 static private $phpFragmentsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$phpFragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$phpFragmentsTotNum - 1; 
 	parent::__construct($actOp,self::INT_PHP_FRAGMENT_FREE,$actNum);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$phpFragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$phpFragmentsTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
 }
 
 function setGlobalHtmlWriter(Html_writer $actHtmlWriter):void
 {
	$this->globalHtmlWriter = $actHtmlWriter;
 }
 
 function getGlobalHtmlWriter():Html_writer
 {
	return $this->globalHtmlWriter;
 }
 
 function setGlobalThis(object $actThis):void
 {
  $this->globalThis = $actThis;
 }
 
 function getGlobalThis():object
 {
  return $this->globalThis;
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$phpFragment = $this->getPhpFragment();
 	$item2 = array("@phpFragment"=>$phpFragment);
 	$serializer->loadItems($item2);					
 }

 function getPhpFragment():string
 {
 	return $this->phpFragment;
 }
 
 function setPhpFragment(string $actPhpFragment):void
 {
 	$this->phpFragment = $actPhpFragment;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
  function isDecorator():bool
 {
  return false;
 }
 
 function action(string $actStr,Interfaces_container $actInterfacesContainer):void
 {
 }
 
 function putData():void
 {
 	$phpFragment = $this->getPhpFragment();
	$thisObj = $this->getGlobalThis();
	$htmlWriterObj = $this->getGlobalHtmlWriter();
 	 //$thisObj = $this;
	 //$htmlWriterObj = $this->getHtmlWriter();
 	 $fragmentFun = static function($actPhpFragment) use ($thisObj,$htmlWriterObj)
 	 {
		//echo $actPhpFragment;
 	 	eval($actPhpFragment);
 	 };
 	 $fragmentFun($phpFragment);
 }

}

?>