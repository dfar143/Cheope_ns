<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_22_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<form id=\"form1\" method=\"POST\" action=\"prova_22.php\">" .
 "<input style=\"color:black;\" dojoType=\"dijit.form.TextBox\" name=\"prova\" format=\"formatValue\" " .
 " onchange=\"alert('change')\"><br/><br/>" .
 "<input style=\"color:black;height:50px;font-size:15pt;\" name=\"dataOdierna\" dojoType=\"dijit.form.DateTextBox\"><br/>" .
 "<br/><button type=\"submit\">Invia</button></form><button type=\"button\">Out</button>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_22_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
