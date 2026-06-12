<?
namespace Cheope_ns\fw;
require_once("GraphIter.int.php");
require_once("Generic_iterator.class.php");
require_once("Db_item.class.php");
require_once("Content.int.php");

class Db_items_iterator extends Generic_iterator implements GraphIter
{
  //const ERROR_1="Db_items_iterator:Errore nell'inserimento dell'oggetto. L'oggetto deve essere di tipo Db_item";

  function __construct(Content $actObj)
 	{
 	 parent::__construct($actObj);
 	}
 	
 //
 // Si sposta sull'elemento successivo in base ad $actPos
 // Ritorna True se rimango dentro al grafo.
 // Ritorna False se ne esco.
 function gotoNext(int $actPos):bool
 {
  $curElement = $this->current();
  $nextGNodes = $curElement->getSons();
	$num1 = count($nextGNodes);
  if ($actPos <= $num1-1)
	{
   $obj = $curElement->getSonByPos($actPos);
	 $objNodeName = $obj->getAliasName();
   $this->reset();
   $nextElement = $this->current();
   while($this->hasMore())
   {
   	if($objNodeName==$nextElement->getAliasName())
   	 return true;
   	$this->next();
   	$nextElement = $this->current();
   }
  }
  return false;
 } 	
 	 
 }
 
?>