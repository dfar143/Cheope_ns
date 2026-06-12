<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"menus");
define('THIS_PAGE',"menus.php");
define('INTERFACE_NAME_SEP',Xml_interface_serializer::INTERFACE_NAME_SEP);

class Cheope_ns_menus_op_page extends Cheope_ns_page
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
  }
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])) 
  {
   putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->put("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.BorderContainer\")</script>"); 
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.StackContainer\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.layout.ContentPane\")</script>");
   $htmlWriter->put("<script>dojo.require(\"dijit.form.TextBox\")</script>");
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
   $intCtrl1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_0); 	
   $intCtrl1->setDataFieldDomainValueByName(FIELD_PAGINE,$pagesFiles);
   $intCtrl2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_1); 	
   $intCtrl2->setDataFieldEvents(array("single_level_menu_onChange(this)")); 
   $intCtrl3 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_3); 	
   $intCtrl3->setDataFieldDomainValueByName(FIELD_MULTI_PAGINE,$pagesFiles);
   $intCtrl4 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_4); 	
   $intCtrl4->setDataFieldEvents(array("multi_level_menu_onChange(this)")); 

   $intFiles = array(STRING_NULL=>STRING_NULL);
   foreach($files as $ind=>$file)
   {
   	$fileItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   	$num = count($fileItems2);
   	if((($num==1)&&(! is_dir($file)))||(($num==2)&&(! is_dir($file)&&($fileItems2[1]==XML_SUFFIX))))
    {
   	 $fileItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	 $num1 = count($fileItems);
   	 if(Xml_interface_file_analyzer::is_free_interface_file($appXmlDir . DIR_SEP . $file))
   	 {
    	if((in_array($fileItems[3],array(Interfaces_info::INT_NLEVELSMENU,
    	 Interfaces_info::INT_LEVEL_MENU,Interfaces_info::INT_LEVEL_MENU_2))) &&(! in_array($file,$intFiles))&&
    	 ($fileItems[0]!=STANDARD_MOD_PREFIX)&&($fileItems[1]==STRING_NULL))
   	    $intFiles[$file]=$file;
   	 }
   	 elseif($num1 == 6)
   	 {
    	 if((in_array($fileItems[3],array(Interfaces_info::INT_NLEVELSMENU,
    	 Interfaces_info::INT_LEVEL_MENU,Interfaces_info::INT_LEVEL_MENU_2))) &&(! in_array($file,$intFiles))&&
    	 ($fileItems[0]!=STANDARD_MOD_PREFIX)&&($fileItems[1]==STRING_NULL))
   	    $intFiles[$file]=$file;
     }
    }
   }
   $intCtrl5 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_6);
   $intCtrl5->setDataFieldDomainValueByName(FIELD_ARRAY_SUBMENU,$intFiles);   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $int_iter = $interfaces->create();
   $int_iter->last();
   $int = $int_iter->current();
   $int->getInterfacesContainer()->deleteItem(1);
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