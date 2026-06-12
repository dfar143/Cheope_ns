<?
namespace 
  			Cheope_ns\fw;
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("cheope_ns_db_struct.def.php");
require_once("cheope_ns_db_queries.def.php");
require_once("cheope_ns_db_connections.def.php");
require_once("cheope_ns_db_binds.def.php");
require_once("Cheope_ns_barGradex.class.php");
define('DEFAULT_PAGE_NAME',"preview");
define('THIS_PAGE',"preview.php");
class Cheope_ns_preview_op_page extends Cheope_ns_page
{
function __construct($actNum=0)
{
spl_autoload_register(array($this,'autoload'));
parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
$this->isASessionPage=true;
}
function putLinkTags():void
{
parent::putLinkTags();
putLinkTag(STRING_NULL,CLIENT_DOJO_CSS_PATH . DIR_SEP . "dojo" .  STYLE_SHEET_FILE_POSTFIX);
putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" .  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
}
function putClientScriptIncludeCode():void
{
parent::putClientScriptIncludeCode();
$htmlWriter=$this->getHtmlWriter();
$htmlWriter->put("<script>dojo.require(\"dojo.parser\")</script>");
$htmlWriter->put("<script>dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>");
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