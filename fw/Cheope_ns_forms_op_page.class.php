<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"forms");
define('THIS_PAGE',"forms.php");

class Cheope_ns_forms_op_page extends Cheope_ns_page
{
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
 function putLinkTags():void
 {
 	parent::putLinkTags();
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {

  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  if(! isset($_SESSION[SESSION_VAR_ACTIVE_APP])||(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)))
  {
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $interfaces->deleteItem(5);
   $int_iter = $interfaces->create();
  /* $int_iter->reset();
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
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP] !== STRING_NULL))
  {
   putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . JS_SUBMODAL);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.TooltipDialog\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }
 
 function putActiveApp():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  putActiveApp($htmlWriter);
 }
 
 function initPutData():array
 {
 }
   
 function putBody():void
 {
 	global $dbStructTree;
 	global $dbQueriesContainer;
 	
 	$interfaces = $this->getInterfacesContainer();
 
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP] !== STRING_NULL)
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
   $intCtrl2->setDataFieldEvents(array("forms_onChange(this)")); 

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
    	if((in_array($fileItems[3],array(Interfaces_info::INT_FORM_SECTION))) &&(! in_array($file,$intFiles))&&
    	 ($fileItems[0]!=STANDARD_MOD_PREFIX)&&($fileItems[1]==STRING_NULL))
   	    $intFiles[$file]=$file;
   	 }
   	 elseif($num1 == 6)
   	 {
    	 if((in_array($fileItems[3],array(Interfaces_info::INT_FORM_SECTION))) &&(! in_array($file,$intFiles))&&
    	 ($fileItems[0]!=STANDARD_MOD_PREFIX)&&($fileItems[1]==STRING_NULL))
   	    $intFiles[$file]=$file;
     }
    }
   }
   $intCtrl3 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_1); 	
   $intCtrl3->setDataFieldDomainValueByName(FIELD_FORMS,$intFiles);   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     
  } 
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
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