<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

class Obj_cache
{
 const ERROR_1 = "Obj_cache:Metodo chiamato non valido.";
 const ERROR_2 = "Obj_cache:Il metodo non esiste.";
 const ERROR_3 = "Obj_cache:La proprietà non esiste.";
 
 private $cachedObj=null;
 //
 // Array associativo contente come chiavi i nomi delle proprietà
 // e come valori i valori delle proprietà corrispondenti. 
 //
 private $cachedObjProps=array();
 private $cachedObjMethods=array();

 function __construct(object $actCachedObj,array $actCachedObjProps)
 {
 	$this->setCachedObjProps($actCachedObjProps);
  $this->setCachedObj($actCachedObj);
 }
 
 function getPropValByMethodName(string $actMethodName):mixed
 {
 	$objProps = $this->getCachedObjProps();
 	$propName = $this->getPropNameFromMethodName($actMethodName);
 	$propVal = $objProps[$propName];
 	return $propVal;
 }
 
 function setPropValByMethodName(string $actMethodName,mixed $actData=STRING_NULL):void
 {
 	$objProps = $this->getCachedObjProps();
 	$propName = $this->getPropNameFromMethodName($actMethodName);
 	$objProps[$propName] = $actData; 
 	$this->setCachedObjProps($objProps);	 	
 }
 
 function getPropNameFromMethodName(string $actMethodName):string
 {
 	$objMethods = $this->getCachedObjMethods();
 	$objProps = $this->getCachedObjProps();
 	if (in_array($actMethodName,$objMethods))
 	{
 	 $propName = substr($actMethodName,3,strlen($actMethodName));
 	 $propName = strToLower(substr($propName,0,1)) . substr($propName,1,strlen($propName));
 	 if(array_key_exists($propName,$objProps))
 	  return $propName;
   else
    die(self::ERROR_3);
  }
 	else
 	 die(self::ERROR_2); 
 }
 
 function isAValidSetOrGetMethod(string $actMethodName):bool
 {
 	$objMethods = $this->getCachedObjMethods();
 	$objProps = $this->getCachedObjProps();
 	if (in_array($actMethodName,$objMethods))
 	{
 	 $propName = substr($actMethodName,3,strlen($actMethodName));
 	 $propName = strToLower(substr($propName,0,1)) . substr($propName,1,strlen($propName));
 	 if(array_key_exists($propName,$objProps))
 	  if((strpos($actMethodName,"get")===0)||(strpos($actMethodName,"set")===0))
 	   return true;
 	  else
 	   return false;
 	 else
 	  die(self::ERROR_3);
 	}
 	else
 	 die(self::ERROR_2); 
 }
 
 function isAGetMethod(string $actMethodName):bool
 {
 	$objMethods = $this->getCachedObjMethods();
 	$objProps = $this->getCachedObjProps();
 	if (in_array($actMethodName,$objMethods))
 	{
 	 $propName = substr($actMethodName,3,strlen($actMethodName));
 	 $propName = strToLower(substr($propName,0,1)) . 
 	 substr($propName,1,strlen($propName));
 	 if(array_key_exists($propName,$objProps))
 	  if(strpos($actMethodName,"get")===0)
 	   return true;
 	  else
 	   return false;
 	 else
 	  die(self::ERROR_3);
  }
 	else
 	 die(self::ERROR_2); 
 }
 
 function isASetMethod(string $actMethodName):bool
 {
 	$objMethods = $this->getCachedObjMethods();
 	$objProps = $this->getCachedObjProps();
 	if (in_array($actMethodName,$objMethods))
 	{
 	 $propName = substr($actMethodName,3,strlen($actMethodName));
 	 $propName = strToLower(substr($propName,0,1)) . substr($propName,1,strlen($propName));
 	 if(array_key_exists($propName,$objProps))
 	  if(strpos($actMethodName,"set")===0)
 	   return true;
 	  else
 	   return false;
 	 else
 	  die(self::ERROR_3);
  }
 	else
 	 die(self::ERROR_2); 
 }

 function setCachedObj(object $actCachedObj):void
 {
  $classMethods = get_class_methods(get_class($actCachedObj));
  $this->setCachedObjMethods($classMethods);
  $this->cachedObj = $actCachedObj;
 }
 
 function getCachedObj()
 {
 	return $this->cachedObj;
 }
 
 function setCachedObjMethods(array $actCachedObjMethods):void
 {
 	$this->cachedObjMethods = $actCachedObjMethods;
 }
 
 function getCachedObjMethods():array
 {
 	return $this->cachedObjMethods;
 }

 function setCachedObjProps(array $actCachedObjProps):void
 {
 	$this->cachedObjProps = $actCachedObjProps;
 }
 
 function getCachedObjProps():array
 {
 	return $this->cachedObjProps;
 }
 
 //
 // L'esecuzione del metodo get permette il guadagno di tempo
 // perchè viene reperito il valore dall'array delle proprietà,
 // invece di eseguire il metodo get nativo dell'oggetto cachato 
 // (che in generale può richiedere molto più tempo). 
 // L'esecuzione del metodo set invece implica l'impostazione del valore 
 // della proprietà nell'array delle propietà e
 // anche l'esecuzione del metodo set sull'oggetto cachato. 
 // 
 //
 function callMethod(string $actMethodName,$actData=STRING_NULL):mixed
 {
	$cachedObj = $this->getCachedObj();
	if($this->isAGetMethod($actMethodName))
	{
	 $propVal = $this->getPropValByMethodName($actMethodName);
	 return $propVal;
	}
	elseif($this->isASetMethod($actMethodName))
 	{
 	 $this->setPropValByMethodName($actMethodName,$actData);
 	 $retVal = call_user_func_array(array($cachedObj,$actMethodName),array($actData));
	 return $retVal;
 	}
 	else
 	  die(self::ERROR_1); 
 	$retVal = false;
 	return $retVal; 	 
 }
 
}


?>