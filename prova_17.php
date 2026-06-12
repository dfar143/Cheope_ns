<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_17_op_page.class.php");

 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setJavascriptEnabled(true);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setTagBody("ciao ciao");

 $intAccordionContainer1 = new Interfaces_container(STRING_NULL);
 $intAccordionContainer1->add($interfaceSimpleTable1);
 $intAccordionContainer1->add($interfaceDivTag1);
 $intAccordionContainer1->add(null);
 $intAccordionContainer1->add(null);
 $intAccordionContainer1->add(null);
 $intAccordionContainer1->add(null);
 $intAccordionContainer1->add(null);
 
 $interfaceAccordion1 = new Cheope_ns_accordion($dbObjProva,OP_NONE,NUM_1);
 $interfaceAccordion1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_DATA_1);
 $interfaceAccordion1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceAccordion1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceAccordion1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceAccordion1->setInterfacesContainer($intAccordionContainer1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceAccordion1);
 $interfacesContainer->add($interfaceSimpleTable1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_17_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 ?>
