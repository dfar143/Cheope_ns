<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_16_op_page.class.php");


 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE_UNIQUE_VAL);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setJavascriptEnabled(true);


 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 /*$interfacesContainer->add($interfaceJavascriptFrag1);*/
 $interfacesContainer->add($interfaceSimpleTable1);
 
 $page = new Cheope_ns_prova_16_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 ?>
