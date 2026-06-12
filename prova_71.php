<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_71_op_page.class.php");

 $formSection1 = new Cheope_ns_form_section(OBJ_NONE,OP_NONE,NUM_1);
 $formSection1->setDataFields(array("Campo1","Campo2","Campo3","Campo4","Campo5","Campo6","Campo7"));
 $formSection1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_CHECK,
 Int_domain::FIELD_DOMAIN_NONE,Int_domain::FIELD_DOMAIN_CHECK,Int_domain::FIELD_DOMAIN_RADIO,Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_SET,Int_domain::FIELD_DOMAIN_MULTIPLE));
 $formSection1->setDataFieldsDomainsValues(array("","",false,
 array("AAA"=>"AAA","BBB"=>"BBB","CCC"=>"CCC"),"Value",
 array("AAA1"=>"AAA","BBB1"=>"BBB","CCC"=>"CCC"),array("MMM1"=>"MMMM","NNN1"=>"NNNN")));
 $formSection1->setGridDimX(4);
 $formSection1->setGridDimY(2);
 $formSection1->setFieldsEvents(array(array("alert('AAA');","alert('BBBB');")));
 $formSection1->setCellPadding(10);
 $formSection1->setFieldsDefaultValues(array("","","","","Default","CCC1","NNN1"));
 $formSection1->setFieldsToolTips(array("ToolTip0","",
 "","ToolTipRadio","ToolTip1","ToolTip2","ToolTip3"));
 $formSection1->setFieldsHints(array("","","","","","Controllo ABC"));
 $formSection1->setFieldsColStyles(array("Campo1"=>"",
 "Campo2"=>"width:80px;float:left;","Campo3"=>"",
 "Campo4"=>"","Campo5"=>"","Campo6"=>"","Campo7"=>""));
 $formSection1->setFieldsLengths(array("Campo7"=>4));
 $formSection1->setFieldsDirections(array("Campo4"=>VER_DIRECTION));
 $formSection1->setFieldsLabels(array("Label1","Label2","Label3","Label4","Label5","Label6","Label7"));
 $formSection1->setLabels(array("Campo1"=>"","Campo2"=>"",
 "Campo3"=>"","Campo4"=>array("AAA"=>"AAA","BBB"=>"BBB","CCC"=>"CCC"),"Campo5"=>"",
 "Campo6"=>""));
 $formSection1->setFieldsRegexps(array(""=>"",""=>"",
 ""=>"",""=>"",""=>"",
 "Campo6"=>"[A-Z]+"));
 
 $divTag1Container1 = new Interfaces_container(STRING_NULL);
 $divTag1Container1->add($formSection1);

 $interfaceDivTag1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDivTag1->setInterfacesContainer($divTag1Container1);

 $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($formSection1);
 $interfacesContainer->add($interfaceDivTag1);
 
 $page = new Cheope_ns_prova_71_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->putData();
 
 ?>
