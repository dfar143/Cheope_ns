<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"layouts");
define('THIS_PAGE',"layouts.php");

class Cheope_ns_layouts_op_page extends Cheope_ns_page
{
 
 const INTERFACE_NAME_SEP = Xml_interface_serializer::INTERFACE_NAME_SEP;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
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
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->put("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.BorderContainer\")</script>"); 
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.StackContainer\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.ContentPane\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.form.TextBox\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.InlineEditBox\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.form.Button\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dojo.dnd.Source\");</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->put("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }
 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }

  
 function putBody():void
 {
 	
 	$interfaces = $this->getInterfacesContainer();

  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appXmlDir);
   $pagesFiles = array(STRING_NULL=>STRING_NULL);
   $pages = Interfaces_model::getAllPages($appName);
   foreach($pages as $page)
   {
   	$pagesFiles[$page]=$page;
   }
   $intCtrl1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,0); 	
   $intCtrl1->setDataFieldDomainValueByName(FIELD_PAGINE,$pagesFiles);
   $intCtrl2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,1); 	
   $intCtrl2->setDataFieldEvents(array("layouts_onChange(this)"));    
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_15)->getInterfacesContainer()->deleteItem(1);
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