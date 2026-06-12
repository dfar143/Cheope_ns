<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");


class Std_local_tabs extends Html_data_interface
{ 

// const ERROR_1="Std_local_tabs:Errore nell'inserimento dell'interface container.";
// const ERROR_2="Std_local_tabs:Errore l'interface container non può essere vuoto.";
 const ERROR_3="Std_local_tabs.putData:Numero campi dati errato.";
 const VOICES_POS=0;
 const DEFAULT_CSS_CLASS="local_tabs_container";
 const TAB_BODY_ID_SUFFIX="body";
 const TAB_FIELD_ID_SUFFIX="field";
 const SELECTED_TAB_FIELD_ID_SUFFIX="selected_field";
 const TAB_CSS_CLASS= "local_tab";
 const TAB_LABEL_CSS_CLASS= "local_tab_label";
 const SELECTED_TAB_CSS_CLASS= "selected_local_tab";
 const SELECTED_TAB_LABEL_CSS_CLASS= "selected_local_tab_label";
 const VOID_TAB_CSS_CLASS= "void_local_tab";
 const VOID_TAB_LABEL_CSS_CLASS= "void_local_tab_label";
 const TAB_BODY_CSS_CLASS="local_tab_body";
 const INNER_DIV_TAB_ID_SUFFIX="inner_div";
 const INNER_DIV_TAB_CSS_CLASS="tab_inner_div";
 const INNER_DIV_TAB_HEIGHT="100%";
 const INNER_DIV_TAB_WIDTH="100%";
 const INNER_DIV_TAB_CELLPADDING="0";
 const DEFAULT_CSS_MODULE=CSS_LOCAL_TABS;
 const DEFAULT_SELECTED_TAB = 0;
 
 private $voicesField=STRING_NULL; 
 private $selectedTab=self::DEFAULT_SELECTED_TAB;
 static private $lTabsTotNum=0;
 static $hasCssManagement = true;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lTabsTotNum++;
  if($actNum === STRING_NULL)
 	$actNum = self::$lTabsTotNum - 1;

  parent::__construct($actObj,$actOp,self::INT_LOCAL_TABS,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . 
  DIR_SEP . self::DEFAULT_CSS_MODULE . 
  STYLE_SHEET_FILE_POSTFIX); 
 }

	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$lTabsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lTabsTotNum=$actIntNum + 0;
 }
 
 function isStandard():bool
 {
 	return false;
 }

 function serialize():void
 {
	parent::serialize();
					  
 	$serializer = $this->getSerializer();
 	$selectedTab = $this->getSelectedTab();
 	$item1 = array("selectedTab"=>$selectedTab);
 	$serializer->loadItems($item1);
  $voicesField = $this->getVoicesField();
 	$item2 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item2); 
 	/*$interfacesContainer = $this->getInterfacesContainer();
 	$item3 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item3);	*/
 }
 
 function setVoicesField(string $actVoicesField):void
 {
 	$this->voicesField = $actVoicesField;
 }
 
 function getVoicesField():string
 {
 	return $this->voicesField;
 }
 
 function getLocalTabsVoices():array
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
	 $localTabsVoices = $this->getDataFieldDomainValueByPos(self::VOICES_POS);
 }
 else
 {
	$labelsDataField = $voicesField;
  $localTabsVoices = $this->getDataFieldDomainValueByName($labelsDataField);
 }
 return $localTabsVoices;
 }

 function setLocalTabsVoices(array $actLocalTabsVoices):void
 {
 $dataFields = $this->getDataFields();
 $voicesField = $this->getVoicesField();
  
 if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
 {
  $this->setDataFieldDomainValueByPos(self::VOICES_POS,$actLocalTabsVoices);
 }
 else
 {
	$labelsDataField = $voicesField;
  $this->setDataFieldDomainValueByName($labelsDataField,$actLocalTabsVoices);
 } 
 }

 function addLocalTabsVoice(string $actLocalTabsVoice):void
 {
  $localTabsVoices = $this->getLocalTabsVoices();
  $localTabsVoices[] = $actLocalTabsVoice;
  $this->setLocalTabsVoices($localTabsVoices);
 }
 
 function getCssClass():string
 {
  if($this->cssClass == STRING_NULL)
   return self::DEFAULT_CSS_CLASS;
  else
   return $this->cssClass;
 }
 
 function setSelectedTab(int $actSel):void
 {
  $this->selectedTab = $actSel;
 }
 
 function getSelectedTab():string
 {
 	if($this->selectedTab == STRING_NULL) 
   return self::DEFAULT_SELECTED_TAB;
  else
   return $this->selectedTab;
 }
 
 function enableBootstrap():void
 {
 }
  
 function isContainer():bool
 {
  return true;
 }
 
 function initPutData():array
 {
 }
 
 //La struttura del contenuto è racchiusa in div in successione
 //una dopo l'altra del numero sufficiente a contenere tutti i controlli
 //I div si sovrappongono avendo position absolute.
 function putContainer(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
	$cssClass = $this->getCssClass();
	$style = $this->getStyle(); 
  $interfacesContainer = $this->getInterfacesContainer();
  $selTab = $this->getSelectedTab();
	$dataFields = $this->getDataFields();
  $num = count($dataFields);
  if($num < 1)
   die(self::ERROR_3);		
	$voicesField = $this->getVoicesField();
	if(($voicesField==STRING_NULL)||(! in_array($voicesField,$dataFields)))
	{
	 $labelDataField = $dataFields[self::VOICES_POS];
	}
	else
	 $labelDataField = $voicesField;

	$labels = $actDataValues[$labelDataField];	  
  $num1 = count($labels);	
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);	  
	$htmlWriter->putTableOpenTag($intCode . VAR_SEP . "inner_table",$cssClass,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableRowOpenTag(STRING_NULL,STRING_NULL,STRING_NULL);
  for($k=0;$k<=$num1-1;$k++)
  {
	 $label = $labels[$k];
	 $onClickCode="for(var i=0;i<=" . ($num1-1) . ";i++){var innerDiv = getElementById('" . 
		$intCode . VAR_SEP . self::INNER_DIV_TAB_ID_SUFFIX . VAR_SEP . "' + i);" .
		"var tabDiv = getElementById('" .
    $intCode . VAR_SEP . "col" . VAR_SEP . self::TAB_FIELD_ID_SUFFIX . VAR_SEP . 
    "' + i);" .	
		"if(i==" . $k . "){tabDiv.className='"  .
		self::SELECTED_TAB_CSS_CLASS . "';if(innerDiv!=null){innerDiv.style.display='block';innerDiv.style.borderTop='0px solid white';};tabDiv.style.borderBottom='0px solid white';}else{" .
		"tabDiv.className='" . self::TAB_CSS_CLASS . 
		"';tabDiv.style.borderBottom='1px solid white';if(innerDiv!=null)innerDiv.style.display='none';}}"; 
	 if ($k != $selTab)
	 { 
		$css = self::TAB_CSS_CLASS;
	 }
	 else
	 {
	 	$css = self::SELECTED_TAB_CSS_CLASS;
	 }
   $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col" . VAR_SEP . self::TAB_FIELD_ID_SUFFIX . VAR_SEP . 
	 $k,$css,STRING_NULL,STRING_NULL,STRING_NULL);
	 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::TAB_FIELD_ID_SUFFIX . VAR_SEP . 
	 $k,STRING_NULL,self::TAB_LABEL_CSS_CLASS,$onClickCode);
	 $htmlWriter->putGenericHtmlString($label);
	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	}
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::VOID_TAB_CSS_CLASS,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putGenericHtmlString(ENTITY_SPACE,0);
	$htmlWriter->putDivOpenTag(STRING_NULL,STRING_NULL,self::VOID_TAB_LABEL_CSS_CLASS,STRING_NULL);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
  $htmlWriter->putTableRowOpenTag(STRING_NULL,STRING_NULL,STRING_NULL);
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,self::TAB_BODY_CSS_CLASS,STRING_NULL,STRING_NULL,($num1+1),STRING_NULL,STRING_NULL);
  
	 $iterator = $interfacesContainer->create();
	 $iterator->reset();
	 $i=0;
	 while($iterator->hasMore())
	 {
	 	$style = "position" . STRING_COLON . "relative" . STRING_SEMICOLON . "width" . 
	 	STRING_COLON . self::INNER_DIV_TAB_WIDTH . STRING_SEMICOLON . "height" . 
	 	STRING_COLON . self::INNER_DIV_TAB_HEIGHT . STRING_SEMICOLON . "padding" . 
	 	STRING_COLON . self::INNER_DIV_TAB_CELLPADDING . STRING_SEMICOLON;
	 	$ctl = $iterator->current();
	 	if($i==$selTab)
	 	{
	 	 $style = $style . 
	 	 "display" . STRING_COLON . "block" . STRING_SEMICOLON;
	 	 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::INNER_DIV_TAB_ID_SUFFIX . VAR_SEP . $i,$style,self::INNER_DIV_TAB_CSS_CLASS,STRING_NULL);
	 	 $ctl->putData();
	 	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 	}
	 	else
	 	{
	 	 $style = $style . 
	 	 "display" . STRING_COLON . "none" . STRING_SEMICOLON;
	 	 $htmlWriter->putDivOpenTag($intCode . VAR_SEP . self::INNER_DIV_TAB_ID_SUFFIX . VAR_SEP . $i,
	 	 $style,self::INNER_DIV_TAB_CSS_CLASS,STRING_NULL);
	 	 $ctl->putData();
	 	 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 	}
	 	$iterator->next();
	 	$i++;
	 }	
	 
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);	
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0); 
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