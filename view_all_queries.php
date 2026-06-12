<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_all_queries_op_page.class.php");

 $intJavascriptDataFragment1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"viewAllQueriesOp3",NUM_1);
 //$intJavascriptDataFragment1 = new Javascript_data_fragment("viewAllQueriesOp3",NUM_1);
 $dataFields = array(FIELD_DATASOURCE,FIELD_COUNT);
 $intJavascriptDataFragment1->setDataFields($dataFields);
 $intJavascriptDataFragment1->setEnableExecuteOnLoad(false);
 $intJavascriptDataFragment1->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*//");
 $intJavascriptDataFragment1->setJavascriptFragment("var isDataSource='#DATASOURCE#';" .
 "htmlWriter.put('<input id=\"DataSource_id_#COUNT#\" type=\"checkbox\" " .
 "onclick=\"dataSource_onClick(this)\" " .
 " '" .
 " + ((isDataSource=='true')?('checked'):'') + '>');");

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllQueriesOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewAllQueriesOp2",NUM_1);
 $dataFields = array(FIELD_QUERYNAME,FIELD_QUERYBODY,FIELD_DATASOURCE);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE 
 ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,$intJavascriptDataFragment1);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(true);
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"35%\"><input id=\"Query_name_id_{COUNT}\" value=\"{QUERYNAME}\"></input></td>" .
 "<td width=\"60%\"><textarea id=\"Query_body_id_{COUNT}\" onchange=\"query_body_id_onChange(this)\">{QUERYBODY}</textarea></td>" .
 "<td width=\"5%\">{DATASOURCE}</td>" .
 "<td width=\"5%\"><img src=\"./img/close.gif\"" .
 " onclick=\"" .
 "var parent=$(this).parent().parent();;" .
 "var removingQueryName=parent.find('input').val();" .
 "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingQueryName,'text');" .
 "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
 "{" .
 "alert(loc.getString('msg',70));" .
 "return false;" .	
 "}" .	  
 "parent.remove();" .
 "\"></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllQueriesOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewAllQueriesOp1",NUM_1);
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
 "<th>" . LABEL_NOME . "</th>" .
 "<th>" . LABEL_CORPO . "</th>" .
 "<th>" . LABEL_DATASOURCE . "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewAllQueriesOp4",NUM_1); 
 //$interfaceJavascriptFrag1 = new Javascript_fragment("viewAllQueriesOp4",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#tables > tbody > tr\").size();" .
  	"tr.id= \"Row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.queryName;" . 
    "input.id=\"Query_name_id_\" + num;"  .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    "var td2 = document.createElement(\"td\");" .
    "var textarea = document.createElement(\"textarea\");" .
    "textarea.id=\"Query_body_id_\" + num;" .
    "textarea.innerHTML = actItem.queryBody;" . 
    "\$(textarea).change(function(){query_body_id_onChange(this)});" .
    "td2.appendChild(textarea);" .
    "tr.appendChild(td2);" .
    "var td3 = document.createElement(\"td\");" .
    "var checkBox = document.createElement(\"input\");" .
    "checkBox.id=\"DataSource_id_\" + num;" .
    "checkBox.type=\"checkbox\";" .
    "if(actItem.isDataSource)" .
    "checkBox.checked=true;" .
    "else " .
    "checkBox.checked=false;" .
    "\$(checkBox).click(function(){dataSource_onClick(this)});" .
    "td3.appendChild(checkBox);" .
    "tr.appendChild(td3);" .
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){" .
    "var parent=$(this).parent().parent();" .
    "var removingQueryName=parent.find('input').val();" .
    "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingQueryName,'text');" .
    "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
    "{" .
    "alert(loc.getString('msg',70));" .
    "return false;" .	
    "}" .	
    "parent.remove();" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    "});");


 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_QUERIES);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL,STRING_NULL);
 //$interfaceLabel1 = new Html_label_tag();
 $attribs = array("for"=>"input_query_name_id","style"=>"display:block;");
 $interfaceLabel1->setAttribs($attribs);
 $interfaceLabel1->setTagBody(LABEL_NUOVA_QUERY);
 
 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$interfaceInput1 = new Html_input_tag();
 $attribs = array("id"=>"input_query_name_id","type"=>"text", "size"=>"25",
 "style"=>"float:left;");
 $interfaceInput1->setAttribs($attribs);
 
 $interfaceTextarea1 = Creator::create("Html_textarea_tag",STRING_NULL);
// $interfaceTextarea1 = new Html_textarea_tag();
 $attribs = array("id"=>"input_query_body_id","style"=>"float:left;margin-left:10px;",
 "onchange"=>"input_query_body_id_onChange();");
 $interfaceTextarea1->setAttribs($attribs);
  
 $intCheckBox = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$intCheckBox = new Html_input_tag();
 $attribs=array("id"=>"checkBox_id","type"=>"checkbox","onclick"=>"checkBox_id_onClick(this);"); 
 $intCheckBox->setAttribs($attribs);
  
 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton1 = new Html_button_tag();
 $intButton1->setTagBody("+");
 $attribs = array("id"=>"button_1","onclick"=>"button_1_onClick(this);");
 $intButton1->setAttribs($attribs);
 
 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
// $intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody("&nbsp;&nbsp;&nbsp;");
 
 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton2 = new Html_button_tag();
 $intButton2->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_2","onclick"=>"button_2_onClick(this);");
 $intButton2->setAttribs($attribs); 
 
 $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv1 = new Html_div_tag();
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL); 
 $intDivCont->add($interfaceLabel1);
 $intDiv1->setInterfacesContainer($intDivCont);
 
 $intDiv2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv2 = new Html_div_tag();
 $attribs = array("style"=>"float:left;border:1px solid grey;padding:5px 5px 5px 5px;margin-right:10px;");
 $intDiv2->setAttribs($attribs);
 $intDiv2Cont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDiv2Cont = new Interfaces_container(STRING_NULL);
 $intDiv2Cont->add($interfaceInput1);
 $intDiv2Cont->add($interfaceTextarea1);
 $intDiv2Cont->add($intCheckBox);
 $intDiv2->setInterfacesContainer($intDiv2Cont);
 
 $intDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv3 = new Html_div_tag();
 $intDiv3Cont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDiv3Cont = new Interfaces_container(STRING_NULL);
 $intDiv3Cont->add($intDiv2);
 $intDiv3Cont->add($intButton1);
 $intDiv3Cont->add($intSpan3);
 $intDiv3Cont->add($intButton2);
 $intDiv3->setInterfacesContainer($intDiv3Cont);
  
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 $interfaceFrame1->setDispFields($dispFields);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($intDiv1);
 $interfaceFrameContainer1->add($intDiv3);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);  
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($intJavascriptDataFragment1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_all_queries_op_page();
 $ajaxOps = array(AJAX_OP_CHECK_IF_IS_DATA_SOURCE_QUERY,
 AJAX_OP_SET_ALL_QUERIES,
  AJAX_OP_UPDATE_BINDS,
AJAX_OP_GET_NODE_TYPE,
  AJAX_OP_CHECK_IF_NODE_IS_USED);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>