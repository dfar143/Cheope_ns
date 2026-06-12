<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");


abstract class Html_interface_decorator extends Html_formatted_interface
{
 
	const DECORATING_SUFFIX="dec";
  const DEFAULT_CSS_MODULE=CSS_FRAME_DEC;

	private $decoratedObj=null;
	private $decoratorName=STRING_NULL;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = false;
  static $hasJavascriptManagement = true;
  static $hasCssManagement=true;
 	
	function __construct(?Html_formatted_interface $actObj=null,
	string $actOp=STRING_NULL,$actNum=STRING_NULL)
	{
	 parent::__construct($actOp,self::INT_HTML_FIELDSET_DECORATOR,$actNum);
	 $this->setDecoratedObj($actObj);
 	 //self::$hasCssManagement=true;
   $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
   self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
	}
	
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
  function useDojo():bool
	{
		return self::$useDojo;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
	
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
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
 	//$serializer = $this->getSerializer();
	//$this->serialize_props_exec($booleanPropsArray);
	
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$decoratedObj = $this->getDecoratedObj();
 	$item1 = array("decoratedObj"=>$decoratedObj);
 	$serializer->loadItems($item1);	
 	$decoratorName = $this->getDecoratorName();
 	$item2 = array("decoratorName"=>$decoratorName);
 	$serializer->loadItems($item1);
 }
	
	function setDecoratorName(string $actDecoratorName):void
	{
		$this->decoratorName = $actDecoratorName;
	}
	
	function getDecoratorName():string
	{
		return $this->decoratorName;
	}
	
	function getDecoratedObj():Html_formatted_interface
	{
		return $this->decoratedObj;
	}
	
	function setDecoratedObj(?Html_formatted_interface $actDecoratedObj):void
	{
		$this->decoratedObj = $actDecoratedObj;
	}
	
abstract function preDec():void;
	
abstract function postDec():void;
	
	function isDecorator():bool
	{
		return true;
	}
	
 	function isContainer():bool
	{
		return false;
	}
	
	function putData():void
	{
		$decObj = $this->getDecoratedObj();
	  $op = $decObj->getOp();
	  $this->setOp($op);
	  $type = $decObj->getType() . VAR_SEP . self::DECORATING_SUFFIX;
	  $this->setType($type);
	  $num = $decObj->getNum();
	  $this->setNum($num);
    $this->preDec();
    $decObj->putData();
    $this->postDec();   	
	}
	
}


?>