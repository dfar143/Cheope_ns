<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_5_op_page.class.php");

 $interfaceJavascriptDataFrag3 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptDataFrag3->setHookId("frame__1_2_0");
 $interfaceJavascriptDataFrag3->setJavascriptFragment("htmlWriter.putGenericHtmlString('<button onclick=\"" .
 "ajaxHandler.synServerCall(\\\'ajax_handler.php\\\',\\\'Op1\\\',\\\'1\\\',\\\'Xml\\\');\">Press</button>');");

 $interfaceJavascriptDataFrag2 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptDataFrag2->setHookId("frame__1_1_0");
 $interfaceJavascriptDataFrag2->setJavascriptFragment("htmlWriter.putGenericHtmlString('<button onclick=\"" .
 "el = getElementById(\\\'frame__1_0_0\\\');el.innerHTML=\\\'\\\';\">Press</button>');");

 $interfaceJavascriptDataFrag1 = new Javascript_data_fragment("Op3",NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceJavascriptDataFrag1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptDataFrag1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptDataFrag1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptDataFrag1->setDataExchangeType("xml");
 $interfaceJavascriptDataFrag1->setJavascriptFragment("fieldVal = '#DATA_2#';" . 
 "if(fieldVal>0.5)htmlWriter.putGenericHtmlString('xxxxx');" . 
 "else htmlWriter.putGenericHtmlString('#DATA_1#');");
 
 $interfaceJavascriptTemplate2 = new Javascript_data_template("Op2",NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptDataFrag1,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr><td>{DATA_1}</td><td>{DATA_2}</td></tr>");  
  
 $interfaceJavascriptTemplate1 = new Javascript_data_template("Op1",NUM_1);
 $dataFields = array(FIELD_TEMP_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("frame__1_0_0");
 $interfaceJavascriptTemplate1->setDataExchangeType("xml");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table border=\"1\">{TEMP_1}</table>");
   
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(3);
 $interfaceFrame1->setColsNum(1);
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add(null);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptDataFrag3);
 $interfacesContainer->add($interfaceJavascriptDataFrag2);
 $interfacesContainer->add($interfaceJavascriptDataFrag1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);
 
 $page = new Cheope_ns_prova_5_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

