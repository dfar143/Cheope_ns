<?
namespace Std\fw;
require_once("Std_forest_ctrl.class.php");

class Std_nLevels_forest_ctrl extends Std_forest_ctrl
{
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 const JAVASCRIPT_VAR_LABEL="label";
 const JAVASCRIPT_VAR_PAR="par";
 const JAVASCRIPT_VAR_LABELS="labels";
 const JAVASCRIPT_VAR_URLS="urls";
 const ERROR_1="Std_nLevels_forest_ctrl:Oggetto dati non valido.";
 const ERROR_2="Std_nLevels_forest_ctrl:Numero campi dati errato.";
 
 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL;
 static private $nLevelsTotNum=0;

function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
 self::$nLevelsTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;
 parent::__construct($actObj,$actOp,self::INT_NLEVELS_FOREST_CTRL,$actNum);
}

 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
	$voicesField = $this->getVoicesField();										
 	$item1 = array("voicesField"=>$voicesField);
  $serializer->loadItems($item1);
  $pagesField = $this->getPagesField();
 	$item2 = array("pagesField"=>$pagesField);
  $serializer->loadItems($item2);
  $idsField = $this->getIdsField();
 	$item3 = array("idsField"=>$idsField);
  $serializer->loadItems($item3);
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$nLevelsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$nLevelsTotNum=$actIntNum + 0;
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

function putMenuPars_recurse(array $actPageValue,array $actLabelValue,
array $actIdValue,string $actUrlsCode,string $actLabelsCode,string $actSep):void
{
 $htmlWriter = $this->getHtmlWriter();
 
 $actSep = $actSep . VAR_SEP;
 $intCode = $this->getInterfaceId();
 $page = $this->getGesPage(); 
 
 $pagesKeys = array_keys($actPageValue);
 $pagesValues = array_values($actPageValue);
 $labelsKeys = array_keys($actLabelValue);
 $labelsValues = array_values($actLabelValue);
 $idsKeys = array_keys($actIdValue);
 $idsValues = array_values($actIdValue);
  
 $j=0;

 foreach($labelsKeys as $labelKey)
 {	
 	$urlsCode = $actUrlsCode . VAR_SEP . $j;
  $labelsCode = $actLabelsCode . VAR_SEP . $j;
  $labelValue = $labelsValues[$j];
  $pageValue = (isset($pagesValues[$j])?$pagesValues[$j]:$page);
  $idValue = $idsValues[$j];
  $idKey = $idsKeys[$j];

  if(is_array($labelValue) or is_a($labelValue,"Countable"))
   $num2 = count($labelValue); 
  elseif(is_string($labelValue))
   $num2 = strlen($labelValue);
 	else
 	 $num2 = 0;

 	if(is_array($labelValue))
 	{
   $htmlWriter->putGenericHtmlString("var " . $actLabelsCode . VAR_SEP . $j . " = new Array(" . $num2 . ");"); 
	 $htmlWriter->putGenericHtmlString("var " . $actUrlsCode . VAR_SEP . $j . " = new Array(" . $num2 . ");");		
   $this->putMenuPars_recurse($pageValue,$labelValue,$idValue,$urlsCode,$labelsCode,$actSep); 
   $htmlWriter->putGenericHtmlString($actLabelsCode . "[" . $j . 
		 "]=" . "\"" . $actSep . $labelKey . "\";");	 
	 if ($page != NO_VALUE)
	 {
	  if (isset($idKey))
	  {
	  $pars = PAR . URL_PAR_EQUAL . $idKey;
	   $opGes = $page . URL_PARS_START . $pars;
	  }
	  else
	  {
	   $pars = PAR . URL_PAR_EQUAL . $j;
	   $opGes = $page . URL_PARS_START . $pars; 
	  } 
	 }
	 else
   {
   	$pageKey = $pagesKeys[$j];
    if (isset($pageKey) && isset($idKey))
    {
     $pars = PAR . URL_PAR_EQUAL . $idKey;
	   $opGes = $pageKey . URL_PARS_START . $pars;
	  }
	  else
	   $opGes=STRING_NULL; 
   }   
	 $htmlWriter->putGenericHtmlString($actUrlsCode . "[" . $j . "]=" . "\"" . $opGes . "\";");	
 	}
  else
  {
	 if ($page != NO_VALUE)
	 {
	  if (isset($idValue))
	  {
	  $pars = PAR . URL_PAR_EQUAL . $idValue;
	   $opGes = $page . URL_PARS_START . $pars; 
	  }
	  else
	  {
	   $pars = PAR . URL_PAR_EQUAL . $j;
	   $opGes = $page . URL_PARS_START . $pars; 
	  } 
	 }
	 else
   {
    if (isset($pageValue) && isset($idValue))
    {
     $pars = PAR . URL_PAR_EQUAL . $idValue;
	   $opGes = $pageValue . URL_PARS_START . $pars;
	  }
	  else
	   $opGes=STRING_NULL; 
   }   
	 $htmlWriter->putGenericHtmlString($actUrlsCode . "[" . $j . "]=" . "\"" . $opGes . "\";");
   $htmlWriter->putGenericHtmlString($actLabelsCode . "[" . $j . 
	"]=" . "\"" . $actSep . $labelValue . "\";");	
  }
  $j++;
  } 
 }

function putMenuPars(array $actDataValues):void
{
 $htmlWriter = $this->getHtmlWriter();
 $intCode = $this->getInterfaceId();
 $page = $this->getGesPage(); 
 $dataFields = $this->getDataFields();
 $num = count($dataFields);
  if($num < 3)
   die(self::ERROR_2);
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

  $pagesKeys = array_keys($pages);
  $pagesValues = array_values($pages);
  $labelsKeys = array_keys($labels);
  $labelsValues = array_values($labels);
  $idsKeys = array_keys($ids);
  $idsValues = array_values($ids);
 
  $htmlWriter->putGenericHtmlString(STRING_NULL);
  $htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . 
  "nVet = " . count($labelsKeys) . ";"); 
  $htmlWriter->putGenericHtmlString(STRING_NULL); 
 
  $j = 0; 

  foreach($labelsKeys as $labelKey)
  { 
	 $htmlWriter->putGenericHtmlString("var " . $intCode . 
	 VAR_SEP . self::JAVASCRIPT_VAR_LABEL . VAR_SEP . 
	 $j . " = " . "\"" . $labelKey . "\"" . ";");		
	 if ($page != NO_VALUE)
	  {
	   if (isset($idsKeys[$j]))
	   {
	    $pars = PAR . URL_PAR_EQUAL . $idsKeys[$j];
	    $opGes = $page . URL_PARS_START . $pars; 
	   }
	   else
	   {
	   	$pars = PAR . URL_PAR_EQUAL . $j;
	    $opGes = $page . URL_PARS_START . $pars; 
	   } 
	  }
	  else
    {
     if (isset($pagesKeys[$j]) && isset($idsKeys[$j]))
     {
     	$pars = PAR . URL_PAR_EQUAL . $idsKeys[$j];
	    $opGes = $pagesKeys[$j] . URL_PARS_START . $pars;
	   }
	   else
	    $opGes=STRING_NULL; 
    }

	 $htmlWriter->putGenericHtmlString("var " . $intCode . 
	 VAR_SEP . self::JAVASCRIPT_VAR_PAR . VAR_SEP .  $j . 
	 " = " . "\"" .  $opGes . "\";"); 	
  
   $labelValue = $labelsValues[$j];
   $pageValue = $pagesValues[$j];
   $idValue = $idsValues[$j];

   if(is_array($labelValue) or is_a($labelValue,"Countable"))
    $num2 = count($labelValue); 
   elseif(is_string($labelValue))
    $num2 = strlen($labelValue);
 	 else
 	  $num2 = 0;

   $urlsCode = $intCode . VAR_SEP . self::JAVASCRIPT_VAR_URLS . VAR_SEP . $j;
   $labelsCode = $intCode . VAR_SEP . self::JAVASCRIPT_VAR_LABELS . VAR_SEP . $j;

   if(is_array($labelValue))
   {
    $htmlWriter->putGenericHtmlString("var " . $labelsCode . " = new Array(" . $num2 . ");"); 
	  $htmlWriter->putGenericHtmlString("var " . $urlsCode . " = new Array(" . $num2 . ");");		
   	$this->putMenuPars_recurse($pageValue,$labelValue,$idValue,$urlsCode,$labelsCode,VAR_SEP);
   }
   else
   {	
    $htmlWriter->putGenericHtmlString("var " . $labelsCode . " = new Array(1);"); 
	  $htmlWriter->putGenericHtmlString("var " . $urlsCode . " = new Array(1);");		 
	  if ($page != NO_VALUE)
	  {
	   if (isset($idsValues[$j]))
	   {
	    $pars = PAR . URL_PAR_EQUAL . $idsValues[$j];
	    $opGes = $page . URL_PARS_START . $pars; 
	   }
	   else
	   {
	   	$pars = PAR . URL_PAR_EQUAL . $j;
	    $opGes = $page . URL_PARS_START . $pars; 
	   } 
	  }
	  else
    {
     if (isset($pagesValues[$j]) && isset($idsValues[$j]))
     {
     	$pars = PAR . URL_PAR_EQUAL . $idsValues[$j];
	    $opGes = $pagesValues[$j] . URL_PARS_START . $pars;
	   }
	   else
	    $opGes=STRING_NULL; 
    }
    $htmlWriter->putGenericHtmlString($labelsCode . "[" . "0" . 
		 "]=" . "\"" . VAR_SEP . $labelValue . "\";");
	  $htmlWriter->putGenericHtmlString($urlsCode . "[" . "0" . "]=" . "\"" . $opGes . "\";"); 
	 }
	 $j++;
	}
}

function initPutData():array
{ 
 $dataFields = $this->getDataFields();
 $obj = $this->getObj();
 $rows = $this->getDataSource();
 $dataValues = array(); 
  
 if(is_a($obj,Classes_info::XML_NODE_CLASS) || is_a($obj,Classes_info::JSON_NODE_CLASS))
 {
 $rows = $this->initDataSource($rows);
 
 $j=0;
 foreach($rows as $ind=>$row)
 {
  foreach($dataFields as $dataField)
  {
   if($ind === $dataField)
	 {
		$fieldValue = $rows[$ind];
		  
	 $fieldValue = $this->getDataFieldAllValues($dataField,$fieldValue);
	 
	 if(is_array($fieldValue))
	  $dataValues[$dataField] = $fieldValue;
	 elseif(is_object($fieldValue))
	 {
	  if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
	  {
 	   if(is_a($fieldValue,Classes_info::HTML_INPUT_CTRL_CLASS))
 	   	 $fieldValue->setPrefixBeforeName(true);
 	   $fieldValueObj = $fieldValue->getObj();
		 if((! is_object($fieldValueObj)) && $this->getInheritData())
		 {
		 	$row["COUNT"] = $j;
			$fieldValue->setDataSource($row);
 	   }
 	  }
 	  elseif(is_a($fieldValue,DATA_INTERFACE_CLASS))
 	  {
     $fieldValueObj = $fieldValue->getObj();
     if((! is_object($fieldValueObj)) && $this->getInheritData())
     {
      $row["COUNT"] = $j;
      $fieldValue->setDataSource($row);
     }
 	  } 
 	  if ($this->getInheritDataFieldName())
		 $fieldValue->setNum($num . VAR_SEP . $j . VAR_SEP . $field);
//
// Se già richiamato Html_page->setAllHtmlWriters questo HtmlWriter è
// quello comune a tutte le interfacce della pagina.
// Altrimenti è diverso.
//
		$oldItemStack = $htmlWriter->getItemStack();
		$oldDumper = $oldItemStack->getDumper();
		$oldItemStack2 = clone $oldItemStack;
		$oldDumper2 = clone $oldDumper;
		$oldDumper2->setObj($oldItemStack2);
		$oldItemStack2->setDumper($oldDumper2);
//
// Imposta il dumper su memoria per il campo corrente.
// L'ItemStack del campo è impostato su memoria.
// Quello vecchio rimane inalterato.
//
    $fieldValue->setMemoryDumper();
    $newItemStack = $fieldValue->getItemStack();
    $htmlWriter->setItemStack($newItemStack);
    $fieldValue->putData();
    $dataValues[$dataField]=$fieldValue->getHtmlWriter()->getItemStack()->flush();
//
// Reimposto il vecchio Item_stack.
// 
 	  $htmlWriter->setItemStack($oldItemStack2);
 	 } 
	 elseif(is_callable($fieldValue))
	 {
	  $dataFromCallable = $fieldValue($j,$dataField);
	  $dataValues[$dataField] = $dataFromCallable;
	 }
	 }
  }
  $j++;
 }
 }
 else
 {
 $dataValues = $this->extractDataFromDataSource($rows);
 }
  
 return $dataValues;
}

}

?>