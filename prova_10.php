<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_10_op_page.class.php");

 $interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceNLevelsMenu1->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET);
 $interfaceNLevelsMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(array("ciao","ciao"=>array("aPage"=>"aVal","b")),
 array("ciaociao","ciaociao"=>array("c","d")));
 $interfaceNLevelsMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1,3,2,"100%","100%");
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
  define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceNLevelsMenu1);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceNLevelsMenu1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_10_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->putData();
 
 
?>