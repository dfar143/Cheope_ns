<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_40_op_page.class.php");

 $interfaceFragment1 = new Html_fragment(OP_NONE,NUM_1);
 $interfaceFragment1->setHtmlFragment("<p>" .
 "<label for=\"amount\">Price range:</label>" .
 "<input type=\"text\" id=\"amount\" readonly style=\"border:0; color:#f6931f; font-weight:bold;\">" .
 "</p>" .
 "<div id=\"slider\"></div>");
 
 $interfaceLForm1 = new Cheope_ns_form(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3);
 $interfaceLForm1->setDbStruct($dbStructTree);
 $interfaceLForm1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceLForm1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,$interfaceFragment1);
 $interfaceLForm1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceLForm1->setCssClass(CSS_FORM);
 $fieldsLabels=array("Data_1","Data_2","Data_3");
 $interfaceLForm1->setFieldsLabels($fieldsLabels);
 $interfaceLForm1->setJavascriptEnabled(true);
 $interfaceLForm1->setDataFieldsRegexpValidationEnabled(true);
 $interfaceLForm1->setStringDataFieldsRegexps(array(FIELD_DATA_2=>"^(\\\\d){1,3}$")); 
 
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
 $interfacesContainer->add($interfaceFragment1);
 $interfacesContainer->add($interfaceLForm1);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_40_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setBodyOnLoad("\$(function() {\$( '#slider' ).slider({" .
      "range: true," .
      "min: 0," .
      "max: 500," .
      "values: [ 75, 300 ]," .
      "slide: function( event, ui ) {" .
        "$('#amount' ).val( '$' + ui.values[ 0 ] + ' - $' + ui.values[ 1 ] );" .
      "}" .
    "});" .
    "$( '#amount' ).val( '$' + $( '#slider' ).slider( 'values', 0 ) + " .
      "' - $' + $( '#slider' ).slider( 'values', 1 ) );" .
  "});");
 $page->putData();
 
 
?>