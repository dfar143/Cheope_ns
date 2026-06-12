<?
namespace Cheope_ns\fw;

require_once("generic.fun.php");
require_once("Data_interface.class.php");
require_once( PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME . 
DIR_SEP . FPDF_DIR .  DIR_SEP . "Fpdf.class.php");


class Cheope_ns_fpdf_field_template extends Data_interface
{
 
 const ERROR_1 = "Cheope_ns_fpdf_field_template:Errore nel nome di un campo.";	
 // dimensioni in millimetri;
 const DEFAULT_XCOORD = 0;
 const DEFAULT_YCOORD = 0;
 // dimensioni in millimetri; 
 const DEFAULT_HEIGHT = 10;
 const DEFAULT_ALIGN = "L";
 const DEFAULT_WIDTH = 0;
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
 private $template=STRING_NULL;
 private $align = self::DEFAULT_ALIGN;
 private $width = self::DEFAULT_WIDTH;
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
  parent::__construct($actObj,$actOp,self::INT_FPDF_FIELD_TEMPLATE,$actNum);
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
 	$align = $this->getAlign();
 	$item4 = array("align"=>$align);
 	$serializer->loadItems($item3); 
 	$width = $this->getWidth();	
 	$item5 = array("width"=>$width);
 	$serializer->loadItems($item5);
 	$font = $this->getFont(); 	
 	$item6 = array("font"=>$font);
 	$serializer->loadItems($item6); 	 	
 	$fontStyle = $this->getFontStyle();
 	$item7 = array("fontStyle"=>$fontStyle);
 	$serializer->loadItems($item7);  	
 	$fontSize = $this->getFontSize();
 	$item8 = array("fontSize"=>$fontSize);
 	$serializer->loadItems($item8);
 	$template = $this->getTemplate();
 	$item9 = array("@template"=>$template);
 	$serializer->loadItems($item9); 	
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
 
 function getFontSize():string
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
 
 function setAlign(string $actAlign):void
 {
 	$this->align = $actAlign;
 }
 
 function getAlign():string
 {
 	if($this->align == NO_VALUE)
 	 return self::DEFAULT_ALIGN;
 	else
 	 return $this->align;
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
 
 function setTemplate(string $actTemplate):void
 {
 	$this->template = $actTemplate;
 }
 
 function getTemplate():string
 {
 	if($this->template == STRING_NULL)
 	 return STRING_NULL;
 	else
 	 return $this->template;
 }
 
 function putFpdf(string $actTemplate):void
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
	$align = $this->getAlign();
	$width = $this->getWidth();
  $pdf->SetY($yCoord,false);
	$pdf->SetX($xCoord);
	$pdf->MultiCell($width,$height,$actTemplate,0,$align);
	}
 }
 
 function isContainer():bool
 {
  return false;
 }
 
 function initPutData():array
 {
 }
 
 function elabFields(array $actRow,$actNum):string
 {
 	$dataFields = $this->getDataFields();
 	$type = $this->getType();
 	$num = $this->getNum();
 	$template = $this->getTemplate();
 	$obj = $this->getObj();

  foreach($dataFields as $field)
  {
   if($field=="COUNT")
    die(self::ERROR_1);
   if(isset($actRow[$field]))
   	$fieldValue = $actRow[$field];
   else
   	$fieldValue = NO_VALUE;

   $fieldValues = $this->getDataFieldAllValues($field,$fieldValue);
 	   
 	 if((is_array($fieldValues)) &&(isset($fieldValues[$field])))
 	  $fieldValue = $fieldValues[$field]; 
 	 elseif(is_array($fieldValues))
 	  $fieldValue = $fieldValues[0];
 	 else
 	  $fieldValue = $fieldValues;

 	 $domain = $this->getDataFieldDomainByName($field);
 	 if($domain == Int_domain::FIELD_DOMAIN_OBJ)
 	 {
 	  if(is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS) 
 	  || is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS))
 	  {
 	   $fieldValueObj = $fieldValue->getObj();
		 if((! is_object($fieldValueObj)) && $this->getInheritData())
		 {
		 	 $actRow["COUNT"] = $actNum;
			 $fieldValue->setDataSource($actRow);
 	   }
 	  }
 	  if ($this->getInheritDataFieldName())
		 $fieldValue->setNum($num . VAR_SEP . $actNum . VAR_SEP . $field);

    $fieldValue->putData();
 	  $template = preg_replace("/\{" . strToUpper($field) . 
 	  "\}/",
 	  ((is_a($fieldValue,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))?
 	  ($fieldValue->getHtmlWriter()->getItemStack()->flush()):
 	  ($fieldValue->getItemStack()->flush())),$template);  
    $template = preg_replace("/\{COUNT\}/",$actNum,$template);
 	 }
   elseif($domain == Int_domain::FIELD_DOMAIN_FUNCTION)
   {
 	  $template = preg_replace("/\{" . strToUpper($field) . "\}/",$fieldValue($actNum,$field),$template); 	    
	 }
 	 else
 	 {
 	  $template = preg_replace("/\{" . strToUpper($field) . "\}/",$fieldValue,$template);
    $template = preg_replace("/\{COUNT\}/",$actNum,$template);
   }
  }
  return $template;
 } 
 
 function putData():void
 { 
  $rows = $this->getDataSource();
  $rows = $this->initDataSource($rows);
//
// Mi aspetto un valore atomico;
//		
  $templateInstance = STRING_NULL;

  $i=0;
  if(count($rows)>0)
  {
   foreach($rows as $rowVal)
   {
   	$template = $this->elabFields($rowVal,$i);
   	if($i==0)
   	 $templateInstance = $template;
   	else
     $templateInstance = $templateInstance . STRING_ESC_RETURN . $template;
    $i++;   
   }
  }
  else
  {
   $templateInstance = $this->elabFields($rows,$i);
  }
   	    
  $this->putFpdf($templateInstance);
 }
 
}


?>