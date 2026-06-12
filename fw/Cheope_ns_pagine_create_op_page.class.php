<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"pagine_create");
define('THIS_PAGE',"pagine_create.php");

class Cheope_ns_pagine_create_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
 	parent::putLinkTags();
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
 
 function putBody():void
 {
 	global $dbStructTree;
 	
 	$interfaces = $this->getInterfacesContainer();

  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;

   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $files = scandir($appXmlDir);
   $interfacesFiles = array(STRING_NULL=>STRING_NULL);
   $pagesFiles = array(STRING_NULL=>STRING_NULL);
   $i=0;
   $j=0;
   foreach($files as $ind=>$file)
   {
   	$fileItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   	$num = count($fileItems2);
   	if(($num==1) && (! is_dir($file)))
   	{
   	 $fileItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	 $num1 = count($fileItems);	
   	 if($fileItems[1]!=STRING_NULL)
   	  if(Xml_interface_file_analyzer::is_free_interface_file($appXmlDir . DIR_SEP . $file))
   	  {
   	   if($fileItems[2] !== "html_page")
   	   $interfacesFiles[$file] = $file;
   	   if((! in_array($fileItems[1],$pagesFiles))&&($fileItems[2]=="html_page"))
   	    $pagesFiles[$fileItems[1]]=$fileItems[1];
     	  $i++;
   	  }
   	  elseif ($num1 == 5)
   	  {
   	   if($fileItems[2] !== "html_page")
   	   $interfacesFiles[$fileItems[0] . self::INTERFACE_NAME_SEP . $fileItems[1] . self::INTERFACE_NAME_SEP .
   	   $fileItems[2] . self::INTERFACE_NAME_SEP . $fileItems[3] . self::INTERFACE_NAME_SEP . $fileItems[4]] = $file;
   	   if((! in_array($fileItems[1],$pagesFiles))&&($fileItems[2]=="html_page"))
   	    $pagesFiles[$fileItems[1]]=$fileItems[1];
   	   $i++;
      }
      elseif($num1 == 6)
      {
       if($fileItems[2] !== "html_page")
   	   $interfacesFiles[$fileItems[0] . self::INTERFACE_NAME_SEP . $fileItems[1] . self::INTERFACE_NAME_SEP .
   	   $fileItems[2] . self::INTERFACE_NAME_SEP . $fileItems[3] . self::INTERFACE_NAME_SEP . $fileItems[4] .
   	   self::INTERFACE_NAME_SEP . $fileItems[5]]= $file;
   	   if((! in_array($fileItems[1],$pagesFiles))&&($fileItems[2]=="html_page"))
   	    $pagesFiles[$fileItems[1]]=$fileItems[1];
   	   $i++;
      }
     }
   }
   $intForm = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_FORM_2,NUM_1); 	
   $intForm->setDataFieldDomainValueByName(FIELD_INTERFACCIA_RADICE,$interfacesFiles);
   $intForm->setDataFieldDomainValueByName(FIELD_NOME_PAGINA,$pagesFiles);
   
   $intButton = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_1);
   $attribs = $intButton->getAttribs();
   $attribs = array("onclick"=>"var dirName = '" . $_SESSION[SESSION_VAR_ACTIVE_APP] .
   "';if(dirName!='')window.open('" . HTTP_ROOT . URL_SEP . getDocumentRoot() . URL_SEP .
   "' + dirName + '"  . URL_SEP . 
   "' + \$('#Nome_pagina').get(0).value + '.php');");
   $intButton->setAttribs($attribs);   
   
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