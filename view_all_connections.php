<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_all_connections_op_page.class.php");

 $intJavascriptDataFragment1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"viewAllConnectionsOp3",NUM_1);
 //$intJavascriptDataFragment1 = new Javascript_data_fragment("viewAllConnectionsOp3",NUM_1);
 $dataFields = array(FIELD_TYPE,FIELD_USER,FIELD_PASSWORD,FIELD_HOST,
 FIELD_DB,FIELD_DSN,FIELD_CONNECTION_STRING);
 $intJavascriptDataFragment1->setDataFields($dataFields);
 $intJavascriptDataFragment1->setEnableExecuteOnLoad(false);
 $intJavascriptDataFragment1->setInheritData(true);
 $intJavascriptDataFragment1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $intJavascriptDataFragment1->setJavascriptFragment("var type='#TYPE#';var user='#USER#';" .
 "var password='#PASSWORD#';var host='#HOST#';var db='#DB#';var dsn='#DSN#';" .
 "var connectionString='#CONNECTION_STRING#';" .
 "htmlWriter.put('<span class=\"Labels\">Type:</span><span id=\"Par_type_id_{COUNT}\" class=\"Pars\">' + type + '</span><br/>" .
 "<span class=\"Labels\">User:</span><span id=\"Par_user_id_{COUNT}\" class=\"Pars\">' + user + '</span>' + " .
 "'<br/><span class=\"Labels\">Password:</span><span id=\"Par_password_id_{COUNT}\" class=\"Pars\">' + password + '</span><br/>');" .
 "if(type != 'ODBC')htmlWriter.put('<span class=\"Labels\">Host:</span><span id=\"Par_host_id_{COUNT}\" class=\"Pars\">' + host + '</span><br/>' + " .
 "'<span class=\"Labels\">Db:</span><span class=\"Pars\">' + db + '</span><br/>'); else " .
 "htmlWriter.put('<span class=\"Labels\">Connection string:</span><span id=\"Par_connection_string_id_{COUNT}\" class=\"Pars\">' + connectionString + '</span>' + " .
 "'<br/><span class=\"Labels\">Dsn:</span><span id=\"Par_dsn_{COUNT}\" class=\"Pars\">' + dsn + '</span>');");

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllConnectionsOp2",NUM_1); 
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewAllConnectionsOp2",NUM_1);
 $dataFields = array(FIELD_NOME_CONNESSIONE,FIELD_PARAMETRI);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$intJavascriptDataFragment1);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(true);
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" >" .
 "<td width=\"5%\"><input type=\"radio\" id=\"radio_id_{COUNT}\" name=\"radio\" " .
 " value=\"{COUNT}\" onclick=\"radio_onClick(this)\"></input></td>" . 
 "<td width=\"43%\"><span id=\"connection_name_id_{COUNT}\">{CONNECTION_NAME}</span></td>" .
 "<td width=\"52%\"><div id=\"parameter_{COUNT}\" class=\"Parameters\">{PARAMETRI}</div></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 =  Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewAllConnectionsOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewAllConnectionsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"connections\" cellpadding=\"5\" width=\"450\">" .
 "<thead>" .
 "<tr>" .
 "<th></th>" .
 "<th>" . LABEL_NOME . "</th>" .
 "<th>" . LABEL_PARAMETRI . "</th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_CONNESSIONI);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);
 $decoratedIntFrame2->setStyle("width:650px");

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
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
 $interfacesContainer->add($intJavascriptDataFragment1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_all_connections_op_page();
 $ajaxOps = array();
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>