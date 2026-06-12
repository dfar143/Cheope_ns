<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_19_op_page.class.php");

 $interfaceButton1 = new Html_button_tag(OP_NONE,NUM_1);
 $interfaceButton1->setTagBody("Exec");
 $attribs = array("onclick" =>"ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . 
 "','" . AJAX_OP_OP5 . "','','text')");
 $interfaceButton1->setAttribs($attribs);

 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($interfaceButton1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_2);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);
 $interfaceDivTag1->setTagBody("ciao ciao");

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceButton1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_19_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $ajaxOps = array(AJAX_OP_OP5);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 ?>
