<?
namespace Std\fw;
require_once("struct.fun.php");
require_once("Std_page.class.php");
require_once("std_db_struct.def.php");
require_once("std_db_queries.def.php");
require_once("std_db_connections.def.php");
require_once("std_db_binds.def.php");
define('DEFAULT_PAGE_NAME',"preview");
define('THIS_PAGE',"preview.php");
class Std_preview_op_page extends Std_page
{
function __construct($actNum=STRING_NULL)
{
parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
$this->isASessionPage=true;
}
function putLinkTags():void
{
parent::putLinkTags();
putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX);
putLinkTag(STRING_NULL,CLIENT_DOJO_CSS_PATH . 
 DIR_SEP . "dojo" .  STYLE_SHEET_FILE_POSTFIX);
putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
}

function putClientScriptIncludeCode():void
{
parent::putClientScriptIncludeCode();
$htmlWriter=$this->getHtmlWriter();
$htmlWriter->put("<script>dojo.require(\"dojo.parser\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.TextBox\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.Tooltip\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.DateTextBox\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.ValidationTextBox\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.FilteringSelect\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.MultiSelect\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.ComboBox\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.Button\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.SimpleTextarea\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.CheckBox\")</script>");
$htmlWriter->put("<script>dojo.require(\"dijit.form.RadioButton\")</script>");
$htmlWriter->put("<script>
	 dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' nihilo';});</script>
	        ");
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