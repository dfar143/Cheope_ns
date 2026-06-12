<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_39_op_page.class.php");

 $interfaceHtmlTag1 = new Html_input_tag(OP_NONE,NUM_1);
 $attribs = array("id"=>"jquery_data_1","data-orig-type"=>"date",
 "class"=>"date","type"=>"text");
 $interfaceHtmlTag1->setAttribs($attribs);
 
 $interfaceHtmlTag2 = new Html_input_tag(OP_NONE,NUM_2);
 $attribs = array("id"=>"jquery_data_2","class"=>"date","type"=>"text");
 $interfaceHtmlTag2->setAttribs($attribs);
 
 $interfaceLForm1 = new Cheope_ns_form(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3
 ,FIELD_DATA_4);
 $interfaceLForm1->setDbStruct($dbStructTree);
 $interfaceLForm1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ
 ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceLForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 $interfaceHtmlTag1,$interfaceHtmlTag2);
 $interfaceLForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLForm1->setCssClass(CSS_FORM);
 $fieldsLabels=array("Data_1"=>"Data_1","Data_2"=>"Data_2",
 "Data_3"=>"Data_3","Data_4"=>"Data_4");
 $interfaceLForm1->setFieldsLabels($fieldsLabels);
 //$interfaceLForm1->setJQueryValidatorEnabled(true);
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1,2,2,"100%","100%");
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
  define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceLForm1);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlTag1);
 $interfacesContainer->add($interfaceLForm1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_39_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setBodyOnLoad("$('.date').datepicker()");
 $page->putData();
 
 
?>