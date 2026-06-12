<?
namespace Cheope_ns\fw;
require_once("Xml_formatted_interface.class.php");
require_once("html.const.php");

class Xml_document extends Xml_formatted_interface 
{
 const ERROR_1="Xml_document:Errore xml file name nullo.";
 const DEFAULT_DOCTYPE_STRING=NO_DOCTYPE;
 const DEFAULT_XML_PROLOG_VERSION=XML_VERSION;
 const DEFAULT_XML_PROLOG_ENCTYPE=CHARSET_UTF8;

 private $docTypeString = self::DEFAULT_DOCTYPE_STRING;
 private $xmlPrologVersion = self::DEFAULT_XML_PROLOG_VERSION;
 private $xmlPrologEncType = self::DEFAULT_XML_PROLOG_ENCTYPE;
  
 function __construct(string $actOp=OP_NONE,$actNum=0)
 {
  parent::__construct($actOp,self::INT_XML_DOCUMENT,$actNum);
 }
 
 function serialize():void
 {
 	parent::serialize();
 	$serializer = $this->getSerializer();
 	$docTypeString = $this->getDocTypeString();
 	$item5 = array("docTypeString"=>$docTypeString);
 	$serializer->loadItems($item5);
 	$xmlPrologVersion = $this->getXmlPrologVersion();
 	$item6 = array("xmlPrologVersion"=>$xmlPrologVersion);
 	$serializer->loadItems($item6);
 	$xmlPrologEnctype = $this->getXmlPrologEncType();
 	$item7 = array("xmlPrologEncType"=>$xmlPrologEncType);
 	$serializer->loadItems($item7);	
 }
 
 static function createInterfacesContainer(string $actName=STRING_NULL):Interfaces_container
 {
 	return Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,$actName);
 }
 
 function initPutData():array
 {
 }
 
 function add(Generic_interface $actInt):void
 {
 	 $intContainer = $this->getInterfacesContainer();
 	 if(is_null($intContainer))
 	  $intContainer = self::createInterfacesContainer();
 	 $intContainer->add($actInt);
 }
 
 function setElement(Generic_interface $actInt,int $actPos):void
 {
 	 $intContainer = $this->getInterfacesContainer();
 	 if(is_null($intContainer))
 	  $intContainer = self::createInterfacesContainer();
 	 $intContainer->setElement($actInt,$actPos);
 }
 
 
 function getXmlPrologVersion():string
 {
  if ($this->xmlPrologVersion==STRING_NULL)
	 return self::DEFAULT_XML_PROLOG_VERSION;
	else
   return $this->xmlPrologVersion;
 }
 
 function setXmlPrologVersion(string $actXmlPrologVersion):void
 {
  $this->xmlPrologVersion = $actXmlPrologVersion;
 }
 
 function getXmlPrologEncType():string
 {
  if ($this->xmlPrologEncType==STRING_NULL)
	 return self::DEFAULT_XML_PROLOG_ENCTYPE;
	else
   return $this->xmlPrologEncType;
 }
 
 function setXmlPrologEncType(string $actXmlPrologEncType):void
 {
  $this->xmlPrologEncType = $actXmlPrologEncType;
 }
 
 function putXmlPrologString():void
 {
 	$xmlWriter = $this->getXmlWriter();
	$xmlPrologVersion = $this->getXmlPrologVersion();
	$xmlPrologEnctype = $this->getXmlPrologEnctype();
	$xmlWriter->putXmlPrologString($xmlPrologVersion,$xmlPrologEnctype);
 }
 
 function putDocTypeString():void
 {
 	$xmlWriter = $this->getXmlWriter();
 	$docTypeString = $this->getDocTypeString();
	if($docTypeString != NO_DOCTYPE)
	 $xmlWriter->putDocTypeTag($docTypeString);
 }
 
 function getDocTypeString():string
 {
  if ($this->docTypeString==STRING_NULL)
	 return self::DEFAULT_DOCTYPE_STRING;
	else
   return $this->docTypeString;
 }
 
 function setDocTypeString(string $actDocTypeString):void
 {
  $this->docTypeString = $actDocTypeString;
 }
 
 
 function setAllXmlWriters():void
 {
 	$xmlWriter = $this->getXmlWriter();
 	$intContainer = $this->getInterfacesContainer();
 	$iterator = $intContainer->create();
 	$iterator->reset();
 	while($iterator->hasMore())
 	{
 	 $int = $iterator->current();
 	 if(is_a($int,Classes_info::XML_FORMATTED_INTERFACE_CLASS))
 	 {
    $int->setXmlWriter($xmlWriter);
   }
   $iterator->next();
  }
 }
 
 function isContainer():bool
 {
  return true;
 }
 
  function isDecorator():bool
	{
		return false;
	}
	
  function isStandard():bool
	{
		return true;
	}
 
 function putInnerXmlData():void
 {
	 $interfacesContainer = $this->getInterfacesContainer();
	 $iter = $interfacesContainer->create();
	 $iter->reset();
	 $fileName = $this->getFileName();
	 if($fileName != STRING_NULL)
	 {
	  while($iter->hasMore())
	  {
	   $interface = $iter->current();
	   $interface->setFileName($fileName);
	   $xmlWriter = $interface->getXmlWriter();
		$itemStack = $xmlWriter->getItemStack();
		//$xmlWriter = self::createXmlWriter();
        $fileDump = self::createFileDumper($itemStack);
		$fileDump->setOpeningChar(STRING_RETURN . STRING_LINE_FEED);
		$fileDump->setClosingChar(STRING_RETURN . STRING_LINE_FEED);
		$fileDump->setFileOpenType(File_dumper::OPEN_FILE_FOR_APPEND);
		$fileDump->setFileName($fileName);
	    $itemStack->setDumper($fileDump);
		$xmlWriter->setItemStack($itemStack);
		//$this->setXmlWriter($xmlWriter);
       $interface->putData();	  
	   $iter->next();	
	  }
	 }
	 else
	  die(self::ERROR_1);
 }
 
 function putData():void
 {
	$this->setAllXmlWriters();
	$this->putXmlPrologString();
	$this->putDocTypeString();
	$this->putInnerXmlData();
 }

}


?>