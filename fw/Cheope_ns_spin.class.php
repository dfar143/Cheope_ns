<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("html.fun.php");

class Cheope_ns_spin extends Html_formatted_interface
{
 const DEFAULT_JAVASCRIPT_MODULE=JS_SPIN;
 const DEFAULT_CSS_MODULE=CSS_SPIN;
 
 static $useJQuery = true;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
    
 function __construct(string $actOp=OP_NONE, $actNum=STRING_NULL)
 {

 	parent::__construct($actOp,self::INT_SPIN,$actNum);
  $this->setJavascriptModule(CLIENT_SPIN_CODE_PATH . DIR_SEP . 
  self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCssModule(CLIENT_SPIN_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . 
  STYLE_SHEET_FILE_POSTFIX);
 }
 
 function serialize():void
 {
 	parent::serialize();
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
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
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
 
 function enableBootstrap():void
 {
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function isContainer():bool
 {
 	return false;
 }
 
  function isDecorator():bool
 {
 	return false;
 }
 
 function putData():void
 {
 }
 
}



?>