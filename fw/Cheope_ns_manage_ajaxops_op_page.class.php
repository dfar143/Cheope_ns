<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"manage_ajaxOps");
define('THIS_PAGE',"manage_ajaxOps.php");

class Cheope_ns_manage_ajaxOps_op_page extends Cheope_ns_page
{ 
  const INTERFACE_NAME_SEP = Xml_interface_serializer::INTERFACE_NAME_SEP;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }

 function putLinkTags():void
 {
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteByStringInType("javascript"); 
  }
 	parent::putClientScriptIncludeCode();
 	putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
  $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . "Selection" . JAVASCRIPT_SOURCE_FILE_POSTFIX);
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
 	$htmlWriter->put("<script>dojo.require(\"dojo.dnd.Source\");</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
  $htmlWriter->putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';" .
	"});</script>");
  }
 }

 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
 
 function putBody():void
 {
 	global $dbStructTree;
 	global $dbQueriesContainer;
 	
 	$interfaces = $this->getInterfacesContainer();

  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_14)->getInterfacesContainer()->deleteItem(1);
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_14)->getInterfacesContainer()->deleteItem(1);
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