<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_35_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div dojoType=\"dojo.data.ItemFileWriteStore\" jsId=\"dataStore\" " .
 " url=\"./json/programmingLanguages_2.json\"></div>" .
 "<div dojoType=\"dijit.tree.ForestStoreModel\" jsId=\"model\"" .
 "store=\"dataStore\" query=\"{type:'category'}\" rootId=\"root\" rootLabel=\"Programming Languages\"></div>" . 
 "<div dojoType=\"dijit.Tree\" id=\"tree\" model=\"model\" dndController=\"dijit._tree.dndSource\"><script type=\"dojo/method\" event=\"onClick\" args=\"item,treeNode\">" .
 "alert(dataStore.getLabel(item));</script></div>");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_35_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
