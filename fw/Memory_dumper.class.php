<?
namespace Cheope_ns\fw;
require_once("Dumper.class.php");

class Memory_dumper extends Dumper
{
 
 function __construct(Stringable $actObj)
 {
  parent::__construct($actObj);
 }
 
 function dump():string
 {
  $obj = $this->getObj();
  $str = $obj->toString();
  return $str; 	
 }

}
