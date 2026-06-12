
function input_bind_name_onChange(actObj)
{
 var oldName = $(actObj).data('oldName');
 ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',oldName,'text');
 if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
 	{
 	 alert(loc.getString('msg',72));
 	 $(actObj).val(oldName);
 	 return false;	
 	}
}

function button_1_onClick()
{
 	var inputFieldVal = $('#select_node_id option:selected').text();
 	var inputConnName = $('#select_connection_id option:selected').text();
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
 		alert(loc.getString('msg',50));
 		return false;
 	}
 	if(inputConnName.replace(/\s*/g,'')=='')
 	{
 		alert(loc.getString('msg',52));
 		return false;
 	} 	
 	var found=false;
 	$('#tables_and_queries span').each(function(){if($(this).text()==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',51));
 	 return false;
  }	
  var ids = inputFieldVal;
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	var typeText = ajaxHandler.getOpByName('getNodeType').result; 
  dndSource.insertNodes(false,[{fieldName:inputFieldVal,
  	fieldType:typeText,connectionName:inputConnName}]);
  dndSource.sync();
  var num = $('#tables_and_queries > tbody > tr').size()-1;
  var select = $('#connections_id_' + num).get(0);
  $('#select_connection_id option').each(function(){var option = document.createElement('option');
  	var optionText = $(this).text();option.innerHTML=optionText;
  	if(this.selected)option.selected=true;select.appendChild(option);});
  alert(loc.getString('msg',91));
  
}

function button_2_onClick()
{
 var ids = '';
 var num = $('#tables_and_queries > tbody > tr').size();
 var i=0;
 if(num>0)
 {
 	var node = $('#tables_and_queries_id_' + i).text();
 	var type = $('#type_id_' + i).text();
 	var conn = $('#connections_id_' + i + ' option:selected').text();
  ids = node + ':' + type + ':' + conn;
  for(i=1;i<=num-1;i++)
  {
 	 var node = $('#tables_and_queries_id_' + i).text();
 	 var type = $('#type_id_' + i).text();
 	 var conn = $('#connections_id_' + i + ' option:selected').text();
 	 ids = ids + ';' + node + ':' + type + ':' + conn;
  }
 }
 else
 	ids = '';
 ajaxHandler.serverCall('ajax_handler.php','setAllTablesAndQueriesBinds',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  alert(loc.getString('msg',91));
}


function button_3_onClick()
{
 display_exec_confirm_dialog();
}

function button_4_onClick()
{
 	var inputNomeBind = $('#nome_bind').val();
 	var selectNodeName = $('#bind_select_node_id option:selected').text();
  var selectConnectionName = $('#bind_select_connection_id option:selected').text(); 	

 	if((inputNomeBind.replace(/\s*/g,'')=='')||(selectNodeName.replace(/\s*/g,'')==''))
 	{
 		alert(loc.getString('msg',67));
 		return false;
 	}
  ajaxHandler.synServerCall('ajax_handler.php','getNodeType',inputNomeBind,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  var typeText = ajaxHandler.getOpByName('getNodeType').result; 
  if(typeText=='Query')
  {
 	 alert(loc.getString('msg',53));
 	// $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Alias')
  {
 	 alert(loc.getString('msg',54));
 	// $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Table')
  {
 	 alert(loc.getString('msg',55));
 	// $('#input_alias_id').val('');
 	 return false;
  }
  else if(typeText=='Bind')
  {
 	 alert(loc.getString('msg',71));
 	// $('#input_alias_id').get(0).value = $('#input_alias_id').data('alias_name');
 	 return false;
  } 

 	if(selectNodeName.replace(/\s*/g,'')=='')
 	{
 		alert(loc.getString('msg',50));
 		return false;
 	} 	
 	if(selectConnectionName.replace(/\s*/g,'')=='')
 	{
 		alert(loc.getString('msg',52));
 		return false;
 	}
 	var found=false;
 	$('#binds input').each(function(){
 		if($(this).get(0).id.indexOf('bind_name')!=-1)
 		 if($(this).val()==inputNomeBind)found=true;
  });
 	if(found)
 	{
 	 alert(loc.getString('msg',68));
 	 return false;
  }	
  bind_dndSource.insertNodes(false,[{fieldBindName:inputNomeBind}]);
  bind_dndSource.sync();
  var num = $('#binds > tbody > tr').size()-1;
  var select1 = $('#bind_node_id_' + num).get(0);
  $('#bind_select_node_id option').each(function(){var option = document.createElement('option');
  	var optionText = $(this).text();option.innerHTML=optionText;
  	if(this.selected)option.selected=true;select1.appendChild(option);});
  var select2 = $('#bind_connection_id_' + num).get(0);
  $('#bind_select_connection_id option').each(function(){var option = document.createElement('option');
  	var optionText = $(this).text();option.innerHTML=optionText;
  	if(this.selected)option.selected=true;select2.appendChild(option);});
}

function button_5_onClick()
{
 var ids = '';
 var num = $('#binds > tbody > tr').size();
 var i=0;
 if(num>0)
 {
 	var bindName = $('#bind_name_id_' + i).val();
 	var bindNode = $('#bind_node_id_' + i + ' option:selected').text()
 	var bindConn = $('#bind_connection_id_' + i + ' option:selected').text();
  ids = bindName + ':' + bindNode + ':' + bindConn;
  for(i=1;i<=num-1;i++)
  {
 	var bindName = $('#bind_name_id_' + i).val();
 	var bindNode = $('#bind_node_id_' + i + ' option:selected').text()
 	var bindConn = $('#bind_connection_id_' + i + ' option:selected').text();
 	 ids = ids + ';' + bindName + ':' + bindNode + ':' + bindConn;
  }
 }
 else
 {
 	ids = '';
 }
 ajaxHandler.serverCall('ajax_handler.php','setAllBinds',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
   alert(loc.getString('msg',91));
}

function display_exec_confirm_dialog()
{
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        "Create dbBinds file": function() {        	
 	       ajaxHandler.synServerCall('ajax_handler.php','createDbStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
 	       ajaxHandler.synServerCall('ajax_handler.php','createQueriesStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
         ajaxHandler.synServerCall('ajax_handler.php','createConnectionsStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
         ajaxHandler.synServerCall('ajax_handler.php','createDbBinds','','text',/[\s\._\:A-Za-z0-9;\-]*/);
		 ajaxHandler.synServerCall('ajax_handler.php','fixDbXmlFiles','','text',/[\s\._\:A-Za-z0-9;\-]*/);
		 window.location.reload();
         $( this ).dialog( "close" );
         },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}

function button_6_onClick(actObj)
{
 var i=0;
 var nodeName='';

 $('#bind_tbody_id input[type=radio]').each(function()
 {
 	if(this.checked) nodeName=$('#bind_name_id_' + i).val();
 	i++;
 });	
 if(nodeName!='')
 {
  popWinPage = 'view_all_bound_interfaces.php' + '?Node=' + nodeName;  
  subModal.showPopWin(popWinPage,600,400,function(actVar){},true);
 }
 else
   alert(loc.getString('msg',75)); 	
}