<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"view_all_fields");
define('THIS_PAGE',"view_all_fields.php");

class Cheope_ns_view_all_fields_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
  (isset($_GET[PAR])))
  {
   $tablePos = $_GET[PAR];
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $intJavascriptDataFragment = $interfaces->getInterface(OBJ_NONE,"viewAllFieldsOp3",
   Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,NUM_1);   
   $fun = function($actField) use ($appName,$tablePos)
   {
    $pk = Xml_db_model::getPkField($appName,$tablePos);
    return $pk;
   };     
   $intJavascriptDataFragment->setDataFieldDomainValueByPos(1,$fun);
  }
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteByStringInType("javascript");
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {
   $htmlWriter->put("<script>dojo.require(\"dijit.Menu\")</script>"); 
 	 $htmlWriter->put("<script>dojo.require(\"dojo.dnd.Source\");</script>");
   $htmlWriter->put("<script>dojo.addOnLoad(function(){document.body.className+=' nihilo';});</script>");
  }
 }
   


 function putActiveApp():void
 {
 }
 
 function putHeader():void
 {
 }

 function putBody():void
 {
 	
 	$interfaces = $this->getInterfacesContainer();
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
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