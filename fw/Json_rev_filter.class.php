<?
namespace Cheope_ns\fw;
require_once("Filter.class.php");

class Json_rev_filter extends Filter
{
 function __construct()
 {
 	parent::__construct();
 }
 
 function exec():string
 {
  $item = $this->getItem();
  return json_decode($item,true);
 }

}

?>