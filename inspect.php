<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_inspect_op_page.class.php");

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
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Edit","Catalog","Inspect",
 "Layouts","Menus","Forms","Pdf"),
 array("interfaces.php","catalog.php","inspect.php",
 "layouts.php","menus.php","forms.php","pdf.php"),
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
 $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"interfaces",NUM_1);
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

 $label1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label1 = new Html_label_tag();
 $label1->setTagBody(LABEL_PAGINE . ENTITY_SPACE . ENTITY_SPACE);
 
 $inputCtrl1 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl1 = new Html_input_ctrl();
 $inputCtrl1->addField(FIELD_PAGINE,array(),Int_domain::FIELD_DOMAIN_SET);
 $inputCtrl1->setDataFieldEvents(array("var id = this.value;ajaxHandler.synServerCall('" . 
 AJAX_HANDLER_PAGE . 
 "','" . AJAX_OP_GET_ALL_INTERFACES_OF_PAGE . 
 "',id,'xml',/[.]*ind_records[.]*/);interfacesContainer.getInterface('Op6').putData();"));

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr1 = new Html_br_tag();
 
 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr2 = new Html_br_tag();
 
 $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr3 = new Html_br_tag();
 
 $intBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr4 = new Html_br_tag();

 $label2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label2 = new Html_label_tag();
 $label2->setTagBody(LABEL_INTERFACCE  . ENTITY_SPACE . ENTITY_SPACE);

 $inputCtrl2 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl2 = new Html_input_ctrl();
 $inputCtrl2->addField(FIELD_INTERFACCE,array(),Int_domain::FIELD_DOMAIN_SET);
 
 $label3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label3 = new Html_label_tag();
 $label3->setTagBody(LABEL_GENITORI  . ENTITY_SPACE . ENTITY_SPACE);
 
 $inputCtrl3 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl3 = new Html_input_ctrl();
 $inputCtrl3->addField(FIELD_GENITORI,array(),Int_domain::FIELD_DOMAIN_SET);
 
 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag2 = new Html_div_tag();
 
 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceDivTagContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer2->add($label1);
 $interfaceDivTagContainer2->add($inputCtrl1);
 $interfaceDivTagContainer2->add($intBr1);
 $interfaceDivTagContainer2->add($intBr2);
 $interfaceDivTagContainer2->add($label3);
 $interfaceDivTagContainer2->add($inputCtrl3);
 $interfaceDivTagContainer2->add($intBr3);
 $interfaceDivTagContainer2->add($intBr4);
 $interfaceDivTagContainer2->add($label2);
 $interfaceDivTagContainer2->add($inputCtrl2);
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);
  
 $interfaceHrTag1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);
 //$interfaceHrTag1 = new Html_hr_tag(); 

 $interfaceBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$interfaceBrTag1 = new Html_br_tag();

 $interfaceBrTag2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$interfaceBrTag2 = new Html_br_tag(); 
 
 $interfaceNLevelsMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_NLEVELS_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_1);
 
 $interfaceNLevelsMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_NLEVELS_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_2);
 //$interfaceNLevelsMenu2 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_2); 
 
 $interfaceDivTagContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer4 = new Interfaces_container(STRING_NULL);
   
 $interfaceDivTag4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,STRING_NULL);
 //$interfaceDivTag4 = new Html_div_tag();
 $interfaceDivTag4->setDispFields(array(LABEL_ALBERO_CONTENITORI));
 $interfaceDivTagContainer4->add($interfaceNLevelsMenu1);
 $interfaceDivTag4->setInterfacesContainer($interfaceDivTagContainer4);
 $decoratedIntDivTag4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag4);  
 //$decoratedIntDivTag4 = new Html_fieldset_decorator($interfaceDivTag4);
 $decoratedIntDivTag4->setCssClass(CSS_FRAME_DEC); 
 
 $interfaceDivTagContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer5 = new Interfaces_container(STRING_NULL);
 
 $interfaceDivTag5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,STRING_NULL); 
 //$interfaceDivTag5 = new Html_div_tag();
 $interfaceDivTag5->setDispFields(array(LABEL_ALBERO_FAMIGLIA));
 $interfaceDivTagContainer5->add($interfaceNLevelsMenu2);
 $interfaceDivTag5->setInterfacesContainer($interfaceDivTagContainer5);
 $decoratedIntDivTag5 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag5);
 //$decoratedIntDivTag5 = new Html_fieldset_decorator($interfaceDivTag5);
 $decoratedIntDivTag5->setCssClass(CSS_FRAME_DEC); 
 
 $interfaceDivTagContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceDivTagContainer3 = new Interfaces_container(STRING_NULL);
 
 $interfaceDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,STRING_NULL);
 //$interfaceDivTag3 = new Html_div_tag();
 $interfaceDivTagContainer3->add($decoratedIntDivTag4);
 $interfaceDivTagContainer3->add($decoratedIntDivTag5);
 $interfaceDivTag3->setInterfacesContainer($interfaceDivTagContainer3);

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,STRING_NULL);
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1->add($interfaceDivTag2);
 $interfaceDivTagContainer1->add($interfaceBrTag1);
 $interfaceDivTagContainer1->add($interfaceHrTag1);
 $interfaceDivTagContainer1->add($interfaceBrTag2);
 $interfaceDivTagContainer1->add($interfaceDivTag3);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "if($('#Interfacce').get(0) != undefined){" .
 "var nomeInterfaccia = $('#Interfacce').get(0).value;" .
 "if(nomeInterfaccia !== '')" .
 "{ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . AJAX_OP_GET_PARENTS
  . "',nomeInterfaccia,'xml',/[.]*ind_records[.]*/);" .
 "}}");
 
 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment(
 "transformMenu('nLevels_menu__1_ul_menu');transformMenu('nLevels_menu__2_ul_menu');");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1); 
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment(
 "\$(\"#nLevels_menu__1 a\").each(function(){" . 
 "var currentTypeId=this.id;var interfaccia = $(this).text();" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" . 
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_EDIT . "\"," .
 "onClick:function(){subModal.showPopWin('view_interface.php?Par=' + interfaccia," .
 "700,400,function(actVar){window.location.reload();},true);}" .
 "}));" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_PROVA_ANTEPRIMA . "\"," .
 "onClick:function(){" .
 "var appName = \$(\"#active_application_id\").text();" .
 "var serverName = interfacesContainer.getInterface(\"Op5\").getServerName();" .
 "var docRoot = interfacesContainer.getInterface(\"Op5\").getDocRoot();" .
 "preview_exec(interfaccia,appName,serverName,docRoot);" .
 "}}));pMenu.startup();});" . 
  "\$(\"#nLevels_menu__2 a\").each(function(){" . 
 "var currentTypeId=this.id;var interfaccia = $(this).text();" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" . 
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_EDIT . "\"," .
 "onClick:function(){subModal.showPopWin('view_interface.php?Par=' + interfaccia," .
 "700,400,function(actVar){window.location.reload();},true);}" .
 "}));" .
  "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_PROVA_ANTEPRIMA . "\"," .
 "onClick:function(){" .
 "var appName = \$(\"#active_application_id\").text();" .
 "var serverName = interfacesContainer.getInterface(\"Op5\").getServerName();" .
 "var docRoot = interfacesContainer.getInterface(\"Op5\").getDocRoot();" .
 "preview_exec(interfaccia,appName,serverName,docRoot);" .
 "}}));pMenu.startup();});");

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_1); 
 //$interfaceJavascriptFrag4 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("this.getServerName=function(){" .
 "return \"" . $_SERVER["SERVER_NAME"] . "\";};this.getDocRoot=function(){" .
 "return \"" . getDocumentRoot() . "\";};");

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op6",NUM_1);
 //$interfaceJavascriptFrag5 = new Javascript_fragment("Op6",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment(
 "var page=\$('#Pagine option:selected').text();" . 
 "var pMenu1 = new dijit.Menu({" .
 "targetNodeIds:['html_tags__3']});" .
 "var app=\$('#active_application_label_id').text();" .
 "if(page != ''){" . 
 "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_CSS . "'," .
 "onClick:function(){var nomePagina = $('#Pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\s*/g,'');" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/css/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.css'" .
 ",700,400,function(actVar){},true);" .  	
 "}}));" . 
  "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_JS . "'," .
 "onClick:function(){var nomePagina = $('#Pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\s*/g,'');" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/js/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.js'" .
 ",700,400,function(actVar){},true);" .  	
 "}}));}" .
 "pMenu1.startup();");
  
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_ISPEZIONE_INTERFACCE);
 $interfaceFrame2->setDispFields($dispFields);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceDivTag1);
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

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,OP_NONE,NUM_0,true,true);
// $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
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
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($inputCtrl1);
 $interfacesContainer->add($inputCtrl2);
 $interfacesContainer->add($inputCtrl3);
 $interfacesContainer->add($interfaceNLevelsMenu1);
 $interfacesContainer->add($interfaceNLevelsMenu2);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_inspect_op_page();
 $ajaxOps = array(AJAX_OP_GET_ALL_INTERFACES_OF_PAGE,
 AJAX_OP_GET_PARENTS,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_CREATE_PREVIEW,
 AJAX_OP_DOJO_IN_PREVIEW);
 
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>