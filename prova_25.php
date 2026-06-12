<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_25_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div dojoType=\"dojo.data.ItemFileReadStore\"" .
 " jsId=\"coffeeStore\" url=\"./coffee.json\"></div><form dojoType=\"dijit.form.Form\" method=\"POST\" action=\"prova_25.php\">" .
 "<select multiple=\"true\" name=\"foo\" dojoType=\"dijit.form.MultiSelect\" " .
 "style=\"height:100px;width:100px;border:3px solid black;\">" .
 "<option value=\"TN\" selected=\"true\">Tennessee</option>" .
 "<option value=\"VA\">Virginia</option>" .
 "<option value=\"WV\">West Virginia</option>" .
 "<option value=\"OH\">Ohio</option>" .
 "</select><br/><br/>" .
 "<input name=\"baz\" type=\"text\"\>" .
 "<button>Submit</button></form>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_25_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
