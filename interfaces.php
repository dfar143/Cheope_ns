<?
namespace Cheope_ns\fw;

 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_interfaces_op_page.class.php");

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
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,
 Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Catalog","Inspect",
 "Layouts","Menus","Forms","Pdf"),
 array("catalog.php","inspect.php","layouts.php","menus.php","forms.php","pdf.php"),
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
 //$interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"interfaces",NUM_1);
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

 $interfaceDivTagContainer0 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer0 = new Interfaces_container(STRING_NULL); 
 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag0 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag0 = new Html_div_tag();
 $interfaceDivTag0->setInterfacesContainer($interfaceDivTagContainer0);

 $interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $interfaceTabs1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_LOCAL_TABS_2,STRING_NULL);
 //$interfaceTabs1 = new Cheope_ns_local_tabs_2();
 $interfaceTabs1->setDataFields(array("Field_0","Field_1"));
 $interfaceTabs1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET));
 $interfaceTabs1->setDataFieldsDomainsValues(array(
 array(LABEL_CAMPI_SUDDIVISI),
 array("#id-0")));
 $interfaceTabs1->setCollapsible(false);
 
 $intTabsContainer1 = $interfaceTabs1->getInterfacesContainer(); 
 $intTabsContainer1->add($interfaceDivTag0);
 $intTabsContainer1->add($interfaceDivTag1);

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
// $interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_NOME_PAGINA,FIELD_GENITORI,FIELD_LISTA_INTERFACCE);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NOME_PAGINA=>30,FIELD_GENITORI=>50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(STRING_NULL,array(),$interfaceTabs1);
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(FIELD_NOME_PAGINA=>array(""),
 FIELD_GENITORI=>array("form_inserimento_1_genitori_onChange(this);"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $fieldsLabels = array(FIELD_NOME_PAGINA=>LABEL_NOME_PAGINA,
 FIELD_GENITORI=>LABEL_GENITORI . STRING_SPACE . 
 LABEL_INT,
 FIELD_LISTA_INTERFACCE=>STRING_NULL);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $submitButtonEvents = array("form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_RICARICA_LISTA);
 $interfaceForm1->setAutoTabIndex(false);

 $interfaceBt1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
// $interfaceBt1 = new Html_button_tag();
 $interfaceBt1->setTagBody(LABEL_SALVA_INTERFACCIA);
 $attribs = array("onclick"=>"button_1_onClick();");
 $interfaceBt1->setAttribs($attribs);

 $interfaceBt2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
 //$interfaceBt2 = new Html_button_tag();
 $interfaceBt2->setTagBody(LABEL_PROVA_ANTEPRIMA);
 $attribs = array("onclick"=>"button_2_onClick('" . 
 ((isset($_SESSION[SESSION_VAR_ACTIVE_APP]))?
 ($_SESSION[SESSION_VAR_ACTIVE_APP]):(STRING_NULL)) . 
 "','" . $_SERVER["SERVER_NAME"] . "','" . 
 getDocumentRoot() . "');","id"=>"Test_preview");
 $interfaceBt2->setAttribs($attribs);

 /*echo($_SERVER["SERVER_NAME"]);
 echo("</br>");
 echo($_SERVER["SCRIPT_NAME"]);
 die(getDocumentRoot());*/

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_INTERFACCE);
 $interfaceFrame2->setDispFields($dispFields);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceForm1);
 $interfaceFrameContainer2->add($interfaceBt1);
 $interfaceFrameContainer2->add($interfaceBt2);
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

 $interfaceHtmlData1 = Creator::create(Interfaces_info::INT_HTML_DATA_TEMPLATE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceHtmlData1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceHtmlData1->setDataFields(array(FIELD_OBJ_1));
 $interfaceHtmlData1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_OBJ));
 $interfaceHtmlData1->setDataFieldsDomainsValues(array());
 $interfaceHtmlData1->setHtmlTemplate("<ul id=\"main_list\">{OBJ_1}</ul><hr/>" .
 "<div id=\"fields_template\"></div>");

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "var parsValues = util.getUrlArgsValues(window.location.search);" .
 "var intName = parsValues[0];" .
 "if((intName != '')&&(intName != undefined)){" .
 "ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE . 
 "','getParents',intName,'xml',/[.]*ind_records[.]*/);" .
 "}");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_2); 
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_2);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("var interfaceName = \$(\"#Lista_interfacce\").val();" .
 "if(interfaceName != ''){alert(interfaceName);ajaxHandler.synServerCall('" . AJAX_HANDLER_PAGE . 
 "','getInterfaceIds',interfaceName,'xml',/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "var app = ajaxHandler.getOpByName('getInterfaceIds').results[0];" .
 "var page = ajaxHandler.getOpByName('getInterfaceIds').results[1];}" .
 "else{var app='';var page='';}" . 
 "var pMenu = new dijit.Menu({" .
 "targetNodeIds:[\"html_tags__0\"]});" .
 "pMenu.addChild(new dijit.MenuItem({label:\"" . 
 LABEL_RICARICA_LISTA . "\"," .
 "onClick:function(){form_inserimento_1_submit_button_onClick();" .
 "document.forms[\"default_form\"].submit();}}));" .
 "pMenu.addChild(new dijit.MenuItem({label:\"" . 
 LABEL_SALVA_INTERFACCIA . "\"," .
 "onClick:function(){button_1_onClick()}}));" .
 "if((app != 'Std'))" .
 "pMenu.addChild(new dijit.MenuItem({label:\"" . 
 LABEL_PROVA_ANTEPRIMA . "\"," .
 "onClick:function(){button_2_onClick(\"" . 
 ((isset($_SESSION[SESSION_VAR_ACTIVE_APP]))?
 ($_SESSION[SESSION_VAR_ACTIVE_APP]):(STRING_NULL)) . "\",\"" . 
 $_SERVER["SERVER_NAME"] . "\",\"" . 
 getDocumentRoot() . "\")}}));" . "else " . 
 "\$('#Test_preview').get(0).disabled=true;" .
 "if(page != ''){" . 
 "pMenu.addChild(new dijit.MenuItem({label:\"" . LABEL_EDITA_PREVIEW_CSS . "\"," .
 "onClick:function(){var nomePagina = $(\"#Nome_pagina\").get(0).value;" .
 "var app = $(\"#active_application_id\").text();" .
 "subModal.showPopWin(\"view_module.php?Par=../\" + app + \"/css/\" + " .
 "app.toLowerCase() + \"_\" + nomePagina + \".css\"" .
 ",700,400,function(actVar){},true);" .  	
 "}}));" . 
 "pMenu.addChild(new dijit.MenuItem({label:\"" . LABEL_EDITA_PREVIEW_JS . "\"," .
 "onClick:function(){var nomePagina = $(\"#Nome_pagina\").get(0).value;" .
 "var app = $(\"#active_application_id\").text();" .
 "subModal.showPopWin(\"view_module.php?Par=../\" + app + \"/js/\" + " .
 "app.toLowerCase() + \"_\" + nomePagina + \".js\"" .
 ",700,400,function(actVar){},true);" .  	
 "}}));}" .
 "pMenu.startup();");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_3);  
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_3);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("var childrenNodes;var objMenu = dijit.byId(\"dataFields_menu_id\");" .
 "if(objMenu != undefined)childrenNodes = objMenu.getChildren();" .
 "\$(\"#html_tags__1 [role=dataFields]\"" .
 ").each(function(){" . 
 "var ids = this.id;" . 
 "var pMenu = new dijit.Menu({targetNodeIds:[ids],id:ids + \"_menu_id\"});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById(ids));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById(ids).value.length;" .
 "var leftStr = document.getElementById(ids).value.substring(0,s.start);" .
 "var rightStr = document.getElementById(ids).value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById(ids).value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();" .
 "});" .
 "var childrenNodes;var objMenu = dijit.byId(\"dataFieldsDomains_menu_id\");" .
 "if(objMenu!=undefined)childrenNodes=objMenu.getChildren();" .
 "\$(\"#html_tags__1 [role=dataFieldsDomains]\"" .
 ").each(function(){" . 
 "var ids = this.id;" .
 "var pMenu = new dijit.Menu({targetNodeIds:[ids],id:ids + \"_menu_id\"});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById(ids));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById(ids).value.length;" .
 "var leftStr = document.getElementById(ids).value.substring(0,s.start);" .
 "var rightStr = document.getElementById(ids).value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById(ids).value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();" .
 "});" .
 "var childrenNodes; var objMenu = dijit.byId(\"dataFieldsDomainsValues_menu_id\");" .
 "if(objMenu!=undefined)childrenNodes=objMenu.getChildren();" .
 "\$(\"#html_tags__1 [role=dataFieldsDomainsValues]\"" .
 ").each(function(){" . 
 "var ids = this.id;" .
 "var pMenu = new dijit.Menu({targetNodeIds:[ids],id:ids + \"_menu_id\"});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById(ids));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById(ids).value.length;" .
 "var leftStr = document.getElementById(ids).value.substring(0,s.start);" .
 "var rightStr = document.getElementById(ids).value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById(ids).value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();" .
 "});");

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_4);   
 //$interfaceJavascriptFrag4 = new Javascript_fragment("Op4",NUM_4);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment(STRING_NULL);

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_5);    
// $interfaceJavascriptFrag5 = new Javascript_fragment("Op5",NUM_5);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment(STRING_NULL);

 $interfaceJavascriptFrag6 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op6",NUM_6);     
 //$interfaceJavascriptFrag6 = new Javascript_fragment("Op6",NUM_6);
 $interfaceJavascriptFrag6->setHookId(STRING_NULL);
 $interfaceJavascriptFrag6->setJavascriptFragment(
 "var childrenNodes;var objMenu = dijit.byId(\"dataFields_menu_id\");" .
 "var nodes = getLabelsFromMenu(\"dataFields_menu_id\");" .
 "if((objMenu != undefined)&&(nodes.length>0)){childrenNodes = objMenu.getChildren();" .
 //"var childrenNodes = \$(\"#dataFields_menu_id\").children().children().children();console.log(childrenNodes);" .
 "var pMenu = new dijit.Menu({targetNodeIds:['DataFields_new'],id:'DataFields_new_menu_id'});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById('DataFields_new'));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById('DataFields_new').value.length;" .
 "var leftStr = document.getElementById('DataFields_new').value.substring(0,s.start);" .
 "var rightStr = document.getElementById('DataFields_new').value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById('DataFields_new').value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();" .
 "var childrenNodes;var objMenu = dijit.byId(\"dataFieldsDomains_menu_id\");" .
 "if(objMenu != undefined)childrenNodes = objMenu.getChildren();" .
 "var pMenu = new dijit.Menu({targetNodeIds:['DataFieldsDomains_new'],id:'DataFieldsDomains_new_menu_id'});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById('DataFieldsDomains_new'));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById('DataFieldsDomains_new').value.length;" .
 "var leftStr = document.getElementById('DataFieldsDomains_new').value.substring(0,s.start);" .
 "var rightStr = document.getElementById('DataFieldsDomains_new').value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById('DataFieldsDomains_new').value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();" .
 "var childrenNodes;var objMenu = dijit.byId(\"dataFieldsDomainsValues_menu_id\");" .
 "if(objMenu != undefined)childrenNodes = objMenu.getChildren();" .
 "var pMenu = new dijit.Menu({targetNodeIds:['DataFieldsDomainsValues_new'],id:'DataFieldsDomainsValues_new_menu_id'});" .
 "for(var node in childrenNodes)" .
 "{" .
 "pMenu.addChild(" .
 "function(actLabel)" .
 "{" .
 "return new dijit.MenuItem(" .
 "{" .
 "label:actLabel," .
 "onClick:function(){" . 
 "var selection = new Selection(document.getElementById('DataFieldsDomainsValues_new'));" .
 "var s = selection.create();" .
 "var lenStr = document.getElementById('DataFieldsDomainsValues_new').value.length;" .
 "var leftStr = document.getElementById('DataFieldsDomainsValues_new').value.substring(0,s.start);" .
 "var rightStr = document.getElementById('DataFieldsDomainsValues_new').value.substring(s.end,lenStr);"  .
 "var newStr = leftStr + actLabel + rightStr;" .
 "document.getElementById('DataFieldsDomainsValues_new').value = newStr;" .
 "}" .
 "}" .
 ")" .
 "}(childrenNodes[node].label)" .
 ");" .
 "}" .
 "pMenu.startup();}"
 ); 

 $interfaceJavascriptFrag7 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op7",NUM_7);      
// $interfaceJavascriptFrag7 = new Javascript_fragment("Op7",NUM_7);
 $interfaceJavascriptFrag7->setHookId(STRING_NULL);
 $interfaceJavascriptFrag7->setJavascriptFragment(
 "\$('#main_list textarea').each(function(){\$(this).get(0).value=\$(this).get(0).value.replace(/\"/g,\"'\")});");
  
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);	
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceDivTag0);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceBt1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($interfaceJavascriptFrag6);
 //$interfacesContainer->add($interfaceJavascriptFrag7);
 $interfacesContainer->add($interfaceHtmlData1);
 $interfacesContainer->add($interfaceTabs1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_interfaces_op_page();
 $ajaxOps = array(
 AJAX_OP_POST_SEND_INTERFACE_DATA,
 AJAX_OP_GET_PARENTS,
 AJAX_OP_GET_NODE_TYPE,
 AJAX_OP_GET_TABLE_FROM_ALIAS,
 AJAX_OP_CREATE_PREVIEW,
 AJAX_OP_GET_ALL_TABLE_FIELDS,
 AJAX_OP_GET_ALL_ALIAS_FIELDS,
 AJAX_OP_GET_ALL_QUERY_FIELDS,
 AJAX_OP_GET_ALL_MODULE_FIELDS,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_GET_INTERFACE_IDS,
 AJAX_OP_GET_BIND_NODE_NAME,
 AJAX_OP_GET_BIND_NODE_TYPE);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();
?>