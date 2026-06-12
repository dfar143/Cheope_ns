<?
namespace Cheope_ns\fw;

require_once("generic.fun.php");
require_once("Data_interface.class.php");
require_once( PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME . 
DIR_SEP . FPDF_DIR .  DIR_SEP . "Fpdf.class.php");

class Cheope_ns_fpdf_field_h extends Data_interface
{
 // dimensioni in millimetri;
 const DEFAULT_XCOORD = 0;
 const DEFAULT_YCOORD = 0;
 // dimensioni in millimetri; 
 const DEFAULT_HEIGHT = 10;
 const DEFAULT_FONT = "Helvetica";
 // dimensione del font in punti;
 const DEFAULT_FONTSIZE = 10;
 // style del font 'B','I' o 'U';
 const DEFAULT_FONTSTYLE = "B";
 // dimensione in millimetri di un punto;
 const POINT_DIM = 0.3528;
 
 // Oggetto Fpdf
 private $fpdf=null;
 private $xCoord=self::DEFAULT_XCOORD;
 private $yCoord=self::DEFAULT_YCOORD;
 private $height=self::DEFAULT_HEIGHT;
 private $font=self::DEFAULT_FONT;
 private $fontStyle=self::DEFAULT_FONTSTYLE;
 private $fontSize=self::DEFAULT_FONTSIZE;
 private $labelName=STRING_NULL;
 static $useJQuery=false;
 static $useDojo=false;
 static $hasJavascriptEnabledSwitch=false;
 static $hasJavascriptManagement=false;
 static $hasCssManagement=false;
 static private $fpdfFieldHTotNum=0;
  
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$fpdfFieldHTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$fpdfFieldHTotNum - 1; 
  parent::__construct($actObj,$actOp,self::INT_FPDF_FIELD_H,$actNum);
 }
 
 function setFpdf(\Cheope_ns\fpdf\FPDF $actFpdf):void
 {
 	$this->fpdf = $actFpdf;
 }

 function getFpdf():\Cheope_ns\fpdf\FPDF
 {
 	return $this->fpdf;
 }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$fpdfFieldHTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$fpdfFieldHTotNum = $actIntNum + 0;
 } 
 
 function isStandard():bool
 {
 	return false;
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
 	$font = $this->getFont();
 	$item4 = array("font"=>$font);
 	$serializer->loadItems($item4); 	 	
 	$fontStyle = $this->getFontStyle();
 	$item5 = array("fontStyle"=>$fontStyle);
 	$serializer->loadItems($item5);  	
 	$fontSize = $this->getFontSize();
 	$item6 = array("fontSize"=>$fontSize);
 	$serializer->loadItems($item6);
 	$labelName = $this->getLabelName();
 	$item7 = array("labelName"=>$labelName);
 	$serializer->loadItems($item7);	
 }
 
 function setFont(string $actFont):void
 {
 	$this->font = $actFont;
 }
 
 function getFont():string
 {
 	if($this->font == STRING_NULL)
 	 return self::DEFAULT_FONT;
 	else
 	 return $this->font;
 }
 
 function setFontStyle(string $actFontStyle):void
 {
 	$this->fontStyle = $actFontStyle;
 }
 
 function getFontStyle():string
 {
 	if($this->fontStyle == STRING_NULL)
 	 return self::DEFAULT_FONTSTYLE;
 	else
 	 return $this->fontStyle;
 }

 function setFontSize(int $actFontSize):void
 {
 	$this->fontSize = $actFontSize;
 }
 
 function getFontSize():int
 {
 	if($this->fontSize == NO_VALUE)
 	 return self::DEFAULT_FONTSIZE;
 	else
 	 return $this->fontSize;
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
 
 function setHeight(int $actHeight):void
 {
 	$this->height = $actHeight;
 }
 
 function getHeight():int
 {
 	if($this->height == NO_VALUE)
 	 return self::DEFAULT_HEIGHT;
 	else
 	 return $this->height;
 }
 
 function setLabelName(string $actLabelName):void
 {
 	$this->labelName = $actLabelName;
 }
 
 function getLabelName():string
 {
 	if($this->labelName == STRING_NULL)
 	 return STRING_NULL;
 	else
 	 return $this->labelName;
 }
 
 function putFpdf(string $actName,string|int $actValue,string $actDomain):void
 {
	$pdf = $this->getFpdf();
	if(! is_null($pdf))
	{
	$font = $this->getFont();
	$fontSize = $this->getFontSize();
	$fontStyle = $this->getFontStyle();
	$pdf->SetFont($font,$fontStyle);
	$pdf->SetFontSize($fontSize);	
	$xCoord = $this->getXCoord();
	$yCoord = $this->getYCoord();
	$height = $this->getHeight();
	$labelName = $this->getLabelName();
	if($labelName !== STRING_NULL)
	  $label = $labelName;
	else
	  $label = $actName;
	$nameSize = strLen($actName) * self::POINT_DIM * $fontSize;
	$valueSize = strLen($label) * self::POINT_DIM * $fontSize; 
	$singleCharSize = self::POINT_DIM * $fontSize;	
		
	if(($actDomain !== Int_domain::FIELD_DOMAIN_OBJ)&&($actDomain !== Int_domain::FIELD_DOMAIN_SET)&&
	($actDomain !== Int_domain::FIELD_DOMAIN_STRING_PHP_CODE)&&($actDomain !== Int_domain::FIELD_DOMAIN_FUNCTION))
  { 
   $pdf->SetX($xCoord);
   $pdf->SetY($yCoord,false);
	 $pdf->Write($height,$label);
	 $xCoord += $nameSize;
	 $pdf->SetX($xCoord);
	 if($label !== STRING_NULL)
	  $pdf->Write($height,STRING_COLON);
	 $xCoord += $singleCharSize;
	 $pdf->SetX($xCoord); 
	 $pdf->Write($height,$actValue);
  }
  }
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function initPutData():array
 {
 }
 
 function putData():void
 { 
  $rows = $this->getDataSource();
  $dataFields = $this->getDataFields();	
  if(count($dataFields)>0) 
  {
	$fieldName = $dataFields[0];
	$domain = $this->getDataFieldDomainByName($fieldName);
//
// Mi aspetto un valore atomico;
//		
  $fieldValue = $this->initDataSourceSingleValue($rows,$fieldName); 	
  $fieldValue = $this->getDataFieldAllValues($fieldName,$fieldValue);    
  $this->putFpdf($fieldName,$fieldValue,$domain);
  }
 }
 
}


?>