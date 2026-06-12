<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_menus_op_page.class.php");

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
 $fieldsDomainsValues = array(array("Edit","Catalog","Inspect",
 "Layouts","Forms","Pdf"),
 array("interfaces.php","catalog.php","inspect.php","layouts.php",
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

 // ***********
 // Single menu
 // ***********

 $label1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label1 = new Html_label_tag();
 $label1->setTagBody(LABEL_PAGINE);

 $inputCtrl1 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL); 
 //$inputCtrl1 = new Html_input_ctrl();
 $inputCtrl1->addField(FIELD_PAGINE,array(),Int_domain::FIELD_DOMAIN_SET);
 $inputCtrl1->setDataFieldEvents(array("pagine_onChange(this,'single');"));

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr1 = new Html_br_tag();

 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr2 = new Html_br_tag();

 $intSpan1 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);  
 //$intSpan1 = new Html_span_tag();
 $intSpan1->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label2 = new Html_label_tag();
 $label2->setTagBody(LABEL_MENUS);

 $inputCtrl2 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl2 = new Html_input_ctrl();
 $inputCtrl2->addField(FIELD_SINGLE_MENUS,array(),Int_domain::FIELD_DOMAIN_SET);

 $intSpan2 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
 //$intSpan2 = new Html_span_tag();
 $intSpan2->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$label3 = new Html_label_tag() ;
 $label3->setTagBody(LABEL_OP  . ENTITY_SPACE); 

 $inputTag1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$inputTag1 = new Html_input_tag();
 $inputTag1->setAttribs(array("id"=>LABEL_OP,"onchange"=>"input_op_onChange(this);"));

 $intSpan3 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);   
 //$intSpan3 = new Html_span_tag();
 $intSpan3->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);    
// $label4 = new Html_label_tag() ;
 $label4->setTagBody(LABEL_NUM  . ENTITY_SPACE); 

 $inputTag2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag2 = new Html_input_tag();
 $inputTag2->setAttribs(array("id"=>LABEL_NUM,"size"=>"7","value"=>"0",
 "onchange"=>"input_num_onChange(this);"));

 $intBr3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr3 = new Html_br_tag();

 $intBr4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr4 = new Html_br_tag();

 $label5 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);    
 //$label5 = new Html_label_tag() ;
 $label5->setTagBody(LABEL_SHORTNAME  . ENTITY_SPACE . ENTITY_SPACE); 

 $inputTag6 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag6 = new Html_input_tag();
 $inputTag6->setAttribs(array("id"=>LABEL_SHORTNAME,"size"=>"25",
 "onchange"=>"shortName_onChange(this);")); 

 $label10 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);     
 //$label10 = new Html_label_tag() ;
 $label10->setTagBody(" - " . LABEL_USA_COME_NOME_FILE_INTERFACCIA . ":"); 

 $inputTag7 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag7 = new Html_input_tag();
 $inputTag7->setAttribs(array("id"=>"CheckBox_IFreeName",
 "type"=>"checkbox","value"=>"true","onclick"=>"checkbox_IFreeName_onClick(this);")); 

 $intBr13 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr13 = new Html_br_tag();

 $intBr14 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr14 = new Html_br_tag();

 $label11 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);      
 //$label11 = new Html_label_tag() ;
 $label11->setTagBody(LABEL_TIPI  . ENTITY_SPACE); 

 $inputCtrl3 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);   
 //$inputCtrl3 = new Html_input_ctrl();
 $inputCtrl3->addField(FIELD_TIPO_MENU,array(Interfaces_info::INT_LEVEL_MENU=>Interfaces_info::INT_LEVEL_MENU,
 Interfaces_info::INT_LEVEL_MENU_2=>Interfaces_info::INT_LEVEL_MENU_2,
   Interfaces_info::INT_MENUBAR=>Interfaces_info::INT_MENUBAR,
 //  Interfaces_info::INT_MENUBAR_2=>Interfaces_info::INT_MENUBAR_2,
   Interfaces_info::INT_CURTAIN_MENU=>Interfaces_info::INT_CURTAIN_MENU,
   Interfaces_info::INT_HOR_SCROLL_MENU=>Interfaces_info::INT_HOR_SCROLL_MENU,
   Interfaces_info::INT_SIDENAV=>Interfaces_info::INT_SIDENAV,
   Interfaces_info::INT_FULLSCREEN_SLIDE_NAV=>Interfaces_info::INT_FULLSCREEN_SLIDE_NAV,
 //  Interfaces_info::INT_ICON_NAV_BAR=>Interfaces_info::INT_ICON_NAV_BAR,
   Interfaces_info::INT_SPLITNAV=>Interfaces_info::INT_SPLITNAV,
   Interfaces_info::INT_SEARCH_BAR=>Interfaces_info::INT_SEARCH_BAR,
   Interfaces_info::INT_FIXED_SIDEBAR=>Interfaces_info::INT_FIXED_SIDEBAR,
   Interfaces_info::INT_RESP_BOTTOM_NAV_BAR=>Interfaces_info::INT_RESP_BOTTOM_NAV_BAR,
 //  Interfaces_info::INT_SIDEBAR=>Interfaces_info::INT_SIDEBAR,
   Interfaces_info::INT_BOTTOM_NAV_BAR=>Interfaces_info::INT_BOTTOM_NAV_BAR,
   Interfaces_info::INT_SLIDE_DOWN=>Interfaces_info::INT_SLIDE_DOWN,
   Interfaces_info::INT_OFFCANVAS_MENU=>Interfaces_info::INT_OFFCANVAS_MENU,
 //  Interfaces_info::INT_EQUAL_WIDTH_NAV_BAR=>Interfaces_info::INT_EQUAL_WIDTH_NAV_BAR,
   Interfaces_info::INT_FIXED_TOP_MENU=>Interfaces_info::INT_FIXED_TOP_MENU,
   Interfaces_info::INT_IMAGE_NAV_BAR=>Interfaces_info::INT_IMAGE_NAV_BAR,
   Interfaces_info::INT_STICKY_NAV_BAR=>Interfaces_info::INT_STICKY_NAV_BAR,
   Interfaces_info::INT_SHRINK_NAV_BAR=>Interfaces_info::INT_SHRINK_NAV_BAR,
   Interfaces_info::INT_HIDE_NAV_BAR=>Interfaces_info::INT_HIDE_NAV_BAR),Int_domain::FIELD_DOMAIN_SET);
   
 $interfaceDivTag2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);        
 //$interfaceDivTag2 = new Html_div_tag();

 $interfaceDivTagContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceDivTagContainer2 = new Interfaces_container(STRING_NULL);
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
 $interfaceDivTagContainer2->add($intBr3);
 $interfaceDivTagContainer2->add($intBr4);
 $interfaceDivTagContainer2->add($label5);
 $interfaceDivTagContainer2->add($inputTag6);
 $interfaceDivTagContainer2->add($label10);
 $interfaceDivTagContainer2->add($inputTag7);
 $interfaceDivTagContainer2->add($intBr13);
 $interfaceDivTagContainer2->add($intBr14); 
 $interfaceDivTagContainer2->add($label11);
 $interfaceDivTagContainer2->add($inputCtrl3); 
 $interfaceDivTag2->setInterfacesContainer($interfaceDivTagContainer2);

 $interfaceHrTag1 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);          
 //$interfaceHrTag1 = new Html_hr_tag(); 

 $interfaceBrTag1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$interfaceBrTag1 = new Html_br_tag(); 
 $interfaceBrTag2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$interfaceBrTag2 = new Html_br_tag(); 

 $interfaceDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);             
 //$interfaceDivTag3 = new Html_div_tag();
 $interfaceDivTag3->setDispFields(array(LABEL_MENU));
 
 $decoratedIntDivTag3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag3);         
 //$decoratedIntDivTag3 = new Html_fieldset_decorator($interfaceDivTag3);
 $decoratedIntDivTag3->setCssClass(CSS_FRAME_DEC); 

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);             
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1->add($interfaceDivTag2);
 $interfaceDivTagContainer1->add($interfaceBrTag1);
 $interfaceDivTagContainer1->add($interfaceHrTag1);
 $interfaceDivTagContainer1->add($decoratedIntDivTag3);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);    
 //$intBr1 = new Html_br_tag();   

 $interfaceLabel1 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);             
 //$interfaceLabel1 = new Html_label_tag();
 $attribs = array("for"=>"input_voice_to_single_id","style"=>"display:block;");
 $interfaceLabel1->setAttribs($attribs);
 $interfaceLabel1->setTagBody(LABEL_NUOVA_VOCE);

 $interfaceInput1 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);              
 //$interfaceInput1 = new Html_input_tag();
 $attribs = array("id"=>"input_voice_to_single_id","type"=>"text", "size"=>"25");
 $interfaceInput1->setAttribs($attribs);

 $intSpan4 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);               
 //$intSpan4 = new Html_span_tag();
 $intSpan4->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $interfaceLabel2 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);              
 //$interfaceLabel2 = new Html_label_tag();
 $attribs = array("for"=>"input_page_to_single_id");
 $interfaceLabel2->setAttribs($attribs);
 $interfaceLabel2->setTagBody(LABEL_NUOVO_URL); 

 $intSpan5 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);              
 //$intSpan5 = new Html_span_tag();
 $intSpan5->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $interfaceInput2 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$interfaceInput2 = new Html_input_tag();
 $attribs = array("id"=>"input_page_to_single_id","type"=>"text", "size"=>"25");
 $interfaceInput2->setAttribs($attribs);

 $intSpan6 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);                
 //$intSpan6 = new Html_span_tag();
 $intSpan6->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);
 
 
 $interfaceLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);              
 //$interfaceLabel2 = new Html_label_tag();
 $attribs = array("for"=>"input_par_to_single_id");
 $interfaceLabel3->setAttribs($attribs);
 $interfaceLabel3->setTagBody(LABEL_NUOVO_PAR); 

 $intSpan7 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);              
 //$intSpan5 = new Html_span_tag();
 $intSpan7->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $interfaceInput3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$interfaceInput2 = new Html_input_tag();
 $attribs = array("id"=>"input_par_to_single_id","type"=>"text", "size"=>"25");
 $interfaceInput3->setAttribs($attribs);

 $intSpan8 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);                
 //$intSpan6 = new Html_span_tag();
 $intSpan8->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);               
 //$intButton1 = new Html_button_tag();
 $intButton1->setTagBody("+");
 $attribs = array("id"=>"button_single_1","onclick"=>"button_add_voice_to_single_onClick();");
 $intButton1->setAttribs($attribs);

 $intSpan9 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);                
 //$intSpan7 = new Html_span_tag();
 $intSpan9->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intButton2 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);                
 //$intButton2 = new Html_button_tag();
 $intButton2->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_single_2","onclick"=>"button_apply_to_single_onClick();");
 $intButton2->setAttribs($attribs); 

 $intDiv4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);                
 //$intDiv4 = new Html_div_tag();
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL);
 $intDivCont->add($interfaceLabel1);
 $intDivCont->add($interfaceInput1);
 $intDivCont->add($intSpan4);
 $intDivCont->add($interfaceLabel2);
 $intDivCont->add($intSpan5);
 $intDivCont->add($interfaceInput2);
 $intDivCont->add($intSpan6);
 $intDivCont->add($interfaceLabel3);
 $intDivCont->add($intSpan7);
 $intDivCont->add($interfaceInput3);
 $intDivCont->add($intSpan8); 
 $intDivCont->add($intButton1);
 $intDivCont->add($intSpan7);
 $intDivCont->add($intButton2);
 $intDiv4->setInterfacesContainer($intDivCont);

 $intBr2 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);                 
 //$intBr2 = new Html_br_tag(); 

 $intButton3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);                 
 //$intButton3 = new Html_button_tag();
 $intButton3->setTagBody(LABEL_TEST_PREVIEW); 
 $intButton3->setAttribs(array("onclick"=>"button_test_preview_onClick(this)"));

 $intButton4 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);                 
 //$intButton4 = new Html_button_tag();
 $intButton4->setTagBody(LABEL_EDIT); 
 $intButton4->setAttribs(array("onclick"=>"button_edit_onClick(this)"));

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);                  
 //$interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_COSTRUTTORE_MENUS_LIVELLO_SINGOLO);
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
 $interfaceFrameContainer2->add($intBr1);
 $interfaceFrameContainer2->add($intDiv4);
 $interfaceFrameContainer2->add($intBr2);
 $interfaceFrameContainer2->add($intButton3);
 $interfaceFrameContainer2->add($intButton4);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 // **********
 // Multi menu
 // **********

 $label6 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);                   
 //$label6 = new Html_label_tag();
 $label6->setTagBody(LABEL_PAGINE);

 $inputCtrl4 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);                    
 //$inputCtrl4 = new Html_input_ctrl();
 $inputCtrl4->addField(FIELD_MULTI_PAGINE,array(),Int_domain::FIELD_DOMAIN_SET);
 $inputCtrl4->setDataFieldEvents(array("pagine_onChange(this,'multi');"));

 $intBr5 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr5 = new Html_br_tag();

 $intBr6 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL); 
 //$intBr6 = new Html_br_tag();
 
 $intSpan10 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan8 = new Html_span_tag();
 $intSpan10->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label7 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);
 //$label7 = new Html_label_tag();
 $label7->setTagBody(LABEL_MENUS);

 $inputCtrl5 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);
 //$inputCtrl5 = new Html_input_ctrl();
 $inputCtrl5->addField(FIELD_MULTI_MENUS,array(),Int_domain::FIELD_DOMAIN_SET);

 $intSpan11 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);
 //$intSpan9 = new Html_span_tag();
 $intSpan11->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label8 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);  
 //$label8 = new Html_label_tag() ;
 $label8->setTagBody(LABEL_MULTI_OP  . ENTITY_SPACE); 

 $inputTag3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL); 
 //$inputTag3 = new Html_input_tag();
 $inputTag3->setAttribs(array("id"=>"Multi_op","onchange"=>"input_multi_op_onChange(this);"));

 $intSpan12 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL); 
 //$intSpan10 = new Html_span_tag();
 $intSpan12->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $label9 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);    
 //$label9 = new Html_label_tag() ;
 $label9->setTagBody(LABEL_MULTI_NUM  . ENTITY_SPACE); 

 $inputTag4 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);  
 //$inputTag4 = new Html_input_tag();
 $inputTag4->setAttribs(array("id"=>"Multi_num","size"=>"7",
 "value"=>"0","onchange"=>"input_multi_num_onChange(this);"));

 $intBr7 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);  
 //$intBr7 = new Html_br_tag();

 $intBr8 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);   
 //$intBr8 = new Html_br_tag();

 $label12 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);    
 //$label12 = new Html_label_tag() ;
 $label12->setTagBody(LABEL_SHORTNAME  . ENTITY_SPACE . ENTITY_SPACE); 

 $inputTag7 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);   
 //$inputTag7 = new Html_input_tag();
 $inputTag7->setAttribs(array("id"=>LABEL_MULTI_SHORTNAME,"size"=>"25",
 "onchange"=>"multi_shortName_onChange(this);")); 

 $label13 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);     
 //$label13 = new Html_label_tag() ;
 $label13->setTagBody(" - " . LABEL_USA_COME_NOME_FILE_INTERFACCIA . STRING_COLON); 

 $inputTag8 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);    
 //$inputTag8 = new Html_input_tag();
 $inputTag8->setAttribs(array("id"=>"Multi_checkBox_IFreeName",
 "type"=>"checkbox","value"=>"true","onclick"=>"multi_checkbox_IFreeName_onClick(this);")); 

 $interfaceDivTag5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);     
 //$interfaceDivTag5 = new Html_div_tag();
 $interfaceDivTagContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer5 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer5->add($label6);
 $interfaceDivTagContainer5->add($inputCtrl4);
 $interfaceDivTagContainer5->add($intSpan10);
 $interfaceDivTagContainer5->add($label7);
 $interfaceDivTagContainer5->add($inputCtrl5);
 $interfaceDivTagContainer5->add($intSpan11);
 $interfaceDivTagContainer5->add($label8);
 $interfaceDivTagContainer5->add($inputTag3);
 $interfaceDivTagContainer5->add($intSpan12);
 $interfaceDivTagContainer5->add($label9);
 $interfaceDivTagContainer5->add($inputTag4);
 $interfaceDivTagContainer5->add($intBr7);
 $interfaceDivTagContainer5->add($intBr8);
 $interfaceDivTagContainer5->add($label12);
 $interfaceDivTagContainer5->add($inputTag7);
 $interfaceDivTagContainer5->add($label13);
 $interfaceDivTagContainer5->add($inputTag8);
 $interfaceDivTag5->setInterfacesContainer($interfaceDivTagContainer5);

 $interfaceHrTag2 = Creator::create(Interfaces_info::INT_HTML_HR_TAG,STRING_NULL);      
 //$interfaceHrTag2 = new Html_hr_tag(); 

 $interfaceBrTag3 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);        
 //$interfaceBrTag3 = new Html_br_tag(); 
 $interfaceBrTag4 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);        
 //$interfaceBrTag4 = new Html_br_tag(); 

 $interfaceDivTag6 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);           
 //$interfaceDivTag6 = new Html_div_tag();
 $interfaceDivTag6->setDispFields(array(LABEL_MENU));
 $decoratedIntDivTag6 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag6);           
 //$decoratedIntDivTag6 = new Html_fieldset_decorator($interfaceDivTag6);
 $decoratedIntDivTag6->setCssClass(CSS_FRAME_DEC); 

 $interfaceDivTagContainer7 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceDivTagContainer7 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag7 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);           
 //$interfaceDivTag7 = new Html_div_tag();
 $interfaceDivTagContainer7->add($interfaceDivTag5);
 $interfaceDivTagContainer7->add($interfaceBrTag3);
 $interfaceDivTagContainer7->add($interfaceHrTag2);
 $interfaceDivTagContainer7->add($decoratedIntDivTag6);
 $interfaceDivTag7->setInterfacesContainer($interfaceDivTagContainer7);

 $intBr7 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);         
 //$intBr7 = new Html_br_tag();   

 $interfaceLabel3 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);         
// $interfaceLabel3 = new Html_label_tag();
 $attribs = array("for"=>"input_voice_to_multi_id","style"=>"display:block;");
 $interfaceLabel3->setAttribs($attribs);
 $interfaceLabel3->setTagBody(LABEL_NUOVA_VOCE);

 $interfaceInput3 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);          
 //$interfaceInput3 = new Html_input_tag();
 $attribs = array("id"=>"input_voice_to_multi_id","type"=>"text", "size"=>"25");
 $interfaceInput3->setAttribs($attribs);

 $intSpan11 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);           
 //$intSpan11 = new Html_span_tag();
 $intSpan11->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $interfaceLabel4 = Creator::create(Interfaces_info::INT_HTML_LABEL_TAG,STRING_NULL);          
 //$interfaceLabel4 = new Html_label_tag();
 $attribs = array("for"=>"input_page_to_multi_id");
 $interfaceLabel4->setAttribs($attribs);
 $interfaceLabel4->setTagBody(LABEL_NUOVO_URL . ENTITY_SPACE); 

 $intSpan12 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);          
 //$intSpan12 = new Html_span_tag();
 $intSpan12->setTagBody(ENTITY_SPACE . ENTITY_SPACE);

 $interfaceInput4 = Creator::create(Interfaces_info::INT_HTML_INPUT_TAG,STRING_NULL);           
 //$interfaceInput4 = new Html_input_tag();
 $attribs = array("id"=>"input_page_to_multi_id","type"=>"text", "size"=>"25");
 $interfaceInput4->setAttribs($attribs);

 $intSpan13 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);            
 //$intSpan13 = new Html_span_tag();
 $intSpan13->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $inputCtrl6 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);           
 //$inputCtrl6 = new Html_input_ctrl();
 $inputCtrl6->addField(FIELD_CHOOSE_SUBMENU,array("Object"=>"Object","Array"=>"Array"),
 Int_domain::FIELD_DOMAIN_RADIO);
 $inputCtrl6->setDataFieldEvents(array(STRING_NULL,"if(\$(this).get(0).value=='Object')" .
 "{\$('#html_input_ctrl__6_Array_submenu_div_id').show();\$('#html_tags__45').hide();}else " .
 "{\$('#html_input_ctrl__6_Array_submenu_div_id').hide();\$('#html_tags__45').show();}"));
 $inputCtrl6->setPrefixBeforeName(true);

 $inputCtrl7 = Creator::create(Interfaces_info::INT_HTML_INPUT_CTRL,STRING_NULL);           
 //$inputCtrl7 = new Html_input_ctrl();
 $inputCtrl7->addField(FIELD_ARRAY_SUBMENU,array());
 $inputCtrl7->setPrefixBeforeName(true);

 $inputTag5 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);            
 //$inputTag5 = new Html_textarea_tag();
 $inputTag5->setTagBody("array()");

 $intDiv9 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);            
 //$intDiv9 = new Html_div_tag();
 $intDivContainer9 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivContainer9 = new Interfaces_container(STRING_NULL);
 $intDivContainer9->add($inputCtrl6);
 $intDivContainer9->add($inputCtrl7);
 $intDivContainer9->add($inputTag5);
 $intDiv9->setInterfacesContainer($intDivContainer9);

 $intBr9 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);             
 //$intBr9 = new Html_br_tag(); 

 $intBr10 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);               
 //$intBr10 = new Html_br_tag(); 

 $intButton3 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);              
 //$intButton3 = new Html_button_tag();
 $intButton3->setTagBody("+");
 $attribs = array("id"=>"button_single_1","onclick"=>"button_add_voice_to_multi_onClick();");
 $intButton3->setAttribs($attribs);

 $intSpan14 = Creator::create(Interfaces_info::INT_HTML_SPAN_TAG,STRING_NULL);                
 //$intSpan14 = new Html_span_tag();
 $intSpan14->setTagBody(ENTITY_SPACE . ENTITY_SPACE . ENTITY_SPACE);

 $intButton4 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);                 
 //$intButton4 = new Html_button_tag();
 $intButton4->setTagBody(LABEL_BUTTON_APPLICA);
 $attribs = array("id"=>"button_single_2","onclick"=>"button_apply_to_multi_onClick();");
 $intButton4->setAttribs($attribs); 

 $intBr11 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);                
 //$intBr11 = new Html_br_tag(); 

 $intDiv8 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);             
 //$intDiv8 = new Html_div_tag();
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL);
 $intDivCont->add($interfaceLabel3);
 $intDivCont->add($interfaceInput3);
 $intDivCont->add($intSpan11);
 $intDivCont->add($interfaceLabel4);
 $intDivCont->add($intSpan12);
 $intDivCont->add($interfaceInput4);
 $intDivCont->add($intSpan13);
 $intDivCont->add($intDiv9);
 //$intDivCont->add($intBr11);
 $intDivCont->add($intBr9);
 $intDivCont->add($intBr10);
 $intDivCont->add($intButton3);
 $intDivCont->add($intSpan14);
 $intDivCont->add($intButton4);
 $intDiv8->setInterfacesContainer($intDivCont); 

 $intBr8 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);                  
 //$intBr8 = new Html_br_tag(); 

 $intButton5 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);                 
 //$intButton5 = new Html_button_tag();
 $intButton5->setTagBody(LABEL_TEST_PREVIEW); 
 $intButton5->setAttribs(array("onclick"=>"button_multi_test_preview_onClick(this)"));

 $interfaceFrame3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);               
 //$interfaceFrame3 = new Html_div_tag();
 $dispFields = array(LABEL_COSTRUTTORE_MENUS_LIVELLO_MULTIPLO);
 $interfaceFrame3->setDispFields($dispFields);
 $attribs = array("style"=>"padding:10px 10px 10px 10px;");
 $interfaceFrame3->setAttribs($attribs);
 define("FRAME_CONTAINER_5","FrameCont5");
 $decoratedIntFrame3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame3);               
 //$decoratedIntFrame3 = new Html_fieldset_decorator($interfaceFrame3);
 $decoratedIntFrame3->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer3->add($interfaceDivTag7);
 $interfaceFrameContainer3->add($intBr7);
 $interfaceFrameContainer3->add($intDiv8);
 $interfaceFrameContainer3->add($intBr8);
 $interfaceFrameContainer3->add($intButton5);
 $interfaceFrame3->setInterfacesContainer($interfaceFrameContainer3);
 
 // ****************

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);                
 //$interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $attribs = array("style"=>"background-color:#290094;" .
 "border:1px solid white;padding:10px 10px 10px 10px;");
 $interfaceFrame1->setAttribs($attribs); 
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceMenuBar1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($decoratedIntFrame3);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 //
 // Single menu Javascript interfaces
 //
 
 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("var id = $(\"#Pagine\").val();ajaxHandler.serverCall(\"" . 
 AJAX_HANDLER_PAGE . 
 "\",\"" . AJAX_OP_GET_SINGLE_MENUS . "\",id,\"xml\",/[.]*ind_records[.]*/);");

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewSingleMenuFieldsOp2",NUM_1);
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("viewSingleMenuFieldsOp2",NUM_1);
 $dataFields = array(FIELD_VOICE,FIELD_PAGE,FIELD_PAR);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setEnableDataFromRemote(false); 
 $interfaceJavascriptTemplate2->setEnableExecuteOnLoad(false); 
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"SMenu_row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"30%\"><input id=\"Smenu_voice_id_{COUNT}\" class=\"Voices\" style=\"width:100%\" value=\"{VOICE}\" onchange=\"sMenu_field_input_onChange(this);\"></input></td>" .
 "<td width=\"30%\"><input id=\"Smenu_page_id_{COUNT}\" class=\"Pages\" style=\"width:100%\" value=\"{PAGE}\" onchange=\"sMenu_page_input_onChange(this);\"></input></td>" .
 "<td width=\"30%\"><input id=\"Smenu_par_id_{COUNT}\" class=\"Pars\" style=\"width:100%\" value=\"{PAR}\" onchange=\"sMenu_par_input_onChange(this);\"></input></td>" .
 "<td width=\"10%\"><img src=\"./img/close.gif\"" .
 " onclick=\"" .
 "var parent = $(this).parent().parent();parent.remove();" .
 "var i=0;" .
 "\$('#tbody_id > tr').each(function(){this.id='SMenu_row_id_' + i;" .
 "\$(this).find('td > input').get(0).id = 'SMenu_voice_id_' + i;" .
 "\$(this).find('td > input').get(1).id = 'SMenu_page_id_' + i;" .
 "\$(this).find('td > input').get(2).id = 'SMenu_par_id_' + i;i++;});" . 
 "\"></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewSingleMenuFieldsOp1",NUM_1);
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("viewSingleMenuFieldsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__11");
 $interfaceJavascriptTemplate1->setEnableExecuteOnLoad(true);
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"SMenuFields\" cellpadding=\"5\" width=\"100%\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_VOCI . "</th>" .
 "<th>"  . LABEL_PAGINE .  "</th>" .
 "<th>"  . LABEL_PARS .  "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>");
 
 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewSingleMenuFieldsOp3",NUM_1); 
 //$interfaceJavascriptFrag2 = new Javascript_fragment("viewSingleMenuFieldsOp3",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL); 
 $interfaceJavascriptFrag2->setEnableExecuteOnload(true);
 $interfaceJavascriptFrag2->setJavascriptFragment("dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = \$(\"#SMenuFields > tbody > tr\").size();" .
  	"tr.id= \"SMenu_row_id_\" + num;" .
	
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.style.width=\"100%\";" . 
    "input.value = actItem.voice;" . 
    "input.id=\"SMenu_voice_id_\" + num;"  .
    "\$(input).addClass(\"Voices\");" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
	
    "var td2 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.page;" . 
    "input.style.width=\"100%\";" . 
    "input.id=\"SMenu_page_id_\" + num;"  .
    "\$(input).addClass(\"Pages\");" .
    "td2.appendChild(input);" .
    "tr.appendChild(td2);" .

    "var td3 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.par;" . 
    "input.style.width=\"100%\";" . 
    "input.id=\"SMenu_par_id_\" + num;"  .
    "\$(input).addClass(\"Pars\");" .
    "td3.appendChild(input);" .
    "tr.appendChild(td3);" .
	
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){" .
    "var parent=\$(this).parent().parent();parent.remove();" .
    "var i=0;" .
    "\$(\"#tbody_id > tr\").each(function(){this.id=\"SMenu_row_id_\" + i;" .
    "\$(this).find(\"td > input\").get(0).id = \"SMenu_voice_id_\" + i;" .
    "\$(this).find(\"td > input\").get(1).id = \"SMenu_page_id_\" + i;" .
    "\$(this).find(\"td > input\").get(2).id = \"SMenu_par_id_\" + i;" .
	"i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    " });");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);     
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("this.getServerName=function(){" .
 "return \"" . $_SERVER["SERVER_NAME"] . "\";};this.getDocRoot=function(){" .
 "return \"" . getDocumentRoot() . "\";};");

 //
 // Multi menu Javascript interfaces
 //

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);     
 //$interfaceJavascriptFrag4 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment("var id = $(\"#Multi_pagine\").val();ajaxHandler.serverCall(\"" . 
 AJAX_HANDLER_PAGE . 
 "\",\"" . AJAX_OP_GET_MULTI_MENUS . "\",id,\"xml\",/[.]*ind_records[.]*/);");

 $interfaceJavascriptTemplate4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewMultiMenuFieldsOp2",NUM_1);
 //$interfaceJavascriptTemplate4 = new Javascript_data_template("viewMultiMenuFieldsOp2",NUM_1);
 $dataFields = array(FIELD_VOICE,FIELD_PAGE,FIELD_SUBMENU);
 $interfaceJavascriptTemplate4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate4->setEnableDataFromRemote(false); 
 $interfaceJavascriptTemplate4->setEnableExecuteOnLoad(false); 
 $interfaceJavascriptTemplate4->setDataExchangeType("xml");
 $interfaceJavascriptTemplate4->setJavascriptTemplate("<tr id=\"MMenu_row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"30%\"><input id=\"Mmenu_voice_id_{COUNT}\" class=\"Voices\"  style=\"width:100%\" value=\"{VOICE}\" onchange=\"mMenu_field_input_onChange(this);\"></input></td>" .
 "<td width=\"30%\"><input id=\"Mmenu_page_id_{COUNT}\" class=\"Pages\"  style=\"width:100%\" value=\"{PAGE}\" onchange=\"mMenu_page_input_onChange(this);\"></input></td>" .
 "<td width=\"30%\"><textarea id=\"Mmenu_submenu_id_{COUNT}\" style=\"width:300px\" class=\"SubMenus\" onchange=\"mMenu_subMenu_textarea_onChange(this);\">{SUBMENU}</textarea></td>" .
 "<td width=\"10%\"><img src=\"./img/close.gif\"" .
 " onclick=\"" .
 "var parent = $(this).parent().parent();parent.remove();" .
 "var i=0;" .
 "\$('#m_tbody_id > tr').each(function(){this.id='MMenu_row_id_' + i;" .
 "\$(this).find('td > input').get(0).id = 'MMenu_voice_id_' + i;" .
 "\$(this).find('td > input').get(1).id = 'MMenu_page_id_' + i;" .
 "\$(this).find('td > textarea').get(0).id = 'MMenu_submenu_id_' + i;i++;});" . 
 "\"></img></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"viewMultiMenuFieldsOp1",NUM_1);
 //$interfaceJavascriptTemplate3 = new Javascript_data_template("viewMultiMenuFieldsOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate4);
 $interfaceJavascriptTemplate3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate3->setHookId("html_tags__38");
 $interfaceJavascriptTemplate3->setEnableExecuteOnLoad(true);
 $interfaceJavascriptTemplate3->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate3->setJavascriptTemplate("<table id=\"MMenuFields\" cellpadding=\"5\" width=\"100%\">" .
 "<thead>" .
 "<tr>" .
 "<th>" . LABEL_VOCI . "</th>" .
 "<th>"  . LABEL_URLS .  "</th>" .
 "<th>"  . LABEL_SUBMENUS .  "</th>" .
 "<th></th>" .
 "</tr></thead><tbody id=\"m_tbody_id\">{OBJ_1}" .
 "</tbody></table>");
 
 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"viewMultiMenuFieldsOp3",NUM_1);
 //$interfaceJavascriptFrag5 = new Javascript_fragment("viewMultiMenuFieldsOp3",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL); 
 $interfaceJavascriptFrag5->setEnableExecuteOnLoad(true);
 $interfaceJavascriptFrag5->setJavascriptFragment("dndSourceMulti = " .
 "new dojo.dnd.Source(\"m_tbody_id\",{skipForm:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#MMenuFields > tbody > tr\").size();" .
  	"tr.id= \"MMenu_row_id_\" + num;" .
    "var td1 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" . 
    "input.value = actItem.voice;" . 
    "input.style.width='100%';" . 
    "input.id=\"MMenu_voice_id_\" + num;"  .
    "$(input).addClass('Voices');" .
    "td1.appendChild(input);" .
    "tr.appendChild(td1);" .
    "var td2 = document.createElement(\"td\");" .
    "var input = document.createElement(\"input\");" .
    "input.value = actItem.page;" .
    "input.style.width='100%';" .  
    "input.id=\"MMenu_page_id_\" + num;"  .
    "$(input).addClass('Pages');" .
    "td2.appendChild(input);" .
    "tr.appendChild(td2);" .
    "var td3 = document.createElement(\"td\");" .
    "var textarea = document.createElement(\"textarea\");" .
    "textarea.innerHTML = actItem.submenu;" . 
    "textarea.style.width='300px';" . 
    "textarea.id=\"MMenu_submenu_id_\" + num;"  .
    "$(textarea).addClass('SubMenus');" .
    "td3.appendChild(textarea);" .
    "tr.appendChild(td3);" .    
    "var img = document.createElement(\"img\");" .
    "img.src=\"./img/close.gif\";" . 
    "var imgObj = \$(img).click(function(){" .
    "var parent = $(this).parent().parent();parent.remove();" .
    "var i=0;" .
    "\$('#m_tbody_id > tr').each(function(){this.id='MMenu_row_id_' + i;" .
    "\$(this).find('td > input').get(0).id = 'MMenu_voice_id_' + i;" .
    "\$(this).find('td > input').get(1).id = 'MMenu_page_id_' + i;" .
    "\$(this).find('td > textarea').get(0).id = 'MMenu_submenu_id_' + i;i++;});" .
    "});" . 
    "var td4 = document.createElement(\"td\");" . 
    "td4.appendChild(img);" .
    "tr.appendChild(td4);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    "});");

 $interfaceJavascriptFrag6 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1); 
 //$interfaceJavascriptFrag6 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag6->setHookId(STRING_NULL);
 $interfaceJavascriptFrag6->setJavascriptFragment(
 "var page=\$('#Pagine option:selected').text();" . 
 "var pMenu1 = new dijit.Menu({" .
 "targetNodeIds:['html_tags__27']});" .
 "var app=\$('#active_application_label_id').text();" .
 "if(page != ''){" . 
 "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_CSS . "'," .
 "onClick:function(){var nomePagina = $('#Pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\\s*/g,'');" .
 "ajaxHandler.synServerCall('ajax_handler.php'," .
 "'" . AJAX_OP_FILE_EXISTS . "','../' + app + '/css/' + app.toLowerCase() + '_' + nomePagina + '.css','xml',/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "var fileExists = ajaxHandler.getOpByName('" . AJAX_OP_FILE_EXISTS . "').testResult;" .
 "if(fileExists=='true'){" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/css/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.css'" .
 ",700,400,function(actVar){},true);}else{alert(loc.getString('msg',86));}" .  	
 "}}));" . 
  "pMenu1.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_JS . "'," .
 "onClick:function(){var nomePagina = $('#Pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\\s*/g,'');" .
 "ajaxHandler.synServerCall('ajax_handler.php'," .
 "'" . AJAX_OP_FILE_EXISTS . "','../' + app + '/js/' + app.toLowerCase() + '_' + nomePagina + '.js','xml',/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "var fileExists = ajaxHandler.getOpByName('" . AJAX_OP_FILE_EXISTS . "').testResult;" .
 "if(fileExists=='true'){" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/js/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.js'" .
 ",700,400,function(actVar){},true);}else{alert(loc.getString('msg',86));}" .  	
 "}}));}" .
 "pMenu1.startup();");  

 $interfaceJavascriptFrag7 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_1);  
 //$interfaceJavascriptFrag7 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptFrag7->setHookId(STRING_NULL);
 $interfaceJavascriptFrag7->setJavascriptFragment(
 "var page=\$('#Multi_pagine option:selected').text();" . 
 "var pMenu2 = new dijit.Menu({" .
 "targetNodeIds:['html_tags__52']});" .
 "var app=\$('#active_application_label_id').text();" .
 "if(page != ''){" . 
 "pMenu2.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_CSS . "'," .
 "onClick:function(){var nomePagina = $('#Multi_pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\\s*/g,'');" .
 "ajaxHandler.synServerCall('ajax_handler.php'," .
 "'" . AJAX_OP_FILE_EXISTS . "','../' + app + '/css/' + app.toLowerCase() + '_' + nomePagina + '.css','xml',/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "if(fileExists=='true'){" .
 "var fileExists = ajaxHandler.getOpByName('" . AJAX_OP_FILE_EXISTS . "').testResult;" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/css/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.css'" .
 ",700,400,function(actVar){},true);}else{alert(loc.getString('msg',86));};" .  	
 "}}));" . 
  "pMenu2.addChild(new dijit.MenuItem({label:'" . LABEL_EDITA_PREVIEW_JS . "'," .
 "onClick:function(){var nomePagina = $('#Multi_pagine option:selected').get(0).value;" .
 "var app = $('#active_application_id').text().replace(/\\s*/g,'');" .
 "ajaxHandler.synServerCall('ajax_handler.php'," .
 "'" . AJAX_OP_FILE_EXISTS . "','../' + app + '/js/' + app.toLowerCase() + '_' + nomePagina + '.js','xml',/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);" .
 "if(fileExists=='true'){" .
 "var fileExists = ajaxHandler.getOpByName('" . AJAX_OP_FILE_EXISTS . "').testResult;" .
 "subModal.showPopWin('view_module.php?Par=../' + app + '/js/' + " .
 "app.toLowerCase() + '_' + nomePagina + '.js'" .
 ",700,400,function(actVar){},true);}else{alert(loc.getString('msg',86));};" .  	
 "}}));}" .
 "pMenu2.startup();");

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
 $interfacesContainer->add($inputCtrl4);
 $interfacesContainer->add($inputCtrl5);
 $interfacesContainer->add($inputCtrl7);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptTemplate4);
 $interfacesContainer->add($interfaceJavascriptTemplate3);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag4);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($interfaceJavascriptFrag6);
 $interfacesContainer->add($interfaceJavascriptFrag7);
 $interfacesContainer->add($decoratedIntFrame2);
 $interfacesContainer->add($decoratedIntFrame3);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_menus_op_page();
 $ajaxOps = array(AJAX_OP_SET_SESSION_ACTIVE_APP,AJAX_OP_GET_SINGLE_MENUS,
 AJAX_OP_VIEW_SINGLE_MENU_FIELDS_OP2,AJAX_OP_SET_SINGLE_MENU,
 AJAX_OP_CREATE_PREVIEW,AJAX_OP_GET_MULTI_MENUS,AJAX_OP_VIEW_MULTI_MENU_FIELDS_OP2,
 AJAX_OP_SET_MULTI_MENU,
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME,
 AJAX_OP_FILTER_PARENTS_INTERFACES_FILES,
 AJAX_OP_GET_ALL_INTERFACES_OF_PAGE,
 AJAX_OP_FILE_EXISTS,
 AJAX_OP_DOJO_IN_PREVIEW,
 AJAX_OP_TEST_INT_FORMAT, AJAX_OP_INTERFACE_EXISTS);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setBodyOnLoad("\$('#html_tags__45').hide();" .
 "\$('#html_input_ctrl__6_Array_submenu_div_id').hide();");
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>