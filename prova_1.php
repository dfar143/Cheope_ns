<? 
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_1_op_page.class.php");
  
 $interfaceSheet1 = new Cheope_ns_sheet($dbQueryQ_prova_2);
 $interfaceSheet1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2);
 $interfaceSheet1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceSheet1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceSheet1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("By By");
 $interfaceSheet1->setDispFields($dispFields);
 $interfaceSheet1->setCssClass(CSS_SHEET);
 
 $interfaceInputCtrl1 = new Html_input_ctrl($dbObjProva);
 $dataFields = array(FIELD_DATA_1);
 $interfaceInputCtrl1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceInputCtrl1->setDataFieldsDomains($fieldsDomains); 
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceInputCtrl1->setDataFieldsDomainsValues($fieldsDomainsValues);
 
 $interfaceInputCtrl2 = new Html_input_ctrl();
 $dataFields = array("Regione");
 $interfaceInputCtrl2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET);
 $interfaceInputCtrl2->setDataFieldsDomains($fieldsDomains); 
 $fieldsDomainsValues = array(array("Lombardia"=>"Lombardia","Veneto"=>"Veneto","Friuli"=>"Friuli"));
 $interfaceInputCtrl2->setDataFieldsDomainsValues($fieldsDomainsValues);
 
 $interfaceScrollTable1 = new Cheope_ns_scrolling_table($dbQueryQ_prova_1);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2,FIELD_SHEET_1,"Regioni");
 $interfaceScrollTable1->setDbStruct($dbStructTree);
 $interfaceScrollTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceScrollTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceInputCtrl1,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceSheet1,$interfaceInputCtrl2);
 $interfaceScrollTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceScrollTable1->setColumnsDims(array("20%","20%","20%","20%","20%"));
 $dispFields = array("Ciao ciao");
 $interfaceScrollTable1->setDispFields($dispFields);
 $interfaceScrollTable1->setInheritData(false);
 $interfaceScrollTable1->setCssClass(CSS_SCROLLING_TABLE);

 $interfaceSheet2 = new Cheope_ns_sheet($dbQueryQ_prova_2);
 $interfaceSheet2->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2,"Regione");
 $interfaceSheet2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
 $interfaceSheet2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceScrollTable1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,"M");
 $interfaceSheet2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("Sheet_2");
 $interfaceSheet2->setDispFields($dispFields);
 $interfaceSheet2->setCssClass(CSS_SHEET);

 $interfaceDecScrollTable1 = new Html_fieldset_decorator($interfaceScrollTable1);
 
 
 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op6",NUM_1);  
// $interfaceJavascriptFrag4 = new Javascript_fragment("viewBindsOp6",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("console.log('aaaa');" );
 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op7",NUM_1);  
// $interfaceJavascriptFrag4 = new Javascript_fragment("viewBindsOp6",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment("console.log('bbbb');var a=\"aaa\";" );
 
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceScrollTable1);
 $interfacesContainer->add($interfaceDecScrollTable1);
 $interfacesContainer->add($interfaceSheet1);
 $interfacesContainer->add($interfaceInputCtrl1);
 $interfacesContainer->add($interfaceInputCtrl2);
 $interfacesContainer->add($interfaceSheet2);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 
 $page = new Cheope_ns_prova_1_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

