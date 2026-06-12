<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_export_changes_op_page.class.php");

 $interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1);
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $dataFields = array(FIELD_MENU_VOICES,FIELD_MENU_PAGES,FIELD_MENU_IDS);
 $interfaceCurtainMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceCurtainMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("Start","Export"),
 array("startt.php","export.php"),
 array(STRING_NULL,STRING_NULL));
 $interfaceCurtainMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);

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

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1);  
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
// $interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"db_objects",NUM_1);
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

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
 //$interfaceFrame2 = new Html_div_tag();
 $interfaceFrame2->setShortName("Frame_2");
 $dispFields = array(LABEL_EXPORT);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $intHtmlInputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$intHtmlInputTag1 = new Html_input_tag();
 $attribs = array("type"=>"checkbox");
 $intHtmlInputTag1->setAttribs($attribs);

 $intPhpDataFragment1 = Creator::create(Interfaces_info::INT_PHP_DATA_FRAGMENT,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intPhpDataFragment1 = new Php_data_fragment(OBJ_NONE,OP_NONE,NUM_1);
 $intPhpDataFragment1->setPhpFragment("\$htmlWriter = \$thisObj->getHtmlWriter();" . 
 "\$htmlWriter->put(\"<div class=\\\"export_changes\\\" " .
 "onmouseover=\\\"export_changes_view_list(\$(this).parent())\\\">+</div>\");");

 $intSimpleTable1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SIMPLE_TABLE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intSimpleTable1 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_NAME,FIELD_DATE_MODIFIED,FIELD_CHECK,FIELD_EXPORT_CHANGES);
 $intSimpleTable1->setDataFields($dataFields);
 $dataFieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $intSimpleTable1->setDataFieldsDomains($dataFieldsDomains);
 $dataFieldsDomainsValues = array(STRING_NULL,STRING_NULL,
 $intHtmlInputTag1,$intPhpDataFragment1);
 $intSimpleTable1->setDataFieldsDomainsValues($dataFieldsDomainsValues);
 $intSimpleTable1->setInheritData(true);
 $intSimpleTable1->setPaginate(false);
 $intSimpleTable1->setLengthChange(false);
 $intSimpleTable1->setInfo(true);
 $intSimpleTable1->setSort(true);
 $intSimpleTable1->setTableHeaders(array(LABEL_NOME,LABEL_DATA_DI_MODIFICA,LABEL_CHECK,LABEL_ESPORTA_VERSO));
 //$intSimpleTable1->setJavascriptEnabled(false);
 $intSimpleTable1->setColumnsDims(array("45%","20%","15%","15%"));

 $intSimpleTable2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SIMPLE_TABLE,STRING_NULL,OBJ_NONE,OP_NONE,NUM_2); 
 //$intSimpleTable2 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_NAME,FIELD_DATE_MODIFIED,FIELD_CHECK,FIELD_EXPORT_CHANGES);
 $intSimpleTable2->setDataFields($dataFields);
 $dataFieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $intSimpleTable2->setDataFieldsDomains($dataFieldsDomains);
 $dataFieldsDomainsValues = array(STRING_NULL,STRING_NULL,
 $intHtmlInputTag1,$intPhpDataFragment1);
 $intSimpleTable2->setDataFieldsDomainsValues($dataFieldsDomainsValues);
 $intSimpleTable2->setInheritData(true);
 $intSimpleTable2->setPaginate(false);
 $intSimpleTable2->setLengthChange(false);
 $intSimpleTable2->setInfo(true);
 $intSimpleTable2->setSort(true);
 $intSimpleTable2->setTableHeaders(array(LABEL_NOME,LABEL_DATA_DI_MODIFICA,LABEL_CHECK,LABEL_ESPORTA_VERSO));
 //$intSimpleTable2->setJavascriptEnabled(false);
 $intSimpleTable2->setColumnsDims(array("45%","20%","15%","15%"));

 $intSimpleTable3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_SIMPLE_TABLE ,STRING_NULL,OBJ_NONE,OP_NONE,NUM_3); 
 //$intSimpleTable3 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_3);
 $dataFields = array(FIELD_NAME,FIELD_DATE_MODIFIED,FIELD_CHECK,FIELD_EXPORT_CHANGES);
 $intSimpleTable3->setDataFields($dataFields);
 $dataFieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $intSimpleTable3->setDataFieldsDomains($dataFieldsDomains);
 $dataFieldsDomainsValues = array(STRING_NULL,STRING_NULL,
 $intHtmlInputTag1,$intPhpDataFragment1);
 $intSimpleTable3->setDataFieldsDomainsValues($dataFieldsDomainsValues);
 $intSimpleTable3->setInheritData(true);
 $intSimpleTable3->setPaginate(false);
 $intSimpleTable3->setLengthChange(false);
 $intSimpleTable3->setInfo(true);
 $intSimpleTable3->setSort(true);
 $intSimpleTable3->setTableHeaders(array(LABEL_NOME,LABEL_DATA_DI_MODIFICA,LABEL_CHECK,LABEL_ESPORTA_VERSO));
 //$intSimpleTable3->setJavascriptEnabled(false);
 $intSimpleTable3->setColumnsDims(array("40%","20%","15%","15%"));

 $intButtonTag1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);  
 //$intButtonTag1 = new Html_button_tag();
 $intButtonTag1->setTagBody(LABEL_EXPORT_CHANGES);
 $intButtonTag1->setAttribs(array("id"=>"button_1","onClick"=>"button_1_onClick()"));

 $intBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBrTag1 = new Html_br_tag();
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("dojo.parser.parse();var menu0=dijit.byId('dijit_Menu_0');" .
 "var menuItems = menu0.getChildren();" .
 "var menuLabels=[];i=0;" .
 "\$('.simple_table_column_Export_changes > div').each(function(){" .
 "\$(this).data('Appls',[]);var curItem=this;j=0;" .
 "var pMenu = new dijit.Menu({targetNodeIds:[\$(this).get(0).id]});" .
 "dojo.forEach(menuItems,function(x,j){pMenu.addChild(new dijit.CheckedMenuItem({label:x.label," .
 "onClick:function(){\$(curItem).data('Appls')[j++]=x.label;}}));});" .
 "});");

 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1); 
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment( 
 "var i=0;\$('#simple_table__1_tbody_id tr').each(function(){" .
 "var pMenu=dijit.byId(\$(this).prop('pMenuId'));if(pMenu!==undefined)pMenu.destroy();i++;});" .
 "var j=0;\$('#simple_table__1_tbody_id tr').each(function(){var m=j;var currentTypeId='simple_table__1_field_id_Name_' + j;" .
 "var pMenu=new dijit.Menu({targetNodeIds:[currentTypeId]});" .
 "\$(this).prop('pMenuId',pMenu.id);" .
 "pMenu.addChild(new dijit.MenuItem({label:'" . LABEL_EDIT . "'," .
 "onClick:function(){label_edit_onClick('1',m)}}));" .
 "j++;pMenu.startup();});"); 

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1); 
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment( 
 "var i=0;\$('#simple_table__2_tbody_id tr').each(function(){" .
 "var pMenu=dijit.byId(\$(this).prop('pMenuId'));if(pMenu!==undefined)pMenu.destroy();i++;});" .
 "var j=0;\$('#simple_table__2_tbody_id tr').each(function(){var m=j;var currentTypeId='simple_table__2_field_id_Name_' + j;" .
 "var pMenu=new dijit.Menu({targetNodeIds:[currentTypeId]});" .
 "\$(this).prop('pMenuId',pMenu.id);" .
 "pMenu.addChild(new dijit.MenuItem({label:'" . LABEL_EDIT . "'," .
 "onClick:function(){label_edit_onClick('2', m)}}));" .
 "j++;pMenu.startup();});"); 

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1); 
 //$interfaceJavascriptFrag4 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment( 
 "var i=0;\$('#simple_table__3_tbody_id tr').each(function(){" .
 "var pMenu=dijit.byId(\$(this).prop('pMenuId'));if(pMenu!==undefined)pMenu.destroy();i++;});" .
 "var j=0;\$('#simple_table__3_tbody_id tr').each(function(){var m=j;var currentTypeId='simple_table__3_field_id_Name_' + j;" .
 "var pMenu=new dijit.Menu({targetNodeIds:[currentTypeId]});" .
 "\$(this).prop('pMenuId',pMenu.id);" .
 "pMenu.addChild(new dijit.MenuItem({label:'" . LABEL_EDIT . "'," .
 "onClick:function(){label_edit_onClick('3', m)}}));" .
 "j++;pMenu.startup();});"); 

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_1); 
 //$interfaceJavascriptFrag5 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment("if('" . 
 (isset($_GET['Par'])?$_GET['Par']:STRING_NULL) . "'=='interfaces'){var menu0=dijit.byId('dijit_Menu_0');" .
 "var menuItems = menu0.getChildren();" .
 "dojo.forEach(menuItems,function(x){var option = document.createElement('option');" .
 "option.label=x.label;option.value=x.label;" .
 "\$('#html_tags__8').append(option);})};");

 $interfaceTabs1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TABS,STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$interfaceTabs1 = new Cheope_ns_tabs(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceTabs1->addField(FIELD_VOICES,array(FW_DIR,XML_DIR,INTERFACES_DIR));
 $interfaceTabs1->addField(FIELD_LOCATIONS,
 array(THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . FW_DIR,
 THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . XML_DIR,
 THIS_PAGE . URL_PARS_START . PAR . URL_PAR_EQUAL . INTERFACES_DIR));
 $interfaceTabs1->setSelectedTab(1);

 $intLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$intLabel3 = new Html_label_tag();
 $intLabel3->setTagBody(LABEL_PAGINE . ENTITY_SPACE . ENTITY_SPACE);

 $intLabel4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);   
 //$intLabel4 = new Html_label_tag();
 $intLabel4->setTagBody(LABEL_FORZA_NOME_APPLICAZIONE);

 $intInput3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);   
 //$intInput3 = new Html_input_tag();
 $intInput3->setId("App_override_check");
 $intInput3->setAttribs(array("type"=>"checkbox"));  

 $intDiv2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
 //$intDiv2 = new Html_div_tag();
 $intDiv2Container = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$intDiv2Container = new Interfaces_container(STRING_NULL);
 $intDiv2Container->add($intLabel4);
 $intDiv2Container->add($intInput3);
 $intDiv2->setInterfacesContainer($intDiv2Container);
 
 $interfaceFrame3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FRAME,STRING_NULL,OP_NONE,NUM_3);
 //$interfaceFrame3 = new Cheope_ns_frame(OP_NONE,NUM_3);
 $interfaceFrame3->setRowsNum(4);
 $interfaceFrame3->setColsNum(1);
 $interfaceFrameContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer3->add($intSimpleTable1);
 $interfaceFrameContainer3->add($intBrTag1);
 $interfaceFrameContainer3->add($intDiv2);
 $interfaceFrameContainer3->add($intButtonTag1);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer3);

 $interfaceFrame4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FRAME,STRING_NULL,OP_NONE,NUM_4); 
 //$interfaceFrame4 = new Cheope_ns_frame(OP_NONE,NUM_4);
 $interfaceFrame4->setRowsNum(4);
 $interfaceFrame4->setColsNum(1);
 $interfaceFrameContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer4->add($intSimpleTable2);
 $interfaceFrameContainer4->add($intBrTag1);
 $interfaceFrameContainer3->add($intDiv2);
 $interfaceFrameContainer4->add($intButtonTag1);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $intLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);    
 //$intLabel1 = new Html_label_tag();
 //$intLabel1->setAttribs(array("style"=>"padding-bottom:70px;"));
 $intLabel1->setTagBody(LABEL_PAGINE . ENTITY_SPACE . ENTITY_SPACE);

 $intSelect1 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL); 
 //$intSelect1 = new Html_select_tag();
 
 $intHtmlFragment1 = Creator::create(Interfaces_info::INT_HTML_FRAGMENT,STRING_NULL);
 //$intHtmlFragment1 = new Html_fragment();
 $intHtmlFragment1->setHtmlFragment(ENTITY_SPACE . "-->" . ENTITY_SPACE);
 $intHtmlFragment1->setStyle("display:inline;");

 $intLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);     
 //$intLabel2 = new Html_label_tag();
 $intLabel2->setTagBody(LABEL_APPLICAZIONI . ENTITY_SPACE . ENTITY_SPACE);

 $intSelect2 = Creator::create(Interfaces_info::INT_HTML_SELECT_TAG,STRING_NULL); 
 //$intSelect2 = new Html_select_tag();
 $intSelect2->setAttribs(array("multiple"=>STRING_NULL));
 
 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr1 = new Html_br_tag(); 
  
 $intLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$intLabel3 = new Html_label_tag();
 $intLabel3->setTagBody(LABEL_FORZA_NOME_APPLICAZIONE);
 
 $intInput2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);
 //$intInput2 = new Html_input_tag();
 $intInput2->setAttribs(array("type"=>"checkbox")); 
 
 $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv1 = new Html_div_tag();
 $intDiv1->setDispFields(array(LABEL_OPZIONI));
 $intDivCont1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$intDivCont1 = new Interfaces_container(STRING_NULL);
 $intDivCont1->add($intLabel1);
 $intDivCont1->add($intSelect1);
 $intDivCont1->add($intHtmlFragment1);
 $intDivCont1->add($intLabel2);
 $intDivCont1->add($intSelect2);
 $intDivCont1->add($intBr1);
 $intDivCont1->add($intLabel3);
 $intDivCont1->add($intInput2);
 $intDiv1->setInterfacesContainer($intDivCont1);
 $intDivDec1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDiv1,OP_NONE,NUM_0);
 //$intDivDec1 = new Html_fieldset_decorator($intDiv1,OP_NONE,NUM_0);
 $intDivDec1->setStyle("padding:8px;");
 
 $interfaceFrame5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_FRAME,STRING_NULL,OP_NONE,NUM_5);
 //$interfaceFrame5 = new Cheope_ns_frame(OP_NONE,NUM_5);
 $interfaceFrame5->setRowsNum(4);
 $interfaceFrame5->setColsNum(1);
 $interfaceFrameContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer5 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer5->add($intSimpleTable3);
 $interfaceFrameContainer5->add($intBrTag1);
 $interfaceFrameContainer5->add($intDiv2);
 $interfaceFrameContainer5->add($intButtonTag1);
 $interfaceFrame5->setInterfacesContainer($interfaceFrameContainer5);

 $interfaceTabsContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceTabsContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceTabsContainer1->add($interfaceFrame3);
 $interfaceTabs1->setInterfacesContainer($interfaceTabsContainer1);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer2->add($interfaceTabs1);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2); 

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setShortName("Frame_1");
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);  
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
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
 $interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceTabs1);
 $interfacesContainer->add($interfaceFrame2);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($interfaceFrame3);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($intDivDec1);
 $interfacesContainer->add($intSelect1);
 $interfacesContainer->add($intSelect2);
 $interfacesContainer->add($interfaceFrame5);
 $interfacesContainer->add($intSimpleTable1);
 $interfacesContainer->add($intSimpleTable2);
 $interfacesContainer->add($intSimpleTable3);
 $interfacesContainer->add($intHtmlInputTag1);
 $interfacesContainer->add($intButtonTag1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_export_changes_op_page();
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $ajaxOps = array(AJAX_OP_EXPORT_CHANGES,
 AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>