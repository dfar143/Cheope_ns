<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_66_op_page.class.php");

 $intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div class=\"spin\" data-spin></div><br/>");

 $intHtmlFragment2 = new Html_fragment(OP_NONE,NUM_2);
 $intHtmlFragment2->setHtmlFragment("<button id=\"button_1\" onclick=\"\$('.spin').show();\">Show</button><br/>");

 $intHtmlFragment3 = new Html_fragment(OP_NONE,NUM_3);
 $intHtmlFragment3->setHtmlFragment("<button id=\"button_2\" onclick=\"\$('.spin').hide();\">Hide</button>");
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setColsNum(1);
 $intFrame1->setRowsNum(3);
 $intFrameContainer1 = new Interfaces_container("");
 $intFrameContainer1->add($intHtmlFragment1);
 $intFrameContainer1->add($intHtmlFragment2);
 $intFrameContainer1->add($intHtmlFragment3);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $intSpin1 = new Cheope_ns_spin(OP_NONE,NUM_1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intSpin1);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intHtmlFragment2);
 $interfacesContainer->add($intHtmlFragment3);
 $interfacesContainer->add($intFrame1);
 
 $page = new Cheope_ns_prova_66_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>