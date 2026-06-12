<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_8_op_page.class.php");

 Html_tags::$distinctTags = true;
 $interfaceA1 = new Html_a_tag(OP_NONE,NUM_1);
 $attribs = array("href"=>"#");
 $interfaceA1->setAttribs($attribs);
 $interfaceA1->setTagBody("AAAAAAA<br/>AAAAAAA");
 $interfaceA1->setAppName("Cheope_ns");
 $interfaceA1->setPageName(DEFAULT_PAGE_NAME);
 $interfaceA1->serialize();
 $interfaceA1->serializer_saveData("Cheope_ns");

 $interfaceA2 = new Html_a_tag(OP_NONE,NUM_2);
 $attribs = array("href"=>"#");
 $interfaceA2->setAttribs($attribs);
 $interfaceA2->setTagBody("BBBBBBBBBBBBBBBB BBBBBBBBBB BBBBBBBB BBBBBBB BBBBBBBBBBBBB");
 $interfaceA2->setAppName("Cheope_ns");
 $interfaceA2->setPageName(DEFAULT_PAGE_NAME);
 $interfaceA2->serialize();
 $interfaceA2->serializer_saveData("Cheope_ns");

 $interfaceA3 = new Html_a_tag(OP_NONE,NUM_3);
 $attribs = array("href"=>"#");
 $interfaceA3->setAttribs($attribs);
 $interfaceA3->setTagBody("CCCCCCCC CCCCCCCCCCCC CCCCCC CCCCCCCCCCC CCCC CCCCCCCCCCCCC");
 $interfaceA3->setAppName("Cheope_ns");
 $interfaceA3->setPageName(DEFAULT_PAGE_NAME);
 $interfaceA3->serialize();
 $interfaceA3->serializer_saveData("Cheope_ns");
 
 $interfaceA4 = new Html_a_tag(OP_NONE,NUM_4);
 $attribs = array("href"=>"#");
 $interfaceA4->setAttribs($attribs);
 $interfaceA4->setTagBody("DDDDDDD");
 $interfaceA4->setAppName("Cheope_ns");
 $interfaceA4->setPageName(DEFAULT_PAGE_NAME);
 $interfaceA4->serialize();
 $interfaceA4->serializer_saveData("Cheope_ns");
  
 $interfaceLocalTabs1 = new Cheope_ns_local_tabs($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4);
 $interfaceLocalTabs1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceLocalTabs1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceLocalTabs1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLocalTabs1->setCssClass(CSS_LOCAL_TABS);
 
 $decoratedLocalTabs1 = new Html_fieldset_decorator($interfaceLocalTabs1);

 define("FRAME_CONTAINER_2","InterfaceLocalTabsFrameCont1");
 
 $interfaceLocalTabsContainer1 = new Interfaces_container(FRAME_CONTAINER_2);
 $interfaceLocalTabsContainer1->add($interfaceA1);
 $interfaceLocalTabsContainer1->add($interfaceA2);
 $interfaceLocalTabsContainer1->add($interfaceA3);
 $interfaceLocalTabsContainer1->add($interfaceA4);

 $interfaceLocalTabs1->setInterfacesContainer($interfaceLocalTabsContainer1);
 $interfaceLocalTabs1->setAppName("Cheope_ns");
 $interfaceLocalTabs1->setPageName(DEFAULT_PAGE_NAME);
 $interfaceLocalTabs1->serialize();
 $interfaceLocalTabs1->serializer_saveData("Cheope_ns");

 $interfaceLocalTabs2 = new Cheope_ns_local_tabs(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4);
 $interfaceLocalTabs2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,
 Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
 $interfaceLocalTabs2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array("ziao1","Ciao2",
 "Ciao3","Ciao4");
 $interfaceLocalTabs2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLocalTabs2->setCssClass(CSS_LOCAL_TABS);

 define("FRAME_CONTAINER_3","InterfaceLocalTabsFrameCont2");

 $interfaceLocalTabsContainer2 = new Interfaces_container(FRAME_CONTAINER_3);
 $interfaceLocalTabsContainer2->add($interfaceA1);
 $interfaceLocalTabsContainer2->add($interfaceA2);
 $interfaceLocalTabsContainer2->add($interfaceA3);
 $interfaceLocalTabsContainer2->add($interfaceA4);

 $interfaceLocalTabs2->setInterfacesContainer($interfaceLocalTabsContainer2);
 $interfaceLocalTabs2->setAppName("Cheope_ns");
 $interfaceLocalTabs2->setPageName(DEFAULT_PAGE_NAME);
 $interfaceLocalTabs2->serialize();
 $interfaceLocalTabs2->serializer_saveData("Cheope_ns");
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(2);
 $interfaceFrame1->setColsNum(1);
 $dispFields = array(STRING_NULL);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceLocalTabs1);
 $interfaceFrameContainer1->add($interfaceLocalTabs2);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setAppName("Cheope_ns");
 $interfaceFrame1->setPageName(DEFAULT_PAGE_NAME);
 $interfaceFrame1->serialize();
 $interfaceFrame1->serializer_saveData("Cheope_ns");

 Html_tags::$distinctTags = false;
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceA1);
 $interfacesContainer->add($interfaceA2);
 $interfacesContainer->add($interfaceA3);
 $interfacesContainer->add($interfaceA4); 
 $interfacesContainer->add($interfaceLocalTabs1);
 $interfacesContainer->add($decoratedLocalTabs1);
 $interfacesContainer->add($interfaceLocalTabs2);
 $interfacesContainer->add($interfaceFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_8_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 
?>