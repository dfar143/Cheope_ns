<?
namespace Cheope_ns\fw;
 require_once("std.const.php");
 require_once("Db_query.class.php");

class Std_db_query extends Db_query
{
	
 function __construct(string $actName,Db_nodes_container $actDbStruct,string $actQueryStr=STRING_NULL)
 {
 	parent::__construct($actName,$actDbStruct,$actQueryStr);
 } 
 
}
 
?>