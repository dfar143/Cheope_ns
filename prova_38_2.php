<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_38_2_op_page.class.php");

 $interfaceNLevelsMenu4 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_4);
 $dataFields = array(FIELD_DATA_7,FIELD_DATA_8);
 $interfaceNLevelsMenu4->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu4->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_SET);
 $interfaceNLevelsMenu4->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array("link5",array("link6"=>"www"));
 $interfaceNLevelsMenu4->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu4->setCssClass(STRING_SPACE);
 $interfaceNLevelsMenu4->setItemCssClass(STRING_SPACE);
 $interfaceNLevelsMenu4->setItemsEvents(array("if(!flag_nLevels_menu_3)" .
 "{\$('#nLevels_menu__4_ul_0_0').css('display','block');flag_nLevels_menu_3=true}" .
 "else if(flag_nLevels_menu_3)" .
 "{\$('#nLevels_menu__4_ul_0_0').css('display','none');flag_nLevels_menu_3=false};event.stopPropagation();"));

 $interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_3,FIELD_DATA_4);
 $interfaceNLevelsMenu1->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceNLevelsMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array("link2",$interfaceNLevelsMenu4);
 $interfaceNLevelsMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu1->setCssClass(STRING_SPACE);
 $interfaceNLevelsMenu1->setItemCssClass('menuItems1');
 $interfaceNLevelsMenu1->setItemsEvents(array("if(!flag_nLevels_menu_2)" .
 "{\$('#nLevels_menu__4').css('display','block');flag_nLevels_menu_2=true}" .
 "else if(flag_nLevels_menu_2)" .
 "{\$('#nLevels_menu__4').css('display','none');flag_nLevels_menu_2=false};event.stopPropagation();"));

 $interfaceNLevelsMenu2 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_2);
 $dataFields = array(FIELD_DATA_5,FIELD_DATA_6);
 $interfaceNLevelsMenu2->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC_STATIC,Int_domain::FIELD_DOMAIN_ATOMIC_STATIC);
 $interfaceNLevelsMenu2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array("link3","link4");
 $interfaceNLevelsMenu2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu2->setCssClass(STRING_SPACE);
 $interfaceNLevelsMenu2->setItemCssClass('menuItems2');

 $interfaceNLevelsMenu3 = new Cheope_ns_NLevels_menu(OBJ_NONE,OP_NONE,NUM_3);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceNLevelsMenu3->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu3->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ,Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceNLevelsMenu3->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceNLevelsMenu1,$interfaceNLevelsMenu2);
 $interfaceNLevelsMenu3->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu3->setCssClass(STRING_SPACE);
 $interfaceNLevelsMenu3->setItemCssClass(STRING_SPACE);
 $interfaceNLevelsMenu3->setItemsEvents(array("if((this.id=='Data_2_id')&&(!flag_nLevels_menu_1))" .
 "{\$('#nLevels_menu__2').css('display','block');flag_nLevels_menu_1=true}" .
 "else if((this.id=='Data_2_id')&&(flag_nLevels_menu_1))" .
 "{\$('#nLevels_menu__2').css('display','none');flag_nLevels_menu_1=false}" .
 "if((this.id=='Data_1_id')&&(!flag_nLevels_menu_0))" .
 "{\$('#nLevels_menu__1').css('display','block');flag_nLevels_menu_0=true}" .
 "else if((this.id=='Data_1_id')&&(flag_nLevels_menu_0))" .
 "{\$('#nLevels_menu__1').css('display','none');flag_nLevels_menu_0=false}"));
// $interfaceNLevelsMenu1->setJavascriptMenuEnabled(true);
 
 /*$interfaceNLevelsMenu1 = new Cheope_ns_NLevels_menu($dbObjProva,OP_NONE,NUM_1);
 $dataFields = array(FIELD_DATA_1,FIELD_DATA_2);
 $interfaceNLevelsMenu1->setDbStruct($dbStructTree);
 $interfaceNLevelsMenu1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceNLevelsMenu1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceNLevelsMenu1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceNLevelsMenu1->setCssClass(STRING_SPACE);
  $interfaceNLevelsMenu1->setItemCssClass(STRING_SPACE);*/
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1,3,2,"100%","100%");
 $dispFields = array(LABEL_FILES);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $decoratedIntFrame1 = new Html_fieldset_decorator($interfaceFrame1);
 $decoratedIntFrame1->setCssClass(CSS_FRAME_DEC);
 
  define("FRAME_CONTAINER_1","FrameCont1");
 
 $interfaceFrameContainer1 = new Interfaces_container(FRAME_CONTAINER_1);
 $interfaceFrameContainer1->add($interfaceNLevelsMenu3);
 $interfaceFrameContainer1->add(null);

 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceNLevelsMenu1);
 $interfacesContainer->add($interfaceNLevelsMenu2);
 $interfacesContainer->add($interfaceNLevelsMenu3);
 $interfacesContainer->add($interfaceNLevelsMenu4);
 $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($decoratedIntFrame1);

/* $interfacesContainer->add($interfaceFrame1);
 $interfacesContainer->add($interfaceTabs1);*/
 
 $page = new Cheope_ns_prova_38_2_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
 
?>