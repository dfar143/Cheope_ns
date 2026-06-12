<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_65_op_page.class.php");
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(1);
 $interfaceFrame1->setColsNum(1);
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_1","FrameCont1");
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
 $inputCtrl1 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $inputCtrl1->setDataFields(array(FIELD_DATA_1));
 $inputCtrl1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $inputCtrl1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 
 $inputCtrl2 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_2);
 $inputCtrl2->setDataFields(array(FIELD_DATA_2));
 $inputCtrl2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $inputCtrl2->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $inputCtrl2->setDataFieldEvents(array(FIELD_DATA_2=>array("if(!testFloatFormat(this.value)){alert('Errore formato.');this.value='';}")));
 
 $inputCtrl3 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_3);
 $inputCtrl3->setDbStruct($dbStructTree);
 $inputCtrl3->setDataFields(array(FIELD_ID_PROVA_2));
 $inputCtrl3->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_TABLE));
 $inputCtrl3->setDataFieldsDomainsValues(array(TABELLA_PROVA_2=>FIELD_DATA_1));

 $inputCtrl4 = new Html_input_ctrl(OBJ_NONE,OP_NONE,NUM_4);
 $inputCtrl4->setDataFields(array(FIELD_ID_PROVA));
 $inputCtrl4->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_HIDDEN));
 $inputCtrl4->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $inputCtrl4->setPrefixBeforeName(true);
 
 $intTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $intTemplate1->setDataFields(array(FIELD_ID_PROVA,FIELD_TEMP_1));
 $intTemplate1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_OBJ));
 $intTemplate1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,$inputCtrl4));
 $intTemplate1->setHtmlTemplate("<div id=\"Id_envelope\">{ID_PROVA}{TEMP_1}</div>");
 $intTemplate1->setInheritData(true);
 $intTemplate1->setInheritDataFieldName(true);
 
 $intSimpleTable1 = new Cheope_ns_simple_table(OBJ_NONE,OP_NONE,NUM_1);
 $intSimpleTable1->setDbStruct($dbStructTree);
 $intSimpleTable1->setDataFields(array(FIELD_TEMP_1,FIELD_DATA_1,FIELD_DATA_2,
 FIELD_DATA_3,FIELD_DATA_4,FIELD_ID_PROVA_2));
 $intSimpleTable1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ,
  Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $intSimpleTable1->setDataFieldsDomainsValues(array($intTemplate1,$inputCtrl1,
  $inputCtrl2,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $intSimpleTable1->setInheritData(true);
 $intSimpleTable1->setBorder("1");
 $intSimpleTable1->setFieldsCssClasses(array(FIELD_DATA_1=>"Colonna_1",FIELD_DATA_2=>"Colonna_2"));
 $intSimpleTable1->setJavascriptEnabled(true);
 $intSimpleTable1->setFilter(false);
 $intSimpleTable1->setLengthChange(true);
 $intSimpleTable1->setPaginate(true);
 
 $intHtmlButtonTag1 = new Html_button_tag(OP_NONE,NUM_2);
 $attribs2 = array("id"=>"submit_button","type"=>"submit");
 $intHtmlButtonTag1->setAttribs($attribs2);
 $intHtmlButtonTag1->setTagBody("SUBMIT");
 
 $htmlInputTag1 = new Html_input_tag(OP_NONE,NUM_3);
 $attribs3 = array("id"=>"Par1","name"=>"Par1","type"=>"hidden","value"=>"Par1");
 $htmlInputTag1->setAttribs($attribs3);
 
 $form1InterfaceCont = new Interfaces_container(STRING_NULL);
 $form1InterfaceCont->add($htmlInputTag1);
 $form1InterfaceCont->add($intSimpleTable1);
 $form1InterfaceCont->add($intHtmlButtonTag1);
 
 $htmlForm1 = new Html_form_tag(OP_NONE,NUM_1);
 $attribs1 = array("method"=>"post","enctype"=>MIME_1,"action"=>THIS_PAGE,"name"=>"form1");
 $htmlForm1->setAttribs($attribs1);
 $htmlForm1->setInterfacesContainer($form1InterfaceCont);
 
 $intDiv1 = new Html_div_tag(OP_NONE,NUM_1);

 $div1InterfacesContainer = new Interfaces_container(STRING_NULL);
 $div1InterfacesContainer->add($htmlForm1);
 
 $intDiv1->setInterfacesContainer($div1InterfacesContainer);
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($intDiv1);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);
 $interfacesContainer->add($intDiv1);
 $interfacesContainer->add($inputCtrl1);
 $interfacesContainer->add($inputCtrl2);
 $interfacesContainer->add($inputCtrl3);
 $interfacesContainer->add($inputCtrl4);
 $interfacesContainer->add($intTemplate1);
 $interfacesContainer->add($intSimpleTable1);
 
 $page = new Cheope_ns_prova_65_op_page();
 $page->setJQueryEnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->putData();
 
 
?>