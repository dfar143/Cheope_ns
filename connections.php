<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_connections_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
// $interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $interfaceCurtainMenu1->setDbStruct($dbStructTree);
 $interfaceCurtainMenu1->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu1->unserialize();

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
// $interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,"db_objects",NUM_1);
 $interfaceCurtainMenu2->setDbStruct($dbStructTree);
 $interfaceCurtainMenu2->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu2->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu2->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu2->unserialize();

 $interfaceCurtainMenu3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);  
// $interfaceCurtainMenu3 = new Cheope_ns_curtain_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Bindings"),
 array("bindings.php"),array(STRING_NULL));
 $interfaceCurtainMenu3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu3->setCssClass(CSS_CURTAIN_MENU);
 $interfaceCurtainMenu3->setFadeToColor("#FFFFFF");
 $interfaceCurtainMenu3->setJavascriptEnabled(false);

 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"interfaces",NUM_1); 
// $interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"interfaces",NUM_1);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);
 $interfaceCurtainMenu4->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu4->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu4->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu4->unserialize();

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1);  
// $interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . 
 Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"connections",NUM_1);
// $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"connections",NUM_1);
 $interfaceMenuBar1->setDbQueries($dbQueriesContainer);
 $interfaceMenuBar1->setDbStruct($dbStructTree);
 $interfaceMenuBar1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceMenuBar1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceMenuBar1->unserialize();
 define("MENUBAR_CONTAINER_1","MenuBarContainer1");

 $interfaceMenuBarContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,MENUBAR_CONTAINER_1);
// $interfaceMenuBarContainer1 = new Interfaces_container(MENUBAR_CONTAINER_1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu2);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu3);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu4);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu5);
 $interfaceMenuBar1->setInterfacesContainer($interfaceMenuBarContainer1); 

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container();
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);  

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
// $interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_CONNECTIONS,FIELD_NUOVA_CONNECTION,FIELD_AVAILABLE_DBS,
 FIELD_CONNECTION_BODY);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NUOVA_CONNECTION=>50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 array(),$interfaceDivTag1);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $fieldsLabels = array(FIELD_LISTA_CONNECTIONS=>LABEL_LISTA_CONNESSIONI,
 FIELD_NUOVA_CONNECTION=>LABEL_NUOVA_CONNESSIONE,
 FIELD_AVAILABLE_DBS=>LABEL_DB_DISPONIBILI);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $dataFieldsEvents = array(
 FIELD_NUOVA_CONNECTION=>array("form_inserimento_1_nuova_connection_onChange(this);"),
 FIELD_LISTA_CONNECTIONS=>array("form_inserimento_1_lista_connections_onChange(this);"),
 FIELD_AVAILABLE_DBS=>array("form_inserimento_1_available_dbs_onChange(this);"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("window.location.reload();");
 $interfaceForm1->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceDivTag2 = new Html_div_tag();
 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
// $interfaceDivTagContainer2 = new Interfaces_container();

 $interfaceSubmitButton1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
// $interfaceSubmitButton1 = new Html_input_tag();
 $attribs = array("type"=>"button","id"=>"button_1","value"=>LABEL_CREA_FILE_STRUTTURA_CONNESSIONI,
 "onclick"=>"button_1_onClick();");
 $interfaceSubmitButton1->setAttribs($attribs);

 $interfaceSubmitButton2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
// $interfaceSubmitButton2 = new Html_input_tag();
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTE_CONNESSIONI,
 "onclick"=>"button_2_onClick();");
 $interfaceSubmitButton2->setAttribs($attribs);
 
 $interfaceDivTagContainer2->add($interfaceSubmitButton1);
 $interfaceDivTagContainer2->add($interfaceSubmitButton2);
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);  

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_CONNESSIONI);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
// $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
// $interfaceBr1 = new Html_br_tag();
 
 $interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
// $interfaceHtmlFragment1 = new Html_fragment();
  $interfaceHtmlFragment1->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"Create table?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_50 . "</p>" .
 "</div>");
 
 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL,OP_NONE,NUM_1);
// $interfaceImg1 = new Html_img_tag(OP_NONE,NUM_1);
 $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif",
 "style"=>"float:left;cursor:pointer;margin-top:5px;","title"=>LABEL_IMPOSTA_NUOVA_TABELLA,
 "onclick"=>"var nuova_connection = \$('#Nuova_connection').get(0);" .
 "form_inserimento_1_nuova_connection_onChange(nuova_connection);"));

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceImg1); 
 $interfaceFrameContainer2->add($interfaceForm1);
 $interfaceFrameContainer2->add($interfaceBr1);
 $interfaceFrameContainer2->add($interfaceDivTag2);
 $interfaceFrameContainer2->add($interfaceHtmlFragment1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,
 STRING_NULL,OP_NONE,NUM_0,true,true);
// $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
  
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
// $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceSubmitButton1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
// $page = new Cheope_ns_connections_op_page();
 $ajaxOps = array(AJAX_OP_GET_DB_OP_PARS,AJAX_OP_GET_CONNECTION,
  AJAX_OP_SET_CONNECTION,AJAX_OP_CREATE_CONNECTIONS_STRUCT,
  AJAX_OP_CREATE_DB_STRUCT,
  AJAX_OP_CREATE_QUERIES_STRUCT,
  AJAX_OP_CREATE_DB_BINDS,AJAX_OP_CHECK_IF_CONNECTION_IS_USED,
 AJAX_OP_FIX_DB_XML_FILES,
 AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>