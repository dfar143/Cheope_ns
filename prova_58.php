<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_58_op_page.class.php");

 $intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div class=\"box\"></div>" .
 "<div id=\"box\" class=\"box\" " .
 "style=\"background:blue\">Chaining</div>");
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container("");
 $intFrameContainer1->add($intHtmlFragment1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_58_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>