<?
namespace Cheope_ns\fw;
 require_once("generic.const.php");
 require_once("db_rel.const.php");


class Db_rel
{
 private $name=STRING_NULL;
 //Array di stringhe; Nomi delle tabelle che partecipano alla relazione.
 private $entities=array();
 private $type=STRING_NULL;
 //
 //Array del tipo di partecipazione (1 o N) delle entità alla relazione.
 //Fa il match con le entità. 
 private $types=array(); 
 private $linkTable=STRING_NULL;
 
 function __construct(array $actEnts,string $actType)
 {
  $this->entities = $actEnts;
	$this->type = $actType;
 }
 
 function getName():string
 {
  return $name;
 }
 
 function setName(string $actName):void
 {
  $name = $actName;
 }
 
 function getType():string
 {
  return $this->type;
 }
 
 function setType(string $actType):void
 {
  $this->type = $actType;
 }
 
 function getEntities():array
 {
  return $this->entities;
 }
 
 function getFather():string
 {
  $ents = $this->getEntities();
	return $ents[ENT_FATHER];
 }
 
 function getSon():string
 {
  $ents = $this->getEntities();
	return $ents[ENT_SON];
 }
 
 function getLinkTable():string
 {
  return $this->linkTable;
 } 
 
 function setLinkTable(string $actLink):void
 {
  $this->linkTable = $actLink;
 }
 
 function getRelTypes():array
 {
  return $this->types;
 }
 
 function setRelTypes(array $actTypes):void
 {
  $this->types = $actTypes;
 }
 
 //
 // Ritorna il tipo di partecipazione alla relazione
 // da parte dell'entità data.
 //
 function getRelType(string $entName):string
 {
  $entities =$this->getEntities();
	$types = $this->getRelTypes();
	$num = count($entities);
  for($i=0;$i<=$num-1;$i++)
	{
	 if($entities[$i] == $entName)
	  return $types[$i];
	}
	return REL_TYPE_NONE;
 }
}

?>