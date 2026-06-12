<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_69_op_page.class.php");

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"stack\" dojoType=\"dijit.layout.StackContainer\" " .
 "style=\"width:700px; height:700px; margin:5px; border:solid 1px white\">"  .
 "<div id=\"Stack1\" dojoType=\"dijit.layout.ContentPane\">" .
 "<div dojoType=\"dijit.layout.BorderContainer\"" .
 " design=\"headline\" style=\"height:800px;width:800px;border:solid 1px\" liveSplitters=\"false\">" .
 "<div id=\"top1\" dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"top\" style=\"padding:30px;background-color:blue;height:200px;border:solid 1px\" splitter=\"true\"" .
 " minSize=50 maxSize=400>" .
 "<span>Width:</span><span dojoType=\"dijit.InlineEditBox\" width=\"100px\" editorParams=\"{color:'black'}\" editor=\"dijit.form.TextBox\">0px</span>" . 
 "<div dojoType=\"dojo.dnd.Source\" style=\"width:80%;text-align:center;border:1px dotted white\" class=\"container\">" .
// "<div id=\"foo1\" style=\"width:80%;text-align:center;border:1px solid white\"  class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
// "<div id=\"bar1\" style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">bar</div>" .
// "<div id=\"baz1\" style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">baz</div>" .
// "<div id=\"quux1\" style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">quux</div>" .
 "</div>" . 
 "</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"center\" minSize=10 maxSize=400 splitter=\"true\" style=\"background-color:green;height:300px;border:solid 1px\">center</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"bottom\" style=\"padding:30px;background-color:red;height:100px;border:solid 1px\" splitter=\"true\">" .
 "<div dojoType=\"dojo.dnd.Source\" style=\"width:80%;text-align:center;border:1px dotted white\" class=\"container\">" .
 "<div style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
 "<div style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">bar</div>" .
 "<div style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">baz</div>" .
 "<div style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">quux</div>" .
 "</div>" . 
 "</div></div>" .
 "</div>" .
 "<div id=\"Stack2\" dojoType=\"dijit.layout.ContentPane\">" .
 "<div dojoType=\"dijit.layout.BorderContainer\"" .
 " design=\"headline\" style=\"height:800px;width:800px;border:solid 1px\" liveSplitters=\"false\">" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"top\" style=\"padding:30px;background-color:blue;height:200px;border:solid 1px\" splitter=\"true\"" .
 " minSize=50 maxSize=400>" . 
 "<div dojoType=\"dojo.dnd.Source\" style=\"width:80%;text-align:center;border:1px dotted white\" class=\"container\">" .
 "<div id=\"foo2\" style=\"width:100%;text-align:center;border:1px solid white\"  class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
 "<div id=\"bar2\" style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">bar</div>" .
 "<div id=\"baz2\" style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">baz</div>" .
 "<div id=\"quux2\" style=\"width:100%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">quux</div>" .
 "</div>" . 
 "</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\"" .
 " region=\"bottom\" style=\"padding:30px;background-color:red;height:100px;border:solid 1px\" splitter=\"true\">" .
 "<div dojoType=\"dojo.dnd.Source\" class=\"container\">" .
 "<div style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
 "<div style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">bar</div>" .
 "<div style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">baz</div>" .
 "<div style=\"width:80%;text-align:center;border:1px solid white\" class=\"dojoDndItem\">quux</div>" .
 "</div>" . 
 "</div></div>" .
 "</div>" .
 "</div>" .
 "</div>" .
// "<div dojoType=\"dijit.Menu\" targetNodeIds=\"foo1\" style=\"display:none\">" .
// "<div dojoType=\"dijit.MenuItem\">Delete" .
// "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">\$('#foo1').remove();" .
// "</script></div></div>" .
 "<button dojoType=\"dijit.form.Button\">1" .
 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
 "dijit.byId(\"stack\").selectChild(\"Stack1\");" .
 "</script>" .
 "</button>" .
 "<button dojoType=\"dijit.form.Button\">2" .
 "<script type=\"dojo/method\" event=\"onClick\" args=\"evt\">" .
 "dijit.byId(\"stack\").selectChild(\"Stack2\");" .
 "</script>" .
 "</button>"
 );

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceHtmlFragment1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_69_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
