function form_inserimento_1_submit_button_onClick()
{
 var num1 = $('select#Lista_queries option').size();
 var num2 = $('select#Lista_queries option:selected').val();
 if(($('select#Lista_queries option:selected').text().replace(/\s*/g,'')!='')
 ||(($('select#Lista_queries option:selected').text().replace(/\s*/g,'')=='')&&(num2<num1-1)))
 {
  var ids = 'queryName' + '=' 
  + encodeURIComponent($('select#Lista_queries option:selected').text()) 
  + '&' 
  + 'queryPos' + '='  + $('select#Lista_queries option:selected').val() + '&'
  + 'queryBody' + '=' + encodeURIComponent($('textarea#Query_body').val()) + '&';
  var isDataSource = $('#isDataSource').get(0).checked;
  if(isDataSource)
   ids = ids + 'dataSource' + '=' + 'true';
  else
  	ids = ids + 'dataSource' + '=' + 'false';
  ajaxHandler.synServerPostCall('ajax_handler.php','setQuery','',ids,'text');
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text');
  window.location.reload();
 }
 else
 {alert(loc.getString('msg',24));return false;}
 return false;
}


function form_inserimento_1_nuova_query_onChange(actObj)
{
 var newQuery = util.ucFirst(actObj.value.replace(/\s*/g,'').toLowerCase());
 var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(newQuery.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 actObj.value='';
 	 return false;
  }
 if(newQuery !='')
 if((util.testTextInComboLabels('Lista_queries',newQuery))&&
 ($('#Lista_queries option:selected').text() != newQuery))
 {
 	alert(loc.getString('msg',9));
  actObj.value='';
  return false;	
 }
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',newQuery,'text');
  var typeText = ajaxHandler.getOpByName('getNodeType').result; 
  if(typeText=='Alias')
  {
 	 alert(loc.getString('msg',54));
 	 actObj.value='';
 	 return false;
  }
  else if(typeText=='Table')
  {
 	 alert(loc.getString('msg',55));
 	 actObj.value='';
 	 return false;
  }
 $('select#Lista_queries option:selected').text(actObj.value);
 $('#isDataSource').get(0).checked=false;
}

function form_inserimento_1_lista_queries_onChange(actObj)
{
 if($('select#Lista_queries option:selected').text().replace(/\s*/g,'')!='')
 {
 	$('#Nuova_query').val($('select#Lista_queries option:selected').text().replace(/\s*/g,''));
  var ids=$('select#Lista_queries option:selected').text() + ';' +
  $('select#Lista_queries option:selected').val();
  ajaxHandler.serverCall('ajax_handler.php','getQuery',ids,'xml');
 }
}

function form_inserimento_1_isDataSource_onChange(actObj)
{
	if(actObj.checked)
	{
	 var queryStr = $('#Query_body').val();
	 ajaxHandler.synServerCall('ajax_handler.php','checkIfIsDataSourceQuery',queryStr,'text');
	 if(ajaxHandler.getOpByName('checkIfIsDataSourceQuery').testResult=='false')
	 { 
	 	alert(loc.getString('msg',39));
	 	actObj.checked=false;
	 }
  }
}

function query_body_onChange()
{
	$('#isDataSource').get(0).checked=false;
}