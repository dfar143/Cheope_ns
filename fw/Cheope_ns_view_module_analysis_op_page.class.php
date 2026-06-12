<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");



date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"view_module_analysis");
define('THIS_PAGE',"view_module_analysis.php");


class Cheope_ns_view_module_analysis_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteByStringInType("javascript");
 	 parent::putLinkTags();
  }
  else
  {
 	 parent::putLinkTags();
   $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
   DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX);
   putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
   DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  }
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {
   $fileName = isset($_GET[PAR])?$_GET[PAR]:STRING_NULL;
   $intTxtEditor = $interfaces->getInterface(OBJ_NONE,'Op4',Interfaces_info::INT_JAVASCRIPT_DATA_ACE_TXTEDITOR,NUM_1);
   $intTxtEditor->setFileName($fileName);
   $pathItems = explode(STRING_SLASH,$fileName);
   $fileName = $pathItems[count($pathItems)-1];
   $fileNameItems = explode(FILE_NAME_ELEMENTS_SEP,$fileName);
   if(count($fileNameItems)>=2)
    $fileType = $fileNameItems[count($fileNameItems)-1];
   else
    $fileType="xml";
   $intTxtEditor->setMode($fileType); 
   parent::putClientScriptIncludeCode();
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Tooltip\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Dialog\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.TextBox\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.CheckBox\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.Button\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.DropDownButton\")</script>");
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
  else
  parent::putClientScriptIncludeCode();
 }
 
  function putActiveApp():void
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