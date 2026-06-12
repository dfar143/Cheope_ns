<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Html_script_tag.class.php");
require_once("Html_div_tag.class.php");

define('DEFAULT_PAGE_NAME',"prova_22_2");
define('THIS_PAGE',PAGE_PROVA_22_2);

class Cheope_ns_prova_22_2_op_page extends Cheope_ns_page
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
  putLinkTag(STRING_NULL,"./css/form.css");
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "claro" . 
  DIR_SEP . "claro" .  STYLE_SHEET_FILE_POSTFIX);
 }

 function putActiveApp():void
 {
 }
 
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
  parent::putClientScriptIncludeCode();
  $htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.TextBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.DateTextBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.TimeTextBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.ValidationTextBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.FilteringSelect\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.MultiSelect\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.ComboBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.Button\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.Form\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.SimpleTextarea\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.CheckBox\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.form.RadioButton\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Tooltip\")</script>");
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dijit.Dialog\")</script>");
  $htmlWriter->putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className='claro';});</script>");
  $htmlWriter->putGenericHtmlString("<script>function formatValue(actVal,actObj){alert(actVal);return actVal.toUpperCase();}</script>");
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  $interfaceDiv1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 
  
  print_r($_POST);
  
  $interfaceDiv1->putData();  
 }
}
