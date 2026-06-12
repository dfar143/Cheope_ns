<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_interface_op_page.class.php");

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
// $interfaceForm1 = new Cheope_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_INTERFACCE);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceDivTag1);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array();
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $fieldsLabels = array(STRING_NULL);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_SALVA_INTERFACCIA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_INTERFACCE);
 $interfaceFrame2->setDispFields($dispFields);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceForm1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("returnVal = " .
 "window.location.search.substr(5,window.location.search.length-1);");

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 $ajaxOps = array(
 AJAX_OP_POST_SEND_INTERFACE_DATA,
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>