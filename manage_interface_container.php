<?
namespace Cheope_ns\fw;
 require_once("root.def.php");
 require_once(FRAMEWORK_PATH . "Cheope_ns_manage_interface_container_op_page.class.php");

 $interfaceDivTag6 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceDivTag6 = new Html_div_tag();
 $interfaceDivTag7 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag7 = new Html_div_tag();
 
 $interfaceDivTagContainer4 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL);
 //$interfaceDivTagContainer4 = new Interfaces_container(STRING_NULL);
 
 $interfaceDivTag4 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceDivTag4 = new Html_div_tag();
 $interfaceDivTagContainer4->add($interfaceDivTag6);
 $interfaceDivTagContainer4->add($interfaceDivTag7);
 $interfaceDivTag4->setInterfacesContainer($interfaceDivTagContainer4);
 
 $interfaceDivTag5 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$interfaceDivTag5 = new Html_div_tag();
 
 $interfaceBt1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);
 //$interfaceBt1 = new Html_button_tag();
 $interfaceBt1->setTagBody(LABEL_RICARICA_CONTENITORE);
 $attribs = array("onclick"=>"button_1_onClick();");
 $interfaceBt1->setAttribs($attribs); 

 $intBr1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL); 
 //$intBr1 = new Html_br_tag();

 $interfaceDivTagContainer3 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceDivTagContainer3 = new Interfaces_container(STRING_NULL);
 $interfaceDivTagContainer3->add($interfaceBt1);
 $interfaceDivTagContainer3->add($intBr1);
 $interfaceDivTagContainer3->add($intBr1);

 $interfaceDivTag3 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);      
 //$interfaceDivTag3 = new Html_div_tag();
 $interfaceDivTagContainer3->add($interfaceDivTag4);
 $interfaceDivTagContainer3->add($interfaceDivTag5);
 $interfaceDivTag3->setDispFields(array(LABEL_GESTIONE_CONTENITORE));
 $interfaceDivTag3->setInterfacesContainer($interfaceDivTagContainer3);
 $decoratedIntDivTag3 = Creator::create(Interfaces_info::INT_HTML_FIELDSET_DECORATOR,STRING_NULL,$interfaceDivTag3);      
 //$decoratedIntDivTag3 = new Html_fieldset_decorator($interfaceDivTag3);
 $decoratedIntDivTag3->setCssClass(CSS_FRAME_DEC); 

 $interfaceDivTagContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
 //$interfaceDivTagContainer1 = new Interfaces_container(STRING_NULL);

 $interfaceDivTag1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);      
 //$interfaceDivTag1 = new Html_div_tag();
 $interfaceDivTagContainer1->add($decoratedIntDivTag3);
 $interfaceDivTag1->setInterfacesContainer($interfaceDivTagContainer1);

 $interfaceJavascriptTemplate2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageOp2",NUM_1);       
 //$interfaceJavascriptTemplate2 = new Javascript_data_template("manageOp2",NUM_1);
 $dataFields = array(FIELD_INTERFACCIA,FIELD_INTERFACE_CANONICAL_NAME,FIELD_TYPE);
 $interfaceJavascriptTemplate2->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC);
 $interfaceJavascriptTemplate2->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE );
 $interfaceJavascriptTemplate2->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate2->setDataExchangeType("xml");
 $interfaceJavascriptTemplate2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate2->setJavascriptTemplate("<tr id=\"Row_id_{COUNT}\" class=\"dojoDndItem\">" .
 "<td width=\"100%\" align=\"left\"><img width=\"49\" height=\"49\" style=\"display:block;\" title=\"{INTERFACE_CANONICAL_NAME}\" src=\"./img/{TYPE}.gif\"/>" .
 "<span id=\"span_id_{COUNT}\">{INTERFACCIA}</span></td>" .
 "</tr>"); 

 $interfaceJavascriptTemplate1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_TEMPLATE,STRING_NULL,"manageOp1",NUM_1);       
 //$interfaceJavascriptTemplate1 = new Javascript_data_template("manageOp1",NUM_1);
 $dataFields = array(FIELD_OBJ_1);
 $interfaceJavascriptTemplate1->setDataFields($dataFields);
 $fieldsDomains = array(Int_domain::FIELD_DOMAIN_OBJ);
 $interfaceJavascriptTemplate1->setDataFieldsDomains($fieldsDomains);
 $fieldsDomainsValues = array($interfaceJavascriptTemplate2);
 $interfaceJavascriptTemplate1->setDataFieldsDomainsValues($fieldsDomainsValues);
 $interfaceJavascriptTemplate1->setHookId("html_tags__1");
 $interfaceJavascriptTemplate1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptTemplate1->setJavascriptTemplate("<table id=\"interfaces_table\" cellpadding=\"5\" width=\"100%\">" .
 "<thead>" .
 "<tr>" .
 "<th align=\"left\">" . LABEL_INTERFACCE . "</th>" .
 "</tr></thead><tbody id=\"tbody_id\">{OBJ_1}" .
 "</tbody></table>"); 

 $interfaceJavascriptFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op1",NUM_1);        
 //$interfaceJavascriptFrag1 = new Javascript_fragment("Op1",NUM_1);
 $interfaceJavascriptFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptFrag1->setJavascriptFragment(
 "var container = new dijit.layout.StackContainer({style:\"width:350px;" .
 "height:400px;border:solid 1px black\;\"},\"html_tags__0\");" .
 "var child1 = new dijit.layout.ContentPane({id:\"simple_layout\",style:\"width:500px;height:100%\"});" .
 "var div = document.createElement(\"div\");" . 
 "div.style.width=\"100%\";" .
 "div.style.height=\"100%\";" .
 "\$(div).attr(\"id\",\"simple_layout_div\");" .
 "child1.domNode.appendChild(div);" .
 "container.addChild(child1);" .
 "container.startup();" .
 "var buttonLeft = new dijit.form.Button({label:\"->\",style:\"color:black;\"," .
 "onClick:function(){dijit.byId(\"html_tags__0\").forward();" .
 "var domNode = dijit.byId(\"html_tags__0\").selectedChildWidget.domNode;" .
 "}});" .
 "var buttonRight = new dijit.form.Button({label:\"<-\",style:\"color:black;\"," .
 "onClick:function(){dijit.byId(\"html_tags__0\").back();"  .
 "var domNode = dijit.byId(\"html_tags__0\").selectedChildWidget.domNode;" .
 "}});" .
 "var hr = document.createElement(\"hr\");" .
 "\$(\"#html_tags__9\").append(hr);" . 
 "\$(\"#html_tags__9\").append(buttonLeft.domNode);" .
 "\$(\"#html_tags__9\").append(buttonRight.domNode);" .
 "var hr = document.createElement(\"hr\");" .
 "\$(\"#html_tags__9\").append(hr);" .
 "var button = document.createElement(\"button\");" .
 "button.innerHTML=\"" . LABEL_SALVA_CONTENITORE . "\";" .
 "\$(button).attr(\"id\",\"Salva_button\");" . 
 "\$(\"#html_tags__9\").append(button);" .
 "\$(\"#html_tags__9\").append(button);");
 
 $interfaceJavascriptFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op2",NUM_1);         
 //$interfaceJavascriptFrag2 = new Javascript_fragment("Op2",NUM_1);
 $interfaceJavascriptFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptFrag2->setJavascriptFragment("var dndSource = " .
 "new dojo.dnd.Source(\"tbody_id\",{accept:[],copyOnly:true," .
  	"creator:function(actItem,actHint)" .
  	"{" .
  	"var tr = document.createElement(\"tr\");" .
  	"var num = $(\"#interfaces_table > tbody > tr\").size();" .
  	"\$(tr).attr(\"id\",\"Row_id_\" + num);" .
    "var span = document.createElement(\"span\");" .
    "span.innerHTML = actItem.value;" .
    "var td = document.createElement(\"td\");" . 
    "var img = document.createElement(\"img\");" .
    "\$(img).attr(\"src\",\"./img/\" + actItem.type + \".gif\");" . 
    "\$(img).attr(\"width\",\"49\");" .
    "\$(img).attr(\"height\",\"49\");" .
    "img.style.display='block';" .
    "td.appendChild(img);" .
    "td.appendChild(span);" .
    "tr.appendChild(td);" .
    "return {node: tr, data: actItem, type: \"text\"};" .
  	"}" .
    " });");

 $interfaceJavascriptFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op3",NUM_1);        
 //$interfaceJavascriptFrag3 = new Javascript_fragment("Op3",NUM_1);
 $interfaceJavascriptFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptFrag3->setJavascriptFragment("\$(\"#tbody_id tr\").each(function(){" .
 "var currentTypeId=this.id;var interfaccia = $(this).find(\"span\").text();" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_CANCELLA . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).remove();}" .
 "}));" . 
 "pMenu.startup();});");

 $interfaceJavascriptDataFrag1 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"TempInit",NUM_1);         
 //$interfaceJavascriptDataFrag1 = new Javascript_data_fragment("TempInit",NUM_1);
 $interfaceJavascriptDataFrag1->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag1->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag1->setDataFields(array(FIELD_WIDTH,FIELD_HEIGHT));
 $interfaceJavascriptDataFrag1->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,
 Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag1->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,
 Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceJavascriptDataFrag1->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag1->setJavascriptFragment(
 "var contentPane = new dijit.layout.ContentPane({region:\"center\",style:" .
 "\"background-color:green;width:#WIDTH#;height:#HEIGHT#;overflow:auto;padding:0px;\",splitter:false});" .
 "var table=document.createElement(\"table\");" .
 "table.style.padding=\"0px\";" .
 "table.style.width=\"80%\";" .
 "table.style.height=\"20px\";" . 
 "table.style.border=\"1px dotted white\";" .
 "table.style.marginLeft=\"10px\";" .
 "table.style.marginTop=\"25px\";" .
 "table.style.wordWrap=\"break-word\";" .
 "\$(table).attr(\"id\",\"container_table\");" .
 "var tbody=document.createElement(\"tbody\");" .
 "\$(tbody).attr(\"id\",\"container_tbody\");" .
 "\$(tbody).attr(\"width\",\"100%\");" .
 "var tr=document.createElement(\"tr\");" .
 "\$(tr).attr(\"id\",\"container_row_id_0\");" .
 "var td = document.createElement(\"td\");" .
 "\$(td).attr(\"width\",\"100%\");" .
 "tr.appendChild(td);" .
 "tbody.appendChild(tr);" .
 "table.appendChild(tbody);" .
 "contentPane.domNode.appendChild(table);" .
 "bc.addChild(contentPane);" .
 "bc.startup();" . 
 "\$(\"#\" + contentPane.domNode.id + \"_splitter\").remove();" .
 "container_dndSource=new dojo.dnd.Source(\"container_tbody\",{" .
 "creator:function(actItem,actHint)" .
 "{" .
 "var intName=\$(actItem).find(\"span\").text();" .
 "var oldIntName = intName;" .
 "var intItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
 "if(intItems.length==1)" .
 "{" .
 "ajaxHandler.synServerCall(\"" . AJAX_HANDLER_PAGE . "\",\"" . 
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME . "\",intName,\"text\",/[.]*\\w[.]*/);" .
 "var intName = ajaxHandler.getOpByName(\"" . 
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME . "\").result;" .
 "var intItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
 "}" .
 "var intType;" .
 "if(intItems.length==5)" .
 "intType = intItems[2];" .
 "else if(intItems.length==6) " .
 "intType=intItems[3];" .
 "else " .
 "intType=intName;" .
 "var tr = document.createElement(\"tr\");" .
 "var num = $(\"#container_table > tbody > tr\").size();" .
 "\$(tr).attr(\"id\",\"container_row_id_\" + num);" .
 "var span = document.createElement(\"span\");" .
 "span.innerHTML = oldIntName;" .
 "span.style.width=\"100%\";" .
 "var td = document.createElement(\"td\");" . 
 "td.style.padding=\"10px\";" .
 "\$(td).attr(\"width\",\"100%\");" .
 "var img = document.createElement(\"img\");" .
 "img.src=\"./img/\" + intType + \".gif\";" . 
 "\$(img).attr(\"title\",intName);" .
 "\$(img).attr(\"width\",\"49\");" .
 "\$(img).attr(\"height\",\"49\");" .
 "img.style.display='block';" .
 "td.appendChild(img);" .
 "td.appendChild(span);" .
 "tr.appendChild(td);" .
 "return {node: tr, data: actItem, type: \"text\"};" .
 "}});" .
 "dojo.connect(container_dndSource,\"onDndDrop\",function(source,nodes){" .
  "var i=0;\$(\"#container_tbody tr\").each(function(){var id = \"container_row_id_\" + i;" .
  "var pMenu=dijit.byId(\$(this).prop(\"pMenuId\"));if(pMenu!==undefined){pMenu.destroy()};" .
  "\$(this).attr(\"id\",id);i++;});var allIntCont=\"\";var j=0;" .
 "\$(\"#container_tbody tr\").each(function(){" .
 "var currentTypeId=\$(this).attr(\"id\");" .
 "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
 "});\$(this).prop(\"pMenuId\",pMenu.id);" .
 "var interfaccia = $(this).find(\"span\").text();" .
 "if(j==1)allIntCont = interfaccia; else if(j>1) allIntCont = allIntCont + \"" . 
 STRING_SEMICOLON . "\" + interfaccia;j++;" .
 "pMenu.addChild(new dijit.MenuItem({label: \"" . LABEL_CANCELLA . "\"," .
 "onClick:function(){\$(\"#\" + currentTypeId).remove();" .
 "var allIntCont=\"\";var k=0;" .
 "\$(\"#container_tbody tr\").each(function(){" .
 "var interfaccia = $(this).find(\"span\").text();" .
 "if(k==1)allIntCont = interfaccia; else if(k>1) allIntCont = allIntCont + \"" . 
 STRING_SEMICOLON . "\" + interfaccia;k++;" .
 "});window.returnVal = allIntCont;" .
 "}" .
 "}));" . 
 "pMenu.startup();});window.returnVal = allIntCont;});"
);

 $interfaceJavascriptDataFrag2 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"TempGetInterface",NUM_1);         
// $interfaceJavascriptDataFrag2 = new Javascript_data_fragment("TempGetInterface",NUM_1);
 $interfaceJavascriptDataFrag2->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag2->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag2->setDataFields(array());
 $interfaceJavascriptDataFrag2->setDataFieldsDomains(array());
 $interfaceJavascriptDataFrag2->setDataFieldsDomainsValues(array());
 $interfaceJavascriptDataFrag2->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag2->setJavascriptFragment("var itemsContainer = rootEl.getElementsByTagName(\"ind_interfacesContainer\");" .
 	"var num1 = itemsContainer.item(0).childNodes.length;" .
 	"var i=0;" .
  "\$(\"#container_table > tbody > tr\").each(function(){if(i>0)\$(this).remove();else i++;});" .
 	"for(var j=0;j<=num1-1;j++){" .
  "var tr = document.createElement(\"tr\");" .
  "var num = \$(\"#container_table > tbody > tr\").size();" .
  "\$(tr).attr(\"id\", \"container_row_id_\" + num);" .
  "var span = document.createElement(\"span\");" .
  "var intName = itemsContainer.item(0).childNodes[j].childNodes[0].nodeValue;" .
  "span.innerHTML = intName;" .
  "span.style.width=\"100%\";" .
  "var td = document.createElement(\"td\");" .
  "\$(td).attr(\"width\",\"100%\");" .
  "td.style.padding=\"10px\";" .
  "var intItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
  "var intType;" .
  "if(intItems.length==5)" .
  "intType = intItems[2];" .
  "else if(intItems.length==6)" .
  "intType=intItems[3];" .
  "else" .
  "intType=intName;" .
  "var img = document.createElement(\"img\");" .
  "img.src=\"./img/\" + intType + \".gif\";" .
  "\$(img).attr(\"width\",\"49\");" .
  "\$(img).attr(\"height\",\"49\");" .
  "\$(img).attr(\"title\",intName);" .
  "img.style.display=\"block\";" .
  "td.appendChild(img);" .
  "td.appendChild(span);" .
  "tr.appendChild(td);" . 	 	
 	"container_dndSource.insertNodes(false,[td]);" .
  "container_dndSource.sync();" .
 	"}" .
  "var i=0;\$(\"#container_tbody tr\").each(function(){var id = \"container_row_id_\" + i;" .
  "var pMenu=dijit.byId(\$(this).prop(\"pMenuId\"));if(pMenu!==undefined){pMenu.destroy()};" .
  "\$(this).attr(\"id\",id);i++;});var i=0;var allIntCont=\"\";" .
  "\$(\"#container_tbody tr\").each(function(){" .
  "var currentTypeId=\$(this).attr(\"id\");" .
  "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
  "});\$(this).prop(\"pMenuId\",pMenu.id);" .
  "pMenu.addChild(new dijit.MenuItem({label: \"Delete\"," .
  "onClick:function(){\$(\"#\" + currentTypeId).remove();" .
 "var allIntCont=\"\";var k=0;" .
 "\$(\"#container_tbody tr\").each(function(){" .
 "var interfaccia = $(this).find(\"span\").text();" .
 "if(k==1)allIntCont = interfaccia; else if(k>1) allIntCont = allIntCont + \"" . 
 STRING_SEMICOLON . "\" + interfaccia;k++;" .
 "});window.returnVal = allIntCont;" .
  "}" .
  "}));" .
  "var interfaccia = $(this).find(\"span\").text();" .
  "if(i==1)allIntCont = interfaccia; else if(i>1) allIntCont = allIntCont + \"" . 
  STRING_SEMICOLON . "\" + interfaccia;i++;" . 
  "pMenu.startup();});window.returnVal = allIntCont;"
);

 $interfaceJavascriptDataFrag3 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"TempSetInterfaces",NUM_1);         
// $interfaceJavascriptDataFrag3 = new Javascript_data_fragment("TempSetInterfaces",NUM_1);
 $interfaceJavascriptDataFrag3->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag3->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag3->setDataFields(array(FIELD_INTERFACCE));
 $interfaceJavascriptDataFrag3->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag3->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceJavascriptDataFrag3->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag3->setJavascriptFragment("var interfaces = \"#INTERFACCE#\";" .
 	"var interfacesItems = interfaces.split(\"" . STRING_SEMICOLON . "\");" .
 	"var interfacesItems2 = new Array();var n=0;" .
 	"for(var k=0;k<=interfacesItems.length-1;k++)" .
 	"{var el=interfacesItems[k];if(el !== '') interfacesItems2[n++]=el;}" .
 	"var num1 = interfacesItems2.length;" .
 	"var i=0;" .
  "\$(\"#container_table > tbody > tr\").each(function(){if(i>0)\$(this).remove();else i++;});" .
 	"for(var j=0;j<=num1-1;j++){" .
  "var tr = document.createElement(\"tr\");" .
  "var num = \$(\"#container_table > tbody > tr\").size();" .
  "\$(tr).attr(\"id\", \"container_row_id_\" + num);" .
  "var span = document.createElement(\"span\");" .
  "var intName = interfacesItems[j];" .
  "var intNameItems = intName.split(\"" . Xml_interface_serializer::INTERFACE_NAME_SEP . "\");" .
  "var intType=\"\";" .
  "if(intNameItems.length==6)" .
  "intType=intNameItems[3];" .
  "else if(intNameItems.length==5)" .
  "intType=intNameItems[2];" .
  "else" .
  "{intType=intName;}" .
  "span.innerHTML = intName;" .
  "span.style.width=\"100%\";" .
  "var td = document.createElement(\"td\");" .
  "\$(td).attr(\"width\",\"100%\");" .
  "td.style.padding=\"10px\";" .
  "var img = document.createElement(\"img\");" .
  "img.src=\"./img/\" + intType + \".gif\";" .
  "\$(img).attr(\"width\",\"49\");" .
  "\$(img).attr(\"height\",\"49\");" .
  "\$(img).attr(\"title\",intName);" .
  "img.style.display=\"block\";" .
  "td.appendChild(img);" .
  "td.appendChild(span);" .
  "tr.appendChild(td);" . 	 	
 	"container_dndSource.insertNodes(false,[td]);" .
  "container_dndSource.sync();" .
 	"}" .
  "var i=0;\$(\"#container_tbody tr\").each(function(){var id = \"container_row_id_\" + i;" .
  "var pMenu=dijit.byId(\$(this).prop(\"pMenuId\"));if(pMenu!==undefined){pMenu.destroy()};" .
  "\$(this).attr(\"id\",id);i++;});var i=0;var allIntCont=\"\";" .
  "\$(\"#container_tbody tr\").each(function(){" .
  "var currentTypeId=\$(this).attr(\"id\");" .
  "var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]" .
  "});\$(this).prop(\"pMenuId\",pMenu.id);" .
  "pMenu.addChild(new dijit.MenuItem({label: \"Delete\"," .
  "onClick:function(){\$(\"#\" + currentTypeId).remove();" .
 "var allIntCont=\"\";var k=0;" .
 "\$(\"#container_tbody tr\").each(function(){" .
 "var interfaccia = $(this).find(\"span\").text();" .
 "if(k==1)allIntCont = interfaccia; else if(k>1) allIntCont = allIntCont + \"" . 
 STRING_SEMICOLON . "\" + interfaccia;k++;" .
 "});window.returnVal = allIntCont;" .  
  "}" .
  "}));" .
  "var interfaccia = $(this).find(\"span\").text();" .
  "if(i==1)allIntCont = interfaccia; else if(i>1) allIntCont = allIntCont + \"" . 
  STRING_SEMICOLON . "\" + interfaccia;i++;" .  
  "pMenu.startup();});window.returnVal = allIntCont;"
);

 $interfaceJavascriptFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op4",NUM_1);
// $interfaceJavascriptFrag4 = new Javascript_fragment("Op4",NUM_1);
 $interfaceJavascriptFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptFrag4->setJavascriptFragment(
 "var simple_layout_bc=new dijit.layout.BorderContainer(" .
 "{design:\"headline\",style:\"height:100%;width:97%;border:solid 1px black;padding:0px;\"},\"simple_layout_div\");" .
 "var tempSimpleCenter = interfacesContainer.getInterface(\"TempInit\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Width\",\"100%\");" .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"Height\",\"100%\");" .
 "if(! tempSimpleCenter.isFieldInDataFields(\"bc\"))" .
 "tempSimpleCenter.addField(\"bc\",simple_layout_bc,\"var\");" .
 "else " .
 "tempSimpleCenter.setDataFieldDomainValueByName(\"bc\",simple_layout_bc);" .
 "tempSimpleCenter.putData();"
 );

 $interfaceJavascriptDataFrag4 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"getContainer",NUM_1);          
// $interfaceJavascriptDataFrag4 = new Javascript_data_fragment("getContainer",NUM_1);
 $interfaceJavascriptDataFrag4->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag4->setDataFields(array(FIELD_INTERFACCIA,FIELD_CONTAINER_NAME));
 $interfaceJavascriptDataFrag4->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC,Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag4->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ,Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceJavascriptDataFrag4->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag4->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag4->setJavascriptFragment("var interfaccia = \"#INTERFACCIA#\";" .
 "var i=0;" .
 "\$(\"#container_table > tbody > tr\").each(function(){if(i>0)\$(this).remove();else i++;});" .
 "if(interfaccia != \"\")ajaxHandler." .
 "synServerCall(\"" . AJAX_HANDLER_PAGE . "\",\"getNamedInterfacesContainer\",\"#INTERFACCIA#;#CONTAINER_NAME#\",\"xml\",/[0-9a-zA-Z_=\\\\-\<\>\?\"\.\s\/]*/);");

 $interfaceJavascriptDataFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_DATA_FRAGMENT,STRING_NULL,"setInterfaces",NUM_1);          
// $interfaceJavascriptDataFrag5 = new Javascript_data_fragment("setInterfaces",NUM_1);
 $interfaceJavascriptDataFrag5->setDataFields(array(FIELD_INTERFACCE));
 $interfaceJavascriptDataFrag5->setEnableExecuteOnLoad(false);
 $interfaceJavascriptDataFrag5->setDataFieldsDomains(array(Int_domain::FIELD_DOMAIN_ATOMIC));
 $interfaceJavascriptDataFrag5->setDataFieldsDomainsValues(array(Int_domain::FIELD_DOMAIN_VALUE_NONE ));
 $interfaceJavascriptDataFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptDataFrag5->setCallBackFunPattern("/[0-9a-zA-Z_=\-\<\>\?\"\.\s\/]*/");
 $interfaceJavascriptDataFrag5->setJavascriptFragment("var interfaces = \"#INTERFACCE#\";" .
 "var tempSetInt = interfacesContainer.getInterface(\"TempSetInterfaces\");" .
 "tempSetInt.setDataFieldDomainValueByName(\"Interfacce\",interfaces);" .
 "tempSetInt.putData();"
);

 $interfaceJavascriptFrag5 = Creator::create(Interfaces_info::INT_JAVASCRIPT_FRAGMENT,STRING_NULL,"Op5",NUM_1); 
// $interfaceJavascriptFrag5 = new Javascript_fragment("Op5",NUM_1);
 $interfaceJavascriptFrag5->setHookId(STRING_NULL);
 $interfaceJavascriptFrag5->setJavascriptFragment(
 "var setInterfacesInt = interfacesContainer.getInterface(\"setInterfaces\");" .
 "setInterfacesInt.putData();"
 );

 $interfaceFrame1 = Creator::create(Interfaces_info::INT_HTML_DIV_TAG,STRING_NULL);  
// $interfaceFrame1 = new Html_div_tag();
 $dispFields = array(LABEL_VOID);
 $interfaceFrame1->setDispFields($dispFields);
 $attribs = array("style"=>"background-color:#290094;" .
 "border:1px solid white;padding:10px 10px 10px 10px;");
 $interfaceFrame1->setAttribs($attribs);

 $interfaceFrameContainer1 = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,STRING_NULL); 
// $interfaceFrameContainer1 = new Interfaces_container(STRING_NULL);
 $interfaceFrameContainer1->add($interfaceDivTag1);
 $interfaceFrame1->setInterfacesContainer($interfaceFrameContainer1);

 $interfaceTempMsg1 = Creator::create(APPLICATION_NAME . VAR_SEP . Interfaces_info::INT_TEMP_MSG,STRING_NULL,OP_NONE,NUM_0,true,true);
// $interfaceTempMsg1 = new Cheope_ns_temp_msg(OP_NONE,NUM_0,true,true);
 $interfaceTempMsg1->setGesPage(PAGE_LOGIN);
 $interfaceTempMsg1->setIsSequenceActive(true);
 $interfaceTempMsg1->setText(MSG_10);
 $interfaceTempMsg1->setSequenceStrings(array(STRING_NULL,MSG_10));
 $interfaceTempMsg1->setButtonFlag(false);

 $interfacesContainer = Creator::create(getClassNameForCreate(Classes_info::INTERFACES_CONTAINER_CLASS),STRING_NULL,CONTENITORE_GLOBALE_INTERFACCE);   
// $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
 $interfacesContainer->add($interfaceDivTag1);
 $interfacesContainer->add($interfaceTempMsg1);
 $interfacesContainer->add($interfaceJavascriptTemplate2);
 $interfacesContainer->add($interfaceJavascriptTemplate1);
 $interfacesContainer->add($interfaceJavascriptDataFrag1);
 $interfacesContainer->add($interfaceJavascriptDataFrag2);
 $interfacesContainer->add($interfaceJavascriptDataFrag3);
 $interfacesContainer->add($interfaceJavascriptFrag1);
 $interfacesContainer->add($interfaceJavascriptFrag2);
 $interfacesContainer->add($interfaceJavascriptFrag3); 
 $interfacesContainer->add($interfaceJavascriptFrag4); 
 $interfacesContainer->add($interfaceJavascriptDataFrag4);
 $interfacesContainer->add($interfaceJavascriptDataFrag5);
 $interfacesContainer->add($interfaceJavascriptFrag5);
 $interfacesContainer->add($interfaceFrame1);


 $page = Creator::create(APPLICATION_NAME . VAR_SEP . DEFAULT_PAGE_NAME . VAR_SEP . "op_page",STRING_NULL);
// $page = new Cheope_ns_manage_interface_container_op_page();
 $ajaxOps = array(AJAX_OP_GET_NAMED_INTERFACE_CONTAINER,
 AJAX_OP_GET_FREE_INTERFACE_CANONICAL_NAME);
 $page->setJQueryEnabled(true);
 $page->setDojoEnabled(true);
 $page->setAjaxOps($ajaxOps);
 $page->setCREnabled(true);
 $page->setInterfacesContainer($interfacesContainer);
 $page->setLocalizationEnabled(true);
 $page->setLocale("EN");
 $page->putData();

?>