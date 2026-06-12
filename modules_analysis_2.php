<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_modules_analysis_2_op_page.class.php");

 /*$interfaceCurtainMenu1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"start",NUM_1); 
 //$interfaceCurtainMenu1 = new Cheope_ns_curtain_menu(OBJ_NONE,"start",NUM_1);
 $interfaceCurtainMenu1->setDbStruct($dbStructTree);
 $interfaceCurtainMenu1->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu1->unserialize();

 $interfaceCurtainMenu2 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"db_objects",NUM_1);
 //$interfaceCurtainMenu2 = new Cheope_ns_curtain_menu(OBJ_NONE,"db_objects",NUM_1);
 $interfaceCurtainMenu2->setDbStruct($dbStructTree);
 $interfaceCurtainMenu2->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu2->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu2->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu2->unserialize();

 $interfaceCurtainMenu3 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"connections",NUM_1);  
// $interfaceCurtainMenu3 = new Cheope_ns_curtain_menu(OBJ_NONE,"connections",NUM_1);
 $interfaceCurtainMenu3->setDbStruct($dbStructTree);
 $interfaceCurtainMenu3->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu3->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu3->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu3->unserialize();

 $interfaceCurtainMenu4 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"interfaces",NUM_1);   
 //$interfaceCurtainMenu4 = new Cheope_ns_curtain_menu(OBJ_NONE,"interfaces",NUM_1);
 $interfaceCurtainMenu4->setDbStruct($dbStructTree);
 $interfaceCurtainMenu4->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu4->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu4->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu4->unserialize();

 $interfaceCurtainMenu5 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_CURTAIN_MENU,STRING_NULL,OBJ_NONE,"pages",NUM_1);   
 //$interfaceCurtainMenu5 = new Cheope_ns_curtain_menu(OBJ_NONE,"pages",NUM_1);
 $interfaceCurtainMenu5->setDbStruct($dbStructTree);
 $interfaceCurtainMenu5->setDbQueries($dbQueriesContainer);
 $interfaceCurtainMenu5->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceCurtainMenu5->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceCurtainMenu5->unserialize();

 $interfaceMenuBar1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_MENUBAR,STRING_NULL,OBJ_NONE,"modules",NUM_1);
 //$interfaceMenuBar1 = new Cheope_ns_menuBar(OBJ_NONE,"modules",NUM_1);
 $interfaceMenuBar1->setDbStruct($dbStructTree);
 $interfaceMenuBar1->setDbQueries($dbQueriesContainer);
 $interfaceMenuBar1->setDir(THIS_DIR . DIR_SEP . INTERFACES_DIR);
 $interfaceMenuBar1->serializer_loadData(ucFirst(APPLICATION_NAME));
 $interfaceMenuBar1->unserialize();
 define("MENUBAR_CONTAINER_1","MenuBarContainer1");

 $interfaceMenuBarContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,MENUBAR_CONTAINER_1);
 //$interfaceMenuBarContainer1 = new Interfaces_container(MENUBAR_CONTAINER_1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu1);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu2);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu3); 
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu4);
 $interfaceMenuBarContainer1->add($interfaceCurtainMenu5);
 $interfaceMenuBar1->setInterfacesContainer($interfaceMenuBarContainer1);*/

 $interfaceDiv1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDiv1 = new Html_div_tag();
 $interfaceDiv1->setAttribs(array("id"=>"Div_tag_1"));

 $interfaceDiv3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceDiv3 = new Html_div_tag();
 $interfaceDiv3->setAttribs(array("id"=>"Div_tag_3","style"=>
 "color:black;height:25px;border:1px dotted white;background-color:#290094")); 

 $interfaceDiv4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceDiv4 = new Html_div_tag();
 $interfaceDiv4->setAttribs(array("id"=>"Div_tag_4","style"=>"height:400px")); 

 $interfaceDiv5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
 //$interfaceDiv5 = new Html_div_tag();
 $interfaceDiv5->setAttribs(array("id"=>"Div_tag_5"));

 $interfaceJavascriptTxtEditor1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_ACE_TXTEDITOR,STRING_NULL,"Op4",NUM_1);
 //$interfaceJavascriptTxtEditor1 = new Javascript_data_ace_txtEditor("Op4",NUM_1);
 $interfaceJavascriptTxtEditor1->setHookId("Div_tag_5");
 $interfaceJavascriptTxtEditor1->setEditorId("Div_tag_4");
 $interfaceJavascriptTxtEditor1->setMode("php");
 $interfaceJavascriptTxtEditor1->setEnableStatusBar(true);
 $interfaceJavascriptTxtEditor1->setEnableOpBar(true);
 $interfaceJavascriptTxtEditor1->setCallBackFunPattern("/[.]*\w[.]*/");
 
 $interfacesContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"4");
 //$interfacesContainer4 = new Interfaces_container("4");
 $interfaceDiv4->setInterfacesContainer($interfacesContainer4);

 $interfacesContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,"1");
 //$interfacesContainer1 = new Interfaces_container("1");
 $interfacesContainer1->add($interfaceDiv3);
 $interfacesContainer1->add($interfaceDiv4);
 $interfacesContainer1->add($interfaceDiv5);
 $interfaceDiv1->setInterfacesContainer($interfacesContainer1);

 $interfaceFrame4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceFrame4 = new Html_div_tag();
 $dispFields = array(LABEL_EDITING_MODULO);
 $interfaceFrame4->setDispFields($dispFields);
 $interfaceFrame4->setCREnabled(true);
 define("FRAME_CONTAINER_4","FrameCont4");
 $decoratedIntFrame4 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceFrame4);
 //$decoratedIntFrame4 = new Html_fieldset_decorator($interfaceFrame4);
 $decoratedIntFrame4->setCssClass(CSS_FRAME_DEC);

 $interfaceFrameContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer4 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer4->add($interfaceDiv1);
 $interfaceFrame4->setInterfacesContainer($interfaceFrameContainer4);

 $interfaceFrame5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //interfaceFrame5 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame5->setDispFields($dispFields);
 $interfaceFrame5->setCssClass(CSS_FRAME);
 define("FRAME_CONTAINER_5","FrameCont5");

 $interfaceFrameContainer5 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL);
 //$interfaceFrameContainer5 = new Interfaces_container(STRING_NULL);
 //$interfaceFrameContainer5->add($interfaceMenuBar1);
 $interfaceFrameContainer5->add($decoratedIntFrame4);
 $interfaceFrame5->setInterfacesContainer($interfaceFrameContainer5);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
 //$interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
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
 //$interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceJavascriptTxtEditor1);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 /*$interfacesContainer->add($interfaceCurtainMenu1);
 $interfacesContainer->add($interfaceCurtainMenu2);
 $interfacesContainer->add($interfaceCurtainMenu3);
 $interfacesContainer->add($interfaceCurtainMenu4);
 $interfacesContainer->add($interfaceMenuBar1);*/
 $interfacesContainer->add($interfaceDiv1);
 $interfacesContainer->add($interfaceDiv4);
 $interfacesContainer->add($interfaceDiv5);
 $interfacesContainer->add($interfaceFrame4);
 $interfacesContainer->add($decoratedIntFrame4);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceFrame5);

 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
 //$page = new Cheope_ns_modules_analysis_op_page();
 $ajaxOps = array(AJAX_OP_SET_SESSION_ACTIVE_APP);
 $page->setAjaxOps($ajaxOps);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setCREnabled(true);
 $page->setLocalizationEnabled(true);
 $page->setDojoEnabled(true);
 $page->setJQueryEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>