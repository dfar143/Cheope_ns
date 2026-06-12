<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"inspect");
define('THIS_PAGE',"inspect.php");
define('INTERFACE_NAME_SEP',Xml_interface_serializer::INTERFACE_NAME_SEP);

class Cheope_ns_inspect_op_page extends Cheope_ns_page
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
  $htmlWriter->putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  "subModal" . STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
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
  putActiveApp($htmlWriter);
 }
 
 function getInterfacesFiles(string $actAppXmlDir):array
 {
 	 $appXmlDir = $actAppXmlDir;
   $files = scandir($appXmlDir);
   $retVal = array();
   $interfacesFiles = array(STRING_NULL=>STRING_NULL);
   $pagesFiles = array(STRING_NULL=>STRING_NULL);
   $i=0;
   $j=0;
   foreach($files as $ind=>$file)
   {
   	$fileItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   	$num = count($fileItems2);
   	if((($num==1) && (! is_dir($file)))||(($num==2)&&(! is_dir($file))&&($fileItems2[1]==XML_SUFFIX)))
   	{
   	 $fileItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	 if(! in_array($fileItems[1],$pagesFiles))
   	     $pagesFiles[$fileItems[1]]=$fileItems[1];
   	 $num1 = count($fileItems);
   	 if($fileItems[1]==STRING_NULL)
   	 if(Xml_interface_file_analyzer::is_free_interface_file($appXmlDir . DIR_SEP . $file))
   	 {
     	$interfacesFiles[$file]=$file;
     	$i++;
   	 }
   	 elseif((($num1==5) || ($num1==6)) && ($fileItems[0]!=STANDARD_MOD_PREFIX))
   	 { 
   	  if($num1 == 5)
   	  {
   	   $interfacesFiles[$fileItems[0] . INTERFACE_NAME_SEP . $fileItems[1] . INTERFACE_NAME_SEP .
   	    $fileItems[2] . INTERFACE_NAME_SEP . $fileItems[3] . INTERFACE_NAME_SEP . $fileItems[4]] = $file;
   	   $i++;
      }
      elseif($num1 == 6)
      {
   	   $interfacesFiles[$fileItems[0] . INTERFACE_NAME_SEP . $fileItems[1] . INTERFACE_NAME_SEP .
   	   $fileItems[2] . INTERFACE_NAME_SEP . $fileItems[3] . INTERFACE_NAME_SEP . $fileItems[4] .
   	   INTERFACE_NAME_SEP . $fileItems[5]]= $file;
   	   $i++;
      }
     }
    }
   }
  $retVal[0] = $interfacesFiles;
  $retVal[1] = $pagesFiles;
  return $retVal;
 }
 
  function getInterfacesFilesByPage(string $actAppXmlDir,string $actPage):array
 {
 	 $appXmlDir = $actAppXmlDir;
   $files = scandir($appXmlDir);
   $retVal = array();
   $interfacesFiles = array(STRING_NULL=>STRING_NULL);
   $pagesFiles = array(STRING_NULL=>STRING_NULL);
   $i=0;
   $j=0;
   foreach($files as $ind=>$file)
   {
   	$fileItems2 = preg_split("/\\"  . FILE_NAME_ELEMENTS_SEP  . "/",$file);
   	$num = count($fileItems2);
   	if($num==2)
   	 $suffix = FILE_NAME_ELEMENTS_SEP . XML_SUFFIX;
   	else
   	 $suffix = STRING_NULL;
   	if((($num==1) && (! is_dir($file)))||(! is_dir($file)&&($num==2)&&($fileItems2[1]==XML_SUFFIX)))
   	{
   	 $fileItems = Xml_interface_file_analyzer::getInterfaceItems($appXmlDir . DIR_SEP . $file);
   	 if(! in_array($fileItems[1],$pagesFiles))
   	   $pagesFiles[$fileItems[1]]=$fileItems[1];
   	 $num1 = count($fileItems);
   	 if($fileItems[1]==$actPage)
   	 if(Xml_interface_file_analyzer::is_free_interface_file($appXmlDir . DIR_SEP . $file))
   	 {
     	$interfacesFiles[$file]=$file;
     	$i++;
   	 }
   	 elseif((($num1==5) || ($num1==6)) && ($fileItems[0]!=STANDARD_MOD_PREFIX))
   	 { 
   	  if($num1 == 5)
   	  {
   	   $interfacesFiles[$fileItems[0] . INTERFACE_NAME_SEP . $fileItems[1] . INTERFACE_NAME_SEP .
   	    $fileItems[2] . INTERFACE_NAME_SEP . $fileItems[3] . INTERFACE_NAME_SEP . $fileItems[4] . 
   	    $suffix] = $file;
   	   $i++;
      }
      elseif($num1 == 6)
      {
   	   $interfacesFiles[$fileItems[0] . INTERFACE_NAME_SEP . $fileItems[1] . INTERFACE_NAME_SEP .
   	   $fileItems[2] . INTERFACE_NAME_SEP . $fileItems[3] . INTERFACE_NAME_SEP . $fileItems[4] .
   	   INTERFACE_NAME_SEP . $fileItems[5] . 
   	   $suffix]= $file;
   	   $i++;
      }
     }
    }
   }
  $retVal[0] = $interfacesFiles;
  $retVal[1] = $pagesFiles;
  return $retVal;
 }


 function loadContainersTree(Xml_interface_serializer $actSerializer,array $actItems):array
 {
 	$interfacesContainersTree=array();
  foreach($actItems as $ind=>$item)
  { 
   if(is_a($item,Classes_info::INTERFACES_CONTAINER_CLASS))
   {
   	 $items = &$item->getContents();
   	 foreach($items as $ind=>$obj)
   	 {
		 if(is_a($obj,Classes_info::INTERFACE_AS_STRING_CLASS))
			$obj=$obj->getItemName();
   	 	 $actSerializer->setFileName($obj);
   	 	 $actSerializer->loadData();
   	 	 $nextItems = $actSerializer->getItems();
   	 	 $containersTree = $this->loadContainersTree($actSerializer,$nextItems);
   	 	 $interfacesContainersTree[$obj]=$containersTree;
 
     }
   }
  }
  return $interfacesContainersTree;
 }  


 function loadFamilyTree(Xml_interface_serializer $actSerializer,array $actItems):array
 {
 	$interfaceFamilyTree=array();
  foreach($actItems as $ind=>$item)
  { 
   if(is_array($item))
   {
    if($ind=="dataFieldsDomainsValues")
   	{
   	 $i=0;
   	 foreach($item as $ind=>$obj)
   	 {
   	 	 $domain = $actItems['dataFieldsDomains'][$i++];
   	 	 if($domain==Int_domain::FIELD_DOMAIN_OBJ)
   	 	 {
		  if(is_a($obj,Classes_info::INTERFACE_AS_STRING_CLASS))
			$obj=$obj->getItemName();
   	 	  $actSerializer->setFileName($obj);
   	 	  $actSerializer->loadData();
   	 	  $nextItems = $actSerializer->getItems();
   	 	  $familyTree = $this->loadFamilyTree($actSerializer,$nextItems);
   	 	  $interfaceFamilyTree[$obj]=$familyTree; 
      }
     }
    } 
   }
   elseif(($ind=="decoratedObj")&&(trim($item)!=STRING_NULL))
   {
   	$actSerializer->setFileName($item);
   	$actSerializer->loadData();
   	$nextItems = $actSerializer->getItems();
   	$familyTree = $this->loadFamilyTree($actSerializer,$nextItems);
   	$interfaceFamilyTree[$item]=$familyTree;
   }
  }
  return $interfaceFamilyTree;
 }  
  
 function putBody():void
 {
 	global $dbStructTree;
 	global $dbQueriesContainer;
 	
 	$interfaces = $this->getInterfacesContainer();

  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
 	(! isset($_GET["interfaccia"])))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;

   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   
   $files = array(STRING_NULL=>STRING_NULL);
   $interfacesFiles = Interfaces_model::getAllInterfacesByPage($appName,STRING_NULL,true);
   foreach($interfacesFiles as $file)
   {
   	$files[$file]=$file;
   }
   $pagesFiles = array(STRING_NULL=>STRING_NULL);
   $pages = Interfaces_model::getAllPages($appName);
   foreach($pages as $page)
   {
   	$pagesFiles[$page]=$page;
   }
   
   $intCtrl1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_0); 	
   $intCtrl1->setDataFieldDomainValueByName(FIELD_PAGINE,$pagesFiles);
   $intCtrl2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_1);	
   $intCtrl2->setDataFieldDomainValueByName(FIELD_INTERFACCE,$files); 
   $intCtrl2->setDataFieldEvents(array("interfacce_onChange(this)"));  
   
   $intNLevelMenu1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_MENU,NUM_1);
   $intNLevelMenu1->addField(current($files),array(),Int_domain::FIELD_DOMAIN_SET);

   $intNLevelMenu2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_MENU,NUM_2);
   $intNLevelMenu2->addField(current($files),array(),Int_domain::FIELD_DOMAIN_SET);

   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     
  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
  ($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
 	(isset($_GET["interfaccia"])))
  {
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appIntDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . XML_DIR;
   $fileItems = Xml_interface_file_analyzer::getInterfaceItems($appIntDir . 
   DIR_SEP . $_GET["interfaccia"]);
   $pageName = $fileItems[1];
   $dbStructTree = $GLOBALS["dbStructTreeLocal"];
   $dbQueriesContainer = $GLOBALS["dbQueriesContainerLocal"];
   $retVal = $this->getInterfacesFilesByPage($appIntDir,$pageName);
   $interfacesFiles = $retVal[0];
   $pagesFiles = $retVal[1];
   
   $intCtrl1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_0); 	
   $intCtrl1->setDataFieldDomainValueByName(FIELD_PAGINE,$pagesFiles);
   $intCtrl1->setSelectedItem($pageName);
   $intCtrl2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_1); 	
   $intCtrl2->setDataFieldDomainValueByName(FIELD_INTERFACCE,$interfacesFiles);   
   $intCtrl2->setSelectedItem($_GET["interfaccia"]);
   $intCtrl2->setDataFieldEvents(array("interfacce_onChange(this)")); 
   $intCtrl3 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_INPUT_CTRL,NUM_2);
   $intCtrl3->setDataFieldEvents(array("genitori_onChange(this);")); 
   
   $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$_GET["interfaccia"]);
   $serializer->setInterfacesDir($appIntDir);
   $serializer->setXmlDir($appXmlDir);
   $serializer->setDbStruct($dbStructTree);
   $serializer->setDbQueries($dbQueriesContainer);
   $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setInterfacesContainer($intContainer);
   $serializer->setAppName($appName);
   $serializer->setPageName($pageName);
   $serializer->setLoadInterfaceAsString(true);
   $serializer->loadData();
   $items = $serializer->getItems();
   
   $interfacesContainersTree = array();
   $interfaceFamilyTree = array();      

   $interfacesContainersTree = $this->loadContainersTree($serializer,$items);
   $interfaceFamilyTree = $this->loadFamilyTree($serializer,$items);

   $intNLevelMenu1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_MENU,NUM_1);
   $intNLevelMenu1->addField($_GET["interfaccia"],$interfacesContainersTree,Int_domain::FIELD_DOMAIN_SET);

   $intNLevelMenu2 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_NLEVELS_MENU,NUM_2);
   $intNLevelMenu2->addField($_GET["interfaccia"],$interfaceFamilyTree,Int_domain::FIELD_DOMAIN_SET);
   
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
   $int->putData();     

  }
  elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
  {
   $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_9)->getInterfacesContainer()->deleteItem(1);
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