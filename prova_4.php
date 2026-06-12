<? 
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_4_op_page.class.php");
 
 $interfaceScrollTable1 = new Cheope_ns_scrolling_table($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,
 FIELD_DATA_4);
 $interfaceScrollTable1->setDbStruct($dbStructTree);
 $interfaceScrollTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceScrollTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceScrollTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceScrollTable1->setColumnsDims(array("25%","25%","25%","25%"));
 $dispFields = array("Ciao ciao");
 $interfaceScrollTable1->setDispFields($dispFields);
 $interfaceScrollTable1->setCssClass(CSS_SCROLLING_TABLE);
 
 $interfaceSheet1 = new Cheope_ns_sheet($dbQueryQ_prova_2,OP_NONE,NUM_1);
 $interfaceSheet1->setDbStruct($dbStructTree);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2);
 $interfaceSheet1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceSheet1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceSheet1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $dispFields = array("By By");
 $interfaceSheet1->setDispFields($dispFields);
 $interfaceSheet1->setNumElPerCol(1);
 $interfaceSheet1->setCssClass(CSS_SHEET);
 
 //$attribs = array("onclick"=>"dynTable.displayTable('" . $interfaceScrollTable1->getInterfaceId() .  "');");
 $attribs = array("onclick"=> 
 "dynTable.setTarget('" . $interfaceScrollTable1->getInterfaceId() .  "');" . 
 "ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_GET_SCROLL_DATA . "','','Xml');");
 $interfaceButton1 = new Html_button_tag(OP_NONE,NUM_1);
 $interfaceButton1->setAttribs($attribs);
 
 $attribs = array("onclick"=> 
 "dynSheet.setTarget('" . $interfaceSheet1->getInterfaceId() .  "');" . 
 "ajaxHandler.serverCall('" . AJAX_HANDLER_PAGE . "','" . 
 AJAX_OP_GET_SHEET_DATA . "','2','Xml');");
 $interfaceButton2 = new Html_button_tag(OP_NONE,NUM_2);
 $interfaceButton2->setAttribs($attribs);
 
 $interfaceScript1 = new Html_script_tag(OP_NONE,NUM_3);
 $interfaceScript1->setTagBody("dynTable.setTarget('" . $interfaceScrollTable1->getInterfaceId() .  "');" .
 "setInterval('" . "ajaxHandler.serverCall(\"" . AJAX_HANDLER_PAGE . "\",\"" . 
 AJAX_OP_GET_SCROLL_DATA . "\",\"\",\"Xml\");" . "',5000);");
 
 $interfaceTagDiv1 = new Html_div_tag(OP_NONE,NUM_4);
 define("FRAME_CONTAINER_2","FrameCont2");
 $interfaceFrameContainer2 = new Interfaces_container(FRAME_CONTAINER_2);
 $interfaceFrameContainer2->add($interfaceButton1);
 $interfaceFrameContainer2->add($interfaceButton2);
 $interfaceTagDiv1->setInterfacesContainer($interfaceFrameContainer2); 
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1,3,1,"100%","100%");
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceScrollTable1);
 $interfaceFrameContainer1->add($interfaceSheet1);
 $interfaceFrameContainer1->add($interfaceTagDiv1);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceScrollTable1);
 $interfacesContainer->add($interfaceButton1);
 $interfacesContainer->add($interfaceButton2);
 $interfacesContainer->add($interfaceScript1);
 $interfacesContainer->add($interfaceScrollTable1);
 $interfacesContainer->add($interfaceSheet1);
 $interfacesContainer->add($interfaceTagDiv1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);
 
 $page = new Cheope_ns_prova_4_op_page();
 $ajaxOps = array(AJAX_OP_GET_SCROLL_DATA,AJAX_OP_GET_SHEET_DATA);
 $page->setAjaxOps($ajaxOps);
 $page->setJQueryEnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->putData();
 
?>

