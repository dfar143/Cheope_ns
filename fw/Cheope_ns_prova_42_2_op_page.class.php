<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_int_struct.fun.php");
require_once("struct.fun.php");
require_once("cheope_ns_db_struct.def.php");
require_once("Cheope_ns_db_queries.def.php");
require_once("Cheope_ns_page.class.php");
require_once("Cheope_ns_scrolling_table.class.php");
require_once("Cheope_ns_menuBar_2.class.php");
require_once("Cheope_ns_frame.class.php");
require_once("Html_div_tag.class.php");
require_once("Html_fieldset_decorator.class.php");
require_once("Html_fragment.class.php");


define('DEFAULT_PAGE_NAME',"prova_42_2");
define('THIS_PAGE',PAGE_PROVA_42_2);

class Cheope_ns_prova_42_2_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }

 function putActiveApp()
 {
 }
 
 // Metodo virtuale per l'output del codice di inclusione dei moduli javascript
 // esterni.
 function putClientScriptIncludeCode()
 {
	  parent::putClientScriptIncludeCode();
 }
 
 function putCodeBeforeBodyClose()
 {
 	$htmlWriter = $this->getHtmlWriter();
 	$htmlWriter->putScriptOpenTag();
 	$htmlWriter->putGenericHtmlString("\$('#menuBar_2__2').css('display','none');" .
 	"\$('#html_fragment__2').css('display','block');" .
 	"\$('#menuBar_2__1_col_li_a_2').bind('mouseover',function(){\$('#menuBar_2__2').css('display','block');" .
 	"\$('#html_fragment__2').css('display','none');});" .
 	"\$('#menuBar_2__1_col_li_a_3').bind('mouseover',function(){\$('#menuBar_2__2').css('display','none');" .
 	"\$('#html_fragment__2').css('display','block');});");
 	$htmlWriter->putGenericHtmlString(SCRIPT_CLOSE_TAG);
 }
 
  
 // Metodo virtuale contenente la specifica della logica di visualizzazione del body.
 //
 function putBody()
 {	 
  global $dbStructTree;
  
	$interfacesContainer = $this->getInterfacesContainer();
  
  $intMenuBar1 = $interfacesContainer->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_MENUBAR_2,NUM_1);
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
