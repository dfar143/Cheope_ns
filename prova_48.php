<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_48_op_page.class.php");

 $intHtmlDiv2 = new Html_div_tag(OP_NONE);
 $attribs2 = array("class"=>"noteHandle");

 $intHtmlDiv2->setAttribs($attribs2);

 $intTextarea1 = new Html_textarea_tag(OP_NONE);
 $attribs3 = array("class"=>"note");

 $intTextarea1->setAttribs($attribs3);

 $intHtmlDiv1 = new Html_div_tag(OP_NONE);
 $attribs1 = array("skip"=>"true","dojoType" =>
 "dojo.dnd.Moveable");

 $intHtmlDiv1->setAttribs($attribs1);
 $intDivContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intDivContainer1->add($intHtmlDiv2);
 $intDivContainer1->add($intTextarea1);
 $intHtmlDiv1->setInterfacesContainer($intDivContainer1);
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intFrameContainer1->add($intHtmlDiv1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlDiv1);
 $interfacesContainer->add($intFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_48_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>