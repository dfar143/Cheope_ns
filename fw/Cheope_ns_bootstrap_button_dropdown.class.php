<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_bootstrap_button_dropdown extends Html_data_interface
{ 
 const ERROR_1="Cheope_ns_bootstrap_button_dropdown:Numero campi dati errato.";
 const DEFAULT_CSS_CLASS="btn-group";
 const DEFAULT_JAVASCRIPT_MODULE = JS_POPPER;

 const BUTTON_TYPE_PRIMARY="primary";
 const BUTTON_TYPE_SECONDARY="secondary";
 const BUTTON_TYPE_SUCCESS="success";
 const BUTTON_TYPE_INFO="info";
 const BUTTON_TYPE_WARNING="warning";
 const BUTTON_TYPE_DANGER="danger";
 const DEFAULT_BUTTON_TYPE=self::BUTTON_TYPE_PRIMARY;
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 
 private $gesPage=STRING_NULL;
 private $buttonType=self::DEFAULT_BUTTON_TYPE;
 private $dropDownStyle=STRING_NULL;
 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL;
 static private $nLevelsTotNum=0;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = false;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$nLevelsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;
  $this->bootstrapEnabled=true;
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
  parent::__construct($actObj,$actOp,self::INT_BOOTSTRAP_BUTTON_DROPDOWN,$actNum);
 }
 
 	function useJQuery():bool
	{
		return self::$useJQuery;
	}
	
 	function useDojo():bool
	{
		return self::$useDojo;
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
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$nLevelsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$nLevelsTotNum=$actIntNum + 0;
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
 	$gesPage = $this->getGesPage();
 	$item1 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item1);	 
 	$buttonType = $this->getButtonType();
 	$item2 = array("buttonType"=>$buttonType);
 	$serializer->loadItems($item2);
	$dropDownStyle = $this->getDropDownStyle();
 	$item3 = array("dropDownStyle"=>$dropDownStyle);
 	$serializer->loadItems($item3);	 		
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item6 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item6);
 }

 function getGesPage():string
 {
 	return $this->gesPage;
 }
 
 function setGesPage(string $actGesPage):void
 {
 	$this->gesPage = $actGesPage;
 } 
 
 function getButtonType():string
 {
  return $this->buttonType;
 }
 
 function setButtonType(string $actButtonType):void
 {
   $this->buttonType = $actButtonType;
 }
 
 function getDropDownStyle():string
 {
  return $this->dropDownStyle;
 }
 
 function setDropDownStyle(string $actDropDownStyle):void
 {
   $this->dropDownStyle = $actDropDownStyle;
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
 }
  
 function isContainer():bool
 {
  return false;
 }
 
 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }
 
 function setPagesField(string $actPagesField):void
 {
 	$this->pagesField = $actPagesField;
 }
 
 function getPagesField():string
 {
 	return $this->pagesField;
 }
 
 function setIdsField(string $actIdsField):void
 {
 	$this->idsField = $actIdsField;
 }
 
 function getIdsField():string
 {
 	return $this->idsField;
 }

 function putMenu(array $actDataValues):void
 {
  $htmlWriter = $this->getHtmlWriter();
  $intCode = $this->getInterfaceId();
  $style = $this->getStyle();
  $class = $this->getCssClass();  
  $dropDownStyle = $this->getDropDownStyle();

 $dataFields = $this->getDataFields();

   $voicesField = $this->getVoicesField();
   $pagesField = $this->getPagesField();
   $idsField = $this->getIdsField();
  
   if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
   {
	 $labelDataField = $dataFields[self::VOICES_POS];
   }
   else
	 $labelDataField = $voicesField;
   $labels = $actDataValues[$labelDataField];	  
  
   if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
   {
	 $pageDataField = $dataFields[self::PAGES_POS];
   }
   else
	$pageDataField = $pagesField;
	
   $pages = $actDataValues[$pageDataField];

   if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
   {
	 $idDataField = $dataFields[self::IDS_POS];
   }
   else
	$idDataField = $idsField;
   $ids = $actDataValues[$idDataField];
   
   $htmlWriter->putDivOpenTag($intCode,$style,$class); 
   $buttonCssClass = "btn";
   $type = $this->getButtonType();
   $typeClass = $buttonCssClass . STRING_SPACE . "btn-" . $type;
   $typeClass1 = $typeClass . STRING_SPACE . "dropdown-toggle dropdown-toggle-split";
   $htmlWriter->putButtonOpenTag(STRING_NULL,STRING_NULL,$typeClass,ucfirst($type));
   $htmlWriter->putGenericHtmlString(BUTTON_CLOSE_TAG);
   $htmlWriter->putGenericArrayOpenTag(BUTTON_TAG,
  	array("class"=>$typeClass1,
  	"type"=>"button",
  	"data-toggle"=>"dropdown"));
   $htmlWriter->putGenericHtmlString(BUTTON_CLOSE_TAG);
   $htmlWriter->putDivOpenTag($intCode,STRING_NULL,"dropdown-menu");
   foreach($labels as $ind=>$val)
   {
	$page = $pages[$ind];
	$buttonDropDownLabel = $val;
 	if((isset($ids[$ind]))&&($ids[$ind] != STRING_NULL))
 	 $pars = URL_PARS_START . PAR . URL_PAR_EQUAL .  $ids[$ind];
	else
	 $pars = STRING_NULL;
	$url = $page . $pars;
    $htmlWriter->putHrefOpenTag(STRING_NULL,$dropDownStyle,"dropdown-item",$url);
	$htmlWriter->putGenericHtmlString($val);
	$htmlWriter->putGenericHtmlString(ANCHOR_CLOSE_TAG);  
   }
   $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);	
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
  $dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 3)
   die(self::ERROR_1);	 
  $rows = $this->getDataSource();
  $rows = $this->initDataSource($rows);

  $dataValues = $this->extractDataFromDataSource($rows);  

  $this->putMenu($dataValues);
 }
 
}


?>