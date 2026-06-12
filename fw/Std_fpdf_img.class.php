<?
namespace Std\fw;

require_once("generic.fun.php");
require_once(PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME . 
DIR_SEP . FPDF_DIR .  DIR_SEP . "Fpdf.class.php");


class Std_fpdf_img extends Generic_interface
{
 
 // dimensioni in millimetri;
 const DEFAULT_XCOORD = 0;
 const DEFAULT_YCOORD = 0;
 // dimensioni in millimetri; 
 const DEFAULT_HEIGHT = 10;
 // dimensione in millimetri
 const DEFAULT_WIDTH = 10;
 const DEFAULT_FILETYPE = 'GIF';
 
 private $fpdf=null;
 private $xCoord=self::DEFAULT_XCOORD;
 private $yCoord=self::DEFAULT_YCOORD;
 private $height=self::DEFAULT_HEIGHT;
 private $width=self::DEFAULT_WIDTH;
 private $fileName=STRING_NULL;
 private $fileType = self::DEFAULT_FILETYPE;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = false;
 static $hasCssManagement=false;
 
 static private $fpdfImgTotNum=0;
  
 function __construct(string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$fpdfImgTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$fpdfImgTotNum - 1; 
  parent::__construct($actOp,self::INT_FPDF_IMG,$actNum);
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
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$fpdfImgTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$fpdfImgNum = $actIntNum + 0;
 } 
 
 function isStandard():bool
 {
 	return false;
 }
 
 function isDecorator():bool
 {
 	return false;
 }
 
 function action(string $actStr,Interfaces_container $actIntContainer):void
 {
 }
 
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$xCoord = $this->getXCoord();
 	$item1 = array("xCoord"=>$xCoord);
 	$serializer->loadItems($item1);
 	$yCoord = $this->getYCoord();
 	$item2 = array("yCoord"=>$yCoord);
 	$serializer->loadItems($item2); 	
 	$height = $this->getHeight();
 	$item3 = array("height"=>$height);
 	$serializer->loadItems($item3);
 	$fileName = $this->getFileName();
 	$item4 = array("fileName"=>$fileName);
 	$serializer->loadItems($item4); 	 	
 	$fileType = $this->getFiletype();
 	$item5 = array("fileType"=>$fileType);
 	$serializer->loadItems($item5);  	
 	$width = $this->getWidth();
 	$item6 = array("width"=>$width);
 	$serializer->loadItems($item6);	
 }
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function setFileType(string $actFileType):void
 {
 	$this->fileType = $actFileType;
 }
 
 function getFileType():string
 {
 	return $this->fileType;
 }  
 
 function getXCoord():int
 {
 	if($this->xCoord == NO_VALUE)
 	 return self::DEFAULT_XCOORD;
 	else
 	 return $this->xCoord;
 }
 
 function setXCoord(int $actXCoord):void
 {
 	$this->xCoord = $actXCoord;
 }
 
 function getYCoord():int
 {
 	if($this->yCoord == NO_VALUE)
 	 return self::DEFAULT_YCOORD;
 	else
 	 return $this->yCoord;
 }
 
 function setYCoord(int $actYCoord):void
 {
 	$this->yCoord = $actYCoord;
 } 
 
 function setHeight(int|string $actHeight):void
 {
 	$this->height = $actHeight;
 }
 
 function getHeight():int|string
 {
 	if($this->height == NO_VALUE)
 	 return self::DEFAULT_HEIGHT;
 	else
 	 return $this->height;
 }
 
 function setWidth(int|string $actWidth):void
 {
 	$this->width = $actWidth;
 }
 
 function getWidth():int|string
 {
 	if($this->width == NO_VALUE)
 	 return self::DEFAULT_WIDTH;
 	else
 	 return $this->width;
 }
 
 function putFpdf():void
 {
	$pdf = $this->getFpdf();
	if(! is_null($pdf))
	{
	$fileName = $this->getFileName();
	$fileType = $this->getFileType();
	$xCoord = $this->getXCoord();
	$yCoord = $this->getYCoord();
	$width = $this->getWidth();
	$height = $this->getHeight();	
	$pdf->Image($fileName,$xCoord,$yCoord,$width,$height,$fileType);
	}	
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function setFpdf(\Std\fpdf\FPDF $actFpdf):void
 {
 	$this->fpdf = $actFpdf;
 }
 
 function getFpdf():\Std\fpdf\FPDF
 {
 	return $this->fpdf;
 }
 
 function initPutData():array
 {
 } 
 function putData():void
 {  	     
  $this->putFpdf();
 }
 
}

?>