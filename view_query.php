<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_query_op_page.class.php");

 $intHtmlInputCtrl1 = Creator::create("Html_input_ctrl",STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intHtmlInputCtrl1 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_QUERIES);
 $intHtmlInputCtrl1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET);
 $intHtmlInputCtrl1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $intHtmlInputCtrl1->setDataFieldsDomainsValues($fieldsDomainsValues);  
 $dataFieldsEvents = array("form_inserimento_1_lista_queries_onChange(this);");
 $intHtmlInputCtrl1->setDataFieldEvents($dataFieldsEvents);

 $interfaceLabelTag1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$interfaceLabelTag1 = new Html_label_tag();
 $attribs = array("for"=>"Query_body");
 $interfaceLabelTag1->setAttribs($attribs);
 $interfaceLabelTag1->setTagBody(LABEL_CORPO_QUERY . ENTITY_SPACE . ENTITY_SPACE);
 
 $interfaceTextareaTag1 = Creator::create("Html_textarea_tag",STRING_NULL);
 //$interfaceTextareaTag1 = new Html_textarea_tag();
 $attribs = array("id"=>"Query_body","rows"=>4,"cols"=>40,"onchange"=>"query_body_onChange();");
 $interfaceTextareaTag1->setAttribs($attribs);
 
 $interfaceBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$interfaceBrTag1 = new Html_br_tag();
 
 $interfaceLabelTag2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$interfaceLabelTag2 = new Html_label_tag();
 $attribs = array("for"=>"isDataSource");
 $interfaceLabelTag2->setAttribs($attribs);
 $interfaceLabelTag2->setTagBody(LABEL_SORGENTE_DATI . ENTITY_SPACE . ENTITY_SPACE); 
 
 $interfaceInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInputTag1 = new Html_input_tag();
 $attribs = array("id"=>"isDataSource","type"=>"checkbox",
 "onchange"=>"form_inserimento_1_isDataSource_onChange(this);");
 $interfaceInputTag1->setAttribs($attribs);
 
 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container();
 $interfaceDivTagContainer1->add($interfaceLabelTag1);
 $interfaceDivTagContainer1->add($interfaceTextareaTag1);
 $interfaceDivTagContainer1->add($interfaceBrTag1);
 $interfaceDivTagContainer1->add($interfaceBrTag1);  
 $interfaceDivTagContainer1->add($interfaceLabelTag2);
 $interfaceDivTagContainer1->add($interfaceInputTag1);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);  

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_QUERIES,FIELD_NUOVA_QUERY,FIELD_QUERY_BODY);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(50,50,50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlInputCtrl1,Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceDivTag1);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $fieldsLabels = array(FIELD_LISTA_QUERIES=>LABEL_LISTA_QUERIES,
 FIELD_NUOVA_QUERY=>LABEL_NUOVA_QUERY);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $dataFieldsEvents = array(
 FIELD_NUOVA_QUERY=>array("form_inserimento_1_nuova_query_onChange(this);"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("window.location.reload();");
 $interfaceForm1->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_QUERIES);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
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
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceLabelTag1); 
 $interfacesContainer->add($interfaceTextareaTag1);
 $interfacesContainer->add($interfaceInputTag1);
 $interfacesContainer->add($intHtmlInputCtrl1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL,STRING_NULL);
 //$page = new Cheope_ns_view_query_op_page();
 $ajaxOps = array(AJAX_OP_GET_QUERY,AJAX_OP_SET_QUERY,
 AJAX_OP_CHECK_IF_IS_DATA_SOURCE_QUERY,
  AJAX_OP_CREATE_DB_BINDS,AJAX_OP_UPDATE_BINDS,
  AJAX_OP_GET_NODE_TYPE);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>