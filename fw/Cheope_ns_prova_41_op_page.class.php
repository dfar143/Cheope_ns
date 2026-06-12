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


define('DEFAULT_PAGE_NAME',"prova_41");
define('THIS_PAGE',PAGE_PROVA_41);

class Cheope_ns_prova_41_op_page extends Cheope_ns_page
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
	  parent::putClientScriptIncludeCode();
	  $htmlWriter = $this->getHtmlWriter();
	  $htmlWriter->putScriptIncludeTag("./js/formValidator.js");
 	  $htmlWriter->putScriptOpenTag();
 	  $htmlWriter->putGenericHtmlString("var objForm_form__1 = new FormValidator();");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.numDataFields=1;");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.setDataFields(new Array(objForm_form__1.numDataFields));");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.getDataFields()[0]=\"jquery_input_2\";");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.numDataFieldsTypes=1;");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.setDataFieldsTypes(new Array(objForm_form__1.numDataFieldsTypes));");
 	  $htmlWriter->putGenericHtmlString("objForm_form__1.getDataFieldsTypes()[0]=\"Integer\";");

 	 // $htmlWriter->putGenericHtmlString("$.tools.validator.conf.inputEvent='keyup';");
 	  $htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
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
