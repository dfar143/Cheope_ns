<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_67_op_page.class.php");

 $interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array("ind_users");
 $interfaceNLevelsMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceNLevelsMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceNLevelsMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu1->setCssClass(STRING_SPACE);
 $interfaceNLevelsMenu1->setItemCssClass(STRING_SPACE);

 $intHtmlSpan1 = new Html_span_tag(OP_NONE,NUM_1);

 $intFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $intFrame1->setRowsNum(2);
 $intFrame1->setColsNum(1);
 
 $intFrameContainer1 = new Interfaces_container("");
 $intFrameContainer1->add($intHtmlSpan1);
 $intFrameContainer1->add($interfaceNLevelsMenu1);
 $intFrame1->setInterfacesContainer($intFrameContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceNLevelsMenu1);
 $interfacesContainer->add($intHtmlSpan1);
 $interfacesContainer->add($intFrame1);
 
 $page = new Cheope_ns_prova_67_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->setCREnabled(true);
 $page->putData();
 
 
?>