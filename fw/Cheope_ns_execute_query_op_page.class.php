<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("Creator.tra.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"execute_query");
define('THIS_PAGE',"execute_query.php");

class Cheope_ns_execute_query_op_page extends Cheope_ns_page
{
 use Creator;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
 }
 
 function putClientScriptIncludeCode():void
 {
 	parent::putClientScriptIncludeCode();
 }
 
 function putActiveApp():void
 {
 } 

 function putBody():void
 {
 	
 	$interfaces = $this->getInterfacesContainer();
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && 
  $_SESSION[SESSION_VAR_ACTIVE_APP] != STRING_NULL)
  { 
   $appDir = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $queryPos = $_GET[PAR];
   $fileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
 
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$fileName);
   $xmlSerializer->loadData($fileName);
   $items = $xmlSerializer->getItems();
   $item = $items[$queryPos];
   $queryStr = $item["queryBody"];
   $scope = STRING_BACKSLASH . $appDir .  
   STRING_BACKSLASH  . FRAMEWORK_DIR . STRING_BACKSLASH ;
   eval("\$dataSource = " . $scope . "getAllDataByQuery(\$queryStr);");
   if((is_array($dataSource))&& (count($dataSource)>0))
   {
    $intTable = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_1);
    $intTable->setFieldsFromDataSource(true);
    $intTable->setDataSource($dataSource);   	        
   }
   elseif(is_array($dataSource)&& (count($dataSource)==0))
   {
   	$intSpan = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	$intSpan->setTagBody("0" . STRING_SPACE . MSG_38);
   	$interfaces->setElement($intSpan,1);
   } 
   else
   {  
   	$intSpan = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
   	$intSpan->setTagBody($dataSource . STRING_SPACE . MSG_38);
   	$interfaces->setElement($intSpan,1);
   }
   $int_iter = $interfaces->create();   
   $int = $int_iter->last();
   $int->putData();
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  else
  {
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
   $int->putData();
  }
 }
}
?>