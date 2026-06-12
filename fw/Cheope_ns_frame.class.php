<?
namespace Cheope_ns\fw;
require_once("Html_formatted_interface.class.php");
require_once("cheope_ns.fun.php");


class Cheope_ns_frame extends Html_formatted_interface
{ 
// const ERROR_1="Cheope_ns_frame:Errore nell'inserimento dell'interface container.";
 const DEFAULT_CSS_CLASS="frame";
 const DEFAULT_HEIGHT="100%";
 const DEFAULT_WIDTH="100%";
 const DEFAULT_COLS=1;
 const DEFAULT_ROWS=1;
 const CELL_HEIGHT=STRING_NULL;
 const CELL_WIDTH="100%";
 const CELL_CSS_CLASS="frame_cell";
 const CELL_CELLSPADDING="5";
 const CELL_CELLSPACING="5";
 const CELL_VALIGN="top";
 const DEFAULT_CSS_MODULE=CSS_FRAME;
  
 private $rowsNum=self::DEFAULT_ROWS;
 private $colsNum=self::DEFAULT_COLS;
 private $frameWidth=self::DEFAULT_WIDTH;
 private $frameHeight=self::DEFAULT_HEIGHT;
 static private $framesTotNum=0;
 static $hasCssManagement=true;
 
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$framesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$framesTotNum - 1; 
  parent::__construct($actOp,self::INT_FRAME,$actNum);
  $this->setCssModule(CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  self::DEFAULT_CSS_MODULE . STYLE_SHEET_FILE_POSTFIX); 
 }
 
	function hasCssManagement():bool
	{
		return self::$hasCssManagement;
	}
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$framesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$framesTotNum=$actIntNum + 0;
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
 	$colsNum = $this->getColsNum();
 	$frameWidth = $this->getFrameWidth();
 	$frameHeight = $this->getFrameHeight();
 	$intCont = $this->getInterfacesContainer();
 	$item1 = array("rowsNum"=>$rowsNum);
 	$serializer->loadItems($item1);
 	$item2 = array("colsNum"=>$colsNum);
 	$serializer->loadItems($item2);
 	$item3 = array("frameWidth"=>$frameWidth);
 	$serializer->loadItems($item3);
 	$item4 = array("frameHeight"=>$frameHeight);
 	$serializer->loadItems($item4);
 	$item5 = array("interfacesContainer"=>$intCont);
 	$serializer->loadItems($item5);
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
 
 function setFrameHeight(string|int $actFrameHeight):void
 {
  $this->frameHeight = $actFrameHeight;
 }
 
 function getFrameHeight():string|int
 {
 if($this->frameHeight == STRING_NULL)
  return self::DEFAULT_HEIGHT;
 else
  return $this->frameHeight;
 }
 
 function isContainer():bool
 {
  return true;
 }
 
 function isDecorator():bool
 {
 	return false;
 }
 
 // Effettua il render dei controlli contenuti
 // nel contenitore mettendoli in una griglia NxM
 // con N=nrows e M=ncols;
 //
 function putContainer():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	
  $interfacesContainer = $this->getInterfacesContainer();
	$frameWidth = $this->getFrameWidth();
	$frameHeight = $this->getFrameHeight();
	$intCode = $this->getInterfaceId();
	if (! empty($interfacesContainer))
	{
   $iterator = $interfacesContainer->create();
   $iterator->reset();
	 $i=0;
	 $j=0;
	 $rowsNum = $this->getRowsNum();
	 $colsNum = $this->getColsNum();
	 while($i <= $rowsNum - 1)
	 {
		$htmlWriter->putTableOpenTag($intCode . VAR_SEP . "inner_table" . VAR_SEP . $i,
		self::CELL_CSS_CLASS,self::CELL_WIDTH,self::CELL_HEIGHT,
		STRING_NULL,self::CELL_CELLSPACING,self::CELL_CELLSPADDING);
		$htmlWriter->putTableRowOpenTag($intCode . VAR_SEP . "inner_table_row" . VAR_SEP . $i,STRING_NULL,STRING_NULL);		
		while($j<=$colsNum-1)
		{
		 $actCtl = $iterator->current();
		 if((! is_null($actCtl)) && ($iterator->hasMore()) && ($actCtl !== false))
		 {
		 	 $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . $i 
		 	 . VAR_SEP . $j,STRING_NULL,STRING_NULL,
		   STRING_NULL,STRING_NULL,STRING_NULL,self::CELL_VALIGN);
		   $actCtl->setHtmlWriter($htmlWriter);
		   $ctlType = $actCtl->getType();
			 $actCtl->putData();
			 $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
		   $iterator->next();	
		 }
		 elseif($iterator->hasMore())
		 {
       $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . $i 
		 	 . VAR_SEP . $j,STRING_NULL,STRING_NULL,
		   STRING_NULL,STRING_NULL,STRING_NULL,self::CELL_VALIGN);
		   $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
		   $iterator->next();
		 }
		 else
		 {
       $htmlWriter->putTableColumnOpenTag($intCode . VAR_SEP . $i 
		 	 . VAR_SEP . $j,STRING_NULL,STRING_NULL,
		   STRING_NULL,STRING_NULL,STRING_NULL,self::CELL_VALIGN);
		   $htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
		 }	 
		 $j++;
		}
		$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
		$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
		$j=0;
		$i++;
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
  $style = $this->getStyle();
	$interfacesContainer = $this->getInterfacesContainer();
  $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
	$htmlWriter->putTableOpenTag(STRING_NULL,$cssClass,$frameWidth,$frameHeight,STRING_NULL,
	STRING_NULL,STRING_NULL);
	$htmlWriter->putTableRowOpenTag(STRING_NULL);
	$htmlWriter->putTableColumnOpenTag(STRING_NULL,STRING_NULL,STRING_NULL,
	STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL);
	$this->putContainer();
	$htmlWriter->putGenericHtmlString(TABLE_COLUMN_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_ROW_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(TABLE_CLOSE_TAG,0);
	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG,0);
	
 }
}


?>