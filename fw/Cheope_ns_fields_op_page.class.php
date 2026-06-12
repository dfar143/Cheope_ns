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
define('DEFAULT_PAGE_NAME',"fields");
define('THIS_PAGE',"fields.php");


class Cheope_ns_fields_op_page extends Cheope_ns_page
{
 use Creator;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
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
  
 function putClientScriptIncludeCode():void
 {
 	$interfaces = $this->getInterfacesContainer();
 	$htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteItem(17);
   /*$interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);*/
   /*$int_iter = $interfaces->create();
   $int_iter->reset();
   $i=0;
   while($int_iter->hasMore())
   {
	 $int = $int_iter->current();
	 echo $i++;
	 echo $int->getType();
	 echo $int->getNum();
	 echo "<br>";
	 $int_iter->next();
   }*/
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }

  
 function putBody():void
 {
 	//global $importEnabledDbs;
 	
 	$fieldTypesConsts = array(FIELD_TYPE_BIG_STRING,FIELD_TYPE_BOOLEAN,FIELD_TYPE_DATE,
  FIELD_TYPE_FLOAT,FIELD_TYPE_INTEGER,FIELD_TYPE_STRING);
 	$interfaces = $this->getInterfacesContainer();
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
 	{
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir =  $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR . 
   DIR_SEP ."db_objects_definition_def" 
   . FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;

   $xmlSerializer = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);    
   $xmlSerializer->loadData();
   $allItems = $xmlSerializer->getItems();
   $sectionsObj = $allItems[0];
   $sectionArray = $sectionsObj->getItem();
   if(count($sectionArray)>0)
   {
    $sectionObj = $sectionArray[0];
    $defArray = $sectionObj->getItem();
    $j=0;
    $newItems = array();
    if((count($defArray)>0) && is_a($defArray[0],Classes_info::DEF_ITEM_CLASS)) 
    foreach($defArray as $ind=>$defObj)
    {
  	 $defElsArray = $defObj->getItem();
  	 $methodCallObj = $defElsArray[1];
  	 $argsArray = $methodCallObj->getItem();
  	 $argObj = $argsArray[3];
  	 $constObj = $argObj->getItem();
  	//
  	// Il nome (costante) delle tabelle è nella forma TABELLA . VAR_SEP . <nomeTabella>
  	//
  	 $constEl = getOriginalItemName($constObj->getItem());  	
  	 //$newItems[$constEl] = $j++; 
	 $newItems[$j++] = $constEl;
    }
    $intForm = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1);
    $intForm->setDataFieldDomainValueByName(FIELD_LISTA_TABELLE,$newItems);
   }
   //$fieldTypesArray[STRING_NULL]=0;
   $fieldTypesArray[0]=STRING_NULL;
   $k=0;
   foreach($fieldTypesConsts as $ind=>$val)
   {
   // $fieldTypesArray[strToUpper($val)] = $k+1;
	$fieldTypesArray[$k+1] = strToUpper($val);
    $k++;	
   }
   $intForm = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_2);
   $intForm->setDataFieldDomainValueByName(FIELD_TIPI_CAMPO,$fieldTypesArray);
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();  
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_5)->getInterfacesContainer()->deleteItem(1);
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_5)->getInterfacesContainer()->deleteItem(1);
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_5)->getInterfacesContainer()->deleteItem(1);
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