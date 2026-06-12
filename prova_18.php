<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_18_op_page.class.php");


 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_ID_PROVA_2);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setJavascriptEnabled(true);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setTagBody("ciao ciao");

 $intLocalTabsContainer1 = new Interfaces_container(STRING_NULL);
 $intLocalTabsContainer1->add($interfaceSimpleTable1);
 $intLocalTabsContainer1->add($interfaceDivTag1);
 $intLocalTabsContainer1->add(null);
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
 $fieldsDomainsValues = array(array("aaa","bbb","ccc"),array("#id-1","#id-2","#id-3"));
 $interfaceLocalTabs1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLocalTabs1->setInterfacesContainer($intLocalTabsContainer1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceLocalTabs1);
 $interfacesContainer->add($interfaceSimpleTable1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_18_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 ?>
