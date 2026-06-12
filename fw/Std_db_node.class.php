<?
namespace Std\fw;
require_once("std.const.php");
require_once("Db_node.class.php");


class Std_db_node extends Db_node
{
	
 // Campo identificativo per il log.
 var $logDataField=STRING_NULL;
	
 function __construct(string $actName)
 {
  parent::__construct($actName);
 }
 
 function getLogDataField():string
 {
  return $this->logDataField;
 }
 
 function setLogDataField(string $actLogDataField):void
 {
  $this->logDataField = $actLogDataField;
 }
 
}


?>