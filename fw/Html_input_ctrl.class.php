<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("html.fun.php");
require_once("generic.fun.php");
require_once("InputCtrl_putInputCtrlClasses.class.php");


class Html_input_ctrl extends Html_data_interface
{

 const ERROR_0="Html_input_ctrl:Errore in function putInputCtrl:Incongruenza fra tipo di dati e dominio.";
 const ERROR_1="Html_input_ctrl:Errore nei campi dati.Deve esistere almeno un campo.";	
	
 const DEFAULT_INPUT_CTRL_CSS_CLASS="input_ctrl";
 const DEFAULT_INPUT_CTRL_STOP = STRING_NULL;
 const INPUT_CTRL_DIV_ID_SUFFIX="div_id";
 const DEFAULT_LENGTH = 15;
 const DEFAULT_TAB_INDEX = 0;
 
 private $prefixBeforeName=false;
 private $tabIndex=self::DEFAULT_TAB_INDEX;
 private $dataFieldEvents=array();
 //
 // Elemento selezionato della lista (nel caso che i controllo corrisponda ad una lista).
 //
 private $selectedItem=STRING_NULL;
 //
 // Corrisponde all'attributo maxLength
 // che può enche essere trascurato.
 // 
 private $stop=self::DEFAULT_INPUT_CTRL_STOP;
 //
 // Corrisponde all'attributo size. 
 //
 private $fieldLength = self::DEFAULT_LENGTH;
 static private $inputCtrlsTotNum=0;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$inputCtrlsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$inputCtrlsTotNum - 1; 
  parent::__construct($actObj,$actOp,self::INT_HTML_INPUT_CTRL,$actNum);
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$inputCtrlsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$inputCtrlsTotNum=$actIntNum + 0;
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
 	$prefixBeforeName = $this->getPrefixBeforeName();
 	$item1 = array("*prefixBeforeName"=>$prefixBeforeName);
 	$serializer->loadItems($item1);	
 	$tabIndex = $this->getTabIndex();
 	$item2 = array("tabIndex"=>$tabIndex);
 	$serializer->loadItems($item2);
 	$stop = $this->getStop();	
 	$item3 = array("stop"=>$stop);
 	$serializer->loadItems($item3);
 	$dataFieldEvents = $this->getDataFieldEvents();
 	$item4 = array("dataFieldEvents"=>$dataFieldEvents);
 	$serializer->loadItems($item4);	
 	$selectedItem = $this->getSelectedItem();
 	$item5 = array("selectedItem"=>$selectedItem);
 	$serializer->loadItems($item5);	
 	$length = $this->getFieldLength();
 	$item6 = array("fieldLength"=>$length);
 	$serializer->loadItems($item6); 				
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_INPUT_CTRL_CSS_CLASS;
 else
  return $this->cssClass;
 }

 function getStop():string|int
 {
	if($this->stop==STRING_NULL)
 	return self::DEFAULT_INPUT_CTRL_STOP;
    else
	return $this->stop; 
 }
 
 function setStop(string|int $actStop):void
 {
  $this->stop = $actStop;
 }
 
 function getFieldLength():int|string
 {
 	if($this->fieldLength == NO_VALUE)
 	 return self::DEFAULT_LENGTH;
 	else 
 	return $this->fieldLength;
 }
 
 function setFieldLength(int|string $actFieldLength):void
 {
 	$this->fieldLength = $actFieldLength;
 }
 
 function setSelectedItem(int|string $actSelectedItem):void
 {
 	$this->selectedItem = $actSelectedItem;
 }
 
 function getSelectedItem():int|string
 {
 	return $this->selectedItem;
 }
 
 function setPrefixBeforeName(bool $actPrefixBeforeName):void
 {
 	$this->prefixBeforeName = $actPrefixBeforeName;
 }
 
 function getPrefixBeforeName():bool
 {
 	return $this->prefixBeforeName;
 }
 
 function setTabIndex(int|string $actTabIndex):void
 {
 	$this->tabIndex = $actTabIndex;
 }
 
 function getTabIndex():int|string
 {
 	if($this->tabIndex == NO_VALUE)
 	 return self::DEFAULT_TAB_INDEX;
 	else 
 	return $this->tabIndex;
 }
 
 function getDataFieldEvents():array
 {
  return $this->dataFieldEvents;
 }
 
 function setDataFieldEvents(array $actDataFieldEvents):void
 {
  $this->dataFieldEvents = $actDataFieldEvents;
 }
 

function putInputCtrl(string $actName,$actValue,string $actType,
string $actDomain,$actLength,$actStop,$actTabIndex,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):void
{
 $htmlWriter = $this->getHtmlWriter();
 $op = $this->getOp();
 $selectedItem = $this->getSelectedItem();
 $dataSource = $this->getDataSource();
 $factory = new putInputCtrl_factory($actName,$actValue,
 $actType,$actLength,$actStop,$actTabIndex,$selectedItem,
 $dataSource,$op,
 $actOnChange,$actOnClick);
 $obj = $factory->create($actDomain,$htmlWriter);
 $obj->exec();
}
 
 function isContainer():bool
 {
  return false;
 }
 
 
 function putData():void
 { 
  $htmlWriter = $this->getHtmlWriter();
  $rows = $this->getDataSource();
  $dataFields = $this->getDataFields();	
  if(count($dataFields) >= 1)
 	 $fieldName = $dataFields[0];
 	else
 	 die(self::ERROR_1);
 	 
	$domain = $this->getDataFieldDomainByName($fieldName);

//
// Mi aspetto un valore atomico;
//		
  if(isset($rows))
  {
   if(! is_array($rows))
    $fieldValue=$rows;
   elseif(count($rows)>0)
   {
    if(isset($rows[$fieldName]) && is_array($rows[$fieldName])&& isset($rows[$fieldName][0]))
     $fieldValue = $rows[$fieldName][0];
    elseif(isset($rows[0]) && isset($rows[0][$fieldName]))
     $fieldValue = $rows[0][$fieldName];
    elseif(isset($rows[$fieldName]))
     $fieldValue = $rows[$fieldName]; 
    else
      $fieldValue = NO_VALUE;
   }
   else
    $fieldValue = NO_VALUE;
  }
  else
   $fieldValue = NO_VALUE;

  if($fieldValue != NO_VALUE)
  $this->setSelectedItem($fieldValue);
 	
  $cssClass = $this->getCssClass();
  $style = $this->getStyle();
  $intCode = $this->getInterfaceId();
  $type = $this->getDataFieldType($fieldName);
	$length = $this->getFieldLength();
	$tabIndex = $this->getTabIndex();
	$stop = $this->getStop();
	
	
	//die(var_dump($stop));
  $fieldValue = $this->getDataFieldAllValues($fieldName,$fieldValue); 
	$events = $this->getDataFieldEvents();

	if(isset($events[0]))
	 $onChangeEventCode = $events[0];
	else
	 $onChangeEventCode=STRING_NULL;
  
	if(isset($events[1]))
	 $onClickEventCode = $events[1];
	else
	 $onClickEventCode=STRING_NULL;
	   
  $divId=STRING_NULL;
  
	if($this->getPrefixBeforeName())
	{
	 $fieldName = $intCode . VAR_SEP . $fieldName;
   $divId = $fieldName . VAR_SEP . self::INPUT_CTRL_DIV_ID_SUFFIX;
  }
  
	$htmlWriter->putDivOpenTag($divId,$style,$cssClass);
  $this->putInputCtrl($fieldName,$fieldValue,$type,$domain,
  $length,$stop,$tabIndex,$onChangeEventCode,$onClickEventCode);
 	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);   
 }
 
}


?>