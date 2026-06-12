<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"queries");
define('THIS_PAGE',"queries.php");


class Cheope_ns_queries_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
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
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer();
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	{
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "queries_repository" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->setDir(STRING_NULL);
   $xmlSerializer->loadData();
   $items = $xmlSerializer->getItems();
   
   $newItems=array();
   $isDataSource=false;
   $queryBody=STRING_NULL;
   $i=0;
   foreach($items as $ind=>$item)
   {
   	if($ind==0)
   	{
   	 $isDataSource = $item["dataSource"];
   	 $queryBody = $item["queryBody"];
   	}
   	//$newItems[$item["queryName"]]=$ind;
	$newItems[$ind]=$item["queryName"];
   	$i++;
   }
   //$newItems[STRING_NULL] = $i;
   $newItems[$i] = STRING_NULL;
   
   if($isDataSource=="true")
   {
   	$intInput1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAG,NUM_1);
   	$attribs = $intInput1->getAttribs();
   	$attribs["checked"]=STRING_NULL;
   	$intInput1->setAttribs($attribs);
   }
   
   $intTextArea = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);
   $intTextArea->setTagBody($queryBody); 
        
   $intForm = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
   
   $intForm->setDataFieldDomainValueByName(FIELD_LISTA_QUERIES,$newItems);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();  
 }
 elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
 {
  $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_7)->getInterfacesContainer()->deleteItem(1);
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