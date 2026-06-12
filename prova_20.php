<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_20_op_page.class.php");

 $interfaceDataTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceDataTemplate1->setDataFields(array(FIELD_DATA_1));
 $interfaceDataTemplate1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceDataTemplate1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceDataTemplate1->setHtmlTemplate("<button>{DATA_1}</button>");

 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_TEMP_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_TABLE);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceDataTemplate1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,TABELLA_PROVA_2=>FIELD_DATA_1);
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setInheritData(true);
 $interfaceSimpleTable1->setJavascriptEnabled(true);

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceSimpleTable1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceDataTemplate1);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceSimpleTable1);
 
 $page = new Cheope_ns_prova_20_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 ?>
