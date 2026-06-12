function getLabelsFromMenu(actId)
{
 var nodes = new Array();
 var i=0;
 $('#' + actId).children().children().children('.dijitMenuItemLabel').each(function(){if (this.innerHTML !== '')nodes[i++] = 
 this.innerHTML});
 return nodes;
}

function input_num_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[0-9]+[0-9]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function input_op_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function shortName_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
  if(fieldVal=='')
  {
	 $('#checkBox_IFreeName').get(0).checked=false;
  }
}

function checkbox_IFreeName_onClick(actObj)
{
	if($(actObj).get(0).checked)
	{
		if($('#shortName').val().replace(/\s*/g,'')=='')
		{
		 alert(loc.getString('msg',66));
		 $(actObj).get(0).checked=false;
	  }
	}
}

function form_inserimento_1_submit_button_onClick()
{
 var nomePagina = $('#Nome_pagina').get(0).value;
 document.forms['default_form'].action = document.forms['default_form'].action + '?NomePagina=' + nomePagina;
}

function loadGroupedField(actPar)
{
 var postStr = 'array(';
 var results = false;
 $('#html_tags__1 [role=' + util.lcFirst(actPar) + ']').each(
 function()
 {
 	var valueStr = this.value.substr(0,5);
 	if(valueStr=='array')
 	 postStr += this.value + ',';
 	else
 	 if((this.type=="checkbox")&&(this.checked))
 	 { 
 		var elsStrArray = this.id.split('_');
 		var suffixNum = elsStrArray[elsStrArray.length-1];
 		var idCode = '#DataFields_' + suffixNum;
 		var checkBoxVal = $(idCode.replace(/\"/g,'')).get(0).value; 
 		postStr += '\'' + checkBoxVal + '\',';
 	 }
 	 else if(this.type!="checkbox")
 	 {
    var templ = /((\"|\')*[A-Z_a-z0-9]+[A-Z_a-z0-9]*(\"|\')*)\s*=>\s*((\"|\')*[\S=>\'\"\(\)\s*]+(\"|\')*)/g;
    var results = templ.exec(this.value);
	//console.log(results);
    if(results !== null)
    {

    	//postStr += 'array(' + results[1] + '=>' + results[4].replace(/\"/g,'\\\"') + ',';
        postStr += results["input"] + ',';
		//console.log(postStr);
	}	 	
    else
 		 postStr += '\'' + this.value.replace(/\"/g,'\\\"') + '\',';
   }
 }
 );
 if (! results) postStr += ')';
// console.log(postStr);
 return postStr;
}

function button_1_onClick()
{
 var strVal = $('#Nome_pagina').get(0).value;
 if($('#Lista_interfacce').get(0) != undefined){
 var listaStr = $('#Lista_interfacce').get(0).value.replace(/\s*/g,'');
 if(listaStr=='')
  alert(loc.getString('msg',23));
 else
 {
 	var postStr = "Nome_interfaccia=" + encodeURIComponent(listaStr) + '&';
  postStr = postStr + $('#Nome_pagina').get(0).id + '=' + 
  encodeURIComponent($('#Nome_pagina').get(0).value) + '&';
  var num = $('#html_tags__0 input').length;
  $('#html_tags__0 input').each(
  function(index)
  {
   var field = $(this).get(0);
   if(index < num-1)
   {
  	postStr = postStr + field.id + '=' + 
  	encodeURIComponent(
  	(field.type=='checkbox')?((field.checked)?'true':'false'):field.value) + '&';
   }
   else
   {
   	postStr = postStr + field.id + '=' + 
  	encodeURIComponent(
  	(field.type=='checkbox')?((field.checked)?'true':'false'):field.value)
   }
  }); 
  var num = $('#html_tags__0 > textarea').length;
  $('#html_tags__0 > textarea').each(
  function(index)
  {
   var vid = $(this).get(0).id; 
   var idBody = vid.substr(1,vid.length-1);
   var typeStr = vid.substr(0,1);
   //
   // $ e @ e % sono caratteri speciali che derivano dalle proprietà corrispondenti sul 
   // file xml. (@ indica forzatura campo textarea nell'editor di interfacce;
   // $ indica quelle proprietà array dell'interfaccia che sono ad indice numerico;
   // % indica quelle proprietà che prendono il valore di default imposto dal codice
   // php.)
   // 
   if(typeStr=='@')
   {
    if(index==0)
     postStr = postStr + '&';
    if(index < num-1)
    {
     postStr = postStr +  $(this).get(0).id + 
     '=' + encodeURIComponent($(this).get(0).value) + '&';
    }
    else
    {
     postStr = postStr +  $(this).get(0).id + '=' + 
     encodeURIComponent($(this).get(0).value);
    }
   }
   else if(((typeStr=='$')||(vid=='dataFields')||
   	(vid=='dataFieldsDomains')||(vid=='dataFieldsDomainsValues'))
   	&&($('#override_separated').get(0).checked))
   {
   	if(index==0)
   	 postStr = postStr + '&';
   	if(index < num-1)
   	{
   	 postStr = postStr + '#' + $(this).get(0).id + 
   	 '=' + encodeURIComponent(loadGroupedField(((typeStr=='$')?idBody:vid))) + '&';
    }
    else
    {
    	postStr = postStr + '#' + $(this).get(0).id + '=' + 
    	encodeURIComponent(loadGroupedField(((typeStr=='$')?idBody:vid)));
    }
  //  console.log(postStr);
   }
   else 
   {
    if(index==0)
     postStr = postStr + '&';
    if(index < num-1)
    {
     postStr = postStr + '#' + vid + 
     '=' + encodeURIComponent(
     $(this).get(0).value) + '&';
    }
    else
    {
     postStr = postStr + '#' + vid + '=' + 
     encodeURIComponent(
    $(this).get(0).value);
    }
   }
  }
 );
 $('.container').each(function(index)
 {
 	var thisId = this.id;
 	var num1 = $(this).find('option:not(:empty)').length;
 	if(num1 > 0)
 	{
  $(this).find('option:not(:empty)').each(
  function(index)
  {
 	 if(index==0)
 	  postStr = postStr + '&|' + thisId + '=';
   if(index < num1-1)
   {
    postStr = postStr + encodeURIComponent($(this).text()) + ';'
   }
   else
   {
    postStr = postStr + encodeURIComponent($(this).text());
   }
  }
  );
 }
 else
 {
 	postStr = postStr + '&|' + thisId + '=';
 }
 });
  //pattern = /[\s\._\:A-Za-z0-9;\-]/;
  pattern = /[]/;
  ajaxHandler.serverPostCall('ajax_handler.php','postSendInterfaceData','_',postStr,'text',pattern);
  alert(loc.getString('msg',91));
 }
}
}

function lista_interfacce_onChange(actObj)
{
 var nomeInterfaccia = actObj.value;
 ajaxHandler.synServerCall('ajax_handler.php','getInterfaceIds',nomeInterfaccia,'xml',/[.]*ind_records[.]*/);
 var nomeInterfacciaItems = ajaxHandler.getOpByName('getInterfaceIds').results;
 var nomePagina = nomeInterfacciaItems[1];
 var intPage = 'interfaces.php';
 newLocation =  intPage + '?Interfaccia=' + actObj.value + '&NomePagina=' + nomePagina ;
 window.location = newLocation;
 //alert(loc.getString('msg',91));
}

//function lista_interfacce_2_onChange(actObj)
//{
// $('#InterfacesContainerBottom option:selected').text($(actObj).val());
// if($('#InterfacesContainerBottom option:last').text()==$('#InterfacesContainerBottom option:selected').text())
//  $('#InterfacesContainerBottom').append('<option></option>');
//}

function lista_interfacce_2_onChange(actObj)
{
 $('#InterfacesContainer option:selected').text($(actObj).val());
 if($('#InterfacesContainer option:last').text()==$('#InterfacesContainer option:selected').text())
  $('#InterfacesContainer').append('<option></option>');
}

function form_inserimento_1_genitori_onChange(actObj)
{
 var nomeIntGen = $('#Genitori').get(0).value;
 ajaxHandler.synServerCall('ajax_handler.php','getInterfaceIds',nomeIntGen,'xml',/CDATA/);
 var nomeIntGenItems = ajaxHandler.getOpByName('getInterfaceIds').results;
 var nomePagina = nomeIntGenItems[1];
 var intPage = 'interfaces.php';
 newLocation =  intPage + '?Interfaccia=' + actObj.value + '&NomePagina=' + nomePagina ;
 window.location = newLocation;
}

function insert_in_container_interfaces(actInd1,actInd2)
{
 var item1Obj=$('#' + actInd2 + ' option:selected');
 var item2Obj=$('#select_' + actInd1 + ' option:selected');
 var item2ObjClone=item2Obj.clone();
 item2ObjClone.insertBefore(item1Obj); 	
}

function select_container_interfaces(actInd1,actInd2)
{
 var item1=$('#' + actInd2 + ' option:selected').text();
 var item2=$('#select_' + actInd1).val();
 var parsValues = util.getUrlArgsValues(window.location.search);
 var intr=parsValues[0];
 if(item2==intr)
 {
		alert(loc.getString('msg',57));
		return false;
 } 
 if((item1=='')&&(item2!=''))
 {$('#' + actInd2).append('<option></option>')}
 $('#' + actInd2 + ' option:selected').text(item2);
 $('#' + actInd2 + ' option:selected').val(item2);		
}

function select_container_interfaces_onClick(actInd1,actInd2)
{
 var item1=$('#' + actInd2 + ' option:selected').text();
 var item2=$('#select_' + actInd1).val();
 var parsValues = util.getUrlArgsValues(window.location.search);
 var intr=parsValues[0];
 if(item2==intr)
 {
		alert(loc.getString('msg',57));
		return false;
 } 
 if((item1=='')&&(item2!=''))
 {$('#' + actInd2).append('<option></option>')}
 $('#' + actInd2 + ' option:selected').text(item2);
 $('#' + actInd2 + ' option:selected').val(item2);		
}

function button_obj_onClick()
{
	 var nodeName = $('#obj').val();
	 if((nodeName.replace(/\s*/g,'') == '')||
	 ($('#obj').get(0).value=='OBJ_NONE'))
	 {
	  alert(loc.getString('msg',50));
	  return false;
   } 
 	 ajaxHandler.synServerCall('ajax_handler.php','getNodeType',nodeName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	 var nodeType = ajaxHandler.getOpByName('getNodeType').result;
   if(nodeType=='')
   {
	alert(loc.getString('msg',50));
	return false;
   }
   if(nodeType=='Bind')
   {
 	  ajaxHandler.synServerCall('ajax_handler.php','getBindNodeType',nodeName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	  nodeType = ajaxHandler.getOpByName('getBindNodeType').result; 
 	  ajaxHandler.synServerCall('ajax_handler.php','getBindNodeName',nodeName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	  nodeName = ajaxHandler.getOpByName('getBindNodeName').result;
   }
 	 if(nodeType=='Alias')
 	 {
 		ajaxHandler.synServerCall('ajax_handler.php','getTableFromAlias',nodeName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 		nodeName = ajaxHandler.getOpByName('getTableFromAlias').result;
 		subModal.showPopWin('view_table.php?Par=' + nodeName,700,400,function(actVar){},true);
 	 }
 	 else if(nodeType=='Table')
 	 {
 	  subModal.showPopWin('view_table.php?Par=' + nodeName,700,400,function(actVar){},true);
   }
   else if(nodeType=='Query')
   {
 	  subModal.showPopWin('view_query.php?Par=' + nodeName,700,400,function(actVar){},true);  	
   }
   else if(nodeType=='Xml')
   {
    var app = $('#active_application_id').text().replace(/\s*/g,'');
 	  subModal.showPopWin('view_module.php?Par=../' + app + '/xml/' + nodeName,700,400,function(actVar){},true);  	
   }
   else if(nodeType=='Json')
   {
    var app = $('#active_application_id').text().replace(/\s*/g,'');
 	  subModal.showPopWin('view_module.php?Par=../' + app + '/json/' + nodeName,700,400,function(actVar){},true);  	
   }
}

function button_container_onClick(actObj)
{
	var intName = $(actObj).parent().find('select').val();
	if(intName.replace(/\s*/g,'') != '')
 	 subModal.showPopWin('view_interface.php?Par=' + intName,
 	 700,400,function(actVar){},true);
  else
   alert(loc.getString('msg',56));
}

function span_container_onClick(actObj)
{
  var parsValues = util.getUrlArgsValues(window.location.search);
  var intName = parsValues[0];
	var selectObj0 = $(actObj).parent().find('select').get(0);
	var selectJQueryObj = $(selectObj0);
	var intContId = selectJQueryObj.attr('id');
	var intContName = intContId.replace(/InterfacesContainer/,'');
	var intCont = '';
	var i=0;
	selectJQueryObj.find('option').each(function(){ if($(this).text()!='') 
		intCont=intCont + $(this).text() + ';'; i++;});
 	subModal.showPopWin('manage_interface_container.php?Interfaccia=' + 
 	intName + '&ContainerName=' + intContName + '&Contenuto=' + intCont
 	,750,400,
 	function(actVar)
 	{if(actVar !== undefined){util.deleteSelectFieldContents(intContId);
 	 var items = actVar.split(';');
 	 for(var item in items){ var option = document.createElement('option');
 	$(option).text(items[item]);selectJQueryObj.append(option);}
 	selectJQueryObj.append('<option></option>');}
 	 },true);
}

function htmlFragment_span_container_onClick(actObj)
{
	var textareaObj0 = $(actObj).prev().prev().get(0);
	var textareaJQueryObj = $(textareaObj0);
	var intCont = textareaJQueryObj.val();
 	subModal.showPopWin('manage_fckeditor.php?Par=' + encodeURIComponent(intCont) 
 	,750,400,
 	function(actVar)
 	{var value=decodeURIComponent(actVar).replace(/\+/g," ");$(textareaObj0).val(value);}
 	,true);
}

function button_2_onClick(actActiveApp,actServerName,actDocRoot)
{
  var parsValues = util.getUrlArgsValues(window.location.search);
  var intr = parsValues[0];

    if(intr==undefined)
	 return false;
 
	if(intr.replace(/\s*/g,'')=='')
	{
		alert(loc.getString('msg',56));
		return false;
  }
  
  var result = intr.match(/([A-Za-z]?[A-Za-z_0-9]*)!([A-Za-z]?[A-Za-z_0-9]*)!([A-Za-z]?[A-Za-z_0-9]*)!([A-Za-z]?[A-Za-z_0-9]*)!([A-Za-z]?[A-Za-z_0-9]*)/);
  
  if (result != null)
  {
  	var intType = result[3];
  	if(intType == "html_page")
  	{
  	 alert(loc.getString('msg',87));
  	 return false;
  	} 
  } 
  
  var crEnabled = 1;
  var dojoEnabled = 1;
  var jqueryEnabled = 1;
  var dataPageEnabled = 1;

  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled ;
  
  pattern = /[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*[aA]rray[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*/;
  //console.log(intr);
  ajaxHandler.synServerCall('ajax_handler.php','createPreview',intr,'text',pattern);
  
  var dirName=actActiveApp;
  if(dirName != '')
    window.open('http://' + actServerName +
   '/' + actDocRoot + '/' + dirName +
   '/' + 'preview.php');
  
  return false;	
}

function setDataFieldsMenuItems(actXmlDoc)
{
 var menu = dijit.byId('dataFields_menu_id');
 var widgetSet = menu.getChildren();
 for(var widgetInd in widgetSet)widgetSet[widgetInd].destroy();
 var rootEl = actXmlDoc.documentElement;
 var len = rootEl.childNodes[0].childNodes.length;
 var childs = rootEl.childNodes[0].childNodes;
 var i=0;
 dojo.forEach(childs,function(child,i)
 { 
 	var field=child.firstChild.nodeValue; 
 	menu.addChild(new dijit.MenuItem({label: field,
  onClick:function(){
  var selection = new Selection(document.getElementById('dataFields'));
  var s = selection.create();
  var lenStr = document.getElementById('dataFields').value.length;
  var leftStr = document.getElementById('dataFields').value.substring(0,s.start);
  var rightStr = document.getElementById('dataFields').value.substring(s.end,lenStr);
  var newStr = leftStr + field + rightStr;
  document.getElementById('dataFields').value=newStr;  
  }}));
  });
 $("#html_tags__1 [role=dataFields]").each(function(){ 
 var ids = this.id;
 var menu = dijit.byId(ids + '_menu_id');
 var widgetSet = menu.getChildren();
 for(var widgetInd in widgetSet)widgetSet[widgetInd].destroy();
 dojo.forEach(childs,function(child,i)
 {
  var field = child.firstChild.nodeValue;
 	menu.addChild(
   new dijit.MenuItem(
   {
   label:field,
   onClick:function(){ 
   var selection = new Selection(document.getElementById(ids));
   var s = selection.create();
   var lenStr = document.getElementById(ids).value.length;
   var leftStr = document.getElementById(ids).value.substring(0,s.start);
   var rightStr = document.getElementById(ids).value.substring(s.end,lenStr);
   var newStr = leftStr + field + rightStr;
  document.getElementById(ids).value = newStr;
 }}
 ));
 });
 });
 var menu = dijit.byId('dataFields_menu_id');
 var widgetSet = menu.getChildren();
 for(var widgetInd in widgetSet)widgetSet[widgetInd].destroy();
 dojo.forEach(childs,function(child,i)
 {
  var field = child.firstChild.nodeValue;
 	menu.addChild(
   new dijit.MenuItem(
   {
   label:field,
   onClick:function(){ 
   var selection = new Selection(document.getElementById('DataFields_new'));
   var s = selection.create();
   var lenStr = document.getElementById('DataFields_new').value.length;
   var leftStr = document.getElementById('DataFields_new').value.substring(0,s.start);
   var rightStr = document.getElementById('DataFields_new').value.substring(s.end,lenStr);
   var newStr = leftStr + field + rightStr;
  document.getElementById('DataFields_new').value = newStr;
 }}
 ));
 });
}

function select_nodes_onChange(actObj,actTargetId)
{
 $('#' + actTargetId).get(0).value = actObj.value;
 if(((actObj.value.replace(/\s*/g,''))!='')&&(actObj.value!='OBJ_NONE')) 
 {
 var len = actObj.value.length;
 $('#' + actTargetId).get(0).size=len+10;
 ajaxHandler.synServerCall('ajax_handler.php','getNodeType',actObj.value,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 var nodeType = ajaxHandler.getOpByName('getNodeType').result;
 var nodeName='';
 if(nodeType=='Bind')
 {
 	ajaxHandler.synServerCall('ajax_handler.php','getBindNodeType',actObj.value,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	nodeType = ajaxHandler.getOpByName('getBindNodeType').result;
 	ajaxHandler.synServerCall('ajax_handler.php','getBindNodeName',actObj.value,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	nodeName = ajaxHandler.getOpByName('getBindNodeName').result;
 }
 if(nodeName=='')
  nodeName = actObj.value;
 if(nodeType=='Table')
   ajaxHandler.synServerCall('ajax_handler.php','getAllTableFields',nodeName,'xml',/CDATA/);
 else if(nodeType=='Alias')
 	 ajaxHandler.synServerCall('ajax_handler.php','getAllAliasFields',nodeName,'xml',/CDATA/);
 else if(nodeType=='Query')
 	ajaxHandler.synServerCall('ajax_handler.php','getAllQueryFields',nodeName,'xml',/CDATA/); 
 else if((nodeType=='Xml')||(nodeType=='Json'))
 	ajaxHandler.synServerCall('ajax_handler.php','getAllModuleFields',nodeName,'xml',/CDATA/); 
 }
}

function getFieldStr(actProps)
{
	var fieldsNames = actProps;
 	var num = fieldsNames.length;
 	var fieldsNamesStr = 'array(' + '\n' + '  ';
 	for(var i=0;i<=num-1;i++)
 	{
 		if(i < num-1)
 		fieldsNamesStr = fieldsNamesStr + i + ' => ' + '\'' +
 		fieldsNames[i] + '\',' + '\n' + '  ';
 	  else
  	fieldsNamesStr = fieldsNamesStr + i + ' => ' + '\'' +
 		fieldsNames[i] + '\',';	  	
 	}
 	fieldsNamesStr = fieldsNamesStr  + '\n' + ')';
 	return fieldsNamesStr;
}

function span_dataFields_onClick(actObj)
{
 var parsValues = util.getUrlArgsValues(window.location.search);
 var intName = parsValues[0];
 var objNode = $('#obj').val();
 subModal.showPopWin('manage_fields.php?Interfaccia=' + 
 intName + '&Obj2=' + objNode,700,400,function(actVar)
 {
 	if(actVar)
 	{
 	var fieldsAttrs = actVar;
 	var fieldsNames = fieldsAttrs['names'];
  var fieldsNamesStr = getFieldStr(fieldsNames);
 	$('#dataFields').val(fieldsNamesStr);
 	var fieldsDomains = fieldsAttrs['domains'];
  var fieldsNamesStr = getFieldStr(fieldsDomains);
 	$('#dataFieldsDomains').val(fieldsNamesStr);
 	var fieldsDomainsValues = fieldsAttrs['domainsValues'];
 	//console.log(fieldsDomainsValues);
 	var num = fieldsDomainsValues.length;
 	var fieldsNamesStr = 'array(' + '\n' + '  ';
 	for(var key in fieldsDomainsValues)
 	{
 		  var templ1 = /\s*array\s*\([\S\n\r\s\'\"]*\)\s*/g;
      var templ2 = /(\'[A-Z_a-z]+[A-Z_a-z0-9]*\')\s*=>\s*([\s\n\r\S]*)/g;
      var results1 = templ1.exec(fieldsDomainsValues[key]);
      var results2 = templ2.exec(fieldsDomainsValues[key]);
      if(! results1)
      {
       if(! results2)
 			  fieldsNamesStr = fieldsNamesStr + key + ' => ' + 
 			  fieldsDomainsValues[key] + ',' + '\n' + ' ';
 			 else
 				fieldsNamesStr = fieldsNamesStr + results2[1] + ' => ' + 
 			  results2[2] + ',' + '\n' + ' ';
 			}
 			else
 			 fieldsNamesStr = fieldsNamesStr + results1[0] + ',' + '\n' + ' '; 			 			 
 	 }
 	 fieldsNamesStr = fieldsNamesStr  + '\n' + ')';
 	$('#dataFieldsDomainsValues').val(fieldsNamesStr);
 }
 },true);
}

function button_3_onclick()
{
 var labels = [];
 var items = {};
 var i=0;
 $('#fields_template label').each(function(){labels[i++]=this.innerHTML});
 var num = labels.length;
 for(var j=0;j<=num-1;j++)
 {
 	var field = $('#' + labels[j] + '_new').get(0);
 	if((field.tagName=='INPUT')&&(field.type=='checkbox'))
 	 items[labels[j]] = field.checked;
 	else if(field.tagName=='INPUT')
 	 items[labels[j]] = field.value;
 	else if(field.tagName=='TEXTAREA')
 	 items[labels[j]] = field.value;
 }
 dndSource.insertNodes(false,[items]);
 dndSource.sync();

 var childrenNodes;
 var objMenu = dijit.byId("dataFields_menu_id");
 if(objMenu != undefined)
  childrenNodes = objMenu.getChildren();
 var num = $('#main_list > li').size()-1;
 var dataFieldId = 'DataFields_' + num;
 var pMenu = new dijit.Menu({targetNodeIds:[dataFieldId]});
 for(var node in childrenNodes)
 {
  pMenu.addChild(
  function(actLabel)
  {
   return new dijit.MenuItem(
   {
   label:actLabel,
   onClick:function(){ 
   var selection = new Selection(document.getElementById(dataFieldId));
   var s = selection.create();
   var lenStr = document.getElementById(dataFieldId).value.length;
   var leftStr = document.getElementById(dataFieldId).value.substring(0,s.start);
   var rightStr = document.getElementById(dataFieldId).value.substring(s.end,lenStr);
   var newStr = leftStr + actLabel + rightStr;
   document.getElementById(dataFieldId).value = newStr;
   }
  }
  )
  }(childrenNodes[node].label)
  );
 }
 pMenu.startup(); 	
 
 var childrenNodes;
 var objMenu = dijit.byId("dataFieldsDomains_menu_id");
 if(objMenu != undefined)
  childrenNodes = objMenu.getChildren();
 var num = $('#main_list > li').size()-1;
 var dataFieldDomainId = 'DataFieldsDomains_' + num;
 var pMenu = new dijit.Menu({targetNodeIds:[dataFieldDomainId]});
 for(var node in childrenNodes)
 {
  pMenu.addChild(
  function(actLabel)
  {
   return new dijit.MenuItem(
   {
   label:actLabel,
   onClick:function(){ 
   var selection = new Selection(document.getElementById(dataFieldDomainId));
   var s = selection.create();
   var lenStr = document.getElementById(dataFieldDomainId).value.length;
   var leftStr = document.getElementById(dataFieldDomainId).value.substring(0,s.start);
   var rightStr = document.getElementById(dataFieldDomainId).value.substring(s.end,lenStr);
   var newStr = leftStr + actLabel + rightStr;
   document.getElementById(dataFieldDomainId).value = newStr;
   }
  }
  )
  }(childrenNodes[node].label)
  );
 }
 pMenu.startup();
 
 var childrenNodes;
 var objMenu = dijit.byId("dataFieldsDomainsValues_menu_id");
 if(objMenu != undefined)
  childrenNodes = objMenu.getChildren();
 var num = $('#main_list > li').size()-1;
 var dataFieldDomainValueId = 'DataFieldsDomainsValues_' + num;
 var pMenu = new dijit.Menu({targetNodeIds:[dataFieldDomainValueId]});
 for(var node in childrenNodes)
 {
  pMenu.addChild(
  function(actLabel)
  {
   return new dijit.MenuItem(
   {
   label:actLabel,
   onClick:function(){ 
   var selection = new Selection(document.getElementById(dataFieldDomainId));
   var s = selection.create();
   var lenStr = document.getElementById(dataFieldDomainValueId).value.length;
   var leftStr = document.getElementById(dataFieldDomainValueId).value.substring(0,s.start);
   var rightStr = document.getElementById(dataFieldDomainValueId).value.substring(s.end,lenStr);
   var newStr = leftStr + actLabel + rightStr;
   document.getElementById(dataFieldDomainValueId).value = newStr;
   }
  }
  )
  }(childrenNodes[node].label)
  );
 }
 pMenu.startup();
}
