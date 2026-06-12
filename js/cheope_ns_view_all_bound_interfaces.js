function button_1_onClick()
{
	var postStr = 'setAllTo=' + 
	encodeURIComponent($('#html_tags__2 option:selected').text()) + '&';
	var interfacesStr='interfaces=';
	$('#html_tags__0  input').each(function(){
		interfacesStr += encodeURIComponent($(this).val()) + ';';
	});
  postStr = postStr + interfacesStr +  '&';
  var nodesStr = 'nodes=';
  $('#html_tags__0  select').each(function(){
  	nodesStr += encodeURIComponent($(this).val()) + ';';
  	});
  postStr = postStr + nodesStr;
  var subEvery = "&subEvery=" + $('#html_tag__1').get(0).checked;
  postStr = postStr + subEvery;
  var parsValues = util.getUrlArgsValues(window.location.search);
  var intr = parsValues[0];
  postStr  = postStr + "&oldNode=" + intr;
//  alert(postStr);
  ajaxHandler.synServerPostCall('ajax_handler.php',
  'setAllBoundInterfaces','',postStr,'text',/[.]*\w[.]*/);
  $('#html_tags__0').empty(); 
  ajaxHandler.synServerCall('ajax_handler.php','viewBoundInterfacesOp2',intr,'xml',/[.]*ind_records[.]*/);
  var interface = interfacesContainer.getInterface('viewBoundInterfacesOp1');
  interface.putData();
  var interface = interfacesContainer.getInterface('Op2');
  interface.putData();
  $('#html_tags__6').hide();
  alert(loc.getString('msg',91));
}

function select_table_id_onChange(actObj)
{
 var i=0;
 var found=false;
 var parsValues = util.getUrlArgsValues(window.location.search);
 var intr = parsValues[0]; 
 var thisSelectStr = $(actObj).val();
 var selectAllStr = $('#html_tags__2').val();
 $('#bound_interfaces_tbody_id input').each(function(){	
 if(! found)
 {
 var inputId = 'bound_interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId = 'table_id_' + (i++);
 var selectStr = $('#' +  selectId  + ' option:selected').text();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',inputVal,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr!=intr)||(selectAllStr!=intr))
 {
  var items = inputVal.split('!');
  if((items.length==6)&&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__6').show();
   found=true;
  }
  else
   $('#html_tags__6').hide();
 }
 else
 	$('#html_tags__6').hide();
 }});
}

function select_set_all_onChange(actObj)
{
 var i=0;
 var found=false;
 var parsValues = util.getUrlArgsValues(window.location.search);
 var intr = parsValues[0]; 
 var thisSelectStr = $(actObj).val();
 $('#bound_interfaces_tbody_id input').each(function()
 {	
 if(! found)
 {
 var inputId = 'bound_interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId = 'table_id_' + (i++);
 var selectStr = $('#' +  selectId  + ' option:selected').text();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',inputVal,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr!=intr)||(thisSelectStr!=intr))
 {
  var items = inputVal.split('!');
  if((items.length==6)&&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__6').show();
   found=true;
  }
  else
   $('#html_tags__6').hide();
  }
 else
 	$('#html_tags__6').hide();
 }
 }
 );
}

