<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_catalog_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,
 STRING_NULL,OBJ_NONE,"start",NUM_1);
// $interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $interfaceCurtainMenu1->setDbStruct($dbStructTree);
 $interfaceCurtainMenu1->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu1->unserialize();

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,
 STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
// $interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,"db_objects",NUM_1);
 $interfaceCurtainMenu2->setDbStruct($dbStructTree);
 $interfaceCurtainMenu2->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu2->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu2->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu2->unserialize();

 $interfaceCurtainMenu3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,
 STRING_NULL,OBJ_NONE,"connections",NUM_1); 
// $interfaceCurtainMenu3 = new Cheope_ns_curtain_menu(OBJ_NONE,"connections",NUM_1);
 $interfaceCurtainMenu3->setDbStruct($dbStructTree);
 $interfaceCurtainMenu3->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu3->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu3->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu3->unserialize();

 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,
 STRING_NULL,OBJ_NONE,"interfaces",NUM_1); 
// $interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"interfaces",NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Edit","Inspect","Layouts",
 "Menus","Forms","Pdf"),
 array("interfaces.php","inspect.php","layouts.php",
 "menus.php","forms.php","pdf.php"),
 array(STRING_NULL,STRING_NULL,STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu4->setCssClass(CSS_CURTAIN_MENU);
 $interfaceCurtainMenu4->setFadeToColor("#FFFFFF");
 $interfaceCurtainMenu4->setJavascriptEnabled(false);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,
 STRING_NULL,OBJ_NONE,"pages",NUM_1); 
// $interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,
 STRING_NULL,OBJ_NONE,"interfaces",NUM_1);
// $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"interfaces",NUM_1);
 $interfaceMenuBar1->setDbStruct($dbStructTree);
 $interfaceMenuBar1->setDbQueries($dbQueriesContainer);
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

 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame3->setDispFields($dispFields);
 $interfaceFrame3->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer1);

 $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
// $intLabel1 = new Html_label_tag();
 $intLabel1->setAttribs(array("for"=>"html_tags__1"));
 $intLabel1->setTagBody(LABEL_PAGINE . ENTITY_SPACE); 
 $intSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
// $intSelect1 = new Html_select_tag();
 $intSelect1->setAttribs(array("onchange"=>"select_1_onChange(this);"));

 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE);

 $intLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
// $intLabel2 = new Html_label_tag();
 $intLabel2->setAttribs(array("for"=>"html_tags__4"));
 $intLabel2->setTagBody(LABEL_NODI . ENTITY_SPACE);
 $intSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
// $intSelect2 = new Html_select_tag(); 
 $intSelect2->setAttribs(array("onchange"=>"select_4_onChange(this);"));
 
 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan2 = new Html_span_tag();
 $intSpan2->setTagBody(LABEL_SOSTITUIRE_OVUNQUE);
 
 $intInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
// $intInput1 = new Html_input_tag();
 $intInput1->setAttribs(array("type"=>"checkbox")); 

 $intDiv2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $intDiv2 = new Html_div_tag();
 $intDiv2->setAttribs(array("style"=>"display:none"));

 $intContDiv2 = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,
 STRING_NULL,Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $intContDiv2 = new Interfaces_container(STRING_NULL);
 $intContDiv2->add($intSpan2);
 $intContDiv2->add($intInput1); 
 $intDiv2->setInterfacesContainer($intContDiv2);

 $intDiv1= Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $intDiv1 = new Html_div_tag();

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_CATALOG);
 $interfaceFrame2->setDispFields($dispFields);
 
 $interfaceFrameContainer2 = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,
 STRING_NULL,Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($intDiv1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);

 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,
 STRING_NULL,$interfaceFrame2);
// $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceFrame1 = new Html_div_tag();
 $dispFields = array();
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

// Gestione visualizzazione tabella 

 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,
 STRING_NULL,"catalogOp3",NUM_1);
// $interfaceJavascriptTemplate3 = new Javascript_data_template("catalogOp3",NUM_1);
 $dataFields = array(FIELD_PAGINE);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setDataExchangeType("xml");
 $interfaceJavascriptTemplate3->setInheritData(false);
 $interfaceJavascriptTemplate3->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<option>{PAGINE}</option>"); 

 $interfaceJavascriptTemplate4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,
 STRING_NULL,"catalogOp4",NUM_1);
// $interfaceJavascriptTemplate4 = new Javascript_data_template("catalogOp4",NUM_1);
 $dataFields = array(FIELD_NODES);
 $interfaceJavascriptTemplate4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate4->setDataExchangeType("xml");
 $interfaceJavascriptTemplate4->setInheritData(false);
 $interfaceJavascriptTemplate4->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate4->setJavascriptTemplate("<option>{NODES}</option>"); 

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,
 STRING_NULL,"catalogOp2",NUM_1); 
// $interfaceJavascriptTemplate2 = new Javascript_data_template("catalogOp2",NUM_1);
 $dataFields = array(FIELD_INTERFACE_NAME,FIELD_NODI,FIELD_PAGINE);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 $interfaceJavascriptTemplate4,$interfaceJavascriptTemplate3);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(false); 
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setAjaxOpPar((isset($_GET["Page"])?$_GET["Page"]:STRING_NULL) 
 . STRING_SEMICOLON . (isset($_GET["Node"])?$_GET["Node"]:STRING_NULL));
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id='catalog_row_id_{COUNT}'>" .
 "<td width='5%'><span id='label_menu_{COUNT}'>" . LABEL_MENU . "</span>" .
 "</td>" .
 "<td align='center' width='30%'><input id='old_interface_name_{COUNT}' value='{INTERFACE_NAME}' type='hidden'></input>" .
 "<input size='40' onchange='interface_onChange(\\\"{COUNT}\\\");' type='text' id='interface_name_id_{COUNT}' value='{INTERFACE_NAME}'></input>" .
 "</td>" .
 "<td align='left' width='30%'>" .
 "<select type='pagina' onchange='select_pagina_id_onChange(this)' id='pagina_id_{COUNT}'>{PAGINE}</select></td>" .
 "<td align='left' width='30%'>" . 
 "<select type='nodo' onchange='select_nodo_id_onChange(this)' id='nodo_id_{COUNT}'>{NODI}</select></td>" .
 "<td align='center' width='5%'><input value='false' onclick='delete_onClick(\\\"{COUNT}\\\")' type='checkbox' id='delete_{COUNT}'>" .
 "</input><span>&nbsp;&nbsp;</span>" .
 "</td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,
 STRING_NULL,"catalogOp1",NUM_1);
// $interfaceJavascriptTemplate1 = new Javascript_data_template("catalogOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__8");
 $interfaceJavascriptTemplate1->setEnableDataFromRemote(false);
 $interfaceJavascriptTemplate1->setInheritData(false);
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id='catalogs' cellpadding='5' width='850'>" .
 "<thead>" .
 "<tr>" .
 "<th></th>" .
 "<th>" . LABEL_NOME_INTERFACCIA . "</th>" .
 "<th>" . LABEL_PAGINE . "</th>" .
 "<th>" . LABEL_NODI . "</th>" .
 "<th>" . LABEL_CANCELLA . "</th>" .
 "</tr></thead><tbody id='catalog_tbody_id'>{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1); 
// $interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("var parsValues = util.getUrlArgsKeyAndValues(window.location.search);" . 
 "var pagePar;" .
 "if(parsValues['page']!=undefined) pagePar = parsValues['page'];" .
 "if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];" .
 "if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];" .
 "if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];" .
  "var nodePar;" .
 "if(parsValues['node']!=undefined) nodePar = parsValues['node'];" .
 "if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];" .
 "if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];" .
 "if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];" .
 "if(pagePar != undefined){" .
 "\$('#catalog_tbody_id select[type=pagina]').each(function()" .
 "{\$('#' + this.id + ' option').each(function(){if(\$(this).text()==pagePar)this.selected=true;});});" .
 "\$('#html_tags__2 option').each(function(){if(\$(this).text()==pagePar)this.selected=true;});}" .
 "if(nodePar != undefined){" .
 "\$('#catalog_tbody_id select[type=nodo]').each(function()" .
 "{\$('#' + this.id + ' option').each(function(){if(\$(this).text()==nodePar)this.selected=true;});});" .
  "\$('#html_tags__5 option').each(function(){if(\$(this).text()==nodePar)this.selected=true;});}" .
  "var ajaxOp = ajaxHandler.getOpByName('catalogOp3');" . 
 "var pagine = ajaxOp.results;var selectTag = \$('#html_tags__12');" .
 "for(var pagina in pagine){if(pagePar==pagine[pagina].Pagine) " .
 "selectTag.append('<option selected>' + pagine[pagina].Pagine + '</option>'); else selectTag.append('<option>' + pagine[pagina].Pagine + '</option>');}" .
 "var ajaxOp2 = ajaxHandler.getOpByName('catalogOp4');" . 
 "var nodi = ajaxOp2.results;var selectTag2 = \$('#html_tags__15');" .
 "for(var nodo in nodi){if(nodePar==nodi[nodo].Nodes) " .
 "selectTag2.append('<option selected>' + nodi[nodo].Nodes + '</option>'); else selectTag2.append('<option>' + nodi[nodo].Nodes + '</option>');}" .
 "\$('#catalog_tbody_id input[type=text]').each(function(){if((this.value.split('!').length==5)||(this.value.split('!').length==6))this.disabled=true;});"
 );

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);  
// $interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("var i=0;" .
 "\$('#catalog_tbody_id input[type=hidden]').each(function(){var intName = this.value;var intNameEls = intName.split('" .  
 Interfaces_info::INTERFACE_INSTANCE_CHAR_SEP . "');var num = intNameEls.length;" .
 "if (num==1) {ajaxHandler.synServerCall('ajax_handler.php','getInterfaceItemsNum',intName,'text',/[65]/);" .
 "num = ajaxHandler.getOpByName('getInterfaceItemsNum').result;}" .
 "if((num=='5')||(num==5)){\$('#nodo_id_' + i + ' option').get(0).selected=true;" .
 "\$('#nodo_id_' + i).get(0).disabled=true;}" .
 "i++;});");

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1); 
// $interfaceJavascriptFrag4 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("var i=0;\$('#catalog_tbody_id tr').each(function(){" .
 "var pMenu=dijit.byId(\$(this).prop('pMenuId'));if(pMenu!==undefined)pMenu.destroy();i++;});" .
 "var j=0;\$('#catalog_tbody_id tr').each(function(){var m=j;var currentTypeId='label_menu_' + j;" .
 "var pMenu=new dijit.Menu({targetNodeIds:[currentTypeId]});" .
 "\$(this).prop('pMenuId',pMenu.id);" .
 "pMenu.addChild(new dijit.MenuItem({label:'" . LABEL_EDIT . "'," .
 "onClick:function(){label_edit_onClick(m)}}));" .
 "pMenu.addChild(new dijit.MenuItem({label:'" . LABEL_PROVA_ANTEPRIMA . "'," .
 "onClick:function(){anteprima_label_onClick(m,'" . 
 ((isset($_SESSION[SESSION_VAR_ACTIVE_APP]))?
 ($_SESSION[SESSION_VAR_ACTIVE_APP]):(STRING_NULL)) . 
 "','" . $_SERVER["SERVER_NAME"] . "','" . 
 getDocumentRoot() . "')}}));" .
 "j++;pMenu.startup();});");

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,
 STRING_NULL,"Op5",NUM_1);  
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment(
 "var page=\$('#html_tags__2 option:selected').text();" . 
 "var pMenu1 = new dijit.Menu({" .
 "targetNodeIds:['html_tags__10']});" .
 "var app=\$('#active_application_label_id').text();" .
 "if(page != ''){" . 
 "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_CSS . "'," .
 "onClick:function(){var nomePagina = $('#html_tags__2 option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\s*/g,'');" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/css/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.css'" .
 ",700,400,function(actVar){},true);" .  	
 "}}));" . 
  "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_JS . "'," .
 "onClick:function(){var nomePagina = $('#Html_tags__2 option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\s*/g,'');" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/js/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.js'" .
 ",700,400,function(actVar){},true);" .  	
 "}}));}" .
 "pMenu1.startup();");

 $intBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
// $intBrTag1 = new Html_br_tag();

 $intLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
// $intLabel3 = new Html_label_tag();
 $intLabel3->setTagBody(LABEL_IMPOSTA_TUTTE_PAGINE . ENTITY_SPACE . ENTITY_SPACE);
 $intLabel3->setAttribs(array("for"=>"html_tags__12"));
 
 $intSelect3 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
// $intSelect3 = new Html_select_tag();
 $intSelect3->setAttribs(array("onchange"=>"select_set_all_pagine_onChange(this);"));
 
 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intLabel4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
// $intLabel4 = new Html_label_tag();
 $intLabel4->setTagBody(LABEL_IMPOSTA_TUTTI_NODI . ENTITY_SPACE . ENTITY_SPACE);
 $intLabel4->setAttribs(array("for"=>"html_tags__15"));
 
 $intSelect4 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
// $intSelect4 = new Html_select_tag();
 $intSelect4->setAttribs(array("onchange"=>"select_set_all_nodi_onChange(this);"));
 
 $intSpan4 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan4 = new Html_span_tag();
 $intSpan4->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
// $intButton1 = new Html_button_tag();
 $intButton1->setTagBody(LABEL_BUTTON_APPLICA);
 $intButton1->setAttribs(array("onclick"=>"button_1_onClick();","id"=>"button_apply"));  

 /*$interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$interfaceHtmlFragment1 = new Html_fragment();
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"Interface exists\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_11 . "</p>" .
"</div>");*/ 

 $intHtmlFragment2 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$intHtmlFragment2 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment2->setHtmlFragment("<div class=\"spin\" " .
 "style=\"position:relative;top:-0px;width:50px;height:50px;\" data-spin></div><br/>");
 
 $intSpin1 = Creator::create("Cheope_ns_spin",STRING_NULL,OP_NONE,NUM_1);
 
 $intJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,'spin',NUM_1);
 //$intJavascriptFrag1 = new Javascript_fragment(OP_NONE,NUM_1);
 $intJavascriptFrag1->setJavascriptFragment("$('.spin').hide();");
 
 $intJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,'setAllPagesSpinEnabled',NUM_1);
 //$intJavascriptFrag1 = new Javascript_fragment(OP_NONE,NUM_1);
 $intJavascriptFrag2->setJavascriptFragment("var changed=false;$(document).ready(function(){" .
 "\$('#html_tags__12').on('focus',function(){\$('.spin').show();changed=true;});" .
 "\$('#html_tags__12').on('change',function(){\$('.spin').hide();changed=true;});" .
 "\$('#html_tags__12').on('blur',function(){\$('.spin').hide();});" .
 "\$('#html_tags__15').on('focus',function(){\$('.spin').show();});" .
 "\$('#html_tags__15').on('change',function(){\$('.spin').hide();});" .
 "\$('#html_tags__15').on('blur',function(){\$('.spin').hide();});" .
// "\$('select').on('mouseleave',function(){if(changed) {\$('.spin').hide();}});" .
 "});");
  
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($intBrTag1);
 $interfaceFrameContainer1->add($intLabel1); 
 $interfaceFrameContainer1->add($intSelect1); 
 $interfaceFrameContainer1->add($intSpan1); 
 $interfaceFrameContainer1->add($intLabel2); 
 $interfaceFrameContainer1->add($intSelect2);  
 $interfaceFrameContainer1->add($intDiv2); 
 $interfaceFrameContainer1->add($intBrTag1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($intBrTag1);
 $interfaceFrameContainer1->add($intLabel3);
 $interfaceFrameContainer1->add($intSelect3);
 $interfaceFrameContainer1->add($intSpan3);
 $interfaceFrameContainer1->add($intLabel4);
 $interfaceFrameContainer1->add($intSelect4);
 $interfaceFrameContainer1->add($intSpan4);
 $interfaceFrameContainer1->add($intButton1);
 $interfaceFrameContainer1->add($intHtmlFragment2);
// $interfaceFrameContainer1->add($interfaceHtmlFragment1);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,
 OP_NONE,NUM_0,true,true);
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
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceFrame3);
 $interfacesContainer->add($intSpin1);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptTemplate4);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($intSelect1);
 $interfacesContainer->add($intSelect2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($intJavascriptFrag1);
 $interfacesContainer->add($intJavascriptFrag2);
 $interfacesContainer->add($interfaceFrame1);



 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
// $page = new Cheope_ns_catalog_op_page();
 $ajaxOps = array(AJAX_OP_SET_ALL_CATALOG_INTERFACES,
 AJAX_OP_GET_INTERFACE_ITEMS_NUM,AJAX_OP_CREATE_PREVIEW,
 AJAX_OP_IS_INTERFACE_BUSY,AJAX_OP_INTERFACE_EXISTS,
 AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>