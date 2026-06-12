<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_28_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"foo\" dojoType=\"dijit.layout.AccordionContainer\" " .
 "style=\"width:100%;height:400px;margin:5px;border:solid 1px;\">" .
 "<div dojoType=\"dijit.layout.AccordionPane\" style=\"color:black;\" title=\"One\"><p>One fish...</p></div>" .
 "<div dojoType=\"dijit.layout.AccordionPane\" style=\"color:black;\" title=\"Two\"><p>Two fish...</p></div>" .
 "<div dojoType=\"dijit.layout.AccordionPane\" style=\"color:black;\" title=\"Red\"><p>Red fish...</p></div>" .
 "<div dojoType=\"dijit.layout.AccordionPane\" style=\"color:black;\" title=\"Blue\"><p>Blue fish...</p></div>" .
 "</div>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_28_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
