<?
namespace Cheope_ns\fw;

require_once("Executable_3.int.php");
require_once("Creator.tra.php");

abstract class AjaxOp implements Executable_3
{
 use Creator;	
	
 private $name=STRING_NULL;
 private $isJsonEnabled=false;
 
 function __construct(string $actName=STRING_NULL)
 {
  $this->name = $actName;
 }
 
 function getName():string
 {
 	return $this->name;
 }
 
 function setName(string $actName):void
 {
 	$this->actName = $actName;
 }
 
 function setIsJsonEnabled(bool $actIsJsonEnabled):void
 {
 	$this->isJsonEnabled = $actIsJsonEnabled;
 }
 
 function getIsJsonEnabled():bool
 {
 	return $this->isJsonEnabled;
 }
 
 function isJsonEnabled():bool
 {
 	return $this->isJsonEnabled;
 }

}

?>