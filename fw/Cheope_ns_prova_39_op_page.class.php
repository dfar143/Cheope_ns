<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_form.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Html_input_tag.class.php");
require_once("Html_fieldset_decorator.class.php");


define('DEFAULT_PAGE_NAME',"prova_39");
define('THIS_PAGE',PAGE_PROVA_39);

class Cheope_ns_prova_39_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }

 function putActiveApp():void
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
 	  $htmlWriter = $this->getHtmlWriter();
	  parent::putClientScriptIncludeCode();
//	  $htmlWriter->putGenericHtmlString('<script>$(":date").dateinput();</script>');
 }
 
 function putLinkTags():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	parent::putLinkTags();
 	//$htmlWriter->putLinkTag(STRING_NULL,"./jQueryTools/dateInput/css/skin1.css");
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 

  //$interfaceScript1 = $interfacesContainer->getInterface(OBJ_NONE,
  //OP_NONE,INT_HTML_TAGS,NUM_3);
  //$interfaceScript1->putData();
  
  $interfaceFrame->putData();  
 }
}
