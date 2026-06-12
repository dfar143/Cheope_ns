<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_data_interface.class.php");


class Html_data_file_template extends Html_data_interface
{
 
	private $fileName=STRING_NULL;
  static private $dataFileTemplatesTotNum=0;
	
	function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
	{
   self::$dataFileTemplatesTotNum++;
   if($actNum === STRING_NULL)
 	 $actNum = self::$dataFileTemplatesTotNum - 1; 
	 parent::__construct($actObj,$actOp,Interfaces_info::INT_HTML_DATA_FILE_TEMPLATE,$actNum);
  }
  
 static function getInterfacesTotNum():string|int
 {
 	return self::$dataFileTemplatesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$dataFileTemplatesTotNum=$actIntNum + 0;
 }
 
  function enableBootstrap():void
 {
 }
  
 function isStandard():bool
 {
 	return true;
 }
  
 function serialize():void
 {
	parent::serialize();
 	$serializer = $this->getSerializer();
 	$fileName= $this->getFileName();
 	$item1 = array("fileName"=>$fileName);
 	$serializer->loadItems($item1);	
 }
  
  function setFileName(string $actFileName):void
  {
  	$this->fileName = $actFileName;
  }
  
  function getFileName():string
  {
  	return $this->fileName;
  }
 
  function isContainer():bool
	{
		return false;
	}
 
 function loadRefFiles(string $actRefFileName):string
 {
 	 $handle = fopen($actRefFileName,"r");
 	 $fileTemplate = fread($handle, filesize($actRefFileName));
 	 
 	 preg_match_all("/{#([A-Za-z]+[a-zA-Z_0-9]*)#}/",$fileTemplate,$out);
 	     
   foreach($out as $ind=>$val)
   {
   	if (isset($out[$ind][0]))
   	{
     if($ind==0)
     {
      $refStr = $out[$ind][0];
     }
     if($ind==1)
     {
      $refFileName = $out[$ind][0];
      $refItem = $this->loadRefFiles($refFileName);
      $fileTemplate = str_replace($refStr,$refItem,$fileTemplate);
     }
    }
   }   
   fclose($handle);
   return $fileTemplate;
 }
    
  function putData():void
  {
  	$fileName = $this->getFileName();
  	$dataFields = $this->getDataFields();
 	  $htmlWriter = $this->getHtmlWriter();
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
    
    $handle = fopen($fileName,"r");
 	  $fileTemplate = fread($handle, filesize($fileName));      
    preg_match_all("/{#([A-Za-z]+[A-Za-z_0-9]*)#}/",$fileTemplate,$out);
    //print_r($out);    	
    foreach($out as $ind=>$val)
    {
   	 if (isset($out[$ind][0]))
   	 {
		//die('mmmmm');
    	if($ind==0)
    	{
    		$refStr = $out[$ind][0];
    	}
    	if($ind==1)
    	{
    	 $refFileName = $out[$ind][0];
    	 $refItem = $this->loadRefFiles($refFileName);
    	 $fileTemplate = str_replace($refStr,$refItem,$fileTemplate);
      }
     }
    }
    foreach($dataFields as $field)
    {
     if(isset($row[$field]))
   	  $fieldValue = $row[$field];
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
 	    if((is_a($fieldValue,Classes_info::HTML_DATA_INTERFACE_CLASS))
 	    ||(is_a($fieldValue,Classes_info::DATA_INTERFACE_CLASS)))
 	    {
 	     $fieldValueObj = $fieldValue->getObj();
		   if((! is_object($fieldValueObj)) && $this->getInheritData())
			  $fieldValue->setDataSource($row);
 	    }
 	    if ($this->getInheritDataFieldName())
		   $fieldValue->setNum($num . VAR_SEP . $actNum . VAR_SEP . $field);
		 $oldItemStack = $htmlWriter->getItemStack();
		 $oldDumper = $oldItemStack->getDumper();
		 $oldItemStack2 = clone $oldItemStack;
		 $oldDumper2 = clone $oldDumper;
		 $oldDumper2->setObj($oldItemStack2);
		 $oldItemStack2->setDumper($oldDumper2);
      $fieldValue->setMemoryDumper();
      $newItemStack = $fieldValue->getItemStack();
      $htmlWriter->setItemStack($newItemStack);
      $fieldValue->putData();
 	    $fileTemplate = preg_replace("/\{" . strToUpper($field) . "\}/",
 	    $fieldValue->getHtmlWriter()->getItemStack()->flush(),$fileTemplate); 	    
 	    $htmlWriter->setItemStack($oldItemStack2); 	   
 	   }
     elseif($domain == Int_domain::FIELD_DOMAIN_FUNCTION)
     {
      $htmlWriter->putGenericHtmlString($fieldValue(),0);
	   }
 	   else
 	   $fileTemplate = preg_replace("/\{" . strToUpper($field) . "\}/",
 	   $fieldValue,$fileTemplate);
    }
   // print_r($htmlWriter);
    $htmlWriter->putGenericHtmlString($fileTemplate);
    fclose($handle);    
  }
  
}




?>