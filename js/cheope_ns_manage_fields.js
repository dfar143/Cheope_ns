function setFieldNameMenu(actId,actDomainFieldId,actDomainValueFieldId,actFields)
{
 var pMenu = new dijit.Menu({targetNodeIds: [actId]
 });
 dojo.forEach(
 actFields,function(field,index)
 {
  pMenu.addChild(
  new dijit.MenuItem(
  {label: field,
  onClick:function()
 { 
  $('#' + actId).val(field);
  $('#' + actDomainFieldId).val('atomic');
  $('#' + actDomainValueFieldId).val('\'\'');
  $('#' + actId).change($('#' + actId).get(0),input_field_onChange);
  $('#' + actId).trigger('change');
 }
 })
 );
 });
 pMenu.startup();
}

function getNodeFields(actNode)
{
 var fields = [];
 var intObj = actNode;
 if((intObj != '')&&(intObj != 'OBJ_NONE'))
 {
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',intObj,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  var nodeType = ajaxHandler.getOpByName('getNodeType').result;
  if(nodeType=='Table')
  {
   ajaxHandler.synServerCall('ajax_handler.php','getAllTableFields',intObj,'xml',/CDATA/);
   fields = ajaxHandler.getOpByName('getAllTableFields').result;
  }
  else if(nodeType=='Alias')
  {
   ajaxHandler.synServerCall('ajax_handler.php','getAllAliasFields',intObj,'xml',/CDATA/);
  fields = ajaxHandler.getOpByName('getAllAliasFields').result;
  }
  else if(nodeType=='Query')
  {
   ajaxHandler.synServerCall('ajax_handler.php','getAllQueryFields',intObj,'xml',/CDATA/);
   fields = ajaxHandler.getOpByName('getAllQueryFields').result;
  }
  else if(nodeType=='Bind')
  {
   ajaxHandler.synServerCall('ajax_handler.php','getAllBindFields',intObj,'xml',/CDATA/);
   fields = ajaxHandler.getOpByName('getAllBindFields').result;
  }  
  else if((nodeType=='Xml')||(nodeType=='Json'))
  {
   ajaxHandler.synServerCall('ajax_handler.php','getAllModuleFields',intObj,'xml',/CDATA/);
   fields = ajaxHandler.getOpByName('getAllModuleFields').result;
  }
 } 
 return fields;
}

function setDomainMenu(actId,actDomainValueFieldId)
{
 var pMenu = new dijit.Menu({targetNodeIds: [actId]
 });
 pMenu.addChild(new dijit.MenuItem({label: 'atomic',
 onClick:function(){ 
 $('#' + actId).val('atomic'); 
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 })); 
 pMenu.addChild(new dijit.MenuItem({label: 'atomic_static',
 onClick:function(){
 $('#' + actId).val('atomic_static');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
  }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'set',
 onClick:function(){
 $('#' + actId).val('set');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('array()');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');

 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'object',
 onClick:function(){
 $('#' + actId).val('object');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 ajaxHandler.synServerCall('ajax_handler.php','getAllInterfacesOfPage',window.intPage,'xml',/CDATA/);
 var interfaces = ajaxHandler.getOpByName('getAllInterfacesOfPage').result;
 var j=0;
 var num = interfaces.length;
 var intList = 'sourceInt' + '=' + window.intName + '&';
 for(j=0;j<=num-1;j++)
  if(interfaces[j] != window.intName)
  intList = intList + 'int_' + j +  '=' + interfaces[j] + '&';
 ajaxHandler.synServerPostCall('ajax_handler.php','filterParentsInterfacesFiles','',intList,'xml',/CDATA/);
 interfaces = ajaxHandler.getOpByName('filterParentsInterfacesFiles').result;
 var domainValueId = actDomainValueFieldId;
 var pMenuDomainValue = new dijit.Menu({targetNodeIds: [domainValueId]});
 dojo.forEach(interfaces,function(interface,index)
 {
  pMenuDomainValue.addChild(new dijit.MenuItem({label: interface,
  onClick:function(){  
  $('#' + actDomainValueFieldId).val('\'' + interface + '\'');
  $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
  $('#' + actDomainValueFieldId).trigger('change'); 
 }
 }))
 }); 
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label:'function',
 onClick:function(){
 $('#' + actId).val('function');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
  pMenu.addChild(new dijit.MenuItem({label:'string_php_code',
 onClick:function(){
 $('#' + actId).val('string_php_code');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'table',
 onClick:function(){
 $('#' + actId).val('table');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'table_no_lookup',
 onClick:function(){
 $('#' + actId).val('table_no_lookup');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'table_unique_val',
 onClick:function(){
 $('#' + actId).val('table_unique_val');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
   pMenu.addChild(new dijit.MenuItem({label:'static_text',
 onClick:function(){
 $('#' + actId).val('static_text');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 var intType=$(window.parent.document).find("#type").val();
 if((intType=='form')||(intType=='form_2')||(intType=='form_section'))
 {
 pMenu.addChild(new dijit.MenuItem({label: 'hidden',
 onClick:function(){
 $('#' + actId).val('hidden');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'radio',
 onClick:function(){
 $('#' + actId).val('radio');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('array()');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'multiple',
 onClick:function(){
 $('#' + actId).val('multiple');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('array()');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'password',
 onClick:function(){
 $('#' + actId).val('password');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 pMenu.addChild(new dijit.MenuItem({label: 'file',
 onClick:function(){
 $('#' + actId).val('file');
 $('#' + actId).change($('#' + actId).get(0),input_domain_onChange);
 $('#' + actId).trigger('change');
 $('#' + actDomainValueFieldId).val('\'\'');
 $('#' + actDomainValueFieldId).change($('#' + actDomainValueFieldId).get(0),input_domain_value_onChange);
 $('#' + actDomainValueFieldId).trigger('change');
 }
 }));
 }
 pMenu.startup();
}

function setDomainValueMenu(actId)
{
 ajaxHandler.synServerCall('ajax_handler.php','getAllInterfacesOfPage',window.intPage,'xml',/CDATA/);
 var interfaces = ajaxHandler.getOpByName('getAllInterfacesOfPage').result;
 var j=0;
 var num = interfaces.length;
 var intList = 'sourceInt' + '=' + window.intName + '&';
 for(j=0;j<=num-1;j++)
  if(interfaces[j] != window.intName)
  intList = intList + 'int_' + j +  '=' + interfaces[j] + '&';
 ajaxHandler.synServerPostCall('ajax_handler.php','filterParentsInterfacesFiles','',intList,'xml',/CDATA/);
 interfaces = ajaxHandler.getOpByName('filterParentsInterfacesFiles').result;
// var domainValueId = actDomainValueFieldId; 
 var pMenuDomainValue = new dijit.Menu({targetNodeIds: [actId]});
 dojo.forEach(interfaces,function(interface,index)
 {
   pMenuDomainValue.addChild(new dijit.MenuItem({label: interface,
   onClick:function(){  
   $('#' + actId).val('\'' + interface + '\'');
   $('#' + actId).change($('#' + actId).get(0),input_domain_value_onChange);
   $('#' + actId).trigger('change'); 
  }
 }))
 }); 	
}

 function collectFieldsProps()
 {
 	var parentDocument = window.parent.document;
 	var postStr = '';
 	postStr = 'dataFields=' + encodeURIComponent($(parentDocument).find('#dataFields').val());
 	postStr = postStr + '&';
 	postStr = postStr + 'dataFieldsDomains=' + encodeURIComponent($(parentDocument).find('#dataFieldsDomains').val());
 	postStr = postStr + '&'; 	
 	postStr = postStr + 'dataFieldsDomainsValues=' + encodeURIComponent($(parentDocument).find('#dataFieldsDomainsValues').val());
 	return postStr;
 }

 function input_onChange(actObj)
 {
 	var inputFieldVal = util.ucFirst((actObj.value.toLowerCase()));
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',61));
 	 actObj.value = '';
   return false;
 	}
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 actObj.value = '';
 	 $(actObj).focus();
 	 return false;
  }
	var inputFieldVal = actObj.value;
	var inputId = actObj.id;
	var found=false;
 	$('.name').each(function(){if($(this).val()==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 actObj.value = '';
 	 return false;
  }
 }
 
 function button_1_onClick(actObj)
 {
 	var inputFieldVal = util.ucFirst(($('#input_name_id').val().toLowerCase()));
 	var inputFieldDomain = $('#input_domain_id').val();
 	var inputFieldDomainValue = $('#input_domain_value_id').val();
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',61));
   $('#input_name_id').val('');
   return false;
 	} 
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_name_id').val('');
 	 return false;
  }
 	var found=false;
 	$('#fields input').each(function(){if(util.ucFirst($(this).val().toLowerCase())==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 $('#input_name_id').val('');
 	 return false;
  }
  dndSource.insertNodes(false,[{fieldName:inputFieldVal,
  	fieldDomain:inputFieldDomain,fieldDomainValue:inputFieldDomainValue}]);
  dndSource.sync();

  var intObj = $(window.parent.document).find("#obj").val();
  var fields = getNodeFields(intObj);
  var num = $('#fields > tbody > tr').size()-1;
  var tableFieldNameId = "Name_id_" + num; 
  var tableFieldDomainId = "Domain_id_" + num;
  var tableFieldDomainValueId = "Domain_value_id_" + num;
  setFieldNameMenu(tableFieldNameId,
  tableFieldDomainId,tableFieldDomainValueId,fields);
  setDomainMenu(tableFieldDomainId,tableFieldDomainValueId);
  if(inputFieldDomain=='object')
   setDomainValueMenu(tableFieldDomainValueId);
  ajaxHandler.getOpByName('manageFieldsOp2').result=true;
  interfacesContainer.getInterface('Op6').putData();
 }
 

function input_domain_onChange(actObj)
{
 interfacesContainer.getInterface('Op6').putData();
} 

function input_domain_value_onChange(actObj)
{
 interfacesContainer.getInterface('Op6').putData();
} 
 
function input_field_onChange(actObj)
{
	var inputFieldVal = actObj.value;
	var inputId = actObj.id;
	var found=false;
 	$('.name').each(function(){
 		if(($(this).val()==inputFieldVal)&&(this.id!=actObj.id))found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 actObj.value='';
 	 return false;
  }
  interfacesContainer.getInterface('Op6').putData();
}