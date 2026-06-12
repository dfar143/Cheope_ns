<?
namespace Std\fw;

require_once("Data_interface.class.php");
require_once("generic.fun.php");
require_once( PREVIOUS_DIR . DIR_SEP . APPLICATION_NAME . 
DIR_SEP . FPDF_DIR .  DIR_SEP . "Fpdf.class.php");


class Std_fpdf_template extends Data_interface
{	
 
 const ERROR_1 = "Cheope_ns_fpdf_template:Errore incongruenza fra il valore del campo ed il dominio.";
 const ERROR_2 = "Cheope_ns_fpdf_template:Campo non trovato in deleteField.";
 const ERROR_3 = "Cheope_ns_fpdf_template:Indice di riga della griglia fuori limite.";

 const DEFAULT_GRID_DIM_X = 3;
 const DEFAULT_GRID_DIM_Y = 3;
 const DEFAULT_FILENAME = "doc.pdf";
 // Dimensioni in millimetri;
 const A4_PAGE_WIDTH = 210;
 const A4_PAGE_HEIGHT = 297;
	
 // Oggetto Fpdf
 private $fpdf = null;
 // Dim X della matrice griglia; 
 private $gridDimX = self::DEFAULT_GRID_DIM_X;
 // Dim Y della matrice griglia; 
 private $gridDimY = self::DEFAULT_GRID_DIM_Y;	
 static private $fpdfTemplateTotNum = 0;
 private $fileName = self::DEFAULT_FILENAME;
 static $useJQuery = false;
 static $useDojo = false;
 static $hasJavascriptEnabledSwitch = false;
 static $hasJavascriptManagement = false;
 static $hasCssManagement = false;
 	
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$fpdfTemplateTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$fpdfTemplateTotNum - 1;
  parent::__construct($actObj,$actOp,self::INT_FPDF_TEMPLATE,$actNum);
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
	
 static function createFpdf():\Cheope_ns\fpdf\Fpdf
  {
 	  return new \Cheope_ns\fpdf\Fpdf();
  }							  
  function isDecorator():bool
  {
  	return false;
  }
  
  function isContainer():bool
  {
  	return false;
  }
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$fpdfTemplateTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$fpdfTemplateTotNum=$actIntNum + 0;
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
 	$fileName = $this->getFileName(); 
 	$item3 = array("fileName"=>$fileName);
 	$serializer->loadItems($item3);	
 }
 
 function setFpdf(\Std\fpdf\FPDF $actFpdf):void
 {
 	$this->fpdf = $actFpdf;
 }

 function getFpdf():\Std\fpdf\FPDF
 {
 	return $this->fpdf;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName; 
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
   
 function deleteField(string $actFieldName):bool
 {
 	$dataFields = $this->getDataFields();
  $pos = array_getPos($dataFields,$actFieldName);
  if($pos)
  {
   $intFormFieldsContainer = $this->getIntFieldsContainer();
   $intFormFieldsContainer->deleteItem($pos);
  }
  if(! $pos)
   die(self::ERROR_2);
 }
 
 function initPutData():array
 {
 }					   
   
 function putFpdf($actFieldValue,
 string $actDomain,int $actXCoord,
 int $actYCoord):void
 {
  $pdf = $this->getFpdf();
   if(! is_null($pdf))
   {
 	$intType = (($actDomain==Int_domain::FIELD_DOMAIN_OBJ)?
 	$actFieldValue->getType():STRING_NULL);
	if(($intType !== STRING_NULL)&&
	(($intType == self::INT_FPDF_FIELD_H))||
	($intType == self::INT_FPDF_FIELD_V)||
	($intType == self::INT_FPDF_IMG)||
	($intType == self::INT_FPDF_TXT)||
	($intType == self::INT_FPDF_FIELD_TEMPLATE))
	{
	 $actFieldValue->setFpdf($pdf);
	 $yCoord = $actFieldValue->getYCoord();
	 $xCoord = $actFieldValue->getXCoord();
   $actFieldValue->setXCoord($xCoord + $actXCoord);
   $actFieldValue->setYCoord($actYCoord + $yCoord);
	 $actFieldValue->putData();	
	}
   }
 }
 
 function putData():void
 {
  $rows = $this->getDataSource();
  $fileName = $this->getFileName();
  //if(file_exists($fileName))
  //unlink($fileName);
  $pdf = $this->getFpdf();
  if(! is_null($pdf))
  {
  //
  // Suppone che il file non esista già.
  //
  $pdf->AddPage();
  
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
      
  $fields = $this->getDataFields();
  $num = count($fields);
      
  $gridDimX = $this->getGridDimX();
  $gridDimY = $this->getGridDimY();
  $j=0;
  $k=0;
  
  // Dimensioni cella della griglia;
  $width = round(self::A4_PAGE_WIDTH / $gridDimX);
  $height = round(self::A4_PAGE_HEIGHT / $gridDimY);
  
  for($i=0;$i<=$num-1;$i++)
  {
   $fieldName = $fields[$i];
   	  
	 $domain = $this->getDataFieldDomainByName($fieldName);

   if(isset($row[$fieldName]))
	  $fieldActValue = trim($row[$fieldName]);
	 else
	  $fieldActValue = FIELD_NO_VALUE;
	  
	 $fieldActValue = $this->getDataFieldAllValues($fieldName,$fieldActValue); 
   if($j > $gridDimX - 1)
   {
    $k++;
    if($k <= $gridDimY - 1)
    {
     $j=0;
 	   $this->putFpdf($fieldActValue,$domain,($width * $j),
 	   ($height * $k));
 	   $j++;
 	  }
   }
   else
   {
 	  if($j == $gridDimX - 1)
 	  {
 	   $this->putFpdf($fieldActValue,$domain,($width * $j),
 	   ($height * $k));
 	  }
 	  else
 	  {
 	   $this->putFpdf($fieldActValue,$domain,($width * $j),
 	  ($height * $k));
 	  }
 	  $j++;
   }
    
   if($k > $gridDimY - 1)
    die(self::ERROR_3);
  }
  $pdf->Output('F',$fileName);
  $pdf->close();
 }
 }
}


?>