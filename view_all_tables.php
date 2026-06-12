<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_view_all_tables_op_page.class.php");

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllTablesOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewAllTablesOp2",NUM_1);
 $dataFields = array(FIELD_TABLE);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"90%\"><input id=\"Name_id_{COUNT}\" value=\"{TABLE}\" onchange=\"input_onChange(this);\"></input></td>" .
 "<td width=\"10%\"><img id=\"img_id_{COUNT}\" src=\"./img/close.gif\"" .
 "\" ></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllTablesOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewAllTablesOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"tables\" cellpadding=\"5\" width=\"350\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_TABELLE . "</th>" .
 "<th></th>" .
 "<th></th>" .
 "</tr></thead>" . /*<span id=\"buffer_deleted_tables\"></span>*/ "<tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewAllTablesOp3",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("viewAllTablesOp3",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = \$(\"#tables > tbody > tr\").size();" .
  	"tr.id= \"Row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.fieldName;" . 
    "input.id = \"Name_id_\" + num;"  .
    "input.onchange = function(){input_onChange(input)};" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){" .
    "var removingTableName=\$('#Name_id_' + num).val();" .
 	  "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingTableName,'text',/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);" .
 	  "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
 	  "{" .
 	 	"alert(loc.getString('msg',69));" .
 	  "return false;" .	
 	  "}else{console.log('Node not used');}" .	  
 	  "ajaxHandler.synServerCall('ajax_handler.php','checkIfIsInRelation',removingTableName,'text',/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);" .
 	  "if(ajaxHandler.getOpByName('checkIfIsInRelation').testResult=='true')" .
 	  "{" .
 		"alert(loc.getString('msg',20));" .
 		"return false;" .
 	  "}else{console.log('Node not in relation');}" .
//	  "\$('#buffer_deleted_tables').data('buffer').push(removingTableName);" .
    "var parent = \$(this).parent().parent();parent.remove();var i=0;" .
    "\$(\"#body_id > tr\").each(function(){this.id=\"Row_id_\" + i;" .
    "\$(this).find(\"td > input\").get(0).id =\"Name_id_\" + i;i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "\$(input).data(\"table_name\",input.value);\$(input).data(\"new_table_name\",\"\");" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    " });");

  $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewAllTablesOp4",NUM_1);
  //$interfaceJavascriptFrag2 = new Javascript_fragment("viewAllTablesOp4",NUM_1);
  $interfaceJavascriptFrag2->setHookId(STRING_NULL);
  $interfaceJavascriptFrag2->setJavascriptFragment("var j=0;\$(\"#tbody_id input\").each(" .
  //"var buffer = new Array();\$('#buffer_deleted_tables').data('buffer',buffer);\$(\"#tbody_id input\").each(" .
 "function(){var name=\$(this).val();\$(this)" .
 ".data(\"table_name\",name);\$(this).data(\"new_table_name\",\"\");});" .
 "\$(\"#tbody_id img\").each(function(){var parent = \$(this).parent().parent();" . 
 "\$(this).click(function(){" .
 "var removingTableName = parent.find('input').val();" .
 "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingTableName,'text',/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);" .
 "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
 "{" .
 "alert(loc.getString('msg',69));" .
 "return false;" .	
 "}" .	
 "ajaxHandler.synServerCall('ajax_handler.php','checkIfIs1NRelation',removingTableName,'text',/[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*ind_records[.\\\\\/<>_\\\\\-\\\\\.\\\\\?\"=\\\\\s ]*/);" .
 "if(ajaxHandler.getOpByName('checkIfIsInRelation').testResult=='true')" .
 "{" .
 "alert(loc.getString('msg',20));" .
 "return false;" .
 "}" .  
  "parent.remove();" . /*\$('#buffer_deleted_tables').data('buffer').push(removingTableName);"*/ "var i=0;" .
    "\$('#tbody_id > tr').each(function(){this.id='Row_id_' + i;" .
    "\$(this).find('td > input').get(0).id ='Name_id_' + i;i++;});" .
 "});j++;" .
 "});"
 );

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_TABELLE);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$interfaceLabel1 = new Html_label_tag();
 $attribs = array("for"=>"input_table_id","style"=>"display:block;");
 $interfaceLabel1->setAttribs($attribs);
 $interfaceLabel1->setTagBody(LABEL_NUOVA_TABELLA);
 
 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInput1 = new Html_input_tag();
 $attribs = array("id"=>"input_table_id","type"=>"text", "size"=>"25");
 $interfaceInput1->setAttribs($attribs);
 
 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
  
 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton1 = new Html_button_tag();
 $intButton1->setTagBody("+");
 $attribs = array("id"=>"button_1","onclick"=>"button_1_onClick(this);");
 $intButton1->setAttribs($attribs);
 
 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
 
 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton2 = new Html_button_tag();
 $intButton2->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_2","onclick"=>"button_2_onClick(this);");
 $intButton2->setAttribs($attribs); 
 
 $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv1 = new Html_div_tag();
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL);
 $intDivCont->add($interfaceLabel1);
 $intDivCont->add($interfaceInput1);
 $intDivCont->add($intSpan1);
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
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 $ajaxOps = array(AJAX_OP_SET_DB_OBJS_DEF_PROPS,
 AJAX_OP_SET_FIELDS_DEF_ALL_FIELDS_PROPS,
  AJAX_OP_CHECK_IF_IS_1N_RELATION,
  AJAX_OP_CHECK_IF_IS_IN_RELATION,
  AJAX_OP_CHECK_IF_ALIAS_EXISTS,
  AJAX_OP_UPDATE_BINDS,
  AJAX_OP_GET_NODE_TYPE,
  AJAX_OP_CHECK_IF_NODE_IS_USED,
  AJAX_OP_DELETE_RELATIONS_DEFS);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>