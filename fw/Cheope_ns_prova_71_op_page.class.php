<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Html_div_tag.class.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_form_section.class.php");

define('DEFAULT_PAGE_NAME',"prova_71");
define('THIS_PAGE',PAGE_PROVA_71);

class Cheope_ns_prova_71_op_page extends Cheope_ns_page
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
  putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "claro" . 
  DIR_SEP . "claro" .  STYLE_SHEET_FILE_POSTFIX);
 // putLinkTag(STRING_NULL,CLIENT_DIJIT_CSS_PATH . DIR_SEP . "nihilo" . 
 // DIR_SEP . "nihilo" .  STYLE_SHEET_FILE_POSTFIX);
 // putLinkTag(STRING_NULL,CLIENT_DOJOX_CODE_PATH . DIR_SEP . "grid" . 
 // DIR_SEP . "resources" .  DIR_SEP . "Grid" . STYLE_SHEET_FILE_POSTFIX);
 // putLinkTag(STRING_NULL,CLIENT_DOJOX_CODE_PATH . DIR_SEP . "grid" . 
 // DIR_SEP . "resources" .  DIR_SEP . "tundraGrid" . STYLE_SHEET_FILE_POSTFIX);
 // putGenericHtmlString("<style type='text/css'>" .
 // "@import \"./dojo/dojox/grid/resources/Grid_rtl.css\";" .
 // "@import \"./dojo/dojox/grid/resources/tundraGrid.css\";</style>");
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
  $htmlWriter->putGenericHtmlString("<script>dojo.require(\"dojo.parser\");</script>");
  $htmlWriter->putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){dojo.parser.parse();document.body.className='claro';});</script>");
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
