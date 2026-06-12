 
 function button_1_onClick(actObj)
 {
 	var inputFieldVal = $('#input_query_name_id').val().replace(/\s*/g,'');
 	var textareaFieldVal = $('#input_query_body_id').val();
  
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',inputFieldVal,'text',/(\.)*\w(\.)*/);
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

 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',40));
   $('#input_query_name_id').val('');
   return false;
 	}
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_query_name_id').val('');
 	 $('#input_query_name_id').focus();
 	 return false;
  }
 	if(textareaFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',41));
   $('#input_query_body_id').val('');
   return false;
 	}
 	var checkBoxIsDataSource = $('#checkBox_id').get(0).checked;

   dndSource.insertNodes(false,[{queryName:inputFieldVal,
   queryBody:textareaFieldVal,isDataSource:checkBoxIsDataSource}]);
   dndSource.sync();
 }
 
 function button_2_onClick(actObj)
 { 	
 	var ids='';
 	var inputValCont = Array();
 	$('#tables input:text').each(function()
 	{
 		var value = this.value;
 		if(value.replace(/\s*/g,'') != '')
 		{
 		 if(! util.in_array(value,inputValCont))
 		  inputValCont.push(value);
 		 else
 		 {
 		  alert(loc.getString('msg',43));
 		  return false;
 		 }
 		}
 		else
		{
 		 alert(loc.getString('msg',40));
 		 return false;
 		} 			
 	});
 	$('#tables textarea').each(function()
 	{
 		var value = $(this).val();
 		if(value.replace(/\s*/g,'')=='')
 		{
 		 alert(loc.getString('msg',41));
 		 return false;
 		} 
 	});
  var num1=0;
  $('#tables input:text').each(function()
  {var items = this.id.split('_');
  var num = items[items.length-1];
  var queryName = this.value;
  var queryBody = $('#Query_body_id_'+num).val();
  var dataSource = ($('#DataSource_id_'+num).get(0).checked)?('true'):('false');
  ids = ids + 'queryName_' + num1 + '=' + queryName + '&' + 
  'queryBody_' + num1 + '=' + queryBody + '&' + 
  'dataSource_' + num1 + '=' + dataSource + '&';
   num1++;
  }); 	
  if(ids!='')
  {
   ids = ids.substr(0,ids.length-1);
  }
  //alert(ids);
  ajaxHandler.synServerPostCall('ajax_handler.php','setAllQueries','',ids,'text',/(\.)*\w(\.)*/);
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text',/(\.)*\w(\.)*/);
  alert(loc.getString('msg',91));
 }
 
 function dataSource_onClick(actObj)
 {	
  var strItems = actObj.id.split("_");
  var num = strItems[strItems.length-1];
 	if(actObj.checked)
	{
	 var queryStr = $('#Query_body_id_' + num).val();
	 if(queryStr.replace(/\s*/g,'') != '')
	 {
	  ajaxHandler.synServerCall('ajax_handler.php','checkIfIsDataSourceQuery',queryStr,'text',/(\.)*\w(\.)*/);
	  if(ajaxHandler.getOpByName('checkIfIsDataSourceQuery').testResult=='false')
	  { 
	 	 alert(loc.getString('msg',39));
	 	 actObj.checked=false;
	  }
	 }
   else
   {
 	  alert(loc.getString('msg',41));
	  actObj.checked=false;
   }	
  }
 } 

 function checkBox_id_onClick(actObj)
 {
  if(actObj.checked)
  {
	 var queryStr = $('#input_query_body_id').val();
	 if(queryStr.replace(/\s*/g,'') != '')
	 {
	  ajaxHandler.synServerCall('ajax_handler.php','checkIfIsDataSourceQuery',queryStr,'text',/(\.)*\w(\.)*/);
	  if(ajaxHandler.getOpByName('checkIfIsDataSourceQuery').testResult=='false')
	  { 
	 	 alert(loc.getString('msg',39));
	 	 actObj.checked=false;
	  }
   }
   else
   {
 	  alert(loc.getString('msg',41));
	  actObj.checked=false;
   } 	
  }
 }
 
 function query_body_id_onChange(actObj)
{
  var strItems = actObj.id.split("_");
  var num = strItems[strItems.length-1];
	$('#DataSource_id_' + num).get(0).checked=false;
}

function input_query_body_id_onChange()
{
	$('#checkBox_id').get(0).checked=false;
}