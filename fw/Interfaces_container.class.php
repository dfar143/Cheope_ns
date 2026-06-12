<?
namespace Cheope_ns\fw;
require_once("Generic_container.class.php");
require_once("Classes_info.class.php");

class Interfaces_container extends Generic_container
{
 const ERROR_1 = "Interfaces_container:Errore nell'inserimento dell'interfaccia nel contenitore";
 const ERROR_2 = "Interfaces_container:Errore nell'aggiunta dell'interfaccia nel contenitore";
 
 function __construct(string $actName=STRING_NULL)
 {
  parent::__construct($actName);
 }
 
 function setInterfaces(array $actInterfaces):void
 {
  parent::setContents($actInterfaces);
 }
 
 function &getInterfaces():array
 {
 	$contents = &parent::getContents();
  return $contents;
 }
 
	function setElement(mixed $actItem,string|int $actPos):bool
	{
	 if(is_a($actItem,Classes_info::GENERIC_INTERFACE_CLASS))
    return parent::setElement($actItem,$actPos);
   else
    die(self::ERROR_1);
	}
	
	function add():void
	{
	 foreach(func_get_args() as $arg)
	 if(is_a($arg,Classes_info::GENERIC_INTERFACE_CLASS)||(is_null($arg)))
	 {
    parent::add($arg);
	 }
	 else
	  die(self::ERROR_2);
	}
 
 function create():Generic_iterator
 {
 	return Creator::create(getClassNameForCreate(Classes_info::GENERIC_ITERATOR_CLASS),STRING_NULL,$this);
 }
 
 function getInterface(string $actObjName,string $actOp,string $actType,$actNum=STRING_NULL):?Generic_interface
 {
  $interfaces = &$this->getInterfaces();
  foreach($interfaces as $interface)
	{
	 $obj = $interface->getObj();
	 if(is_object($obj)&&(is_a($obj,Classes_info::DB_ITEM_CLASS)))
	 {
	  $objName = $obj->getAliasName();
	 }
	 elseif(is_object($obj)&&(is_a($obj,Classes_info::SERIALIZABLE_NODE_CLASS)))
	 {
	 	$objName = $obj->getName();
	 }
	 else
	 {
	  $objName = OBJ_NONE; 
	 } 
	 $op = $interface->getOp();
	 $type = $interface->getType();
	 $num = $interface->getNum();
	 if(($objName == $actObjName) && ($op == $actOp) && ($type == $actType) && ($num == $actNum))
	 {
		return $interface;
	 }
	}
	$retVal = null;
  return $retVal;
 }
 
 function getInterfaceByShortName(string $actShortName):?Generic_interface
 {
 	$interfaces = &$this->getInterfaces();
 	foreach($interfaces as $interface)
 	{
 		if($interface->getShortName() == $actShortName)
 		 return $interface;
 	}
 	$retVal=null;
 	return $retVal;
 }
 
 function deleteByStringInType(string $actStr):void
 {
 	$interfaces = &$this->getInterfaces();
 	$newInterfaces = array();
 	$i=0;
 	foreach($interfaces as $interface)
 	{
 		if(strpos($interface->getType(),$actStr)===false)
 		 $newInterfaces[$i++] = $interface;
 	} 
 	$this->setInterfaces($newInterfaces);	
 }
}
 

?>