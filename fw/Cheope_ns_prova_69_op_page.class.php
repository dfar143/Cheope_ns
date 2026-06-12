<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Html_script_tag.class.php");
require_once("Html_div_tag.class.php");

define('DEFAULT_PAGE_NAME',"prova_69");
define('THIS_PAGE',PAGE_PROVA_69);

class Cheope_ns_prova_69_op_page extends Cheope_ns_page
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
  //putLinkTag(STRING_NULL,CLIENT_DOJO_CSS_PATH . 
  //DIR_SEP . "dojo" .  STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
  DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
  putLinkTag(STRING_NULL,CLIENT_DOJO_CSS_PATH . DIR_SEP . "dnd.css");
 }

 function putActiveApp():void
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
  parent::putClientScriptIncludeCode();
  putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>"); 
  putGenericHtmlString("<script>dojo.require(\"dijit.layout.BorderContainer\")</script>"); 
  putGenericHtmlString("<script>dojo.require(\"dijit.layout.StackContainer\")</script>");
  putGenericHtmlString("<script>dojo.require(\"dijit.layout.ContentPane\")</script>");
  putGenericHtmlString("<script>dojo.require(\"dijit.form.TextBox\")</script>");
  putGenericHtmlString("<script>dojo.require(\"dijit.InlineEditBox\")</script>");
  putGenericHtmlString("<script>dojo.require(\"dijit.form.Button\")</script>");
  putGenericHtmlString("<script>dojo.require(\"dojo.dnd.Source\");</script>");
  putGenericHtmlString("<script>dojo.require(\"dijit.Menu\")</script>");
  putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className+=' tundra';});</script>");
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  $interfaceDiv1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 
  
  $interfaceDiv1->putData();  
 }
}
