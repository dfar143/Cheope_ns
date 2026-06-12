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
define('DEFAULT_PAGE_NAME',"db_parameters");
define('THIS_PAGE',"db_parameters.php");

class Cheope_ns_db_parameters_op_page extends Cheope_ns_page
{
 use Creator;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
	//spl_autoload_register(array($this, 'autoload'));
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
  parent::putClientScriptIncludeCode();
  $htmlWriter = $this->getHtmlWriter();
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
  putActiveApp($htmlWriter);
 }
 
 function putInnerInterfaces(string $actActiveType=STRING_NULL,
 array $actSectionsArray):void
 {
  $interfaces = $this->getInterfacesContainer();

   $blockDefObj1 = $actSectionsArray[1];
   //$ifElseArray = $ifElseObj->getItem();
   //$blockDefObj1 = $ifElseArray[1];
 //  $blockDefObj1->setBrackets(false);
   $blockDefArray1 = $blockDefObj1->getItem();
   $sectionObj1 = $blockDefArray1[1];
   $refArray1 = $sectionObj1->getItem();
   $refObj = $refArray1[0];
   $sectionsArray1 = $refObj->getItem();
   $sectionsObj1 = $sectionsArray1[0];
   $sectionArray1 = $sectionsObj1->getItem();
   $sectionObj2 = $sectionArray1[0];
   $defArray1 = $sectionObj2->getItem();
   $i=0;
   $types = array();
   foreach($defArray1 as $ind=>$defObj1)
   {
   	$functionArray1 = $defObj1->getItem();
   	$functionObj1 = $functionArray1[0];
   	$argArray1 = $functionObj1->getItem();
   	$argObj1 = $argArray1[1];
   	$stringObj1 = $argObj1->getItem();
   	$typeStr = $stringObj1->getItem();
   	$type = strToUpper($typeStr);
   	$types[$i] = $type;
   	if($type == $actActiveType)
   	 $j=$i;
   	$i++;
   }
   $interfaceForm1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,
   Interfaces_info::INT_HTML_TAGS,NUM_0);
   $interfaceSelectTag1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL,OP_NONE);
   $interfaceSelectTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);

   $interfaceOptionTag1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL,OP_NONE); 
   $interfaceSelectTagContainer1->add($interfaceOptionTag1);  
   for($k=0;$k<=$i-1;$k++)
   {
   	$interfaceOptionTag1 = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL,OP_NONE);   	
   	$interfaceOptionTag1->setTagBody($types[$k]);
   	$attribs = array("value"=>$types[$k]);
   	if($types[$k] == $actActiveType)
   	 $attribs["selected"] = "selected";
   	$interfaceOptionTag1->setAttribs($attribs);
   	$interfaceSelectTagContainer1->add($interfaceOptionTag1);
   }
   
   $inputHidden = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL,OP_NONE);
   $attribs = array("type"=>"hidden","name"=>"Par1","id"=>"Par1");
   $inputHidden->setAttribs($attribs);
   
   $attribs = array("id" =>"select_1","name" =>"select_1",
   "onchange"=>"if(this.value!='') select_1_onChange(this);");
   $interfaceSelectTag1->setAttribs($attribs);
   $interfaceSelectTag1->setInterfacesContainer($interfaceSelectTagContainer1);
   $interfaceFormContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $interfaceFormContainer1->add($inputHidden);
   $interfaceFormContainer1->add($interfaceSelectTag1);
  
   $sectionObj2 = $blockDefArray1[$j+3];
   $refArray2 = $sectionObj2->getItem();
   $refObj1 = $refArray2[0];
   $sectionsArray2 = $refObj1->getItem();
   $sectionsObj2 = $sectionsArray2[0];
   $sectionArray2 = $sectionsObj2->getItem();
   $sectionObj2 = $sectionArray2[0];
   $defArray2 = $sectionObj2->getItem();
   $br = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,OP_NONE);
   $interfaceFormContainer1->add($br);
   foreach($defArray2 as $ind=>$defObj2)
   {
   	$functionArray2 = $defObj2->getItem();
   	$functionObj2 = $functionArray2[0];
   	if(get_class($functionObj2)==Classes_info::FUNCTION_CALL_ITEM_CLASS)
   	{
   	 $argArray2 = $functionObj2->getItem();
   	 $argObj2 = $argArray2[0];
   	 $stringObj2 = $argObj2->getItem();
   	 $strPar = $stringObj2->getItem(); 
   	 $strParItems1 = explode(STRING_POINT,$strPar);
   	 $strPar1 = $strParItems1[1];
   	 $strPar2 = str_replace(STRING_SINGLE_QUOTE,STRING_NULL,$strPar1);
   	 $strPar3 = str_replace(STRING_BACKSLASH,STRING_NULL,$strPar2);
   	 
   	 $strParItems = explode(VAR_SEP,$strPar3);
   	 $num = count($strParItems);
   	 $strParName = ucFirst(strToLower($strParItems[1]));
   	 for($i=2;$i<=$num-1;$i++)
   	 { 
   		$strParName = $strParName . STRING_SPACE . strToLower($strParItems[$i]);
   	 }   	
   	 $br = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,OP_NONE); 
   	 $interfaceFormContainer1->add($br);
   	 $label = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL,OP_NONE);
   	 $label->setTagBody($strParName . ENTITY_SPACE . ENTITY_SPACE);
   	 $interfaceFormContainer1->add($label);
   	 $argObj3 = $argArray2[1];
   	 $stringObj3 = $argObj3->getItem();
   	 $strPar1 = $stringObj3->getItem();
   	 $ctrlType = $stringObj3->getName();
   	 if($ctrlType==STRING_AT)
   	 {
   	 	$input = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL,OP_NONE);
   	  $attribs = array("name"=>$strParName,"id"=>$strParName,"rows"=>"5","cols"=>"50");
   	  $input->setTagBody($strPar1);
   	 }
   	 else
   	 {
   	 	$input = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL,OP_NONE);
   	 	$attribs = array("name"=>$strParName,"id"=>$strParName,"type"=>"text",
   	 	"size"=>strlen($strPar1)+10,"value"=>$strPar1);
   	 }

   	 $input->setAttribs($attribs);
   	 $br = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,OP_NONE);
   	 $interfaceFormContainer1->add($input);
   	 $interfaceFormContainer1->add($br);
    }   
   }
   $interfaceFormContainer1->add($br); 
   $interfaceBt1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL,OP_NONE);
   $interfaceBt1->setTagBody(LABEL_SALVA_PARAMETRI);
   $attribs=array("type"=>"submit","onclick"=>"button_2_onClick()");
   $interfaceBt1->setAttribs($attribs);

   $interfaceFormContainer1->add($br);
   $interfaceBt2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL,OP_NONE); 
   $interfaceBt2->setTagBody(LABEL_VEDI_TUTTE_CONNESSIONI);
   $attribs=array("type"=>"button","id"=>"button_1","onclick"=>"button_1_onClick()");
   $interfaceBt2->setAttribs($attribs);
    
   $interfaceBt3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL,OP_NONE);  
   $interfaceBt3->setTagBody(LABEL_TEST_CONNECTION);
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $attribs=array("type"=>"button","onclick"=>
   "ajaxHandler.serverCall('ajax_handler.php','testConnection','','text')");
   $interfaceBt3->setAttribs($attribs);
   $interfaceFormContainer1->add($interfaceBt1);
   $interfaceFormContainer1->add($interfaceBt2);
   $interfaceFormContainer1->add($interfaceBt3);
   $interfaceForm1->setInterfacesContainer($interfaceFormContainer1);
 }
 
 
 function putBody():void
 {
 	global $dbStructTree;
 	
 	$interfaces = $this->getInterfacesContainer();
 	if(((isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
          ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))&&
          (! isset($_POST["select_1"]))))
 	{
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "db_const" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName); 
   $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP); 
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $blockDefObj1 = $sectionsArray[1];
   //$ifElseArray = $ifElseObj->getItem();
   //$blockDefObj1 = $ifElseArray[1];
   $blockDefArray1 = $blockDefObj1->getItem();
   $sectionObj1 = $blockDefArray1[1];
   $sectionArray = $sectionObj1->getItem();
   $sectionObj2 = $blockDefArray1[2];
   $defArray = $sectionObj2->getItem();
   $defObj = $defArray[0];
   $functionCallArray = $defObj->getItem();
   $functionCallObj = $functionCallArray[0];
   $argArray = $functionCallObj->getItem();
   $argObj = $argArray[1];
   $exprObj = $argObj->getItem();
   $activeTypeStr = $exprObj->getItem();
   $activeTypeStrItems = explode(STRING_BACKSLASH,$activeTypeStr);
   $activeType = $activeTypeStrItems[1];
   $this->putInnerInterfaces($activeType,$sectionsArray);      	 
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  }
  elseif(((isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
          ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))&&
          (isset($_POST["select_1"])) &&
          ($_POST["Par1"]==1)))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "db_const" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP);
   $xmlSerializer1->setResolveRef(false); 
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
  // $ifElseObj = $sectionsArray[1];
  // $ifElseArray = $ifElseObj->getItem();
   $blockDefObj1 = $sectionsArray[1];
  // $blockDefObj1->setBrackets(true);
   $blockDefArray1 = $blockDefObj1->getItem();
  // $sectionObj1 = $blockDefArray1[1];
  // $sectionArray = $sectionObj1->getItem();
   $sectionObj2 = $blockDefArray1[2];
   $defArray = $sectionObj2->getItem();
   $defObj = $defArray[0];
   $functionCallArray = $defObj->getItem();
   $functionCallObj = $functionCallArray[0];
   $argArray = $functionCallObj->getItem();
   $argObj = $argArray[1];
   $exprObj = $argObj->getItem();
   $oldActiveType = $exprObj->getItem();
   $oldActiveTypeItems = explode(STRING_BACKSLASH,$oldActiveType);
   $oldActiveType1 = $oldActiveTypeItems[1];
   $activeType = $_POST["select_1"];
   $exprObj->setItem("namespace" . STRING_BACKSLASH . $activeType);
   $xmlSerializer1->loadItems($allItems);
   $xmlSerializer1->saveData();
   $fileDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . FRAMEWORK_DIR;
   $xmlSerializer1->setResolveRef(true);
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
 // $ifElseObj = $sectionsArray[1];
 // $ifElseArray = $ifElseObj->getItem();
   $blockDefObj1 = $sectionsArray[1];
  // $blockDefObj1->setBrackets(true);
   $blockDefArray1 = $blockDefObj1->getItem();
   $sectionObj1 = $blockDefArray1[1];
   $sectionArray = $sectionObj1->getItem();
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . "db" . 
   FILE_NAME_ELEMENTS_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
   $fileDumper->dump(); 
   rename($fileDir . DIR_SEP . "db_op.fun.php",$fileDir . DIR_SEP .  
   strTolower($oldActiveType1) . VAR_SEP . "db_op.fun.php");
   rename($fileDir . DIR_SEP .  strTolower($activeType) . VAR_SEP . 
   "db_op.fun.php",$fileDir . DIR_SEP . "db_op.fun.php");
   $this->putInnerInterfaces($activeType,$sectionsArray);                 	 
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  }
  elseif(((isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
          ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))&&
          (isset($_POST["select_1"])) &&
          ($_POST["Par1"]==STRING_NULL)))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appFileName = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . "db_const" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer1 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName);
   $xmlSerializer1->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP); 
   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $blockDefObj1 = $sectionsArray[1];
   //$ifElseArray = $ifElseObj->getItem();
   //$blockDefObj1 = $ifElseArray[1];
  // $blockDefObj1->setBrackets(false);
   $blockDefArray1 = $blockDefObj1->getItem();
   $sectionObj1 = $blockDefArray1[1];
   $sectionArray = $sectionObj1->getItem();
   $sectionObj2 = $blockDefArray1[2];
   $defArray = $sectionObj2->getItem();
   $defObj = $defArray[0];
   $functionCallArray = $defObj->getItem();
   $functionCallObj = $functionCallArray[0];
   $argArray = $functionCallObj->getItem();
   $argObj = $argArray[1];
   $exprObj = $argObj->getItem();
   $activeType = $_POST["select_1"];

   //echo $activeType;
   
   $appFileName2 = PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP . strToLower($activeType) . VAR_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   $xmlSerializer2 = Creator::create(getClassNameForCreate(Classes_info::XML_ITEMS_SERIALIZER_CLASS),STRING_NULL,$appFileName2); 
   $xmlSerializer2->setAppDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR . DIR_SEP); 
   $xmlSerializer2->loadData();
   $allItems2 = $xmlSerializer2->getItems();
   $sectionsObj2 = $allItems2[0];
   $sectionArray2 = $sectionsObj2->getItem();
   $sectionObj2 = $sectionArray2[0];
   $defArray2 = $sectionObj2->getItem();
   $dataArray = array();
   $num = count($_POST);
   $l=0;
   next($_POST);
   next($_POST);
   for($k=2;$k<=$num-1;$k++)
   {
   	$dataArray[$l++] = current($_POST);
   	next($_POST);
   }    
   foreach($dataArray as $ind=>$val)
   { 
    $defObj2 = $defArray2[$ind];
    $functionArray2 = $defObj2->getItem();
    $functionObj2 = $functionArray2[0];
    $argArray2 = $functionObj2->getItem();
    $argObj2 = $argArray2[1];
    $stringObj2 = $argObj2->getItem();
    $stringObj2->setItem($dataArray[$ind]);
   }
   $xmlSerializer2->loadItems($allItems2);
   $xmlSerializer2->saveData();

   $xmlSerializer1->loadData();
   $allItems = $xmlSerializer1->getItems();
   $sectionsObj = $allItems[0];
   $sectionsArray = $sectionsObj->getItem();
   $blockDefObj1 = $sectionsArray[1];
   //$ifElseArray = $ifElseObj->getItem();
   //$blockDefObj1 = $ifElseArray[1];
  // $blockDefObj1->setBrackets(false);
   $blockDefArray1 = $blockDefObj1->getItem();
   $sectionObj = $blockDefArray1[1];
   $sectionArray = $sectionObj->getItem();
 
   $fileDumper = Creator::create(getClassNameForCreate(Classes_info::FILE_DUMPER_CLASS),STRING_NULL,$allItems[0]);
   $fileDumper->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);  
   $fileDumper->setFileName(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FRAMEWORK_DIR . DIR_SEP . "db" . 
   FILE_NAME_ELEMENTS_SEP . "const" .
   FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
   $fileDumper->dump();
   
   $this->putInnerInterfaces($activeType,$sectionsArray);

   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  }
  elseif(((isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
          ($_SESSION[SESSION_VAR_ACTIVE_APP] != STRING_NULL))&&
          ($_GET["Par1"]=='test')))
  {
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData(); 
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && 
  $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_2)->getInterfacesContainer()->deleteItem(1);
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