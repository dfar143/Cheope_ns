<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_manage_ajaxOps_op_page.class.php");

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
 $fieldsDomainsValues = array(array("Create","Edit"),
 array("pagine_create.php","pagine_edit.php"),array(STRING_NULL,STRING_NULL));
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
 
 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageAjaxOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("manageAjaxOp2",NUM_1);
 $dataFields = array(FIELD_AJAXOPS,FIELD_CHECKED);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"70%\">" .
 "<input id=\"ajaxOp_id_{COUNT}\" value=\"{AJAXOPS}\" class=\"ajaxOp\" type=\"text\" onchange=\"input_ajaxOp_onChange(this);\">" .
 "</input>" .
 "</td><td width=\"10%\"><input id=\"ajaxOp_isJsonEnabled_id_{COUNT}\" {CHECKED} class=\"ajaxOp_isJsonEnabled\" type=\"checkbox\" " .
 "\"></td>" .
 "<td width=\"10%\"><img src=\"./img/close.gif\"" .
 " onclick=\"" .
 "var parent=\$(this).parent().parent();parent.remove();var i=0;" .
 "\$('#tbody_id > tr').each(function(){this.id='row_id_' + i;" .
 "\$(this).find('td > input[type=text]').get(0).id ='ajaxOp_id_' + i;" .
 "\$(this).find('td > input[type=checkbox]').get(0).id ='ajaxOp_jsonEnabled_id_' + i;" .
 "i++;});" .
 "\"></img></td>" .
 "<td width=\"10%\"><input type=\"button\" value=\"->\" onclick=\"ajaxOp_button_onClick(this)\"></input></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageAjaxOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("manageAjaxOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"fields\" cellpadding=\"5\" width=\"350\">" .
 "<thead>" .
 "<tr>" .
 "<th style=\"text-align:left;\">" . LABEL_AJAXOP . "</th>" .
 "<th>" . LABEL_JSON_ABILITATO . "</th>" .
 "<th></th><th></th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{accept:[],copyOnly:true,skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#fields > tbody > tr\").size();" .
  	"tr.id= \"row_id_\" + num;" .
    
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.type = \"text\";" .
    "input.value = actItem.fieldName;" . 
    "input.id=\"ajaxOp_id_\" + num;"  .
    "\$(input).addClass(\"ajaxOp\");" .
    "input.onchange=function(){input_ajaxOp_onChange(input)};" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    
    "var td2 = document.createElement(\"td\");" .
    "var input1 = document.createElement(\"input\");" .
    "input1.type = \"checkbox\";" .
    "input1.checked = actItem.isJsonEnabled;" .
    "input1.id=\"ajaxOp_isJsonEnabled_id_\" + num;" .
    "\$(input1).addClass(\"ajaxOp_isJsonEnabled\");" .
    "td2.appendChild(input1);" .
    "tr.appendChild(td2);" .
            
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj=\$(img).click(function(){" .
    "var parent=\$(this).parent().parent();parent.remove();var i=0;" .
    "\$(\"#tbody_id > tr\").each(function(){this.id=\"row_id_\" + i;" .
    "\$(this).find(\"td > input[type=text]\").get(0).id=\"ajaxOp_id_\" + i;" .
    "\$(this).find(\"td > input[type=checkbox]\").get(0).id=\"ajaxOp_isJsonEnabled_id_\" + i;" .
    "i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    
    "var td5 = document.createElement(\"td\");" .
    "var input2 = document.createElement(\"input\");" .
    "input2.type = \"button\";" .
    "input2.value = \"->\";" .
    "input2.onclick=function(){ajaxOp_button_onClick(input2);};" .
    "td5.appendChild(input2);" .
    "tr.appendChild(td5);" .    
    
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    "});");

 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_OPERAZIONI_AJAX);
 $interfaceFrame3->setDispFields($dispFields);
 $decoratedIntFrame3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame3);
 //$decoratedIntFrame3 = new Html_fieldset_decorator($interfaceFrame3);
 $decoratedIntFrame3->setCssClass(CSS_FRAME_DEC);  
 
 $interfaceLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$interfaceLabel1 = new Html_label_tag();
 $attribs = array("for"=>"input_ajaxOp_id","style"=>"display:block;margin-right:5px;");
 $interfaceLabel1->setAttribs($attribs);
 $interfaceLabel1->setTagBody(LABEL_NUOVO_AJAXOP);
 
 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInput1 = new Html_input_tag();
 $attribs = array("id"=>"input_ajaxOp_id","type"=>"text", "size"=>"15",
 "onChange"=>"input_ajaxOp_onChange(this)");
 $interfaceInput1->setAttribs($attribs);

 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
 //$intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE .  ENTITY_SPACE);

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr1 = new Html_br_tag();

 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr2 = new Html_br_tag();
 
 $interfaceLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
 //$interfaceLabel2 = new Html_label_tag();
 $attribs = array("for"=>"input_ajaxOp_isJsonEnabled_id","style"=>"margin-right:5px;");
 $interfaceLabel2->setAttribs($attribs);
 $interfaceLabel2->setTagBody(LABEL_JSON_ABILITATO);

 $interfaceInput2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$interfaceInput2 = new Html_input_tag();
 $attribs = array("id"=>"input_ajaxOp_isJsonEnabled_id","type"=>"checkbox");
 $interfaceInput2->setAttribs($attribs);

 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton1 = new Html_button_tag();
 $intButton1->setTagBody("+");
 $attribs = array("id"=>"button_1","onclick"=>"button_1_onClick();");
 $intButton1->setAttribs($attribs);

 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton2 = new Html_button_tag();
 $intButton2->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_2","onclick"=>"button_2_onClick();");
 $intButton2->setAttribs($attribs);

 $intButton4 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
 //$intButton4 = new Html_button_tag();
 $intButton4->setTagBody(LABEL_GENERA_FILES_CONFIGURAZIONE_AJAXOPS);
 $attribs = array("id"=>"button_4","onclick"=>"button_4_onClick();");
 $intButton4->setAttribs($attribs);

 $intButton5 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
 //$intButton5 = new Html_button_tag();
 $intButton5->setTagBody(LABEL_GENERA_FILE_AJAXOPS_CLASSES);
 $attribs = array("id"=>"button_5","onclick"=>"button_5_onClick();");
 $intButton5->setAttribs($attribs); 

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,OP_NONE,NUM_1); 
 //$interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer1->add($intBr1);
 $interfaceDivTagContainer1->add($interfaceLabel1);
 $interfaceDivTagContainer1->add($interfaceInput1);
 $interfaceDivTagContainer1->add($intSpan1);
 $interfaceDivTagContainer1->add($interfaceLabel2);
 $interfaceDivTagContainer1->add($interfaceInput2);
 $interfaceDivTagContainer1->add($intSpan1);
 $interfaceDivTagContainer1->add($intButton1);
 $interfaceDivTagContainer1->add($intSpan1);
 $interfaceDivTagContainer1->add($intButton2);
 $interfaceDivTagContainer1->add($intBr2);
 $interfaceDivTagContainer1->add($intBr2);
 $interfaceDivTagContainer1->add($intButton4);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_AJAXOPS);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($decoratedIntFrame3);
 $interfaceFrameContainer2->add($interfaceDivTag1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);

 $interfaceFrame5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame5 = new Html_div_tag();
 $dispFields = array(LABEL_CLASSI_AJAXOPS);
 $interfaceFrame5->setDispFields($dispFields);
 $decoratedIntFrame5 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame5);
 //$decoratedIntFrame5 = new Html_fieldset_decorator($interfaceFrame5);
 $decoratedIntFrame5->setCssClass(CSS_FRAME_DEC);  

 $interfaceJavascriptTemplate4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageAjaxClassesOp2",NUM_1);  
 //$interfaceJavascriptTemplate4 = new Javascript_data_template("manageAjaxClassesOp2",NUM_1);
 $dataFields = array(FIELD_AJAXOPS_CLASSES);
 $interfaceJavascriptTemplate4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate4->setDataExchangeType("xml");
 $interfaceJavascriptTemplate4->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate4->setJavascriptTemplate("<tr id=\"row_classes_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"80%\">" .
 "<input id=\"ajaxOp_class_id_{COUNT}\" value=\"{AJAXOPS_CLASSES}\" class=\"ajaxOpClass\" type=\"text\" onchange=\"input_ajaxOp_class_onChange(this);\">" .
 "</input>" .
 "<td width=\"20%\"><img src=\"./img/close.gif\"" .
 " onclick=\"" .
 "var parent=\$(this).parent().parent();parent.remove();var i=0;" .
 "\$('#tbody_class_id > tr').each(function(){this.id='row_classes_id_' + i;" .
 "\$(this).find('td > input[type=text]').get(0).id ='ajaxOp_class_id_' + i;" .
 "i++;});" .
 "\"></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageAjaxClassesOp1",NUM_1);  
 //$interfaceJavascriptTemplate3 = new Javascript_data_template("manageAjaxClassesOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate4);
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setHookId("html_tags__10");
 $interfaceJavascriptTemplate3->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<table id=\"fields_classes\" cellpadding=\"5\" width=\"350\">" .
 "<thead>" .
 "<tr>" .
 "<th style=\"text-align:left;\">" . LABEL_AJAXOP_CLASS . "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"tbody_class_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);   
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("dndSource1 = " .
 "new dojo.dnd.Source(\"tbody_class_id\",{accept:[],copyOnly:true,skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = \$(\"#fields_classes > tbody > tr\").size();" .
  	"tr.id= \"row_classes_id_\" + num;" .
    
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.type = \"text\";" .
    "input.value = actItem.fieldName;" . 
    "input.id=\"ajaxOp_class_id_\" + num;"  .
    "\$(input).addClass(\"ajaxOpClass\");" .
    "input.onchange=function(){input_ajaxOp_class_onChange(input)};" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
            
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj=\$(img).click(function(){" .
    "var parent=\$(this).parent().parent();parent.remove();var i=0;" .
    "\$(\"#tbody_class_id > tr\").each(function(){this.id=\"row_classes_id_\" + i;" .
    "\$(this).find(\"td > input[type=text]\").get(0).id=\"ajaxOp_class_id_\" + i;" .
    "i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    "});");

  $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);       
  //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_1);
  $interfaceJavascriptFrag3->setHookId(STRING_NULL);
  $interfaceJavascriptFrag3->setJavascriptFragment("\$(\"#tbody_class_id tr\").each(function(){" .
 "var currentTypeId=this.id;var ajaxOpClass = \$(this).find(\".ajaxOpClass\").val();var thisObj=this;" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" .
 "var app = $('#active_application_id').text().replace(/\\\\s*/g,'');" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_EDIT . "\"," .
 "onClick:function(){subModal.showPopWin('" . PAGE_VIEW_MODULE . "?Par=../' + app" .
 " + '/ajaxOps/' + 'ajaxOp' + ajaxOpClass + '.xml'," .
 "700,400,function(actVar){},true);}" .
 "}));" . 
 "pMenu.startup();});");
 
 $intButton3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);   
 //$intButton3 = new Html_button_tag();
 $intButton3->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_3","onclick"=>"button_3_onClick();");
 $intButton3->setAttribs($attribs);

 $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);   
 //$intBr3 = new Html_br_tag();

 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag2 = new Html_div_tag();
 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer2->add($intBr1);
 $interfaceDivTagContainer2->add($intButton3);
 $interfaceDivTagContainer2->add($intBr3);
 $interfaceDivTagContainer2->add($intBr3);
 $interfaceDivTagContainer2->add($intButton5);
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);

 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame4 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_CLASSI_AJAXOPS);
 $interfaceFrame4->setDispFields($dispFields);
 $decoratedIntFrame4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame4);
 //$decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer4->add($decoratedIntFrame5);
 $interfaceFrameContainer4->add($interfaceDivTag2);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($decoratedIntFrame4);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);  
// $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptTemplate4);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3); 
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_manage_ajaxOps_op_page();
 $ajaxOps = array(AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_MANAGE_AJAX_OP1,
 AJAX_OP_MANAGE_AJAX_OP2,
 AJAX_OP_SET_ALL_AJAX_OPS,
 AJAX_OP_SET_ALL_AJAX_OPS_CLASSES,
  AJAX_OP_MANAGE_AJAX_CLASSES_OP1,
  AJAX_OP_MANAGE_AJAX_CLASSES_OP2,
 AJAX_OP_GENERATE_AJAX_OPS_CONFIGURATION_FILES,
 AJAX_OP_GENERATE_AJAX_OPS_CLASSES_FILES);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>