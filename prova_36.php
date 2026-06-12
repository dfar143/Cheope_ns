<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_36_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div style=\"margin:px;background:#eee;height:400px;width:525px\">" .
 "<div id=\"editor\" height=\"375px\" dojoType=\"dijit.Editor\">" .
 "When shall we three meet again ?<br>" .
 "</div>" .
 "</div>" .
 "<button dojoType=\"dijit.form.Button\">save" .
 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
 "alert(dijit.byId(\"editor\").getValue());" .
 "</script>" .
 "</button>" .
 "<button dojoType=\"dijit.form.Button\">Clear" .
 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
 "dijit.byId(\"editor\").replaceValue(\"\");" .
 "</script>" .
 "</button>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_36_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
