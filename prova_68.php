<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_68_op_page.class.php");

 $intHtmlSpan1 = new Html_span_tag(OP_NONE,NUM_1);

 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 
 $intFrameContainer1 = new Interfaces_container("");
 $intFrameContainer1->add($intHtmlSpan1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlSpan1);
 $interfacesContainer->add($intFrame1);
 
 $page = new Cheope_ns_prova_68_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>