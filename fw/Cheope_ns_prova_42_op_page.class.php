<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_scrolling_table.class.php");
require_once("Cheope_ns_menuBar.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Html_div_tag.class.php");
require_once("Html_fieldset_decorator.class.php");
require_once("Html_fragment.class.php");


define('DEFAULT_PAGE_NAME',"prova_42");
define('THIS_PAGE',PAGE_PROVA_42);

class Cheope_ns_prova_42_op_page extends Cheope_ns_page
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
 
 function putCodeBeforeBodyClose():void
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putScriptOpenTag();
 	$htmlWriter->putGenericHtmlString("\$('#menuBar__2').css('display','none');" .
 	"\$('#html_fragment__2').css('display','block');" .
 	"\$('#menuBar__1_col_div_a_2').bind('mouseover',function(){\$('#menuBar__2').css('display','block');" .
 	"\$('#html_fragment__2').css('display','none');});" .
 	"\$('#menuBar__1_col_div_a_3').bind('mouseover',function(){\$('#menuBar__2').css('display','none');" .
 	"\$('#html_fragment__2').css('display','block');});");
 	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody():void
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $intMenuBar1 = $interfacesContainer->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_MENUBAR,NUM_1);
  $intMenuBar1->addMenuBarVoice("AAA");
  $intMenuBar1->addMenuBarPage("AAA");
  $intMenuBar1->addMenuBarId("AAA");
  $intMenuBar1->addMenuBarVoice("BBB");
  $intMenuBar1->addMenuBarPage("BBB");
  $intMenuBar1->addMenuBarId("BBB");
  
  $interfaceFrame = $interfacesContainer->getInterface(OBJ_NONE,
  OP_NONE,Interfaces_info::INT_FRAME,NUM_1); 

  //$interfaceScript1 = $interfacesContainer->getInterface(OBJ_NONE,
  //OP_NONE,INT_HTML_TAGS,NUM_3);
  //$interfaceScript1->putData();
  
  $interfaceFrame->putData();  
 }
}
