<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_32_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div  id=\"ancora\">ciao</div><div dojoType=\"dijit.Menu\" targetNodeIds=\"ancora\" style=\"display:none\" > " .
 "<div dojoType=\"dijit.MenuItem\">foo <script type=\"dojo/method\" event=\"onClick\" args=\"evt\">alert('foo');</script></div>" .
 "<div dojoType=\"dijit.MenuItem\">bar <script type=\"dojo/method\" event=\"onClick\" args=\"evt\">alert('bar');</script></div>" .
 "<div dojoType=\"dijit.PopupMenuItem\" id=\"subMenu1\" onclick=\"alert('baz')\"><span>baz</span>" .
 "<div dojoType=\"dijit.Menu\">" .
 "<div dojoType=\"dijit.MenuItem\">yabba</div>" .
 "<div dojoType=\"dijit.MenuItem\">dabba</div>" .
 "<div dojoType=\"dijit.MenuItem\">doo</div>" . 
 "</div>" .
 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">alert('baz');</script></div>" .
 "</div>");
 
 $interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dijit.byId(\"subMenu1\")._onClick=function(){alert(\"baz\");};");

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_32_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
