<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_47_op_page.class.php");

 $intHtmlButton1 = new Html_button_tag(OP_NONE);
 $attribs1 = array("type"=>"button","onclick" =>
 "javascript:download()");

 $intHtmlButton1->setAttribs($attribs1);
 $intHtmlButton1->setTagBody("Press");
 
 $intHtmlSpan1 = new Html_span_tag(OP_NONE);
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intFrameContainer1->add($intHtmlButton1);
 $intFrameContainer1->add($intHtmlSpan1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intFrame1);
 $interfacesContainer->add($intHtmlButton1);
 $interfacesContainer->add($intHtmlSpan1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_47_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setAjaxOps(array(AJAX_OP_OP7));
 $page->putData();
 
 
?>