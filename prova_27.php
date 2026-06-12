<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_27_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"stack\" dojoType=\"dijit.layout.StackContainer\" " .
 "style=\"background-color:red;width:400px;height:400px;margin:5px;border:solid 1px;\">" .
 "<div dojoType=\"dijit.layout.ContentPane\">One fish...</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\">Two fish...</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\">Red fish...</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\">Blue fish...</div>" .
 "</div><button dojoType=\"dijit.form.Button\">&lt;<script type=\"dojo/method\" event=\"onClick\" " .
 "args=\"evt\">dijit.byId(\"stack\").back();" .
 "</script></button>" .
 "<button dojoType=\"dijit.form.Button\">&gt;<script type=\"dojo/method\" event=\"onClick\" " .
 "args=\"evt\">dijit.byId(\"stack\").forward();" .
 "</script></button>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_27_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
