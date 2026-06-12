<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_62_op_page.class.php");

 $intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div id=\"container\"><div class=\"box\"><p>content</p>" .
 "</div></div>" .
"<!-- contains the content to be loaded when scrolled -->" .
"<nav id=\"page-nav\">" .
"<a href=\"2.html\">AAA</a>" .
"</nav>");
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlFragment1);
 
 $page = new Cheope_ns_prova_62_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>