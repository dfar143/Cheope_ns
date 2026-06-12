<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_startt_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu1->setFields(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS)->setDomains(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET)->
 setValues(array("Export","Export changes"),array("export.php","export_changes.php"),array(STRING_NULL,STRING_NULL));
 //$interfaceCurtainMenu1->setDataFields($dataFields);
 //$fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,
 //Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 //$interfaceCurtainMenu1->setDataFieldsDomains($fieldsDomains);
 //$fieldsDomainsValues = array(array("Export","Export changes"),
 //array("export.php","export_changes.php"),
 //array(STRING_NULL,STRING_NULL));
 //$interfaceCurtainMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
// $interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,"db_objects",NUM_1);
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
 
 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1);
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();
 $interfaceCurtainMenu5->setNum(NUM_3);
 
 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"start",NUM_1);
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
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_APPLICAZIONI,FIELD_NOME_APPLICAZIONE);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NOME_APPLICAZIONE=>20);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array(),Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OBB);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(FIELD_APPLICAZIONI=>
 array("var el = getElementById('" . FIELD_NOME_APPLICAZIONE . "');"  .
 "el.value=$('select#" . FIELD_APPLICAZIONI . " option[value=' + this.value + ']').text();"),
 FIELD_NOME_APPLICAZIONE=>array("form_inserimento_1_nome_applicazione_onChange(this);"));
 $interfaceForm1->setSubmitFormEvents(array("return form_inserimento_1_onSubmit();"));
 $interfaceForm1->setSubmitButtonEvents(array("$('.spin').show();return true;"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setStyle("float:left;width:230px;");
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_COMPOSIZIONE_APPLICAZIONE);
 $interfaceFrame2->setDispFields($dispFields);
 $attribs = array("style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame2->setAttribs($attribs);
 define("FRAME_CONTAINER_2","FrameCont2");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame4 = new Html_div_tag();
 $dispFields = array(LABEL_IMPOSTA_APPLICAZIONE);
 $interfaceFrame4->setDispFields($dispFields);
 $attribs = array("style"=>"padding:10px 10px 10px 10px;height:580px;");
 $interfaceFrame4->setAttribs($attribs);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame4);
 //$decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);
 
 $interfaceHtmlDataTemplate1 = Creator::create("Html_data_template",STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceHtmlDataTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_CHECKED_1,FIELD_CHECKED_2,FIELD_CHECKED_3,
 FIELD_CHECKED_4,FIELD_CHECKED_5,FIELD_CHECKED_6,FIELD_CHECKED_7,FIELD_CHECKED_8,FIELD_CHECKED_9);
 $interfaceHtmlDataTemplate1->setDataFields($dataFields);
 $interfaceHtmlDataTemplate1->setHtmlTemplate("<input type=\"radio\" name=\"dir\" " .
 "{CHECKED_1} id=\"check_1\" tabindex=\"4\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . FRAMEWORK_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_1\">" . FRAMEWORK_DIR . "</label>" .
 "<input type=\"radio\" name=\"check_1\" " .
 "{CHECKED_2} id=\"check_2\" tabindex=\"5\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . JAVASCRIPT_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_2\">" . JAVASCRIPT_DIR . "</label>" .
 "<input type=\"radio\" name=\"check_2\" " .
 "{CHECKED_3} id=\"check_3\" tabindex=\"6\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . CSS_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_3\">" . CSS_DIR . "</label>" .
 "<input type=\"radio\" name=\"check_3\" " .
 "{CHECKED_4} id=\"check_4\" tabindex=\"7\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . IMAGES_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text');\"/><label for=\"check_4\">" . IMAGES_DIR . "</label>" .
 "<input type=\"radio\" name=\"check_4\" " .
 "{CHECKED_5} id=\"check_5\" tabindex=\"8\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . XML_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_5\">" . XML_DIR . "</label>" .
 "<input type=\"radio\" name=\"check_5\" " .
 "{CHECKED_6} id=\"check_6\" tabindex=\"9\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . JSON_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_6\">" . JSON_DIR ."</label>" . 
 "<input type=\"radio\" name=\"check_6\" " .
 "{CHECKED_7} id=\"check_7\" tabindex=\"11\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . CSV_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_7\">" . CSV_DIR ."</label>" .
 "<input type=\"radio\" name=\"check_7\" " .
 "{CHECKED_8} id=\"check_8\" tabindex=\"12\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . INTERFACES_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_8\">" . INTERFACES_DIR ."</label>" .
 "<input type=\"radio\" name=\"check_8\" " .
 "{CHECKED_9} id=\"check_9\" tabindex=\"13\" onclick=\"ids='" . THIS_PAGE . STRING_SEMICOLON . AJAXOPS_DIR . "',ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_TEST_DIR . "',ids,'text',/(\.)*[\w](\.)*/);\"/><label for=\"check_9\">" . AJAXOPS_DIR ."</label><br/><br/>");
 
 $interfaceNLevelMenu1 = Creator::create("Cheope_ns_nLevels_forest_ctrl",STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceNLevelMenu1 = new Cheope_ns_nLevels_forest_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_PAGE,FIELD_LABEL,FIELD_ID);
 $interfaceNLevelMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceNLevelMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array(),array(),array());
 $interfaceNLevelMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelMenu1->setDispFields(FIELD_NO_VALUE);
 $interfaceNLevelMenu1->setGesPage(THIS_PAGE);
 $interfaceNLevelMenu1->setCssClass(CSS_FOREST_CTRL);
 $interfaceNLevelMenu1->setMainLabel(LABEL_TIPI_DI_MODULI);
 $interfaceNLevelMenu1->setTarget("_self");

 $interfaceBt2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$interfaceBt2 = new Html_button_tag();
 $interfaceBtAttribs2 = array("id"=>"button_1",
 "onclick"=>"create_file();");
 $interfaceBt2->setTagBody(LABEL_CREA_FILE);
 $interfaceBt2->setAttribs($interfaceBtAttribs2);

 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInput1 = new Html_input_tag();

 $interfaceFrame8 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame8 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame8->setDispFields($dispFields);
 define("FRAME_CONTAINER_8","FrameCont8");
 
 $interfaceFrameContainer8 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer8 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer8->add($interfaceBt2);
 $interfaceFrameContainer8->add($interfaceInput1);
 $interfaceFrame8->setInterfacesContainer($interfaceFrameContainer8);

 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceDivTagContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer2->add($interfaceFrame8);

 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceDivTag2 = new Html_div_tag();
 $interfaceDivAttribs2 = array("id"=>$interfaceDivTag2->getId(),
 "align"=>"left","style"=>"float:left");
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);
 $interfaceDivTag2->setAttribs($interfaceDivAttribs2);

// *****************

 $interfaceBt1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$interfaceBt1 = new Html_button_tag();
 $interfaceBtAttribs1 = array("id"=>"button_2", "onclick"=>"display_delete_confirm_dialog();");
 $interfaceBt1->setTagBody(LABEL_CANCELLA_FILE);
 $interfaceBt1->setAttribs($interfaceBtAttribs1);

 $interfaceSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$interfaceSpan1 = new Html_span_tag();
 $interfaceSpan1->setTagBody("---");

 $interfaceFrame7 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame7 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame7->setDispFields($dispFields);
 define("FRAME_CONTAINER_7","FrameCont7");
 
 $interfaceFrameContainer7 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer7 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer7->add($interfaceBt1);
 //$interfaceFrameContainer7->add($interfaceSpan1);
 $interfaceFrame7->setInterfacesContainer($interfaceFrameContainer7);

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer1->add($interfaceFrame7);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivAttribs1 = array("id"=>$interfaceDivTag1->getId(),
 "align"=>"left","style"=>"float:left");
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);
 $interfaceDivTag1->setAttribs($interfaceDivAttribs1);

//**************************

 $interfaceBt3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$interfaceBt3 = new Html_button_tag();
 $interfaceBtAttribs3 = array("id"=>"button_3","onclick"=>"rename_file();");
 $interfaceBt3->setTagBody(LABEL_RINOMINA_FILE);
 $interfaceBt3->setAttribs($interfaceBtAttribs3);

 $interfaceInput2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInput2 = new Html_input_tag();

 $interfaceDivTagContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer4->add($interfaceInput2);

 $interfaceDivTag4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag4 = new Html_div_tag();
 $interfaceDivAttribs4 = array("align"=>"left");
 $interfaceDivTag4->setInterfacesContainer($interfaceDivTagContainer4);
 $interfaceDivTag4->setAttribs($interfaceDivAttribs4);

 $interfaceFrame9 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame9 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame9->setDispFields($dispFields);
 define("FRAME_CONTAINER_9","FrameCont9");
 
 $interfaceFrameContainer9 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer9 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer9->add($interfaceBt3);
 $interfaceFrameContainer9->add($interfaceDivTag4);
 $interfaceFrame9->setInterfacesContainer($interfaceFrameContainer9);

 $interfaceDivTagContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer3->add($interfaceFrame9);

 $interfaceDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag3 = new Html_div_tag();
 $interfaceDivAttribs3 = array("id"=>$interfaceDivTag3->getId(),
 "align"=>"left","style"=>"float:left");
 $interfaceDivTag3->setInterfacesContainer($interfaceDivTagContainer3);
 $interfaceDivTag3->setAttribs($interfaceDivAttribs3);

//******************************

 $interfaceFrame6 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame6 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame6->setDispFields($dispFields);
 define("FRAME_CONTAINER_6","FrameCont6");
 
 $interfaceFrameContainer6 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer6 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer6->add($interfaceDivTag2);
 $interfaceFrameContainer6->add($interfaceDivTag3);
 $interfaceFrameContainer6->add($interfaceDivTag1);
 $interfaceFrame6->setInterfacesContainer($interfaceFrameContainer6);

 //Caricamento interfacce per controlli contenitore
 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceHtmlDataTemplate1);
 $interfaceFrameContainer2->add($interfaceFrame6);
 $interfaceFrameContainer2->add($interfaceSpan1);
 $interfaceFrameContainer2->add($interfaceNLevelMenu1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$interfaceHtmlFragment1 = new Html_fragment();
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"Delete\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_47 . "</p>" .
"</div>");

 $intSpin1 = Creator::create("Cheope_ns_spin",STRING_NULL,OP_NONE,NUM_1);
 //$intSpin1 = new Cheope_ns_spin(OP_NONE,NUM_1);
 
 $intHtmlFragment2 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$intHtmlFragment2 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment2->setHtmlFragment("<div class=\"spin\" " .
 "style=\"position:relative;top:-450px;\" data-spin></div><br/>");
  
 $intHtmlLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 $intHtmlLabel1->setId("label_1");
 $intHtmlLabel1->setAttribs(array("for"=>"Checked_1","style"=>"float:left"));
 $intHtmlLabel1->setTagBody(LABEL_ABILITA_LOG);
  
 $intHtmlCheck1 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 $intHtmlCheck1->setDataFields(array(FIELD_CHECKED_1));
 $intHtmlCheck1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_CHECK));
 $intHtmlCheck1->setDataFieldsDomainsValues(array(1));
 $intHtmlCheck1->setDataFieldEvents(array("ids=this.checked;ajaxHandler.serverCall('" . 
 AJAX_HANDLER_PAGE . "','" . AJAX_OP_LOG_ENABLE . "',ids,'text',/[\s]*/);",""));
 //echo $intHtmlCheck1->getCompleteInterfaceId();
  
 $interfaceFrameContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer4->add($interfaceForm1);
 $interfaceFrameContainer4->add($decoratedIntFrame2);
 $interfaceFrameContainer4->add($intHtmlLabel1);
 $interfaceFrameContainer4->add($intHtmlCheck1);
 $interfaceFrameContainer4->add($interfaceHtmlFragment1);
 $interfaceFrameContainer4->add($intHtmlFragment2);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $interfaceFrame5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame5 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame5->setDispFields($dispFields);
 $interfaceFrame5->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_5","FrameCont5");

 $interfaceFrameContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer5 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer5->add($interfaceMenuBar1);
 $interfaceFrameContainer5->add($decoratedIntFrame4);
 $interfaceFrame5->setInterfacesContainer($interfaceFrameContainer5);

 $intJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,'spin',NUM_1);
 //$intJavascriptFrag1 = new Javascript_fragment(OP_NONE,NUM_1);
 $intJavascriptFrag1->setJavascriptFragment("\$('.spin').hide();");

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true); 
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 
 $page = Creator::create("Cheope_ns_startt_op_page",STRING_NULL);
 //$page = new Cheope_ns_startt_op_page();
 $serializer = $page->getSerializer();
 $serializer->setPageName(DEFAULT_PAGE_NAME);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $page->serializer_loadData(ucFirst(APPLICATION_NAME));
 $page->unserialize();

 $interfacesContainer = $page->getInterfacesContainer();
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceNLevelMenu1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($interfaceHtmlDataTemplate1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($intSpin1);
 $interfacesContainer->add($intJavascriptFrag1);
 
 $interfacesContainer->add($interfaceBt2);
 $interfacesContainer->add($interfaceInput1);
 $interfacesContainer->add($interfaceFrame8);

 $interfacesContainer->add($interfaceBt1);
 $interfacesContainer->add($interfaceSpan1);
 $interfacesContainer->add($interfaceFrame7);
 $interfacesContainer->add($intHtmlCheck1);
 
 $interfacesContainer->add($interfaceBt3);
 $interfacesContainer->add($interfaceInput2);
 $interfacesContainer->add($interfaceDivTag4);
 $interfacesContainer->add($interfaceFrame9);
 
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceDivTag2);
 $interfacesContainer->add($interfaceDivTag3);
 $interfacesContainer->add($interfaceFrame6);
 $interfacesContainer->add($decoratedIntFrame4);
 $interfacesContainer->add($interfaceFrame5);

 $ajaxOps = array(AJAX_OP_SCAN_FOR_ITEM,AJAX_OP_TEST_DIR,AJAX_OP_LOG_ENABLE,AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>