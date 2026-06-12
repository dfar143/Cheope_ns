<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_formatted_interface.class.php");


class Html_fragment extends Html_formatted_interface
{

 const BODY_ID_SUFFIX="body";

 private $htmlFragment=STRING_NULL;
 private $divEnvelope=true;
 static private $fragmentsTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$fragmentsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$fragmentsTotNum - 1;
 	parent::__construct($actOp,Interfaces_info::INT_HTML_FRAGMENT,$actNum);
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$fragmentsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$fragmentsTotNum=$actIntNum + 0;
 } 
 
 function enableBootstrap():void
 {
 } 
 
 function isStandard():bool
 {
 	return true;
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$serializer = $this->getSerializer();
 	$htmlFragment = $this->getHtmlFragment();
 	$item1 = array("@htmlFragment"=>$htmlFragment);
 	$serializer->loadItems($item1);
 	$divEnvelope = $this->getDivEnvelope();
 	$item2 = array("divEnvelope"=>$divEnvelope);
 	$serializer->loadItems($item2);		
 }

 function setDivEnvelope(string $actDivEnvelope):void
 {
 	$this->divEnvelope = $actDivEnvelope;
 }
 
 function getDivEnvelope():string
 {
 	return $this->divEnvelope;
 }

 function getHtmlFragment():string
 {
 	return $this->htmlFragment;
 }
 
 function setHtmlFragment(string $actHtmlFragment):void
 {
 	$this->htmlFragment = $actHtmlFragment;
 }
 
  function isDecorator():bool
	{
		return false;
	}
	
	function isContainer():bool
	{
		return false;
	}
 
 function putData():void
 {
  $htmlWriter = $this->getHtmlWriter();
 	$cssClass = $this->getCssClass();
 	$htmlFragment = $this->getHtmlFragment();
 	$type = $this->getType();
 	$num = $this->getNum();
 	$divEnvelope = $this->getDivEnvelope();
 	$id = $this->getInterfaceId();
 	$style = $this->getStyle();	
 	
 	if($divEnvelope)
 	{
 	$htmlWriter->putDivOpenTag($id,$style,$cssClass);
  }
 	$htmlWriter->putGenericHtmlString($htmlFragment);
 	if($divEnvelope)
 	{
 	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
  }
 }

}

?>