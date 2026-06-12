<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_table_op_page.class.php");

 $interfaceForm1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceForm1 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_LISTA_TABELLE);
 $interfaceForm1->setDataFields($dataFields);
 $fieldsLabels = array(FIELD_LISTA_TABELLE=>LABEL_TABELLE);
 $interfaceForm1->setFieldsLabels($fieldsLabels);
 $fieldsLengths = array(FIELD_LISTA_TABELLE=>50);
 $interfaceForm1->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET);
 $interfaceForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm1->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT);
 $interfaceForm1->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(
 FIELD_LISTA_TABELLE=>array("form_inserimento_1_lista_tabelle_onChange();"));
 $interfaceForm1->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_1_reset_button_onClick();");
 $interfaceForm1->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_1_submit_button_onClick();");
 $interfaceForm1->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm1->setGesPage(THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . $_GET[PAR]);
 $interfaceForm1->setCssClass(CSS_FORM);
 $interfaceForm1->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm1->setAutoTabIndex(false);
 
 $intHtmlFragment4 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_4);
 //$intHtmlFragment4 = new Html_fragment(OP_NONE,NUM_4);
 $intHtmlFragment4->setHtmlFragment(STRING_NULL);

 $interfaceImg1 = Creator::create(Interfaces_info::INT_HTML_IMG_TAG,STRING_NULL,OP_NONE,NUM_1);
 //$interfaceImg1 = new Html_img_tag(OP_NONE,NUM_1);
 $interfaceImg1->setAttribs(array("src"=>"./img/trasf.gif","id"=>"Trasf_img_id",
 "title"=>LABEL_IMPOSTA_NUOVO_CAMPO,
 "onclick"=>"var nuovo_campo = \$('#Nuovo_campo').get(0);form_inserimento_2_nuovo_campo_onChange(nuovo_campo);",
 "style"=>"float:left;cursor:pointer;"));

 $interfaceForm2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_2); 
 //$interfaceForm2 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_LISTA_CAMPI,FIELD_NUOVO_CAMPO,FIELD_TIPI_CAMPO);
 $interfaceForm2->setDataFields($dataFields);
 $fieldsLengths = array(FIELD_NUOVO_CAMPO=>40);
 $interfaceForm2->setFieldsLengths($fieldsLengths);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_SET);
 $interfaceForm2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array(STRING_NULL=>STRING_NULL),Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 array(0=>STRING_NULL));
 $interfaceForm2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm2->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT,ACCESS_OPT);
 $interfaceForm2->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array(
 FIELD_LISTA_CAMPI=>array("form_inserimento_2_lista_campi_onChange(this);"),
 FIELD_NUOVO_CAMPO=>array(STRING_NULL),
 FIELD_TIPI_CAMPO=>array("form_inserimento_2_tipi_campo_onChange(this);"));
 $interfaceForm2->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_2_reset_button_onClick();");
 $interfaceForm2->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_2_submit_button_onClick();");
 $interfaceForm2->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm2->setGesPage(THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . $_GET[PAR]);
 $interfaceForm2->setCssClass(CSS_FORM);
 $interfaceForm2->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm2->setDispFields(LABEL_CAMPI);
 $interfaceForm2->setAutoTabIndex(false);
 $interfaceForm2->setCellPadding(6);

 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDiv3 = new Html_div_tag();
 $intDiv3Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDiv3Container = new Interfaces_container(STRING_NULL);
 $intDiv3Container->add($interfaceImg1);
 $intDiv3Container->add($interfaceForm2);
 $interfaceDiv3->setInterfacesContainer($intDiv3Container); 
 $interfaceDiv3->setDispFields(LABEL_CAMPI); 
 $decoratedForm2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDiv3);
 //$decoratedForm2 = new Html_fieldset_decorator($interfaceDiv3);
 $decoratedForm2->setCssClass(CSS_FRAME_DEC);

 $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_1);
 //$intHtmlFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $intHtmlFragment1->setHtmlFragment("<button id=\"Chiavi_candidate_button_1\" type=\"button\"" .
 " onclick=\"" .
 "insertHtmlTags1NewGroup();" .
 "\">" . LABEL_NUOVA_CHIAVE .
 "</button>");
 
 $intHtmlFragment3 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_3);
 //$intHtmlFragment3 = new Html_fragment(OP_NONE,NUM_3);
 $intHtmlFragment3->setHtmlFragment("<span id=\"candKeyFieldsHeader\">" .
 LABEL_CAMPI_TABELLA . ENTITY_SPACE . ENTITY_SPACE . "->" . ENTITY_SPACE . ENTITY_SPACE . LABEL_CHIAVE . "</span><br/><br/>");
 
 $intHtmlDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intHtmlDivTag1 = new Html_div_tag();
 $interfacesContainerDivTag1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfacesContainerDivTag1 = new Interfaces_container(STRING_NULL);
 $interfacesContainerDivTag1->add($intHtmlFragment3);
 $intHtmlDivTag1->setInterfacesContainer($interfacesContainerDivTag1);
 
 $interfaceForm3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_3);
 //$interfaceForm3 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_3);
 $dataFields = array(FIELD_GROUP_CONTAINER_0,FIELD_BUTTON);
 $interfaceForm3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlDivTag1,$intHtmlFragment1);
 $interfaceForm3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm3->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT,ACCESS_OPT);
 $interfaceForm3->setDataFieldsAccess($accessFields);
 $dataFieldsEvents = array();
 $interfaceForm3->setDataFieldsEvents($dataFieldsEvents);
 $resetButtonEvents = array("form_inserimento_3_reset_button_onClick();");
 $interfaceForm3->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_3_submit_button_onClick();");
 $interfaceForm3->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm3->setGesPage(THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . $_GET[PAR]);
 $interfaceForm3->setCssClass(CSS_FORM);
 $interfaceForm3->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm3->setDispFields(LABEL_CHIAVI_CANDIDATE);
 $interfaceForm3->setAutoTabIndex(false); 
 $interfaceForm3->setCellPadding(12);
 $decoratedForm3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceForm3);
 //$decoratedForm3 = new Html_fieldset_decorator($interfaceForm3);
 $decoratedForm3->setCssClass(CSS_FRAME_DEC);
 
 $intHtmlFragment5 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL,OP_NONE,NUM_5);
 //$intHtmlFragment5 = new Html_fragment(OP_NONE,NUM_5);
 $intHtmlFragment5->setHtmlFragment("<span id=\"extKeyFieldsHeader\">" .
 LABEL_TABELLE . ENTITY_SPACE . ENTITY_SPACE . "->" . ENTITY_SPACE  . ENTITY_SPACE . LABEL_ESTERNE . "</span><br/><br/>");
 
 $intHtmlDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intHtmlDivTag2 = new Html_div_tag();
 
 $interfacesContainerDivTag2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfacesContainerDivTag2 = new Interfaces_container(STRING_NULL);
 $interfacesContainerDivTag2->add($intHtmlFragment5);
 $intHtmlDivTag2->setInterfacesContainer($interfacesContainerDivTag2);

 $interfaceForm4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FORM_2,STRING_NULL,OBJ_NONE,OP_NONE,NUM_4);
 //$interfaceForm4 = new Cheope_ns_form_2(OBJ_NONE,OP_NONE,NUM_4);
 $dataFields = array(FIELD_GROUP_CONTAINER_0);
 $interfaceForm4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceForm4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($intHtmlDivTag2);
 $interfaceForm4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array(LABEL_VOID);
 $interfaceForm4->setDispFields($dispFields);
 $accessFields = array(ACCESS_OPT);
 $interfaceForm4->setDataFieldsAccess($accessFields);
 $resetButtonEvents = array("form_inserimento_4_reset_button_onClick();");
 $interfaceForm4->setResetButtonEvents($resetButtonEvents);
 $submitButtonEvents = array("return form_inserimento_4_submit_button_onClick();");
 $interfaceForm4->setSubmitButtonEvents($submitButtonEvents);
 $interfaceForm4->setGesPage(THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . $_GET[PAR]);
 $interfaceForm4->setCssClass(CSS_FORM);
 $interfaceForm4->setSubmitButtonLabel(LABEL_BUTTON_APPLICA);
 $interfaceForm4->setDispFields(LABEL_CHIAVI_ESTERNE);
 $interfaceForm4->setAutoTabIndex(false); 
 $decoratedForm4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceForm4);
 //$decoratedForm4 = new Html_fieldset_decorator($interfaceForm4);
 $decoratedForm4->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_GESTIONE_CAMPI);
 $interfaceFrame3->setDispFields($dispFields);
 $decoratedIntFrame3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame3);
 //$decoratedIntFrame3 = new Html_fieldset_decorator($interfaceFrame3);
 $decoratedIntFrame3->setCssClass(CSS_FRAME_DEC); 
 
 $interfaceFrameContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer3->add($decoratedForm2);
 $interfaceFrameContainer3->add($decoratedForm3);
 $interfaceFrameContainer3->add($decoratedForm4);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer3);
  
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceForm1);
 $interfaceFrameContainer1->add($decoratedIntFrame3);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("\$(\"select#Lista_campi\").after('<span id=\"tipo_campo_id\"></span>" .
 "<input id=\"pk\" type=\"checkbox\"></input><span>PK</span>');" .
 "\$(\"input#pk\").bind(\"click\",function(){" .
 "if(this.checked)\$(\"select#Lista_campi\").data(\"pk\",\$(\"select#Lista_campi option:selected\").text()); " .
 "else \$(\"select#Lista_campi\").data(\"pk\",\"\");});var selectedTable=\"" . $_GET[PAR] . "\";" .
 "\$(\"#Lista_tabelle option\").each(function(){if(\$(this).text()==selectedTable)\$(this).get(0).selected=true;});" .
 "form_inserimento_1_lista_tabelle_onChange();");
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceForm1);
 $interfacesContainer->add($interfaceForm2);
 $interfacesContainer->add($decoratedForm2);
 $interfacesContainer->add($interfaceForm3);
 $interfacesContainer->add($decoratedForm3);
 $interfacesContainer->add($intHtmlFragment1);
 $interfacesContainer->add($intHtmlFragment3);
 $interfacesContainer->add($intHtmlFragment4);
 $interfacesContainer->add($intHtmlFragment5);
 $interfacesContainer->add($intHtmlDivTag1);
 $interfacesContainer->add($interfaceForm4);
 $interfacesContainer->add($decoratedForm4);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($decoratedIntFrame3);
 $interfacesContainer->add($interfaceFrame1);
 
 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_table_op_page();
 $ajaxOps = array(AJAX_OP_GET_ALL_FIELDS_DEF_PROPS,
 AJAX_OP_SET_FIELDS_DEF_FIELDS_PROPS,
 AJAX_OP_SET_FIELDS_DEF_CAND_KEY_FIELDS_PROPS,
 AJAX_OP_SET_FIELDS_DEF_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_SET_1N_RELATIONS_DEFINITION_PROPS,
 AJAX_OP_GET_FIELDS_DEF_PROPS,
 AJAX_OP_GET_CAND_KEY_FIELDS_PROPS,
 AJAX_OP_GET_EXT_KEY_FIELDS_PROPS,
 AJAX_OP_GET_PK_KEY_FIELD,AJAX_OP_SET_PK,
 AJAX_OP_CHECK_IF_IS_1N_RELATION_FATHER_OF,
 AJAX_OP_CHECK_IF_IS_SUITABLE_PK_KEY,
 AJAX_OP_CHECK_IF_IS_SUITABLE_FIELD,AJAX_OP_SET_FIELDS_DEF,
 AJAX_OP_SET_FIELDS_DEF_WITHOUT_EXT_KEYS);
 $page->setAjaxOps($ajaxOps);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>