<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_login_op_page.class.php");

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_USER,FIELD_PASSWORD);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_USER=>30,FIELD_PASSWORD=>30);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
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
 


 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_LOGIN);
 $interfaceFrame1->setDispFields($dispFields);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame1);
 //$decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 //Caricamento interfacce per controlli contenitore
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceForm1);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(THIS_PAGE);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_7));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($decoratedIntFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_login_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>