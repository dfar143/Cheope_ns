<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("generic.fun.php");


class Cheope_ns_tabs extends Html_data_interface
{ 
 
// const ERROR_1="Cheope_ns_tabs:Errore nell'inserimento dell'interface container.";
 const VOICES_POS=0;
 const LOCATIONS_POS=1;
 const DEFAULT_CSS_CLASS="tabs_container";
 const DEFAULT_CSS_MODULE=CSS_TABS;
 const TAB_BODY_ID_SUFFIX="body";
 const TAB_FIELD_ID_SUFFIX="field";
 const SELECTED_TAB_FIELD_ID_SUFFIX="selected_field";
 const TAB_CSS_CLASS="tab";
 const TAB_LABEL_CSS_CLASS="tab_label";
 const SELECTED_TAB_CSS_CLASS="selected_tab";
 const SELECTED_TAB_LABEL_CSS_CLASS="selected_tab_label";
 const VOID_TAB_CSS_CLASS="void_tab";
 const VOID_TAB_LABEL_CSS_CLASS="void_tab_label";
 const TAB_BODY_CSS_CLASS="tab_body";
 const DEFAULT_SELECTED_TAB = 0;

 private $voicesField=STRING_NULL;
 private $locationsField=STRING_NULL;
 private $selectedTab=self::DEFAULT_SELECTED_TAB;
 static private $tabsTotNum=0;
 static $hasCssManagement=true;
   
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$tabsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$tabsTotNum - 1;
 	//self::$hasCssManagement=true;
  parent::__construct($actObj,$actOp,self::INT_TABS,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$tabsTotNum;
 }
 
  function enableBootstrap():void
  {
  }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	parent::serialize();
 	//$serializer = $this->getSerializer();
	//$booleanPropsArray=array();
	//$this->serialize_props_exec($booleanPropsArray);
 	//parent::serialize();
 	$serializer = $this->getSerializer();
	$voicesField = $this->getVoicesField();
 	$item1 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item1);
  $locationsField = $this->getLocationsField();
 	$item3 = array("locationsField"=>$locationsField);
  $serializer->loadItems($item3);
 	$selectedTab = $this->getSelectedTab();
 	$item4 = array("selectedTab"=>$selectedTab);
 	$serializer->loadItems($item4);
 	/*$interfacesContainer = $this->getInterfacesContainer();
 	$item5 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item5);	*/
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
 
 function setLocationsField(string $actLocationsField):void
 {
 	$this->locationsField = $actLocationsField;
 }
 
 function getLocationsField():string
 {
 	return $this->locationsField;
 }
 
 function setSelectedTab(int $actSel)
 {
  $this->selectedTab = $actSel;
 }
 
 function getSelectedTab():int
 {
 	if($this->selectedTab == NO_VALUE)
 	 return self::DEFAULT_SELECTED_TAB;
 	else
   return $this->selectedTab;
 }
  
 function isContainer():bool
 {
  return true;
 }
 
 //La struttura del contenuto è racchiusa in tabelle in successione
 //una dopo l'altra del numero sufficiente a contenere tutti i controlli.
 function putContainer(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $intCode = $this->getInterfaceId();
	$dataFields = $this->getDataFields();
  $style = $this->getStyle();
	$selTab = $this->getSelectedTab();
	$cssClass = $this->getCssClass();
  $interfacesContainer = $this->getInterfacesContainer();
  
  $voicesField = $this->getVoicesField();
  $locationsField = $this->getLocationsField();
  
	if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 	$labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;
	$labels = $actDataValues[$labelDataField];	  
  
	if(($locationsField==STRING_NULL)||(! in_array($locationsField,$dataFields)))
	{
	 	$locationDataField = $dataFields[self::LOCATIONS_POS];
	}
	else
	 $locationDataField = $locationsField;
	$locations = $actDataValues[$locationDataField];
  
  $num1 = count($labels);
  
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
	$htmlWriter->putTableOpenTag($intCode . VAR_SEP . "inner_table",$cssClass,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableRowOpenTag(STRING_NULL,STRING_NULL,STRING_NULL);
  for($k=0;$k<=$num1-1;$k++)
  {
	 $label = $labels[$k];
	 $location = $locations[$k];		 
	 if ($k != $selTab)
	 {
		$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::TAB_CSS_CLASS,STRING_NULL,
		STRING_NULL,STRING_NULL);
		$htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::TAB_FIELD_ID_SUFFIX . VAR_SEP . 
		$k,STRING_NULL,self::TAB_LABEL_CSS_CLASS,"window.location = '" . $location . "'");
		$htmlWriter->putGenericHtmlString($label);
		$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
		$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	 }
	 else
	 {
		$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::SELECTED_TAB_CSS_CLASS,
		STRING_NULL,STRING_NULL,STRING_NULL);
	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::SELECTED_TAB_FIELD_ID_SUFFIX . 
	  VAR_SEP . $k,STRING_NULL,
	  self::SELECTED_TAB_LABEL_CSS_CLASS,
	  "window.location = '" . $location . "'");
		$htmlWriter->putGenericHtmlString($label);
		$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
		$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	 }
	}
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::VOID_TAB_CSS_CLASS,STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putGenericHtmlString(ENTITY_SPACE,0);
	$htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,self::VOID_TAB_LABEL_CSS_CLASS,STRING_NULL);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
  $htmlWriter->putTableRowOpenTag(STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::TAB_BODY_CSS_CLASS,STRING_NULL,STRING_NULL,($num1+1),STRING_NULL,STRING_NULL);
	$htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::TAB_BODY_ID_SUFFIX);

	$iterator = $interfacesContainer->create();
	while($iterator->hasMore())
	{
	 $ctrl = $iterator->current();
	 $ctrl->putData();
	 $iterator->next();
	}	
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);	
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