<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("generic.fun.php");


class Std_bootstrap_carousel extends Html_data_interface
{
// const ERROR_1 = "Cheope_ns_carousel:Errore nell'inserimento dell'interface container.";
 const ERROR_1 = "Std_bootstrap_carousel:Numero campi dati errato.";
 const ERROR_2 = "Std_boostrap_carousel:Numero etichette maggiore del numero di interfacce."; 
 const DEFAULT_CSS_CLASS = "carousel";
 const CAROUSEL_INNER = "carousel-inner";
 const CAROUSEL_ITEM = "carousel-item";
 const CAROUSEL_CAPTION = "carousel-caption";
 const BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const CAROUSEL_ITEM_ID_SUFFIX = "carousel_id_suffix";
 const VOICES_POS = 0;
 const DEFAULT_DATA_INTERVAL = 6000;
 const DEFAULT_CSS_MODULE = CSS_BOOTSTRAP_CAROUSEL;
 const DEFAULT_HEADER = STRING_NULL;
 
  private $voicesField = STRING_NULL; 
  private $dataInterval = self::DEFAULT_DATA_INTERVAL;
  private $header=self::DEFAULT_HEADER;
  static private $tablesTotNum = 0;
  static $useJQuery = false;
  static $useDojo = false;
  static $hasJavascriptEnabledSwitch = false;
  static $hasJavascriptManagement = false;
  static $hasCssManagement = true;
     
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tablesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tablesTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_BOOTSTRAP_CAROUSEL,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
	function hasJavascriptEnabledSwitch():bool
	{
		return self::$hasJavascriptEnabledSwitch;
	}
	
	function hasJavascriptManagement():bool
	{
		return self::$hasJavascriptManagement;
	}
	
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 function getHeader(array $actRow):string
 {
 	return $this->header;
 }

 function setHeader(string $actHeader):void
 {
 	$this->header = $actHeader;
 }
 
 function getDataInterval():int
 {
  return $this->dataInterval;
 }
 
 function setDataInterval(int $actDataInterval):void
 {
	$this->dataInterval = $actDataInterval;
 }
 
 function getBootstrapCarouselVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $bootstrapCarouselVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $bootstrapCarouselVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $bootstrapCarouselVoices;
 }

 function setBootstrapCarouselVoices(array $actBootstrapCarouselVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actBootstrapCarouselVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actBootstrapCarouselVoices);
 } 
 }

 function addBootstrapCarouselVoice(string $actBootstrapCarouselVoice):void
 {
  $bootstrapCarouselVoices = $this->getBootstrapCarouselVoices();
  $bootstrapCarouselVoices[] = $actBootstrapCarouselVoice;
  $this->setBootstrapCarouselVoices($bootstrapCarouselVoices);
 }
 
 function deleteItem(int $actPos):bool
 {
  $voices = $this->getBootstrapCarouselVoices();
  $num = count($voices);
  
  if(($actPos <= $num-1)&&($actPos>=0))
  {
   unset($voices[$actPos]);
   unset($ids[$actPos]);
   for($i=$actPos;$i<=$num-1;$i++)
   {
    $j = $i + 1;
    if($j <= $num-1)
    {
   	 $voices[$i] = $voices[$j];
   	 $ids[$i] = $ids[$j];
    }
    else
    {
   	 unset($voices[$i]);
   	 unset($ids[$i]);
    }
   }
   $this->setBootstrapCarouselVoices($voices);
  }
  else
   return false;
   
  $interfacesContainer = $this->getInterfacesContainer();
  $interfacesContainer->deleteItem($actPos);
  return true;
 }

 function getNumItems():int
 {
  $voices = $this->getBootstrapCarouselVoices();
  return count($voices); 
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tablesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$tablesTotNum=$actIntNum + 0;
 }
 
 function enableBootstrap():void
 {
  $this->setBootstrapEnabled(true);
 }
 
 function isStandard():bool
 {
 	return false;
 }

 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	//$interfacesContainer = $this->getInterfacesContainer();
 	//$item1 = array("interfacesContainer"=>$interfacesContainer);
 	//$serializer->loadItems($item1);
  $voicesField = $this->getVoicesField();
 	$item3 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item3);
  $header = $this->getHeader(array());
 	$item4 = array("header"=>$header);
  $serializer->loadItems($item4);
  $dataInterval = $this->getDataInterval();
  $item5 = array("dataInterval"=>$dataInterval);
  $serializer->loadItems($dataInterval);
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item5 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item5); 	
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function putContainer(array $actDataValues):void
 { 
  $htmlWriter = $this->getHtmlWriter();
 	$dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 1)
   die(self::ERROR_1);
	$interfacesContainer = $this->getInterfacesContainer();
  $cssClass = $this->getCssClass();
  $cssClass1 = self::BOOTSTRAP_CONTAINER_TYPE_1; 
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
	$iterator = $interfacesContainer->create();
  $voicesField = $this->getVoicesField();
  $dataInterval = $this->getDataInterval();
 
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass1);	
  $htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,
  self::BOOTSTRAP_CONTAINER_TYPE_1);	
  if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;
	$labels = $actDataValues[$labelDataField];	  
  
  $htmlWriter->putH3OpenTag(STRING_NULL,STRING_NULL,STRING_NULL);
  $header = $this->getHeader(array());
  $htmlWriter->putGenericHtmlString($header);
  $htmlWriter->putGenericHtmlString(H3_CLOSE_TAG);
  $cssClass .= " slide"; 
	$htmlWriter->putGenericArrayOpenTag(DIV_TAG,
	array("id"=>"gallery-carousel","class"=>$cssClass,
	"data-ride"=>"carousel","data-interval"=>$dataInterval));
	$htmlWriter->putGenericArrayOpenTag(DIV_TAG,
	array("class"=>self::CAROUSEL_INNER,"role"=>"listbox"));
	
	$num = count($labels);
    if(count($labels)<=$iterator->count())
	{
	for($i=0;$i<=$num-1;$i++)
	{
	 $label = $labels[$i];			
	 $ctl = $iterator->current();
	 if (is_a($ctl,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))
	 {
	 	$ctl->setHtmlWriter($htmlWriter);
	  $ctlType = $ctl->getType();
	  $htmlWriter->putDivOpenTag(self::CAROUSEL_ITEM_ID_SUFFIX . VAR_SEP . $i,
	  "height:400px",
	  self::CAROUSEL_ITEM . 
	 (($i==0)?STRING_SPACE . "active":STRING_NULL));
	 	$ctl->putData();
	 	$htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,self::CAROUSEL_CAPTION);
	 	$htmlWriter->putGenericHtmlString($label);
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
    $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);  
   }
	 $iterator->next();	
	}
	}
	else 
	 die(self::ERROR_2);
  
  //$htmlWriter->putGenericArrayOpenTag(ANCHOR_TAG,array("class"=>"left carousel-control",
  //"href"=>"#gallery-carousel","role"=>"button","data-slide"=>"prev"));
  //$htmlWriter->putGenericArrayOpenTag(SPAN_TAG,
  //array("class"=>"icon-prev","aria-hidden"=>"true"));
  $htmlWriter->putGenericArrayOpenTag(ANCHOR_TAG,array("class"=>"carousel-control-prev",
  "href"=>"#gallery-carousel","role"=>"button","data-slide"=>"prev"));
  $htmlWriter->putGenericArrayOpenTag(SPAN_TAG,
  array("class"=>"carousel-control-prev-icon","aria-hidden"=>"true"));
  $htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);	
  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);	
  
  $htmlWriter->putGenericArrayOpenTag(ANCHOR_TAG,array("class"=>"carousel-control-next",
  "href"=>"#gallery-carousel","role"=>"button","data-slide"=>"next"));
  $htmlWriter->putGenericArrayOpenTag(SPAN_TAG,
  array("class"=>"carousel-control-next-icon","aria-hidden"=>"true"));
  $htmlWriter->putGenericHtmlString(SPAN_CLOSE_TAG);
  $htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);	
  
  $htmlWriter->putOlOpenTag(STRING_NULL,STRING_NULL,
  "carousel-indicators","1","1");
 
  for($i=0;$i<=$num-1;$i++)
  {
   ($i==0)?($htmlWriter->putGenericArrayOpenTag(LI_TAG,array(
  "data-target"=>"#gallery-carousel",
  "data-slide-to"=>$i,
  "class"=>"active"))):($htmlWriter->putGenericArrayOpenTag(LI_TAG,array(
  "data-target"=>"#gallery-carousel",
  "data-slide-to"=>$i)));
  $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
  
  /*$htmlWriter->putGenericArrayOpenTag(LI_TAG,array(
  "data-target"=>"#gallery-carousel",
  "data-slide-to"=>1));
  $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
  
  $htmlWriter->putGenericArrayOpenTag(LI_TAG,array(
  "data-target"=>"#gallery-carousel",
  "data-slide-to"=>2));
  $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);
  
 $htmlWriter->putGenericArrayOpenTag(LI_TAG,array(
  "data-target"=>"#gallery-carousel",
  "data-slide-to"=>3));
  $htmlWriter->putGenericHtmlString(LI_CLOSE_TAG);*/
  }
  
  $htmlWriter->putGenericHtmlString(OL_CLOSE_TAG);
  
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
	$rows = $this->getDataSource();
  $dataValues = array(); 
  $dataValues = $this->extractDataFromDataSource($rows);
	$this->putContainer($dataValues);
 } 
}


?>