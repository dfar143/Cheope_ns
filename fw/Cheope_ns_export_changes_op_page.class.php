<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("filesystem.fun.php");
require_once("Creator.tra.php");


date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"export_changes");
define('THIS_PAGE',"export_changes.php");


class Cheope_ns_export_changes_op_page extends Cheope_ns_page
{
 use Creator;
 
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
   $interfaces->deleteItem(20);
   $interfaces->deleteItem(20);
   $interfaces->deleteItem(20);
   $interfaces->deleteItem(20);
   $interfaces->deleteItem(20);
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
 	 putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){document.body.className+=' nihilo';});</script>"); 
  }
 }

 
  function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
   
 function putBody():void
 {
 	
 	$stdAppFiles = array("ajax_handler.php","model_ajax_handler.php","preview.php",
 	"loader.php");	
 	$interfaces = $this->getInterfacesContainer();
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)
  {
   $intTabs = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TABS,NUM_1);
   $intTabsContainer = $intTabs->getInterfacesContainer();
   $intSimpleTable1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_1);
   $interfaceFrame3 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FRAME,NUM_3);
   $intSimpleTable2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_2);
   $interfaceFrame4 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FRAME,NUM_4);
   $intSimpleTable3 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_SIMPLE_TABLE,NUM_3);
   $interfaceFrame5 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FRAME,NUM_5);
   if((isset($_GET[PAR]))&&($_GET[PAR]==XML_DIR))
   {
    $intTabs->setSelectedTab(1);
    $intTabsContainer->deleteItem(0);
    $intTabsContainer->add($interfaceFrame4);
    $intButton = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);
    $intButton->setAttribs(array("id"=>"button_1","onClick"=>"button_1_onClick('2')"));
   }
   elseif((isset($_GET[PAR]))&&($_GET[PAR]==INTERFACES_DIR))
   { 
   	$intDivDec1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_FIELDSET_DECORATOR,NUM_0);
    $intTabs->setSelectedTab(2);
    $intTabsContainer->deleteItem(0);
    $intTabsContainer->add($intDivDec1);
    $intTabsContainer->add($interfaceFrame5);
    $intButton = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);
    $intButton->setAttribs(array("id"=>"button_1","onClick"=>"button_1_onClick('3')"));
    $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
    $pages = Interfaces_model::getAllPages($appName);
    $intSelect1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_6);
    $intSelectCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
    $intOption = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
    $intOption->setAttribs(array("label"=>STRING_NULL,"value"=>STRING_NULL));
    $intSelectCont->add($intOption);
    foreach($pages as $page)
    {
     $intOption = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
     $intOption->setAttribs(array("label"=>$page,"value"=>$page));
     $intSelectCont->add($intOption);
    }
    $intSelect1->setInterfacesContainer($intSelectCont);   
   }
   else
   { 
    $intTabs->setSelectedTab(0);
    $intTabsContainer->deleteItem(0);
    $intTabsContainer->add($interfaceFrame3);
    $intButton = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);
    $intButton->setAttribs(array("id"=>"button_1","onClick"=>"button_1_onClick('1')"));
   }
    
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $dir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . FW_DIR;
   $files = scandir($dir);
   $exportingFiles1 = array();
   foreach($files as $ind=>$file)
   { 
    $fileItems =explode(STRING_POINT,$file);
    $suffix = $fileItems[count($fileItems)-1];
    $dateModified = date('Y/m/d H:m:s',filemtime($dir . DIR_SEP . $file));   
    if((! is_dir($file))&&($suffix ==APP_LANGUAGE)&&(! in_array($file,$stdAppFiles)))
    {
     $exportingFiles1[] = array(FIELD_NAME=>$file,
     FIELD_DATE_MODIFIED=>$dateModified);
    }
   }
   $dir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . XML_DIR;
   $files = scandir($dir);
   $exportingFiles2 = array();
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(STRING_POINT,$file);
    $suffix = $fileItems[count($fileItems)-1];
    $dateModified = date('Y/m/d H:m:s',filemtime($dir . DIR_SEP . $file));   
    if((! is_dir($file))&&($suffix ==XML_SUFFIX)&&(! in_array($file,$stdAppFiles)))
    {
     $exportingFiles2[] = array(FIELD_NAME=>$file,
     FIELD_DATE_MODIFIED=>$dateModified);
    }
   }
   $dir = PREVIOUS_DIR . DIR_SEP . $appName . DIR_SEP . INTERFACES_DIR;
   $files = scandir($dir);
   $exportingFiles3 = array();
   foreach($files as $ind=>$file)
   {
    $fileItems = explode(STRING_POINT,$file);
    $suffix = $fileItems[count($fileItems)-1];
    $dateModified = date('Y/m/d H:m:s',filemtime($dir . DIR_SEP . $file));   
    if((! is_dir($file))&&($suffix != 'bak')&&(! in_array($file,$stdAppFiles)))
    {
     $exportingFiles3[] = array(FIELD_NAME=>$file,
     FIELD_DATE_MODIFIED=>$dateModified);
    }
   }
   $intSimpleTable1->setDataSource($exportingFiles1); 
   $intSimpleTable2->setDataSource($exportingFiles2); 
   $intSimpleTable3->setDataSource($exportingFiles3);    	
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $intTabs = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TABS,NUM_1);
   if(isset($_GET[PAR]) && ($_GET[PAR]==XML_DIR))
    $intTabs->setSelectedTab(1);
   else
    $intTabs->setSelectedTab(0);
   $interfaces->getInterfaceByShortName("Frame_1")->getInterfacesContainer()->deleteItem(1);
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