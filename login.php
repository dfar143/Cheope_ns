<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_login_op_page.class.php");

 $interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_USER,FIELD_PASSWORD);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_USER=>30,FIELD_PASSWORD=>30);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(FIELD_DOMAIN_ATOMIC,FIELD_DOMAIN_ATOMIC);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(FIELD_DOMAIN_VALUE_NONE,FIELD_DOMAIN_VALUE_NONE);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $fieldsLabels = array(FIELD_USER=>LABEL_USER,FIELD_PASSWORD=>LABEL_PASSWORD);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $accessFields = array(ACCESS_OBB,ACCESS_OBB);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array();
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setInitialTabIndex(1);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setJavascriptEnabled(true);

 $interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_LOGIN);
 $interfaceFrame1->setDispFields($dispFields);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 //Caricamento interfacce per controlli contenitore
 $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceForm1);
 $interfaceFrame1->setInterfaceContainer($interfaceFrameContainer1);
 
 $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(THIS_PAGE);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setSequenceStrings(array('',MSG_7));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfaceContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfaceContainer->add($interfaceForm1);
 $interfaceContainer->add($interfaceFrame1);
 $interfaceContainer->add($interfaceTempMsg1);
 $interfaceContainer->add($decoratedIntFrame1);

 $page = new Cheope_ns_login_op_page();
 $page->setInterfaceContainer($interfaceContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>