<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("importEnabledDbs.def.php");
require_once("Creator.tra.php");


date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"import");
define('THIS_PAGE',"import.php");

class Cheope_ns_import_op_page extends Cheope_ns_page
{
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
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>"); 
  }
 }

 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
 
 function checkIfIsFree(string $actTable):int|bool
 {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir =  $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP . "db_objects_definition_def" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
    
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $free=1;
   if(count($sectionsArray)>0)
   {
    $sectionObj = $sectionsArray[0];
    $defsArray = $sectionObj->getItem();
    foreach($defsArray as $ind=>$defObj)
    {
     $defElsArray = $defObj->getItem();
     $methodCallObj = $defElsArray[1];
     $argsArray = $methodCallObj->getItem();
     $argObj = $argsArray[2];
     $constObj = $argObj->getItem();
     $constObjItem = $constObj->getItem();
     $constEl = getOriginalItemName($constObjItem);
     if($constEl == ucFirst(strToLower($actTable)))
      $free=0;
    }
   }
   return $free;   	
 }
   
 function putBody():void
 {
 	global $importEnabledDbs;
 	//global $dbStructTree;
 	 	
 	$interfaces = $this->getInterfacesContainer(); 	 	
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)
  {
   $scope = $_SESSION[SESSION_VAR_ACTIVE_APP] . STRING_BACKSLASH . FW_DIR ;
   
   $intHtmlPTag = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);

   eval("\$activeDb = " . "\\" . $_SESSION[SESSION_VAR_ACTIVE_APP] . "\\" . FW_DIR . "\\ACTIVE_DB;");
   eval("\$sqlServerDb = " . "\\" . $_SESSION[SESSION_VAR_ACTIVE_APP] . "\\" . FW_DIR . "\\SQLSRV_DB;");

   if (! in_array($activeDb,$importEnabledDbs))
   {
    $intHtmlPTag->setTagBody(MSG_28);
   }
   else
   {
    try
    {
    	$testConnection = $scope . STRING_BACKSLASH . "testConnection";
   		$testConnection();
    }
    catch(\Exception $e)
    {
   		$intHtmlPTag->setTagBody(MSG_36 . 
   		STRING_SPACE . STRING_MINUS . STRING_SPACE . 
   		$e->getMessage());
   		$appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   		$interfaceButtonTag2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL,OP_NONE,NUM_3);
      $interfaceButtonTag2->setTagBody(LABEL_TEST_CONNECTION);
      $attribs = array("onclick"=>"window.location='" .
      HTTP_ROOT . URL_SEP . getDocumentRoot() . URL_SEP .
      $appName  . URL_SEP . PAGE_PARAMETRI_DB . "'");
   		$interfaces->setElement($interfaceButtonTag2,9);
      $interfaceButtonTag2->setAttribs($attribs);
      $intFrame2 = $interfaces->getInterfaceByShortName('Frame_2');
      $intFrame2->getInterfacesContainer()->setElement($interfaceButtonTag2,1);
    }
    if(! isset($e))
    switch($activeDb)
    {
     case SQLSRV:
      $getAllDataByQuery = $scope . STRING_BACKSLASH . "getAllDataByQuery";
      $tables = $getAllDataByQuery("Select name from " .
      $sqlServerDb . STRING_POINT . "sys" . STRING_POINT . "tables");
      foreach($tables as $ind=>$table)
      {
      	$tables[$ind]["free"] = $this->checkIfIsFree($table["name"]);
      }
      $intTable = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SIMPLE_TABLE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
      $intTable->setDataFields(array("name","obj_1"));
      $intTable->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ));
      $intTable->setDataSource($tables);
      $intTable->setTableHeaders(array(LABEL_NOMI_TABELLE,LABEL_SCEGLI));
      $intTable->setWidth("300");
      $intTable->setColumnsDims(array("150","150"));
      $intTable->setColumnsHeaderAlignes(array("left","center"));
      $intTable->setColumnsAlignes(array("left","center"));
      $intTable->setFieldsCssClasses(array("name"=>"name","obj_1"=>"obj_1"));
      $intTable->setInheritData(true);
      $intPhpDataFragment = Creator::create(Interfaces_info::INT_PHP_DATA_FRAGMENT,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
      $intPhpDataFragment->setDataFields(array("free","name"));
      $intPhpDataFragment->setPhpFragment("\$htmlWriter = \$this->getHtmlWriter();\$free=#FREE#;\$name='#NAME#';" .
      "\$intInput = new Cheope_ns\\fw\\Html_input_tag('',2);" .
      "\$attribs=array('type'=>'checkbox','class'=>'choose', 'value'=>\$name);" .
      "\$intInput->setAttribs(\$attribs);if(\$free==0){\$htmlWriter->putGenericHtmlString('" . 
      MSG_29 . "');}\$intInput->putData();");
      $intTable->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE,$intPhpDataFragment));
      $intFrame = $interfaces->getInterfaceByShortName('Frame_2');
      $intFrame->getInterfacesContainer()->setElement($intTable,0);
      $intButtonTag = $interfaces->getInterfaceByShortName('Button_1');
      $attribs = $intButtonTag->getAttribs();
      $attribs['onclick'] = $attribs['onclick'] . "var ids = '';" .
      "\$('.choose').each(function(){if(this.checked){if(ids=='')ids=this.value;else ids=ids + ';' + this.value}});" .
      "if(ids!=''){ajaxHandler.serverCall('ajax_handler.php','sqlSrvImport',ids,'text');}";
      $intButtonTag->setAttribs($attribs);
      break;
    }
   }
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_3)->getInterfacesContainer()->deleteItem(1);
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