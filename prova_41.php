<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_41_op_page.class.php");

 $interfaceHtmlTag2 = new Html_input_tag(OP_NONE,NUM_2);
 $attribs = array("id"=>"jquery_input_2","name"=>"jquery_input_2","onchange"=>"if (! objForm_form__1.evalField(this)){this.value='';return false}else return true;");
 $interfaceHtmlTag2->setAttribs($attribs);
 
 /*$interfaceHtmlTag3 = new Html_input_tag(OP_NONE,NUM_3);
 $attribs = array("id"=>"jquery_input_3","name"=>"jquery_input_3","type"=>"text", 
 "required"=>"true","data-message"=>"Errore validazione","pattern"=>"[a-zA-Z ]{5,}");
 $interfaceHtmlTag3->setAttribs($attribs);*/
 
 $interfaceLForm1 = new Cheope_ns_form(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceLForm1->setDbStruct($dbStructTree);
 $interfaceLForm1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceLForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE , $interfaceHtmlTag2);
 $interfaceLForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLForm1->setCssClass(CSS_FORM);
 $fieldsLabels = array("Data_1"=>"Data_1","Data_2"=>"Data_2");
 $interfaceLForm1->setFieldsLabels($fieldsLabels);
 //$interfaceLForm1->setJavascriptAutoValidatorEnabled(true);
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
 //$interfacesContainer->add($interfaceHtmlTag1);
 $interfacesContainer->add($interfaceHtmlTag2);
 //$interfacesContainer->add($interfaceHtmlTag3);
 $interfacesContainer->add($interfaceLForm1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_41_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 //$page->setBodyOnLoad("$(':range').rangeinput();");
 $page->putData();
 
 
?>