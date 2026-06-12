<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_51_op_page.class.php");

 $intHtmlDiv2 = new Html_div_tag(OP_NONE);
 $attribs2 = array("class"=>"noteHandle","id"=>"dragHandle1");

 $intHtmlDiv2->setAttribs($attribs2);

 $intTextarea1 = new Html_textarea_tag(OP_NONE);
 $attribs3 = array("class"=>"note");

 $intTextarea1->setAttribs($attribs3);
 $intTextarea1->setTagBody("Note1");
 
 $intHtmlDiv1 = new Html_div_tag(OP_NONE);
 $attribs1 = array("id"=>"note1");

 $intHtmlDiv1->setAttribs($attribs1);
 $intDivContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intDivContainer1->add($intHtmlDiv2);
 $intDivContainer1->add($intTextarea1);
 $intHtmlDiv1->setInterfacesContainer($intDivContainer1);
 
//***********

 $intHtmlDiv4 = new Html_div_tag(OP_NONE);
 $attribs5 = array("class"=>"noteHandle","id"=>"dragHandle2");

 $intHtmlDiv4->setAttribs($attribs5);

 $intTextarea2 = new Html_textarea_tag(OP_NONE);
 $attribs6 = array("class"=>"note");

 $intTextarea2->setAttribs($attribs6);
 $intTextarea2->setTagBody("Note2");
 
 $intHtmlDiv3 = new Html_div_tag(OP_NONE);
 $attribs4 = array("id"=>"note2");

 $intHtmlDiv3->setAttribs($attribs4);
 
 $intDivContainer2 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intDivContainer2->add($intHtmlDiv4);
 $intDivContainer2->add($intTextarea2);
 $intHtmlDiv3->setInterfacesContainer($intDivContainer2);
 
 $intHtmlDiv5 = new Html_div_tag(OP_NONE);
 $attribs7 = array("class"=>"parent");

 $intHtmlDiv5->setAttribs($attribs7);
 
 $intDivContainer3 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intDivContainer3->add($intHtmlDiv1);
 $intDivContainer3->add($intHtmlDiv3);
 $intHtmlDiv5->setInterfacesContainer($intDivContainer3);
 
 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 $intFrameContainer1 = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $intFrameContainer1->add($intHtmlDiv5);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intHtmlDiv1);
 $interfacesContainer->add($intHtmlDiv2);
 $interfacesContainer->add($intHtmlDiv3);
 $interfacesContainer->add($intHtmlDiv4);
 $interfacesContainer->add($intHtmlDiv5);
 $interfacesContainer->add($intFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_51_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>