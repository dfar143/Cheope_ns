<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_layouts_op_page.class.php");

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
 $fieldsDomainsValues = array(array("Edit","Catalog","Inspect","Menus","Forms",
 "Pdf"),
 array("interfaces.php","catalog.php","inspect.php","menus.php",
 "forms.php","pdf.php"),
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

 $label1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label1 = new Html_label_tag();
 $label1->setTagBody(LABEL_PAGINE . ENTITY_SPACE . ENTITY_SPACE);
 
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
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $label2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label2 = new Html_label_tag();
 $label2->setTagBody(LABEL_LAYOUTS  . ENTITY_SPACE . ENTITY_SPACE);

 $inputCtrl2 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl2 = new Html_input_ctrl();
 $inputCtrl2->addField(FIELD_LAYOUTS,array(),Int_domain::FIELD_DOMAIN_SET);

 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan2 = new Html_span_tag();
 $intSpan2->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
  
 $label3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label3 = new Html_label_tag() ;
 $label3->setTagBody(LABEL_OP  . ENTITY_SPACE . ENTITY_SPACE); 
 
 $inputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$inputTag1 = new Html_input_tag();
 $inputTag1->setAttribs(array("id"=>LABEL_OP,"onchange"=>"input_op_onChange(this);"));
 
 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
  
 $label4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label4 = new Html_label_tag() ;
 $label4->setTagBody(LABEL_NUM  . ENTITY_SPACE . ENTITY_SPACE); 
 
 $inputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$inputTag2 = new Html_input_tag();
 $inputTag2->setAttribs(array("id"=>LABEL_NUM,"size"=>"7",
 "value"=>"0","onchange"=>"input_num_onChange(this);"));
 
 $interfaceBrTag3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$interfaceBrTag3 = new Html_br_tag(); 
 
 $interfaceBrTag4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$interfaceBrTag4 = new Html_br_tag();
  
 $label5 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label5 = new Html_label_tag() ;
 $label5->setTagBody(LABEL_SHORTNAME  . ENTITY_SPACE . ENTITY_SPACE); 
 
 $inputTag3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$inputTag3 = new Html_input_tag();
 $inputTag3->setAttribs(array("id"=>LABEL_SHORTNAME,"size"=>"25",
 "onchange"=>"shortName_onChange(this);")); 
 
 $label6 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label6 = new Html_label_tag() ;
 $label6->setTagBody(" - " . LABEL_USA_COME_NOME_FILE_INTERFACCIA . STRING_COLON); 
 
 $inputTag4 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$inputTag4 = new Html_input_tag();
 $inputTag4->setAttribs(array("id"=>"checkBox_IFreeName",
 "type"=>"checkbox","value"=>"true","onclick"=>"checkbox_IFreeName_onClick(this);")); 
  
 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag2 = new Html_div_tag();
 
 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer2->add($label1);
 $interfaceDivTagContainer2->add($inputCtrl1);
 $interfaceDivTagContainer2->add($intSpan1);
 $interfaceDivTagContainer2->add($label2);
 $interfaceDivTagContainer2->add($inputCtrl2);
 $interfaceDivTagContainer2->add($intSpan2);
 $interfaceDivTagContainer2->add($label3);
 $interfaceDivTagContainer2->add($inputTag1);
 $interfaceDivTagContainer2->add($intSpan3);
 $interfaceDivTagContainer2->add($label4);
 $interfaceDivTagContainer2->add($inputTag2);
 $interfaceDivTagContainer2->add($interfaceBrTag3);
 $interfaceDivTagContainer2->add($interfaceBrTag4);
 $interfaceDivTagContainer2->add($label5);
 $interfaceDivTagContainer2->add($inputTag3);
 $interfaceDivTagContainer2->add($label6);
 $interfaceDivTagContainer2->add($inputTag4);
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);
 
 $interfaceHrTag1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);
 //$interfaceHrTag1 = new Html_hr_tag(); 
 
 $interfaceBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$interfaceBrTag1 = new Html_br_tag(); 
 
 $interfaceBrTag2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$interfaceBrTag2 = new Html_br_tag(); 
 
 $interfaceDivTag5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceDivTag5 = new Html_div_tag();
  
 $interfaceDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
 //$interfaceDivTag3 = new Html_div_tag();
 $interfaceDivTag3->setDispFields(array(LABEL_INTERFACCE));
 $decoratedIntDivTag3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag3);
 //$decoratedIntDivTag3 = new Html_fieldset_decorator($interfaceDivTag3);
 $decoratedIntDivTag3->setCssClass(CSS_FRAME_DEC); 

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);
 
 $interfaceDivTag8 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag8 = new Html_div_tag();

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1->add($interfaceDivTag2);
 $interfaceDivTagContainer1->add($interfaceBrTag1);
 $interfaceDivTagContainer1->add($interfaceHrTag1);
 $interfaceDivTagContainer1->add($interfaceDivTag8);
 $interfaceDivTagContainer1->add($decoratedIntDivTag3);
 $interfaceDivTagContainer1->add($interfaceDivTag5); 
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);
 
 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"layoutsOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("layoutsOp2",NUM_1);
 $dataFields = array(FIELD_INTERFACCIA,FIELD_INTERFACE_CANONICAL_NAME,FIELD_TYPE);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"100%\" align=\"left\"><img width=\"49\" height=\"49\" style=\"display:block;\" title=\"{INTERFACE_CANONICAL_NAME}\" src=\"./img/{TYPE}.gif\"/>" .
 "<span id=\"span_id_{COUNT}\">{INTERFACCIA}</span></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"layoutsOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("layoutsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__11");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[]/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"interfaces_table\" cellpadding=\"5\" width=\"100%\">" .
 "<thead>" .
 "<tr>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>"); 

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "var container = new dijit.layout.StackContainer({style:\"width:500px;" .
 "height:500px;border:solid 1px black\;\"},\"html_tags__12\");" .
 "var child1 = new dijit.layout.ContentPane({id:\"simple_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" . 
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"simple_layout_div\");" .
 "child1.domNode.appendChild(div);" .
 "container.addChild(child1);" .
 "container.startup();" .
 "var child2 = new dijit.layout.ContentPane({id:\"two_columns_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" .
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"two_columns_layout_div\");" .
 "child2.domNode.appendChild(div);" .
 "container.addChild(child2);" .
 "container.startup();" .
 "var child3 = new dijit.layout.ContentPane({id:\"three_columns_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" .
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"three_columns_layout_div\");" .
 "child3.domNode.appendChild(div);" .
 "container.addChild(child3);" .
 "container.startup();" .
 "var child4 = new dijit.layout.ContentPane({id:\"tb_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" .
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"tb_layout_div\");" .
 "child4.domNode.appendChild(div);" .
 "container.addChild(child4);" .
 "container.startup();" .
 "var child5 = new dijit.layout.ContentPane({id:\"tb_simple_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" .
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"tb_simple_layout_div\");" .
 "child5.domNode.appendChild(div);" .
 "container.addChild(child5);" .
 "container.startup();" .
 "var pars1 = {withContainer:true,containerStyle:\"width:100%;height:100%\"," .
 "left:{style:\"\",container:[]}," .
 "center:{style:\"\",container:[]}," .
 "right:{style:\"\",container:[]}," .
 "top:{style:\"\",container:[]}," .
 "bottom:{style:\"\",container:[]}};" .
 "var pars2 = util.cloner().clone(pars1);" .
 "var pars3 = util.cloner().clone(pars1);" .
 "var pars4 = util.cloner().clone(pars1);" .
 "var pars5 = util.cloner().clone(pars1);" .
 "var pars6 = util.cloner().clone(pars1);" .
 "\$(\"#html_tags__12\").data(\"Pars\",pars1);" .
 "\$(\"#simple_layout\").data(\"Pars\",pars2);" .
 "\$(\"#two_columns_layout\").data(\"Pars\",pars3);" .
 "\$(\"#three_columns_layout\").data(\"Pars\",pars4);" .
 "\$(\"#tb_layout\").data(\"Pars\",pars5);" .
 "\$(\"#tb_simple_layout\").data(\"Pars\",pars6);" .
 "var buttonLeft = new dijit.form.Button({label:\"->\",style:\"color:black;\"," .
 "onClick:function(){dijit.byId(\"html_tags__12\").forward();" .
 "var domNode = dijit.byId(\"html_tags__12\").selectedChildWidget.domNode;" .
 "var pars1 = \$(domNode).data(\"Pars\");var pars2 = util.cloner().clone(pars1);" .
 "\$(\"#html_tags__12\").data(\"Pars\",pars2);" .
 "\$(\"#withContainer\").get(0).checked = pars1.withContainer;" .
 "if(pars1.withContainer)\$(\"#container_stuff\").show();else \$(\"#container_stuff\").hide();" .
 "\$(\"#containerStyle\").val(pars1.containerStyle);" .
 "}});" .
 "var buttonRight = new dijit.form.Button({label:\"<-\",style:\"color:black;\"," .
 "onClick:function(){dijit.byId(\"html_tags__12\").back();"  .
 "var domNode = dijit.byId(\"html_tags__12\").selectedChildWidget.domNode;" .
 "var pars1 = \$(domNode).data(\"Pars\");var pars2 = util.cloner().clone(pars1);" .
 "\$(\"#html_tags__12\").data(\"Pars\",pars2);" .
 "\$(\"#withContainer\").get(0).checked = pars1.withContainer;" .
 "if(pars1.withContainer)\$(\"#container_stuff\").show();else \$(\"#container_stuff\").hide();" .
 "\$(\"#containerStyle\").val(pars1.containerStyle);" .
 "}});" .
 "var div=document.createElement(\"div\");" .
 "\$(div).attr(\"id\",\"container_stuff\");" .
 "var label0 = document.createElement(\"label\");" .
 "label0.innerHTML=\"WithContainer:\";" .
 "var input0 = document.createElement(\"input\");" .
 "\$(input0).attr(\"type\",\"checkbox\");" .
 "\$(input0).attr(\"id\",\"withContainer\");" .
 "input0.checked=true;" .
 "\$(input0).bind(\"click\",function(){" .
 "\$(\"#container_stuff\").toggle();" .
 "var domNode = dijit.byId(\"html_tags__12\").selectedChildWidget.domNode;" .
 "var pars = \$(domNode).data(\"Pars\");" .
 "pars.withContainer = this.checked;" .
 "\$(domNode).data(\"Pars\",pars);});" .
 "\$(\"#html_tags__10\").append(label0);" .
 "\$(\"#html_tags__10\").append(input0);" .
 "\$(\"#html_tags__10\").append(div);" .
 "var label1 = document.createElement(\"label\");" .
 "label1.innerHTML=\"ContainerStyle:\";" . 
 "\$(\"#container_stuff\").append(label1);" .
 "var input1 = document.createElement(\"input\");" .
 "\$(input1).val(\"width:100%;height:100%\");" .
 "\$(input1).attr(\"id\",\"containerStyle\");" .
 "input1.style.width=\"250px\";" .
 "\$(input1).attr(\"type\",\"text\");" .
 "\$(input1).attr(\"maxlength\",255);" .
 "\$(input1).bind(\"change\",function(){" .
 "var domNode = dijit.byId(\"html_tags__12\").selectedChildWidget.domNode;" .
 "var pars = \$(domNode).data(\"Pars\");" .
 "pars.containerStyle = \$(input1).val();" .
 "\$(domNode).data(\"Pars\",pars);});" .
 "\$(\"#container_stuff\").append(input1);" .
 "var br = document.createElement(\"br\");" .
 "\$(\"#container_stuff\").append(br);" .
 "var hr = document.createElement(\"hr\");" .
 "\$(\"#html_tags__10\").append(hr);" . 
 "\$(\"#html_tags__10\").append(buttonLeft.domNode);" .
 "\$(\"#html_tags__10\").append(buttonRight.domNode);" .
 "var hr = document.createElement(\"hr\");" .
 "\$(\"#html_tags__10\").append(hr);" .
 "var button = document.createElement(\"button\");" .
 "button.innerHTML=\"" . LABEL_SALVA_LAYOUT . "\";" .
 "\$(button).attr(\"id\",\"Salva_layout_button\");" . 
 "\$(button).bind(\"click\",salva_layout_button_onClick);" .
 "\$(\"#html_tags__10\").append(button);" .
 "var button = document.createElement(\"button\");" .
 "button.innerHTML=\"" . LABEL_PROVA_ANTEPRIMA . "\";" .
 "\$(button).attr(\"id\",\"Prova_pagina_button\");" . 
 "\$(button).bind(\"click\",function(){create_preview();" .
 "var dirName = $('#active_application_id').text();" . 
 "if(dirName!=\"\")window.open(\"http://\" + \"" . $_SERVER["SERVER_NAME"] . 
 "\" + \"/\" + \"" . getDocumentRoot() . "\" + \"/\" + dirName + " .
 "\"/\" + \"preview\" + " .
 "\".php\");" .
 "});" .
 "\$(\"#html_tags__10\").append(button);");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1); 
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("var id = $(\"#Pagine\").val();ajaxHandler.serverCall(\"" . 
 AJAX_HANDLER_PAGE . 
 "\",\"" . AJAX_OP_GET_LAYOUTS . "\",id,\"xml\",/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);");
 
 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_2);
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_2);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("var dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{accept:[],copyOnly:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#interfaces_table > tbody > tr\").size();" .
  	"\$(tr).attr(\"id\",\"Row_id_\" + num);" .
    "var span = document.createElement(\"span\");" .
    "span.innerHTML = actItem.value;" .
    "var td = document.createElement(\"td\");" . 
    "var img = document.createElement(\"img\");" .
    "\$(img).attr(\"src\",\"./img/\" + actItem.type + \".gif\");" . 
    "\$(img).attr(\"width\",\"49\");" .
    "\$(img).attr(\"height\",\"49\");" .
    "img.style.display='block';" .
    "td.appendChild(img);" .
    "td.appendChild(span);" .
    "tr.appendChild(td);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    " });");

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1);
 //$interfaceJavascriptFrag4 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("\$(\"#tbody_id tr\").each(function(){" .
 "var currentTypeId=this.id;var interfaccia = $(this).find(\"span\").text();var thisObj=this;" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_CANCELLA . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).remove();}" .
 "}));" . 
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_EDIT . "\"," .
 "onClick:function(){subModal.showPopWin('view_interface.php?Par=' + interfaccia," .
 "700,400,function(actVar){},true);}" .
 "}));" . 
 "pMenu.startup();});");
 
 $interfaceJavascriptDataFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"TempInit",NUM_1);
 //$interfaceJavascriptDataFrag1 = new Javascript_data_fragment("TempInit",NUM_1);
 $interfaceJavascriptDataFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag1->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag1->setDataFields(array(FIELD_LAYOUT,FIELD_POS,FIELD_WIDTH,FIELD_HEIGHT,
 FIELD_INLINETEXTBOX_STYLE));
 $interfaceJavascriptDataFrag1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE , Int_domain::FIELD_DOMAIN_VALUE_NONE));
 $interfaceJavascriptDataFrag1->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag1->setJavascriptFragment(
 "var contentPane = new dijit.layout.ContentPane({region:\"#POS#\",style:" .
 "\"background-color:green;width:#WIDTH#;height:#HEIGHT#;overflow:auto;padding:0px;\",splitter:false});" .
 "var table=document.createElement(\"table\");" .
 "table.style.padding=\"0px\";" .
 "table.style.width=\"80%\";" .
 "table.style.height=\"20px\";" . 
 "table.style.border=\"1px dotted white\";" .
 "table.style.marginLeft=\"10px\";" .
 "table.style.marginTop=\"25px\";" .
 "table.style.wordWrap=\"break-word\";" .
 "\$(table).attr(\"id\",\"#LAYOUT#_#POS#_table\");" .
 "var tbody=document.createElement(\"tbody\");" .
 "\$(tbody).attr(\"id\",\"#LAYOUT#_#POS#_tbody\");" .
 "\$(tbody).attr(\"width\",\"100%\");" .
 "var tr=document.createElement(\"tr\");" .
 "\$(tr).attr(\"id\",\"#LAYOUT#_#POS#_row_id_0\");" .
 "var td = document.createElement(\"td\");" .
 "\$(td).attr(\"width\",\"100%\");" .
 "tr.appendChild(td);" .
 "tbody.appendChild(tr);" .
 "table.appendChild(tbody);" .
 "contentPane.domNode.appendChild(table);" .
 "bc.addChild(contentPane);" .
 "bc.startup();" . 
 "\$(\"#\" + contentPane.domNode.id + \"_splitter\").remove();" .
 "#LAYOUT#_#POS#_dndSource=new dojo.dnd.Source(\"#LAYOUT#_#POS#_tbody\",{" .
 "creator:function(actItem,actHint)" .
 "{" .
 "var intName=\$(actItem).find(\"span\").text();" .
 "var oldIntName = intName;" .
 "var intItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
 "if(intItems.length==1)" .
 "{" .
 "ajaxHandler.synServerCall(\"" . AJAX_HANDLER_PAGE . "\",\"" . 
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME . "\",intName,\"text\",/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "var intName = ajaxHandler.getOpByName(\"" . 
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME . "\").result;" .
 "var intItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
 "}" .
 "var intType;" .
 "if(intItems.length==5)" .
 "intType = intItems[2];" .
 "else if(intItems.length==6) " .
 "intType=intItems[3];" .
 "else " .
 "intType=intName;" .
 "var tr = document.createElement(\"tr\");" .
 "var num = $(\"##LAYOUT#_#POS#_table > tbody > tr\").size();" .
 "\$(tr).attr(\"id\",\"#LAYOUT#_#POS#_row_id_\" + num);" .
 "var span = document.createElement(\"span\");" .
 "span.innerHTML = oldIntName;" .
 "span.style.width=\"100%\";" .
 "var td = document.createElement(\"td\");" . 
 "td.style.padding=\"10px\";" .
 "\$(td).attr(\"width\",\"100%\");" .
 "var img = document.createElement(\"img\");" .
 "img.src=\"./img/\" + intType + \".gif\";" . 
 "\$(img).attr(\"title\",intName);" .
 "\$(img).attr(\"width\",\"49\");" .
 "\$(img).attr(\"height\",\"49\");" .
 "img.style.display='block';" .
 "td.appendChild(img);" .
 "td.appendChild(span);" .
 "tr.appendChild(td);" .
 "return {node: tr, data: actItem, type: \"text\"};" .
 "}});" .
 "dojo.connect(#LAYOUT#_#POS#_dndSource,\"onDndDrop\",function(source,nodes){" .
  "var i=0;\$(\"##LAYOUT#_#POS#_tbody tr\").each(function(){var id = \"#LAYOUT#_#POS#_row_id_\" + i;" .
  "var pMenu=dijit.byId(\$(this).prop(\"pMenuId\"));if(pMenu!==undefined){pMenu.destroy()};" .
  "\$(this).attr(\"id\",id);i++;});" .
 "\$(\"##LAYOUT#_#POS#_tbody tr\").each(function(){" .
 "var currentTypeId=\$(this).attr(\"id\");" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});\$(this).prop(\"pMenuId\",pMenu.id);var interfaccia = $(this).find(\"span\").text();var thisObj=this;" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_CANCELLA . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).remove();loadPars(\"#LAYOUT#\",\"#POS#\");}" .
 "}));" . 
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_EDIT . "\"," .
 "onClick:function(){subModal.showPopWin('view_interface.php?Par=' + interfaccia," .
 "700,400,function(actVar){\$(thisObj).find(\"span\").text(actVar);},true);}" .
 "}));" .
 "pMenu.startup();loadPars(\"#LAYOUT#\",\"left\");loadPars(\"#LAYOUT#\",\"center\");" .
 "loadPars(\"#LAYOUT#\",\"right\");loadPars(\"#LAYOUT#\",\"bottom\");" .
 "loadPars(\"#LAYOUT#\",\"top\");});});" .
 "var spanNode1 = document.createElement(\"span\");" .
 "spanNode1.innerHTML=\"Style:\";" .
 "contentPane.domNode.insertBefore(spanNode1,table);" .
 "var spanNode2 = document.createElement(\"span\");" .
 "\$(spanNode2).attr(\"id\",\"#LAYOUT#_#POS#_span_style\");" .
 "spanNode2.innerHTML=\"#INLINETEXTBOX_STYLE#\";" .
 "spanNode2.style.color=\"black\";" .
 "contentPane.domNode.insertBefore(spanNode2,table);" .
 "var inlineTextBox = new dijit.InlineEditBox" .
 "({editor: \"dijit.form.TextBox\",width:\"400px\", " .
 "onChange:function(actObj){" .
 "\$(\"##LAYOUT#\").data(\"Pars\").#POS#.style=actObj;"  .
 "}},\"#LAYOUT#_#POS#_span_style\");"
);

 $interfaceJavascriptDataFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"TempGetLayout",NUM_1);
//$interfaceJavascriptDataFrag2 = new Javascript_data_fragment("TempGetLayout",NUM_1);
 $interfaceJavascriptDataFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag2->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag2->setDataFields(array(FIELD_LAYOUT,FIELD_POS));
 $interfaceJavascriptDataFrag2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag2->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceJavascriptDataFrag2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag2->setJavascriptFragment("dijit.byId(\"html_tags__12\").selectChild(\"#LAYOUT#\");" .
 	"var itemsWithContainer = rootEl.getElementsByTagName(\"ind_withContainer\");" .
 	"var withContainer = itemsWithContainer.item(0).childNodes[0].nodeValue;" .
 	"if(withContainer==\"true\")" .
 	"{" .
 	"\$(\"#withContainer\").get(0).checked=true;" .
 	"\$(\"#container_stuff\").show();" .
 	"}" .
 	"else {" .
 	"\$(\"#withContainer\").get(0).checked=false;" .
 	"\$(\"#container_stuff\").hide();" .
 	"}" .
 	"var itemsContainerStyle = rootEl.getElementsByTagName(\"ind_containerStyle\");" .
 	"var containerStyle = itemsContainerStyle.item(0).childNodes[0].nodeValue;" .
 	"\$(\"#containerStyle\").val(containerStyle);" .
 	"var pars1 = \$(\"##LAYOUT#\").data(\"Pars\");" .
 	"pars1.withContainer = (withContainer==\"true\")?(true):(false);" .
 	"pars1.containerStyle = containerStyle;" .
 	"var itemsContainer = rootEl.getElementsByTagName(\"ind_interfacesContainer\" + util.ucFirst(\"#POS#\"));" .
 	"var num1 = itemsContainer.item(0).childNodes.length;" .
 	"var i=0;" .
  "\$(\"##LAYOUT#_#POS#_table > tbody > tr\").each(function(){if(i>0)\$(this).remove();else i++;});" .
 	"for(var j=0;j<=num1-1;j++){" .
  "var tr = document.createElement(\"tr\");" .
  "var num = \$(\"##LAYOUT#_#POS#_table > tbody > tr\").size();" .
  "\$(tr).attr(\"id\", \"#LAYOUT#_#POS#_row_id_\" + num);" .
  "var span = document.createElement(\"span\");" .
  "var intName = itemsContainer.item(0).childNodes[j].childNodes[0].nodeValue;" .
  "span.innerHTML = intName;" .
  "span.style.width=\"100%\";" .
  "var td = document.createElement(\"td\");" .
  "\$(td).attr(\"width\",\"100%\");" .
  "td.style.padding=\"10px\";" .
  "var img = document.createElement(\"img\");" .
  "img.src=\"./img/#LAYOUT#.gif\";" .
  "\$(img).attr(\"width\",\"49\");" .
  "\$(img).attr(\"height\",\"49\");" .
  "\$(img).attr(\"title\",intName);" .
  "img.style.display=\"block\";" .
  "td.appendChild(img);" .
  "td.appendChild(span);" .
  "tr.appendChild(td);" . 	 	
 	"loadPars(\"#LAYOUT#\",\"#POS#\");" .
 	"#LAYOUT#_#POS#_dndSource.insertNodes(false,[td]);" .
  "#LAYOUT#_#POS#_dndSource.sync();" .
 	"}" .
 	"if(\"#POS#\" != \"center\")" .
 	"{var itemsStyle = rootEl.getElementsByTagName(\"ind_container\" + util.ucFirst(\"#POS#\") + \"Style\");" .
  "var intStyle = itemsStyle.item(0).childNodes[0].nodeValue;" .
  "\$(\"##LAYOUT#_#POS#_span_style\").text(intStyle);}" .
  "var i=0;\$(\"##LAYOUT#_#POS#_tbody tr\").each(function(){var id = \"#LAYOUT#_#POS#_row_id_\" + i;" .
  "var pMenu=dijit.byId(\$(this).prop(\"pMenuId\"));if(pMenu!==undefined){pMenu.destroy()};" .
  "\$(this).attr(\"id\",id);i++;});" .
  "\$(\"##LAYOUT#_#POS#_tbody tr\").each(function(){" .
  "var currentTypeId=\$(this).attr(\"id\");" .
  "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
  "});\$(this).prop(\"pMenuId\",pMenu.id);var interfaccia = \$(this).find(\"span\").text();var thisObj=this;" .
  "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_CANCELLA . "\"," .
  "onClick:function(){\$(\"#\" + currentTypeId).remove();loadPars(\"#LAYOUT#\",\"#POS#\");}" .
  "}));" . 
  "pMenu.addChild(new dijit.MenuItem({label: \"" .  LABEL_EDIT . "\"," .
  "onClick:function(){subModal.showPopWin(\"view_interface.php?Par=\" + interfaccia," .
  "700,400,function(actVar){\$(thisObj).find(\"span\").text(actVar);},true);}" .
  "}));" .
  "pMenu.startup();loadPars(\"#LAYOUT#\",\"#POS#\")});"
);

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_1);
 //$interfaceJavascriptFrag5 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment(
 "var simple_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:97%;border:solid 1px black;padding:0px;\"},\"simple_layout_div\");" .
 "tempSimpleCenter = interfacesContainer.getInterface(\"TempInit\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Layout\",\"simple_layout\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Pos\",\"center\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"_\");" .
 "if(! tempSimpleCenter.isFieldInDataFields(\"bc\")){" .
 "tempSimpleCenter.addField(\"bc\",simple_layout_bc,\"var\");}" .
 "else{" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"bc\",simple_layout_bc);}" .
 "tempSimpleCenter.putData();" 
 );

 $interfaceJavascriptFrag6 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op6",NUM_1); 
 //$interfaceJavascriptFrag6 = new Javascript_fragment("Op6",NUM_1);
 $interfaceJavascriptFrag6->setHookId(STRING_NULL);
 $interfaceJavascriptFrag6->setJavascriptFragment("var two_columns_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:97%;border:solid 1px black;padding:0px;\"},\"two_columns_layout_div\");" .
 "var tempTwoColumnsLeft = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"Layout\",\"two_columns_layout\");" .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"Pos\",\"left\");" .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"Width\",\"53%\");" .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:50%;height:100%\");" .
 "if(! tempTwoColumnsLeft.isFieldInDataFields(\"bc\"))" .
 "tempTwoColumnsLeft.addField(\"bc\",two_columns_layout_bc,\"var\");" .
 "else " .
 "tempTwoColumnsLeft.setDataFieldDomainValueByName(\"bc\",two_columns_layout_bc);" .
 "tempTwoColumnsLeft.putData();" .
 "var tempTwoColumnsRight = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTwoColumnsRight.setDataFieldDomainValueByName(\"Layout\",\"two_columns_layout\");" .
 "tempTwoColumnsRight.setDataFieldDomainValueByName(\"Pos\",\"right\");" .
 "tempTwoColumnsRight.setDataFieldDomainValueByName(\"Width\",\"47%\");" .
 "tempTwoColumnsRight.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempTwoColumnsRight.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:50%;height:100%\");" .
 "tempTwoColumnsRight.putData();");

 $interfaceJavascriptFrag7 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op7",NUM_1);  
 //$interfaceJavascriptFrag7 = new Javascript_fragment("Op7",NUM_1);
 $interfaceJavascriptFrag7->setHookId(STRING_NULL);
 $interfaceJavascriptFrag7->setJavascriptFragment("var three_columns_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:100%;border:solid 1px black;padding:0px;\"},\"three_columns_layout_div\");" .
 "var tempThreeColumnsLeft = interfacesContainer.getInterface(\"TempInit\");" .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"Layout\",\"three_columns_layout\");" .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"Pos\",\"left\");" .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"Width\",\"32%\");" .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:33%;height:100%\");" .
 "if(! tempThreeColumnsLeft.isFieldInDataFields(\"bc\"))" .
 "tempThreeColumnsLeft.addField(\"bc\",three_columns_layout_bc,\"var\");" .
 "else " .
 "tempThreeColumnsLeft.setDataFieldDomainValueByName(\"bc\",three_columns_layout_bc);" .
 "tempThreeColumnsLeft.putData();" .
 "var tempThreeColumnsCenter = interfacesContainer.getInterface(\"TempInit\");" .
 "tempThreeColumnsCenter.setDataFieldDomainValueByName(\"Layout\",\"three_columns_layout\");" .
 "tempThreeColumnsCenter.setDataFieldDomainValueByName(\"Pos\",\"center\");" .
 "tempThreeColumnsCenter.setDataFieldDomainValueByName(\"Width\",\"36%\");" .
 "tempThreeColumnsCenter.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempThreeColumnsCenter.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:33%;height:100%\");" .
 "tempThreeColumnsCenter.putData();" .
 "var tempThreeColumnsRight = interfacesContainer.getInterface(\"TempInit\");" .
 "tempThreeColumnsRight.setDataFieldDomainValueByName(\"Layout\",\"three_columns_layout\");" .
 "tempThreeColumnsRight.setDataFieldDomainValueByName(\"Pos\",\"right\");" .
 "tempThreeColumnsRight.setDataFieldDomainValueByName(\"Width\",\"32%\");" .
 "tempThreeColumnsRight.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "tempThreeColumnsRight.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:33%;height:100%\");" .
 "tempThreeColumnsRight.putData();");

 $interfaceJavascriptFrag8 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op8",NUM_1);   
 //$interfaceJavascriptFrag8 = new Javascript_fragment("Op8",NUM_1);
 $interfaceJavascriptFrag8->setHookId(STRING_NULL);
 $interfaceJavascriptFrag8->setJavascriptFragment("var tb_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:97%;border:solid 1px black;padding:0px;\"},\"tb_layout_div\");" .
 "var tempTBTop = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Layout\",\"tb_layout\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Pos\",\"top\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Height\",\"50%\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:100%;height:50%\");" .
 "if(! tempTBTop.isFieldInDataFields(\"bc\"))" .
 "tempTBTop.addField(\"bc\",tb_bc,\"var\");" .
 "else " .
 "tempTBTop.setDataFieldDomainValueByName(\"bc\",tb_layout_bc);" .
 "tempTBTop.putData();" .
 "var tempTBBottom = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Layout\",\"tb_layout\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Pos\",\"bottom\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Height\",\"50%\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:100%;height:50%\");" .
 "tempTBBottom.putData();");

 $interfaceJavascriptFrag9 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op9",NUM_1);   
 //$interfaceJavascriptFrag9 = new Javascript_fragment("Op9",NUM_1);
 $interfaceJavascriptFrag9->setHookId(STRING_NULL);
 $interfaceJavascriptFrag9->setJavascriptFragment("var tb_simple_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:97%;border:solid 1px black;padding:0px;\"},\"tb_simple_layout_div\");" .
 "var tempTBTop = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Layout\",\"tb_simple_layout\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Pos\",\"top\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"Height\",\"34%\");" .
 "tempTBTop.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:100%;height:33%\");" .
 "if(! tempTBTop.isFieldInDataFields(\"bc\"))" .
 "tempTBTop.addField(\"bc\",tb_bc,\"var\");" .
 "else " .
 "tempTBTop.setDataFieldDomainValueByName(\"bc\",tb_simple_layout_bc);" .
 "tempTBTop.putData();" .
 "var tempTBCenter = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTBCenter.setDataFieldDomainValueByName(\"Layout\",\"tb_simple_layout\");" .
 "tempTBCenter.setDataFieldDomainValueByName(\"Pos\",\"center\");" .
 "tempTBCenter.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempTBCenter.setDataFieldDomainValueByName(\"Height\",\"33%\");" .
 "tempTBCenter.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:100%;height:33%\");" .
 "tempTBCenter.putData();" .
 "var tempTBBottom = interfacesContainer.getInterface(\"TempInit\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Layout\",\"tb_simple_layout\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Pos\",\"bottom\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"Height\",\"33%\");" .
 "tempTBBottom.setDataFieldDomainValueByName(\"InlineTextBox_style\",\"width:100%;height:33%\");" .
 "tempTBBottom.putData();");

 $interfaceJavascriptFrag10 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op10",NUM_1);    
 //$interfaceJavascriptFrag10 = new Javascript_fragment("Op10",NUM_1);
 $interfaceJavascriptFrag10->setHookId(STRING_NULL);
 $interfaceJavascriptFrag10->setJavascriptFragment(
 "var page=\$('#Pagine option:selected').text();" . 
 "var pMenu1 = new dijit.Menu({" .
 "targetNodeIds:['html_tags__13']});" .
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
 $dispFields = array(LABEL_GESTIONE_LAYOUTS);
 $interfaceFrame2->setDispFields($dispFields);
 $attribs = array("style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame2->setAttribs($attribs);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceDivTag1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
  
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $attribs = array("style"=>"background-color:#290094;" .
 "border:1px solid white;padding:10px 10px 10px 10px;");
 $interfaceFrame1->setAttribs($attribs);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);

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
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($inputCtrl1);
 $interfacesContainer->add($inputCtrl2);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptDataFrag1);
 $interfacesContainer->add($interfaceJavascriptDataFrag2); 
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3); 
 $interfacesContainer->add($interfaceJavascriptFrag4); 
 $interfacesContainer->add($interfaceJavascriptFrag5); 
 $interfacesContainer->add($interfaceJavascriptFrag6); 
 $interfacesContainer->add($interfaceJavascriptFrag7); 
 $interfacesContainer->add($interfaceJavascriptFrag8); 
 $interfacesContainer->add($interfaceJavascriptFrag9);
 $interfacesContainer->add($interfaceJavascriptFrag10);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);


 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_layouts_op_page();
 $ajaxOps = array(AJAX_OP_SET_SESSION_ACTIVE_APP,AJAX_OP_GET_LAYOUTS,
 AJAX_OP_SAVE_LAYOUT,AJAX_OP_GET_LAYOUT,
 AJAX_OP_CREATE_LAYOUT_PREVIEW,
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME,
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