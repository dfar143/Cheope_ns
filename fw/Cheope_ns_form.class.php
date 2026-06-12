<?
namespace Cheope_ns\fw;
require_once("Html_data_interface.class.php");
require_once("cheope_ns.fun.php");
require_once("InputCtrl_putInputCtrlClasses.class.php");
require_once("Creator.tra.php");


class Cheope_ns_form extends Html_data_interface
{
 Use Creator;	
	
 const DEFAULT_ENCTYPE=MIME_1;
 const FILE_ENCTYPE=MIME_2;

 const ERROR_1="Cheope_ns_form:Errore incongruenza fra il valore del campo ed il dominio.";
 const ERROR_2="Cheope_ns_form:Errore in function putInputCtrl : Incongruenza fra tipo di dati e dominio.";
 const ERROR_3="Cheope_ns_form:Campo non trovato in deleteField.";

 const DEFAULT_NAME="default_form";
 const DEFAULT_CSS_CLASS="form";
 const CSS_HIDDEN_ROWS="form_hidden_rows";
 const CSS_NO_LABEL_ROWS="form_no_label_rows";
 const DEFAULT_TABLE_CELLPADDING=10;
 const DEFAULT_TABLE_CELLSPACING=0;
 const DEFAULT_TABLE_INITIAL_TAB_INDEX=2;
 const FIELD_LABEL_ID_SUFFIX="field_label";
 const DEFAULT_SUBMIT_BUTTON_LABEL="Invia";
 const DEFAULT_RESET_BUTTON_LABEL="Reset";
 const DEFAULT_LABEL_SPACER_WIDTH=0;
 const DEFAULT_FIELDS_LENGTH=10;
 const DEFAULT_JAVASCRIPT_MODULE=JS_FORM_VALIDATOR;
 const DEFAULT_CSS_MODULE=CSS_FORM;
 const NO_FIELD_LABEL=STRING_NULL; 
 const DEFAULT_TABLE_AUTO_TAB_INDEX=true;
 	
 private $formName=STRING_NULL;
 // Array delle etichette dei campi (array associativo); 
 private $fieldsLabels = array();
 // Array delle etichette a destra dei campi (array associativo);
 private $fieldsLabelsRight = array();
 // Blocco campi (array associativo); 
 private $fieldsStops = array();
 // Lunghezza campi (array associativo);
 private $fieldsLengths = array();
  // Campi obbligatori (array normale);
 private $mandatoryFields = array();
 // Spaziatura fra etichette e campi.
 private $labelSpacerWidth = self::DEFAULT_LABEL_SPACER_WIDTH;
 // Array associativo del codice di gestione eventi per i 
 // campi data. 
 // Il tipo di evento è identificato per posizione: 0->onChange; 
 private $dataFieldsEvents = array();
 // Array associativo del codice di gestione eventi per il 
 // form 
 // Il tipo di evento è identificato per posizione: 0->onSubmit,1->onReset;   
 private $submitFormEvents = array();
 // Array associativo del codice di gestione eventi per il 
 // bottone di reset. 
 // Il tipo di evento è identificato per posizione: 0->onClick;  
 private $resetButtonEvents = array();
 // Array associativo del codice di gestione eventi per il 
 // bottone di submit. 
 // Il tipo di evento è identificato per posizione: 0->onClick;  
 private $submitButtonEvents = array();
 private $cellPadding = self::DEFAULT_TABLE_CELLPADDING;
 private $cellSpacing = self::DEFAULT_TABLE_CELLSPACING;
 private $initialTabIndex = self::DEFAULT_TABLE_INITIAL_TAB_INDEX;
 private $autoTabIndex = self::DEFAULT_TABLE_AUTO_TAB_INDEX;
 private $gesPage = STRING_NULL;
 private $submitButtonLabel = self::DEFAULT_SUBMIT_BUTTON_LABEL;
 private $resetButtonLabel = self::DEFAULT_RESET_BUTTON_LABEL;
// private $jQueryValidatorEnabled = false;
 private $evalFieldFun = "evalField";
 private $dataFieldsRegexpValidationEnabled = false;
 private $stringDataFieldsRegexps = array();
 private $fieldsSelectedItems = array();
 static private $lFormsTotNum=0;
 static $useJQuery = true;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = true;
 static $hasJavascriptManagement = true;
 static $hasCssManagement=true;
    
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lFormsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$lFormsTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_FORM,$actNum);
  $this->setJavascriptModule(CLIENT_CODE_PATH . DIR_SEP . self::DEFAULT_JAVASCRIPT_MODULE);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
 function initPutData():array
 {
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
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putGenericHtmlString("var " . 
 	$this->getFormObjName() . " = new FormValidator();");
  $this->putFormValidationFields();
  $formObj = $this->getObj();
 	if(is_a($formObj,Classes_info::DB_ITEM_CLASS))
 	{		  
 	 $this->putFormValidationFieldsTypes();
 	}
  if($this->getDataFieldsRegexpValidationEnabled())
   $this->putFormValidationStringRegexps();
 	$this->putFormValidationMandatoryDataFields();
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$lFormsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum=0):void
 {
 	 self::$lFormsTotNum=$actIntNum + 0;
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
 	$formName = $this->getFormName();
 	$item1 = array("formName"=>$formName);
 	$serializer->loadItems($item1);
 	$fieldsLabels = $this->getFieldsLabels();
 	$item2 = array("\$fieldsLabels"=>$fieldsLabels);
 	$serializer->loadItems($item2);
 	$fieldsLabelsRight = $this->getFieldsLabelsRight();
 	$item3 = array("\$fieldsLabelsRight"=>$fieldsLabelsRight);
 	$serializer->loadItems($item3);
 	$fieldsStops = $this->getFieldsStops();
 	$item4 = array("\$fieldsStops"=>$fieldsStops);
 	$serializer->loadItems($item4);
 	$fieldsLengths = $this->getFieldsLengths();
 	$item5 = array("\$fieldsLengths"=>$fieldsLengths);
 	$serializer->loadItems($item5);	
 	$mandatoryFields = $this->getMandatoryFields();	
 	$item6 = array("\$mandatoryFields"=>$mandatoryFields);
 	$serializer->loadItems($item6);
 	$labelSpacerWidth = $this->getLabelSpacerWidth();
 	$item7 = array("labelSpacerWidth"=>$labelSpacerWidth);
 	$serializer->loadItems($item7);	 	 
 	$dataFieldsEvents = $this->getDataFieldsEvents();	
 	$item8 = array("\$dataFieldsEvents"=>$dataFieldsEvents);
 	$serializer->loadItems($item8);
 	$submitFormEvents = $this->getSubmitFormEvents();
 	$item9 = array("\$submitFormEvents"=>$submitFormEvents);
 	$serializer->loadItems($item9);	 
 	$resetButtonEvents = $this->getResetButtonEvents();	
 	$item10 = array("\$resetButtonEvents"=>$resetButtonEvents);
 	$serializer->loadItems($item10);
 	$submitButtonEvents = $this->getSubmitButtonEvents();
 	$item11 = array("\$submitButtonEvents"=>$submitButtonEvents);
 	$serializer->loadItems($item11);	 	
 	$cellPadding = $this->getCellPadding();	
 	$item12 = array("cellPadding"=>$cellPadding);
 	$serializer->loadItems($item12);
 	$cellSpacing = $this->getCellSpacing();
 	$item13 = array("cellSpacing"=>$cellSpacing);
 	$serializer->loadItems($item13);  	
 	$initialTabIndex = $this->getInitialTabIndex();	
 	$item14 = array("initialTabIndex"=>$initialTabIndex);
 	$serializer->loadItems($item14);
 	$autoTabIndex = $this->getAutoTabIndex();
 	$item15 = array("*autoTabIndex"=>$autoTabIndex);
 	$serializer->loadItems($item15);   	
	$gesPage = $this->getGesPage();	
 	$item16 = array("gesPage"=>$gesPage);
 	$serializer->loadItems($item16);
 	$submitButtonLabel = $this->getSubmitButtonLabel();
 	$item17 = array("submitButtonLabel"=>$submitButtonLabel);
 	$serializer->loadItems($item17); 	 	
	$resetButtonLabel = $this->getResetButtonLabel();	
 	$item18 = array("resetButtonLabel"=>$resetButtonLabel);
 	$serializer->loadItems($item18);
 	/*$javascriptEnabled = $this->getJavascriptEnabled();
 	$item19 = array("*javascriptEnabled"=>$javascriptEnabled);
 	$serializer->loadItems($item19);*/ 	 	
	//$jQueryValidatorEnabled = $this->getJQueryValidatorEnabled();	
 	//$item20 = array("*jQueryValidatorEnabled"=>$jQueryValidatorEnabled);
 	//$serializer->loadItems($item20);
 	$evalFieldFun = $this->getEvalFieldFun();
 	$item21 = array("evalFieldFun"=>$evalFieldFun);
 	$serializer->loadItems($item21);
	$dataFieldsRegexpValidationEnabled = $this->getDataFieldsRegexpValidationEnabled();	
 	$item22 = array("*dataFieldsRegexpValidationEnabled"=>$dataFieldsRegexpValidationEnabled);
 	$serializer->loadItems($item22);
 	$stringDataFieldsRegexps = $this->getStringDataFieldsRegexps();
 	$item23 = array("\$stringDataFieldsRegexps"=>$stringDataFieldsRegexps);
 	$serializer->loadItems($item23);	
 }
 
 function setFormName(string $actFormName):void
 {
 	$this->formName = $actFormName;
 }
 
 function getFormName():string
 {
  if($this->formName == STRING_NULL)
   return self::DEFAULT_NAME;
  else
   return $this->formName;
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
 }
 
 function getFieldsLabels():array
 {
 	return $this->fieldsLabels;
 }
 
 function setFieldsLabels(array $actFieldsLabels):void
 {
 	$fieldsLabels = $this->convertToAssociative($actFieldsLabels);
 	$this->fieldsLabels = $fieldsLabels;
 }

 function getFieldsLabelsRight():array
 {
 	return $this->fieldsLabelsRight;
 }
 
 function setFieldsLabelsRight(array $actFieldsLabelsRight):void
 {
 	$fieldsLabelsRight = $this->convertToAssociative($actFieldsLabelsRight);
 	$this->fieldsLabelsRight = $fieldsLabelsRight;
 }
 
 function setFieldLabelRight(string $actLabelRight,string $actFieldName):bool
 {
 	$fieldsLabelsRight = $this->getFieldsLabelsRight();
 	if(isset($fieldsLabelsRight[$actFieldName]))
 	{
 	 $fieldsLabelsRight[$actFieldName] = $actLabelRight;
 	 $this->setFieldsLabelsRight($fieldsLabelsRight);
   return true;
  }
  else
   return false;
 }

 function getFieldLabelRight(string $actFieldName):string
 {
 	$fieldsLabelsRight = $this->getFieldsLabelsRight();
 	if(isset($fieldsLabelsRight[$actFieldName]))
 	  return $fieldsLabelsRight[$actFieldName];
 	else
 	  return self::NO_FIELD_LABEL;
 }
 
 function getFieldsStops():array
 {
 	return $this->fieldsStops;
 }
 
 function setFieldsStops(array $actFieldsStops):void
 {
 	$fieldsStops = $this->convertToAssociative($actFieldsStops);
 	$this->fieldsStops = $fieldsStops;
 }
 
 function getFieldStop(string $actFieldName):string
 {
 	$fieldsStops = $this->getFieldsStops();
 	if(isset($fieldsStops[$actFieldName]))
 	{
 	 $stop = $fieldsStops[$actFieldName];
 	 ($stop==STRING_NULL)?$stop=STRING_NULL:$stop;
 	 return $stop;
 	}
 	else
 	 return STRING_NULL;
 }
 
 function getFieldsLengths():array
 {
 	return $this->fieldsLengths;
 }
 
 function setFieldsLengths(array $actFieldsLengths):void
 {
 	$fieldsLengths = $this->convertToAssociative($actFieldsLengths);
 	$this->fieldsLengths = $fieldsLengths;
 }
 
 function getFieldLength(string $actFieldName):string|int
 {
 	$fieldsLengths = $this->getFieldsLengths();
 	if(isset($fieldsLengths[$actFieldName]))
 	{
 	 $length = $fieldsLengths[$actFieldName];
 	 ($length==STRING_NULL)?$length=STRING_NULL:$length;
 	 return $length;
 	}
 	else
 	 return STRING_NULL;
 }
  
 function setFieldLabel(string $actLabel,string $actFieldName):bool
 {
 	$fieldsLabels = $this->getFieldsLabels();
 	if(isset($fieldsLabels[$actFieldName]))
 	{
 	 $fieldsLabels[$actFieldName] = $actLabel;
 	 $this->setFieldsLabel($fieldsLabels);
   return true;
  }
  else
   return false;
 }
 
 function getFieldLabel(string $actFieldName):string
 {
 	$fieldsLabels = $this->getFieldsLabels();
 	if(isset($fieldsLabels[$actFieldName]))
 	 return $fieldsLabels[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
   
 function setDataFieldsAccess(array $actAccess):void
 {
  $mandatoryFields = array();
  $fields = $this->getDataFields();
	$num = count($actAccess);
  $j=0;
	for($i=0;$i<=$num-1;$i++)
  {
	 if($actAccess[$i] == ACCESS_OBB)
	  $mandatoryFields[$j++] = $fields[$i];
	} 
	$this->setMandatoryFields($mandatoryFields);
 }
 
 function getMandatoryFields():array
 {
  return $this->mandatoryFields;
 }
 
 function setMandatoryFields(array $actMandatoryFields):void
 {
 	$this->mandatoryFields = $actMandatoryFields; 
 }
 
 function getLabelSpacerWidth():int
 {
 	if($this->labelSpacerWidth==NO_VALUE)
 	 return self::DEFAULT_LABEL_SPACER_WIDTH;
 	else
   return $this->labelSpacerWidth;
 }
 
 function setLabelSpacerWidth(int $actSpacerWidth):void
 {
  $this->labelSpacerWidth = $actSpacerWidth;
 }
 
 function getDataFieldsEvents():array
 {
  return $this->dataFieldsEvents;
 }
 
 function setDataFieldsEvents(array $actDataFieldsEvents):void
 {
 	$dataFieldsEvents = $this->convertToAssociative($actDataFieldsEvents);
  $this->dataFieldsEvents = $dataFieldsEvents;
 }
 
 function getHiddenDataFields():array
 {
  $hiddenDataFields = array();
  $dataFields = $this->getDataFields();
	$domains = $this->getDataFieldsDomains();
	$num1 = count($dataFields);
	$j=0;
	for($i=0;$i<=$num1-1;$i++)
	 if($domains[$i]==Int_domain::FIELD_DOMAIN_HIDDEN)
		$hiddenDataFields[$j++] = $dataFields[$i];
  return $hiddenDataFields;
 }
 
 function setHiddenDataFields(array $actHiddenDataFields):void
 {
  $dataFields = $this->getDataFields();
	$domains = $this->getDataFieldsDomains();
	$num1 = count($actHiddenDataFields);
	$num2 = count($dataFields);
	for($i=0;$i<=$num1-1;$i++)
	 for($j=0;$j<=$num2-1;$j++)
	  if($actHiddenDataFields[$i]==$dataFields[$j])
		 $domains[$j] = Int_domain::FIELD_DOMAIN_HIDDEN;
  $this->setDataFieldsDomains($domains);
 }
 
 function isStatic(string $actField):bool
 {
  $domains = $this->getDataFieldsDomains();
	$dataFields = $this->getDataFields();
	$num=count($domains);
	for($i=0;$i<=$num-1;$i++)
	{
	 if(($actField==$dataFields[$i])&&($domains[$i]==Int_domain::FIELD_DOMAIN_STATIC_TEXT))
	  return true;
	}
	return false;
 }
 
 function isHidden(string $actField):bool
 {
  $domains = $this->getDataFieldsDomains();
	$dataFields = $this->getDataFields();
	$num=count($domains);
	for($i=0;$i<=$num-1;$i++)
	{
	 if(($actField==$dataFields[$i])&&($domains[$i]==Int_domain::FIELD_DOMAIN_HIDDEN))
	  return true;
	}
	return false;
 }
 
 function getResetButtonEvents():array
 {
  return $this->resetButtonEvents;
 }
  
 function setResetButtonEvents(array $actResetButtonEvents):void
 {
 	$resetButtonEvents = $actResetButtonEvents;
 	if(isset($actResetButtonEvents[0]))
 	{
 	 $resetButtonEvents["onclick"] = $actResetButtonEvents[0];
 	 unset($resetButtonEvents[0]);
 	}
  $this->resetButtonEvents = $resetButtonEvents;
 }
 
 function getSubmitButtonEvents():array
 {
  return $this->submitButtonEvents;
 }
  
 function setSubmitButtonEvents(array $actSubmitButtonEvents):void
 {
 	$submitButtonEvents = $actSubmitButtonEvents;
 	if(isset($actSubmitButtonEvents[0]))
 	{
 	 $submitButtonEvents["onclick"] = $actSubmitButtonEvents[0];
 	 unset($submitButtonEvents[0]);
  }
  $this->submitButtonEvents = $submitButtonEvents;
 }
 
  function setCellPadding(int $actCellPadding):void
 {
 	$this->cellPadding = $actCellPadding;
 }
 
 function getCellPadding():int
 {
  if ($this->cellPadding==NO_VALUE)
	 return self::DEFAULT_TABLE_CELLPADDING;
	else
   return $this->cellPadding;
 }
 
 function setCellSpacing(int $actCellSpacing):void
 {
 	$this->cellSpacing = $actCellSpacing;
 }
 
 function getCellSpacing():int
 {
  if ($this->cellSpacing==NO_VALUE)
	 return self::DEFAULT_TABLE_CELLSPACING;
	else
   return $this->cellSpacing;
 }
 
 function setInitialTabIndex(int $actInitialTabIndex):void
 {
  $this->initialTabIndex=$actInitialTabIndex;
 }
 
 function getInitialTabIndex():int
 {
  if ($this->initialTabIndex==NO_VALUE)
	 return self::DEFAULT_TABLE_INITIAL_TAB_INDEX;
	else
   return $this->initialTabIndex; 	
 }
 
 function getAutoTabIndex():bool
 {
 	if ($this->autoTabIndex==STRING_NULL)
 	 return self::DEFAULT_TABLE_AUTO_TAB_INDEX;
 	else
 	 return $this->autoTabIndex;
 }
 
 function setAutoTabIndex(bool $actAutoTabIndex):void
 {
 	$this->autoTabIndex = $actAutoTabIndex;
 }
 
 function enableAutoTabIndex():void
 {
 	$this->autoTabIndex = true;
 }
 
 function disableAutoTabIndex():void
 {
 	$this->autoTabIndex = false;
 }
 
 function setGesPage(string $actPage):void
 {
  $this->gesPage = $actPage;
 }
 
 function getGesPage():string
 {
  return $this->gesPage;
 }
 
 function setSubmitButtonLabel(string $actLabel):void
 {
  $this->submitButtonLabel = $actLabel;
 }
 
 function getSubmitButtonLabel():string
 {
  if ($this->submitButtonLabel==STRING_NULL)
	 return self::DEFAULT_SUBMIT_BUTTON_LABEL;
	else
   return $this->submitButtonLabel;
 }
 
 function setResetButtonLabel(string $actLabel):void
 {
  $this->resetButtonLabel = $actLabel;
 }
 
 function getResetButtonLabel():string
 {
  if ($this->resetButtonLabel==STRING_NULL)
	 return self::DEFAULT_RESET_BUTTON_LABEL;
	else
   return $this->resetButtonLabel;
 }
 
 function getSubmitFormEvents():array
 {
 	return $this->submitFormEvents;
 }
 
 function setSubmitFormEvents(array $actSubmitFormEvents):void
 {
 	$submitFormEvents = $actSubmitFormEvents;
 	if(isset($actSubmitFormEvents[0]))
 	{
 	 $submitFormEvents["onsubmit"] = $actSubmitFormEvents[0];
   unset($submitFormEvents[0]);
  }
  if(isset($actSubmitFormEvents[1]))
  {
   $submitFormEvents["onreset"] = $actSubmitFormEvents[1];
   unset($submitFormEvents[1]);
 	}
 	$this->submitFormEvents = $submitFormEvents;
 }
 
 function setEvalFieldFun(string $actEvalFieldFun):void
 {
 	$this->evalFieldFun = $actEvalFieldFun;
 }
 
 function getEvalFieldFun():string
 {
 	return $this->evalFieldFun;
 } 
 
 function getDataFieldsRegexpValidationEnabled():bool
 {
 	return $this->dataFieldsRegexpValidationEnabled;
 }
 
 function setDataFieldsRegexpValidationEnabled(bool $actDataFieldsRegexpValidationEnabled):void
 {
 	$this->dataFieldsRegexpValidationEnabled=$actDataFieldsRegexpValidationEnabled;
 }
 
 function getStringDataFieldsRegexps():array
 {
 	return $this->stringDataFieldsRegexps;
 }
 
 function setStringDataFieldsRegexps(array $actStringDataFieldsRegexps):void
 {
 	$stringDataFieldsRegexps = $this->convertToAssociative($actStringDataFieldsRegexps);
 	$this->stringDataFieldsRegexps = $stringDataFieldsRegexps;
 }
 
 function getFieldsSelectedItems():array
 {
 	return $this->fieldsSelectedItems;
 }
 
 function setFieldsSelectedItems(array $actFieldsSelectedItems):void
 {
 	$fieldsSelectedItems = $this->convertToAssociative($actFieldsSelectedItems);
 	$this->fieldsSelectedItems = $fieldsSelectedItems;
 }
 
 function getFieldSelectedItem(string $actFieldName):string|int
 {
 	$fieldsSelectedItems = $this->getFieldsSelectedItems();
  	
 	if(isset($fieldsSelectedItems[$actFieldName]))
 	 return $fieldsSelectedItems[$actFieldName];
 	else
 	 return STRING_NULL;
 } 
 
 function deleteField(string $actFieldName):bool
 {
  $mandatoryFields = $this->getMandatoryFields();
  $pos2 = array_getPos($mandatoryFields,$actFieldName);
  if($pos2)
  {
   $newMandatoryFields = array();
   $newMandatoryFields = array_deleteItem($mandatoryFields,$actFieldName);
   $this->setMandatoryFields($newMandatoryFields);
  }
 	$dataFields = $this->getDataFields();
  $pos = array_getPos($dataFields,$actFieldName);
  if($pos)
  {
   $intFormFieldsContainer = $this->getIntFieldsContainer();
   $intFormFieldsContainer->deleteItem($pos);
   $fieldsLengths = $this->getFieldsLengths();
   $fieldsLabels = $this->getFieldsLabels();
   $fieldsLabelsRight = $this->getFieldsLabelsRight();
   $fieldsStops = $this->getFieldsStops();
   $stringDataFieldsRegexps = $this->getStringDataFieldsRegexps();
   $dataFieldsEvents = $this->getDataFieldsEvents();
   
   if (isset($fieldsLengths[$actFieldName]))
     unset($fieldsLengths[$actFieldName]);
   $this->setFieldsLengths($fieldsLabels);   
    
   if (isset($fieldsLabels[$actFieldName]))
     unset($fieldsLabels[$actFieldName]);
   $this->setFieldsLabels($fieldsLabels);
   
   if (isset($fieldsLabelsRight[$actFieldName]))
     unset($fieldsLabelsRight[$actFieldName]);
   $this->setFieldsLabelsRight($fieldsLabelsRight);

   if (isset($fieldsStops[$actFieldName]))
     unset($fieldsStops[$actFieldName]);
   $this->setFieldsStops($fieldsStops);
   
   if (isset($stringDataFieldsRegexps[$actFieldName]))
     unset($stringDataFieldsRegexps[$actFieldName]);
   $this->setStringDataFieldsRegexps($stringDataFieldsRegexps);
     
   if (isset($dataFieldsEvents[$actFieldName]))
    unset($dataFieldsEvents[$actFieldName]);     
   $this->setDataFieldsEvents($dataFieldsEvents);
  }
  if((!$pos)&&(!$pos2))
   die(self::ERROR_3);
  return true;
 }
 

 function containFileDataField():bool
 {
  $domains = $this->getDataFieldsDomains();
  $num = count($domains);
  for($i=0;$i<=$num -1;$i++)
  if ($domains[$i] == Int_domain::FIELD_DOMAIN_FILE)
	 return true;
  return false;
 }

 function containDataFieldEvents(string $actFieldName):bool
 {
  $events = $this->getDataFieldsEvents();
  foreach($events as $key=>$val)
   if($key == $actFieldName)
	  return true;
  return false;
 } 
 
 function getFormObjName():string
 {
 	$intCode = $this->getInterfaceId();
 	return "objForm" . VAR_SEP . $intCode;
 }
 
 function putFormObjName():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$formObjName = $this->getFormObjName();
 	$htmlWriter->putGenericHtmlString($formObjName);
 }
 
 function putFormValidationFields():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$intCode = $this->getInterfaceId();
  $dataFields = $this->getDataFields();
  $num = count($dataFields);
  $formObjName = $this->getFormObjName();  
  $htmlWriter->putGenericHtmlString($formObjName . ".numDataFields=" . $num . ";");
  $htmlWriter->putGenericHtmlString($formObjName . ".setDataFields(new Array(" . 
  $formObjName . ".numDataFields" . "));");
  for($i=0;$i<=$num-1;$i++)
  {
   $htmlWriter->putGenericHtmlString($formObjName . ".getDataFields()[" . 
   $i . "]=\"" . $dataFields[$i] . "\";");
  }
 }
 
 function putFormValidationFieldsTypes():void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
 	$intCode = $this->getInterfaceId();
  $dataFields = $this->getDataFields();
  $num = count($dataFields);
  $formObjName = $this->getFormObjName(); 
  $htmlWriter->putGenericHtmlString($formObjName . ".setDataFieldsTypes(new Array(" . 
  $formObjName . ".numDataFields" . "));");
  for($i=0;$i<=$num-1;$i++)
  {	  	  	
   $field = $dataFields[$i];
	 $type = $this->getDataFieldType($field);
   $htmlWriter->putGenericHtmlString($formObjName . ".getDataFieldsTypes()[" . 
   $i . "]=\"" . $type . "\";");
  }    
 }
 
 function putFormValidationStringRegexps():void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
 	$intCode = $this->getInterfaceId();
  $stringDataFieldsRegexps = $this->getStringDataFieldsRegexps(); 	
  $num = count($stringDataFieldsRegexps);
  $formObjName = $this->getFormObjName();
	$htmlWriter->putGenericHtmlString($formObjName . ".setStringDataFieldsRegexps({");
	$i=0;  
  foreach($stringDataFieldsRegexps as $ind=>$val)
  {
   if($i==$num-1)
	  $htmlWriter->putGenericHtmlString($ind . ":\"" . $val . "\"");
	 else
	 	$htmlWriter->putGenericHtmlString($ind . ":\"" . $val . "\",");
	 $i++;     	
  }
	 $htmlWriter->putGenericHtmlString("});");  
 }
 
 function putFormValidationMandatoryDataFields():void
 {
 	$htmlWriter = $this->getHtmlWriter(); 	
 	$intCode = $this->getInterfaceId();
  $mandatoryFields = $this->getMandatoryFields();
  $num = count($mandatoryFields);
  $formObjName = $this->getFormObjName();
  $htmlWriter->putGenericHtmlString($formObjName . ".numMandatoryDataFields=" . $num . ";");
  $htmlWriter->putGenericHtmlString($formObjName . ".setMandatoryDataFields(new Array(" .
  $formObjName . ".numMandatoryDataFields));");
  for($i=0;$i<=$num -1;$i++)
  {
   $htmlWriter->putGenericHtmlString($formObjName . ".getMandatoryDataFields()[" . 
   $i . "]=\"" . $mandatoryFields[$i] . "\";");
  }
 }
 
 function putFormValidationCodePar():void
 {
  $this->putFormValidationFields();
  $this->putFormValidationFieldsTypes();
  if($this->getDataFieldsRegexpValidationEnabled())
   $this->putFormValidationStringRegexps();
  $this->putFormValidationMandatoryDataFields();
 } 
 
function putInputCtrl(string $actName,$actValue,string $actType,
string $actDomain,$actLength=STRING_NULL,
$actStop=STRING_NULL,
$actTabIndex=STRING_NULL,
string $actOnChange=STRING_NULL,
string $actOnClick=STRING_NULL):void
{
 $htmlWriter = $this->getHtmlWriter();
 $op = $this->getOp();
 $dataSource = $this->getDataSource();
 $factory = Creator::create("PutInputCtrl_factory",STRING_NULL,
 $actName,$actValue,
 $actType,$actLength,$actStop,$actTabIndex,STRING_NULL,
 $dataSource,$op,
 $actOnChange,$actOnClick);
 /*$factory = new PutInputCtrl_factory($actName,$actValue,
 $actType,$actLength,$actStop,$actTabIndex,STRING_NULL,
 $dataSource,$op,
 $actOnChange,$actOnClick);*/
 $obj = $factory->create($actDomain,$htmlWriter);
 $obj->exec();
}

//
//Funzione che imposta la visualizzazione di una riga del form.
//Le classi derivate possono effettuare l'override di questo
//metodo per implementare comportamenti più complessi.
//Viene richiamata per ogni campo dati. 
//
function putInputCtrls(string $actFieldName,
$actFieldValue,string $actType,
string $actDomain,int $actPos):void
{
 $htmlWriter = $this->getHtmlWriter(); 
 $intCode = $this->getInterfaceId();
 $length = $this->getFieldLength($actFieldName);
 if($length==STRING_NULL)
  $length = self::DEFAULT_FIELDS_LENGTH;  
 $stop = $this->getFieldStop($actFieldName);
 $dataSource = $this->getDataSource();  
 
  if(($actFieldValue==STRING_NULL)||(is_array($actFieldValue)))
  {
   $fieldSelectedItem = $this->getFieldSelectedItem($actFieldName);
  }
  elseif( ! is_array($actFieldValue))
   $fieldSelectedItem = $actFieldValue;
  else
   $fieldSelectedItem = STRING_NULL; 
 
 if($this->isHidden($actFieldName))
 {
  $htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "row" . VAR_SEP . $actFieldName . 
  VAR_SEP . "hidden",self::CSS_HIDDEN_ROWS);
  $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col_item" . VAR_SEP . $actFieldName . 
  VAR_SEP . "hidden",STRING_NULL,STRING_NULL,STRING_NULL,"2");
  $this->putInputCtrl($actFieldName,$actFieldValue,$actType,$actDomain,$length); 
 }
 else
 { 	
 	if(($fieldLabel = $this->getFieldLabel($actFieldName))==self::NO_FIELD_LABEL)
 	{
   $htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "row" . VAR_SEP . $actFieldName  . 
   VAR_SEP . "no_label",self::CSS_NO_LABEL_ROWS);
   $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col_item" . VAR_SEP . $actFieldName . 
   VAR_SEP . "no_label",STRING_NULL,STRING_NULL,STRING_NULL,2);
	}
  else
  {
   $htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "row" . VAR_SEP . $actFieldName);
   $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col_label" . VAR_SEP . $actFieldName);

	 if($actDomain==Int_domain::FIELD_DOMAIN_OBJ)
	  $htmlWriter->putLabelTag($intCode . VAR_SEP . self::FIELD_LABEL_ID_SUFFIX . 
	   VAR_SEP . $actFieldName,STRING_NULL,STRING_NULL,STRING_NULL,$fieldLabel);
	 else  
	  $htmlWriter->putLabelTag($intCode . VAR_SEP . self::FIELD_LABEL_ID_SUFFIX . 
	   VAR_SEP . $actFieldName,STRING_NULL,STRING_NULL,$actFieldName,$fieldLabel);

   $spaceNum = $this->getLabelSpacerWidth();
   for($j=0;$j<=$spaceNum-1;$j++)
	 $htmlWriter->putGenericHtmlString(ENTITY_SPACE);
   $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
   $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "col_item" . VAR_SEP . $actFieldName);
  }	
  //
  //Per adesso è gestito solo l'evento OnChange.
  //
  if($this->containDataFieldEvents($actFieldName))
  {
	 $events = $this->getDataFieldsEvents($actFieldName);
	 $onChangeEventCode = $events[$actFieldName][0];
  }
  elseif($this->getJavascriptEnabled())
  {
   $evalFieldFun = $this->getEvalFieldFun();
   $formObjName = $this->getFormObjName();
   $onChangeEventCode = "if (! " . $formObjName . 
   STRING_POINT . $evalFieldFun . 
   "(this)){this.value='';return false}else return true;";
	}
	else
	 $onChangeEventCode = STRING_NULL;
	
  if(($actDomain != Int_domain::FIELD_DOMAIN_OBJ)&&($actDomain != Int_domain::FIELD_DOMAIN_FUNCTION))
	{
   $this->putInputCtrl($actFieldName,$actFieldValue,$actType,$actDomain,$length,$stop,
   ($this->getAutoTabIndex())?$actPos:STRING_NULL,$onChangeEventCode); 
  } 
  elseif($actDomain == Int_domain::FIELD_DOMAIN_FUNCTION)
  {
   $htmlWriter->putGenericHtmlString($actFieldValue(),0);
	}
	else
  {
	 if(is_a($actFieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	 { 
    $op = $this->getOp();
 //   if($op != OP_INSERIMENTO)
	   if($this->getInheritData())
		 $actFieldValue->setDataSource($dataSource); 
	  $actFieldValue->setHtmlWriter($htmlWriter);	 
	 }
	 elseif(is_a($actFieldValue,Classes_info::DATA_INTERFACE_CLASS))
	 {
    $op = $this->getOp();
 //   if($op != OP_INSERIMENTO)
	   if($this->getInheritData())
		  $actFieldValue->setDataSource($dataSource);
		$actFieldValue->setHtmlWriter($htmlWriter); 
	 }
	 if(is_a($actFieldValue,Classes_info::HTML_INPUT_CTRL_CLASS) && $this->getAutoTabIndex())
	   $actFieldValue->setTabIndex($actPos);
	    
	 $actFieldValue->putData();
	} 
	$labelRight = $this->getFieldLabelRight($actFieldName);
	if($labelRight != self::NO_FIELD_LABEL) 
	 	$htmlWriter->putGenericHtmlString(ENTITY_SPACE . $labelRight,0); 	 
 }
 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
}

function putForm():void
{
 $htmlWriter = $this->getHtmlWriter(); 
 $gesPage = $this->getGesPage();
 $class = $this->getCssClass();
 $intCode = $this->getInterfaceId();
 $submitButtonLabel = $this->getSubmitButtonLabel();
 $resetButtonLabel = $this->getResetButtonLabel();
 $op = $this->getOp();
 $obj = $this->getObj();
// $this->fieldsFromDataSource(); 
 $fields = $this->getDataFields();
 $cellPadding = $this->getCellPadding();
 $cellSpacing = $this->getCellSpacing();
 $initialTabIndex = $this->getInitialTabIndex();
 $rows = $this->getDataSource();

//
// Mi aspetto un array;
//
  if(isset($rows))
  {
   if(! is_array($rows))
    $row=array($rows);
   elseif(is_array_of_array($rows))
    $row = current($rows);
   else
    $row=$rows;
  }
  else
   $row = array();


 if($obj !== OBJ_NONE)
 {
  $formName = $obj->getName();
  $objName = $obj->getName();
  $objNameLength = strlen($objName);
 }
 else
 {
  $formName = $this->getFormName();
  $objName = OBJ_NONE;
  $objNameLength = strlen($objName);
 }

 $style = $this->getStyle();
 $htmlWriter->putDivOpenTag($intCode,$style,$class);
 
 $submitFormEvents = $this->getSubmitFormEvents();
	 
 if(count($submitFormEvents)>0)
 {
  $onSubmitCode = (isset($submitFormEvents["onsubmit"]))?$submitFormEvents["onsubmit"]:STRING_NULL;
  $onResetCode = (isset($submitFormEvents["onreset"]))?$submitFormEvents["onreset"]:STRING_NULL;
 }
 elseif($this->getJavascriptEnabled())
 {
 	 $formObjName = $this->getFormObjName();
   $onSubmitCode = "return " . $formObjName . ".evalForm(this);";
   $onResetCode = STRING_NULL;
 }
 else
 {
 	$onSubmitCode = STRING_NULL;
 	$onResetCode = STRING_NULL;
 }
 
 if ($this->containFileDataField())
   $htmlWriter->putFormOpenTag($formName,$formName,STRING_NULL,STRING_NULL,$gesPage,METHOD_POST,self::FILE_ENCTYPE,'1',$onSubmitCode,$onResetCode);
 else
   $htmlWriter->putFormOpenTag($formName,$formName,STRING_NULL,STRING_NULL,$gesPage,METHOD_POST,self::DEFAULT_ENCTYPE,'1',$onSubmitCode,$onResetCode);

 $opLength = strlen($op);
 $this->putInputCtrl(PAR1 . VAR_SEP . $this->getNum(),$objName,FIELD_TYPE_NONE,Int_domain::FIELD_DOMAIN_HIDDEN,$objNameLength);
 $this->putInputCtrl(PAR2 . VAR_SEP . $this->getNum(),$op,FIELD_TYPE_NONE,Int_domain::FIELD_DOMAIN_HIDDEN,$opLength);
 
 $htmlWriter->putTableOpenTag($intCode . 
 VAR_SEP . "inner_table",$class,STRING_NULL,STRING_NULL,STRING_NULL,$cellSpacing,$cellPadding);
 $num = count($fields);

 $tabIndex = $initialTabIndex;

 for($i=0;$i<=$num-1;$i++)
 {
  $fieldName = $fields[$i];
  if($obj !== OBJ_NONE)
	 $type = $this->getDataFieldType($fieldName);
	else
	 $type = STRING_NULL;
	$domain = $this->getDataFieldDomainByName($fieldName);

    if(isset($row[$fieldName]))
	{
	  $fieldActValue = trim($row[$fieldName]);
	  //echo $fieldActValue;
	  $fieldsSelectedItems[$i] = $fieldActValue;
	  $this->setFieldsSelectedItems($fieldsSelectedItems);
	} 
	 else
	  $fieldActValue = FIELD_NO_VALUE;

	$fieldActValue = $this->getDataFieldAllValues($fieldName,$fieldActValue);
	$this->putInputCtrls($fieldName,$fieldActValue,$type,$domain,$tabIndex);
	if(($domain!=Int_domain::FIELD_DOMAIN_HIDDEN)&&($domain!=Int_domain::FIELD_DOMAIN_ATOMIC_STATIC)&& $this->getAutoTabIndex())
	 $tabIndex++;
 }
 //
 // Visualizza bottone di submit e annulla.
 //
 $htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "form_buttons_table_row");
 $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "form_buttons_table_column",STRING_NULL,STRING_NULL,STRING_NULL,"2");
 $htmlWriter->putTableOpenTag($intCode . VAR_SEP . "buttons_table");
 $htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "buttons_row");
 $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "submit_button");
 $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG,0);
 $submitButtonEvents = $this->getSubmitButtonEvents();
 if(count($submitButtonEvents)>0)
 {
  $onClickCode = $submitButtonEvents["onclick"];
  $htmlWriter->putButtonTag($intCode . VAR_SEP . BUTTON_TYPE_SUBMIT . VAR_SEP . "button" . VAR_SEP . "id",STRING_NULL,STRING_NULL,
  $submitButtonLabel,BUTTON_TYPE_SUBMIT,($this->getAutoTabIndex())?($tabIndex):STRING_NULL,$onClickCode);
 }
 else
 {
  $htmlWriter->putButtonTag($intCode . VAR_SEP . BUTTON_TYPE_SUBMIT . VAR_SEP . "button" . VAR_SEP . "id",STRING_NULL,STRING_NULL,
  $submitButtonLabel,BUTTON_TYPE_SUBMIT,($this->getAutoTabIndex())?($tabIndex):STRING_NULL);
 }
 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
 $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . "reset_button");
 $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG,0);
 $resetButtonEvents = $this->getResetButtonEvents();
 if(count($resetButtonEvents)>0)
 {
  $onClickCode = $resetButtonEvents["onclick"];
  $htmlWriter->putButtonTag($intCode . VAR_SEP . BUTTON_TYPE_RESET . VAR_SEP . "button" . VAR_SEP . "id",STRING_NULL,STRING_NULL,
  $resetButtonLabel,BUTTON_TYPE_RESET,($this->getAutoTabIndex())?($tabIndex+1):STRING_NULL,$onClickCode);
 }
 else
 {
   $htmlWriter->putButtonTag($intCode . VAR_SEP . BUTTON_TYPE_RESET . VAR_SEP . "button" . VAR_SEP . "id",STRING_NULL,STRING_NULL,
   $resetButtonLabel,BUTTON_TYPE_RESET,($this->getAutoTabIndex())?($tabIndex+1):STRING_NULL);
 }
 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(FORM_CLOSE_TAG,0);
 $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
}

function isContainer():bool
{
 return false;
}

function putData():void
{
 $this->putForm();
}
 
}


?>