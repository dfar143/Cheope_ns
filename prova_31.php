<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_31_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div dojoType=\"dijit.Toolbar\" style=\"width:175px;\"> " .
 "<button dojoType=\"dijit.form.Button\" iconClass=\"dijitEditorIcon dijitEditorIconBold\">aaa</button>" .
 "<button dojoType=\"dijit.form.Button\" iconClass=\"dijitEditorIcon dijitEditorIconItalic\"></button>" .
  "<button dojoType=\"dijit.form.Button\" iconClass=\"dijitEditorIcon dijitEditorIconUnderline\"></button>" .
  "<span dojoType=\"dijit.ToolbarSeparator\"></span>" . 
 "<button dojoType=\"dijit.form.Button\" iconClass=\"dijitEditorIcon dijitEditorIconSubscript\"></button>" .
  "<button dojoType=\"dijit.form.Button\" iconClass=\"dijitEditorIcon dijitEditorIconSuperscript\"></button>" .
 "</div>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_31_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
