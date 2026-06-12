<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_barGradex.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Html_fieldset_decorator.class.php");


define('DEFAULT_PAGE_NAME',"prova_64");
define('THIS_PAGE',PAGE_PROVA_64);

class Cheope_ns_prova_64_op_page extends Cheope_ns_page
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
  
  $dataSource = array(0=>array(FIELD_DATA_1=>"AAA",FIELD_DATA_2=>21),
  1=>array(FIELD_DATA_1=>"BBB",FIELD_DATA_2=>34));
  
  $interfaceBarGradex = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_BARGRADEX,NUM_1);
  $interfaceBarGradex->setDataSource($dataSource);  
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 

  //$interfaceScript1 = $interfacesContainer->getInterface(OBJ_NONE,
  //OP_NONE,INT_HTML_TAGS,NUM_3);
  //$interfaceScript1->putData();
  $interfaceFrame->putData();  
 }
}
