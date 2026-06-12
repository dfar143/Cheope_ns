<?
namespace Cheope_ns\fw;
require_once("html.const.php");

class Php_class_gen extends Generic_interface
{
 var $fileName=STRING_NULL;
 // Non ha metodi setter per essere allineato con il filename.
 var $fileHandle;
 var $requireOnces = array();
 var $defines = array();
 var $className = STRING_NULL;
 var $parentClass = STRING_NULL;
 var $publicProps = array();
 var $constructorArgs = array();
 var $constructorBody = STRING_NULL;
 var $methodsNames = array();
 // Array di array.
 var $methodsArgs = array();
 var $methodsBodies = array();

 function __construct(string $actClass,$actNum=STRING_NULL)
 {
 	parent::__construct(STRING_NULL,self::INT_PHP_CLASS_GEN,$actNum);
 	$this->setClassName($actClass);
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function setFileName(string $actFileName):void
 {
 	$this->fileName = $actFileName;
 }
 
 function getFileHandle():resource|false
 {
 	return $this->fileHandle;
 }
 
 function getRequireOnces():array
 {
 	return $this->requireOnces;
 }
 
 function setRequireOnces(array $actRequireOnces):void
 {
 	$this->requireOnces = $actRequireOnces;
 }
 
 function getDefines():array
 {
 	return $this->defines;
 }
 
 function setDefines(array $actDefines):void
 {
 	$this->defines = $actDefines;
 }
 
 function putEOL():string
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
 	{
 	 return STRING_RETURN . STRING_LINE_FEED;
  }
  else
   return SEP_COMPLETE_TAG;
 }
 
 function puts(string $actStr):void
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
 	{
 	 $fileHandle = $this->getFileHandle();
 	 fwrite($fileHandle,$actStr);
  }
  else
   echo $actStr;
 }
 
 function setClassName(string $actClassName):void
 {
 	$this->className = $actClassName;
 }
 
 function getClassName():string
 {
 	return $this->className;
 }
 
 function setParentClass(string $actParentClass):void
 {
 	$this->parentClass = $actParentClass;
 }
 
 function getParentClass():string
 {
 	if (isset($this->parentClass))
 	 return $this->parentClass;
 	else
 	 return PARENT_CLASS;
 }
 
 function getPublicProps():array
 {
 	return $this->publicProps;
 }
 
 function setPublicProps(array $actPublicProps):void
 {
 	$this->publicProps = $actPublicProps;
 }
 
 function getConstructorArgs():array
 {
 	return $this->getConstructorArgs;
 }
 
 function setConstructorArgs(array $actConstructorArgs):void
 {
 	$this->constructorArgs = $actConstructorArgs;
 }
 
 function getConstructorBody():string
 {
 	return $this->constructorBody;
 }
 
 function setConstructorBody(string $actConstructorBody):void
 {
 	$this->constructorBody = $actConstructorBody;
 }
 
 function getMethodsNames():array
 {
 	return $this->methodsNames;
 }
 
 function setMethodsNames(array $actMethodsNames):string
 {
 	$this->methodsNames = $actMethodsNames;
 }
 
 function getMethodsArgs():array
 {
 	return $this->methodsArgs;
 }
 
 function setMethodsArgs(array $actMethodsArgs):void
 {
 	$this->methodsArgs = $actMethodsArgs;
 }
 
 function getMethodsBodies():array
 {
 	return $this->methodsBodies;
 }
 
 function setMethodsBodies(array $actMethodsBodies):void
 {
 	$this->methodsBodies = $actMethodsBodies; 
 }
 
 function putRequireOnces():void
 {
 	$requireOnces = $this->getRequireOnces();
 	foreach($requireOnces as $requireOnce)
 	{
 		$this->puts("require_once(\"" . $requireOnce . "\");");
 	}
 }
 
 function putDefines():void
 {
 	$defines = $this->getDefines();
 	foreach($defines as $ind =>$define)
 	{
 		$this->puts("define('" . $ind . "',\"" . $define . "\");");
 	}
 }
 
 function putClassHeader():void
 {
 	$className = $this->getClassName();
 	$parentClass = $this->getParentClass();
 	
 	if($parentClass != STRING_NULL)
 	 $this->puts("class" . STRING_SPACE . STRING_SPACE . $className . 
 	 STRING_SPACE . "extends" . STRING_SPACE . $parentClass);
 	else
 	 $this->puts("class" . STRING_SPACE . STRING_SPACE . $className);
 	  	 
 }
 
 function putProps():void
 {
 	$publicProps = $this->getPublicProps();
 	foreach($publicProps as $publicPropInd=>$publicPropVal)
 	{
 	 if($publicPropVal == STRING_NULL)
 	  $this->puts("var" . STRING_SPACE . $publicPropInd . 
 	  STRING_SEMICOLON);
 	 else
 	  $this->puts("var" . STRING_SPACE . $publicPropInd . 
 	   STRING_EQUAL . $publicPropVal . STRING_SEMICOLON); 	  
 	 $this->puts($this->putEOL());
 	} 	
 }
 
 function putConstructor():void
 {
 	$constructorArgs = $this->getConstructorArgs();
 	$constructorHeader = "function" . STRING_SPACE . ucFirst($this->getClassName()) .
 	STRING_OPEN_PAR ;
 	$constructorBody = $this->getConstructorBody();
 	if(isset($constructorArgs[0]))
   $constructorHeader = $constructorHeader . $constructorArgs[0];
  $num = count($constructorArgs); 
  for($i=1;$i<=$num-1;$i++)
   $constructorHeader = $constructorHeader . STRING_COMMA . $constructorArgs[$i];
  $constructorHeader = $constructorHeader . STRING_CLOSE_PAR;
  $constructor = $this->putEOL() . $constructorHeader . $this->putEOL() . 
  STRING_OPEN_GRAFF_BRACKET . $this->putEOL() . $constructorBody . 
  $this->putEOL() . STRING_CLOSE_GRAFF_BRACKET;
  $this->puts($constructor);
 }
 
 function putMethod(string $actMethodName):void
 {
 	$methodsArgs = $this->getMethodsArgs();
 	$methodsBodies = $this->getMethodsBodies();
 
	$methodBody = $methodsBodies[$actMethodName];
	$methodArgs = $methodsArgs[$actMethodName];
  $methodHeader = "function" . STRING_SPACE . $actMethodName . STRING_OPEN_PAR ;
  if(isset($methodArgs[0]))
   $methodHeader = $methodHeader . $methodArgs[0];
  $num = count($methodArgs); 
  for($i=1;$i<=$num-1;$i++)
   $methodHeader = $methodHeader . STRING_COMMA . $methodArgs[$i];
  $methodHeader = $methodHeader . STRING_CLOSE_PAR;
    
  $method = $this->putEOL() . $methodHeader . $this->putEOL() . 
  STRING_OPEN_GRAFF_BRACKET . $this->putEOL() . $methodBody . 
  $this->putEOL() . STRING_CLOSE_GRAFF_BRACKET;
  $this->puts($method);  
 }
 
 function putBody():void
 {
 	$this->putProps();
 	$this->puts($this->putEOL());
 	$this->putConstructor();
 	$this->puts($this->putEOL());
 	$methodsNames = $this->getMethodsNames();
 	foreach($methodsNames as $methodName)
 	{
 	 $this->putMethod($methodName);
 	 $this->puts($this->putEOL());
 	}		
 }
 
 function isStandard():bool
 {
 	return true;
 }
 
 function isContainer():bool
 {
 	return false;
 }
 
 function isDecorator():bool
 {
 	return false;
 }
 
 function putData():void
 {
 	$fileName = $this->getFileName();
 	if($fileName != STRING_NULL)
  {
   $fileHandle = fopen($fileName,"a");
   $this->fileHandle = $fileHandle;
 	}
 	$this->putRequireOnces();
 	$this->puts($this->putEOL());
 	$this->puts($this->putEOL());
 	$this->putDefines();
 	$this->puts($this->putEOL());
 	$this->puts($this->putEOL());
 	$this->putClassHeader();
 	$this->puts($this->putEOL());
 	$this->puts(STRING_OPEN_GRAFF_BRACKET);
 	$this->puts($this->putEOL());
 	$this->putBody();
 	$this->puts($this->putEOL());
 	$this->puts(STRING_CLOSE_GRAFF_BRACKET);
 	$this->puts($this->putEOL());
 	if($fileName != STRING_NULL)
 	 fclose($fileHandle);
 }

}



?>