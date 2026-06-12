function form_inserimento_1_available_dbs_onChange(actObj)
{
 var connectionPos = parseInt($('#Lista_connections option:selected').val())+1;
 var numConnections = $('#Lista_connections option').size();
 var dbName = $('#Available_dbs option:selected').text().replace(/\s*/g,'');
 if(dbName != '')
 if(connectionPos==numConnections)
 {
   $('#html_tags__0').hide();
 	 $('#container').remove();
   $('#html_tags__0').after('<div id="container"></div>');
   var id = $("#" + actObj.id + " option:selected").text();
   //alert(id);
   ajaxHandler.serverCall('ajax_handler.php','getDbOpPars',id,'xml',/CDATA/); 	
 }
 else
 {
  var num = actObj.value;
  if(num>0)
  {
   $('#html_tags__0').hide();
   $('#html_tags__0').after('<div id="container"></div>');
   var id = $("#" + actObj.id + " option:selected").text();
   //alert(id);
   ajaxHandler.serverCall('ajax_handler.php','getDbOpPars',id,'xml',/CDATA/);
  }
  else
  {
 	 $('#container').remove();
 	 $('#html_tags__0').show();
  }
 }
}

function getConnection(actId)
{
$('#container').remove();
 $('#html_tags__0 label').remove();
 $('#html_tags__0 input').remove();
 $('#html_tags__0 textarea').remove();
 $('#html_tags__0 br').remove(); 
 ajaxHandler.serverCall('ajax_handler.php','getConnection',actId,'xml',/CDATA/);
}

function form_inserimento_1_lista_connections_onChange(actObj)
{
 var id = $('#Lista_connections option:selected').val();
 getConnection(id);
}

function form_inserimento_1_submit_button_onClick()
{
 var num1 = $('select#Lista_connections option').size();
 var num2 = $('select#Lista_connections option:selected').val();
 if(($('select#Lista_connections option:selected').text().replace(/\s*/g,'')!='')
 ||(($('select#Lista_connections option:selected').text().replace(/\s*/g,'')=='')&&(num2<num1-1)))
 {
 	var ids = 'connectionName' + '=' +
  encodeURIComponent($('select#Lista_connections option:selected').text()) +
  '&' + 'connectionPos' + '=' +
  $('select#Lista_connections option:selected').val() +  
  '&' + 'availableDb' + '=' +
  encodeURIComponent($('select#Available_dbs option:selected').text()) + '&';
  //alert($('#html_tags__0').css('display'));
  if($('#html_tags__0').css('display').replace(/\s*/g,'')=='none')
   $('#container').children(':input').each(function()
   {
   	ids = ids + this.name + '=' + 
   	encodeURIComponent($(this).val()) + '&';
   });
  else
   $('#html_tags__0').children(':input').each(function()
   {
   	ids = ids + this.name + '=' + 
   	encodeURIComponent($(this).val()) + '&';
   });
  if(ids!='')
  {
   ids = ids.substr(0,ids.length-1);
  }
  ajaxHandler.synServerPostCall('ajax_handler.php','setConnection','',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 // return false;
  window.location.reload();
   alert(loc.getString('msg',91));
 }	
 else
 {alert(loc.getString('msg',46));return false;}
 return false;
}

function form_inserimento_1_nuova_connection_onChange(actObj)
{
 var newConnection = util.ucFirst(actObj.value.replace(/\s*/g,'').toLowerCase());
 var oldConnection = $('#Lista_connections option:selected').text();
 var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
 if((newConnection.match(regExp)===null)&&(newConnection !=''))
  {
 	 alert(loc.getString('msg',45));
 	 actObj.value='';
 	 return false;
  }
 	ajaxHandler.synServerCall('ajax_handler.php','checkIfConnectionIsUsed',oldConnection,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	if(ajaxHandler.getOpByName('checkIfConnectionIsUsed').testResult=='true')
 	{
 	 alert(loc.getString('msg',73));
 	 return false;	
 	}
 if(newConnection !='')
 if((util.testTextInComboLabels('Lista_connections',newConnection))&&
 ($('#Lista_connections option:selected').text() != newConnection))
 {
 	alert(loc.getString('msg',9));
  actObj.value='';
  return false;	
 }
 $('select#Lista_connections option:selected').text(actObj.value);
}

function button_1_onClick()
{
 display_exec_confirm_dialog();
}

function button_2_onClick()
{
 subModal.showPopWin('view_all_connections.php',500,400,
 function(actVar)
 {
 	if(actVar==undefined)
 	 actVar=0;
 	$('select#Lista_connections option').get(actVar).selected=true;
 	getConnection(actVar);
 },true);
}

function display_exec_confirm_dialog()
{
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:220,
      modal: true,
      buttons: {
        "Create connections structure file": function() {
		 ajaxHandler.synServerCall('ajax_handler.php','createDbStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
		 ajaxHandler.synServerCall('ajax_handler.php','createQueriesStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
         ajaxHandler.synServerCall('ajax_handler.php','createConnectionsStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
        // ajaxHandler.synServerCall('ajax_handler.php','createDbBinds','','text',/[\s\._\:A-Za-z0-9;\-]*/);
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