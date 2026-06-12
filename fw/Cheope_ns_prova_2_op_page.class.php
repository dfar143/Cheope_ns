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
require_once("Cheope_ns_form.class.php");
require_once("Cheope_ns_db_navigator.class.php");
require_once("Html_fragment.class.php");
require_once("Html_button_tag.class.php");
require_once("Html_data_template.class.php");
require_once("Php_data_fragment.class.php");
require_once("Xml_interface_serializer.class.php");


define('DEFAULT_PAGE_NAME',"prova_2");
define('THIS_PAGE',PAGE_PROVA_2);

class Cheope_ns_prova_2_op_page extends Cheope_ns_page
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
  $intForm = $interfacesContainer->getInterface(OBJ_PROVA,
  OP_INSERIMENTO,Interfaces_info::INT_FORM,NUM_1);  
  $intDecForm = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_FIELDSET_DECORATOR,NUM_8); 
  //$intForm->putFormValidationCodePar(); 
  $intDecForm->putData();
  $intTemp = $interfacesContainer->getInterface(OBJ_NONE,OP_NONE,
  Interfaces_info::INT_HTML_DATA_TEMPLATE,NUM_2);
  $intTemp->putData();
  
  //$interfaceDbNavigator1 = $interfacesContainer->getInterface(OBJ_PROVA_2,
  //OP_NONE,INT_TREE_CTRL,NUM_1);
  //$interfaceDbNavigator1->setNum(2);
  //$ser = new Xml_interface_serializer(STRING_NULL);
  //$ser->setIntContainer($interfacesContainer);
  //$intForm->setSerializer($ser);
  //$intForm->serialize();
  //$intForm->serializer_saveData();
  //$intForm->serializer_loadData();
  //$intForm->unserialize();
  //$intForm->setInitialTabIndex(10);
  //$intDecForm->putData();
  
  //$intForm->putData();
  //$intDbNav->putData();
  /*$intSheet1 = $interfacesContainer->getInterface(QUERY_PROVA_2,
  OP_NONE,INT_SHEET,NUM_1);  
  $intSheet1->putData(); 
  $intSheet2 = $interfacesContainer->getInterface(QUERY_PROVA_2,
  OP_NONE,INT_SHEET,NUM_2);  
  $intSheet2->putData();*/
 }
}
