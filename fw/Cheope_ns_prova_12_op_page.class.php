<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("struct.fun.php");
require_once("Html_div_tag.class.php");
require_once("Html_textarea_tag.class.php");
require_once("Cheope_ns_page.class.php");
require_once("Javascript_fragment.class.php");
require_once("Javascript_data_txtEditor.class.php");


define('DEFAULT_PAGE_NAME',"prova_12");
define('THIS_PAGE',PAGE_PROVA_12);

class Cheope_ns_prova_12_op_page extends Cheope_ns_page
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
 }

 function putActiveApp():void
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
  parent::putClientScriptIncludeCode();
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $interfaceDiv = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 
  
  $interfaceDiv->putData();  
 }
}
