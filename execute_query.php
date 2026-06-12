<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_execute_query_op_page.class.php");

 $intSimpleTable1 = Creator::create("Cheope_ns_simple_table",STRING_NULL,OBJ_NONE,OP_NONE,NUM_1);
 //$intSimpleTable1 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_1);

 $intDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv1 = new Html_div_tag();
 $dispFields = array(LABEL_RISULTATI);
 $intDiv1->setDispFields($dispFields);
 $intDivCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDivCont = new Interfaces_container(STRING_NULL);
 $intDivCont->add($intSimpleTable1);
 $intDiv1->setInterfacesContainer($intDivCont);
  
 $decoratedIntDiv1 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$intDiv1);
 //$decoratedIntDiv1 = new Html_fieldset_decorator($intDiv1);
 $decoratedIntDiv1->setCssClass(CSS_FRAME_DEC);
 
 $intButton1 = Creator::create(Interfaces_info::INT_HTML_BUTTON_TAG,STRING_NULL);
 //$intButton1 = new Html_button_tag();
 $attribs = array("id"=>"button_1","onclick"=>"button_1_onClick();");
 $intButton1->setAttribs($attribs);
 $intButton1->setTagBody(LABEL_ESPORTA_CSV); 
 
 $intBr1 = Creator::create(Interfaces_info::INT_HTML_BR_TAG,STRING_NULL);
 //$intBr1 = new Html_br_tag();
 
 $intDiv2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$intDiv2 = new Html_div_tag();
 $intDiv2Cont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$intDiv2Cont = new Interfaces_container(STRING_NULL);
 $intDiv2Cont->add($decoratedIntDiv1);
 $intDiv2Cont->add($intBr1);
 $intDiv2Cont->add($intButton1);
 $intDiv2->setInterfacesContainer($intDiv2Cont); 
 
 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE); 
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($intSimpleTable1);
 $interfacesContainer->add($decoratedIntDiv1);
 $interfacesContainer->add($intDiv2);
 
 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_execute_query_op_page();
 $ajaxOps = array(AJAX_OP_EXPORT_QUERY_TO_CSV);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>