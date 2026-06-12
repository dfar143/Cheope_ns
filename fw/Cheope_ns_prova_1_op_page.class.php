<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_scrolling_table.class.php");
require_once("Html_fieldset_decorator.class.php");
require_once("Cheope_ns_sheet.class.php");
require_once("Html_input_ctrl.class.php");


define('DEFAULT_PAGE_NAME',"prova_1");
define('THIS_PAGE',PAGE_PROVA);

class Cheope_ns_prova_1_op_page extends Cheope_ns_page
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
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
	$interfacesContainer = $this->getInterfacesContainer();
//	print_r($interfacesContainer);
  $intScroll = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_FIELDSET_DECORATOR,NUM_5);  
  $intScroll->putData();
  $intSheet1 = $interfacesContainer->getInterface(QUERY_Q_PROVA_2,
  OP_NONE,Interfaces_info::INT_SHEET,NUM_0);  
  $intSheet1->putData(); 
  $intSheet2 = $interfacesContainer->getInterface(QUERY_Q_PROVA_2,
  OP_NONE,Interfaces_info::INT_SHEET,NUM_1);  
  $intSheet2->putData();
 }

}
