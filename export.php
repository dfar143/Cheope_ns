<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_export_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Start","Export changes"),
 array("startt.php","export_changes.php"),
 array(STRING_NULL));
 $interfaceCurtainMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);

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

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
 //$interfaceFrame2 = new Html_div_tag();
 $interfaceFrame2->setShortName("Frame_2");
 $dispFields = array(LABEL_EXPORT);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $intHtmlInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$intHtmlInputTag1 = new Html_input_tag();
 $attribs = array("type"=>"checkBox");
 $intHtmlInputTag1->setAttribs($attribs);

 $intPhpDataFragment1 = Creator::create(Interfaces_info::INT_PHP_DATA_FRAGMENT,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intPhpDataFragment1 = new Php_data_fragment(OBJ_NONE,OP_NONE,NUM_1);
 $intPhpDataFragment1->addField(FIELD_TYPE,STRING_NULL,Int_domain::FIELD_DOMAIN_ATOMIC);
 $intPhpDataFragment1->setPhpFragment("\$htmlWriter = \$thisObj->getHtmlWriter();" .
 "\$type='#TYPE#';if(\$type==\"Application\")" . 
 "\$htmlWriter->put(\"<button onclick=\\\"button_exec_onClick(this);\\\">" . LABEL_EXEC . 
 "</button>\");");

 $intDataTemplate1 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intPhpDataFragment1 = new Php_data_fragment(OBJ_NONE,OP_NONE,NUM_1);
 $intDataTemplate1->addField(FIELD_PATH,STRING_NULL,Int_domain::FIELD_DOMAIN_ATOMIC);
 $intDataTemplate1->addField(FIELD_NAME,STRING_NULL,Int_domain::FIELD_DOMAIN_ATOMIC);
 $intDataTemplate1->setHtmlTemplate("<a href=\"{PATH}\" id=\"File_names_id\" onClick=\"subModal.showPopWin('" . PAGE_ANALISI_MODULI . FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE .
   "'?Par=../' + app + '/css/' + " .
   "app.toLowerCase() + '_' + nomePagina + '.css'" .
   ",700,400,function(actVar){},true);" .  "\">{NAME}</a>");

 $intSimpleTable1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SIMPLE_TABLE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intSimpleTable1 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_NAME,FIELD_DIR,FIELD_TYPE,FIELD_CHECK,FIELD_EXEC,FIELD_PATH);
 $intSimpleTable1->setDataFields($dataFields);
 $dataFieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,
 Int_domain::FIELD_DOMAIN_NONE);
 $intSimpleTable1->setDataFieldsDomains($dataFieldsDomains);
 $dataFieldsDomainsValues = array($intDataTemplate1,STRING_NULL,STRING_NULL,
 $intHtmlInputTag1,$intPhpDataFragment1,STRING_NULL);
 $intSimpleTable1->setDataFieldsDomainsValues($dataFieldsDomainsValues);
 $intSimpleTable1->setInheritData(true);
 $intSimpleTable1->setBorder(1);
 $intSimpleTable1->setJavascriptEnabled(false);
 $intSimpleTable1->setColumnsDims(array("30%","10%","20%","10%","20%","0%"));

 $intButtonTag1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
 //$intButtonTag1 = new Html_button_tag();
 $intButtonTag1->setTagBody(LABEL_EXPORT);
 $intButtonTag1->setAttribs(array("id"=>"button_1",
 "onclick"=>"button_1_display_dialog();"));
 
 $intBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBrTag1 = new Html_br_tag();

 $intHtmlLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 //$intHtmlLabel1 = new Html_label_tag();
 $intHtmlLabel1->setTagBody(LABEL_ESPORTA_TUTTI_FILES_DISTINTI);
 $intHtmlLabel1->setAttribs(array("for"=>"Tutti_files_checkBox_id"));

 $intHtmlInputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$intHtmlInputTag2 = new Html_input_tag();
 $attribs = array("id"=>"Tutti_files_checkBox_id", "type"=>"checkBox","disabled"=>STRING_NULL,"checked"=>STRING_NULL,
 "onClick"=>"if($('#Tutti_files_checkBox_id').get(0).checked)checkBox_esporta_tutti_i_files_distinti_onClick();");
 $intHtmlInputTag2->setAttribs($attribs);

 $intHtmlLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 //$intHtmlLabel2 = new Html_label_tag();
 $intHtmlLabel2->setTagBody(LABEL_CANCELLA_VECCHI_FILES);
 $intHtmlLabel2->setAttribs(array("for"=>"Delete_old_files_checkBox_id"));

 $intHtmlInputTag3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$intHtmlInputTag3 = new Html_input_tag();
 $attribs = array("id"=>"Delete_old_files_checkBox_id", "type"=>"checkBox","onClick"=>"if($( '#Delete_old_files_checkBox_id' ).get(0).checked)checkBox_cancella_vecchi_files_onClick();");
 $intHtmlInputTag3->setAttribs($attribs);

 $intHtmlLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 //$intHtmlLabel3 = new Html_label_tag();
 $intHtmlLabel3->setTagBody(LABEL_ESPORTA_AMBIENTE);
 $intHtmlLabel3->setAttribs(array("for"=>"Export_environment_checkBox_id"));

 $intHtmlInputTag4 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$intHtmlInputTag4 = new Html_input_tag();
 $attribs = array("id"=>"Export_environment_checkBox_id", "type"=>"checkBox","onClick"=>"if($('#Export_environment_checkBox_id').get(0).checked)checkBox_esporta_ambiente_onClick();");
 $intHtmlInputTag4->setAttribs($attribs);

 $intHtmlLabel4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$intHtmlLabel4 = new Html_label_tag();
 $intHtmlLabel4->setTagBody(LABEL_CANCELLA_VECCHIO_AMBIENTE);
 $intHtmlLabel4->setAttribs(array("for"=>"Delete_old_environment_checkBox_id"));

 $intHtmlInputTag5 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$intHtmlInputTag5 = new Html_input_tag();
 $attribs = array("id"=>"Delete_old_environment_checkBox_id", "type"=>"checkBox","onClick"=>"if($('#Delete_old_environment_checkBox_id').get(0).checked)checkBox_cancella_vecchio_ambiente_onClick();");
 $intHtmlInputTag5->setAttribs($attribs);
 
 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 
 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 
 $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 
 $intHtmlA1 = Creator::create(Interfaces_info::INT_HTML_A_TAG,STRING_NULL);
 $attribs = array("id"=>"File_analisi_id","style"=>"text-decoration:underline","href"=>STRING_NULL);
 $intHtmlA1->setAttribs($attribs);
 
 $intHtmlA2 = Creator::create(Interfaces_info::INT_HTML_A_TAG,STRING_NULL);
 $attribs = array("id"=>"File_zip_id","style"=>"text-decoration:underline","href"=>STRING_NULL);
 $intHtmlA2->setAttribs($attribs);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("this.getServerName=function(){" .
 "return \"" . $_SERVER["SERVER_NAME"] . "\";};this.getDocRoot=function(){" .
 "return \"" . getDocumentRoot() . "\";};");

 $intSpin1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SPIN,OP_NONE,NUM_1);
 //$intSpin1 = new Cheope_ns_spin(OP_NONE,NUM_1);
 
 $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
 //$intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<div class=\"spin\" " .
 "style=\"position:relative;left:640px;top:-50px;\" data-spin></div><br/>");
 
  $intHtmlFragment2 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_2);
 //$interfaceHtmlFragment1 = new Html_fragment();
  $intHtmlFragment2->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"" . LABEL_PROCEDI . "?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_62 . "</p>" .
 "</div>");
 
  $intHtmlFragment3 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_3);
 //$interfaceHtmlFragment1 = new Html_fragment();
  $intHtmlFragment3->setHtmlFragment("<div id=\"dialog-confirm-2\" style=\"display:none;\" title=\"" . LABEL_PROCEDI . "?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_63 . "</p>" .
 "</div>");
 
  $intHtmlFragment4 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_4);
 //$interfaceHtmlFragment1 = new Html_fragment();
  $intHtmlFragment4->setHtmlFragment("<div id=\"dialog-confirm-3\" style=\"display:none;\" title=\"" . LABEL_PROCEDI . "?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_62 . "</p>" .
 "</div>");
 
  $intHtmlFragment5 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_5);
 //$interfaceHtmlFragment1 = new Html_fragment();
  $intHtmlFragment5->setHtmlFragment("<div id=\"dialog-confirm-4\" style=\"display:none;\" title=\"" . LABEL_PROCEDI . "?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_63 . "</p>" .
 "</div>");
 
  $intHtmlFragment6 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_6);
 //$interfaceHtmlFragment1 = new Html_fragment();
  $intHtmlFragment6->setHtmlFragment("<div id=\"dialog-confirm-5\" style=\"display:none;\" title=\"" . LABEL_PROCEDI . "?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_64 . "</p>" .
 "</div>");

 $intJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
 //$intJavascriptFrag2 = new Javascript_fragment(OP_NONE,NUM_1);
 $intJavascriptFrag2->setJavascriptFragment("\$('.spin').hide();");
 

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($intSimpleTable1);
 $interfaceFrameContainer2->add($intBrTag1);
 $interfaceFrameContainer2->add($intButtonTag1);
 $interfaceFrameContainer2->add($intHtmlLabel1); 
 $interfaceFrameContainer2->add($intHtmlInputTag2);
 $interfaceFrameContainer2->add($intHtmlLabel2); 
 $interfaceFrameContainer2->add($intHtmlInputTag3);
 $interfaceFrameContainer2->add($intHtmlLabel3); 
 $interfaceFrameContainer2->add($intHtmlInputTag4);
 $interfaceFrameContainer2->add($intHtmlLabel4); 
 $interfaceFrameContainer2->add($intHtmlInputTag5);
 $interfaceFrameContainer2->add($intBr1);
 $interfaceFrameContainer2->add($intBr2);
 $interfaceFrameContainer2->add($intHtmlA1);
 $interfaceFrameContainer2->add($intBr3);
 $interfaceFrameContainer2->add($intHtmlA2);
 $interfaceFrameContainer2->add($intHtmlFragment1);
 $interfaceFrameContainer2->add($intHtmlFragment2);
 $interfaceFrameContainer2->add($intHtmlFragment3);
 $interfaceFrameContainer2->add($intHtmlFragment4);
 $interfaceFrameContainer2->add($intHtmlFragment5);
 $interfaceFrameContainer2->add($intHtmlFragment6);
$interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setShortName("Frame_1");
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

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE); 
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($intSimpleTable1);
 $interfacesContainer->add($intHtmlInputTag1);
 $interfacesContainer->add($intButtonTag1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($intJavascriptFrag2);
 $interfacesContainer->add($intSpin1);
 $interfacesContainer->add($intHtmlA1);
 $interfacesContainer->add($intHtmlA2);
 $interfacesContainer->add($intDataTemplate1);
 $interfacesContainer->add($interfaceFrame1);


 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_export_op_page();
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $ajaxOps = array(AJAX_OP_EXPORT,
 AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>