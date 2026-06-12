<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_37_op_page.class.php");

 $interfaceDataTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceDataTemplate1->setDataFields(array(FIELD_DATA_1));
 $interfaceDataTemplate1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceDataTemplate1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceDataTemplate1->setHtmlTemplate("<button>{DATA_1}</button>");

 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_TEMP_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $interfaceSimpleTable1->setHeight("100%");
 $interfaceSimpleTable1->setWidth("100%");
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceDataTemplate1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setInheritData(true);
 $interfaceSimpleTable1->setJavascriptEnabled(true);
 
 $interfaceSimpleTable2 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_2);
 $interfaceSimpleTable2->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_TEMP_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable2->setDataFields($dataFields);
 $interfaceSimpleTable2->setHeight("100%");
 $interfaceSimpleTable2->setWidth("100%");
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceDataTemplate1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable2->setDataFieldsDomainsValues($fieldsDomainsValues); 
 $interfaceSimpleTable2->setInheritData(true);
 $interfaceSimpleTable2->setJavascriptEnabled(true);
 
 $interfaceSimpleTable3 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_3);
 $interfaceSimpleTable3->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_TEMP_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable3->setDataFields($dataFields);
 $interfaceSimpleTable3->setHeight("100%");
 $interfaceSimpleTable3->setWidth("100%");
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceDataTemplate1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable3->setInheritData(true);
 $interfaceSimpleTable3->setJavascriptEnabled(true);

 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setDivEnvelope(false);
 $interfaceHtmlFragment1->setHtmlFragment("<table><tr><td>aaa</td><td>bbb</td></tr></table>");

 $interfaceDataTemplate2 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceDataTemplate2->setDataFields(array(FIELD_DATA_2));
 $interfaceDataTemplate2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_OBJ));
 $interfaceDataTemplate2->setDataFieldsDomainsValues(array($interfaceSimpleTable2));
 $interfaceDataTemplate2->setHtmlTemplate("<div id=\"foo\" dojoType=\"dijit.layout.AccordionContainer\" " .
 "style=\"width:100%;height:300px;margin:0px;padding:0px;border:solid 1px;\">" .
 "<div dojoType=\"dijit.layout.ContentPane\" title=\"One\">One fish...</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\" title=\"Two\" style=\"height:200px\">Ciao ciao</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\" title=\"Red\">{DATA_2}</div>" .
 "<div dojoType=\"dijit.layout.ContentPane\" title=\"Blue\">Blue fish...</div>" .
 "</div>");
 
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
 
 $intLocalTabsContainer1 = new Interfaces_container(STRING_NULL);
   $intLocalTabsContainer1->add($interfaceA2);
 $intLocalTabsContainer1->add($interfaceSimpleTable3);
 $intLocalTabsContainer1->add($interfaceA4);
 $intLocalTabsContainer1->add(null);
 $intLocalTabsContainer1->add(null);
 $intLocalTabsContainer1->add(null);
 $intLocalTabsContainer1->add(null);

 
 $interfaceLocalTabs1 = new Cheope_ns_local_tabs_2(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceLocalTabs1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_LABELS,FIELD_IDS);
 $interfaceLocalTabs1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceLocalTabs1->setDataFieldsDomains($fieldsDomains);
  $interfaceLocalTabs1->setCollapsible(false);
 $fieldsDomainsValues = array(array("aaa","bbb","ccc"),array("#id1","#id2","#id3"));
 $interfaceLocalTabs1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLocalTabs1->setInterfacesContainer($intLocalTabsContainer1);

 
 $interfaceFrame1 = new Cheope_ns_div_frame(OP_NONE,NUM_1);
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setColsNum(4);
 $interfaceFrame1->setRowsNum(2);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setFrameCellsWidths(array("200px","200px","200px","200px"));
 $interfaceFrame1->setFrameWidth("100%");
 $interfaceFrame1->setFrameHeight("100%");
 $interfaceFrame1->setCssClass(CSS_DIV_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1,OP_NONE,NUM_1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
  define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceDataTemplate2);
 $interfaceFrameContainer1->add($interfaceA2);
 $interfaceFrameContainer1->add($interfaceA3);
 $interfaceFrameContainer1->add($interfaceA4);
 $interfaceFrameContainer1->add($interfaceA2);
 $interfaceFrameContainer1->add($interfaceA3);
 $interfaceFrameContainer1->add($interfaceSimpleTable1);
 $interfaceFrameContainer1->add($interfaceLocalTabs1);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceDataTemplate1);
 $interfacesContainer->add($interfaceDataTemplate2);
 $interfacesContainer->add($interfaceSimpleTable1);
 $interfacesContainer->add($interfaceSimpleTable2);
 $interfacesContainer->add($interfaceSimpleTable3);
 $interfacesContainer->add($interfaceA2);
 $interfacesContainer->add($interfaceA3);
 $interfacesContainer->add($interfaceA4); 
 $interfacesContainer->add($interfaceLocalTabs1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);
 $interfacesContainer->add($interfaceHtmlFragment1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_37_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 
?>