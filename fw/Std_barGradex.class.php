<?
namespace Std\fw;
require_once("Html_data_interface.class.php");
require_once("std.fun.php");
require_once("Jpgraph.class.php");
require_once("Jpgraph_bar.class.php");
require_once("Classes_info.class.php");
require_once("Creator.tra.php");


define('JPGRAPH_IMG_DIR',THIS_DIR . DIR_SEP . "img");
define('DEFAULT_JPGRAPH_FILENAME',"BarGradex" . FILE_NAME_ELEMENTS_SEP . JPEG_ACRONYM);

class Std_barGradex extends Html_data_interface
{
 Use Creator;	
	
 const ERROR_1="Std_barGradex:Numero campi dati errato.";
 const JPGRAPH_IMG_DIR = JPGRAPH_IMG_DIR;
 const DEFAULT_CLASS = "BarGradex";
 const DEFAULT_WIDTH = 400;
 const DEFAULT_HEIGHT = 200;
 const DEFAULT_FILENAME=DEFAULT_JPGRAPH_FILENAME;
 const DEFAULT_LEFTMARGIN = 60;
 const DEFAULT_RIGHTMARGIN = 20;
 const DEFAULT_TOPMARGIN = 30;
 const DEFAULT_BOTTOMMARGIN = 150;
 const DEFAULT_SCALE = "textlin";
 const DEFAULT_MARGINCOLOR = "silver";
 const DEFAULT_TITLE_LABEL = STRING_NULL;
 const DEFAULT_TITLE_FONT_FAMILY = JPGRAPH_FF_VERDANA;
 const DEFAULT_TITLE_FONT_TYPE = JPGRAPH_FS_NORMAL;
 const DEFAULT_TITLE_FONT_SIZE = 18;
 const DEFAULT_TITLE_FONT_COLOR = "darkred";
 const DEFAULT_XAXIS_FONT_FAMILY = JPGRAPH_FF_VERDANA;
 const DEFAULT_XAXIS_FONT_TYPE = JPGRAPH_FS_NORMAL;
 const DEFAULT_XAXIS_FONT_SIZE = 12;
 const DEFAULT_XAXIS_FONT_COLOR = "#000000";
 const DEFAULT_YAXIS_FONT_FAMILY = JPGRAPH_FF_VERDANA;
 const DEFAULT_YAXIS_FONT_TYPE = JPGRAPH_FS_NORMAL;
 const DEFAULT_YAXIS_FONT_SIZE = 11;
 const DEFAULT_XAXIS_LABEL_ANGLE = 50;
 const DEFAULT_YAXIS_FONT_COLOR = "#000000";
 const DEFAULT_BARPLOT_WIDTH = 0.6;
 const DATAX_POS = 0;
 const DATAY_POS = 1;
 
 private $graph=null;
 private $bplot=null;
 private $width=self::DEFAULT_WIDTH;
 private $height=self::DEFAULT_HEIGHT;
 private $fileName=self::DEFAULT_FILENAME;
 private $imageDir = STRING_NULL;
 private $dataXField = STRING_NULL;
 private $dataYField = STRING_NULL;
 private $leftMargin = self::DEFAULT_LEFTMARGIN;
 private $rightMargin = self::DEFAULT_RIGHTMARGIN;
 private $topMargin = self::DEFAULT_TOPMARGIN;
 private $bottomMargin = self::DEFAULT_BOTTOMMARGIN;
 private $scale = self::DEFAULT_SCALE;
 private $marginColor = self::DEFAULT_MARGINCOLOR;
 private $shadow=STRING_NULL;
 private $titleLabel = self::DEFAULT_TITLE_LABEL;
 private $titleFontFamily = self::DEFAULT_TITLE_FONT_FAMILY;
 private $titleFontType = self::DEFAULT_TITLE_FONT_TYPE;
 private $titleFontSize = self::DEFAULT_TITLE_FONT_SIZE;
 private $titleFontColor = self::DEFAULT_TITLE_FONT_COLOR;
 private $titleXAxisFontFamily = self::DEFAULT_XAXIS_FONT_FAMILY;
 private $titleXAxisFontType = self::DEFAULT_XAXIS_FONT_TYPE;
 private $titleXAxisFontSize = self::DEFAULT_TITLE_FONT_SIZE;
 private $titleXAxisFontColor = self::DEFAULT_XAXIS_FONT_COLOR;
 private $titleYAxisFontFamily = self::DEFAULT_YAXIS_FONT_FAMILY;
 private $titleYAxisFontType = self::DEFAULT_YAXIS_FONT_TYPE;
 private $titleYAxisFontSize = self::DEFAULT_YAXIS_FONT_SIZE; 
 private $titleYAxisFontColor = self::DEFAULT_YAXIS_FONT_COLOR;  
 private $titleXAxisLabelAngle = self::DEFAULT_XAXIS_LABEL_ANGLE;
 static private $barGradexsTotNum=0;  
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = false;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$barGradexsTotNum++;
 	if($actNum === STRING_NULL)
 	 $actNum = self::$barGradexsTotNum - 1; 	
  parent::__construct($actObj,$actOp,self::INT_BARGRADEX,$actNum);
 }
 
 function hasJavascriptEnabledSwitch():bool
 {
  return self::$hasJavascriptEnabledSwitch;
 }
	
 function hasJavascriptManagement():bool
 {
  return self::$hasJavascriptManagement;
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$barGradexsTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$barGradexsTotNum=$actIntNum + 0;
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
 											 
	$width = $this->getWidth();
 	$item1 = array("width"=>$width);
 	$serializer->loadItems($item1);
 	$height = $this->getHeight();
 	$item2 = array("height"=>$height);
 	$serializer->loadItems($item2); 
 	$fileName = $this->getFileName();
 	$item3 = array("fileName"=>$fileName);
 	$serializer->loadItems($item3);  	
 	$imageDir = $this->getImageDir();
 	$item4 = array("imageDir"=>$imageDir);
 	$serializer->loadItems($item4);
 	$dataXField = $this->getDataXField();
 	$item5 = array("dataXField"=>$dataXField);
 	$serializer->loadItems($item5);
 	$dataYField = $this->getDataYField();
 	$item6 = array("dataYField"=>$dataYField);
 	$serializer->loadItems($item6); 
 	$leftMargin = $this->getLeftMargin();
 	$item7 = array("leftMargin"=>$leftMargin);
 	$serializer->loadItems($item7);
 	$rightMargin = $this->getRightMargin();
 	$item8 = array("rightMargin"=>$rightMargin);
 	$serializer->loadItems($item8);
 	$topMargin = $this->getTopMargin();
 	$item9 = array("topMargin"=>$topMargin);
 	$serializer->loadItems($item9);
 	$bottomMargin = $this->getBottomMargin();
 	$item10 = array("bottomMargin"=>$bottomMargin);
 	$serializer->loadItems($item10); 
 	$scale = $this->getScale();
 	$item11 = array("scale"=>$scale);
 	$serializer->loadItems($item11); 
 	$marginColor = $this->getMarginColor();
 	$item12 = array("marginColor"=>$marginColor);
 	$serializer->loadItems($item12);
 	$shadow = $this->getShadow();
 	$item13 = array("shadow"=>$shadow);
 	$serializer->loadItems($item13); 
 	$titleLabel = $this->getTitleLabel();
 	$item14 = array("titleLabel"=>$titleLabel);
 	$serializer->loadItems($item14);
 	$titleFontFamily = $this->getTitleFontFamily();
 	$item15 = array("titleFontFamily"=>$titleFontFamily);
 	$serializer->loadItems($item15); 
 	$titleFontSize = $this->getTitleFontSize();
 	$item16 = array("titleFontSize"=>$titleFontSize);
 	$serializer->loadItems($item16); 
 	$titleFontColor = $this->getTitleFontColor();
 	$item17 = array("titleFontColor"=>$titleFontColor);
 	$serializer->loadItems($item17); 
 	$titleXAxisFontFamily= $this->getTitleXAxisFontFamily();
 	$item18 = array("titleXAxisFontFamily"=>$titleXAxisFontFamily);
 	$serializer->loadItems($item18); 
 	$titleXAxisFontType= $this->getTitleXAxisFontType();
 	$item19 = array("titleXAxisFontType"=>$titleXAxisFontType);
 	$serializer->loadItems($item19);
 	$titleXAxisFontSize= $this->getTitleXAxisFontSize();
 	$item20 = array("titleXAxisFontSize"=>$titleXAxisFontSize);
 	$serializer->loadItems($item20);
 	$titleYAxisFontFamily= $this->getTitleYAxisFontFamily();
 	$item21 = array("titleYAxisFontFamily"=>$titleYAxisFontFamily);
 	$serializer->loadItems($item21);	
 	$titleYAxisFontType= $this->getTitleYAxisFontType();
 	$item22 = array("titleYAxisFontType"=>$titleYAxisFontType);
 	$serializer->loadItems($item22);	
 	$titleYAxisFontSize= $this->getTitleYAxisFontSize();
 	$item23 = array("titleYAxisFontSize"=>$titleYAxisFontSize);
 	$serializer->loadItems($item23);	
 	$titleXAxisLabelAngle= $this->getTitleXAxisLabelAngle();
 	$item24 = array("titleXAxisLabelAngle"=>$titleXAxisLabelAngle);
 	$serializer->loadItems($item24);
 }
 
 function createGraph(int $actWidth,int $actHeight,string $actFileName):Graph
 {
 	$graph = Creator::create(getClassNameForCreate(Classes_info::GRAPH_CLASS),STRING_NULL,$actWidth,$actHeight,$actFileName);
 	return $graph;
 } 
 
 function setImageDir(string $actImageDir):void
 {
 	$this->imageDir = $actImageDir;
 }
 
 function getImageDir():string
 {
 	return $this->imageDir;
 }
 
 function setDataXField(string $actDataXField):void
 {
 	$this->dataXField = $actDataXField;
 }
 
 function getDataXField():string
 {
 	return $this->dataXField;
 }
 
 function setDataYField(string $actDataYField):void
 {
 	$this->dataYField = $actDataYField;
 }
 
 function getDataYField():string
 {
 	return $this->dataYField;
 } 
 
 function getDataY():array|string|bool
 {
 	$dataYField = $this->getDataYField();
 	$dataFields = $this->getDataFields();
	if(in_array($dataYField,$dataFields))
	{
	 $barGradexDatay = $this->getDataFieldDomainValueByName($dataYField);
	 return $barGradexDatay;
	}
	else
	{
	 $dataYField = $dataFields[self::DATAY_POS];
	 $barGradexDatay = $this->getDataFieldDomainValueByName($dataYField);
	 return $barGradexDatay;
	}
  return false;
 }
 
 function setDataY(array|string $actDataY):bool
 {
 	$dataYField = $this->getDataYField();
 	$dataFields = $this->getDataFields();
	if(in_array($dataYField,$dataFields))
	{
	 $this->setDataFieldDomainValueByName($dataYField,$actDataY);
	 return true;
	}
	else
	{
	 $dataYField = $dataFields[self::DATAY_POS];
	 $this->setDataFieldDomainValueByName($dataYField,$actDataY);
	 return true;
	}
  return false; 	
 }
 
 function getDataX():array|string|bool
 {
 	$dataXField = $this->getDataXField();
 	$dataFields = $this->getDataFields();
	if(in_array($dataXField,$dataFields))
	{
	 $barGradexDatax = $this->getDataFieldDomainValueByName($dataXField);
	 return $barGradexDatax;
	}
	else
	{
	 $dataXField = $dataFields[self::DATAX_POS];
	 $barGradexDatax = $this->getDataFieldDomainValueByName($dataXField);
	 return $barGradexDatax;
	}
  return false;
 }
 
 function setDataX(array|string $actDataX):bool
 {
 	$dataXField = $this->getDataXField();
 	$dataFields = $this->getDataFields();
	if(in_array($dataXField,$dataFields))
	{
	 $this->setDataFieldDomainValueByName($dataXField,$actDataX);
	 return true;
	}
	else
	{
	 $dataXField = $dataFields[self::DATAX_POS];
	 $barGradexDatax = $this->setDataFieldDomainValueByName($dataXField,$actDataX);
	 return true;
	}
  return false; 
 }
 
 function setGraph(Graph $actGraph):void
 {
 	$this->graph = $actGraph;
 }
 
 function getGraph():Graph
 {
 	return $this->graph;
 }
 
 function setBplot(BarPlot $actBplot):void
 {
 	$this->bplot = $actBplot;
 }
 
 function createBarPlot(array $actDataY):BarPlot
 {
 	$bplot = Creator::create(getClassNameForCreate(BAR_PLOT_CLASS),STRING_NULL,$actDataY);
 	return $bplot; 
 }
 
 function getBplot(array $actDataY=array()):BarPlot
 {
 	if(! isset($this->bplot))
 	{
 	 $dataY = $actDataY;
 	 $this->bplot = $this->createBarPlot($dataY);
   $this->bplot->setWidth(self::DEFAULT_BARPLOT_WIDTH);
   $this->bplot->setFillGradient("navy","lightsteelblue",JPGRAPH_GRAD_MIDVER);
   $this->bplot->setColor("navy");
 	} 	
 	return $this->bplot;
 }

 function getWidth():int
 {
 	if($this->width == NO_VALUE)
 	 return self::DEFAULT_WIDTH;
 	else
 	 return $this->width;
 }
 
 function setWidth(int $actWidth):void
 {
 	$this->width = $actWidth;
 }
 
 function getHeight():int
 {
 	if($this->height == NO_VALUE)
 	 return self::DEFAULT_HEIGHT;
 	else
 	 return $this->height;
 }
 
 function setHeight(int $actHeight):void
 {
 	$this->height = $actHeight;
 }
 
 function getFileName():string
 {
 	if($this->fileName == NO_VALUE)
 	 return self::DEFAULT_FILENAME;
 	else
 	 return $this->fileName;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getLeftMargin():int
 {
 	if($this->leftMargin == NO_VALUE)
 	 return self::DEFAULT_LEFTMARGIN;
 	else
 	 return $this->leftMargin;
 }
 
 function setLeftMargin(int $actLeftMargin):void
 {
 	$this->leftMargin = $actLeftMargin;
 }
 
 function getRightMargin():int
 {
 	if($this->rightMargin == NO_VALUE)
 	 return self::DEFAULT_RIGHTMARGIN;
 	else
 	 return $this->rightMargin;
 }
 
 function setRightMargin(int $actRightMargin):void
 {
 	$this->rightMargin = $actRightMargin;
 }

 function setTopMargin(int $actTopMargin):void
 {
 	$this->topMargin = $actTopMargin;
 }
 
 function getTopMargin():int
 {
 	if($this->topMargin == NO_VALUE)
 	 return self::DEFAULT_TOPMARGIN;
 	else
 	 return $this->topMargin;
 }

 function setBottomMargin(int $actBottomMargin):void
 {
 	$this->bottomMargin = $actBottomMargin;
 }
 
 function getBottomMargin():int
 {
 	if($this->bottomMargin == NO_VALUE)
 	 return self::DEFAULT_BOTTOMMARGIN;
 	else
 	 return $this->bottomMargin;
 }
 
 function setScale(int|string $actScale):void
 {
 	$this->scale = $actScale;
 }
 
 function getScale():int|string
 {
 	if($this->scale == NO_VALUE)
 	 return self::DEFAULT_SCALE;
 	else
 	 return $this->scale;
 }
 
 function setMarginColor(string $actMarginColor):void
 {
 	$this->marginColor = $actMarginColor;
 }
 
 function getMarginColor():string
 {
 	if($this->marginColor == STRING_NULL)
 	 return self::DEFAULT_MARGINCOLOR;
 	else
 	 return $this->marginColor;
 }
 
 function setShadow(string $actShadow):void
 {
 	$this->shadow = $actShadow;
 }
 
 function getShadow():string
 {
 	return $this->shadow;
 }
 
 function setTitleLabel(string $actTitleLabel):void
 {
 	$this->titleLabel = $actTitleLabel;
 }
 
 function getTitleLabel():string
 {
 	return $this->titleLabel;
 } 
 
 function setTitleFontFamily(string $actTitleFontFamily):void
 {
 	$this->titleFontFamily = $actTitleFontFamily;
 }
 
 function getTitleFontFamily():string
 {
 	if($this->titleFontFamily == STRING_NULL)
 	 return self::DEFAULT_TITLE_FONT_FAMILY;
 	else
 	 return $this->titleFontFamily;
 }
 
 function setTitleFontType(string $actTitleFontType):void
 {
 	$this->titleFontType = $actTitleFontType;
 }
 
 function getTitleFontType():string
 {
  if($this->titleFontType == STRING_NULL)
   return self::DEFAULT_TITLE_FONT_TYPE;
  else
 	 return $this->titleFontType;
 }
 
 function setTitleFontSize(int $actTitleFontSize):void
 {
 	$this->titleFontSize = $actTitleFontSize;
 }
 
 function getTitleFontSize():int
 {
 	if($this->titleFontSize == NO_VALUE)
   return self::DEFAULT_TITLE_FONT_SIZE;
  else
 	 return $this->titleFontSize;
 }
 
 function setTitleFontColor(string $actTitleFontColor):void
 {
 	$this->titleFontColor =$actTitleFontColor;
 }
  
 function getTitleFontColor():string
 {
 	if($this->titleFontColor==STRING_NULL)
 	 return self::DEFAULT_TITLE_FONT_COLOR;
 	else
 	 return $this->titleFontColor;
 }
 

 function setTitleXAxisFontFamily(string $actTitleXAxisFontFamily):void
 {
 	$this->titleXAxisFontFamily = $actTitleXAxisFontFamily;
 }
 
 function getTitleXAxisFontFamily():string
 {
 	if($this->titleXAxisFontFamily == STRING_NULL)
 	 return self::DEFAULT_XAXIS_FONT_FAMILY;
 	else
 	 return $this->titleXAxisFontFamily;
 }
 
 function setTitleXAxisFontType(string $actTitleXAxisFontType):void
 {
 	$this->titleXAxisFontType = $actTitleXAxisFontType;
 }
 
 function getTitleXAxisFontType():string
 {
  if($this->titleXAxisFontType == STRING_NULL)
   return self::DEFAULT_XAXIS_FONT_TYPE;
  else
 	 return $this->titleXAxisFontType;
 }
 
 function setTitleXAxisFontSize(int $actTitleXAxisFontSize):void
 {
 	$this->titleXAxisFontSize = $actTitleXAxisFontSize;
 }
 
 function getTitleXAxisFontSize():int
 {
  if($this->titleXAxisFontSize == NO_VALUE)
   return self::DEFAULT_XAXIS_FONT_SIZE;
  else
 	return $this->titleXAxisFontSize;
 }
 
 function setTitleXAxisFontColor(string $actTitleXAxisFontColor):void
 {
 	$this->titleXAxisFontColor = $actTitleXAxisFontColor;
 }
 
 function getTitleXAxisFontColor():string
 {
  if($this->titleXAxisFontColor == STRING_NULL)
   return self::DEFAULT_XAXIS_FONT_COLOR;
  else
 	return $this->titleXAxisFontColor;
 }
 
 function setTitleYAxisFontFamily(string $actTitleYAxisFontFamily):void
 {
 	$this->titleYAxisFontFamily = $actTitleYAxisFontFamily;
 }
 
 function getTitleYAxisFontFamily():string
 {
 	if($this->titleYAxisFontFamily == STRING_NULL)
 	 return self::DEFAULT_YAXIS_FONT_FAMILY;
 	else
 	 return $this->titleYAxisFontFamily;
 }
 
 function setTitleYAxisFontType(string $actTitleYAxisFontType):void
 {
 	$this->titleYAxisFontType = $actTitleYAxisFontType;
 }
 
 function getTitleYAxisFontType():string
 {
  if($this->titleYAxisFontType == STRING_NULL)
   return self::DEFAULT_YAXIS_FONT_TYPE;
  else
 	 return $this->titleYAxisFontType;
 }
 
 function setTitleYAxisFontSize(int $actTitleYAxisFontSize):void
 {
 	$this->titleYAxisFontSize = $actTitleYAxisFontSize;
 }
 
 function getTitleYAxisFontSize():int
 {
  if($this->titleYAxisFontSize == NO_VALUE)
   return self::DEFAULT_YAXIS_FONT_SIZE;
  else
 	return $this->titleYAxisFontSize;
 }
 
  function setTitleYAxisFontColor(string $actTitleYAxisFontColor):void
 {
 	$this->titleYAxisFontColor = $actTitleYAxisFontColor;
 }
 
 function getTitleYAxisFontColor():string
 {
  if($this->titleYAxisFontColor == STRING_NULL)
   return self::DEFAULT_YAXIS_FONT_COLOR;
  else
 	return $this->titleYAxisFontColor;
 }
 
 function setTitleXAxisLabelAngle(int $actTitleXAxisLabelAngle):void
 {
 	$this->titleXAxisLabelAngle = $actTitleXAxisLabelAngle;
 }
 
 function getTitleXAxisLabelAngle():int
 {
 	if($this->titleXAxisLabelAngle==NO_VALUE)
 	 return self::DEFAULT_XAXIS_LABEL_ANGLE;
 	else
 	 return $this->titleXAxisLabelAngle;
 } 
 
 function supressZeroLabel():void
 {
  $graph = $this->getGraph();
  $graph->yscale->ticks->supressZeroLabel();
 }
 
 function activateZeroLabel():void
 {
  $graph = $this->getGraph();
  $graph->yscale->ticks->supressZeroLabel(false);
 }
  
 function getCssClass():string
 {
  if($this->cssClass == NO_VALUE)
   return self::DEFAULT_CLASS;
  else
   return $this->cssClass;
 }

 function isContainer():bool
 {
  return false;
 }
 
 function putGraph(array $actDataValues):void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $class = $this->getCssClass(); 
	$dataFields = $this->getDataFields();	
  $num = count($dataFields);
  if($num < 2)
   die(self::ERROR_1);
	$style = $this->getStyle();   
  $id = $this->getInterfaceId();  
  $width = $this->getWidth();
  $height = $this->getHeight();
  $fileName = $this->getFileName();
  
  $graph = $this->createGraph($width,$height,$fileName);
  $this->setGraph($graph);
  
	$htmlWriter->putDivOpenTag($id,$style,$class); 
	if(count($actDataValues)>=2)
	{ 	 	
	 $dataXField = $this->getDataXField();
	 if(($dataXField==STRING_NULL)||(! in_array($dataXField,$dataFields)))
	 {
	 	$dataXField = $dataFields[self::DATAX_POS];
	 }

	 $dataYField = $this->getDataYField();
	 if(($dataYField==STRING_NULL)||(! in_array($dataYField,$dataFields)))
	 {
	 	$dataYField = $dataFields[self::DATAY_POS];
	 }

	 $datax = $actDataValues[$dataXField];
   $datay = $actDataValues[$dataYField];
    
   $leftMargin = $this->getLeftMargin();
   $rightMargin = $this->getRightMargin();
   $topMargin = $this->getTopMargin();
   $bottomMargin = $this->getBottomMargin();
  
   $graph->img->setMargin($leftMargin,$rightMargin,$topMargin,$bottomMargin);   
   $scale = $this->getScale();
   $graph->setScale($scale);  
   $marginColor = $this->getMarginColor();   
   $graph->setMarginColor($marginColor);
   $shadow = $this->getShadow();  
   $graph->setShadow($shadow);  
   $titleLabel = $this->getTitleLabel();  
   $graph->title->set($titleLabel);  
   $titleFontFamily = $this->getTitleFontFamily();
   $titleFontType = $this->getTitleFontType();
   $titleFontSize = $this->getTitleFontSize();  
   $graph->title->setFont($titleFontFamily,$titleFontType,$titleFontSize);  
   $titleFontColor = $this->getTitleFontColor();  
   $graph->title->setColor($titleFontColor);  
   $titleXAxisFontFamily = $this->getTitleXAxisFontFamily();
   $titleXAxisFontType = $this->getTitleXAxisFontType();
   $titleXAxisFontSize = $this->getTitleXAxisFontSize();  
   $titleXAxisFontColor = $this->getTitleXAxisFontColor();  
   $titleYAxisFontFamily = $this->getTitleYAxisFontFamily();
   $titleYAxisFontType = $this->getTitleYAxisFontType();
   $titleYAxisFontSize = $this->getTitleYAxisFontSize();   
   $titleYAxisFontColor = $this->getTitleYAxisFontColor();
   
   $graph->xaxis->setFont($titleXAxisFontFamily,$titleXAxisFontType,$titleXAxisFontSize);
   $graph->xaxis->setColor($titleXAxisFontColor);  
   $graph->yaxis->setFont($titleYAxisFontFamily,$titleYAxisFontType,$titleYAxisFontSize);
   $graph->yaxis->setColor($titleYAxisFontColor);
    
   $this->supressZeroLabel();
  
   $graph->xaxis->setTickLabels($datax);  
   $titleXAxisLabelAngle = $this->getTitleXAxisLabelAngle();
   $graph->xaxis->setLabelAngle($titleXAxisLabelAngle);  
   $bplot = $this->getBplot($datay);  
   $graph->add($bplot);
   $graph->stroke();

   $imageDir = $this->getImageDir();
   if($imageDir ==STRING_NULL)
    $imageDir = self::JPGRAPH_IMG_DIR;

   $htmlWriter->putImgTag(STRING_NULL,STRING_NULL,$class,STRING_NULL,
   $imageDir . DIR_SEP . $fileName);
  }
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	  
 }
 
 function putData():void
 {
  $rows = $this->getDataSource();
  $dataValues = array(); 
  $dataValues = $this->extractDataFromDataSource($rows);	 
  $this->putGraph($dataValues);
 }
}

?>