<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_63_op_page.class.php");


 $interfaceSimpleTable1 = new Cheope_ns_simple_table($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2,FIELD_FUNC_1);
 $interfaceSimpleTable1->setDbStruct($dbStructTree);
 $interfaceSimpleTable1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_FUNCTION);
 $interfaceSimpleTable1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,function(){static $staticVar;$staticVar++;echo "func";return $staticVar;});
 $interfaceSimpleTable1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceSimpleTable1->setColumnsDims(array("25%","25%","25%","25%"));
 $interfaceSimpleTable1->setCssClass(CSS_SCROLLING_TABLE);
 $interfaceSimpleTable1->setBorder("1");
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(3);
 $interfaceFrame1->setColsNum(2);
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceSimpleTable1);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceSimpleTable1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_63_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 
?>