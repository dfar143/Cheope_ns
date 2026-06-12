 function input_onChange(actObj)
 {
 	var inputFieldVal = util.ucFirst((actObj.value.toLowerCase()));
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',61));
 	 actObj.value = $(actObj).data('table_name');
   return false;
 	}
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 actObj.value = $(actObj).data('table_name');
 	 $(actObj).focus();
 	 return false;
  }
 	var found=false;
 	$('#tables input').each(function(){if(($(this).val()==inputFieldVal)&&(this.id!=actObj.id))found=true});
 	if(found)
 	{
 	 actObj.value = $(actObj).data('table_name');
 	 alert(loc.getString('msg',9));
 	 return false;
  } 
  var ids = actObj.value;
  ajaxHandler.synServerCall('ajax_handler.php','checkIfAliasExists',ids,'text',/(\.)*[\w](\.)*/);
 	if(ajaxHandler.getOpByName('checkIfAliasExists').testResult=='true')
 	{
 		alert(loc.getString('msg',48));
 		actObj.value = $(actObj).data("table_name");
 		return false;
 	}
 	$(actObj).data('new_table_name',actObj.value);
 }
 
 function button_1_onClick(actObj)
 {
 	var inputFieldVal = util.ucFirst(($('#input_table_id').val().toLowerCase()));
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',61));
   $('#input_table_id').val('');
   return false;
 	} 
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_table_id').val('');
 	 return false;
  }
 	var found=false;
 	$('#tables input').each(function(){if($(this).val()==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 $('#input_table_id').val('');
 	 return false;
  }
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',inputFieldVal,'text',/(\.)*[\w](\.)*/);
  var typeText = ajaxHandler.getOpByName('getNodeType').result; 
  if(typeText=='Query')
  {
 	 alert(loc.getString('msg',53));
 	 $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Alias')
  {
 	 alert(loc.getString('msg',54));
 	 $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Table')
  {
 	 alert(loc.getString('msg',55));
 	 $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Bind')
  {
 	 alert(loc.getString('msg',71));
 	 actObj.value = $(actObj).data('alias_name');
 	 return false;
  } 
  dndSource.insertNodes(false,[{fieldName:inputFieldVal}]);
  dndSource.sync();
  var num = $('#fields_table > tbody > tr').size()-1;
  var currentTypeId = 'Type_id_' + num;
  var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]});
  pMenu.addChild(new dijit.MenuItem({label: 'BIG_STRING',
  onClick:function(){$('#' + currentTypeId).text('BIG_STRING');}})); 
  pMenu.addChild(new dijit.MenuItem({label: 'BOOLEAN',
  onClick:function(){$('#' + currentTypeId).text('BOOLEAN');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'DATE',
  onClick:function(){$('#' + currentTypeId).text('DATE');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'FLOAT',
  onClick:function(){$('#' + currentTypeId).text('FLOAT');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'INTEGER',
  onClick:function(){$('#' + currentTypeId).text('INTEGER');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'STRING',
  onClick:function(){$('#' + currentTypeId).text('STRING');}}));
  pMenu.startup(); 
 }
 
/* function img_close_onClick(actObj)
 {
  var imgId = actObj.id;
  var idItems = actObj.id.split('_');
  var imgIdNum = idItems[2];
  var inputObjId = "#Name_id_" + imgIdNum;
  var inputObj = $(inputObjId);
  var oldTab = inputObj.val();
  
//  var oldTab = $('select#Lista_tabelle option:selected').text();
 
 var ids = oldTab;
 ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',ids,'text');
 if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
 {
 	alert(loc.getString('msg',69));
 	return false;	
 }
 
 if(selTab=='')
 {
 	ajaxHandler.synServerCall('ajax_handler.php','checkIfIsInRelation',oldTab,'text');
 	if(ajaxHandler.getOpByName('checkIfIsInRelation').testResult=='true')
 	{
 		alert(loc.getString('msg',20));
 		$('select#Lista_tabelle option:selected').text(oldTab);
 		return false;
 	}
 }
 }*/
 
 function button_2_onClick(actObj)
 {
 	var ids='';
  $('#tables input').each(function(){var oldName=$(this).data('table_name');
 	var newName=$(this).data('new_table_name');
 	if((oldName!==undefined) && (newName!='') &&(oldName!='') &&(newName!=oldName)){var ids = oldName + ';' + newName;
 	ajaxHandler.synServerCall('ajax_handler.php','renameAllItems',ids,'text',/(\.)*[\w](\.)*/);
 	$(this).data('table_name',newName);$(this).data('new_table_name','')}}); 	
  $('#tables input').each(function(){var table=$(this).val();
  	ids = ids + table + ';'});
	//alert(ids);
  /*var buffer_1 = $('#buffer_deleted_tables').data('buffer');
  var num = buffer_1.length;
  for(i=0;i<=num-1;i++)
  {
    var ids = buffer_1[i];
    ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',ids,'text');
	//console.log(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult);
	//return false;
    if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
    {
 	 alert(loc.getString('msg',69));
 	 return false;	
    }
 	  
	ajaxHandler.synServerCall('ajax_handler.php','checkIfIsInRelation',ids,'text');
 	if(ajaxHandler.getOpByName('checkIfIsInRelation').testResult=='true')
 	{
     alert(loc.getString('msg',20));
 	// $('select#Lista_tabelle option:selected').text(ids);
 	 return false;
 	} 
	if(i==0)
	 deleted_tables = buffer_1[i];
	else
	deleted_tables += ';' + buffer_1[i];
  }
  //console.log(deleted_tables);*/
  ajaxHandler.synServerCall('ajax_handler.php','setDbObjsDefProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text',/[\s\._\:A-Za-z0-9;\-]*/);
  ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefAllFieldsProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  alert(loc.getString('msg',91));  
 // ajaxHandler.synServerCall('ajax_handler.php','deleteRelationsDefs',deleted_tables,'text');
 }