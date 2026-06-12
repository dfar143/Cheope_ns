<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_26_2_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div dojoType=\"dijit.layout.BorderContainer\"" .
 " design=\"headline\" style=\"height:800px;width:800px;border:solid 1px\" liveSplitters=\"false\">" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"top\" style=\"background-color:blue;height:200px;border:solid 1px\" splitter=\"true\"" .
 " minSize=50 maxSize=400>top</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"center\" style=\"background-color:green;border:solid 1px\">center</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"left\" splitter=\"true\" style=\"background-color:green;width:400px;border:solid 1px\">left</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"right\" splitter=\"true\" style=\"background-color:green;width:400px;border:solid 1px\">right</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"bottom\" style=\"background-color:red;height:100px;border:solid 1px\" splitter=\"true\">bottom</div></div>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_26_2_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
