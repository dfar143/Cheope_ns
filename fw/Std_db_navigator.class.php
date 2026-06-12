<?
namespace Std\fw;
require_once("Std_tree_ctrl.class.php");


class Std_db_navigator extends Std_tree_ctrl
{
 
 const ERROR_1="Std_db_navigator.putMenuPars:Cardinalità degli id errata.";
 const ERROR_2="Std_db_navigator.putMenuPars:Numero campi dati errato.";
 const ERROR_3="Std_db_navigator.putMenuPars:Struttura del database.";
 const ERROR_4="Std_db_navigator.putData:Oggetto dati errato.";
// const ERROR_5="Std_db_navigator.putData:Numero campi dati errato.";
 const DEFAULT_ROOT_LABEL=STRING_UNDERSCORE;
// const DEFAULT_JAVASCRIPT_MODULE=JS_TREE_CTRL;
 const VOICES_POS=0;
 const PAGES_POS=1;
 const IDS_POS=2;
 const JAVASCRIPT_VAR_LABEL="label";
 const JAVASCRIPT_VAR_PAR="par";
 const JAVASCRIPT_VAR_LABELS="labels";
 const JAVASCRIPT_VAR_URLS="urls";

 private $voicesField=STRING_NULL;
 private $pagesField=STRING_NULL;
 private $idsField=STRING_NULL; 
 private $rootLabel=STRING_NULL;
 static private $dbNavigatorsTotNum=0;

function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
{
 self::$dbNavigatorsTotNum++;
 if($actNum === STRING_NULL)
 	 $actNum = self::$dbNavigatorsTotNum - 1; 
 //self::$hasJavascriptManagement=true;
 parent::__construct($actObj,$actOp,self::INT_DB_NAVIGATOR,$actNum);
// $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
}

 function putJavascriptInitializationCode($actPar):void
 {
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$dbNavigatorsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$dbNavigatorsTotNum=$actIntNum + 0;
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
  $rootLabel = $this->getRootlabel();
 	$item4 = array("rootLabel"=>$rootLabel);
  $serializer->loadItems($item4);
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

function putMenuPars(array $actDataValues):void
{
 $htmlWriter = $this->getHtmlWriter();
 $dbStruct = $this->getDbStruct();
 $obj = $this->getObj();
 $type = $this->getType();
 $dispFields = $this->getDispFields();
 $intCode = $this->getInterfaceId();
 $dataFields = $this->getDataFields();
 $num = count($dataFields);
 $nextObjs = array(); 
 $nextObjs = $obj->getSons();
 $objName = $obj->getName();
 $keyFields1 = $obj->getKeyFields();
 $gesPage = $this->getGesPage();
 $page = $gesPage;
 
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

 $rootLabel = $this->getRootLabel();

 $htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . self::JAVASCRIPT_VAR_LABEL . " = " . "\"" . $rootLabel . "\"" . ";");		
 $htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . self::JAVASCRIPT_VAR_PAR . " = " . "\"#\"" . ";"); 	
 
 $num1 = count($labels);

 $htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . self::JAVASCRIPT_VAR_LABELS . VAR_SEP . "0" . " = new Array(" . $num1 . ");"); 
 $htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . self::JAVASCRIPT_VAR_URLS . VAR_SEP . "0" . " = new Array(" . $num1 . ");");

 for($j=0;$j<=$num1-1;$j++)
 {

	$htmlWriter->putGenericHtmlString($intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_LABELS . VAR_SEP . "0" . "[" . $j .  
	"]" . " = " . "\"" . $labels[$j] . "\"" . ";");	
	
	$pars1 = STRING_NULL;
	$pars2 = STRING_NULL;
	
	if(isset($ids[$j]))
	 $pars1 = URL_PARS_START . PAR . URL_PAR_EQUAL . $ids[$j];
	else
	 die(self::ERROR_1);	 

  if(isset($pages[$j]) && is_null($gesPage))
   $page = $pages[$j];

	$pars2 = $page . $pars1;
	 
	$htmlWriter->putGenericHtmlString($intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_URLS . VAR_SEP . "0" . "[" . $j .  
	"]" .  " = "  . "\"" .  $pars2 . "\";");
	
	// Vettori buffer degli elementi figli e degli id degli elementi figli. 
	$rowKeyBuf = array();
	$rowLabelBuf = array();
	$nextObjNames = array();	 
  $num=0;
  
	// Ciclo di riempimento degli array buffer.
	//
	foreach($nextObjs as $ind => $nextObj)
	{
	 $nextObjName = $nextObj->getName();
	 $rels = array();
	 $rels = $nextObj->getRelsByEntFather($objName);
	 $keyFields2 = $nextObj->getKeyFields();
	// Una singola relazione fra 2 entità.
	 if (count($rels) == 1)
	 {
		$rel = $rels[0];
		$relType = $rel->getRelType($objName);
	  if ($relType == REL_M_N)
		{	
		 $ordField = $keyFields2[0];
		 $field = $ordField;
		 $keyField = $keyFields1[0];
		 $linkTable = $rel->getLinkTable();
	   $linkTableObj = $dbStruct->getElementByAliasName($linkTable);
		 $row1 = $linkTableObj->getFilteredOrdData($linkTable,$keyField,
		 $ids[$j],$ordField,$field);
		 $num2 = count($row1);
		 if($num2>0)
		 {			
			$row2Conc = array();
			$ordField = $dispFields[0];
			$field = $dispFields[0];
			$keyField = $keyFields2[0];
			for($k=0;$k<=$num2-1;$k++)
			{
			 $row2 = $nextObj->getFilteredOrdData($keyField,$row1[$k],
		   $ordField,$field);
			 $row2Conc = array_concat($row2Conc,$row2);
			}
			$rowKeyBuf = array_concat($rowKeyBuf,$row1);
			$rowLabelBuf = array_concat($rowLabelBuf,$row2Conc);
		 }
		 for($l=0;$l<=$num2-1;$l++)
		  $nextObjNames[$num + $l] = $nextObjName;
		 $num+=$num2;
		}
		elseif (($relType == REL_1_N)&&(! $dbStruct->isAMNLinkTable($nextObjName)))
		{
		 $field = $dispFields[0];
		 $ordField = $dispFields[0];
		 $keyField0 = $keyFields1[0];
	   $row1 = $nextObj->getFilteredOrdData($keyField0,
		 $ids[$j],$ordField,$field);
		 $num2=count($row1);
		 $rowLabelBuf = array_concat($rowLabelBuf,$row1);
		 $keyField = $keyFields2[0];
	   $row2 = $nextObj->getFilteredOrdData($keyField0,
		 $ids[$j],$ordField,$keyField);	
		 
		 // espando row2 a row1
		 $rowTemp=array();
		 for($m=0;$m<=$num2-1;$m++)
		  $rowTemp[$m] = $row2[0];
		 unset($row2);
		 $row2=$rowTemp;
		 
		 $rowKeyBuf = array_concat($rowKeyBuf,$row2);
		 for($l=0;$l<=$num2-1;$l++)
		  $nextObjNames[$num + $l] = $nextObjName;
		 $num+=$num2;	 
		}
	 }
	 else
	 {
		die(self::ERROR_3);
	 }		
	}
	
	$htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_LABELS . VAR_SEP . "0" . VAR_SEP . $j . 
	" = new Array(" . $num . ");"); 
	$htmlWriter->putGenericHtmlString("var " . $intCode . VAR_SEP . 
	self::JAVASCRIPT_VAR_URLS . VAR_SEP . "0" . VAR_SEP . $j . 
	" = new Array(" . $num . ");");
	
	//
	// Output secondo livello
	//	 
	if ($num>0)
	{ 
	 for($i=0;$i<=$num-1;$i++)
	 {		 
	  $pars = PAR2 . URL_PAR_EQUAL . $rowKeyBuf[$i];
   		
		$opGes = $page . URL_PARS_START . PAR1 . URL_PAR_EQUAL . $nextObjNames[$i] .
		  URL_PARS_DIV . $pars; 
		 
		$htmlWriter->putGenericHtmlString($intCode . VAR_SEP . self::JAVASCRIPT_VAR_LABELS . 
		VAR_SEP . "0" . VAR_SEP . $j . "[" . $i . 
		 "]=" . "\"" . INDENT_SEP_3 . $rowLabelBuf[$i] . "\";");
		$htmlWriter->putGenericHtmlString($intCode . VAR_SEP . self::JAVASCRIPT_VAR_URLS . 
		VAR_SEP . "0" . VAR_SEP . $j . "[" . $i . 
		"]=" . "\"" . $opGes . "\";"); 
	 }
	} 
 }
}

function initPutData():array
{
 $dataFields = $this->getDataFields();
 $num = count($dataFields);
 if($num < 3)
   die(self::ERROR_3); 
 $obj = $this->getObj();
 $rows = $this->getDataSource();
 $dataValues = array();
    
 if(($obj===OBJ_NONE)||(! is_a($obj,Classes_info::DB_ITEM_CLASS)))
 {
  die(self::ERROR_4);      	
 }
 else
 { 
  $dataValues = $this->extractDataFromDataSource($rows);
  return $dataValues;
 }
}
}

?>