<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_52_op_page.class.php");

 $intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div dojoType=\"dojo.dnd.Source\" class=\"container\">" .
 "<div class=\"dojoDndItem\"><a href=\"#\">foo</a></div>" .
 "<div class=\"dojoDndItem\">bar</div>" .
 "<div class=\"dojoDndItem\">baz</div>" .
 "<div class=\"dojoDndItem\">quux</div>" .
 "</div>");
 
 $intHtmlTemplate2 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_2);
 $intHtmlTemplate2->setDataFields(array(FIELD_VAL_1,FIELD_VAL_2));
 $intHtmlTemplate2->setHtmlTemplate("<tr class=\"dojoDndItem\">" .
 "<td width=\"50%\">{VAL_1}</td>" .
 "<td width=\"50%\">{VAL_2}</td></tr>");
 
 $intHtmlTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $intHtmlTemplate1->setDataFields(array(FIELD_OBJ_1));
 $intHtmlTemplate1->setHtmlTemplate("<table width=\"600\"><thead>" .
 "<tr><th>COL 1" .
 "</th><th>COL 2</th><tr></thead><tbody dojoType=\"dojo.dnd.Source\" class=\"container\">{OBJ_1}" .
 "</tbody></table>"); 
 $intHtmlTemplate1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_OBJ));
 $intHtmlTemplate1->setDataFieldsDomainsValues(array($intHtmlTemplate2));
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intFrameContainer1->add($intHtmlFragment1);
 $intFrameContainer1->add($intHtmlTemplate1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlTemplate1);
 $interfacesContainer->add($intHtmlTemplate2);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_52_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>