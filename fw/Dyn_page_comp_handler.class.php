<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

class Dyn_page_comp_handler 
{
 const DYN_PAGE_COMP_HANDLER_ERROR_1="Dyn_page_comp_handler:Errore interfaccia non trovata.";
 const DYN_PAGE_COMP_HANDLER_ERROR_2="Dyn_page_comp_handler:Errore nome interfaccia non valida.";
 const DYN_PAGE_COMP_HANDLER_ERROR_3="Dyn_page_comp_handler:Errore parametro mancante.";
 const DYN_PAGE_COMP_HANDLER_ERROR_4="Dyn_page_comp_handler:Errore parametro mancante -Type-.";
 const DYN_PAGE_COMP_HANDLER_ERROR_5="Dyn_page_comp_handler:Errore parametro mancante -Num-.";
 const DYN_PAGE_COMP_HANDLER_ERROR_6="Dyn_page_comp_handler:Errore la proprietà deve essere impostata."; 
 const DYN_PAGE_COMP_HANDLER_ERROR_7="Dyn_page_comp_handler:Errore il valore della proprietà deve essere impostato."; 
 const DYN_PAGE_COMP_HANDLER_ERROR_8="Dyn_page_comp_handler:Errore il metodo deve essere impostato.";
 
 private $itemStr=STRING_NULL;
 private $dir=STRING_NULL;
 private $interfacesDir=STRING_NULL;
 private $appName=STRING_NULL;
 private $pageName=STRING_NULL;
 private $interpolateConsts=true;
 private $xmlEmbeds=array();
 static $xmlEmbedsIndex = 0;
 
 function __construct(string $actStr=STRING_NULL)
 {
 	if($actStr != STRING_NULL)
 	 $this->setItemStr($actStr);
 }
 
 function setInterpolateConsts(bool $actInterpolateConsts)
 {
 	$this->interpolateConsts = $actInterpolateConsts; 
 }
 
 function getInterpolateConsts()
 {
 	return $this->interpolateConsts;
 }
 
 function setDir(string $actDir)
 {
 	$this->dir = $actDir;
 }
 
 function getDir()
 {
 	return $this->dir;
 }
 
 function setInterfacesDir(string $actInterfacesDir)
 {
 	$this->interfacesDir = $actInterfacesDir;
 }
 
 function getInterfacesDir()
 {
 	return $this->interfacesDir;
 }
 
  function setAppName(string $actAppName)
 {
 	$this->appName = $actAppName;
 }
 
 function getAppName()
 {
 	return $this->appName;
 }
 
   function setPageName(string $actPageName)
 {
 	$this->pageName = $actPageName;
 }
 
 function getPageName()
 {
 	return $this->pageName;
 }
 
 

 function setXmlEmbeds(array $actXmlEmbeds)
 {
 	$this->xmlEmbeds = $actXmlEmbeds;
 }
 
 function getXmlEmbeds()
 {
 	return $this->xmlEmbeds;
 }
 
 function setItemStr(string $actItemStr)
 {
 	$this->itemStr = $actItemStr;
 }
 
 function getItemStr()
 {
 	return $this->itemStr;
 }
 
 function exec()
 {
 	$itemStr = $this->getItemStr();
  $xmlEl = simplexml_load_string($itemStr);	
  $strResult = STRING_NULL;
  switch(trim($xmlEl['action']))
 	{

 	 case "display":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;
	   
	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;
	  
	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
 	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);
 	  
 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");';
 		$strResult = $strResult . '$obj->putData();';
 		$strResult = $strResult . 'unset($obj);' . STRING_RETURN . STRING_LINE_FEED;
 		break;
 	 
 	 case "template":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;

	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);

 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");';
 	  $strResult = $strResult . '$obj->action("' . $xmlEl[0] .
 	   '",$interfacesContainer);$obj->putData();';
 	   $strResult = $strResult . 'unset($obj);' . STRING_RETURN . STRING_LINE_FEED;
 	  break;
 	 
 	 case "load":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;

	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);

 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir(); 
 	  $interpolateConsts = $this->getInterpolateConsts();

 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");';
 	 	$strResult = $strResult . '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' .
 	  '$xmlIntSerializer->setDbStruct($dbStructTree);' . 
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');';
 	  $strResult = $strResult . '$obj->setSerializer($xmlIntSerializer);$obj->serializer_loadData("' . 
 	  $appName . '");$obj->unserialize();';
 	  $strResult = $strResult . 'unset($obj);unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
 	  break;
 	 
 	 case "load_and_display":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;
	   
	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
     	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);

 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir(); 
 	  $interpolateConsts = $this->getInterpolateConsts();

 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");';
 	 	$strResult = $strResult . '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
 	  '$xmlIntSerializer->setDbStruct($dbStructTree);' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');';
 	  $strResult = $strResult . '$obj->setSerializer($xmlIntSerializer);$obj->serializer_loadData("' . 
 	  $appName . '");$obj->unserialize();$obj->putData();'  .
 	  $strResult = $strResult . 'unset($obj);unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
 	  break;
 	 
 	 case "create_from_normal_name_and_display":

 	  $nomeCompletoInterfaccia = $xmlEl[0];
//
// Questo controllo va eseguito subito.
//
 	  if (! Xml_interface_serializer::isInterfaceNameNormalized($nomeCompletoInterfaccia))
 	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_2);
 	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
    $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
 	    
    $strResult = $strResult .
 	 	'$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' . 
    '$interfaceIds = Generic_interface::decodeInterfaceId("' . 
    $nomeCompletoInterfaccia . '",Xml_interface_serializer::INTERFACE_NAME_SEP);' .
    '$pageName = $interfaceIds[1];' .
 	  '$xmlIntSerializer->setPageName($pageName);' . 
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .   
    '$newInterface = $xmlIntSerializer->createInterfaceFromString("' . $nomeCompletoInterfaccia . '");' .
    'if(is_a($newInterface,Classes_info::HTML_DATA_INTERFACE_CLASS))' .
    '{' .
    '$newInterface->setDbStruct($dbStructTree);' .
	  '}' . 
    '$newInterface->setSerializer($xmlIntSerializer);' .
    '$newInterface->serializer_loadData("' . $appName . '");' .
    '$newInterface->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' .
	  '$interfacesContainer->add($newInterface);' .
	  '$newInterface->putData();' .
	  'unset($interfaceIds);' . 
	  'unset($pageName);' .	
	  'unset($newInterface);' . 
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  break;
 	 
 	 case "create_from_normal_name":

 	  $nomeCompletoInterfaccia = $xmlEl[0];
//
// Questio controllo va eseguito subito.
//
 	  if (! Xml_interface_serializer::isInterfaceNameNormalized($nomeCompletoInterfaccia))
 	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_2);
 	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
    $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
 	   
    $strResult = $strResult .
 	 	'$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$interfaceIds = Generic_interface::decodeInterfaceId("' . 
    $nomeCompletoInterfaccia . '",Xml_interface_serializer::INTERFACE_NAME_SEP);' .
    '$pageName = $interfaceIds[1];' .
 	  '$xmlIntSerializer->setPageName($pageName);' . 
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .   
    '$newInterface = $xmlIntSerializer->createInterfaceFromString("' . 
    $nomeCompletoInterfaccia . '");' .
    'if(is_a($newInterface,Classes_info::HTML_DATA_INTERFACE_CLASS))' .
    '{' .
    '$newInterface->setDbStruct($dbStructTree);' .
	  '}' . 
    '$newInterface->setSerializer($xmlIntSerializer);' .
    '$newInterface->serializer_loadData("' . $appName . '");' .
    '$newInterface->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' .
	  '$interfacesContainer->add($newInterface);' .
	  'unset($interfaceIds);' . 
	  'unset($pageName);' .	
	  'unset($newInterface);' . 
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  break;
	 
	 case "create_from_embed":

	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_4);

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_5);
	  
	  $xmlEmbeds[self::$xmlEmbedsIndex] = $xmlEl;
	  $this->setXmlEmbeds($xmlEmbeds);
	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
	  
	  $sepChar = Xml_interface_serializer::INTERFACE_NAME_SEP;
	  $nomeCompletoInterfaccia = $appName . $sepChar . $pageName . $sepChar .
	  $objName . $sepChar . $type . $sepChar . $op . $sepChar . $num;
	  	
    $strResult = $strResult . '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .   
    '$newInterface = $xmlIntSerializer->createInterfaceFromString("' . 
    $nomeCompletoInterfaccia . '");' .
    'if(is_a($newInterface,Classes_info::HTML_DATA_INTERFACE_CLASS))' .
    '{' .
    '$newInterface->setDbStruct($dbStructTree);' .
	  '}' .     
	  '$xmlEmbed = $xmlEmbeds[' . self::$xmlEmbedsIndex . '];' . 
	  '$xmlIntSerializer->loadDataFromSimpleXml($xmlEmbed);' . 
    '$newInterface->setSerializer($xmlIntSerializer);' .
	  '$newInterface->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' .
	  '$interfacesContainer->add($newInterface);' .
	  'unset($xmlEmbed);' . 	
	  'unset($newInterface);' . 
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  self::$xmlEmbedsIndex++; 
	  break;
	  
	 case "create_from_embed_and_display":

	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_4);

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   die(self::DYN_PAGE_COMP_HANDLER_ERROR_5);
	  
	  $xmlEmbeds[self::$xmlEmbedsIndex] = $xmlEl;
	  $this->setXmlEmbeds($xmlEmbeds);
	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
	  
	  $sepChar = Xml_interface_serializer::INTERFACE_NAME_SEP;
	  $nomeCompletoInterfaccia = $appName . $sepChar . $pageName . $sepChar .
	  $objName . $sepChar . $type . $sepChar . $op . $sepChar . $num;
	  	
    $strResult = $strResult . '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .   
    '$newInterface = $xmlIntSerializer->createInterfaceFromString("' . 
    $nomeCompletoInterfaccia . '");' .
    'if(is_a($newInterface,Classes_info::HTML_DATA_INTERFACE_CLASS))' .
    '{' .
    '$newInterface->setDbStruct($dbStructTree);' .
	  '}' .     
	  '$xmlEmbed = $xmlEmbeds[' . self::$xmlEmbedsIndex . '];' . 
	  '$xmlInterfaceSerializer->loadDataFromSimpleXml($xmlEmbed);' . 
    '$newInterface->setSerializer($xmlIntSerializer);' .
	  '$newInterface->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' .
	  '$interfacesContainer->add($newInterface);' .
	  '$newInterface->putData();' .
	  'unset($xmlEmbed);' . 	
	  'unset($newInterface);' . 
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  self::$xmlEmbedsIndex++; 
	  break;
	  
	 case "create":

	   if (isset($xmlEl['obj_name']))
	    $objName = $xmlEl['obj_name'];
	   else
	    $objName=OBJ_NONE; 

	   if (isset($xmlEl['op']))
	    $op = $xmlEl['op'];
	   else
	    $op=OP_NONE; 

	   if (isset($xmlEl['type']))
	    $type = $xmlEl['type'];
	   else
	    die(self::DYN_PAGE_COMP_HANDLER_ERROR_4);

	   if (isset($xmlEl['num']))
	    $num = $xmlEl['num'];
	   else
	    die(self::DYN_PAGE_COMP_HANDLER_ERROR_5);

 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
	  
	  $sepChar = Xml_interface_serializer::INTERFACE_NAME_SEP;
	  $nomeCompletoInterfaccia = $appName . $sepChar . $pageName . $sepChar .
	  $objName . $sepChar . $type . $sepChar . $op . $sepChar . $num;
      	  
    $strResult = $strResult . '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .   
    '$newInterface = $xmlIntSerializer->createInterfaceFromString("' . $nomeCompletoInterfaccia . '");' .
    'if(is_a($newInterface,Classes_info::HTML_DATA_INTERFACE_CLASS))' .
    '{' .
    '$newInterface->setDbStruct($dbStructTree);' .
	  '}' .  
     '$interfacesContainer->add($newInterface);' . 
     'unset($newInterface);' . 
     'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;	  
	   break;
	   
	 case "load_from_embed":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;

	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);

	  $xmlEmbeds[self::$xmlEmbedsIndex] = $xmlEl;
	  $this->setXmlEmbeds($xmlEmbeds);
	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
         
 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");' .
    '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .  
    '$xmlEmbed = $xmlEmbeds[' . self::$xmlEmbedsIndex . '];' . 
	  '$xmlIntSerializer->loadDataFromSimpleXml($xmlEmbed);' . 
    '$obj->setSerializer($xmlIntSerializer);' .
	  '$obj->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' . 
    'unset($xmlEmbed);' .
    'unset($obj);' .
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  self::$xmlEmbedsIndex++; 
	  break;
	  
	 case "load_from_embed_and_display":

 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;
	  
	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
     	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);

	  $xmlEmbeds[self::$xmlEmbedsIndex] = $xmlEl;
	  $this->setXmlEmbeds($xmlEmbeds);
	  
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = $this->getDir();
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
         
 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");' .
    '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .  
    '$xmlEmbed = $xmlEmbeds[' . self::$xmlEmbedsIndex . '];' . 
	  '$xmlIntSerializer->loadDataFromSimpleXml($xmlEmbed);' . 
    '$obj->setSerializer($xmlIntSerializer);' .
	  '$obj->unserialize();' .
	  '$interfacesContainer = $xmlIntSerializer->getInterfacesContainer();' .
    '$obj->putData();' .	   
    'unset($xmlEmbed);' .
    'unset($obj);' .
	  'unset($xmlIntSerializer);' . STRING_RETURN . STRING_LINE_FEED;
	  self::$xmlEmbedsIndex++; 
	  break;

	 case "set_property":
	 
 	  $threeParNotFound=false;
	  if (isset($xmlEl['obj_name']))
	   $objName = $xmlEl['obj_name'];
	  else
	   $objName=OBJ_NONE; 

	  if (isset($xmlEl['op']))
	   $op = $xmlEl['op'];
	  else
	   $op=OP_NONE; 

	  if (isset($xmlEl['type']))
	   $type = $xmlEl['type'];
	  else
	   $threeParNotFound=true;

	  if (isset($xmlEl['num']))
	   $num = $xmlEl['num'];
	  else
	   $threeParNotFound=true;

	  $shortNameNotFound=false;	  
	  if (isset($xmlEl['shortName']))
	   $shortName=$xmlEl['shortName'];
	  else
	   $shortNameNotFound=true;

	  $objValueNotFound=false; 
	  if(isset($xmlEl['objVar'])) 
     $objVal = $xmlEl['objVar'];
    else
     $objValueNotFound=false; 
     	   
	  if(! $shortNameNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterfaceByShortName("' . trim($shortName) . '");';
    elseif(! $threeParNotFound)
     $strResult = $strResult . '$obj = $interfacesContainer->getInterface("' . 
     trim($objName) . '","' . trim($op) . '","' . trim($type) . '","' . trim($num) . '");';
    elseif(! $objValueNotFound)
     $strResult = $strResult . '$obj = $' . $objVal . ";";
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_3);
    
    if(isset($xmlEl['prop']))
     $prop = $xmlEl['prop'];
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_6);
    
    if(isset($xmlEl['propVal'])) 
     $propVal = $xmlEl['propVal'];
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_7);
          
 	  $strResult = $strResult . 'if(is_null($obj)) die("' . self::DYN_PAGE_COMP_HANDLER_ERROR_1 . '");' .
    '$obj->set' . ucFirst($prop) . '($' . $propVal . ');' . 	   
    'unset($obj);' . STRING_RETURN . STRING_LINE_FEED; 
	  break;

   case "exec_page_method":

	  if(isset($xmlEl['method'])) 
     $method = $xmlEl['method'];
    else
     die(self::DYN_PAGE_COMP_HANDLER_ERROR_8); 
     
	  if(isset($xmlEl['parametersVar'])) 
    {
     $parametersVar = $xmlEl['parametersVar'];
     $parametersVar = "$" . $parametersVar;
    } 
    else
    {
     $parametersVar = "array()";    
    }
    
 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = FRAMEWORK_PATH;
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
 	  $idCharSep = Generic_interface::INTERFACE_ID_CHAR_SEP;
 	  $objPageName = $appName . $idCharSep . $pageName . $idCharSep .
 	  'op_page';
 	  $objModuleName = $dir . $objPageName . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php";
 	  $strResult = $strResult . 'require_once("' . $objModuleName . '");' .
    '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .
    'if(! isset($globalObjPage))' .
    '{' .  
     '$objPageName = ' . '__NAMESPACE__ . "\\\\" . "' . $objPageName . '";' .
     '$globalObjPage = new  $objPageName();' .
    '}' .
    '$globalObjPage->setInterfacesContainer($interfacesContainer);' .
    '$globalObjPage->setSerializer($xmlIntSerializer);' .
    'call_user_func_array(array($globalObjPage,"' . $method . '"),' . $parametersVar . ');'; 
    break;
    
   case "load_page":

 	  $appName = $this->getAppName();
 	  $pageName = $this->getPageName(); 
 	  $dir = FRAMEWORK_PATH;
 	  $interfacesDir = $this->getInterfacesDir();
 	  $interpolateConsts = $this->getInterpolateConsts();
 	  $idCharSep = Generic_interface::INTERFACE_ID_CHAR_SEP;
 	  $objPageName = $appName . $idCharSep . $pageName . $idCharSep .
 	  'op_page';
 	  $objModuleName = $dir . $objPageName . FILE_NAME_ELEMENTS_SEP . "class" . 
 	      FILE_NAME_ELEMENTS_SEP . "php";
 	  $strResult = $strResult . 'require_once("' . $objModuleName . '");' .
    '$xmlIntSerializer = Generic_interface::createXmlInterfaceSerializer();' .
 	  '$xmlIntSerializer->setDir("' . $dir . '");' .
 	  '$xmlIntSerializer->setInterfacesDir("' . $interfacesDir . '");' .
 	  '$xmlIntSerializer->setAppName("' . $appName . '");' . 
    '$xmlIntSerializer->setPageName("' . $pageName . '");' .
 	  '$xmlIntSerializer->setInterpolateConsts(' . $interpolateConsts . ');' .
    '$xmlIntSerializer->setDbStruct($dbStructTree);' .
    '$xmlIntSerializer->setDbQueries($dbQueriesContainer);' .
    '$xmlIntSerializer->setInterfacesContainer($interfacesContainer);' .  
    'if(! isset($globalObjPage))' .
    '{' .  
     '$objPageName = ' . '__NAMESPACE__ . "\\\\" . "' . $objPageName . '";' .
     '$globalObjPage = new $objPageName();' .
    '}' .
    '$globalObjPage->setInterfacesContainer($interfacesContainer);' .
    '$globalObjpage->setSerializer($xmlIntSerializer);' .
    '$globalObjPage->serializer_loadData("' . $appName . '");' .
    '$globalObjPage->unserialize();';
    break;
 	}

 	return $strResult;
 }
 	
}


?>