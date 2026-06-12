<? 
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_prova_13_op_page.class.php");

 $interfaceDiv1 = new Html_div_tag(OP_NONE,NUM_1);
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));
 
 /*$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId("Div_tag_2");
 $interfaceJavascriptFrag1->setJavascriptFragment("htmlWriter.putGenericHtmlString(\'<button onclick=\\\"" .
 "ajaxHandler.synServerCall(\\\\\'ajax_handler.php\\\\\',\\\\\'" . AJAX_OP_GET_FILE . 
 "\\\\\',\\\\\'Testo_prova_12.txt\\\\\',\\\\\'text\\\\\');\\\">Press</button>\');");*/

 $interfaceDiv2 = new Html_div_tag(OP_NONE,NUM_2);
 $interfaceDiv2->setAttribs(array("id"=>"Div_tag_2"));
 
 $interfaceDiv3 = new Html_div_tag(OP_NONE,NUM_3);
 $interfaceDiv3->setAttribs(array("id"=>"Div_tag_3"));
 
 /*$interfaceTextarea1 = new Html_textarea_tag(NUM_1);
 $interfaceTextarea1->setAttribs(array("id"=>"Textarea_1","cols"=>"80","rows"=>"20"));
 $interfaceTextarea1->setTagBody("Default value");*/
 
 $interfaceFckEditor1 = new FCKEditor(OP_NONE,NUM_1);
 $interfaceFckEditor1->setWidth("800px");
 
 $interfaceHtmlDataTemplate1 = new Html_data_template(OBJ_NONE,OP_NONE,NUM_1);
 $dataFields = array(FIELD_FORM);
 $interfaceHtmlDataTemplate1->setDataFields($dataFields);
 $dataFieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceHtmlDataTemplate1->setDataFieldsDomains($dataFieldsDomains);
 $dataFieldsDomainsValues = array($interfaceFckEditor1);
 $interfaceHtmlDataTemplate1->setDataFieldsDomainsValues($dataFieldsDomainsValues);
 $interfaceHtmlDataTemplate1->setHtmlTemplate("<form id=\"fckEditor_form\" onsubmit=\"alert('ciao');\">{FORM}</form>");
  
 $interfacesContainer1 = new Interfaces_container("");
 $interfacesContainer1->add($interfaceHtmlDataTemplate1);
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
 $interfacesContainer->add($interfaceFckEditor1);
 $interfacesContainer->add($interfaceHtmlDataTemplate1);
 
 $page = new Cheope_ns_prova_13_op_page();
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setJQueryEnabled(true);
 $page->putData();
 
?>

