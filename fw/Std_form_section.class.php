<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("InputCtrl_putDojoInputCtrlClasses.class.php");


define("HOR_DIRECTION","H");
define("VER_DIRECTION","V");

class Std_form_section extends Html_data_interface
{	
 
 const ERROR_1="Std_form_section:Errore incongruenza fra il valore del campo ed il dominio.";
 const ERROR_2="Std_form_section:Errore in function putInputCtrl : Incongruenza fra tipo di dati e dominio.";
 const ERROR_3="Std_form_section:Campo non trovato in deleteField.";
 const ERROR_4="Std_form_section:Indice di riga della griglia fuori limite.";

 const DEFAULT_GRID_DIM_X=3;
 const DEFAULT_GRID_DIM_Y=3;
 const DEFAULT_CSS_CLASS="form_section";
 const DEFAULT_COLUMNS_CLASS="form_section_columns_class";
 const DEFAULT_ROWS_CLASS="form_section_rows_class";
 const DEFAULT_ROWS_STYLE="height:100px;";

 const DEFAULT_BOOTSTRAP_CSS_ROW_TYPE = "row";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_1 = "container";
 const DEFAULT_BOOTSTRAP_CONTAINER_TYPE_2 = "container-fluid";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_1 = "xs";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_2 = "sm";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_3 = "md";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_4 = "lg";
 const DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_5 = "xl";

 const CSS_LABEL_ROWS="form_section_label_rows";
 const CSS_FORM_LABELS="form_section_labels";
 const DEFAULT_CELLPADDING=0;
 const DEFAULT_CELLSPACING=0;
 const FIELD_LABEL_ID_SUFFIX="form_section_field_label";
 const DEFAULT_LABEL_SPACER_WIDTH=1;
 const DEFAULT_FIELDS_LENGTH=10;
 //const DEFAULT_JAVASCRIPT_MODULE=JS_FORM_SECTION_VALIDATOR;
 const DEFAULT_CSS_MODULE=CSS_FORM_SECTION;
 const NO_FIELD_LABEL=STRING_NULL; 
	
 private $bootstrapContainerType = self::DEFAULT_BOOTSTRAP_CONTAINER_TYPE_2;
 private $bootstrapViewPortSizeType = self::DEFAULT_BOOTSTRAP_VIEWPORT_SIZE_TYPE_5;		
 // Dim X della matrice griglia; 
 private $gridDimX = self::DEFAULT_GRID_DIM_X;
 // Dim Y della matrice griglia; 
 private $gridDimY = self::DEFAULT_GRID_DIM_Y;	
 // Array delle etichette dei campi (array associativo).
 private $fieldsLabels = array();
 // Blocco campi (array associativo); 
 private $fieldsStops = array();
 // Lunghezza campi (array associativo);
 private $fieldsLengths = array();
 // Campi obbligatori (array normale);
 private $fieldsMandatory = array();
 // Spaziatura fra etichette e campi.
 private $labelSpacerWidth = self::DEFAULT_LABEL_SPACER_WIDTH;
 // Valori di defaults dei campi;
 private $fieldsDefaultValues = array();
 // Hints dei campi;
 private $fieldsHints = array();
 // Array associativo del codice di gestione eventi per i 
 // campi data. 
 // Il tipo di evento è identificato per posizione: 0->onChange;
 //
 private $fieldsEvents = array();
 // Array delle espressioni regolari per la validazione dei campi;
 private $fieldsRegExps = array(); 
 // Array delle etichette del gruppo di radio buttons o checkBoxes (array associativo).
 private $labels = array();
 // Array dei tooltips dei campi.
 private $fieldsToolTips = array(); 
 // Array delle classi delle colonne. 
 private $fieldsColClasses = array();
 // Classi delle righe.
 private $rowsClasses = array();
 // Classe delle righe.
 private $rowsClass = STRING_NULL;
 // Stili delle righe.
 private $rowsStyles = array();
 // Stile delle righe.
 private $rowsStyle = "height:25px" . STRING_SEMICOLON;
 //
 // Array degli stili delle colonne
 //
 private $fieldsColStyles = array();
 //
 // Array degli stili dei controlli
 //
 private $fieldsStyles = array();
 //
 // Array delle direzioni dei campi radios
 //
 private $fieldsTypes = array();
 private $fieldsDirections = array();
 private $cellPadding = self::DEFAULT_CELLPADDING;
 private $cellSpacing = self::DEFAULT_CELLSPACING;
 
 static private $lFormsTotNum = 0;
 static $useJQuery = true;
 static $useDojo = true;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = true;
 static $hasCssManagement = true;
	
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$lFormsTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$lFormsTotNum - 1; 
  parent::__construct($actObj,$actOp,self::INT_FORM_SECTION,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
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
	
 function enableBootstrap():void
 {
 }	
	
  function isDecorator():bool
  {
  	return false;
  }
  
  function isContainer():bool
  {
  	return false;
  }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 	$htmlWriter = $this->getHtmlWriter();

  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.Tooltip\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.TextBox\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.DateTextBox\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.ValidationTextBox\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.FilteringSelect\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.MultiSelect\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.ComboBox\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.Button\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.Form\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.SimpleTextarea\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.CheckBox\");");
  $htmlWriter->putGenericHtmlString("dojo.require(\"dijit.form.RadioButton\");");
 }

 static function getInterfacesTotNum():string|int
 {
 	return self::$lFormsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$lFormsTotNum=$actIntNum + 0;
 }
 
 function isStandard():bool
 {
 	return false;
 }
 
 function serialize():void
 {
	
	parent::serialize();
 	$serializer = $this->getSerializer(); 	
 	$gridDimX = $this->getGridDimX();
 	$item1 = array("gridDimX"=>$gridDimX);
 	$serializer->loadItems($item1);
 	$gridDimY = $this->getGridDimY(); 
 	$item2 = array("gridDimY"=>$gridDimY);
 	$serializer->loadItems($item2);	
  $rowsClasses = $this->getRowsClasses();	
 	$item3 = array("rowsClasses"=>$rowsClasses);
 	$serializer->loadItems($item3);	
  $rowsClass = $this->getRowsClass();	
 	$item4 = array("rowsClass"=>$rowsClass);
 	$serializer->loadItems($item4);	
  $rowsStyles = $this->getRowsStyles();	
 	$item5 = array("rowsStyles"=>$rowsStyles);
 	$serializer->loadItems($item5);	
  $rowsStyle = $this->getRowsStyle();	
 	$item6 = array("rowsStyle"=>$rowsStyle);
 	$serializer->loadItems($item6);
	$fieldsColClasses = $this->getFieldsColClasses();
 	$item7 = array("\$fieldsColClasses"=>$fieldsColClasses);
 	$serializer->loadItems($item7);
  $fieldsColStyles = $this->getFieldsColStyles();	
 	$item8 = array("\$fieldsColStyles"=>$fieldsColStyles);
 	$serializer->loadItems($item8);
  $fieldsStyles = $this->getFieldsStyles();	
 	$item9 = array("\$fieldsStyles"=>$fieldsStyles);
 	$serializer->loadItems($item9);
  $fieldsTypes = $this->getFieldsTypes();	
 	$item10 = array("\$fieldsTypes"=>$fieldsTypes);
 	$serializer->loadItems($item10);
 	$fieldsLabels = $this->getFieldsLabels(); 
 	$item11 = array("\$fieldsLabels"=>$fieldsLabels);
 	$serializer->loadItems($item11);
 	$fieldsStops = $this->getFieldsStops();
 	$item12 = array("\$fieldsStops"=>$fieldsStops);
 	$serializer->loadItems($item12);
 	$fieldsLengths = $this->getFieldsLengths();
 	$item13 = array("\$fieldsLengths"=>$fieldsLengths);
 	$serializer->loadItems($item13);	
 	$fieldsMandatory = $this->getFieldsMandatory();	
 	$item14 = array("\$fieldsMandatory"=>$fieldsMandatory);
 	$serializer->loadItems($item14);	
 	$labelSpacerWidth = $this->getLabelSpacerWidth();	
 	$item15 = array("labelSpacerWidth"=>$labelSpacerWidth);
 	$serializer->loadItems($item15);	
 	$fieldsDefaultValues = $this->getFieldsDefaultValues();	
 	$item16 = array("\$fieldsDefaultValues"=>$fieldsDefaultValues);
 	$serializer->loadItems($item16);
 	$fieldsHints = $this->getFieldsHints();	
 	$item17 = array("\$fieldsHints"=>$fieldsHints);
 	$serializer->loadItems($item17);
 	$fieldsEvents = $this->getFieldsEvents();	
 	$item18 = array("\$fieldsEvents"=>$fieldsEvents);
 	$serializer->loadItems($item18); 	
 	$fieldsRegexps = $this->getFieldsRegexps();	
 	$item19 = array("\$fieldsRegexps"=>$fieldsRegexps);
 	$serializer->loadItems($item19);
 	$labels = $this->getLabels();
 	$item20 = array("\$labels"=>$labels);
 	$serializer->loadItems($item20);
 	$fieldsToolTips = $this->getFieldsToolTips();	
 	$item21 = array("\$fieldsToolTips"=>$fieldsToolTips);
 	$serializer->loadItems($item21);
 	$fieldsDirections = $this->getFieldsDirections();	
 	$item22 = array("\$fieldsDirections"=>$fieldsDirections);
 	$serializer->loadItems($item22);
 	$cellPadding = $this->getCellPadding();	
 	$item23 = array("cellPadding"=>$cellPadding);
 	$serializer->loadItems($item23);
 	$cellSpacing = $this->getCellSpacing();
 	$item24 = array("cellSpacing"=>$cellSpacing);
 	$serializer->loadItems($item24);  	
 	//$javascriptEnabled = $this->getJavascriptEnabled();
 	//$item25 = array("*javascriptEnabled"=>$javascriptEnabled);
 	//$serializer->loadItems($item25); 	 	
 }
 
 function getGridDimX():int
 {
 	if($this->gridDimX == NO_VALUE)
 	 return self::DEFAULT_GRID_DIM_X; 
 	else
 	 return $this->gridDimX;
 }
 
 function setGridDimX(int $actGridDimX):void
 {
 	$this->gridDimX = $actGridDimX;
 }
 
 function getGridDimY():int
 {
 	if($this->gridDimY == NO_VALUE)
 	 return self::DEFAULT_GRID_DIM_Y; 
 	else
 	 return $this->gridDimY;
 }
 
 function setGridDimY(int $actGridDimY):void
 {
 	$this->gridDimY = $actGridDimY;
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
 
function setBootstrapContainerType(string $actBootstrapContainerType):void
{
	$this->bootstrapContainerType = $actBootstrapContainerType; 
}

 function getBootstrapContainerType():string
 {
 	return $this->bootstrapContainerType;
 }

function setBootstrapViewPortSizeType(string $actBootstrapViewPortSizeType):void
{
	$this->bootstrapViewPortSizeType = $actBootstrapViewPortSizeType; 
}

 function getBootstrapViewPortSizeType():string
 {
 	return $this->bootstrapViewPortSizeType;
 } 
 
 function getColClass():string
 {
  if ($this->colClass==STRING_NULL)
	 return self::DEFAULT_COLUMNS_CLASS;
	else
   return $this->colClass;
 }
 
 function setColClass(string $actColClass):void
 {
 	$this->colClass=$actColClass;
 }
 
 function getRowsClasses():array
 {
 	return $this->rowsClasses;
 }
 
 function setRowsClasses(array $actRowsClasses):void
 {
 	$this->rowsClasses=$actRowsClasses;
 }
 
 function getRowsClass():string
 {
 	return $this->rowsClass;
 }
 
 function setRowsClass(string $actRowsClass):void
 {
 	$this->rowsClass=$actRowsClass;
 }
 
 function getRowsStyles():array
 {
 	return $this->rowsStyles;
 }
 
 function setRowsStyles(array $actRowsStyles):void
 {
 	$this->rowsStyles=$actRowsStyles;
 }
 
 function getRowsStyle():string
 {
 	return $this->rowsStyle;
 }
 
 function setRowsStyle(string $actRowsStyle):void
 {
 	$this->rowsStyle=$actRowsStyle;
 }
 
 function getFieldsColStyles():array
 {
 	return $this->fieldsColStyles;
 }
 
 function getFieldColStyle(string $actFieldName):string
 {
 	$fieldsColStyles = $this->getFieldsColStyles();
 	if(isset($fieldsColStyles[$actFieldName]))
 	 return $fieldsColStyles[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
 
 function setFieldsColStyles(array $actFieldsColStyles):void
 {
 	$fieldsColStyles = $this->convertToAssociative($actFieldsColStyles);
 	$this->fieldsColStyles = $fieldsColStyles;
 }

 function setFieldColStyle(string $actFieldColStyle,string $actFieldName):bool
 {
 	$fieldsColStyles = $this->getFieldsColStyles();
 	if(isset($fieldsColStyles[$actFieldName]))
 	{
 	 $fieldsColStyles[$actFieldName] = $actFieldColStyle;
 	 $this->setFieldsColStyles($fieldsColStyles);
   return true;
  }
  else
   return false;
 }
 
 function getFieldsColClasses():array
 {
 	return $this->fieldsColClasses;
 }
 
 function getFieldColClass(string $actFieldName):string
 {
 	$fieldsColClasses = $this->getFieldsColClasses();
 	if(isset($fieldsColClasses[$actFieldName]))
 	 return $fieldsColClasses[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL; 	
 }
 
 function setFieldsColClasses(array $actFieldsColClasses):void
 {
 	$fieldsColClasses = $this->convertToAssociative($actFieldsColClasses);
 	$this->fieldsColClasses = $fieldsColClasses;
 }

 function setFieldColClass(string $actFieldColClass,string $actFieldName):bool
 {
 	$fieldsColClass = $this->getFieldsColClasess();
 	if(isset($fieldsColClasess[$actFieldName]))
 	{
 	 $fieldsColClasses[$actFieldName] = $actFieldColClass;
 	 $this->setFieldsColClasses($fieldsColClasses);
   return true;
  }
  else
   return false;
 }
 
 function getFieldsStyles():array
 {
 	return $this->fieldsStyles;
 }
 
 function getFieldStyle(string $actFieldName):string
 {
 	$fieldsStyles = $this->getFieldsStyles();
 	if(isset($fieldsStyles[$actFieldName]))
 	 return $fieldsStyles[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
 
 function setFieldsStyles(array $actFieldsStyles):void
 {
 	$fieldsStyles = $this->convertToAssociative($actFieldsStyles);
 	$this->fieldsStyles = $fieldsStyles;
 }

 function setFieldStyle(string $actFieldStyle,string $actFieldName):bool
 {
 	$fieldsStyles = $this->getFieldsStyles();
 	if(isset($fieldsStyles[$actFieldName]))
 	{
 	 $fieldsStyles[$actFieldName] = $actFieldStyle;
 	 $this->setFieldsStyles($fieldStyles);
   return true;
  }
  else
   return false;
 }


 function getFieldsTypes():array
 {
 	return $this->fieldsTypes;
 }
 
 function getFieldType(string $actFieldName):string
 {
 	$fieldsTypes = $this->getFieldsTypes();
 	if(isset($fieldsTypes[$actFieldName]))
 	 return $fieldsTypes[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
 
 function setFieldsTypes(array $actFieldsTypes):void
 {
 	$fieldsTypes = $this->convertToAssociative($actFieldsTypes);
 	$this->fieldsTypes = $fieldsTypes;
 }

 function setFieldType(string $actFieldType,string $actFieldName):bool
 {
 	$fieldsTypes = $this->getFieldsTypes();
 	if(isset($fieldsTypes[$actFieldName]))
 	{
 	 $fieldsTypes[$actFieldName] = $actFieldType;
 	 $this->setFieldsTypes($fieldTypes);
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
 
 function getFieldsLabels():array
 {
 	return $this->fieldsLabels;
 }
 
 function setFieldsLabels(array $actFieldsLabels):void
 {
 	$fieldsLabels = $this->convertToAssociative($actFieldsLabels);
 	$this->fieldsLabels = $fieldsLabels;
 }
 
 function getFieldToolTip(string $actFieldName):string
 {
 	$fieldsToolTips = $this->getFieldsToolTips();
 	if(isset($fieldsToolTips[$actFieldName]))
 	 return $fieldsToolTips[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
 
 function getFieldsToolTips():array
 {
 	return $this->fieldsToolTips;
 }
 
 function setFieldsToolTips(array $actFieldsToolTips):void
 {
 	$fieldsToolTips = $this->convertToAssociative($actFieldsToolTips);
 	$this->fieldsToolTips = $fieldsToolTips;
 }
 
 function getFieldDirection(string $actFieldName):string
 {
 	$fieldsDirections = $this->getFieldsDirections();
 	if(isset($fieldsDirections[$actFieldName]))
 	 return $fieldsDirections[$actFieldName];
 	else
 	 return self::NO_FIELD_LABEL;
 }
 
 function getFieldsDirections():array
 {
 	return $this->fieldsDirections;
 }
 
 function setFieldsDirections(array $actFieldsDirections):void
 {
 	$fieldsDirections = $this->convertToAssociative($actFieldsDirections);
 	$this->fieldsDirections = $fieldsDirections;
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
 
 function getFieldsStops():array
 {
 	return $this->fieldsStops;
 }
 
 function setFieldsStops(array $actFieldsStops):void
 {
 	$fieldsStops = $this->convertToAssociative($actFieldsStops);
 	$this->fieldsStops = $fieldsStops;
 }
 
 function getFieldStop(string $actFieldName):string|bool|int
 {
 	$fieldsStops = $this->getFieldsStops();
 	if(isset($fieldsStops[$actFieldName]))
 	{
 	 $stop = $fieldsStops[$actFieldName];
 	 ($stop==STRING_NULL)?$stop=0:$stop;
 	 return $stop;
 	}
 	else
 	 return 0;
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
 	 ($length==STRING_NULL)?$length=0:$length;
 	 return $length;
 	}
 	else
 	 return STRING_NULL;
 }
 
 function setFieldsMandatory(array $actFieldsMandatories):void
 {
 	$fieldsMandatories = $this->convertToAssociative($actFieldsMandatories);
  $this->fieldsMandatory = $fieldsMandatories;
 }
 
 function getFieldsMandatory():array
 {
 	return $this->fieldsMandatory; 
 } 
 
 function getFieldMandatory(string $actFieldName):string|bool
 {
 	$fieldsMandatories = $this->getFieldsMandatory();
 	if(isset($fieldsMandatories[$actFieldName]))
 	 return $fieldsMandatories[$actFieldName];
 	else
 	 return STRING_NULL;
 }
 
 function getFieldsDefaultValues():array
 {
 	return $this->fieldsDefaultValues;
 }
 
 function setFieldsDefaultValues(array $actFieldsDefaultValues):void
 {
 	$fieldsDefaultValues = $this->convertToAssociative($actFieldsDefaultValues);
 	$this->fieldsDefaultValues = $fieldsDefaultValues;
 }
 
 function getFieldDefaultValue(string $actFieldName):string|int
 {
 	$fieldsDefaultValues = $this->getFieldsDefaultValues();
  	
 	if(isset($fieldsDefaultValues[$actFieldName]))
 	 return $fieldsDefaultValues[$actFieldName];
 	else
 	 return STRING_NULL;
 }
 
 function getFieldsHints():array
 {
 	return $this->fieldsHints;
 }
 
 function setFieldsHints(array $actFieldsHints):void
 {
 	$fieldsHints = $this->convertToAssociative($actFieldsHints);
 	$this->fieldsHints = $fieldsHints;
 }
 
 function getFieldHint(string $actFieldName):string
 {
 	$fieldsHints = $this->getFieldsHints();
 	if(isset($fieldsHints[$actFieldName]))
 	 return $fieldsHints[$actFieldName];
 	else
 	 return STRING_NULL;
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
 
 function getFieldsEvents():array
 {
 	return $this->fieldsEvents;
 }
 
 function setFieldsEvents(array $actFieldsEvents):void
 {
 	$fieldsEvents = $this->convertToAssociative($actFieldsEvents);
 	$this->fieldsEvents = $fieldsEvents;
 }
 
 function getFieldEvents(string $actFieldName):array
 {
 	$fieldsEvents = $this->getFieldsEvents();
 	if(isset($fieldsEvents[$actFieldName]))
 	 return $fieldsEvents[$actFieldName];
 	else
 	 return STRING_NULL;
 }
 
 function getFieldsRegExps():array
 {
 	return $this->fieldsRegExps;
 }
 
 function setFieldsRegExps(array $actFieldsRegexps):void
 {
 	$fieldsRegexps = $this->convertToAssociative($actFieldsRegexps);
 	$this->fieldsRegExps = $fieldsRegexps;
 }
 
 function getFieldRegExp(string $actFieldName):string
 {
 	$fieldsRegexps = $this->getFieldsRegExps();
 	if(isset($fieldsRegexps[$actFieldName]))
 	 return $fieldsRegexps[$actFieldName];
 	else
 	 return STRING_NULL;
 }
 
 function getLabel(string $actFieldName):string|array
 {
 	$labels = $this->getLabels();
 	if(isset($labels[$actFieldName]))
 	 return $labels[$actFieldName];
 	else
 	 return STRING_NULL;
 }
 
 function setLabels(array $actLabels):void
 {
 	$labels = $this->convertToAssociative($actLabels);
 	$this->labels = $labels;
 }
 
 function getLabels():array
 {
 	return $this->labels;
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
 
  function setCellPadding(int $actCellPadding):void
 {
 	$this->cellPadding = $actCellPadding;
 }
 
 function getCellPadding():int
 {
  if ($this->cellPadding==NO_VALUE)
	 return self::DEFAULT_CELLPADDING;
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
	 return self::DEFAULT_CELLSPACING;
	else
   return $this->cellSpacing;
 }
 
 function setGesPage(string $actPage):void
 {
  $this->gesPage = $actPage;
 }
 
 function getGesPage():string
 {
  return $this->gesPage;
 }

 function deleteField(string $actFieldName):bool
 {
  $fieldsMandatory = $this->getFieldsMandatory();
  $pos2 = array_getPos($fieldsMandatory,$actFieldName);
  if($pos2)
  {
   $newFieldsMandatory = array();
   $newFieldsMandatory = array_deleteItem($fieldsMandatory,$actFieldName);
   $this->setFieldsMandatory($newFieldsMandatory);  
  }
 	$dataFields = $this->getDataFields();
  $pos = array_getPos($dataFields,$actFieldName);
  if($pos)
  {
   $intFormFieldsContainer = $this->getIntFieldsContainer();
   $intFormFieldsContainer->deleteItem($pos);
   $fieldsColClasses = $this->getFieldsColClasses();
   $fieldsColStyles = $this->getFieldsColStyles();
   $fieldsStyles = $this->getFieldsStyles();
   $fieldsLabels = $this->getFieldsLabels();
   $fieldsStops = $this->getFieldsStops();
   $fieldsLengths = $this->getFieldsLengths();
   $fieldsDefaultValues = $this->getFieldsDefaultValues();
   $fieldsHints = $this->getFieldsHints();
   $fieldsEvents = $this->getFieldsEvents();
   $fieldsRegexps = $this->getFieldsRegexps();
   $fieldsToolTips = $this->getFieldsToolsTips();

   if (isset($fieldsColClasses[$actFieldName]))
     unset($fieldsColClasses[$actFieldName]);
   $this->setFieldsColClasses($fieldsColClasses);

   if (isset($fieldsColStyles[$actFieldName]))
     unset($fieldsColStyles[$actFieldName]);
   $this->setFieldsColStyles($fieldsColStyles);
   
   if (isset($fieldsStyles[$actFieldName]))
     unset($fieldsStyles[$actFieldName]);
   $this->setFieldsStyles($fieldsStyles);

   if (isset($fieldsLabels[$actFieldName]))
     unset($fieldsLabels[$actFieldName]);
   $this->setFieldsLabels($fieldsLabels);

   if (isset($fieldsStops[$actFieldName]))
     unset($fieldsStops[$actFieldName]);
   $this->setFieldsStops($fieldsStops);

   if (isset($fieldsLengths[$actFieldName]))
     unset($fieldsLengths[$actFieldName]);
   $this->setFieldsLengths($fieldsLabels); 

   if (isset($fieldsDefaultValues[$actFieldName]))
     unset($fieldsDefaultValues[$actFieldName]);
   $this->setFieldsDefaultValues($fieldsDefaultValues);
   
   if (isset($fieldsHints[$actFieldName]))
     unset($fieldsHints[$actFieldName]);
   $this->setFieldsHints($fieldsHints);
     
   if (isset($fieldsEvents[$actFieldName]))
    unset($fieldsEvents[$actFieldName]);     
   $this->setFieldsEvents($fieldsEvents);
   
   if (isset($fieldsRegexps[$actFieldName]))
     unset($fieldsRegexps[$actFieldName]);
   $this->setFieldsRegexps($fieldsRegexps); 
   
   if (isset($fieldsToolTips[$actFieldName]))
     unset($fieldsToolTips[$actFieldName]);
   $this->setFieldsToolTips($fieldsToolTips);    
   
  }
  if((!$pos)&&(!$pos2))
   die(self::ERROR_3);
 return true;
 }
 
 function containDataFieldEvents(string $actFieldName):bool
 {
  $events = $this->getFieldsEvents();
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
 
 function putInputCtrl(string $actName,$actValue,string $actType,string $actStyle,
 string $actDomain,
 int $actLength=STRING_NULL,
 int $actStop=STRING_NULL,string $actHint=STRING_NULL,
 string $actToolTip=STRING_NULL,
 array $actEvents=array(),
 string $actRegExp=STRING_NULL,$actDefaultValue=STRING_NULL,
 $actIsMandatory=STRING_NULL,$actLabels=STRING_NULL,
 string $actDirection=STRING_NULL):void
 {
  $htmlWriter = $this->getHtmlWriter();
  //echo "BBBB:" . $actIsMandatory;
  $factory = new putDojoInputCtrl_factory($actName,$actValue,
  $actType,$actStyle,$actLength,$actStop,
  $actHint,$actToolTip,$actEvents,$actRegExp,$actDefaultValue,
  $actIsMandatory,$actLabels,$actDirection);
  $obj = $factory->create($actDomain,$htmlWriter);
  $obj->exec();
 }

 function putInputCtrls(string $actFieldName,$actFieldValue,string $actType,
 string $actDomain,int $actIndX,int $actIndY,int $actDimX,
 string $actWidth,bool $actLastEl):void
 {
  $htmlWriter = $this->getHtmlWriter(); 
  $intCode = $this->getInterfaceId();

  $bootstrapEnabled = $this->getBootstrapEnabled();  
  $length = $this->getFieldLength($actFieldName); 
  if($length==STRING_NULL)
   $length = self::DEFAULT_FIELDS_LENGTH;  
  $stop = $this->getFieldStop($actFieldName);
  $hint = $this->getFieldHint($actFieldName);
  $events = $this->getFieldEvents($actFieldName);
  $colClass = $this->getFieldColClass($actFieldName);
	 
  $regExp = $this->getFieldRegExp($actFieldName);
  if(($actFieldValue==STRING_NULL)||(is_array($actFieldValue)))
  {
   $fieldDefaultValue = $this->getFieldDefaultValue($actFieldName);
  }
  elseif( ! is_array($actFieldValue))
   $fieldDefaultValue = $actFieldValue;
  else
   $fieldDefaultValue = STRING_NULL;
     
  $isMandatory = var_export($this->getFieldMandatory($actFieldName),true);
  //echo "AAAA:" . var_export($isMandatory);
  $fieldLabel = $this->getFieldLabel($actFieldName);
  $labels = $this->getLabel($actFieldName);
  $toolTip = $this->getFieldToolTip($actFieldName);
  $colStyle = $this->getFieldColStyle($actFieldName);
  $fieldStyle = $this->getFieldStyle($actFieldName);
  $fieldDirection = $this->getFieldDirection($actFieldName);
  
   if(($colStyle == STRING_NULL) && (! $bootstrapEnabled))
  {
   if($actIndX <= $actDimX - 1)
    $colStyle = $colStyle . STRING_SPACE . "width:" . $actWidth . 
    STRING_SEMICOLON . "float:left;"; 
   elseif(($actIndX <= $actDimX - 1)&&($actIndX == 0))
    $colStyle = $colStyle . STRING_SPACE . "width:" . $actWidth . 
    STRING_SEMICOLON;
   else
    $colStyle = $colStyle . STRING_SPACE .  "float:left;";	   
  }
  else
   $colStyle = $colStyle . STRING_SPACE . "float:left;";
     
  $gridDimX = $this->getGridDimX();
  
	$numBootstrapCols = round(12 / $gridDimX);
	 if($numBootstrapCols < 1)
	  $numBootstrapCols = 1;
	  
	$bootstrapViewPortSizeType = $this->getBootstrapViewPortSizeType();
  
  $bootstrapColClass = "col" . STRING_MINUS . 
     $bootstrapViewPortSizeType . STRING_MINUS . 
     $numBootstrapCols; 
   
  $colClassVal= $colClass; 

  if($bootstrapEnabled)    
  $colClassVal .= STRING_SPACE . $bootstrapColClass;     
       
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . "ind" . VAR_SEP . 
  $actIndY . VAR_SEP . $actIndX,
  $colStyle,$colClassVal);

  $labelSpacerWidth = $this->getLabelSpacerWidth();

  $labelSpacerWidth1 = (($labelSpacerWidth==STRING_NULL)?
  self::DEFAULT_LABEL_SPACER_WIDTH:$labelSpacerWidth);

  for($i=0;$i<=$labelSpacerWidth1-1;$i++)
   $fieldLabel = $fieldLabel . ENTITY_SPACE; 
  $htmlWriter->putLabelTag($intCode . VAR_SEP . self::FIELD_LABEL_ID_SUFFIX . 
	VAR_SEP . $actFieldName,STRING_NULL,self::CSS_FORM_LABELS,
	STRING_NULL,$fieldLabel);
	if($actDomain==Int_domain::FIELD_DOMAIN_RADIO)
	 $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG); 
	 
	if($actDomain==Int_domain::FIELD_DOMAIN_OBJ)
	{
	 $actFieldValue->setStyle($fieldStyle);
	 $actFieldValue->putData();	
	}
	else
	{ 
   $this->putInputCtrl($actFieldName,$actFieldValue,$actType,
   $fieldStyle,$actDomain,$length,$stop,$hint,$toolTip,$events,$regExp,
   $fieldDefaultValue,$isMandatory,$labels,$fieldDirection);    
  }
  if(! $actLastEl)
   $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG);          	
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0); 
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 {
  $htmlWriter = $this->getHtmlWriter();	
  $class = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  $rows = $this->getDataSource();
  $obj = $this->getObj();
  $bootstrapEnabled = $this->getBootstrapEnabled();
  
//
// Mi aspetto un array;
//
  if(isset($rows))
  {
   if(! is_array($rows))
    $row = array($rows);
   elseif(is_array_of_array($rows))
    $row = current($rows);
   else
    $row = $rows;
  }
  else
   $row = array();
     
  $cellPadding = $this->getCellPadding();
  $cellSpacing = $this->getCellSpacing();
  
  $fields = $this->getDataFields();
  $num = count($fields);
  $style = $this->getStyle();	
  $rowsClasses = $this->getRowsClasses();
  $rowsClass = $this->getRowsClass();
  $rowsStyles = $this->getRowsStyles();
  $rowsStyle = $this->getRowsStyle(); 

  $bootstrapContainerType = $this->getBootstrapContainerType(); 
  
  $classVal = $class;
  if($bootstrapEnabled)					   
  $classVal .= STRING_SPACE . $bootstrapContainerType;     
    
  $htmlWriter->putDivOpenTag($intCode,$style,$classVal);
  $htmlWriter->putDivOpenTag($intCode . 
  VAR_SEP . "inner_table","padding:" . 
  $cellPadding . "px" . 
  STRING_SEMICOLON . "margin:" . 
  $cellSpacing . "px",$classVal);
  
  $gridDimX = $this->getGridDimX();
  $gridDimY = $this->getGridDimY();
  $j=0;
  $k=0;
  
  $width = round(100 / $gridDimX)-1;
  $width = $width . STRING_PERCENT;
  
  $rowClassVal = (isset($rowsClasses[0])?$rowsClasses[0]:(self::DEFAULT_ROWS_CLASS));
  $rowStyleVal = (isset($rowsStyles[0])?$rowsStyles[0]:(self::DEFAULT_ROWS_STYLE));
  if($rowsClass !== STRING_NULL)
   $rowClassVal = $rowsClass;
  if($rowsStyle !== STRING_NULL)
   $rowStyleVal = $rowsStyle; 

  if($bootstrapEnabled)   
  $rowClassVal .= STRING_SPACE . 
  self::DEFAULT_BOOTSTRAP_CSS_ROW_TYPE;   
   
  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . 
  self::DEFAULT_BOOTSTRAP_CSS_ROW_TYPE . VAR_SEP . $k,
  $rowStyleVal,$rowClassVal);
  for($i=0;$i<=$num-1;$i++)
  {
   $fieldName = $fields[$i];
   
   $type1 = $this->getFieldType($fieldName);
   
   if($obj !== OBJ_NONE)
	  $type = $this->getDataFieldType($fieldName);
	 else
	  $type = $type1;
	  
	 $domain = $this->getDataFieldDomainByName($fieldName);

   if(isset($row[$fieldName]))
	  $fieldActValue = trim($row[$fieldName]);
	 else
	  $fieldActValue = FIELD_NO_VALUE;
	  
	 $fieldActValue = $this->getDataFieldAllValues($fieldName,$fieldActValue);   

   if($j > $gridDimX - 1)
   {
    $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
    $htmlWriter->putGenericHtmlString(SEP_OPEN_TAG); 
    $k++;
    if($k <= $gridDimY - 1)
    {
     $rowClassVal = (isset($rowsClasses[$k])?$rowsClasses[$k]:(self::DEFAULT_ROWS_CLASS));
     $rowStyleVal = (isset($rowsStyles[$k])?$rowsStyles[$k]:(self::DEFAULT_ROWS_STYLE));
     if($rowsClass !== STRING_NULL)
      $rowClassVal = $rowsClass;

	 if($bootstrapEnabled)
     $rowClassVal .= STRING_SPACE . self::DEFAULT_BOOTSTRAP_CSS_ROW_TYPE;
      
     if($rowsStyle !== STRING_NULL)
      $rowStyleVal = $rowsStyle;
     
     $htmlWriter->putDivOpenTag($intCode . VAR_SEP . 
     self::DEFAULT_BOOTSTRAP_CSS_ROW_TYPE . VAR_SEP . $k,
     $rowStyleVal,$rowClassVal);
     $j=0;
 	   $this->putInputCtrls($fieldName,$fieldActValue,
 	   $type,$domain,$j,$k,$gridDimX,$width,true);
 	   $j++;
 	  }
   }
   else
   {
 	  if($j == $gridDimX - 1)
 	  {
 	   $this->putInputCtrls($fieldName,$fieldActValue,$type,$domain,$j,$k,
 	   $gridDimX,$width,false);
 	  }
 	  else
 	  {
 	   $this->putInputCtrls($fieldName,$fieldActValue,$type,$domain,$j,$k,
 	   $gridDimX,$width,true);
 	  }
 	  $j++;
   }
    
   if($k > $gridDimY - 1)
    die(self::ERROR_4);
  }
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);  
  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
 }
	
}


?>