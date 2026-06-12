<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_all_bound_interfaces_op_page.class.php");

 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBoundInterfacesOp3",NUM_1);
 //$interfaceJavascriptTemplate3 = new Javascript_data_template("viewBoundInterfacesOp3",NUM_1);
 $dataFields = array(FIELD_NODES);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setDataExchangeType("xml");
 $interfaceJavascriptTemplate3->setCallBackFunPattern("/[.\\/<>_\\-\\?\"=\\s ]*ind_records[.\\/<>_\\-\\.\\?\"=\\s ]*/");
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<option>{NODES}</option>"); 

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBoundInterfacesOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewBoundInterfacesOp2",NUM_1);
 $dataFields = array(FIELD_INTERFACE_NAME,FIELD_NODO);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceJavascriptTemplate3);
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setInheritData(false); 
 $interfaceJavascriptTemplate2->setAjaxOpPar($_GET["Node"]);
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[.\\/<>_\\-\\.\\?\"=\\s ]*ind_records[.\\/<>_\\-\\.\\?\"=\\s ]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"bound_interface_row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td align=\"left\" width=\"65%\"><input id=\"bound_interface_name_id_{COUNT}\" disabled size=\"40\" value=\"{INTERFACE_NAME}\"></input></td>" .
 "<td align=\"left\" width=\"35%\"><select id=\"table_id_{COUNT}\" onchange=\"select_table_id_onChange()\">{NODO}</select></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewBoundInterfacesOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewBoundInterfacesOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__0");
 $interfaceJavascriptTemplate1->setEnableDataFromRemote(false);
 $interfaceJavascriptTemplate1->setInheritData(false);
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[.\\/<>_\\-\\.\\?\"=\\s ]*ind_records[.\\/<>_\\-\\.\\?\"=\\s ]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"bound_interfaces\" cellpadding=\"5\" width=\"450\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_NOME_INTERFACCIA . "</th>" .
 "<th>" . LABEL_NODI . "</th>" .
 "</tr></thead><tbody id=\"bound_interfaces_tbody_id\">{OBJ_1}" .
 "</tbody></table>");
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("var ajaxOp = ajaxHandler.getOpByName('viewBoundInterfacesOp3');" . 
 "var nodi = ajaxOp.results;var selectTag = \$('#html_tags__2');" .
 "var parsValues = util.getUrlArgsValues(window.location.search);var intr = parsValues[0]; " .
 "for(var nodo in nodi){if(intr==nodi[nodo].Nodes) " .
 "selectTag.append(\"<option selected>\" + nodi[nodo].Nodes + \"</option>\"); else selectTag.append(\"<option>\" + nodi[nodo].Nodes + \"</option>\");}");
 
 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("var parsValues = util.getUrlArgsValues(window.location.search);var intr = parsValues[0];" .
 "\$('#bound_interfaces_tbody_id select').each(function()" .
 "{\$('#' + this.id + ' option').each(function(){if(\$(this).text()==intr)this.selected=true;});});");
 
 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_INTERFACCE_ASSOCIATE);
 $interfaceFrame2->setDispFields($dispFields);
 
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
 //$decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $intHtmlBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL,STRING_NULL);
 //$intHtmlBrTag1 = new Html_br_tag();
 
 $intHtmlLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL,STRING_NULL);
 //$intHtmlLabel1 = new Html_label_tag();
 $intHtmlLabel1->setTagBody(LABEL_IMPOSTA_TUTTI . ENTITY_SPACE . ENTITY_SPACE);
 $intHtmlLabel1->setAttribs(array("for"=>"html_tags__2"));
 
 $intHtmlSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL);
 //$intHtmlSelect1 = new Html_select_tag();
 $intHtmlSelect1->setAttribs(array("onchange"=>"select_set_all_onChange(this);"));
 
 $intHtmlSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intHtmlSpan1 = new Html_span_tag();
 $intHtmlSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intHtmlButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL); 
 //$intHtmlButton1 = new Html_button_tag();
 $intHtmlButton1->setTagBody(LABEL_BUTTON_APPLICA);
 $intHtmlButton1->setAttribs(array("onclick"=>"button_1_onClick();"));

 $intHtmlSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intHtmlSpan2 = new Html_span_tag();
 $intHtmlSpan2->setTagBody(LABEL_SOSTITUIRE_OVUNQUE);
 
 $intHtmlInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$intHtmlInput1 = new Html_input_tag();
 $intHtmlInput1->setAttribs(array("type"=>"checkbox"));
 
 $intHtmlDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intHtmlDiv1 = new Html_div_tag();
 $intHtmlDiv1->setAttribs(array("style"=>"display:none"));
 $intContDiv1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intContDiv1 = new Interfaces_container(STRING_NULL);
 $intContDiv1->add($intHtmlSpan2);
 $intContDiv1->add($intHtmlInput1); 
 $intHtmlDiv1->setInterfacesContainer($intContDiv1);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($intHtmlBrTag1);
 $interfaceFrameContainer1->add($intHtmlLabel1);
 $interfaceFrameContainer1->add($intHtmlSelect1);
 $interfaceFrameContainer1->add($intHtmlSpan1);
 $interfaceFrameContainer1->add($intHtmlButton1);
 $interfaceFrameContainer1->add($intHtmlDiv1); 
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_all_bound_interfaces_op_page();
 $ajaxOps = array(AJAX_OP_SET_ALL_BOUND_INTERFACES, AJAX_OP_IS_INTERFACE_BUSY);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>