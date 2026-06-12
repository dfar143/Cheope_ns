<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");
require_once("Creator.tra.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"connections");
define('THIS_PAGE',"connections.php");


class Cheope_ns_connections_op_page extends Cheope_ns_page
{
 use Creator;
 
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
  {
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }

 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter); }
 
 function putLinkTags():void
 {
  $htmlWriter = $this->getHtmlWriter();	 
  parent::setAllIeCssPatchEnabled(true);
  parent::setAllIeCssPatchModule(THIS_DIR . DIR_SEP . CSS_DIR . DIR_SEP . "connections_all_ie_css_patch_module.css");
  parent::putLinkTags();
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer();
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
 	&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	{
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_defines_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $sectionObj = $sectionsArray[0];
   $sectionArray = $sectionObj->getItem();
   $num = count($sectionArray);
   $newItems = array();
   $j=0;
   for($i=1;$i<=$num-1;$i++)
   {
   	$defObj = $sectionArray[$i];
   	$defArray = $defObj->getItem();
   	$functionCallObj = $defArray[0];
   	$functionCallArray = $functionCallObj->getItem();
   	$argObj = $functionCallArray[1];
   	$stringObj = $argObj->getItem();
   	//$newItems[$stringObj->getItem()]=$j++;
	$newItems[$j++]=$stringObj->getItem();
   }
   //$newItems[STRING_NULL] = $j;
   $newItems[$j] = STRING_NULL;
   $intForm = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
   $intForm->setDataFieldDomainValueByName(FIELD_LISTA_CONNECTIONS,$newItems);
   
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "connections_definition_def" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->loadData();
   $allItems1 = $xmlSerializer1->getItems();
   $sectionsObj1 = $allItems1[0];
   $sectionsArray1 = $sectionsObj1->getItem();
   if(count($sectionsArray1)>0)
   {
    $sectionObj1 = $sectionsArray1[0];
    $sectionArray1 = $sectionObj1->getItem(); 
    foreach($sectionArray1 as $ind=>$val)
    {  
     $defObj1 = $sectionArray1[$ind];
     $defArray1 = $defObj1->getItem();
     $selectorObj = (isset($defArray1[1])?$defArray1[1]:null);
     if(is_a($selectorObj,Classes_info::METHOD_CALL_ITEM_CLASS))
     {
      $methodCallObj = $selectorObj;
      $methodCallArray = $methodCallObj->getItem();
      $argObj = $methodCallArray[1];
      $stringObj = $argObj->getItem();
      $db = $stringObj->getItem();
      $dbItems = explode(VAR_SEP,$db);
      $dbName = strToUpper($dbItems[0]);
     }
    }
   }
   else
   {
    $dbName=STRING_NULL;
    $sectionArray1 = array();
   }
   
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
    DIR_SEP . "db_type_const" .
    FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer2->loadData();
   $allItems2 = $xmlSerializer2->getItems();
   $sectionsObj2 = $allItems2[0];
   $sectionsArray2 = $sectionsObj2->getItem();
   $sectionObj2 = $sectionsArray2[0];
   $sectionArray2 = $sectionObj2->getItem();   
   $newDbTypes = array();
   //$newDbTypes[$dbName]=0;
   $newDbTypes[0]=$dbName;
   //echo $dbName;
   $j=1;
   foreach($sectionArray2 as $ind=>$defObj2)
   {
   	$defArray2 = $defObj2->getItem();
   	$functioncallObj2 = $defArray2[0];
   	$functionCallArray2 = $functioncallObj2->getItem();
   	$argObj2 = $functionCallArray2[1];
   	$stringObj2 = $argObj2->getItem();
   	$aDbName = $stringObj2->getItem();
	//echo $aDbName;
   	if($dbName!=strToUpper($aDbName))
   	 //$newDbTypes[strToUpper($aDbName)] = $j++;
     $newDbTypes[$j++] = strToUpper($aDbName);
   }
   $intForm->setDataFieldDomainValueByName(FIELD_AVAILABLE_DBS,$newDbTypes);
   
   $intDiv1 = $intForm->getDataFieldDomainValueByName(FIELD_CONNECTION_BODY);
   $intDivCont = $intDiv1->getInterfacesContainer();
   
   foreach($sectionArray1 as $ind=>$defObj1)
   {
   	$defArray1 = $defObj1->getItem();
   	$selectorObj = (isset($defArray1[1])?$defArray1[1]:null); 
   	if(is_a($selectorObj,Classes_info::STRING_ITEM_CLASS))
    {
     $varObj1 = $defArray1[0];
     $varName = $varObj1->getItem();
     $intLabel = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
     $attribs = array("id"=>$varName . VAR_SEP . "label","for"=>$varName . VAR_SEP . "id");
     $intLabel->setAttribs($attribs);
     $intLabel->setTagBody(ucFirst(strToLower($varName)) . ENTITY_SPACE . ENTITY_SPACE);
     $stringObj1 = $defArray1[1];
     $varValType = $stringObj1->getName();
     $varVal = $stringObj1->getItem();
     $intBr = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
     if($varValType==STRING_AT)
     {
     	$intText = Creator::create(getClassNameForCreate(Classes_info::HTML_TEXTAREA_TAG_CLASS),STRING_NULL);
     	$attribs = array("id"=>$varName . VAR_SEP . "id",
     	"name"=>$varName,"cols"=>40,"rows"=>5);
     	$intText->setAttribs($attribs);
     	$intText->setTagBody($varVal);
     	$intDivCont->add($intLabel);
     	$intDivCont->add($intText);
     	$intDivCont->add($intBr);
     	$intDivCont->add($intBr);
     }
     else
     {
      $intInput = Creator::create(getClassNameForCreate(Classes_info::HTML_INPUT_TAG_CLASS),STRING_NULL);
    	$attribs = array("id"=>$varName . VAR_SEP . "id",
     	"name"=>$varName,"value"=>$varVal,"type"=>"text","size"=>strlen($varVal)+10);
     	$intInput->setAttribs($attribs);
     	$intDivCont->add($intLabel);
     	$intDivCont->add($intInput);
     	$intDivCont->add($intBr);
     	$intDivCont->add($intBr);
     }
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