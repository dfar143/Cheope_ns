<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_6_op_page.class.php");

 $interfacePhpDataFrag1 = new Php_data_fragment(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_ID_PROVA_2);
 $interfacePhpDataFrag1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfacePhpDataFrag1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfacePhpDataFrag1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfacePhpDataFrag1->setPhpFragment("\$fieldVal = #ID_PROVA_2#;\$htmlWriter = \$thisObj->getHtmlWriter();" . 
 "\$row=\$thisObj->getExternalParFromProc(\$fieldVal);" .
 "\$htmlWriter->putUlOpenTag();for(\$i=0;\$i<=count(\$row)-1;\$i++){\$htmlWriter->putLiOpenTag();" .
 "\$htmlWriter->putGenericHtmlString(\$row[\$i]);\$htmlWriter->putGenericHtmlString('</li>');" . 
 "\$htmlWriter->putGenericHtmlString('</ul>');}");

 $interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_TEMP_1);
 $interfaceNLevelsMenu1->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceNLevelsMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfacePhpDataFrag1);
 $interfaceNLevelsMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu1->setInheritData(true);
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(3);
 $interfaceFrame1->setColsNum(2);
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
 $interfacesContainer->add($interfacePhpDataFrag1);
 $interfacesContainer->add($interfaceNLevelsMenu1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_6_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 
?>