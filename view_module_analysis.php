<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_view_module_analysis_op_page.class.php");

 $interfaceDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));

 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $interfaceDiv3->setAttribs(array("id"=>"Div_tag_3","style"=>
 "color:black;height:25px;border:1px dotted white;background-color:#290094")); 

 $interfaceDiv4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $interfaceDiv4->setAttribs(array("id"=>"Div_tag_4","style"=>"height:400px")); 
 
 $interfaceDiv5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $interfaceDiv5->setAttribs(array("id"=>"Div_tag_5"));

 $interfaceJavascriptTxtEditor1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_ACE_TXTEDITOR,STRING_NULL,"Op4",NUM_1);
 $interfaceJavascriptTxtEditor1->setHookId("Div_tag_5");
 $interfaceJavascriptTxtEditor1->setEditorId("Div_tag_4");
 $interfaceJavascriptTxtEditor1->setMode("php");
 $interfaceJavascriptTxtEditor1->setEnableStatusBar(true);
 $interfaceJavascriptTxtEditor1->setEnableOpBar(true);
 $interfaceJavascriptTxtEditor1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 
 $interfacesContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"4");
 $interfaceDiv4->setInterfacesContainer($interfacesContainer4);

 $interfacesContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"4");
 $interfacesContainer1->add($interfaceDiv3);
 $interfacesContainer1->add($interfaceDiv4);
 $interfacesContainer1->add($interfaceDiv5);
 $interfaceDiv1->setInterfacesContainer($interfacesContainer1);

 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $dispFields = array(LABEL_EDITING_MODULO);
 $interfaceFrame4->setDispFields($dispFields);
 $interfaceFrame4->setCREnabled(true);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 $interfaceFrameContainer4->add($interfaceDiv1);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $interfaceFrame5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG);
 $dispFields = array(LABEL_VOID);
 $interfaceFrame5->setDispFields($dispFields);
 $interfaceFrame5->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_5","FrameCont5");

 $interfaceFrameContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 $interfaceFrameContainer5->add($decoratedIntFrame4);
 $interfaceFrame5->setInterfacesContainer($interfaceFrameContainer5);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment("var txtAceEditor = interfacesContainer.getInterface('Op4');" .
 "var editor = txtAceEditor.getEditor();" .
 "var UndoManager = ace.UndoManager;" .
 "var undoManager = new UndoManager();txtAceEditor.getEditor().getSession().setUndoManager(undoManager);" .
 "editor.commands.addCommand({" .
 "name: 'FindCommand',bindKey: {win: 'F3',  mac: 'F3'}," .
 "exec: function(actEditor) {" .
 "var findVal = document.getElementById('textBox_find_findField_id').value;" .
 "var backwardsVal = document.getElementById('checkBox_find_backwards_id').checked;" .
 "var wrapVal = document.getElementById('checkBox_find_wrap_id').checked;" .
 "var caseVal = document.getElementById('checkBox_find_caseSensitive_id').checked;" .
 "var wholeVal = document.getElementById('checkBox_find_wholeWord_id').checked;" .
 "var regexpVal = document.getElementById('checkBox_find_regexp_id').checked;" .
 "actEditor.find(findVal,{backwards: backwardsVal,wrap: wrapVal,caseSensitive: caseVal," .
 "wholeWord: wholeVal,regExp: regexpVal});" .
 "}," .
 "readOnly: false });" .
 "editor.commands.addCommand({" .
 "name: 'FindReplaceCommand',bindKey: {win: 'F4',  mac: 'F4'}," .
 "exec: function(actEditor) {" .
 "var findVal = document.getElementById('textBox_findReplace_findField_id').value;" .
 "var replaceVal = document.getElementById('textBox_findReplace_replaceField_id').value;" .
 "var replaceAllVal = document.getElementById('checkBox_findReplace_replaceAll_id').checked;" .
 "var backwardsVal = document.getElementById('checkBox_findReplace_backwards_id').checked;" .
 "var wrapVal = document.getElementById('checkBox_findReplace_wrap_id').checked;" .
 "var caseVal = document.getElementById('checkBox_findReplace_caseSensitive_id').checked;" .
 "var wholeVal = document.getElementById('checkBox_findReplace_wholeWord_id').checked;" .
 "var regexpVal = document.getElementById('checkBox_findReplace_regexp_id').checked;" .
 "actEditor.find(findVal,{backwards: backwardsVal,wrap: wrapVal,caseSensitive: caseVal," .
 "wholeWord: wholeVal,regExp: regexpVal});" .
 "if(replaceAllVal)editor.replaceAll(replaceVal);else editor.replace(replaceVal);" .
 "}," .
 "readOnly: false });" .
 "var dialogFind = new dijit.TooltipDialog({" .
 "content: '<label style=\"color:black;\" for=\"name\">" . LABEL_TROVA . ":</label>' + " .
 "' <input type=\"text\" id=\"textBox_find_findField_id\" " . 
 ">' + " .
 "'</input><br/><label style=\"color:black;\">" . LABEL_INDIETRO . "</label>" .
 "<input id=\"checkBox_find_backwards_id\" type=\"checkbox\"></input>' + " .
 "'<label style=\"color:black;\">" . LABEL_RIPARTI_DALL_INIZIO . "</label>" .
 "<input id=\"checkBox_find_wrap_id\" type=\"checkbox\"></input>' + " .
  "'<br/><label style=\"color:black;\">"  . LABEL_MINUSCOLE_MAIUSCOLE . "</label>" .
 "<input id=\"checkBox_find_caseSensitive_id\" type=\"checkbox\"></input>' + " .
  "'<label style=\"color:black;\">" . LABEL_PAROLA_INTERA . "</label>" .
 "<input id=\"checkBox_find_wholeWord_id\" type=\"checkbox\"></input>' + " .
   "'<br/><label style=\"color:black;\">" . LABEL_REGEXP . "</label>" .
 "<input id=\"checkBox_find_regexp_id\" type=\"checkbox\"></input>'});" .
 "var buttonFind = new dijit.form.DropDownButton({" .
 "dropDown: dialogFind," .
 "label: '" . LABEL_TROVA . " (F3)',id:'find_button_id'});" .
 "dojo.byId('Div_tag_3').appendChild(buttonFind.domNode);" .
 "var dialogFindReplace = new dijit.TooltipDialog({" .
 "content: '<label style=\"color:black;\" for=\"name\">" . LABEL_TROVA . ":</label>' + " .
 "'<input type=\"text\" size=\"19\" id=\"textBox_findReplace_findField_id\" " . 
 ">' + " .
 "'</input><br/><label style=\"color:black;\">" . LABEL_SOSTITUISCI . ":</label>" .
 "<input type=\"text\" size=\"16\" style=\"margin-top:5px\" id=\"textBox_findReplace_replaceField_id\" " . 
 ">' + " .
 "'</input><br/><label style=\"color:black;\">" . LABEL_SOSTITUISCI_TUTTO . "</label>" .
 "<input id=\"checkBox_findReplace_replaceAll_id\" type=\"checkbox\"></input>' + " .
 "'</input><label style=\"color:black;\">" . LABEL_INDIETRO . "</label>" .
 "<input id=\"checkBox_findReplace_backwards_id\" type=\"checkbox\"></input>' + " .
 "'<br/><label style=\"color:black;\">" . LABEL_RIPARTI_DALL_INIZIO . "</label>" .
 "<input id=\"checkBox_findReplace_wrap_id\" type=\"checkbox\"></input>' + " .
  "'<label style=\"color:black;\">" . LABEL_MINUSCOLE_MAIUSCOLE . "</label>" .
 "<input id=\"checkBox_findReplace_caseSensitive_id\" type=\"checkbox\"></input>' + " .
  "'<br/><label style=\"color:black;\">" . LABEL_PAROLA_INTERA . "</label>" .
 "<input id=\"checkBox_findReplace_wholeWord_id\" type=\"checkbox\"></input>' + " .
   "'<label style=\"color:black;\">". LABEL_REGEXP . "</label>" .
 "<input id=\"checkBox_findReplace_regexp_id\" type=\"checkbox\"></input>'});" .
 "var buttonFindReplace = new dijit.form.DropDownButton({" .
 "dropDown: dialogFindReplace," .
 "label: '" . LABEL_TROVA_E_SOSTITUISCI . " (F4)',id:'findReplace_button_id'});" .
 "dojo.byId('Div_tag_3').appendChild(buttonFindReplace.domNode);" .
 "var buttonUndo = document.createElement('button');buttonUndo.id='button_undo_id';" .
 "buttonUndo.innerHTML = '" . LABEL_ANNULLA . "';buttonUndo.disabled=true;dojo.byId('Div_tag_3').appendChild(buttonUndo);" .
 "var buttonRedo = document.createElement('button');buttonRedo.id='button_redo_id';" .
 "buttonUndo.onclick=function(){var undoManager = txtAceEditor.getEditor().getSession().getUndoManager();" .
 "if(undoManager.hasUndo()){undoManager.undo();txtAceEditor.getEditor().focus();}" .
 "if(! undoManager.hasUndo()) {this.disabled=true;var sign=document.getElementById('modify_sign');" .
 "sign.style.visibility='hidden';} if(undoManager.hasRedo()) buttonRedo.disabled=false;};" .
 "buttonRedo.onclick=function(){var undoManager = txtAceEditor.getEditor().getSession().getUndoManager();" .
 "if(undoManager.hasRedo()){undoManager.redo();txtAceEditor.getEditor().focus();}" .
 "if(! undoManager.hasRedo()) this.disabled=true;if(undoManager.hasUndo()) buttonUndo.disabled=false;};" .
 "buttonRedo.innerHTML = '" . LABEL_RIPETI . "';buttonRedo.disabled=true;dojo.byId('Div_tag_3').appendChild(buttonRedo);" .
 "txtAceEditor.setExtCtrlManager(function(actEvent){if(actEvent=='change')buttonUndo.disabled=false;" .
 "else if(actEvent=='get'){var UndoManager = ace.UndoManager;" .
 "var undoManager = new UndoManager();txtAceEditor.getEditor().getSession().setUndoManager(undoManager);" .
 "buttonUndo.disabled=true;buttonRedo.disabled=true;}});");
 
 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTxtEditor1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($interfaceDiv4);
 $interfacesContainer->add($interfaceDiv5);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($decoratedIntFrame4);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame5);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setLocalizationEnabled(true);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>