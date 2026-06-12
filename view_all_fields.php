<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_all_fields_op_page.class.php");

 $interfaceJavascriptDataFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"viewAllFieldsOp3",NUM_1);
 //$interfaceJavascriptDataFrag1 = new Javascript_data_fragment("viewAllFieldsOp3",NUM_1);
 $dataFields = array(FIELD_FIELD,FIELD_PK);
 $interfaceJavascriptDataFrag1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_FUNCTION);
 $interfaceJavascriptDataFrag1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptDataFrag1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptDataFrag1->setDataExchangeType("xml");
 $interfaceJavascriptDataFrag1->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag1->setJavascriptFragment(
 "var pkField='#FIELD#';var pk='#PK#';if(pkField==pk){htmlWriter.put('PK');}" .
 "else htmlWriter.put('---');");

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllFieldsOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewAllFieldsOp2",NUM_1);
 $dataFields = array(FIELD_FIELD,FIELD_TYPE,FIELD_PK);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceJavascriptDataFrag1);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(true);
 $interfaceJavascriptTemplate2->setAjaxOpPar((isset($_GET[PAR]))?($_GET[PAR]):(STRING_NULL)); 
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"50%\"><input id=\"Name_id_{COUNT}\" type=\"text\" size=\"25\" value=\"{FIELD}\"></input></td>" .
 "<td width=\"30%\"><div id=\"Type_id_{COUNT}\">{TYPE}</div></td>" .
 "<td width=\"10%\"><span id=\"Pk_id_{COUNT}\">{PK}</span></td>" .
 "<td width=\"10%\"><img src=\"./img/close.gif\"" .
 " onclick=\"var parent=\$(this).parent().parent();" .
 "if(checkIfIsInCandidates('" . ((isset($_GET[PAR]))?($_GET[PAR]):(STRING_NULL)) . "',parent.find('input').val()))" .
 "{alert(loc.getString('msg',63));return false;}" .
 "if(parent.find('span').text().replace(/\s*/g,'')!='PK')parent.remove();" .
 "else {alert(loc.getString('msg',35));return false;}" .
 "var i=0;" .
   "\$('#tbody_id > tr').each(function(){this.id='Row_id_' + i;" .
    "\$(this).find('td > span').get(0).id = 'Pk_id_' + i;" .
    "\$(this).find('td > div').get(0).id = 'Type_id_' + i;" .
    "\$(this).find('td > input').get(0).id ='Name_id_' + i;i++;});" . 
 "\"></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllFieldsOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewAllFieldsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"fields_table\" cellpadding=\"5\" width=\"400\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_CAMPI . "</th>" .
 "<th>" . LABEL_TIPI . "</th>" .
 "<th>" . LABEL_PK . "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewAllFieldsOp4",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("viewAllFieldsOp4",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("\$(\"#tbody_id div\").each(function(){" .
 "var currentTypeId=this.id;var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_BIG_STRING) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_BIG_STRING) . "\");}" .
 "}));" . 
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_BOOLEAN) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_BOOLEAN) . "\");}" .
 "}));" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_DATE) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_DATE) . "\");}" .
 "}));" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_FLOAT) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_FLOAT) . "\");}" .
 "}));" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_INTEGER) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_INTEGER) . "\");}" .
 "}));" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . strToUpper(FIELD_TYPE_STRING) . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).text(\"" . strToUpper(FIELD_TYPE_STRING) . "\");}" .
 "}));" .
 "pMenu.startup();});" .
 "\$(\"#tbody_id span\").each(function(){" .
 "var currentObj = \$(this);" .
 "var currentSpanId=this.id;var pMenu = new dijit.Menu({targetNodeIds: [currentSpanId]" .
 "});" .
 "pMenu.addChild(" .
  "new dijit.MenuItem({" .
  "label: \"" . LABEL_SET_UNSET_PK . "\"," .
  "onClick:function(){" .
   "var currentCount = currentSpanId.split(\"_\")[2];" .
   "var spanPk = currentObj.text();" .
   "if(spanPk.replace(/\s*/g,\"\")==\"---\")" .
   "{" .
     "\$(\"#\" + currentSpanId).text(\"" . strToUpper(LABEL_PK) . "\");" .
   "\$(\"#fields_table span\").each(function(){var currentObj=$(this);" .
   "if(currentObj.get(0).id != currentSpanId){currentObj.text(\"---\");}" .
   "});" .
   "}" .
   "else" .
   "{" .
   "currentObj.text(\"---\");" .
   "};" .
  "}" .
 "}));" . 
 "pMenu.startup();});");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewAllFieldsOp5",NUM_2);
 //$interfaceJavascriptFrag2 = new Javascript_fragment("viewAllFieldsOp5",NUM_2);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = \$(\"#fields_table > tbody > tr\").size();" .
  	"tr.id = \"Row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.fieldName;" .
    "input.type=\"text\";" .
    "input.size=25;" .
    "input.id=\"Name_id_\" + num;" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    "var td2 = document.createElement(\"td\");" .
    "var div = document.createElement(\"div\");" .
    "div.id = \"Type_id_\"+num;" .
    "div.innerHTML = actItem.fieldType;" .
    "td2.appendChild(div);" .
    "tr.appendChild(td2);" .    
    "var td3 = document.createElement(\"td\");" .
    "var span=document.createElement(\"span\");" .
    "span.id= \"Pk_id_\" + num;" .
    "span.innerHTML = \"---\";" .
    "td3.appendChild(span);" .
    "tr.appendChild(td3);" . 
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){var parent=$(this).parent().parent();" .
    "if(\$('#Pk_id_' + num).text().replace(/\s*/g,'')!='PK')parent.remove();" .
    "else {alert(loc.getString('msg',35));return false;}" .
    "var i=0;" .
    "\$(\"#tbody_id > tr\").each(function(){this.id=\"row_id_\" + i;" .
    "\$(this).find(\"td > span\").get(0).id = \"Pk_id_\" + i;" .
    "\$(this).find(\"td > div\").get(0).id = \"Type_id_\" + i;" .
    "\$(this).find(\"td > input\").get(0).id =\"Name_id_\" + i;i++;});" .     
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    " });");

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
// $interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_CAMPI);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
// $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);

 $interfaceLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL); 
// $interfaceLabel1 = new Html_label_tag();
 $attribs = array("for"=>"input_field_id","style"=>"display:block;");
 $interfaceLabel1->setAttribs($attribs);
 $interfaceLabel1->setTagBody(LABEL_NUOVO_CAMPO);

 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
// $interfaceInput1 = new Html_input_tag();
 $attribs = array("id"=>"input_field_id","type"=>"text", "size"=>"25");
 $interfaceInput1->setAttribs($attribs);
 
 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
 
 $intOpt1 = Creator::create("Html_option_tag",STRING_NULL);
// $intOpt1 = new Html_option_tag();
 $intOpt1->setTagBody(strToUpper(FIELD_TYPE_BIG_STRING));
 
 $intOpt2 = Creator::create("Html_option_tag",STRING_NULL);
// $intOpt2 = new Html_option_tag();
 $intOpt2->setTagBody(strToUpper(FIELD_TYPE_BOOLEAN));

 $intOpt3 = Creator::create("Html_option_tag",STRING_NULL); 
// $intOpt3 = new Html_option_tag();
 $intOpt3->setTagBody(strToUpper(FIELD_TYPE_DATE));

 $intOpt4 = Creator::create("Html_option_tag",STRING_NULL); 
// $intOpt4 = new Html_option_tag();
 $intOpt4->setTagBody(strToUpper(FIELD_TYPE_FLOAT));

 $intOpt5 = Creator::create("Html_option_tag",STRING_NULL); 
// $intOpt5 = new Html_option_tag();
 $intOpt5->setTagBody(strToUpper(FIELD_TYPE_INTEGER));

 $intOpt6 = Creator::create("Html_option_tag",STRING_NULL); 
// $intOpt6 = new Html_option_tag();
 $intOpt6->setTagBody(strToUpper(FIELD_TYPE_STRING));
 
 $intSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
// $intSelect1 = new Html_select_tag();
 $attribs = array("id"=>"type_field_id");
 $intSelect1->setAttribs($attribs);
 $intSelectCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $intSelectCont = new Interfaces_container(STRING_NULL);
 $intSelectCont->add($intOpt1);
 $intSelectCont->add($intOpt2);
 $intSelectCont->add($intOpt3);
 $intSelectCont->add($intOpt4);
 $intSelectCont->add($intOpt5);
 $intSelectCont->add($intOpt6);
 $intSelect1->setInterfacesContainer($intSelectCont);
 
 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan2 = new Html_span_tag();
 $intSpan2->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
 
 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton1 = new Html_button_tag();
 $intButton1->setTagBody("+");
 $attribs = array("id"=>"button_1","onclick"=>"button_1_onClick(this,'" . 
 trim((isset($_GET[PAR]))?($_GET[PAR]):(STRING_NULL)) . "');");
 $intButton1->setAttribs($attribs);
 
 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
 
 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton2 = new Html_button_tag();
 $intButton2->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_2","onclick"=>"button_2_onClick(this,'" . 
 trim((isset($_GET[PAR]))?($_GET[PAR]):(STRING_NULL)) . "');");
 $intButton2->setAttribs($attribs); 
 
 $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv1 = new Html_div_tag();
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL);
 $intDivCont->add($interfaceLabel1);
 $intDivCont->add($interfaceInput1);
 $intDivCont->add($intSpan1);
 $intDivCont->add($intSelect1);
 $intDivCont->add($intSpan2);
 $intDivCont->add($intButton1);
 $intDivCont->add($intSpan3);
 $intDivCont->add($intButton2);
 $intDiv1->setInterfacesContainer($intDivCont);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($intDiv1);
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
 $interfacesContainer->add($interfaceJavascriptDataFrag1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_all_fields_op_page();
 $ajaxOps = array(AJAX_OP_CHECK_IF_IS_SUITABLE_PK_KEY,
 AJAX_OP_SET_FIELDS_DEF_FIELDS_PROPS,AJAX_OP_GET_CAND_KEY_FIELDS_PROPS,
 AJAX_OP_SET_PK,AJAX_OP_CHECK_IF_IS_SUITABLE_FIELD,AJAX_OP_SET_FIELDS_CONSTS_DEF);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>