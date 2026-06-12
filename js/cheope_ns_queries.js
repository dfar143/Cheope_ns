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
  //alert(ids);
  ajaxHandler.synServerPostCall('ajax_handler.php','setQuery','',ids,'text',/[0-9]*/);
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text',/[0-9]*/);
  window.location.reload();
 }
 else
 {alert(loc.getString('msg',24));return false;}
 alert(loc.getString('msg',91))
 return false;
}

function button_2_onClick(actObj)
{
	if($('select#Lista_queries option:selected').text().replace(/\s*/g,'')!='')
  {
	 var tablePos = $('select#Lista_queries option:selected').val();
	 subModal.showPopWin('execute_query.php?Par=' + tablePos,600,400,
	 function(actVar){},true);
  }
}

function form_inserimento_1_nuova_query_onChange(actObj)
{
 var newQuery = util.ucFirst($('#Nuova_query').get(0).value.replace(/\s*/g,'').toLowerCase());
 
 var oldQuery = $('select#Lista_queries option:selected').text();

 ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',oldQuery,'text',/[.]*\w[.]*/);
 if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
 	{
 	 alert(loc.getString('msg',70));
 	 return false;	
 	}
 
 var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
 if((newQuery.match(regExp)===null)&&(newQuery != ''))
 {
 	alert(loc.getString('msg',45));
 	$('#Nuova_query').get(0).value='';
 	return false;
 }
 
 if(newQuery !='')
 if((util.testTextInComboLabels('Lista_queries',newQuery))&&
 ($('#Lista_queries option:selected').text() != newQuery))
 {
 	alert(loc.getString('msg',9));
  $('#Nuova_query').get(0).value='';
  return false;	
 }
  
 ajaxHandler.synServerCall('ajax_handler.php','getNodeType',newQuery,'text',/[.]*\w[.]*/);
 var typeText = ajaxHandler.getOpByName('getNodeType').result; 
 if(typeText=='Alias')
 {
 	alert(loc.getString('msg',54));
 	$('#Nuova_query').get(0).value='';
 	return false;
 }
 else if(typeText=='Table')
 {
 	alert(loc.getString('msg',55));
 	$('#Nuova_query').get(0).value='';
 	return false;
 }
  else if(typeText=='Bind')
  {
 	 alert(loc.getString('msg',71));
 	 $('#Nuova_query').get(0).value = '';
 	 return false;
  } 
  
 $('select#Lista_queries option:selected').text($('#Nuova_query').get(0).value);
 $('#isDataSource').get(0).checked=false;
}

function form_inserimento_1_lista_queries_onChange(actObj)
{
 if($('select#Lista_queries option:selected').text().replace(/\s*/g,'')!='')
 {
 	$('#Nuova_query').val($('select#Lista_queries option:selected').text().replace(/\s*/g,''));
  var ids=$('select#Lista_queries option:selected').text() + ';' +
  $('select#Lista_queries option:selected').val();
 // var ids = $('select#Lista_queries option:selected').val();
  ajaxHandler.serverCall('ajax_handler.php','getQuery',ids,'xml',/CDATA/);
 }
}

function form_inserimento_1_isDataSource_onChange(actObj)
{
	if(actObj.checked)
	{
	 var queryStr = $('#Query_body').val();
	 ajaxHandler.synServerCall('ajax_handler.php','checkIfIsDataSourceQuery',queryStr,'text',/[.]*\w[.]*/);
	 if(ajaxHandler.getOpByName('checkIfIsDataSourceQuery').testResult=='false')
	 { 
	 	alert(loc.getString('msg',39));
	 	actObj.checked=false;
	 }
  }
}

function button_3_onClick(actObj)
{
  subModal.showPopWin('view_all_queries.php',600,400,function(actVar){window.location.reload()},true);
}

function button_1_onClick()
{
 display_exec_confirm_dialog();
}

function button_4_onClick(actObj)
{
 var nodeName = $('#Lista_queries option:selected').text();
 var popWinPage = 'view_all_bound_interfaces.php' + '?Node=' + nodeName;  
 subModal.showPopWin(popWinPage,600,400,function(actVar){},true);
}

function query_body_onChange()
{
	$('#isDataSource').get(0).checked=false;
}

function display_exec_confirm_dialog()
{
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:220,
      modal: true,
      buttons: {
        "Create queries structure file": function() {
 	       ajaxHandler.synServerCall('ajax_handler.php','createDbStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
          ajaxHandler.synServerCall('ajax_handler.php','createQueriesStruct','','text',/[.]*\w[.]*/);
        //  ajaxHandler.synServerCall('ajax_handler.php','createDbBinds','','text',/[.]*\w[.]*/);
		 ajaxHandler.synServerCall('ajax_handler.php','fixDbXmlFiles','','text',/[.]*\w[.]*/);
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