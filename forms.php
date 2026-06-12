<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_forms_op_page.class.php");

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
 
 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"forms",NUM_1);  
 //$interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"forms",NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Edit","Catalog",
 "Inspect","Layouts","Menus","Pdf"),
 array("interfaces.php","catalog.php","inspect.php",
 "layouts.php","menus.php","pdf.php"),
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu4->setCssClass(CSS_CURTAIN_MENU);
 $interfaceCurtainMenu4->setFadeToColor("#FFFFFF");
 $interfaceCurtainMenu4->setJavascriptEnabled(false);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1);  
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"interfaces",NUM_1);
// $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"interfaces",NUM_1);
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

// **************
// Menu sections
// **************

 $label1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label1 = new Html_label_tag();
 $label1->setTagBody(LABEL_PAGINE);

 $inputCtrl1 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL); 
 //$inputCtrl1 = new Html_input_ctrl();
 $inputCtrl1->addField(FIELD_PAGINE,array(),Int_domain::FIELD_DOMAIN_SET);
 $inputCtrl1->setDataFieldEvents(array("pagine_onChange(this);"));

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr1 = new Html_br_tag();

 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr2 = new Html_br_tag();

 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
 //$intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label2 = new Html_label_tag();
 $label2->setTagBody(LABEL_FORMS);

 $inputCtrl2 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl2 = new Html_input_ctrl();
 $inputCtrl2->addField(FIELD_FORMS,array(),Int_domain::FIELD_DOMAIN_SET);

 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan2 = new Html_span_tag();
 $intSpan2->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$label3 = new Html_label_tag();
 $label3->setTagBody(LABEL_OP  . ENTITY_SPACE); 

 $inputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$inputTag1 = new Html_input_tag();
 $inputTag1->setAttribs(array("id"=>LABEL_OP,"onchange"=>"input_op_onChange(this);"));

 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
 //$intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$label4 = new Html_label_tag();
 $label4->setTagBody(LABEL_NUM  . ENTITY_SPACE); 

 $inputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag2 = new Html_input_tag();
 $inputTag2->setAttribs(array("id"=>LABEL_NUM,"size"=>"7","value"=>"0",
 "onchange"=>"input_num_onChange(this);"));

 $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr3 = new Html_br_tag();

 $intBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);   
 //$intBr4 = new Html_br_tag();

 $label5 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label5 = new Html_label_tag();
 $label5->setTagBody(LABEL_SHORTNAME  . ENTITY_SPACE . ENTITY_SPACE); 

 $inputTag6 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag6 = new Html_input_tag();
 $inputTag6->setAttribs(array("id"=>LABEL_SHORTNAME,"size"=>"25",
 "onchange"=>"shortName_onChange(this);")); 

 $label10 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 //$label10 = new Html_label_tag() ;
 $label10->setTagBody(" - " . LABEL_USA_COME_NOME_FILE_INTERFACCIA . ":"); 

 $inputTag7 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag7 = new Html_input_tag();
 $inputTag7->setAttribs(array("id"=>"CheckBox_IFreeName",
 "type"=>"checkbox","value"=>"true","onclick"=>"checkbox_IFreeName_onClick(this);")); 

 $intBr13 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr13 = new Html_br_tag();

 $intBr14 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr14 = new Html_br_tag();

 $interfaceHrTag1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL); 
 //$interfaceHrTag1 = new Html_hr_tag();

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_FORM_SECTION_GRID);
 $interfaceFrame2->setDispFields($dispFields);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame3 = new Html_div_tag();
 $interfaceFrameContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer3);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($label1);
 $interfaceFrameContainer2->add($inputCtrl1);
 $interfaceFrameContainer2->add($intSpan1);
 $interfaceFrameContainer2->add($label2);
 $interfaceFrameContainer2->add($inputCtrl2);
 $interfaceFrameContainer2->add($intSpan2);
 $interfaceFrameContainer2->add($label3);
 $interfaceFrameContainer2->add($inputTag1);
 $interfaceFrameContainer2->add($intSpan3);
 $interfaceFrameContainer2->add($label4);
 $interfaceFrameContainer2->add($inputTag2);
 $interfaceFrameContainer2->add($intBr3);
 $interfaceFrameContainer2->add($intBr4);
 $interfaceFrameContainer2->add($label5);
 $interfaceFrameContainer2->add($inputTag6);
 $interfaceFrameContainer2->add($label10);
 $interfaceFrameContainer2->add($inputTag7);
 $interfaceFrameContainer2->add($intBr13);
 $interfaceFrameContainer2->add($intBr14); 
 $interfaceFrameContainer2->add($interfaceHrTag1); 
 $interfaceFrameContainer2->add($interfaceFrame3);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"gridViewColumnOp1",NUM_1); 
 //$interfaceJavascriptTemplate3 = new Javascript_data_template("gridViewColumnOp1",NUM_1);
 $dataFields = array(FIELD_ROW);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setHookId(STRING_NULL); 
 $interfaceJavascriptTemplate3->setEnableDataFromRemote(false); 
 $interfaceJavascriptTemplate3->setEnableExecuteOnLoad(false);
 $interfaceJavascriptTemplate3->setInheritData(true); 
 $interfaceJavascriptTemplate3->setExecOnlyOnFullDataSource(false); 
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<div  id=\"gridView_column_id_{COUNT}_{ROW}\" style=\"float:left;\">" .
 "<div id=\"gridView_ctrl_id_{COUNT}_{ROW}\" style=\"border:1px solid white;\">" .
 "<select onchange=\"\$(this).data('buffer').domain = this.value;" .
 "\$(this).data('buffer')['domain_' + this.value + '_buf'].domain = this.value;" .
 "\" id=\"ctrl_id_{COUNT}_{ROW}\">" .
 "<option>" . Int_domain::FIELD_DOMAIN_ATOMIC . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_ATOMIC_STATIC . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_SET . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_CHECK . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_RADIO . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_MULTIPLE . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_PASSWORD . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_FILE . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_HIDDEN . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_NONE . "</option>" .
 "<option>" . Int_domain::FIELD_DOMAIN_OBJ . "</option>" .
 "</select><br/>" .
 "<button onclick=\"open_ctrl_edit({COUNT},{ROW})\">" . LABEL_EDIT . 
 "</button><img title=\"Delete control\" id=\"delete_column_id_{COUNT}_{ROW}\" onClick=\"delete_ctrl({COUNT},{ROW});\" src=\"./img/close_green.gif\"/>" .
 "</div></div><span style=\"float:left;\" id=\"sep_id_{COUNT}_{ROW}\">&nbsp;-&nbsp;</span>" .
 "<button type=\"button\" id=\"ctrl_add_column_button_id_{ROW}\" onClick=\"add_column_to_grid_row({ROW},'atomic')\">+</button>"); 

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"gridViewRowOp1",NUM_1); 
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("gridViewRowOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_2);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate3);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setEnableDataFromRemote(false); 
 $interfaceJavascriptTemplate2->setEnableExecuteOnLoad(false); 
 $interfaceJavascriptTemplate2->setInheritCountFieldName("Row"); 
 $interfaceJavascriptTemplate2->setInheritData(true);
 $interfaceJavascriptTemplate2->setExecOnlyOnFullDataSource(false); 
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<img title=\"Delete row\" id=\"delete_row_id_{COUNT}\" " .
 "src=\"./img/close.gif\"/ style=\"float:left;\" onclick=\"delete_row({COUNT})\">" .
 "<div style=\"margin-left:15px;border:1px dotted white;height:50px;padding:5px;overflow:auto;\" id=\"gridView_row_id_{COUNT}\">" .
 "{OBJ_2}");  

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"gridViewOp1",NUM_1); 
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("gridViewOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__10");
 $interfaceJavascriptTemplate1->setInheritData(false);
 $interfaceJavascriptTemplate1->setEnableExecuteOnLoad(true);
 $interfaceJavascriptTemplate1->setEnableDataFromRemote(false); 
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<div id=\"gridView_id\" width=\"100%\">" .
 "{OBJ_1}" .
 "</div></div><hr/><button type=\"button\" id=\"ctrl_add_row_button_id\" onClick=\"add_row_to_grid()\">+</button><hr/>" .
 "<button onclick=\"save_button_onClick();\">" . LABEL_SALVA . "</button>&nbsp;&nbsp;&nbsp;" .
 "<button onclick=\"button_form_section_preview_onClick(this);\">" . LABEL_TEST_PREVIEW . "</button>"); 

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"createToolTip",NUM_1);  
 //$interfaceJavascriptFrag1 = new Javascript_fragment("createToolTip",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL); 
 $interfaceJavascriptFrag1->setEnableExecuteOnLoad(true);
 $interfaceJavascriptFrag1->setJavascriptFragment("new dijit.TooltipDialog({" .
 "content:" .
 "'<button>" . LABEL_SALVA . "</button>'" .
 "});");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"initCtrls",NUM_1);   
 //$interfaceJavascriptFrag2 = new Javascript_fragment("initCtrls",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL); 
 $interfaceJavascriptFrag2->setEnableExecuteOnLoad(true);
 $interfaceJavascriptFrag2->setJavascriptFragment("var bufObj = getDefaultsDomainBuffer(0,0);" .
 "$('#ctrl_id_0_0').data('buffer',bufObj);");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);    
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("this.getServerName=function(){" .
 "return \"" . $_SERVER["SERVER_NAME"] . "\";};this.getDocRoot=function(){" .
 "return \"" . getDocumentRoot() . "\";};");

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 $interfaceFrame1->setShortName("Frame_1");

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
 $interfacesContainer->add($interfaceCurtainMenu5);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($inputCtrl1);
 $interfacesContainer->add($inputCtrl2);
 $interfacesContainer->add($inputTag1);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_forms_op_page();
 $ajaxOps = array(AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME,
 AJAX_OP_VIEW_FORMS_SECTION_GRID_OP1,
 AJAX_OP_SAVE_FORM_SECTION,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_CREATE_PREVIEW,
 AJAX_OP_GET_FORM_SECTIONS);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>