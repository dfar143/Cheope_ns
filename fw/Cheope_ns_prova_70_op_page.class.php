<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");
require_once("Html_script_tag.class.php");
require_once("Html_div_tag.class.php");

define('DEFAULT_PAGE_NAME',"prova_70");
define('THIS_PAGE',PAGE_PROVA_70);

class Cheope_ns_prova_70_op_page extends Cheope_ns_page
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
  putGenericHtmlString("<script>dojo.require('dojox.grid.DataGrid');</script>"); 
  putGenericHtmlString("<script>dojo.require('dojox.data.CsvStore');</script>");
  putGenericHtmlString("<script>" .
	"dojo.addOnLoad(function(){" .
	"var store4 = new dojox.data.CsvStore({url:'./dojo/dojox/grid/tests/movies.csv'});" .
	"var layout4 = [{field:'Title',name:'Title of Movies',width:'200px'}," .
	"{field:'Year',name:'Year',width:'50px'}," .
	"{field:'Producer',name:'Producer',width:'auto'}];" .
	"var grid4 = new dojox.grid.DataGrid({" .
	"query:{Title:'*'}," .
	"store:store4," .
	"clientSort:true," .
	"rowSelector:'20px'," .
	"structure:layout4},document.createElement('div'));" . 
	"dojo.byId('gridContainer4').appendChild(grid4.domNode);" .
	"grid4.startup();});" .
	"</script>");
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
