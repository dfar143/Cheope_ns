<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_module_op_page.class.php");

 $interfaceDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,OP_NONE,NUM_1);
 //$interfaceDiv1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));

 $interfaceDiv4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL,OP_NONE,NUM_4);
 //$interfaceDiv4 = new Html_div_tag(OP_NONE,NUM_4);
 $interfaceDiv4->setAttribs(array("id"=>"Div_tag_4")); 

 $interfaceJavascriptTxtEditor1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TXTEDITOR,STRING_NULL,"Op4",NUM_1);
 //$interfaceJavascriptTxtEditor1 = new Javascript_data_txtEditor("Op4",NUM_1);
 $interfaceJavascriptTxtEditor1->setHookId("Div_tag_4");
 $interfaceJavascriptTxtEditor1->setFileName((isset($_GET[PAR]))?($_GET[PAR]):(STRING_NULL));
 $interfaceJavascriptTxtEditor1->setCallBackFunPattern('/[\s\._\:A-Za-z0-9;\-\?\/<>="]*/');
 //$interfaceJavascriptTxtEditor1->setCallBackFunPattern('/[\s\.]*/');
 
 $interfacesContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"4");
 //$interfacesContainer4 = new Interfaces_container("4");
 $interfaceDiv4->setInterfacesContainer($interfacesContainer4);

 $interfacesContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"1");
 //$interfacesContainer1 = new Interfaces_container("1");
 $interfacesContainer1->add($interfaceDiv4);
 $interfaceDiv1->setInterfacesContainer($interfacesContainer1);

 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame4 = new Html_div_tag();
 $dispFields = array(LABEL_EDITING_MODULO);
 $interfaceFrame4->setDispFields($dispFields);
 $interfaceFrame4->setCREnabled(true);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame4);
 //$decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer4->add($interfaceDiv1);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $interfaceFrame5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame5 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame5->setCssClass(CSS_FRAME);
 $interfaceFrame5->setDispFields($dispFields);
 define("FRAME_CONTAINER_5","FrameCont5");

 $interfaceFrameContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceFrameContainer5 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer5->add($decoratedIntFrame4);
 $interfaceFrame5->setInterfacesContainer($interfaceFrameContainer5);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);  
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTxtEditor1);
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($interfaceDiv4);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($decoratedIntFrame4);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame5);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_view_module_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setlocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>