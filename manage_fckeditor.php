<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_manage_fckeditor_op_page.class.php");

 $interfaceFckEditor1 = Creator::create(Interfaces_info::INT_FCKEDITOR,STRING_NULL,OP_NONE,NUM_1);
 $interfaceFckEditor1->setBasePath('./FCKEditor/editor');
 $interfaceFckEditor1->setWidth('100%');
 $interfaceFckEditor1->setHeight('400');
 $interfaceFckEditor1->setToolbarSet('Default');

 $intCont = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"Contenitore_1");
 $intCont->add($interfaceFckEditor1);

 $interfaceHtmlTags1 = Creator::create(Interfaces_info::INT_HTML_TAGS,STRING_NULL,OP_NONE,NUM_1,"form");
 $interfaceHtmlTags1->setAttribs(array("id"=>"FCKEditor","name"=>"FCKEditor","method"=>"GET","action"=>"manage_fckeditor.php"));
 $interfaceHtmlTags1->setInterfacesContainer($intCont);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1); 
 //$interfaceJavascriptFrag5 = new Javascript_fragment("Op6",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "var parsValues = util.getUrlArgsValues(window.location.search);" .
  "var fckEditorVal = parsValues[0];window.returnVal=fckEditorVal;");
//  "var editor = document.getElementById('FCKEditor__1');editor.value = '{' + fckEditorVal + '}';" );

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);     
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceHtmlTags1);
 $interfacesContainer->add($interfaceFckEditor1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_manage_fields_op_page();
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(false);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>