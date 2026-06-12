<? 
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_15_op_page.class.php");

 $interfaceDiv1 = new Html_div_tag();
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));
 
 $interfaceDiv2 = new Html_div_tag();
 $interfaceDiv2->setAttribs(array("id"=>"Div_tag_2"));
 
 $interfaceDiv3 = new Html_div_tag();
 $interfaceDiv3->setAttribs(array("id"=>"Div_tag_3"));
  
 $interfaceNLevelsTreeCtrl1 = new Cheope_ns_nLevels_tree_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceNLevelsTreeCtrl1->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsTreeCtrl1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceNLevelsTreeCtrl1->setDataFieldsDomainsValues(array(
  array("labelA"=>array("labelA1"=>array("labelA2"=>"labelA2"),"labelB1"=>array("labelB2"=>"labelB2"),"labelC1"=>array("labelC2"=>"labelC2"))),
 array("pageA"=>array("pageA1"=>array("pageA2"=>"pageA2"),"pageB1"=>array("pageB2"=>"pageB2"),"pageC1"=>array("pageC2"=>"pageC2"))),
 array("ida"=>array("ida1"=>array("ida2"=>"ida2"),"idb2"=>array("idb2"=>"idb2"),"idc1"=>array("idc2"=>"idc2")))));
 $interfaceNLevelsTreeCtrl1->setGesPage(THIS_PAGE);
// $interfaceNLevelsTreeCtrl1->setDispFields(array(FIELD_DATA_1));
 $interfaceNLevelsTreeCtrl1->setTreeCtrlVer("2");
 $interfaceNLevelsTreeCtrl1->setRootItemHtmlType("ol");
 $interfaceNLevelsTreeCtrl1->setRootLabel("____");
 //$interfaceNLevelsTreeCtrl1->setRootLabel("Root");

 $interfaceNLevelsTreeCtrl2 = new Cheope_ns_nLevels_tree_ctrl(OBJ_NONE,OP_NONE,NUM_2);
 $interfaceNLevelsTreeCtrl2->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsTreeCtrl2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceNLevelsTreeCtrl2->setDataFieldsDomainsValues(array(
  array("labelA"=>array("labelA1"=>array("labelA2"=>"labelA2"),"labelB1"=>array("labelB2"=>"labelB2")),
 "labelB"=>array("labelB1"=>array("labelB2"=>"labelB2")),
 "labelC"=>array("labelC1"=>array("labelC2"=>"labelC2")),
 "labelD"=>array()),
  array("pageA"=>array("pageA1"=>array("pageA2"=>"pageA2"),"pageB1"=>array("pageB2"=>"pageB2")),
 "pageB"=>array("pageB1"=>array("pageB2"=>"pageB2")),
 "pageC"=>array("pageC1"=>array("pageC2"=>"pageC2")),
 "pageD"=>array()),
  array("ida"=>array("ida1"=>array("ida2"=>"ida2"),"idb2"=>array("idb2"=>"idb2")),
 "idb"=>array("idb1"=>array("idb2"=>"idb2")),
 "idc"=>array("idc1"=>array("idc2"=>"idc2")),
 "idd"=>array())));
 $interfaceNLevelsTreeCtrl2->setGesPage(THIS_PAGE);
 $interfaceNLevelsTreeCtrl2->setDispFields(array(FIELD_DATA_1));
 $interfaceNLevelsTreeCtrl2->setTreeCtrlVer("");
 $interfaceNLevelsTreeCtrl2->setRootItemHtmlType("span");
 $interfaceNLevelsTreeCtrl2->setRootLabel("____");
 //$interfaceNLevelsTreeCtrl2->setRootLabel("Root");
 $interfaceNLevelsTreeCtrl2->setIndent(true); 
 
 $interfaceNLevelsForestCtrl1 = new Cheope_ns_nLevels_forest_ctrl(OBJ_NONE,OP_NONE,NUM_1);
 $interfaceNLevelsForestCtrl1->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsForestCtrl1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_SET,
 Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET));
 $interfaceNLevelsForestCtrl1->setDataFieldsDomainsValues(array(
 array("labelA"=>array("labelA1"=>array("labelA2"=>"labelA2"),"labelB1"=>array("labelB2"=>"labelB2")),
 "labelB"=>array("labelB1"=>array("labelB2"=>"labelB2")),
 "labelC"=>array("labelC1"=>array("labelC2"=>"labelC2")),
 "labelD"=>array()),
 array("pageA"=>array("pageA1"=>array("pageA2"=>"pageA2"),"pageB1"=>array("pageB2"=>"pageB2")),
 "pageB"=>array("pageB1"=>array("pageB2"=>"pageB2")),
 "pageC"=>array("pageC1"=>array("pageC2"=>"pageC2")),
 "pageD"=>array()),
 array("ida"=>array("ida1"=>array("ida2"=>"ida2"),"idb2"=>array("idb2"=>"idb2")),
 "idb"=>array("idb1"=>array("idb2"=>"idb2")),
 "idc"=>array("idc1"=>array("idc2"=>"idc2")),
 "idd"=>array())));
 $interfaceNLevelsForestCtrl1->setGesPage(THIS_PAGE);
 $interfaceNLevelsForestCtrl1->setDispFields(array(FIELD_DATA_1));
  $interfaceNLevelsForestCtrl1->setForestCtrlVer("");
 $interfaceNLevelsForestCtrl1->setRootItemHtmlType("span");
 $interfaceNLevelsForestCtrl1->setMainLabel("zzz");
 
 $interfaceNLevelsForestCtrl2 = new Cheope_ns_nLevels_forest_ctrl(OBJ_NONE,OP_NONE,NUM_2);
 $interfaceNLevelsForestCtrl2->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsForestCtrl2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_SET,
 Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_SET));
 $interfaceNLevelsForestCtrl2->setDataFieldsDomainsValues(array(
 array("labelA"=>array("labelA1"=>array("labelA2"=>"labelA2"),"labelB1"=>array("labelB2"=>"labelB2")),
 "labelB"=>array("labelB1"=>array("labelB2"=>"labelB2")),
 "labelC"=>array("labelC1"=>array("labelC2"=>"labelC2")),
 "labelD"=>array()),
 array("pageA"=>array("pageA1"=>array("pageA2"=>"pageA2"),"pageB1"=>array("pageB2"=>"pageB2")),
 "pageB"=>array("pageB1"=>array("pageB2"=>"pageB2")),
 "pageC"=>array("pageC1"=>array("pageC2"=>"pageC2")),
 "pageD"=>array()),
 array("ida"=>array("ida1"=>array("ida2"=>"ida2"),"idb1"=>array("idb2"=>"idb2")),
 "idb"=>array("idb1"=>array("idb2"=>"idb2")),
 "idc"=>array("idc1"=>array("idc2"=>"idc2")),
 "idd"=>array())));
 $interfaceNLevelsForestCtrl2->setGesPage(THIS_PAGE);
 $interfaceNLevelsForestCtrl2->setDispFields(array(FIELD_DATA_1));
  $interfaceNLevelsForestCtrl2->setForestCtrlVer("2");
 $interfaceNLevelsForestCtrl2->setRootItemHtmlType("ol");
 $interfaceNLevelsForestCtrl2->setMainLabel("MMM");
 
/* $interfaceNLevelsTreeCtrl2 = new Cheope_ns_NLevels_tree_ctrl(OBJ_NONE,OP_NONE,NUM_2);
 $interfaceNLevelsTreeCtrl2->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsTreeCtrl2->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceNLevelsTreeCtrl2->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceNLevelsTreeCtrl2->setGesPage(THIS_PAGE);
 $interfaceNLevelsTreeCtrl2->setDispFields(array(FIELD_DATA_1));
 
 $interfaceNLevelsTreeCtrl3 = new Cheope_ns_NLevels_tree_ctrl(OBJ_NONE,OP_NONE,NUM_3);
 $interfaceNLevelsTreeCtrl3->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3));
 $interfaceNLevelsTreeCtrl3->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceNLevelsTreeCtrl3->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceNLevelsTreeCtrl3->setGesPage(THIS_PAGE);
 $interfaceNLevelsTreeCtrl3->setDispFields(array(FIELD_DATA_1));*/
 
 $interfaceFrame1 = new Cheope_ns_frame(OP_NONE,NUM_1);
 $interfaceFrame1->setRowsNum(1);
 $interfaceFrame1->setColsNum(4);
 
 $interfaceFrameContainer1 = new Interfaces_container();
 $interfaceFrameContainer1->add($interfaceNLevelsTreeCtrl1);
 $interfaceFrameContainer1->add($interfaceNLevelsTreeCtrl2);
 $interfaceFrameContainer1->add($interfaceNLevelsForestCtrl1);
 $interfaceFrameContainer1->add($interfaceNLevelsForestCtrl2);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
   
 $interfacesContainer1 = new Interfaces_container("");
 $interfacesContainer1->add($interfaceFrame1);
 $interfaceDiv3->setInterfacesContainer($interfacesContainer1);
 
 $interfaceDiv4 = new Html_div_tag();
 $interfaceDiv4->setAttribs(array("id"=>"Div_tag_4")); 
 
 $interfacesContainer1 = new Interfaces_container("");
 $interfacesContainer1->add($interfaceDiv2);
 $interfacesContainer1->add($interfaceDiv3);
 $interfacesContainer1->add($interfaceDiv4);
 $interfaceDiv1->setInterfacesContainer($interfacesContainer1);
 
 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 /*$interfacesContainer->add($interfaceJavascriptFrag1);*/
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($interfaceDiv2);
 $interfacesContainer->add($interfaceDiv3);
 $interfacesContainer->add($interfaceDiv4);
 $interfacesContainer->add($interfaceNLevelsTreeCtrl1);
 $interfacesContainer->add($interfaceNLevelsTreeCtrl2);
 $interfacesContainer->add($interfaceNLevelsForestCtrl1);
  $interfacesContainer->add($interfaceNLevelsForestCtrl2);
 
 $page = new Cheope_ns_prova_15_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

