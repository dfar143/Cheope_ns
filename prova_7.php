<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_7_op_page.class.php");

 $interfaceA1 = new Html_a_tag(OP_NONE,NUM_1);
 $attribs = array("href"=>"#","style"=>"border:1px solid white;");
 $interfaceA1->setAttribs($attribs);
 $interfaceA1->setTagBody("AAAAAAA");
 
 $interfaceA2 = new Html_a_tag(OP_NONE,NUM_2);
 $attribs = array("href"=>"#");
 $interfaceA2->setAttribs($attribs);
 $interfaceA2->setTagBody("BBBBBBBBBBBBBBBB BBBBBBBBBB BBBBBBBB BBBBBBB BBBBBBBBBBBBB");
 
 $interfaceA3 = new Html_a_tag(OP_NONE,NUM_3);
 $attribs = array("href"=>"#");
 $interfaceA3->setAttribs($attribs);
 $interfaceA3->setTagBody("CCCCCCCC CCCCCCCCCCCC CCCCCC CCCCCCCCCCC CCCC CCCCCCCCCCCCC");
 
 $interfaceA4 = new Html_a_tag(OP_NONE,NUM_4);
 $attribs = array("href"=>"#");
 $interfaceA4->setAttribs($attribs);
 $interfaceA4->setTagBody("DDDDDDD");
 
 $interfaceFrame1 = new Cheope_ns_div_frame(OP_NONE,NUM_1);
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setRowsNum(1);
 $interfaceFrame1->setColsNum(4);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setFrameCellsWidths(array("25%","25%","25%","25%"));
 $interfaceFrame1->setFrameWidth("100%");
 $interfaceFrame1->setFrameHeight("300px");
 $interfaceFrame1->setCssClass(CSS_DIV_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
  define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceA1);
 $interfaceFrameContainer1->add($interfaceA2);
 $interfaceFrameContainer1->add($interfaceA3);
 $interfaceFrameContainer1->add($interfaceA4);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceA1);
 $interfacesContainer->add($interfaceA2);
 $interfacesContainer->add($interfaceA3);
 $interfacesContainer->add($interfaceA4); 
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_7_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 
?>