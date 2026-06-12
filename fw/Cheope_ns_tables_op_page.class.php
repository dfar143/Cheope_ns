<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"tables");
define('THIS_PAGE',"tables.php");


class Cheope_ns_tables_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
  $this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();
  parent::setAllIeCssPatchEnabled(true);
  parent::setAllIeCssPatchModule(THIS_DIR . DIR_SEP . CSS_DIR . DIR_SEP . "tables_all_ie_css_patch_module.css");
  parent::putLinkTags();
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {
  $interfaces = $this->getInterfacesContainer();
  $htmlWriter = $this->getHtmlWriter();
  /*if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteItem(14);
   $interfaces->deleteItem(14);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
  }*/
  parent::putClientScriptIncludeCode(); 
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . "cheope_ns_tables_class.js");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Tooltip\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Dialog\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.TextBox\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.CheckBox\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.Button\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.DropDownButton\")</script>");
   $htmlWriter->putGenericHtmlString("<script>" .
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
  
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" 
   . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionArray = $sectionsObj->getItem();
   $newItems = array();
   $tables = array();
   if(isset($sectionArray[0]))
   {
    $sectionObj = $sectionArray[0];
    $defArray = $sectionObj->getItem();
    $j = 0;
    if((count($defArray)>0) && is_a($defArray[0],Classes_info::DEF_ITEM_CLASS)) 
    foreach($defArray as $ind=>$defObj)
    {
     $defElsArray = $defObj->getItem();
     $methodCallObj = $defElsArray[1];
     $argsArray = $methodCallObj->getItem();
     $argObj = $argsArray[3];
     $constObj = $argObj->getItem();
     $constEl = getOriginalItemName($constObj->getItem());
     $tables[$j] = $constEl;
     //$newItems[$constEl] = $j++;
     $newItems[$j++] = $constEl;	 
    }
    //$newItems[STRING_NULL] = $j;
	$newItems[$j] = STRING_NULL;
   }
   else
    //$newItems[STRING_NULL] = 0;
    $newItems[0] = STRING_NULL;
   $intHtmlInputCtrl = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_0);
   $intHtmlInputCtrl->setDataFieldDomainValueByName(FIELD_LISTA_TABELLE,$newItems);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();  
 }
 elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
 {
  $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_4)->getInterfacesContainer()->deleteItem(1);
  $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_4)->getInterfacesContainer()->deleteItem(1);
  $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_4)->getInterfacesContainer()->deleteItem(1);
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