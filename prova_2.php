<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_2_op_page.class.php");
  
 $interfaceSheet1 = new Cheope_ns_sheet($dbQueryQ_prova_2,OP_NONE,NUM_1);
 $interfaceSheet1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2);
 $interfaceSheet1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceSheet1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceSheet1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("By By");
 $interfaceSheet1->setDispFields($dispFields);
 $interfaceSheet1->setCssClass(CSS_SHEET);
 
 $interfaceInputCtrl1 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1);
 $interfaceInputCtrl1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceInputCtrl1->setDataFieldsDomains($fieldsDomains); 
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceInputCtrl1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceInputCtrl1->setTabIndex(2);
 
 $interfaceButtonTag1 = new Html_button_tag(OP_NONE,NUM_1);
 $interfaceButtonTag1->setTagBody(FIELD_BUTTON_1);
 
 $interfaceScrollTable1 = new Cheope_ns_scrolling_table($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2,FIELD_SHEET_1);
 $interfaceScrollTable1->setDbStruct($dbStructTree);
 $interfaceScrollTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceScrollTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceInputCtrl1,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceSheet1);
 $interfaceScrollTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceScrollTable1->setColumnsDims(array("25%","25%","25%","25%"));
 $dispFields = array("Ciao ciao");
 $interfaceScrollTable1->setInheritData(true);
 $interfaceScrollTable1->setDispFields($dispFields);
 $interfaceScrollTable1->setCssClass(CSS_SCROLLING_TABLE);
 
 $interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<p> jkrfhekrjgfekrjgerj </p>");
 
 $interfaceDbNavigator1 = new Cheope_ns_db_navigator($dbObjProva_3,OP_NONE,NUM_1);
 $interfaceDbNavigator1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_1,FIELD_ID_PROVA_3);
 $interfaceDbNavigator1->setDataFields($dataFields);  
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceDbNavigator1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE,
 Int_domain::FIELD_DOMAIN_VALUE_NONE,
 Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceDbNavigator1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceDbNavigator1->setGesPage(STRING_NULL);
// $interfaceDbNavigator1->setMainLabel('CucuPaloma');
 $interfaceDbNavigator1->setCssClass(CSS_TREE_CTRL);
 $interfaceDbNavigator1->setDispFields(array(FIELD_DATA_1));
 
 // Questa form viene usata nella pagina delle modifiche per ricercare la linea.
 $interfaceForm1 = new Cheope_ns_form($dbObjProva,OP_INSERIMENTO,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_SCROLL_1,FIELD_FRAGMENT_1,
 FIELD_DATA_3,FIELD_BUTTON_1,FIELD_DATA_4,FIELD_DB_NAV_1,FIELD_DATA_5);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(70,10,50,60,50,50,5,10,10);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,
 Int_domain::FIELD_DOMAIN_RADIO,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_MULTIPLE,
 Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_SET);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceInputCtrl1,
 $interfaceScrollTable1,$interfaceHtmlFragment1,array("aaa","bbbb"),
 $interfaceButtonTag1,
 array("ambarabaciccicocco"=>"a","b"=>"b","c"=>"c","d"=>"d"),$interfaceDbNavigator1,
 array("0"=>"a","1"=>"b"));
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("Ciao ciao");
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OBB,ACCESS_OPT,ACCESS_OPT,
 ACCESS_OPT,ACCESS_OBB,ACCESS_OPT,ACCESS_OBB,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $interfaceForm1->setGesPage("");
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel("Ricerca");
 $interfaceForm1->setResetButtonLabel("Annulla");
 $interfaceForm1->setCellSpacing(10);
 $interfaceForm1->setCellPadding(10); 

 $interfaceSheet2 = new Cheope_ns_sheet($dbQueryQ_prova_2,OP_NONE,NUM_2);
 $interfaceSheet2->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2);
 $interfaceSheet2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceSheet2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceScrollTable1,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceSheet2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("Sheet_2");
 $interfaceSheet2->setDispFields($dispFields);
 $interfaceSheet2->setCssClass(CSS_SHEET);

 $interfaceDecForm1 = new Html_fieldset_decorator($interfaceForm1);
    
 $interfacePhpDataFrag = new Php_data_fragment(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfacePhpDataFrag->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
 $interfacePhpDataFrag->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,"6");
 $interfacePhpDataFrag->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfacePhpDataFrag->setPhpFragment("\$fieldVal = #DATA_2#;\$htmlWriter=\$this->getHtmlWriter();" . 
 "if(\$fieldVal>0.5)\$htmlWriter->putGenericHtmlString('xxxxx');" . 
 "else \$htmlWriter->putGenericHtmlString('#DATA_1#');");

 $interfaceHtmlTemp1 = new Html_data_template($dbQueryQ_prova_1,OP_NONE,NUM_1);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2);
 $interfaceHtmlTemp1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceHtmlTemp1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfacePhpDataFrag,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceHtmlTemp1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceHtmlTemp1->setHtmlTemplate("<tr><td>{ID_PROVA}</td><td>{DATA_1}</td><td>{DATA_2}</td></tr>");  
 $interfaceHtmlTemp1->setDivEnvelope(false);
 
 $interfaceHtmlTemp2 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_TEMP_1);
 $interfaceHtmlTemp2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceHtmlTemp2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceHtmlTemp1);
 $interfaceHtmlTemp2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceHtmlTemp2->loadTemplateFromFile("template_prova.tpl");
 //$interfaceHtmlTemp2->setHtmlTemplate("<table border=\"1\">{TEMP_1}</table>");
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceScrollTable1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceDecForm1);
 $interfacesContainer->add($interfaceSheet1);
 $interfacesContainer->add($interfaceInputCtrl1);
 $interfacesContainer->add($interfaceSheet2);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceButtonTag1);
 $interfacesContainer->add($interfaceDbNavigator1);
 $interfacesContainer->add($interfacePhpDataFrag);
 $interfacesContainer->add($interfaceHtmlTemp1);
 $interfacesContainer->add($interfaceHtmlTemp2);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_2_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

