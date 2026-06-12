<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Classes_info.class.php");
require_once("Stringable.int.php");

class GNode implements Stringable
{
 // Nome del nodo
 private $nodeName=STRING_NULL;
 // Valori del nodo:Array associativo;
 private $nodeValues=array();
 // Array dei figli (array di gNodes)
 private $nodeSons=array();

  
 function __construct(string $actNodeName=STRING_NULL)
 {
  $this->nodeName = $actNodeName;	 
 }
 
 function getSons():array
 {
  return $this->nodeSons;
 }
 
 function setSons(array $actNodeSons):void
 {
  $this->nodeSons = $actNodeSons;
 }
 
 function addSon(GNode $actNodeSon):void
 {
  $nodeSons = $this->getSons();
  $nodeSons[] = $actNodeSon;
  $this->setSons($nodeSons);
 }
 
 function getValues():array
 {
  return $this->nodeValues;
 }
 
 function setValues(array $actNodeValues):void
 {
   $this->nodeValues=$actNodeValues;
 }
 
 
 //I valori possono essere ritornati solo tramite il
 // nome del campo.
 // Ritorna una copia della'array dei valori.
 //
 function getValue(string $actField):mixed
 {
 	$values = $this->getValues();
 	$nodeValue = false;
 	if(isset($values[$actField]))
   $nodeValue = $values[$actField];
  return $nodeValue;
 }
 
 function setValue(string $actField,mixed $actValue)
 {
 	$values = $this->getValues();
 	if(isset($values[$actField]))
 	{
 	 $values[$actField]=$actValue;
 	 $this->setValues($values);
 	 return true;
 	}
 	else
 	 return false;
 }
 
 
 function getNodeName():string
 {
  return $this->nodeName;
 }
 
 function setNodeName(string $actNodeName):void
 {
  $this->nodeName = $actNodeName;
 }
 
 //
 //I figli possono essere ritornati o
 //per posizione nell'array che li contiene 
 //o tramite il nome 
 //del nodo.
 //
 function getSonByPos(int $actSonPos):?GNode
 {
  $nodeSons = $this->getSons();
  if($actSonPos <= count($nodeSons) - 1)
   return $nodeSons[$actSonPos];
	else
	{
	 $retVal = NULL;
	 return $retVal;
  }
 }
 
 function setSonByPos(int $actSonPos,?GNode $actSon):bool
 {
  $nodeSons = $this->getSons();
  if($actSonPos <= count($nodeSons) - 1)
  {
  	if(isset($nodeSons[$actSonPos]))
  	{
	   $nodeSons[$actSonPos] = $actSon;
	   $this->setSons($nodeSons);
	   return true;
	  }
	  else
	   return false;
	}
	else
	 return false;
 }
 
 //
 // Ritorna un array di riferimenti ai nodi figli
 // selezionati per nome.
 function getSonsByName(string $actSonName):array
 {
  $sons=array();
	$i=0;
	$nodeSons = $this->getSons();
	for($j=0;$j<=count($nodeSons)-1;$j++)
	{
	 if ($actSonName == $nodeSons[$j]->getNodeName())
	 {
	  $sons[$i++]=$nodeSons[$j];
	 }
	}
	return $sons;
 }
 
 function toString():string
 {
 	$nodeName = $this->getNodeName();
 	return $nodeName;
 }
 
}


?>