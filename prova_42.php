<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_42_op_page.class.php");

 $interfaceScrollingTable1 = new Cheope_ns_scrolling_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceScrollingTable1->setDbStruct($dbStructTree);
 $interfaceScrollingTable1->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceScrollingTable1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
 $interfaceScrollingTable1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE 
 ,TABELLA_PROVA_2=>FIELD_ID_PROVA_2,"QQ"));
 $interfaceScrollingTable1->setColumnsDims(array("33%","33%","33%"));
 
 $interfaceScrollingTable2 = new Cheope_ns_scrolling_table($dbObjProva,OP_NONE,NUM_2);
 $interfaceScrollingTable2->setDbStruct($dbStructTree);
 $interfaceScrollingTable2->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceScrollingTable2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_TABLE_NO_LOOKUP,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC));
 $interfaceScrollingTable2->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE 
 ,TABELLA_PROVA_2=>FIELD_ID_PROVA_2,"QQ"));
 $interfaceScrollingTable2->setColumnsDims(array("33%","33%","33%"));

 $interfaceFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceFragment1->setHtmlFragment("<div style=\"background-color:red;\">Ciao,ciao mare.<br/>Ciao,Ciao,mare...</div>");

 $interfaceFragment2 = new Html_fragment(OP_NONE,NUM_2);
 $interfaceFragment2->setHtmlFragment("<div style=\"background-color:red;\">Ciao,ciao mare.<br/>Ciao,Ciao,mare...</div>");

 define("FRAME_CONTAINER_2","FrameCont2");

 $interfacesContainer2 = new Interfaces_container(FRAME_CONTAINER_2); 
 $interfacesContainer2->add($interfaceScrollingTable2);
 $interfacesContainer2->add($interfaceFragment1);

 $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceMenuBar1->setDataFields(array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS));
 $interfaceMenuBar1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET));
 $interfaceMenuBar1->setDataFieldsDomainsValues(array(array("Db Objects","sss","sss")
 ,array("Db Objects","sss","sss"),array("Db Objects",
 "sss","sss")));
 $interfaceMenuBar1->setInterfacesContainer($interfacesContainer2);
 $interfaceMenuBar1->setCssClass(CSS_MENUBAR);
 $interfaceMenuBar1->setDataSource(NO_DATA_SOURCE);
 
 $interfaceMenuBar2 = new Cheope_ns_menuBar($dbQueryQ_prova_2,OP_NONE,NUM_2);
 $interfaceMenuBar2->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceMenuBar2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceMenuBar2->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE 
 ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceMenuBar2->setInterfacesContainer($interfacesContainer2);
 $interfaceMenuBar2->setCssClass(CSS_MENUBAR);
 $interfaceMenuBar2->setDataSource(NO_DATA_SOURCE);
  
 $intDivContainer1 = new Interfaces_container(FRAME_CONTAINER_2);
 $intDivContainer1->add($interfaceMenuBar1);
 $intDivContainer1->add($interfaceMenuBar2);
 $intDivContainer1->add($interfaceFragment2);
 
 $interfaceDiv1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDiv1->setInterfacesContainer($intDivContainer1);
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1,2,2,"100%","100%");
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceDiv1);
 $interfaceFrameContainer1->add($interfaceScrollingTable1);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceScrollingTable1);
 $interfacesContainer->add($interfaceScrollingTable2);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceMenuBar2);
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($decoratedIntFrame1);
 $interfacesContainer->add($interfaceFragment1);
 $interfacesContainer->add($interfaceFragment2);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_42_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setBodyOnLoad("");
 $page->putData();
 
 
?>