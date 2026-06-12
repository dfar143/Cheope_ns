<?
namespace Std\fw;
require_once("Html_formatted_interface.class.php");
require_once("std.fun.php");


class Std_div_frame extends Html_formatted_interface
{
 
// const ERROR_1="Std_div_frame:Errore nell'inserimento dell'interface container.";
 const DEFAULT_CSS_CLASS="div_frame";
 const DEFAULT_HEIGHT="100%";
 const DEFAULT_WIDTH="100%";
 const DEFAULT_ROWS=1;
 const DEFAULT_COLS=1;
 const CELL_CSS_CLASS="div_frame_cell";
 const COLUMN_CSS_CLASS="div_frame_column";
 const DEFAULT_CSS_MODULE=CSS_DIV_FRAME;
 	 
 private $rowsNum=self::DEFAULT_ROWS;
 private $colsNum=self::DEFAULT_COLS;
 private $frameWidth = self::DEFAULT_WIDTH;
 private $frameHeight = self::DEFAULT_HEIGHT;
 private $frameCellsWidths = array();
 static private $divFramesTotNum=0;
 static $hasCssManagement=true;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
 	self::$divFramesTotNum++;
 	if($actNum === STRING_NULL)
 	 $actNum = self::$divFramesTotNum - 1;

  parent::__construct($actOp,self::INT_DIV_FRAME,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$divFramesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$divFramesTotNum=$actIntNum + 0;
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
 	$rowsNum = $this->getRowsNum();
 	$item1 = array("rowsNum"=>$rowsNum);
 	$serializer->loadItems($item1);
 	$colsNum = $this->getColsNum();
 	$item2 = array("colsNum"=>$colsNum);
 	$serializer->loadItems($item2);
 	$frameWidth = $this->getFrameWidth();
 	$item3 = array("frameWidth"=>$frameWidth);
 	$serializer->loadItems($item3);
 	$frameHeight = $this->getFrameHeight();
 	$item4 = array("frameHeight"=>$frameHeight);
 	$serializer->loadItems($item4);
 	$frameCellsWidths = $this->getFrameCellsWidths();
 	$item5 = array("\$frameCellsWidths"=>$frameCellsWidths);
 	$serializer->loadItems($item5);	
 	$interfacesContainer = $this->getInterfacesContainer();
 	$item6 = array("interfacesContainer"=>$interfacesContainer);
 	$serializer->loadItems($item6);		
 }
 
 function setRowsNum(int $actRowsNum):void
 {
  $this->rowsNum = $actRowsNum; 
 }
 
 function getRowsNum():int
 {
 if($this->rowsNum == NO_VALUE)
  return self::DEFAULT_ROWS;
 else
  return $this->rowsNum;
 }
 
 function setColsNum(int $actColsNum):void
 {
  $this->colsNum = $actColsNum;
 }
 
 function getColsNum():int
 {
 if($this->colsNum == NO_VALUE)
  return self::DEFAULT_COLS;
 else
  return $this->colsNum;
 }
 
 function getCssClass():string
{
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
}
 
 function setFrameWidth(string|int $actFrameWidth):void
 {
  $this->frameWidth = $actFrameWidth;
 }
 
 function getFrameWidth():string|int
 {
 if($this->frameWidth == STRING_NULL)
  return self::DEFAULT_WIDTH;
 else
  return $this->frameWidth;
 }
 
 function setFrameHeight(string|int $actFrameHeight)
 {
  $this->frameHeight = $actFrameHeight;
 }
 
 function getFrameHeight():string|int
 {
  if($this->frameHeight== STRING_NULL)
   return self::DEFAULT_HEIGHT;
  else
   return $this->frameHeight;
 }
 
 function setFrameCellsWidths(array $actFrameCellsWidths):void
 {
  $this->frameCellsWidths = $actFrameCellsWidths;
 }
 
 function getFrameCellsWidths():array
 {
  return $this->frameCellsWidths;
 }
 
 function isContainer():bool
 {
  return true;
 }
 
 function isDecorator():bool
 {
  return false;
 }
 
// Le interfacce vengono disposte prima sulle colonne. 
 function putContainer():void
 {
 	$htmlWriter = $this->getHtmlWriter(); 
 	$cssClass = $this->getCssClass();	
  $interfacesContainer = $this->getInterfacesContainer();
	$frameCellsWidths = $this->getFrameCellsWidths();
	$intCode = $this->getInterfaceId();
	if (! empty($interfacesContainer))
	{   
   $iterator = $interfacesContainer->create();
	 $rowsNum = $this->getRowsNum();
	 $colsNum = $this->getColsNum();
	 for($i=0;$i<=$colsNum-1;$i++)
	 {
	 	 if(isset($frameCellsWidths[$i])) 
	 	  $frameCellsWidth = $frameCellsWidths[$i];
	 	 else
	 	  $frameCellsWidth = (string)((int)(100 / $colsNum)) . STRING_PERCENT;
	 	  
	 	if(($i>0)||(($i==0)&&($colsNum>1)))
	   $colStyle = "float" . STRING_COLON . "left" . STRING_SEMICOLON . 
	   "width" . STRING_COLON . $frameCellsWidth . STRING_SEMICOLON; 
	  elseif(($i==0)&&($colsNum==1))
	   $colStyle="width" . STRING_COLON . $frameCellsWidth . STRING_SEMICOLON;
	  
	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . $i,$colStyle,self::COLUMN_CSS_CLASS);
	  for($j=0;$j<=$rowsNum-1;$j++)
	  {
	   $ctl = $iterator->current();
		 if((! is_null($ctl)) && ($iterator->hasMore()) && ($ctl !== false))
		 {
	 	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . $j 
		 	 . VAR_SEP . $i,STRING_NULL,self::CELL_CSS_CLASS);
	 	  $ctl->setHtmlWriter($htmlWriter);
	 	  $ctl->putData();
	 	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 	  $iterator->next();
	 	 }
	 	 elseif($iterator->hasMore())
	 	 {
	 	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . $j 
		 	 . VAR_SEP .$i,STRING_NULL,self::CELL_CSS_CLASS);
	 	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 	  $iterator->next();
	 	 }
	 	 else
	 	 {
	 	  $htmlWriter->putDivOpenTag($intCode . VAR_SEP . $j 
		 	 . VAR_SEP .$i,STRING_NULL,self::CELL_CSS_CLASS);
	 	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 	 }	
	  }
	  $htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	 }	
  }
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
 	$htmlWriter = $this->getHtmlWriter(); 	
	$cssClass = $this->getCssClass();
	$intCode = $this->getInterfaceId();
	$frameWidth = $this->getFrameWidth();
	$frameHeight = $this->getFrameHeight();
	$interfacesContainer = $this->getInterfacesContainer();
  $style = $this->getStyle();
	$style = $style . STRING_SEMICOLON .  "height" . STRING_COLON . 
	$frameHeight . STRING_SEMICOLON . 
	"width" . STRING_COLON . $frameWidth . STRING_SEMICOLON;
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
	$this->putContainer();
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);	
 }
}


?>