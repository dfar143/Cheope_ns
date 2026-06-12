<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("Creator.tra.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"bindings");
define('THIS_PAGE',"bindings.php");


class Cheope_ns_bindings_op_page extends Cheope_ns_page
{
 use Creator;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$interfaces = $this->getInterfacesContainer();
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))  {
   $interfaces->deleteByStringInType("javascript");
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
 	 $htmlWriter->put("<script>dojo.require(\"dojo.dnd.Source\");</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }

 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter); 
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putBody():void
 {
 	
 $interfaces = $this->getInterfacesContainer();
 if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
 	&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 {
 	 $app = $_SESSION[SESSION_VAR_ACTIVE_APP];
 	 $items = array();
    
   $tables = Xml_db_model::getDbObjsDefProps($app);
   $i=0;
   foreach($tables as $ind=>$table)
   {
   	$items[$i++] = $table;
   	$tablePos = Xml_db_model::getTablePos($app,$table);
   	$aliases = Xml_db_model::getAllAliases($app,$tablePos);
   	foreach($aliases as $alias)
   	{
   		$items[$i++] = $alias;
   	}
   } 
   
   $queries = Xml_db_model::getAllDataSourceQueries($app);
   foreach($queries as $ind=>$query)
   {
   	$items[$i++] = $query;
   }
   
 	 $intSelect1 = $interfaces->getInterface(OBJ_NONE,"Input",Interfaces_info::INT_HTML_TAGS,NUM_2);
 	 $intSelect3 = $interfaces->getInterface(OBJ_NONE,"Input",Interfaces_info::INT_HTML_TAGS,NUM_10);
 	 $intSelectContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 	 foreach($items as $ind=>$val)
 	 {
 	 	$intOption = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
 	 	$attribs = array("id"=>"input_node_option_id" . VAR_SEP . $ind);
 	 	$intOption->setTagBody($val);
 	 	$intSelectContainer->add($intOption);
 	 }
 	 $intSelect1->setInterfacesContainer($intSelectContainer);
 	 $intSelect3->setInterfacesContainer($intSelectContainer);
 	 
 	 $intSelect2 = $interfaces->getInterface(OBJ_NONE,"Input",Interfaces_info::INT_HTML_TAGS,NUM_3);
 	 $intSelect4 = $interfaces->getInterface(OBJ_NONE,"Input",Interfaces_info::INT_HTML_TAGS,NUM_11);
 	 $intSelectContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);

   $conn = Xml_db_model::getAllConnections($app);
   
   foreach($conn as $ind=>$val)
   {
   	$intOption = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
 	 	$attribs = array("id"=>"input_connection_option_id" . VAR_SEP . $ind);
 	 	$intOption->setTagBody($val["Connection_name"]);
 	 	$intSelectContainer->add($intOption);
   } 
 	 $intSelect2->setInterfacesContainer($intSelectContainer);
 	 $intSelect4->setInterfacesContainer($intSelectContainer);
  	 
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();  
 }
 elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
 {
  $int_iter = $interfaces->create();
  $int = $int_iter->last();
  $int->getInterfacesContainer()->deleteItem(1);
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