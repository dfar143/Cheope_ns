<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Stringable.int.php");
//
// Deve includere le classi che implementano il metodo toString
//  

abstract class Dumper 
{
 private $obj=null;
 
 function __construct(Stringable $actObj)
 {
 	$this->setObj($actObj);
 }
 
 function setObj(Stringable $actObj):void
 {
  $this->obj = $actObj;
 }
 
 function getObj():Stringable
 {
  return $this->obj;
 }
 
// Funzione virtuale
//
 abstract function dump():string;
 
}

?>