<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_53_op_page.class.php");

 $intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div id=\"source1\" dojoType=\"dojo.dnd.Source\" class=\"container\">" .
 "<div class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
 "<div class=\"dojoDndItem\">bar</div>" .
 "<div class=\"dojoDndItem\">baz</div>" .
 "<div class=\"dojoDndItem\">quux</div>" .
 "</div>" .
 "<div id=\"source2\" dojoType=\"dojo.dnd.Source\" class=\"container\">" .
 "<div class=\"dojoDndItem\"><a href=\"#\">FOO</a></div>" .
 "<div class=\"dojoDndItem\">BAR</div>" .
 "<div class=\"dojoDndItem\">BAZ</div>" .
 "<div class=\"dojoDndItem\">QUUX</div>" .
 "</div>");
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intFrameContainer1->add($intHtmlFragment1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_53_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>