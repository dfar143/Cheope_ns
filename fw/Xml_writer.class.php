<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("xml.const.php");
require_once("Item_stack.class.php");
require_once("String_item.class.php");
require_once("Creator.tra.php");

class Xml_writer
{
 const ERROR_1="Xml_writer:Errore nell'inserimento dell'item_stack.";
 const ERROR_2="Xml_writer:Errore nell'inserimento del dumper.";

 const QUOTE_CHAR=STRING_DOUBLE_QUOTE;
	
 private $itemStack=null;
 private $flushEnabled=true;
 private $CREnabled=false; 
 
 function __construct(Item_stack $actItemStack=null)
 {
 	if(! is_null($actItemStack))
 	 $this->setItemStack($actItemStack);
 }
 
 function getItemStack():Item_stack
 {
 	return $this->itemStack;
 }
 
 function setItemStack(Item_stack $actItemStack):void
 {
 	 $this->itemStack = $actItemStack;
 }
 
 function setFlushEnabled(bool $actEnable):void
 {
 	$this->flushEnabled = $actEnabled;
 }
 
 function getFlushEnabled():bool
 {
 	return $this->flushEnabled;
 }
 
 function setCREnabled(bool $actCREnabled):void
 {
 	$this->CREnabled = $actCREnabled;
 }
 
 function getCREnabled():bool
 {
 	return $this->CREnabled;
 }
 
 function getDumper():Dumper
 {
 	$itemStack = $this->getItemStack();
 	$dumper = $itemStack->getDumper();
 	return $dumper;
 }
 
 function setDumper(Dumper $actDumper):void
 {
 	$itemStack = $this->getItemStack();
 	$itemStack->setDumper($actDumper);
 }
 
 static function createStringItem():String_item
 {
 	$stringItem=Creator::create(Creator::create(Classes_info::STRING_ITEM_CLASS),STRING_NULL);
 	$stringItem->setType(STRING_NULL);
 	return $stringItem;
 } 
 
 function sendData():void
 {
 	$dumper = $this->getDumper();
 	$itemStack = $this->getItemStack();
 	$flushEnabled = $this->getFlushEnabled();
 	if(! is_a($dumper,Classes_info::MEMORY_DUMPER_CLASS))
 	{
 	 if($flushEnabled)
 	  $itemStack->flush();
 	 else
 	  $itemStack->dump();
  }
 }
 
function putXmlPrologString(string $actVersion,string $actEncoding):Xml_writer
{
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();  
 $stringItem->setItem(XML_TAG_INIT_CHAR . "?xml version=" . 
 self::QUOTE_CHAR . $actVersion . 
 self::QUOTE_CHAR . " encoding=" . self::QUOTE_CHAR . $actEncoding . 
 self::QUOTE_CHAR . STRING_QUESTION_MARK . XML_TAG_END_CHAR);
 $itemStack->push($stringItem);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
  $stringItem->tail_add(STRING_ESC_RETURN);
 $this->sendData();
 return $this;
}


function putDocTypeTag(string $actStr):Xml_writer
{
 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem();
 $stringItem->setItem(XML_TAG_INIT_CHAR . 
 "!DOCTYPE " . $actStr . XML_TAG_END_CHAR);
 $CREnabled = $this->getCREnabled();
 if($CREnabled)
 $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this;
}

function putGenericXmlString(?string $actStr,int $actNumSpace=0):Xml_writer
{
 $space=STRING_NULL;
 for($i=0;$i<=$actNumSpace-1;$i++)
  $space = $space . STRING_SPACE;

 $itemStack = $this->getItemStack();
 $stringItem = self::createStringItem(); 
 $stringItem->setItem($space . $actStr);
  
 $CREnabled = $this->getCREnabled();
 if($CREnabled)  
  $stringItem->tail_add(STRING_ESC_RETURN);
 $itemStack->push($stringItem);
 $this->sendData();
 return $this; 
}

function put(string $actStr,int $actNumSpace=0):void
{
	$this->putGenericHtmlString($actStr,$actNumSpace);
}


function putGenericArrayOpenTag(string $actTag,array $actPropArray):Xml_writer
{
 $propStr = STRING_SPACE;
 if(array_is_assoc($actPropArray)&&($actTag !== STRING_NULL))
 {
 	foreach($actPropArray as $ind=>$val)
 	{
   if($ind !== STRING_NULL)
   {
   	$propStr .= STRING_SPACE . $ind . STRING_EQUAL . 
   	self::QUOTE_CHAR . $val . self::QUOTE_CHAR;
   }  
  }    
  $itemStack = $this->getItemStack();
  $stringItem = self::createStringItem();		
  $stringItem->setItem(XML_TAG_INIT_CHAR . $actTag . 
  $propStr . XML_TAG_END_CHAR);
  $CREnabled = $this->getCREnabled();
  if($CREnabled)
   $stringItem->tail_add(STRING_ESC_RETURN);
  $itemStack->push($stringItem);
  $this->sendData();
 }
 return $this;
}


}

?>