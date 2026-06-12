<?
namespace Std\fw;
require_once("std.fun.php");
require_once("AjaxOp.class.php");
//require_once("error_handler.def.php");
require_once("Xml_interface_serializer.class.php");
require_once("Creator.tra.php");

class AjaxOpLocalization extends AjaxOp
{
  function __construct()
  {
   parent::__construct(AJAX_OP_LOCALIZATION);
  }
  
  function exec_1(string $actId):array|string|bool|null
  {	
   session_start();
   $ids = explode(STRING_SEMICOLON,$actId);
   $locale = $ids[0];
   $localeFile = $ids[1];
   $appFileName = THIS_DIR. DIR_SEP . JSON_DIR . 
   DIR_SEP . $localeFile . FILE_NAME_ELEMENTS_SEP . JSON_SUFFIX;
   $jsonSerializer = Creator::create(getClassNameForCreate(Classes_info::JSON_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $jsonSerializer->loadData();
   $items = $jsonSerializer->getItems();
   $localizzazioni = $items;
   $item=array();
   foreach($localizzazioni as $locale1)
   {
   	if ($locale1["locale"] == $locale)
   	 $item = $locale1["items"];
   }
   return $item;
  }
}

class AjaxOpJavascriptInjection extends AjaxOp {
	function __construct() {
		parent::__construct( AJAX_OP_JAVASCRIPT_INJECTION );
	}
    function exec_1(string $actId):array|string|bool|null
	{
	 session_start ();
     $ids = explode(VAR_SEP,$actId);
     $op = $ids[0];
     $num = $ids[1];
	 $javascriptCodeFileName = APPLICATION_NAME . Xml_interface_serializer::INTERFACE_NAME_SEP . Xml_interface_serializer::INTERFACE_NAME_SEP .
	 ucFirst(Interfaces_info::INT_JAVASCRIPT_CODE) . Xml_interface_serializer::INTERFACE_NAME_SEP . $op . Xml_interface_serializer::INTERFACE_NAME_SEP . $num;
     $javascriptCodeFilePath = THIS_DIR . DIR_SEP . INTERFACES_DIR . 
		DIR_SEP . $javascriptCodeFileName; 
     $interfaceSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$javascriptCodeFilePath);
		$interfaceSerializer->loadData ();
		$items = $interfaceSerializer->getItems ();
		$javascriptCode = $items["javascriptCode"];  
     return $javascriptCode;   		
	}
}	

?>