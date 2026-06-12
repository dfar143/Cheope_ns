<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_tree_ctrl.class.php");


class Cheope_ns_nLevels_tree_ctrl extends Cheope_ns_tree_ctrl
{
 
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 const JAVASCRIPT_VAR_LABEL="label";
 const JAVASCRIPT_VAR_PAR="par";
 const JAVASCRIPT_VAR_LABELS="labels";
 const JAVASCRIPT_VAR_URLS="urls";
 const DEFAULT_ROOT_LABEL=STRING_UNDERSCORE;
 const ERROR_1="Cheope_ns_nLevels_tree_ctrl:Oggetto dati non valido.";
 const ERROR_2="Cheope_ns_nLevels_tree_ctrl:Numero campi dati errato.";
 
 private $rootLabel=STRING_NULL;
 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL;
 private $indent=false;
 static private $nLevelsTotNum=0;

function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
 self::$nLevelsTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$nLevelsTotNum - 1;
 parent::__construct($actObj,$actOp,self::INT_NLEVELS_TREE_CTRL,$actNum);
}

 function enableBootstrap():void
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
 	$rootLabel = $this->getRootLabel();
 	$item4 = array("rootLabel"=>$rootLabel);
 	$serializer->loadItems($item4);
 	$indent = $this->getIndent();
 	$item5 = array("*indent"=>$indent);
 	$serializer->loadItems($item5);	
}

function setIndent(bool $actIndent):void
{
	$this->indent = $actIndent;
}

function getIndent():bool
{
	return $this->indent;
}

function setRootLabel(string $actRootLabel):void
{
	$this->rootLabel = $actRootLabel;
}

function getRootLabel():string
{
	if($this->rootLabel==STRING_NULL)
	 return self::DEFAULT_ROOT_LABEL;
	else
	return $this->rootLabel;
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
 $indent = $this->getIndent();
 $actSep=($indent==true)?($actSep . VAR_SEP):STRING_NULL;
 $type = $this->getType();
 $dispFields = $this->getDispFields();
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

  if(is_array($labelValue) or is_a($labelValue,"Countable"))
   $num2 = count($labelValue); 
  elseif(is_string($labelValue))
   $num2 = strlen($labelValue);
 	else
 	 $num2 = 0;  

 	if(is_array($labelValue))
 	{
   $htmlWriter->putGenericHtmlString("var " . $labelsCode . " = new Array(" . $num2 . ");"); 
	 $htmlWriter->putGenericHtmlString("var " . $urlsCode . " = new Array(" . $num2 . ");");		
   $this->putMenuPars_recurse($pageValue,$labelValue,$idValue,$urlsCode,$labelsCode,$actSep); 
   $htmlWriter->putGenericHtmlString($actLabelsCode . "[" . $j . 
		 "]=" . "\"" . $actSep . $labelKey . "\";");
   $idKey = $idsKeys[$j];	 
	 if ($page != NO_VALUE)
	 {
	  if (isset($idKey))
	  {
	  $pars = PAR1 . URL_PAR_EQUAL . $idKey;
	   $opGes = $page . URL_PARS_START . $pars;
	  }
	  else
	  {
	   $pars = PAR1 . URL_PAR_EQUAL . $j;
	   $opGes = $page . URL_PARS_START . $pars; 
	  } 
	 }
	 else
   {
    $pageKey = $pagesKeys[$j];
    if (isset($pageKey) && isset($idKey))
    {
     $pars = PAR1 . URL_PAR_EQUAL . $idKey;
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
	  $pars = PAR1 . URL_PAR_EQUAL . $idValue;
	   $opGes = $page . URL_PARS_START . $pars;
	  }
	  else
	  {
	   $pars = PAR1 . URL_PAR_EQUAL . $j;
	   $opGes = $page . URL_PARS_START . $pars; 
	  } 
	 }
	 else
   {
    if (isset($pageValue) && isset($idValue))
    {
     $pars = PAR1 . URL_PAR_EQUAL . $idValue;
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

// L'argomento $actData è un'array di array avente tre elementi: 
// il primo elemento ha come valore un array associativo avente come chiavi
// le pagine del primo livello e come valori, degli array con le pagine del secondo livello per ogni 
// elemento del primo.
// il secondo (strutturalmente come il primo) con le labels; 
// il terzo (strutturalmente come i primi due) con gli ids.
// Questi ultimi servono per comporre gli url di chiamata alle pagine corrispondenti.
//
function putMenuPars(array $actDataValues):void
{
 $htmlWriter = $this->getHtmlWriter();
 $type = $this->getType();
 $dispFields = $this->getDispFields();
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
	$labelsArray = $actDataValues[$labelDataField];	  
  
	if(($pagesField==STRING_NULL)||(! in_array($pagesField,$dataFields)))
	{
	 	$pageDataField = $dataFields[self::PAGES_POS];
	}
	else
	 $pageDataField = $pagesField;
	$pagesArray = $actDataValues[$pageDataField];

	if(($idsField==STRING_NULL)||(! in_array($idsField,$dataFields)))
	{
	 	$idDataField = $dataFields[self::IDS_POS];
	}
	else
	 $idDataField = $idsField;
	$idsArray = $actDataValues[$idDataField];

 if (is_array($labelsArray) 
 && is_array($pagesArray) 
 && is_array($idsArray))
 {
  $pagesKeys = array_keys($pagesArray);
  $pagesValues = array_values($pagesArray);
  $labelsKeys = array_keys($labelsArray);
  $labelsValues = array_values($labelsArray);
  $idsKeys = array_keys($idsArray);
  $idsValues = array_values($idsArray);

	$htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_LABEL . VAR_SEP . '0' . " = " . "\"" . 
	$labelsKeys[0] . "\"" . ";");		
	$pars1 = URL_PARS_START . PAR1 . URL_PAR_EQUAL . $idsKeys[0];
	 
	$pars2 = $pagesKeys[0] . $pars1;
	$htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_PAR . VAR_SEP . '0' . " = " . "\"" .  $pars2 . "\";"); 	
  
  $labelValue = $labelsValues[0];
  $pageValue = $pagesValues[0];
  $idValue = $idsValues[0];

  if(is_array($labelValue) or is_a($labelValue,"Countable"))
   $num2 = count($labelValue); 
  elseif(is_string($labelValue))
   $num2 = strlen($labelValue);
 	else
 	 $num2 = 0;  

  $urlsCode = $intCode . VAR_SEP . self::JAVASCRIPT_VAR_URLS . VAR_SEP . '0';
  $labelsCode = $intCode . VAR_SEP . self::JAVASCRIPT_VAR_LABELS . VAR_SEP . '0';

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
   $htmlWriter->putGenericHtmlString($labelsCode . "[" . "0" . 
		 "]=" . "\"" . VAR_SEP . $labelValue . "\";");
	 if ($page != NO_VALUE)
	 {
	  if (isset($idsValues[0]))
	  {
	   $pars = PAR1 . URL_PAR_EQUAL . $idsValues[0];
	   $opGes = $page . URL_PARS_START . $pars; 
	  }
	  else
	  {
	   $opGes = $page; 
	  } 
	 }
	 else
   {
    if (isset($pagesValues[0]) && isset($idsValues[0]))
    {
     $pars = PAR1 . URL_PAR_EQUAL . $idsValues[0];
	   $opGes = $pagesValues[0] . URL_PARS_START . $pars;
	  }
	  else
	   $opGes=STRING_NULL; 
   }
	 $htmlWriter->putGenericHtmlString($urlsCode . "[" . "0" . "]=" . "\"" . $opGes . "\";"); 
	}
 }
 else
 {
  die(self::ERROR_1);
 }
}

function initPutData():array
{ 
 $dataFields = $this->getDataFields();
 $obj = $this->getObj();
 $rows = $this->getDataSource();
 $rootLabel = $this->getRootLabel();
  
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
	  $dataValues[$dataField][$rootLabel] = $fieldValue;
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
    $dataValues[$dataField][$rootLabel]=$fieldValue->getHtmlWriter()->getItemStack()->flush();
//
// Reimposto il vecchio Item_stack.
// 
 	  $htmlWriter->setItemStack($oldItemStack2);
 	 } 
	 elseif(is_callable($fieldValue))
	 {
	  $dataFromCallable = $fieldValue($j,$dataField);
	  if(is_array($dataFromCallable))
	   $fieldValue[$dataField] = $dataFromCallable;
    else
	   $dataValues[$dataField][$rootLabel] = $dataFromCallable;
	 }
	 }
  }
  $j++;
 }
 }
 else
 {
 $dataValues = $this->extractDataFromDataSource($rows);
 $dataValues1 = array();
 foreach($dataValues as $ind=>$val)
  {
	$dataValues1[$ind][$rootLabel]=$val;
  }
  $dataValues = $dataValues1;
 }
 //print_r($dataValues);
 return $dataValues;
}

}
?>