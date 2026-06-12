<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("Creator.tra.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"catalog");
define('THIS_PAGE',"catalog.php");

class Cheope_ns_catalog_op_page extends Cheope_ns_page
{
 Use Creator;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL))
   $interfaces->deleteByStringInType("javascript");
  parent::putClientScriptIncludeCode(); 
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
  $htmlWriter->putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
 }
   
  function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter); 
 }
 

 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $app = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $intSelect1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_2);	
   $intSelect2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_5);	
   $pages = Interfaces_model::getAllPages($app);
   
   $intSelectCont1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
   $opt = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   $opt->setTagBody(STRING_NULL);
   $intSelectCont1->add($opt);
   $i=0;
   foreach($pages as $page)
   {
   	$opt = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   	$opt->setTagBody($page);
   	//$opt->setAttribs(array("value"=>$page));
	$intSelectCont1->add($opt);
   }     
   $intSelect1->setInterfacesContainer($intSelectCont1);
   $nodes = Xml_db_model::getAllNodes($app);
   $intSelectCont2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
   foreach($nodes as $node)
   {
   	$opt = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   	$opt->setTagBody($node);
   	$intSelectCont2->add($opt);
   }     
   $intSelect2->setInterfacesContainer($intSelectCont2);   
   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
//   $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0);
   $int_iter = $interfaces->create();
   $int_iter->reset();
   $int_iter->next();
   $int_iter->next();
   $int_iter->next();
   $int_iter->next();
  $int = $int_iter->current();
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