<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_bindings_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
// $interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
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

 $interfaceCurtainMenu3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);  
// $interfaceCurtainMenu3 = new Cheope_ns_curtain_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Edit"),
 array("connections.php"),array(STRING_NULL));
 $interfaceCurtainMenu3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceCurtainMenu3->setCssClass(CSS_CURTAIN_MENU);
 $interfaceCurtainMenu3->setFadeToColor("#FFFFFF");
 $interfaceCurtainMenu3->setJavascriptEnabled(false);

 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"interfaces",NUM_1);
 //$interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"interfaces",NUM_1);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);
 $interfaceCurtainMenu4->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu4->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu4->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu4->unserialize();

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1); 
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"bindings",NUM_1);
 $interfaceMenuBar1->setDbQueries($dbQueriesContainer);
 $interfaceMenuBar1->setDbStruct($dbStructTree);
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

// Tables and queries binds

 
 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewTablesAndQueriesOp3",STRING_NULL,NUM_1);
// $interfaceJavascriptTemplate3 = new Javascript_data_template("viewTablesAndQueriesOp3",NUM_1);
 $dataFields = array(FIELD_CONNECTION_NAME);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setDataExchangeType("xml");
 $interfaceJavascriptTemplate3->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<option>{CONNECTION_NAME}</option>"); 
 
 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewTablesAndQueriesOp2",NUM_1);
// $interfaceJavascriptTemplate2 = new Javascript_data_template("viewTablesAndQueriesOp2",NUM_1);
 $dataFields = array(FIELD_TABLES_QUERIES,FIELD_TYPE,FIELD_CONNECTION_NAME,FIELD_CONNECTIONS);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceJavascriptTemplate3);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(false);
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/"); 
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td align=\"center\" width=\"30%\"><span id=\"tables_and_queries_id_{COUNT}\">{TABLES_QUERIES}</span></td>" .
 "<td align=\"center\" width=\"30%\"><div id=\"type_id_{COUNT}\">{TYPE}</div></td>" .
 "<td align=\"center\" width=\"30%\"><input id=\"hidden_id_{COUNT}\" type=\"hidden\" value=\"{CONNECTION_NAME}\"></input>" .
 "<select id=\"connections_id_{COUNT}\">{CONNECTIONS}</select></td>" .
 "<td align=\"center\" width=\"10%\"><img src=\"./img/close.gif\">" .
 "</img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewTablesAndQueriesOp1",NUM_1);
// $interfaceJavascriptTemplate1 = new Javascript_data_template("viewTablesAndQueriesOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 //$interfaceJavascriptTemplate1->setCallBackFunPattern("/[\.<>=\?\"!\/0-9a-zA-Z_\s\'\-]*/");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"tables_and_queries\" cellpadding=\"5\" width=\"350\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_TABELLA_O_QUERY_O_ALIAS . "</th>" .
 "<th>" . LABEL_TIPO . "</th>" .
 "<th>" . LABEL_CONNESSIONI . "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewTablesAndQueriesOp4",NUM_1); 
 //$interfaceJavascriptFrag1 = new Javascript_fragment("viewTablesAndQueriesOp4",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#tables_and_queries > tbody > tr\").size();" .
  	"tr.id= \"row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "td1.align=\"center\";" .
    "var span = document.createElement(\"span\");" .
    "span.innerHTML = actItem.fieldName;" .
    "span.id=\"tables_and_queries_id_\" + num;" .
    "td1.appendChild(span);" .
    "tr.appendChild(td1);" .
    "var td2 = document.createElement(\"td\");" .
    "td2.align=\"center\";" .
    "var div = document.createElement(\"div\");" .
    "div.id = \"type_id_\"+num;" .
    "div.innerHTML = actItem.fieldType;" .
    "td2.appendChild(div);" .
    "tr.appendChild(td2);" .    
    "var td3 = document.createElement(\"td\");" .
    "td3.align=\"center\";" .
    "var select=document.createElement(\"select\");" .
    "select.id= \"connections_id_\" + num;" .
    "td3.appendChild(select);" .
    "tr.appendChild(td3);" . 
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){var parent = $(this).parent().parent();parent.remove();var i=0;" .
    "\$(\"#tbody_id > tr\").each(function(){this.id=\"row_id_\" + i;" .
    "\$(this).find(\"td > span\").get(0).id = \"tables_and_queries_id_\" + i;" .
    "\$(this).find(\"td > div\").get(0).id = \"type_id_\" + i;" .
    "\$(this).find(\"td > select\").get(0).id =\"connections_id_\" + i;i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" . 
  	"});");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewTablesAndQueriesOp5",NUM_1); 
 $interfaceJavascriptFrag2 = new Javascript_fragment("viewTablesAndQueriesOp5",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("\$(\"#tbody_id input\")" .
 ".each(function(){var connName = this.value;var items = this.id.split(\"_\");" .
 "var count = items[2];\$(\"#connections_id_\" + count + \" option\").each(function(){" .
 "if(\$(this).text()==connName)this.selected=true;});});" .
 "\$(\"#tbody_id img\").each(function(){" . 
  "$(this).click(function(){var parent = $(this).parent().parent();" .
  "parent.remove();var i=0;" .
    "\$('#tbody_id > tr').each(function(){this.id='row_id_' + i;" .
    "\$(this).find('td > span').get(0).id = 'tables_and_queries_id_' + i;" .
    "\$(this).find('td > div').get(0).id = 'type_id_' + i;" .
    "\$(this).find('td > select').get(0).id ='connections_id_' + i;i++;});" .
 "});" .
 "});"
 );

 $intDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $intDivTag3 = new Html_div_tag();

 $intDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $intDivTag1 = new Html_div_tag();
 $dispFields = array(LABEL_TABELLE_E_QUERIES_BINDS);
 $intDivTag1->setDispFields($dispFields);

 $intSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL,"Input");
// $intSelect1 = new Html_select_tag("Input");
 $attribs = array("id"=>"select_node_id"); 
 $intSelect1->setAttribs($attribs);

 $intSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL,"Input"); 
// $intSelect2 = new Html_select_tag("Input");
 $attribs = array("id"=>"select_connection_id"); 
 $intSelect2->setAttribs($attribs);

 $interfaceButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
// $interfaceButton2 = new Html_button_tag();
 $interfaceButton2->setAttribs(array("id"=>"button_2",
 "onclick"=>"button_2_onClick();"));
 $interfaceButton2->setTagBody(LABEL_BUTTON_APPLICA);

 $interfaceButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
// $interfaceButton1 = new Html_button_tag();
 $interfaceButton1->setAttribs(array("id"=>"button_1",
 "onclick"=>"button_1_onClick();"));
 $interfaceButton1->setTagBody("+");

 $interfaceSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
// $interfaceSpan1 = new Html_span_tag();
 $interfaceSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $intHrTag1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL); 
// $intHrTag1 = new Html_hr_tag();
 
 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceDivTagContainer1 = new Interfaces_container();
 $interfaceDivTagContainer1->add($intDivTag3);
 $interfaceDivTagContainer1->add($intHrTag1);
 $interfaceDivTagContainer1->add($intSelect1);
 $interfaceDivTagContainer1->add($intSelect2);
 $interfaceDivTagContainer1->add($interfaceButton1);
 $interfaceDivTagContainer1->add($interfaceSpan1);
 $interfaceDivTagContainer1->add($interfaceButton2);
 $intDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $decoratedIntDiv1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag1);  
// $decoratedIntDiv1 = new Html_fieldset_decorator($intDivTag1);
 $decoratedIntDiv1->setCssClass(CSS_FRAME_DEC); 
 
// Bindings

 $interfaceJavascriptTemplate6 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBindsOp3",NUM_1);
// $interfaceJavascriptTemplate6 = new Javascript_data_template("viewBindsOp3",NUM_1);
 $dataFields = array(FIELD_CONNECTION_NAME);
 $interfaceJavascriptTemplate6->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate6->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate6->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate6->setDataExchangeType("xml");
 $interfaceJavascriptTemplate6->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate6->setJavascriptTemplate("<option>{CONNECTION_NAME}</option>"); 

 $interfaceJavascriptTemplate7 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBindsOp4",NUM_1);
// $interfaceJavascriptTemplate7 = new Javascript_data_template("viewBindsOp4",NUM_1);
 $dataFields = array(FIELD_NODES);
 $interfaceJavascriptTemplate7->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate7->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate7->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate7->setDataExchangeType("xml");
 $interfaceJavascriptTemplate7->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate7->setJavascriptTemplate("<option>{NODES}</option>"); 

 $interfaceJavascriptTemplate5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBindsOp2",NUM_1); 
// $interfaceJavascriptTemplate5 = new Javascript_data_template("viewBindsOp2",NUM_1);
 $dataFields = array(FIELD_BIND_NAME,FIELD_NODE_NAME,FIELD_NODES,FIELD_CONNECTION_NAME,FIELD_CONNECTIONS);
 $interfaceJavascriptTemplate5->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate5->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 $interfaceJavascriptTemplate7,Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceJavascriptTemplate6);
 $interfaceJavascriptTemplate5->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate5->setDataExchangeType("xml");
 $interfaceJavascriptTemplate5->setInheritData(false);
 //$interfaceJavascriptTemplate5->setCallBackFunPattern("/[\.<>=\?\"!\[\]\/0-9a-zA-Z_\s\'\-]*/");
 $interfaceJavascriptTemplate5->setCallBackFunPattern("/[0-9a-zA-Z_\-\<\>\?\"\.\/\s]*/");
 $interfaceJavascriptTemplate5->setJavascriptTemplate("<tr id=\"bind_row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td align=\"center\" width=\"28%\"><input type=\"text\" id=\"bind_name_id_{COUNT}\" value=\"{BIND_NAME}\" onchange=\"input_bind_name_onChange(this);\"></input></td>" .
 "<td align=\"center\" width=\"28%\"><input id=\"hidden_2_id_{COUNT}\" type=\"hidden\" value=\"{NODE_NAME}\">" .
 "</input><select type=\"nodo\" id=\"bind_node_id_{COUNT}\">{NODES}</select></td>" .
 "<td align=\"center\" width=\"28%\"><input id=\"hidden_id_{COUNT}\" type=\"hidden\" value=\"{CONNECTION_NAME}\">" .
 "</input><select type=\"connessione\" id=\"bind_connection_id_{COUNT}\">{CONNECTIONS}</select></td>" .
 "<td align=\"center\" width=\"10%\"><img src=\"./img/close.gif\">" .
 "</img></td>" .
 "<td align=\"\" width=\"6%\"><input id=\"radio_id_{COUNT}\" name=\"radio_button\" type=\"radio\"></input></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBindsOp1",NUM_1); 
// $interfaceJavascriptTemplate4 = new Javascript_data_template("viewBindsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate5);
 $interfaceJavascriptTemplate4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate4->setHookId("html_tags__7");
 $interfaceJavascriptTemplate4->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate4->setJavascriptTemplate("<table id=\"binds\" cellpadding=\"5\" width=\"350\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_NOME_BIND . "</th>" .
 "<th>" . LABEL_NODI . "</th>" .
 "<th>" . LABEL_CONNESSIONI . "</th>" .
 "<th></th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"bind_tbody_id\">{OBJ_1}" .
 "</tbody></table>");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewBindsOp5",NUM_1);  
// $interfaceJavascriptFrag3 = new Javascript_fragment("viewBindsOp5",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("bind_dndSource = " .
 "new dojo.dnd.Source(\"bind_tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#binds > tbody > tr\").size();" .
  	"tr.id= \"bind_row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "td1.align=\"center\";" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.fieldBindName;" .
    "\$(input).data('oldName',actItem.fieldBindName);" .
    "\$(input).bind(\"change\",function(){input_bind_name_onChange(input)});" .
    "input.id=\"bind_name_id_\" + num;" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    "var td2 = document.createElement(\"td\");" .
    "td2.align=\"center\";" .
    "var select1 = document.createElement(\"select\");" .
    "\$(select1).attr(\"type\",\"nodo\");" .
    "select1.id = \"bind_node_id_\"+num;" .
    "td2.appendChild(select1);" .
    "tr.appendChild(td2);" .    
    "var td3 = document.createElement(\"td\");" .
    "td3.align=\"center\";" .
    "var select2=document.createElement(\"select\");" .
    "\$(select2).attr(\"type\",\"connessione\");" .
    "select2.id = \"bind_connection_id_\" + num;" .
    "td3.appendChild(select2);" .
    "tr.appendChild(td3);" . 
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){var parent = $(this).parent().parent();" .
    "var removingTableName=parent.find('input').val();" .
    "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingTableName,'text',/[\s\._\:A-Z<>\?\"'=a-z0-9;\-]*/);" .
    "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
    "{" .
    "alert(loc.getString('msg',72));" .
    "return false;" .	
    "}" .	
    "parent.remove();var i=0;" .
    "\$(\"#bind_tbody_id > tr\").each(function(){\$(this).get(0).id=\"row_id_\" + i;" .
    "\$(this).find(\"td > input\").get(0).id = \"bind_name_id_\" + i;" .
    "\$(this).find(\"td > select[type='nodo']\").get(0).id =\"bind_node_id_\" + i;" .
    "\$(this).find(\"td > select[type='connessione']\").get(0).id =\"bind_connection_id_\" + i;i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "var input2 = document.createElement(\"input\");" .
    "input2.name =\"radio_button\";" .
    "input2.id=\"radio_id_\" + num;" .
    "input2.type=\"radio\";" .
    "var td5 = document.createElement(\"td\");" .
    "td5.appendChild(input2);" .
    "tr.appendChild(td5);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" . 
  	"});");

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewBindsOp6",NUM_1);  
// $interfaceJavascriptFrag4 = new Javascript_fragment("viewBindsOp6",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("\$(\"#bind_tbody_id input[type=hidden]\")" .
 ".each(function(){if(this.id.indexOf('hidden_2')!=-1)" .
 "{var nodeName = this.value;var items = this.id.split(\"_\");" .
 "var count = items[3];\$(\"#bind_node_id_\" + count + \" option\").each(function(){" .
 "if(\$(this).text()==nodeName)this.selected=true;});}" .
 "else" .
 "{var connName = this.value;var items = this.id.split(\"_\");" .
 "var count = items[2];\$(\"#bind_connection_id_\" + count + \" option\").each(function(){" .
 "if(\$(this).text()==connName)this.selected=true;});}" .
 "});" .
 "\$(\"#bind_tbody_id input[type=text]\").each(function(){\$(this).data('oldName',\$(this).val());" .
 "});" .
 "\$(\"#bind_tbody_id img\").each(function(){" . 
 "$(this).click(function(){var parent = $(this).parent().parent();" .
 "var removingTableName=parent.find('input').val();" .
 "ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',removingTableName,'text',/[\s\._\:A-Za-z0-9<>\?\"'=;\-]*/);" .
 "if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')" .
 "{" .
 "alert(loc.getString('msg',72));" .
 "return false;" .	
 "}" .	
  "parent.remove();var i=0;" .
    "\$('#bind_tbody_id > tr').each(function(){this.id='bind_row_id_' + i;" .
    "\$(this).find('td > input').get(0).id = 'bind_name_id_' + i;" .
    "\$(this).find('td > select[type=nodo]').get(0).id = 'bind_node_id_' + i;" .
    "\$(this).find('td > select[type=connessione]').get(0).id ='bind_connection_id_' + i;i++;});" .
 "});" .
 "});"
 );

 $intDivTag4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $intDivTag4 = new Html_div_tag();

 $intDivTag5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
// $intDivTag5 = new Html_div_tag();
 $dispFields = array(LABEL_BINDS);
 $intDivTag5->setDispFields($dispFields);

 $intHtmlInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
// $intHtmlInputTag1 = new Html_input_tag();
 $attribs = array("type"=>"text","id"=>"nome_bind");
 $intHtmlInputTag1->setAttribs($attribs);

 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
// $intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE);
 
 $intSelect3 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL,"Input");
// $intSelect3 = new Html_select_tag("Input");
 $attribs = array("id"=>"bind_select_node_id"); 
 $intSelect3->setAttribs($attribs);
 
 $intSelect4 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL,"Input"); 
// $intSelect4 = new Html_select_tag("Input");
 $attribs = array("id"=>"bind_select_connection_id"); 
 $intSelect4->setAttribs($attribs);

 $interfaceButton5 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
// $interfaceButton5 = new Html_button_tag();
 $interfaceButton5->setAttribs(array("id"=>"button_5",
 "onclick"=>"button_5_onClick();"));
 $interfaceButton5->setTagBody(LABEL_BUTTON_APPLICA);

 $interfaceButton4 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
// $interfaceButton4 = new Html_button_tag();
 $interfaceButton4->setAttribs(array("id"=>"button_4",
 "onclick"=>"button_4_onClick();"));
 $interfaceButton4->setTagBody("+");

 $interfaceSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
// $interfaceSpan3 = new Html_span_tag();
 $interfaceSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $intHrTag2 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL); 
// $intHrTag2 = new Html_hr_tag();

 $interfaceButton6 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
// $interfaceButton6 = new Html_input_tag();
 $attribs = array("type"=>"button","value"=>LABEL_VEDI_TUTTE_INTERFACCE_ASSOCIATE,
 "onclick"=>"button_6_onClick();");
 $interfaceButton6->setAttribs($attribs);

 $interfaceBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
// $interfaceBr1 = new Html_br_tag();

 $intDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $intDivTag2 = new Html_div_tag();
 $dispFields = array(LABEL_BINDS);
 $intDivTag2->setDispFields($dispFields);

 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceDivTagContainer2 = new Interfaces_container();
 $interfaceDivTagContainer2->add($intDivTag4);
 $interfaceDivTagContainer2->add($intHrTag2);
 $interfaceDivTagContainer2->add($intHtmlInputTag1);
 $interfaceDivTagContainer2->add($intSpan1);
 $interfaceDivTagContainer2->add($intSelect3);
 $interfaceDivTagContainer2->add($intSelect4);
 $interfaceDivTagContainer2->add($interfaceButton4);
 $interfaceDivTagContainer2->add($interfaceSpan3);
 $interfaceDivTagContainer2->add($interfaceButton5);
 $interfaceDivTagContainer2->add($interfaceBr1);
 $interfaceDivTagContainer2->add($interfaceBr1);
 $interfaceDivTagContainer2->add($interfaceButton6);
 $intDivTag2->setInterfacesContainer($interfaceDivTagContainer2); 
 
 $decoratedIntDiv2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDivTag2);
// $decoratedIntDiv2 = new Html_fieldset_decorator($intDivTag2);
 $decoratedIntDiv2->setCssClass(CSS_FRAME_DEC); 

 $intBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
// $intBrTag1 = new Html_br_tag();

 $interfaceButton3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
// $interfaceButton3 = new Html_button_tag();
 $interfaceButton3->setAttribs(array("id"=>"button_3",
 "onclick"=>"button_3_onClick();"));
 $interfaceButton3->setTagBody(LABEL_CREA_FILE_BINDS);

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
// $interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_BINDING);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
// $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
// $interfaceHtmlFragment1 = new Html_fragment();
 $interfaceHtmlFragment1->setHtmlFragment("<div id=\"dialog-confirm\" style=\"display:none;\" title=\"Create table?\">" .
  "<p><span class=\"ui-icon ui-icon-alert\" style=\"float:left; margin:0 7px 20px 0;\"></span>" . MSG_49 . "</p>" .
 "</div>");

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($decoratedIntDiv1);
 $interfaceFrameContainer2->add($decoratedIntDiv2);
 $interfaceFrameContainer2->add($intBrTag1);
 $interfaceFrameContainer2->add($interfaceButton3);
 $interfaceFrameContainer2->add($interfaceHtmlFragment1);
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

 $interfaceTempMsg1 =  Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,
 STRING_NULL,OP_NONE,NUM_0,true,true);  
// $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);  
// $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptTemplate7);
 $interfacesContainer->add($interfaceJavascriptTemplate6);
 $interfacesContainer->add($interfaceJavascriptTemplate5);
 $interfacesContainer->add($interfaceJavascriptTemplate4);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceHtmlFragment1);
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($intSelect1);
 $interfacesContainer->add($intSelect2);
 $interfacesContainer->add($intSelect3);
 $interfacesContainer->add($intSelect4);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_bindings_op_page();
 $ajaxOps = array(AJAX_OP_GET_NODE_TYPE,
 AJAX_OP_SET_ALL_TABLES_AND_QUERIES_BINDS,
 AJAX_OP_CREATE_DB_STRUCT,
 AJAX_OP_CREATE_QUERIES_STRUCT,
 AJAX_OP_CREATE_CONNECTIONS_STRUCT,
 AJAX_OP_CREATE_DB_BINDS,
 AJAX_OP_SET_SESSION_ACTIVE_APP,
 AJAX_OP_SET_ALL_BINDS,
 AJAX_OP_CHECK_IF_NODE_IS_USED,
 AJAX_OP_FIX_DB_XML_FILES);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>