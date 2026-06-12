<?
namespace Cheope_ns\fw;
require_once("cheope_ns.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_button_tag.class.php");
require_once("Html_div_tag.class.php");

define('DEFAULT_PAGE_NAME',"prova_19");
define('THIS_PAGE',PAGE_PROVA_19);

class Cheope_ns_prova_19_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }

 function putLinkTags():void
 {
 	parent::putLinkTags();
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
  $interfaceDiv1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 
  
  $interfaceDiv1->putData();  
 }
}
