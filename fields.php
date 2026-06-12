<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_fields_op_page.class.php");

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
 $fieldsDomainsValues = array(array("Db parameters","Tables","Queries","Import"),
 array("db_parameters.php","tables.php","queries.php","import.php"),
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu2->setCssClass(CSS_CURTAIN_MENU);
 $interfaceCurtainMenu2->setFadeToColor("#FFFFFF");
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
// $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"db_objects",NUM_1);
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

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1); 
 // $interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_TABELLE);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLabels = array(FIELD_LISTA_TABELLE=>LABEL_TABELLE);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $fieldsLengths = array(FIELD_LISTA_TABELLE=>50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(
 FIELD_LISTA_TABELLE=>array("form_inserimento_1_lista_tabelle_onChange();"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_1_reset_button_onClick();");
 $interfaceForm1->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $intHtmlFragment4 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_4);
 //$intHtmlFragment4 = new Html_fragment(OP_NONE,NUM_4);
 $intHtmlFragment4->setHtmlFragment(STRING_NULL);

 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL,OP_NONE,NUM_4);
 //$interfaceImg1 = new Html_img_tag(OP_NONE,NUM_1);
 $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif","id"=>"Trasf_img_id",
 "title"=>LABEL_IMPOSTA_NUOVO_CAMPO,
 "onclick"=>"var nuovo_campo = \$('#Nuovo_campo').get(0);form_inserimento_2_nuovo_campo_onChange(nuovo_campo);",
 "style"=>"float:left;cursor:pointer;"));
 
 $interfaceForm2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_2);
// $interfaceForm2 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_LISTA_CAMPI,FIELD_NUOVO_CAMPO,FIELD_TIPI_CAMPO);
 $interfaceForm2->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_LISTA_CAMPI=>50,
 FIELD_NUOVO_CAMPO=>40,
 FIELD_TIPI_CAMPO=>50);
 $interfaceForm2->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_SET);
 $interfaceForm2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array(STRING_NULL=>STRING_NULL),Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 array(STRING_NULL=>0));
 $interfaceForm2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm2->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm2->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(
 FIELD_LISTA_CAMPI=>array("form_inserimento_2_lista_campi_onChange(this);"),
 FIELD_NUOVO_CAMPO=>array(STRING_NULL),
 FIELD_TIPI_CAMPO=>array("form_inserimento_2_tipi_campo_onChange(this);"));
 $interfaceForm2->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_2_reset_button_onClick();");
 $interfaceForm2->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_2_submit_button_onClick();");
 $interfaceForm2->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm2->setGesPage(THIS_PAGE);
 $interfaceForm2->setCssClass(CSS_FORM);
 $interfaceForm2->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm2->setDispFields(LABEL_CAMPI);
 $interfaceForm2->setAutoTabIndex(false);
 $interfaceForm2->setCellSpacing(6);

 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDiv3 = new Html_div_tag();
 $intDiv3Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDiv3Container = new Interfaces_container(STRING_NULL);
 $intDiv3Container->add($interfaceImg1);
 $intDiv3Container->add($interfaceForm2);
 $interfaceDiv3->setInterfacesContainer($intDiv3Container); 
 $interfaceDiv3->setDispFields(LABEL_CAMPI); 
 $decoratedForm2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDiv3);
 //$decoratedForm2 = new Html_fieldset_decorator($interfaceDiv3);
 $decoratedForm2->setCssClass(CSS_FRAME_DEC);

 $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
 //$intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<button id=\"Chiavi_candidate_button_1\" type=\"button\"" .
 " onclick=\"" .
 "insertHtmlTags1NewGroup();" .
 "\">" . LABEL_NUOVA_CHIAVE .
 "</button>");
 
 $intHtmlFragment3 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_3);
 //$intHtmlFragment3 = new Html_fragment(OP_NONE,NUM_3);
 $intHtmlFragment3->setHtmlFragment("<span id=\"candKeyFieldsHeader\">" .
 LABEL_CAMPI_TABELLA . ENTITY_SPACE . ENTITY_SPACE . "->" . ENTITY_SPACE . ENTITY_SPACE . LABEL_CHIAVE . "</span><br/><br/>");
 
 $intHtmlDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intHtmlDivTag1 = new Html_div_tag();
 $interfacesContainerDivTag1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfacesContainerDivTag1 = new Interfaces_container(STRING_NULL);
 $interfacesContainerDivTag1->add($intHtmlFragment3);
 $intHtmlDivTag1->setInterfacesContainer($interfacesContainerDivTag1);
 
 $interfaceForm3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_3);
 //$interfaceForm3 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_3);
 $dataFields = array(FIELD_GROUP_CONTAINER_0,FIELD_BUTTON);
 $interfaceForm3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlDivTag1,$intHtmlFragment1);
 $interfaceForm3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm3->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT);
 $interfaceForm3->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array();
 $interfaceForm3->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_3_reset_button_onClick();");
 $interfaceForm3->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_3_submit_button_onClick();");
 $interfaceForm3->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm3->setGesPage(THIS_PAGE);
 $interfaceForm3->setCssClass(CSS_FORM);
 $interfaceForm3->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm3->setDispFields(LABEL_CHIAVI_CANDIDATE);
 $interfaceForm3->setAutoTabIndex(false); 
 $interfaceForm3->setCellPadding(8);
 $decoratedForm3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceForm3);
 //$decoratedForm3 = new Html_fieldset_decorator($interfaceForm3);
 $decoratedForm3->setCssClass(CSS_FRAME_DEC);
 
 $intHtmlFragment5 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_5);
 //$intHtmlFragment5 = new Html_fragment(OP_NONE,NUM_5);
 $intHtmlFragment5->setHtmlFragment("<span id=\"extKeyFieldsHeader\">" .
 LABEL_TABELLE . ENTITY_SPACE . ENTITY_SPACE . "->" . ENTITY_SPACE . ENTITY_SPACE . LABEL_ESTERNE . "</span><br/><br/>");
 
 $intHtmlDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intHtmlDivTag2 = new Html_div_tag();
 $interfacesContainerDivTag2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 // $interfacesContainerDivTag2 = new Interfaces_container(STRING_NULL);
 $interfacesContainerDivTag2->add($intHtmlFragment5);
 $intHtmlDivTag2->setInterfacesContainer($interfacesContainerDivTag2);

 $interfaceForm4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_4);
 //$interfaceForm4 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_4);
 $dataFields = array(FIELD_GROUP_CONTAINER_0);
 $interfaceForm4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlDivTag2);
 $interfaceForm4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm4->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT);
 $interfaceForm4->setDataFieldsAccess($accessFields);
 $resetButtonEvents = array("form_inserimento_4_reset_button_onClick();");
 $interfaceForm4->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_4_submit_button_onClick();");
 $interfaceForm4->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm4->setGesPage(THIS_PAGE);
 $interfaceForm4->setCssClass(CSS_FORM);
 $interfaceForm4->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm4->setDispFields(LABEL_CHIAVI_ESTERNE);
 $interfaceForm4->setAutoTabIndex(false); 
 $decoratedForm4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceForm4);
// $decoratedForm4 = new Html_fieldset_decorator($interfaceForm4);
 $decoratedForm4->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_CAMPI);
 $interfaceFrame3->setDispFields($dispFields);
 $decoratedIntFrame3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame3);
 //$decoratedIntFrame3 = new Html_fieldset_decorator($interfaceFrame3);
 $decoratedIntFrame3->setCssClass(CSS_FRAME_DEC); 

 $interfaceFrameContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceFrameContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer3->add($decoratedForm2);
 $interfaceFrameContainer3->add($decoratedForm3);
 $interfaceFrameContainer3->add($decoratedForm4);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer3);
 
 $interfaceSubmitButton1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL, OP_NONE,NUM_1);
 //$interfaceSubmitButton1 = new Html_input_tag(OP_NONE,NUM_1);
 $attribs = array("type"=>"button","style"=>"display:inline;",
 "value"=>LABEL_CREA_FILE_STRUTTURA_DB,
 "onclick"=>"button_1_onClick(this);");
 $interfaceSubmitButton1->setAttribs($attribs);
 
 $interfaceSubmitButton2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL,OP_NONE,NUM_2);
 //$interfaceSubmitButton2 = new Html_input_tag(OP_NONE,NUM_2);
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTI_CAMPI,
 "onclick"=>"button_2_onClick(this);");
 $interfaceSubmitButton2->setAttribs($attribs);
 
 $interfaceSubmitButton3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,OP_NONE,NUM_3);
 //$interfaceSubmitButton3 = new Html_input_tag(OP_NONE,NUM_3);
 $attribs = array("type"=>"button","value"=>LABEL_CREA_TABELLA,
 "onclick"=>"button_3_onClick(this);");
 $interfaceSubmitButton3->setAttribs($attribs); 
 
 $interfaceDiv4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDiv4 = new Html_div_tag();
 $interfacesContainerDiv4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfacesContainerDiv4 = new Interfaces_container(STRING_NULL);
 $interfacesContainerDiv4->add($interfaceSubmitButton1);
 $interfacesContainerDiv4->add($interfaceSubmitButton2);
 $interfacesContainerDiv4->add($interfaceSubmitButton3);
 $interfaceDiv4->setInterfacesContainer($interfacesContainerDiv4);
 
 $interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$interfaceHtmlFragment1 = new Html_fragment();
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"Create table?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_48 . "</p>" .
"</div>"); 

 $interfaceHtmlFragment2 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$interfaceHtmlFragment2 = new Html_fragment();
 $interfaceHtmlFragment2->setHtmlFragment("<div id=\"dialog-confirm-2\" style=\"display:none;\" title=\"Create table?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_52 . "</p>" .
"</div>");
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $interfaceFrame1->setCssClass(CSS_FRAME);
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($interfaceForm1);
 $interfaceFrameContainer1->add($interfaceDiv4);
 $interfaceFrameContainer1->add($decoratedIntFrame3);
 $interfaceFrameContainer1->add($interfaceHtmlFragment1);
 $interfaceFrameContainer1->add($interfaceHtmlFragment2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("\$(\"select#Lista_campi\").after('<span id=\"tipo_campo_id\"></span>" .
 "<input id=\"pk\" type=\"checkbox\"></input><span>PK</span>');" .
 "\$(\"input#pk\").bind(\"click\",function(){" .
 "if(this.checked)\$(\"select#Lista_campi\").data(\"pk\",\$(\"select#Lista_campi option:selected\").text()); " .
 "else \$(\"select#Lista_campi\").data(\"pk\",\"\");});" .
 "\$(\"#Lista_tabelle option\").get(0).selected=true;" .
 "form_inserimento_1_lista_tabelle_onChange();");
 
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
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceForm2);
 $interfacesContainer->add($decoratedForm2);
 $interfacesContainer->add($interfaceForm3);
 $interfacesContainer->add($decoratedForm3);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intHtmlFragment3);
 $interfacesContainer->add($intHtmlFragment4);
 $interfacesContainer->add($intHtmlFragment5);
 $interfacesContainer->add($intHtmlDivTag1);
 $interfacesContainer->add($interfaceForm4);
 $interfacesContainer->add($decoratedForm4);
// $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceSubmitButton1);
 $interfacesContainer->add($interfaceSubmitButton2);
 $interfacesContainer->add($interfaceDiv4);
 $interfacesContainer->add($decoratedIntFrame3);
 $interfacesContainer->add($interfaceFrame1);
 
 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_fields_op_page();
 $ajaxOps = array(AJAX_OP_GET_ALL_FIELDS_DEF_PROPS,
 AJAX_OP_SET_FIELDS_DEF_FIELDS_PROPS,
 AJAX_OP_SET_FIELDS_DEF_CAND_KEY_FIELDS_PROPS,
 AJAX_OP_SET_FIELDS_DEF_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_SET_1N_RELATIONS_DEFINITION_PROPS,
 AJAX_OP_CREATE_DB_STRUCT,AJAX_OP_GET_FIELDS_DEF_PROPS,
 AJAX_OP_GET_CAND_KEY_FIELDS_PROPS,
 AJAX_OP_GET_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_GET_PK_KEY_FIELD,AJAX_OP_SET_PK,
 AJAX_OP_CHECK_IF_IS_1N_RELATION_FATHER_OF,
 AJAX_OP_CHECK_IF_IS_SUITABLE_PK_KEY,
 AJAX_OP_CHECK_IF_IS_SUITABLE_FIELD,AJAX_OP_SET_FIELDS_DEF,
 AJAX_OP_SET_FIELDS_DEF_WITHOUT_EXT_KEYS,
 AJAX_OP_SQL_SERVER_CREATE_TABLE,AJAX_OP_SET_FIELDS_CONSTS_DEF,
 AJAX_OP_GET_FIELDS_DEF_PROPS,
 AJAX_OP_CREATE_DB_BINDS,AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_FIX_DB_XML_FILES,
 AJAX_OP_GET_PK_KEY_BY_TABLE_NAME);
 $page->setAjaxOps($ajaxOps);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>