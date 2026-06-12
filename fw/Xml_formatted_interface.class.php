<?
namespace Cheope_ns\fw;

require_once("Xml_writer.class.php");
require_once("Generic_interface.class.php");


abstract class Xml_formatted_interface extends Generic_interface 
{
	
	const ERROR_1 = "Xml_formatted_interface:Errore nell'inserimento del Xml_writer.";
	
	protected $dispFields=array();
	protected $xmlWriter=null;
	private $fileName=STRING_NULL;
	static private $xmlFormattedInterfacesTotNum = 0;
	static $useShortNameAsInterfaceId = true;
	
	function __construct(string $actOp=OP_NONE,string $actType,$actNum=STRING_NULL)
	{
		self::$xmlFormattedInterfacesTotNum++;
 	  if($actNum === STRING_NULL)
 	   $actNum = self::$xmlFormattedInterfacesTotNum-1;
		parent::__construct($actOp,$actType,$actNum);
		$itemStack = $this->getItemStack();
		$xmlWriter = self::createXmlWriter();
        $fileDump = self::createFileDumper($itemStack);
		$fileDump->setOpeningChar(STRING_NULL);
		$fileDump->setClosingChar(STRING_NULL);
		$fileDump->setFileOpenType(File_dumper::OPEN_FILE_FOR_OVERWRITE);
	    $itemStack->setDumper($fileDump);
		$xmlWriter->setItemStack($itemStack);
		$this->setXmlWriter($xmlWriter);
	} 
	
	function getInterfaceId(string $actSepChar=self::INTERFACE_ID_CHAR_SEP):string
	{
		if(self::$useShortNameAsInterfaceId)
		{
			$intShortName = $this->getShortName();
			if($intShortName!=STRING_NULL)
			 return $intShortName;
			else
			 return parent::getInterfaceId($actSepChar);
		}
		return parent::getInterfaceId($actSepChar);
	}
	 
 static function getInterfacesTotNum():string|int
 {
 	return self::$xmlFormattedInterfacesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
  self::$xmlFormattedInterfacesTotNum=$actIntNum;
 }

 function serialize():void
 {
 	parent::serialize();
 	$serializer = $this->getSerializer();

 	$dispFields = $this->getDispFields();
 	$item1 = array("\$dispFields"=>$dispFields);
 	$serializer->loadItems($item1);
 	$fileName = $this->getFileName();
 	$item2 = array("\$fileName"=>$fileName);
 	$serializer->loadItems($item2);
 }
 
 function setXmlWriter(Xml_writer $actXmlWriter):void
 {
 	 $this->xmlWriter = $actXmlWriter;
 }
 
 function getXmlWriter():Xml_writer
 {
 	return $this->xmlWriter;
 }
 
 function setFileName(string $actFileName):void
 {
	$this->fileName = $actFileName;
	$itemStack = $this->getItemStack();
	$fileDumper = $itemStack->getDumper();
	$fileDumper->setFileName($this->fileName);
 }
 
 function getFileName():string
 {
   return $this->fileName;
 }
 
 function setCREnabled(bool $actEnabled):void
 {
 	$xmlWriter = $this->getXmlWriter();
 	$xmlWriter->setCREnabled($actEnabled);
 }
	
 function setDispFields($actDispFields):void
 {
 	if(is_array($actDispFields))
   $this->dispFields = $actDispFields;
  else
   $this->dispFields = array($actDispFields);
  /*else
   die(ERROR_2);*/
 }
 
 function getDispFields():array
 {
  return $this->dispFields;
 }
	
 static function createXmlWriter():Xml_writer
 {
 	return Creator::create(getClassNameForCreate(classes_info::XML_WRITER_CLASS),STRING_NULL);
 }	
 
 function getCompleteInterfaceId(string $actSepChar=Generic_interface::INTERFACE_ID_CHAR_SEP):string
 {
 	$interfaceId = $this->getInterfaceId($actSepChar);
 	return $interfaceId;
 }
 
 function getInstanceName(string $actSepChar=Generic_interface::INTERFACE_INSTANCE_CHAR_SEP):string
 {
 	$instanceName = $this->getAppName() . $actSepChar .
 	$this->getPageName() . $actSepChar . $this->getInterfaceId($actSepChar);
 	return $instanceName;
 }
 
 function getDualInterfaceName():string
 {
 	return STRING_NULL;
 }
 
 function action(string $actStr,Interfaces_container $actInterfacesContainer):void
 {
 //	$this->putData();
 }
	
}

?>