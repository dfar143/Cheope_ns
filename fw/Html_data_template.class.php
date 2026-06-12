<?
namespace Cheope_ns\fw;
require_once("html.fun.php");
require_once("Html_data_interface.class.php");


class Html_data_template extends Html_data_interface
{ 
 const BODY_ID_SUFFIX="body";
 const DEFAULT_INHERIT_COUNT_FIELD_NAME="COUNT";
 const DEFAULT_CSS_CLASS="data_template";
 const ERROR_1="Html_data_template:Il nome di campo COUNT è riservato.";
 
 private $divEnvelope = false;
 private $htmlTemplate = STRING_NULL;
 static private $templatesTotNum=0;
 
 function __construct($actObj=OBJ_NONE,string $actOp=OP_NONE,$actNum=STRING_NULL)
 {
  self::$templatesTotNum++;
  if($actNum === STRING_NULL)
 	 $actNum = self::$templatesTotNum - 1; 
 	parent::__construct($actObj,$actOp,Interfaces_info::INT_HTML_DATA_TEMPLATE,$actNum);
 }
 
 function putJavascriptInitializationCode(string $actPar):void
 {
 } 
 
 static function getInterfacesTotNum():string|int
 {
 	return self::$templatesTotNum;
 }
 
 static function setInterfacesTotNum(int|string $actIntNum):void
 {
 	 self::$templatesTotNum=$actIntNum;
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
 	//$serializer = $this->getSerializer();
	//$booleanPropsArray=array("divEnvelope");
	//$textPropsArray = array("htmlTemplate");
	//$this->serialize_props_exec($booleanPropsArray,array(),$textPropsArray);
 	//parent::serialize();
 	$serializer = $this->getSerializer();
 	$divEnvelope = $this->getDivEnvelope();
 	$item1 = array("*divEnvelope"=>$divEnvelope);
 	$serializer->loadItems($item1);	
 	$htmlTemplate = $this->getHtmlTemplate();
 	$item2 = array("@htmlTemplate"=>$htmlTemplate);
 	$serializer->loadItems($item2);	
 }
 
 function getCssClass():string
 {
 if($this->cssClass == STRING_NULL)
  return self::DEFAULT_CSS_CLASS;
 else
  return $this->cssClass;
 }
 
 function setDivEnvelope(string $actDivEnvelope):void
 {
 	$this->divEnvelope = $actDivEnvelope;
 }
 
 function getDivEnvelope():string
 {
 	return $this->divEnvelope;
 }
 
 function loadTemplateFromFile(string $actFileName):void
 {
 	$fileRows = file($actFileName);
 	$htmlTemplate = STRING_NULL;
 	foreach($fileRows as $fileRow)
 	{
 	 $htmlTemplate = $htmlTemplate . $fileRow;
 	}
 	$this->setHtmlTemplate($htmlTemplate);
 }
 
 function setHtmlTemplate(string $actHtmlTemplate):void
 {
 	$this->htmlTemplate = $actHtmlTemplate;
 }
 
 function getHtmlTemplate():string
 {
 	return $this->htmlTemplate;
 }
 
  function isContainer():bool
	{
		return false;
	}
	
 function initPutData():array
 {
 }
 
 function action(string $actStr,Interfaces_container $actInterfacesContainer):void
 {
 	preg_match_all("/{([a-zA-Z_0-9]+)}|{@([a-zA-Z_0-9]+)}/i",$actStr,$matches);
 	$fields = array();
 	$fieldsDomains = array();
 	$fieldsDomainsValues = array();
 	foreach($matches as $ind=>$val)
 	{
 		if($ind==1)
 		{
 			$i=0;
 			foreach($val as $ind2 => $val2)
 			{
 			 if($val2 != STRING_NULL)
 			 {
 			  $fields[$i] = $val2;
 			  $fieldsDomains[$i] = Int_domain::FIELD_DOMAIN_ATOMIC;
 			  $fieldsDomainsValues[$i++] = Int_domain::FIELD_DOMAIN_VALUE_NONE ;
 			 }
 			}
 		}
 		elseif($ind==2)
 		{
 			$j=$i;
 			foreach($val as $ind3 => $val3)
 			{
 			 if($val3 != STRING_NULL)
 			 {
 			 	$obj = $actInterfacesContainer->getInterfaceByShortName($val3);
 			 	$actStr=preg_replace("/" . $val3 ."/",strToUpper($val3),$actStr);
 			 	if(! is_null($obj)) 
 			 	{
 			   $fields[$j] = $val3;
 			   $fieldsDomains[$j] = Int_domain::FIELD_DOMAIN_OBJ;
 			   $fieldsDomainsValues[$j++] = $obj;
 			  }
 			 }
 			}
 			$actStr=preg_replace("/" . STRING_AT . "/",STRING_NULL,$actStr); 			
 		}
  }
  $this->setDataFields($fields);
  $this->setDataFieldsDomains($fieldsDomains);
  $this->setDataFieldsDomainsValues($fieldsDomainsValues);
  $this->setHtmlTemplate($actStr);
 }
 
 function elabFields(array $actRow,int $actNum):string
 {
 	$htmlWriter = $this->getHtmlWriter();
	$this->fieldsFromDataSource();
 	$dataFields = $this->getDataFields();
 	$type = $this->getType();
 	$num = $this->getNum();
 	$htmlTemplate = $this->getHtmlTemplate();
 	$obj = $this->getObj();

  foreach($dataFields as $ind=>$field)
  {
   if($field==self::DEFAULT_INHERIT_COUNT_FIELD_NAME)
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
		 	 $actRow[self::DEFAULT_INHERIT_COUNT_FIELD_NAME] = $actNum;
			 $fieldValue->setDataSource($actRow);
 	   }
 	  }
 	  if ($this->getInheritDataFieldName())
		 $fieldValue->setNum($num . VAR_SEP . $actNum . VAR_SEP . $field);
//
// Se già richiamato Html_page->setAllHtmlWriters questo HtmlWriter è
// quello comune a tutte le interfacce della pagina.
// Altrimenti è diverso.
//
		$oldItemStack = $htmlWriter->getItemStack();
		$oldDumper = $oldItemStack->getDumper();
		$oldItemStack2 = clone $oldItemStack;
		$oldDumper2 = clone $oldDumper;
		$oldDumper2->setObj($oldItemStack2);
		$oldItemStack2->setDumper($oldDumper2);
//
// Imposta il dumper su memoria per il campo corrente.
// L'ItemStack del campo è impostato su memoria.
// Quello vecchio rimane inalterato.
//
    $fieldValue->setMemoryDumper();
    $newItemStack = $fieldValue->getItemStack();
    $htmlWriter->setItemStack($newItemStack);
    $fieldValue->putData();
 	  $htmlTemplate = preg_replace("/\{" . strToUpper($field) . "\}/",
 	  ((is_a($fieldValue,Classes_info::HTML_FORMATTED_INTERFACE_CLASS))?
 	  ($fieldValue->getHtmlWriter()->getItemStack()->flush()):
 	  ($fieldValue->getItemStack()->flush())),$htmlTemplate);  
    $htmlTemplate = preg_replace("/\{" . 
    self::DEFAULT_INHERIT_COUNT_FIELD_NAME . "\}/",$actNum,$htmlTemplate);
//    
// Reimposto il vecchio Item_stack.
// 
 	  $htmlWriter->setItemStack($oldItemStack2);
 	 }
   elseif($domain == Int_domain::FIELD_DOMAIN_FUNCTION)
   {
 	  $htmlTemplate = preg_replace("/\{" . strToUpper($field) . "\}/",$fieldValue($actNum,$field),$htmlTemplate); 	    
	 }
 	 else
 	 {
 	  $htmlTemplate = preg_replace("/\{" . strToUpper($field) . "\}/",$fieldValue,$htmlTemplate);
    $htmlTemplate = preg_replace("/\{" . 
    self::DEFAULT_INHERIT_COUNT_FIELD_NAME . "\}/",$actNum,$htmlTemplate);
   }
  }
  return $htmlTemplate;
 }
 
 function putData():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $rows = $this->getDataSource();
  $style = $this->getStyle();	
  $rows = $this->initDataSource($rows);
   
  $htmlTemplate = $this->getHtmlTemplate();
  $htmlTemplateInstance = STRING_NULL;
 	$cssClass = $this->getCssClass();
  $intCode = $this->getInterfaceId();
  
  $i=0;
  if(count($rows)>0)
  {
   foreach($rows as $rowVal)
   {
   	$htmlTemplate = $this->elabFields($rowVal,$i);
   	if($i==0)
   	 $htmlTemplateInstance = $htmlTemplate;
   	else
     $htmlTemplateInstance = $htmlTemplateInstance . STRING_ESC_RETURN . $htmlTemplate;
    $i++;   
   }
  }
  else
  {
   $htmlTemplateInstance = $this->elabFields($rows,$i);
  }
  $divEnvelope = $this->getDivEnvelope();
  if($divEnvelope)
   $htmlWriter->putDivOpenTag($intCode,$style,$cssClass);
 	$htmlWriter->putGenericHtmlString($htmlTemplateInstance);
 	if($divEnvelope)
 	$htmlWriter->putGenericHtmlString(DIV_CLOSE_TAG);
 }
     
}

?>