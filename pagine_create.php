<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_pagine_create_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1); 
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $interfaceCurtainMenu1->setDbStruct($dbStructTree);
 $interfaceCurtainMenu1->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu1->unserialize();

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
 //$interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,"db_objects",NUM_1);
 $interfaceCurtainMenu2->setDbStruct($dbStructTree);
 $interfaceCurtainMenu2->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu2->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu2->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu2->unserialize();

 $interfaceCurtainMenu3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"connections",NUM_1);   
 //$interfaceCurtainMenu3 = new Cheope_ns_curtain_menu(OBJ_NONE,"connections",NUM_1);
 $interfaceCurtainMenu3->setDbStruct($dbStructTree);
 $interfaceCurtainMenu3->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu3->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu3->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu3->unserialize();

 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"interfaces",NUM_1);   
 //$interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"interfaces",NUM_1);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);
 $interfaceCurtainMenu4->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu4->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu4->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu4->unserialize();

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);    
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu5->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu5->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Edit","Manage ajaxOps"),
 array("pagine_edit.php","manage_ajaxOps.php"),array(STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu5->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu5->setCssClass(CSS_CURTAIN_MENU);

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
 //$interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"db_objects",NUM_1);
 $interfaceMenuBar1->setDbStruct($dbStructTree);
 $interfaceMenuBar1->setDbQueries($dbQueriesContainer);
 $interfaceMenuBar1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceMenuBar1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceMenuBar1->unserialize();
 define("MENUBAR_CONTAINER_1","MenuBarContainer1");

 $interfaceMenuBarContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,MENUBAR_CONTAINER_1);
 //$interfaceMenuBarContainer1 = new Interfaces_container(MENUBAR_CONTAINER_1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu2);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu3);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu4);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu5);
 $interfaceMenuBar1->setInterfacesContainer($interfaceMenuBarContainer1);

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,OP_NONE,NUM_1);
 //$interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
 //$interfaceHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceHtmlFragment1->setHtmlFragment("<label for=\"CREnabled\">CREnabled</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"CREnabled\" id=\"CREnabled\" type=\"checkbox\" ></input>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for=\"DojoEnabled\">DojoEnabled</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"DojoEnabled\" id=\"DojoEnabled\" type=\"checkbox\" ></input>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for=\"JQueryEnabled\">JQueryEnabled</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"JQueryEnabled\" id=\"JQueryEnabled\" type=\"checkbox\" ></input>");

 $interfaceHtmlFragment2 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_2); 
 //$interfaceHtmlFragment2 = new Html_fragment(OP_NONE,NUM_2);
 $interfaceHtmlFragment2->setHtmlFragment("<label for=\"DataPageEnabled\">" . LABEL_CREA_OP_PAGE . "</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"DataPageEnabled\" id=\"DataPageEnabled\" type=\"checkbox\" ></input>");

 $interfaceHtmlFragment3 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_3);
 //$interfaceHtmlFragment3 = new Html_fragment(OP_NONE,NUM_3);
 $interfaceHtmlFragment3->setHtmlFragment("<label for=\"AjaxOps\">" . LABEL_OPERAZIONI_AJAX . "</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name=\"AjaxOps\" id=\"AjaxOps\" rows=\"3\" cols=\"20\">array()</textarea>");

 $interfaceHtmlFragment4 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_4);
 //$interfaceHtmlFragment4 = new Html_fragment(OP_NONE,NUM_4);
 $interfaceHtmlFragment4->setHtmlFragment("<hr/>");

 $interfaceHtmlFragment5 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_5); 
 //$interfaceHtmlFragment5 = new Html_fragment(OP_NONE,NUM_5);
 $interfaceHtmlFragment5->setHtmlFragment("<hr/>");

 $interfaceHtmlFragment6 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_6); 
 //$interfaceHtmlFragment6 = new Html_fragment(OP_NONE,NUM_6);
 $interfaceHtmlFragment6->setHtmlFragment("<label for=\"AjaxOpsHandlerEnabled\">" . LABEL_GENERA_JAVASCRIPT_AJAX_HANDLER . "</label>" .
 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"AjaxOpsHandlerEnabled\" type=\"checkbox\" id=\"AjaxOpsHandlerEnabled\"></input><hr/>");

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_NOME_PAGINA,FIELD_INTERFACCIA_RADICE,
 FIELD_SPAZIATORE_1,FIELD_CHECKBOX_1,
 FIELD_CHECKBOX_2,FIELD_SPAZIATORE_2,FIELD_AJAXOPS,FIELD_CHECKBOX_3);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NOME_PAGINA=>50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,
 Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,
 Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array(),array(),
 $interfaceHtmlFragment4,$interfaceHtmlFragment1,
 $interfaceHtmlFragment2,$interfaceHtmlFragment5,$interfaceHtmlFragment3,
 $interfaceHtmlFragment6);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT,
 ACCESS_OPT,ACCESS_OPT,ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(FIELD_NOME_PAGINA=>array("var id = this.value;ajaxHandler.synServerCall('" . 
 AJAX_HANDLER_PAGE . 
 "','" . AJAX_OP_GET_ALL_INTERFACES_OF_PAGE . "',id,'xml',/[.<>]*/);"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $fieldsLabels = array(FIELD_NOME_PAGINA=>LABEL_NOME_PAGINA,
 FIELD_INTERFACCIA_RADICE=>LABEL_INTERFACCIA_RADICE);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_CREA_PAGINA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $interfaceBt1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL,OP_NONE,NUM_2);
 //$interfaceBt1 = new Html_button_tag(OP_NONE,NUM_2);
 $interfaceBt1->setTagBody(LABEL_PROVA_PAGINA);
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_PAGINE);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceForm1);
 $interfaceFrameContainer2->add($interfaceBt1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
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

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);   
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3); 
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceHtmlFragment2);
 $interfacesContainer->add($interfaceHtmlFragment3);
 $interfacesContainer->add($interfaceHtmlFragment4);
 $interfacesContainer->add($interfaceHtmlFragment5);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceBt1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_pagine_create_op_page();
 $ajaxOps = array(AJAX_OP_CREATE_PAGE,AJAX_OP_ADD_AJAX_OPS_FROM_PHP_ARRAY,
 AJAX_OP_GET_ALL_INTERFACES_OF_PAGE,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME);
 
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>