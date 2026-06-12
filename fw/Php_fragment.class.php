<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


class Php_fragment extends Html_formatted_interface
{
 const DEFAULT_ENABLE_EXECUTE_AT_ONCE =true;	
	
 private $phpFragment=STRING_NULL;
 private $executeAtOnce=self::DEFAULT_ENABLE_EXECUTE_AT_ONCE;
 static private $phpFragmentsTotNum=0;
 static $hasCssManagement=false;
 private $externalPar=STRING_NULL;
 static $hasJavascriptManagement = false;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$phpFragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$phpFragmentsTotNum - 1; 
 	parent::__construct($actOp,self::INT_PHP_FRAGMENT,$actNum);
 }
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$phpFragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$phpFragmentsTotNum=$actIntNum + 0;
 }
 
 function setExecuteAtOnce(bool $actExecute):void
 {
  $this->executeAtOnce = $actExecute;
 }
 
 function getExecuteAtOnce():bool
 {
 	if($this->executeAtOnce == STRING_NULL)
 	 return self::DEFAULT_ENABLE_EXECUTE_AT_ONCE;
 	else
 	 return $this->executeAtOnce;
 }
 
 function setExternalPar(string $actExternalPar):void
 {
 	$this->externalPar = $actExternalPar;
 }
 
 function getExternalPar():string
 {
 	return $this->externalPar;
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$executeAtOnce = $this->getExecuteAtOnce();
 	$item1 = array("executeAtOnce"=>$executeAtOnce);
 	$serializer->loadItems($item1);	
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
 	$executeAtOnce = $this->getExecuteAtOnce();
 	$htmlWriter = $this->getHtmlWriter();
 	if($executeAtOnce)
  {
   $thisObj = $this;
   $fragmentFun = static function($actPhpFragment) use ($thisObj)
 	 {
 	 	eval($actPhpFragment);
 	 };
 	 $fragmentFun($phpFragment);
 	}
 	else
 	 $htmlWriter->put($phpFragment);
 }

}

?>