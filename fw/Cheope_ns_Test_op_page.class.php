<?
namespace 
  			Cheope_ns\fw;
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("cheope_ns_db_connections.def.php");
require_once("cheope_ns_db_binds.def.php");
require_once("html_div_tag.class.php");
define('DEFAULT_PAGE_NAME',"Test");
define('THIS_PAGE',"Test.php");
class Cheope_ns_Test_op_page extends Cheope_ns_page
{
function __construct($actNum=0)
{
parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
$this->isASessionPage=true;
}
function putLinkTags():void
{
parent::putLinkTags();
}
function putClientScriptIncludeCode():void
{
parent::putClientScriptIncludeCode();
}
function putActiveApp():void
{

}
function putBody():void
{
$interfaces=$this->getInterfacesContainer();
$int_iter=$interfaces->create();
$int=$int_iter->last();
$int->putData();
}
}

?>