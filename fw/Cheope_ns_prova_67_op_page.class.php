<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("Xml_generic_serializer.class.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_nLevels_menu.class.php");
require_once("Html_span_tag.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_67");
define('THIS_PAGE',PAGE_PROVA_67);

class Cheope_ns_prova_67_op_page extends Cheope_ns_page
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
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode():void
 {
	 parent::putClientScriptIncludeCode();
 }
 
  function putActiveApp():void
 {
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	   
	$interfacesContainer = $this->getInterfacesContainer();

  $serializer = new Xml_generic_serializer("Users.xml");
  $serializer->loadData();
  $items = $serializer->getItems();
  
  $interfaceSpan1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0); 

  $interfaceSpan1->setTagBody(print_r($items,true));

  $interfaceNLevelsMenu1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_NLEVELS_MENU,NUM_1);
  $interfaceNLevelsMenu1->setDataSource(array($items));

  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 
  
  $interfaceFrame->putData();  
 }
}
