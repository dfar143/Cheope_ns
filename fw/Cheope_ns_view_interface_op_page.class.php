<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("Cheope_ns_view_interface_op_page_putBodyClasses.class.php");
require_once("http.const.php");
require_once("filesystem.fun.php");
require_once("javascript.fun.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"view_interface");
define('THIS_PAGE',"view_interface.php");

class Cheope_ns_view_interface_op_page extends Cheope_ns_page
{
 
 const INTERFACE_NAME_SEP = Xml_interface_serializer::INTERFACE_NAME_SEP;
 
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
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX);
 }

 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  parent::putClientScriptIncludeCode();
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])
  &&($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL))
  {
   $htmlWriter->putScriptIncludeTag(CLIENT_CODE_PATH . DIR_SEP . "Selection" . JAVASCRIPT_SOURCE_FILE_POSTFIX);
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.dnd.Source\")</script>"); 
   $htmlWriter->putGenericHtmlString("<script>" .
	 "dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
  }
 }
 
 function putActiveApp():void
 {
 }
 
 function putHeader():void
 {
 }
   
 function putBody():void
 {	
 	$interfaces = $this->getInterfacesContainer();
 	
 	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP])&&
 	($_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)&&
 	(isset($_GET[PAR])))
 	{
 	 $interfaccia = $_GET[PAR];
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   $appXmlDir = PREVIOUS_DIR . DIR_SEP . $appDir . DIR_SEP . INTERFACES_DIR;
   $items = explode(self::INTERFACE_NAME_SEP,$interfaccia);
   if(count($items)==1)
    $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
    $appXmlDir . DIR_SEP . $interfaccia,"pageName");
   else
    $nomePagina = $items[1];  	 
   $appName = $_SESSION[SESSION_VAR_ACTIVE_APP];
   $appDir = $appName;
   
   $files = scandir($appXmlDir);
   $interfacesFiles = array();
   $interfacesFiles = Interfaces_model::getAllInterfacesByPage($appName,$nomePagina,true);
   
   $interfaceDivTag1 = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0);
    
   $interfaceDivTagContainer1 = $interfaceDivTag1->getInterfacesContainer(); 
   
   $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
   $attribs = array("for" =>FIELD_LISTA_INTERFACCE);
   $intLabel1->setTagBody(LABEL_LISTA_INTERFACCE);
   $intLabel1->setAttribs($attribs);
   $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
   $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE . ENTITY_SPACE); 
   $intHtmlFragment1->setDivEnvelope(false); 
   $interfaceSelectTag1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
   $attribs = array("name" => FIELD_LISTA_INTERFACCE,"id" => FIELD_LISTA_INTERFACCE,
   "onchange" => "lista_interfacce_onChange(this)");
   $interfaceSelectTag1->setAttribs($attribs);
   $interfacesSelectContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $interfacesSelectContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   //
   // Determino l'array degli attributi per il combo delle interfacce
   //
   //  
   $j=0;
   $attribsAlt=array();
   foreach($interfacesFiles as $ind=>$interfaceFile)
   {
   	$fileItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . STRING_SLASH,$interfaceFile);
   	if(($fileItems[0] != STANDARD_MOD_PREFIX)&&($interfaceFile != $interfaccia))
   	{
   	 $interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL); 
     $attribsAlt = array("value"=>$interfaceFile,"class"=>"dojoDndItem");
   	 $interfaceOptionTag->setTagBody($ind);
   	 $interfaceOptionTag->setAttribs($attribsAlt);
   	 $interfacesSelectContainer4->add($interfaceOptionTag);
   	 $j++;
    }
   }
   //
   //      
   // Contatore tags
   //
   $j=0;
   foreach($interfacesFiles as $ind=>$interfaceFile)
   {
   	$interfaceOptionTag = Creator::create(Interfaces_info::INT_HTML_OPTION_TAG,STRING_NULL);
   	if($interfaceFile==$interfaccia)
   	 $attribs2 = array("value"=>$interfaceFile,"selected"=>STRING_NULL);
   	else
     $attribs2 = array("value"=>$interfaceFile);
   	$interfaceOptionTag->setTagBody($ind);
   	$interfaceOptionTag->setAttribs($attribs2);
   	$interfacesSelectContainer1->add($interfaceOptionTag);
   	$j++;
   }
   $interfaceSelectTag1->setInterfacesContainer($interfacesSelectContainer1);
   $interfaceDivTagContainer1->add($intLabel1);
   $interfaceDivTagContainer1->add($intHtmlFragment1);
   $interfaceDivTagContainer1->add($interfaceSelectTag1);
   
   $serializer = Creator::create(getClassNameForCreate(Classes_info::XML_INTERFACE_SERIALIZER_CLASS),STRING_NULL,$interfaccia);
   $serializer->setInterpolateConsts(false);
   $serializer->setXmlDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . XML_DIR);
   $serializer->setInterfacesDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . INTERFACES_DIR);
   $serializer->setCodeDir(PREVIOUS_DIR . DIR_SEP . $appDir . 
   DIR_SEP . FW_DIR);
   $serializer->setDbStruct($GLOBALS["dbStructTreeLocal"]);
   $serializer->setDbQueries($GLOBALS["dbQueriesContainerLocal"]);
   $intContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
   $serializer->setInterfacesContainer($intContainer);
   $serializer->setAppName($appName);
 	 
	 $scope = $appDir . STRING_BACKSLASH . FRAMEWORK_DIR;	 
	 $serializer->setScope($scope);
 
   $filesItems = preg_split(STRING_SLASH . self::INTERFACE_NAME_SEP . 
   STRING_SLASH,$interfaccia);
   if(count($filesItems)==1)
      $nomePagina = Xml_interface_file_analyzer::getScalarProperty(
      $appXmlDir . DIR_SEP . $interfaccia,"pageName");
   else
    $nomePagina = $filesItems[1];
   $serializer->setPageName($nomePagina);
   //
   // Carico le interfacce come stringhe, col loro nome completo.
   // 
   $serializer->setLoadInterfaceAsString(true);
   $serializer->setLoadSpecialChars(true);
   $serializer->loadData();
   $items = $serializer->getItems();
    
   $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer1->add($intBr1);
   $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer1->add($intBr2);
   $intHr1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);
   $interfaceDivTagContainer1->add($intHr1); 
   $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
   $interfaceDivTagContainer1->add($intBr3);

   foreach($items as $ind=>$item)
   {
   	/*echo "<[";
   	var_dump($item);
   	echo "]>";*/
	 	$factory = Creator::create(getClassNameForCreate(Classes_info::PUTBODY_FACTORY_CLASS),STRING_NULL,$item,$ind,$scope);
	  $factory->setDbStructTree($GLOBALS["dbStructTreeLocal"]);
	  $factory->setDbQueriesContainer($GLOBALS["dbQueriesContainerLocal"]);
	  $factory->setItems($items);
	  $factory->setAppDir($appDir);
	  $factory->setDivTagContainer( $interfaceDivTagContainer1);
	  $factory->setIntHtmlFragment( $intHtmlFragment1);
	  $factory->setInterfacesFiles($interfacesFiles);
	  $factory->setIntSelectContainer($interfacesSelectContainer4);
	  $factory->setNomePagina($nomePagina);
	  $factory->setIntSelectTag($interfaceSelectTag1);
	  
	 	$branchObj = $factory->create();
	 	
	 	if(! is_null($branchObj))
	   $branchObj->exec();	
	 }
   
   $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);   
   $int_iter = $interfaces->create();
   $int=$int_iter->last();
   $int->putData();
 }
 elseif(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]==STRING_NULL)
 {
  $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_2)->getInterfacesContainer()->deleteItem(0);
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