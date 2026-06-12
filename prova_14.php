<? 
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_14_op_page.class.php");

 $interfaceDiv1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));
 
 $interfaceDiv2 = new Html_div_tag(OP_NONE,NUM_2);
 $interfaceDiv2->setAttribs(array("id"=>"Div_tag_2"));
 
 $interfaceDiv3 = new Html_div_tag(OP_NONE,NUM_3);
 $interfaceDiv3->setAttribs(array("id"=>"Div_tag_3"));
  
 $interfaceDbNavigator1 = new Cheope_ns_db_navigator($dbObjProva_2,OP_NONE,NUM_1);
 $interfaceDbNavigator1->setDataFields(array(FIELD_DATA_1,FIELD_DATA_2,FIELD_ID_PROVA_2));
 $interfaceDbNavigator1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceDbNavigator1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceDbNavigator1->setGesPage(STRING_NULL);
 //$interfaceDbNavigator1->setMainLabel("Root");
 $interfaceDbNavigator1->setCssClass(CSS_TREE_CTRL);
 $interfaceDbNavigator1->setDispFields(array(FIELD_DATA_1));
 $interfaceDbNavigator1->setDbStruct($dbStructTree);
   
 $interfacesContainer1 = new Interfaces_container("");
 $interfacesContainer1->add($interfaceDbNavigator1);
 $interfaceDiv3->setInterfacesContainer($interfacesContainer1);
 
 $interfaceDiv4 = new Html_div_tag(OP_NONE,NUM_4);
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
 $interfacesContainer->add($interfaceDbNavigator1);
 
 $page = new Cheope_ns_prova_14_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

