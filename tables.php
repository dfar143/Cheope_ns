<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_tables_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $interfaceCurtainMenu1->setDbStruct($dbStructTree);
 $interfaceCurtainMenu1->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu1->unserialize();

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Db parameters","Fields","Queries","Import"),
 array("db_parameters.php","fields.php","queries.php","import.php"),
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu2->setCssClass(CSS_CURTAIN_MENU);
 //$interfaceCurtainMenu1->setFadeToColor("#FFFFFF");
 $interfaceCurtainMenu2->setJavascriptEnabled(false);

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

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1); 
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

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

 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL); 
 //$interfaceImg1 = new Html_img_tag();
 $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif",
 "style"=>"float:left;cursor:pointer;","title"=>LABEL_IMPOSTA_NUOVA_TABELLA,
 "onclick"=>"var nuova_tabella_obj = \$('#Nuova_tabella').get(0);var nuova_tabella = nuova_tabella_obj.value;" .
 "if(nuova_tabella != '') form_inserimento_1_nuova_tabella_onChange(nuova_tabella_obj);" .
 "else alert(loc.getString('msg',61));"));

 $intHtmlInputCtrl1 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL); 
 //$intHtmlInputCtrl1 = new Html_input_ctrl();
 $intHtmlInputCtrl1->addField(FIELD_LISTA_TABELLE,array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $dataFieldsEvents = array("form_inserimento_1_lista_tabelle_onChange(this);");
 $intHtmlInputCtrl1->setDataFieldEvents($dataFieldsEvents); 
 
 $intHtmlDataTemplate1 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL);
 //$intHtmlDataTemplate1 = new Html_data_template();
 $intHtmlDataTemplate1->addField(FIELD_LISTA_TABELLE,$intHtmlInputCtrl1);
 $intHtmlDataTemplate1->setHtmlTemplate("{LISTA_TABELLE}" . ENTITY_SPACE . ENTITY_SPACE .
 "<button type=\"button\" id=\"button_aliases\" onclick=\"form_inserimento_1_button_aliases_onClick();\">" . 
 LABEL_ALIASES . "</button>"); 
 
 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_TABELLE,FIELD_NUOVA_TABELLA);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NUOVA_TABELLA=>30);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlDataTemplate1,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $fieldsLabels = array(STRING_NULL,STRING_NULL);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array();
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_1_reset_button_onClick();");
 $interfaceForm1->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setAutoTabIndex(false);
 $interfaceForm1->setCellSpacing(6);
 
 $interfaceHr1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);
 //$interfaceHr1 = new Html_hr_tag();
 $attribs = array();
 $interfaceHr1->setAttribs($attribs);
 
 $interfaceButton1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceButton1 = new Html_input_tag();
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTE_TABELLE,
 "onclick"=>"button_2_onClick(this);");
 $interfaceButton1->setAttribs($attribs); 
 
 $interfaceButton2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceButton2 = new Html_input_tag();
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTE_RELAZIONI,
 "onclick"=>"button_3_onClick(this);");
 $interfaceButton2->setAttribs($attribs); 
 
 $interfaceButton3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceButton3 = new Html_input_tag();
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTE_INTERFACCE_ASSOCIATE,
 "onclick"=>"button_4_onClick(this);");
 $interfaceButton3->setAttribs($attribs);
 
/* $interfaceSpan1 = new Html_span_tag(OP_NONE,NUM_4);
 $attribs = array();
 $interfaceSpan1->setAttribs($attribs);
 $interfaceSpan1->setTagBody("&nbsp;&nbsp;&nbsp;&nbsp;");  */
 
 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDiv3 = new Html_div_tag();
 $intDiv3Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 //$intDiv3Container = new Interfaces_container(STRING_NULL);
 $intDiv3Container->add($interfaceImg1);
 $intDiv3Container->add($interfaceForm1);
 $intDiv3Container->add($interfaceHr1);
 $intDiv3Container->add($interfaceButton1);
 $intDiv3Container->add($interfaceButton2);
 $intDiv3Container->add($interfaceButton3);
 $interfaceDiv3->setInterfacesContainer($intDiv3Container);
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_TABELLE);
 $interfaceFrame2->setDispFields($dispFields);
 $attribs = array("id"=>$interfaceFrame2->getId(),
 "style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame2->setAttribs($attribs);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceDiv3);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_RELAZIONI_1N);
 $interfaceFrame3->setDispFields($dispFields);
 $attribs = array("id"=>$interfaceFrame3->getId(),
 "style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame3->setAttribs($attribs);
 $decoratedIntFrame3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame3);
 //$decoratedIntFrame3 = new Html_fieldset_decorator($interfaceFrame3);
 $decoratedIntFrame3->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame4 = new Html_div_tag();
 $dispFields = array(LABEL_RELAZIONI_MN);
 $interfaceFrame4->setDispFields($dispFields);
 $attribs = array("id"=>$interfaceFrame4->getId(),
 "style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame4->setAttribs($attribs);
 $decoratedIntFrame4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame4);
 //$decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 $interfaceFrame1->setDispFields($dispFields);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("tables.initInputTables();ids=$(\"select#Lista_tabelle option:selected\").text();" .
 "if(ids!=\"\")ajaxHandler.synServerCall(\"" . AJAX_HANDLER_PAGE . "\",\"" . 
 AJAX_OP_GET_1N_RELATIONS . "\",ids,\"xml\",/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);");
 
 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("ids=$(\"select#Lista_tabelle option:selected\").text();" .
 "if(ids!=\"\")ajaxHandler.synServerCall(\"" . AJAX_HANDLER_PAGE . "\",\"" . 
 AJAX_OP_GET_MN_RELATIONS . "\",ids,\"xml\",/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("\$(\"select#Lista_tabelle option\").each(" .
 "function(){var name=\$(this).text().replace(/\s*/g,\"\");if(name!=\"\"){\$(this)" .
 ".data(\"table_name\",name);\$(this).data(\"new_table_name\",\"*\");}});"); 
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($decoratedIntFrame3);
 $interfaceFrameContainer1->add($decoratedIntFrame4);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE); 
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($intHtmlInputCtrl1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame3);
 $interfacesContainer->add($decoratedIntFrame3);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($decoratedIntFrame4);
 $interfacesContainer->add($interfaceDiv3);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_tables_op_page();
 $ajaxOps = array(
 AJAX_OP_SET_DB_OBJS_DEF_PROPS,
 AJAX_OP_SET_FIELDS_DEF_ALL_FIELDS_PROPS,
 AJAX_OP_GET_1N_RELATIONS,AJAX_OP_GET_MN_RELATIONS,
 AJAX_OP_SET_1N_RELATIONS_DEFINITION_PROPS,
 AJAX_OP_SET_MN_RELATIONS_DEFINITION_PROPS,
 AJAX_OP_CHECK_IF_IS_1N_RELATION,
 AJAX_OP_CHECK_IF_IS_IN_RELATION,
 AJAX_OP_CHECK_IF_IS_1N_RELATION_FATHER_OF,
 AJAX_OP_CHECK_IF_EXIST_MN_RELATION_LINK_TABLE,
 AJAX_OP_SET_FIELDS_DEF,
 AJAX_OP_SET_FIELDS_DEF_WITHOUT_EXT_KEYS,
 AJAX_OP_SET_FIELDS_DEF_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_SET_FIELDS_CONSTS_DEF,
 AJAX_OP_RENAME_ALL_ITEMS,AJAX_OP_GET_FIELDS_DEF_PROPS,
 AJAX_OP_UPDATE_BINDS,AJAX_OP_CHECK_IF_TABLE_EXISTS,
 AJAX_OP_GET_NODE_TYPE,AJAX_OP_GET_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_CHECK_IF_NODE_IS_USED,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_DELETE_RELATIONS_DEFS,
 AJAX_OP_GET_PK_KEY_BY_TABLE_NAME,
 AJAX_OP_CREATE_DB_STRUCT,
 AJAX_OP_FIX_DB_XML_FILES);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>