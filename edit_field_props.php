<?
namespace Cheope_ns\fw;
 require_once("root.def.php"); 
 require_once(FRAMEWORK_PATH . "Cheope_ns_edit_field_props_op_page.class.php");

 $interfaceFrame2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
// $interfaceFrame2 = new Html_div_tag();
 $dispFields = array(LABEL_EDIT_FIELD_PROP);
 $interfaceFrame2->setDispFields($dispFields);
 $decoratedIntFrame2 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame2);
// $decoratedIntFrame2 = new Html_fieldset_decorator($interfaceFrame2);
 $decoratedIntFrame2->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceFrameContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceFrame2->setInterfacesContainer($interfaceFrameContainer2);
 
 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $interfaceFrame1->setCssClass(CSS_FRAME);
 
 /*$htmlButtonTag1 = new Html_button_tag();
 $htmlButtonTag1->setTagBody(LABEL_SAVE_FIELD);
 $htmlButtonTag1->setAttribs(array("onclick"=>"saveFieldProps();"));*/

 $htmlTextArea1 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL);
// $htmlTextArea1 = new Html_textarea_tag();
 $htmlTextArea1->setAttrib("style","width:170px;height:80px;display:none;"); 
 $htmlTextArea1->setAttrib("id","textarea_0"); 
 
 $interfaceDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
// $interfaceDiv1 = new Html_div_tag(); 
 
 $interfaceDivContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
// $interfaceDivContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceDivContainer1->add($htmlTextArea1);
 $interfaceDiv1->setInterfacesContainer($interfaceDivContainer1);
 
 $htmlTextArea2 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL); 
// $htmlTextArea2 = new Html_textarea_tag();
 $htmlTextArea2->setAttrib("style","width:170px;height:80px;display:none;"); 
 $htmlTextArea2->setAttrib("id","textarea_1"); 

 $interfaceDiv2 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);   
// $interfaceDiv1 = new Html_div_tag(); 

 $interfaceDivContainer2 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceDivContainer2 = new Interfaces_container(STRING_NULL);
 $interfaceDivContainer2->add($htmlTextArea2);
 $interfaceDiv2->setInterfacesContainer($interfaceDivContainer2); 

 $htmlTextArea3 = Creator::create(Interfaces_info::INT_HTML_TEXTAREA_TAG,STRING_NULL); 
// $htmlTextArea3 = new Html_textarea_tag();
 $htmlTextArea3->setAttrib("style","width:170px;height:80px;display:none;"); 
 $htmlTextArea3->setAttrib("id","textarea_2"); 

 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);      
// $interfaceDiv3 = new Html_div_tag(); 

 $interfaceDivContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceDivContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceDivContainer3->add($htmlTextArea3);
 $interfaceDiv3->setInterfacesContainer($interfaceDivContainer3);     

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);   
// $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
// $interfaceFrameContainer1->add($htmlButtonTag1);
 $interfaceFrameContainer1->add($decoratedIntFrame2);
 $interfaceFrameContainer1->add($interfaceDiv1);
 $interfaceFrameContainer1->add($interfaceDiv2);
 $interfaceFrameContainer1->add($interfaceDiv3);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);
 $interfaceFrame1->setCssClass(CSS_FRAME);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"editFieldPropOp1",NUM_1); 
// $interfaceJavascriptFrag1 = new Javascript_fragment("editFieldPropOp1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL); 
 $interfaceJavascriptFrag1->setEnableExecuteOnload(true);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "var args = util.getUrlArgsValues(window.location.search);" .
 "var buffer = window.parent.$('#ctrl_id_' + args[1] + '_' + args[0]).data('buffer');" .
 "var domain = buffer.domain;" .
  
 "addNameField('html_tags__0');" .
 "addDomainField('html_tags__0',domain);" .
 
 "if((domain=='set')||(domain=='multiple')||(domain=='radio')) " .
  "addDomainValueFieldSelect('html_tags__0');" .
 "else " .
  "addDomainValueFieldInput('html_tags__0');" .
 
 "addRowClassField('html_tags__0');" .
 "addRowsClassField('html_tags__0');" .
 "addRowStyleField('html_tags__0');" . 
 "addRowsStyleField('html_tags__0');" .
 "addLabelSpacerWidthField('html_tags__0');" .
 "addCellPaddingField('html_tags__0');" .
 "addCellSpacingField('html_tags__0');" . 
 "addStyleField('html_tags__0');" .
 "addColStyleField('html_tags__0');" .  
 "addFieldLabel('html_tags__0');" . 
 "addFieldColClass('html_tags__0');" .
 
 "var div_domainDip = document.createElement('div');" .
 "div_domainDip.id = 'div_domainDip_id';" .
 "$('#html_tags__0').append(div_domainDip);" .
 
 "switch(domain)" .
 "{" .
 " case 'atomic':" .
 "{" . 
 "addFieldType('div_domainDip_id');" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldLength('div_domainDip_id');" .
 "addFieldStop('div_domainDip_id');" .
 "addFieldHint('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" . 
 "addFieldEvents('div_domainDip_id');" .
 "addFieldRegexp('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .
 "addFieldMandatory('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'atomic_static':" .
 "{" .
 "addFieldType('div_domainDip_id');" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'set': " .
 "{" .
 "addFieldStyle('div_domainDip_id');" . 
 "addFieldStop('div_domainDip_id');" .
 "addFieldHint('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" .
 "addFieldRegexp('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .  
 "addFieldMandatory('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'check':" .
 "{" . 
 "addFieldStyle('div_domainDip_id');" . 
 "addFieldEvents('div_domainDip_id');" .
 "addFieldLength('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'radio':" .
 "{" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .
 "addLabel('div_domainDip_id');" . 
 "addFieldDirection('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'multiple':" .
 "{" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .
 "addFieldLength('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'password':" .
 "{" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .
 "addFieldLength('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "addFieldType('div_domainDip_id');" .
 "addFieldStop('div_domainDip_id');" .
 "addFieldRegexp('div_domainDip_id');" . 
 "addFieldMandatory('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'file':" .
 "{" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldEvents('div_domainDip_id');" . 
 "addFieldDefaultValue('div_domainDip_id');" .
 "addFieldLength('div_domainDip_id');" .
 "addFieldToolTip('div_domainDip_id');" .
 "addFieldType('div_domainDip_id');" .
 "addFieldStop('div_domainDip_id');" .
 "addFieldMandatory('div_domainDip_id');" .
 "break;" .
 "}" .
 " case 'hidden':" .
 "{" .
 "addFieldEvents('div_domainDip_id');" . 
 "break;" .
 "}" .
 " case 'none':" .
 "{" .
 "break;" .
 "}" .
 " case 'object':" .
 "{" .
 "addFieldStyle('div_domainDip_id');" .
 "addFieldObjName('div_domainDip_id',buffer.fieldObjName);" .
 "break;" .
 "}" .
 "}" .
 "window.returnVal = buffer;" .
 "$('#html_tags__0').append(div_domainDip);" .
 "setDefaultSectionDomainBufs('div_domainDip_id');" .
 "setDefaultCommonBuf('html_tags__0');" .
 //"loadSectionCtrlsFromBuf('div_domainDip_id',buffer);" .
 "loadSectionCtrlsFromBuf('html_tags__0',buffer);" .
 "loadCommonsCtrlsFromCommonBuf('html_tags__0',buffer);" .
 "saveBufIntoSectionDomainBuf('div_domainDip_id',buffer);" .
 "saveBufIntoCommonBuf('html_tags__0',buffer);" .
 "saveFieldsProps();" .
 "$('#div_domainDip_id').attr('style','overflow:auto;width:80%;');" 
 );

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
// $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
// $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 //$interfacesContainer->add($htmlButtonTag1);
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($interfaceDiv2);
 $interfacesContainer->add($interfaceDiv3); 
 $interfacesContainer->add($htmlTextArea1);
 $interfacesContainer->add($htmlTextArea2);
 $interfacesContainer->add($htmlTextArea3);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceTempMsg1);
 //$interfacesContainer->add($intButton1);
 $interfacesContainer->add($interfaceFrame1);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
// $page = new Cheope_ns_edit_field_props_op_page();
 $ajaxOps = array(AJAX_OP_GET_ALL_INTERFACES_OF_PAGE);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>