<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("Cheope_ns_page.class.php");
require_once("Html_fragment.class.php");

define('DEFAULT_PAGE_NAME',"prova_62");
define('THIS_PAGE',PAGE_PROVA_62);

class Cheope_ns_prova_62_op_page extends Cheope_ns_page
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
 	$htmlWriter = $this->getHtmlWriter();
   $htmlWriter->putScriptIncludeTag(CLIENT_JQUERY_INFINITE_SCROLL_CODE_PATH  .
   DIR_SEP . JS_JQUERY_INFINITE_SCROLL);
 }
 
 // metodo virtuale
 function putCodeBeforeBodyClose():void
 {
 	parent::putCodeBeforeBodyClose();
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putScriptOpenTag();
 	$htmlWriter->putGenericHtmlString("\$(function(){" .
  "var \$container = \$('#container');" .
  "\$container.infinitescroll({" .
  "navSelector  : '#page-nav'," .    // selector for the paged navigation
  "nextSelector : '#page-nav a'," .  // selector for the NEXT link (to page 2)
  "itemSelector : '.box'," .     // selector for all items you'll retrieve
  "loading: {" .
  "finishedMsg: 'No more pages to load.'," .
  "img: './img/close.gif'" .
  "}});" .
  "});");
 	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_HTML_FRAGMENT,NUM_1); 

  //$interfaceScript1 = $interfacesContainer->getInterface(OBJ_NONE,
  //OP_NONE,INT_HTML_TAGS,NUM_3);
  //$interfaceScript1->putData();
  
  $interfaceFrame->putData();  
 }
}
