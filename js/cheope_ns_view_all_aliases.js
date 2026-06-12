 function input_onChange(actObj)
 {
 	var inputFieldVal = util.ucFirst((actObj.value.replace(/\s*/g,'').toLowerCase()));
 	if(inputFieldVal=='')
 	{
   actObj.value = $(actObj).data('alias_name');
   alert(loc.getString('msg',47));
   return false;
 	}  
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
   actObj.value = $(actObj).data('alias_name');
   $(actObj).focus();
 	 return false;
  }   
 	var found=false;
 	$('#aliases input').each(function(){if(($(this).val()==inputFieldVal)&&(this.id!=actObj.id))found=true});
 	if(found)
 	{
 	 actObj.value = $(actObj).data('alias_name');
 	 alert(loc.getString('msg',9));
 	 return false;
  }
  var ids = actObj.value;
 
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',ids,'text',/[.]*\w[.]*/);
  var typeText = ajaxHandler.getOpByName('getNodeType').result; 
  if(typeText=='Query')
  {
 	 alert(loc.getString('msg',53));
 	 actObj.value = $(actObj).data('alias_name');
 	 return false;
  }
  else if(typeText=='Alias')
  {
 	 alert(loc.getString('msg',54));
 	 actObj.value = $(actObj).data('alias_name');
 	 return false;
  }
  else if(typeText=='Table')
  {
 	 alert(loc.getString('msg',55));
 	 actObj.value = $(actObj).data('alias_name');
 	 return false;
  }
  else if(typeText=='Bind')
  {
 	 alert(loc.getString('msg',71));
 	 actObj.value = $(actObj).data('alias_name');
 	 return false;
  }  
  $(actObj).data('old_alias_name',$(actObj).data('alias_name'));
  $(actObj).data('alias_name',actObj.value);
 	return true;
 }
 
 function button_1_onClick(actObj)
 {
 	var inputFieldVal = util.ucFirst(($('#input_alias_id').val().replace(/\s*/g,'').toLowerCase()));
 	if(inputFieldVal=='')
 	{
   alert(loc.getString('msg',47));
   return false;
 	} 
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
   $('#input_alias_id').val('');
   $('#input_alias_id').focus();
 	 return false;
  }
 	var found=false;
 	$('#aliases input').each(function(){if($(this).val()==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 return false;
  }
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',inputFieldVal,'text',/[.]*\w[.]*/);
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
 }
 
 function button_2_onClick(actObj,actTablePos)
 {
 	var ids='';
  $('#aliases input').each(
  function(){
  	var alias=$(this).val();
  	if($(this).data('old_alias_name')!=$(this).data('alias_name'))
  	{
     ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',$(this).data('old_alias_name'),'text',/[.]*\w[\.]*/);
     if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
     {
 	  alert(loc.getString('msg',69));
      alias=$(this).data('old_alias_name');
      $(this).val(alias);	  
     }
	 else
	 {
  	  var idsAlias = $(this).data('old_alias_name') + ';' + $(this).data('alias_name');
  	  ajaxHandler.synServerCall('ajax_handler.php','renameAliasName',idsAlias,'text',/[0-9]/);
	 }
  	}
  	ids = ids + alias + ';'
  });
  ids = actTablePos + ';' + ids;
  ajaxHandler.synServerCall('ajax_handler.php','setAllAliases',ids,'text',/[0-9]/);
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text',/[0-9]/);  
 }
 
