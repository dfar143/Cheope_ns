<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("Xml_generic_serializer.class.php");
require_once("Xml_serializer.class.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_span_tag.class.php");
require_once("Cheope_ns_frame.class.php");

define('DEFAULT_PAGE_NAME',"prova_68");
define('THIS_PAGE',PAGE_PROVA_68);

class Cheope_ns_prova_68_op_page extends Cheope_ns_page
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

  $items = array("aaa"=>array("aaaa1"=>"aaaa","bbb"=>"bbb"),"bbb"=>"bbb");
  $serializer1 = new Xml_generic_serializer("Prova_68_1.xml");
  $serializer1->loadItems($items);
  $serializer1->saveData();
  $serializer2 = new Xml_serializer("Prova_68_2.xml");
  $serializer2->loadItems($items);
  $serializer2->saveData();
  /*$serializer1->resetRoot();
  $items = array("aaa"=>array("aaaa1"=>"aaaa","bbb"=>"bbb"),"bbb"=>"bbb");
  $serializer1->loadItems($items);
  $serializer1->saveData();*/
  $intSpan1 = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_TAGS,NUM_0);
  $serializer1->loadData();
  $intSpan1->setTagBody(print_r($serializer1->getItems(),true));   
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 
  
  $interfaceFrame->putData();  
 }
}
