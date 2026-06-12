<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_24_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div dojoType=\"dojo.data.ItemFileReadStore\"" .
 " jsId=\"coffeeStore\" url=\"./coffee.json\"></div><form dojoType=\"dijit.form.Form\" action=\"prova_24.php\">" .
 "<select dojoType=\"dijit.form.ComboBox\" required=\"true\" name=\"coffee\" searchAttr=\"name\" store=\"coffeeStore\"> " .
 "<script type=\"dojo/method\" event=\"onChange\" args=\"newValue\">alert('value changed to ' + newValue);" .
 "var f=function(item){alert('new description is ' + coffeeStore.getValue(item,'description'));};" . 
 "coffeeStore.fetchItemByIdentity({identity:newValue,onItem:f});</script></select><br/><br/>" .
 "<button style=\"color:black;\" type=\"submit\" dojoType=\"dijit.form.Button\">Submit</button></form>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_24_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
