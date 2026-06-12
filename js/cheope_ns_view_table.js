function renumItemsIndexes(actDivContainer)
{
 var divContainerChilds = actDivContainer.children();
 var divContainerChildsNum = divContainerChilds.size();
 for(var i=0;i<=divContainerChildsNum-2;i++)
 {
 	var j=i+1;
 	var divContainerChild = divContainerChilds.eq(j);

 	var divContainerChildId = divContainerChild.attr('id');
 	divContainerChildIdSuffix = util.extractSuffixFromString(divContainerChildId,'_');
 	divContainerChildId1 = i;
 	divContainerChild.attr('id',divContainerChildIdSuffix + '_' + divContainerChildId1);
 	   	 
 	var divContainerChild0 = divContainerChild.children().eq(0);
 	var divContainerChild2 = divContainerChild.children().eq(2);
 	var divContainerChild3 = divContainerChild.children().eq(3);
 	 	
 	var divContainerChild0Id = divContainerChild0.attr('id');
 	divContainerChild0IdSuffix = util.extractSuffixFromString(divContainerChild0Id,'_');
 	divContainerChild0Id1 = i;
 	divContainerChild0.attr('id',divContainerChild0IdSuffix + '_' + divContainerChild0Id1); 
 	var divContainerChild2Id = divContainerChild2.attr('id');
 	divContainerChild2IdSuffix = util.extractSuffixFromString(divContainerChild2Id,'_');
 	divContainerChild2Id1 = i;
 	divContainerChild2.attr('id',divContainerChild2IdSuffix + '_' + divContainerChild2Id1);
 	var divContainerChild3Id = divContainerChild3.attr('id');
 	divContainerChild3IdSuffix = util.extractSuffixFromString(divContainerChild3Id,'_');
 	divContainerChild3Id1 = i;
 	divContainerChild3.attr('id',divContainerChild3IdSuffix + '_' + divContainerChild3Id1);
 }
}

function select_lista_nuovi_campi_onChange(actObj)
{
 var parentObj = $(actObj).parent().get(0);
 var index=util.extractLastItemFromString(parentObj.id,'_');
 var item1=$('#html_tags__1_lista_nuovi_campi_' + index  +  
 ' option:selected').text();
 var item2=$('#html_tags__1_lista_campi_' + index +  
 ' option:selected').text();
 if(((! util.testTextInComboLabels('html_tags__1_lista_campi_' + index,item1))||(item1=='')))
 {
 	$('#html_tags__1_lista_campi_' + index +  
  ' option:selected').text(item1);
  if((item2=="")&&(item1!=""))  
  {
   $('#html_tags__1_lista_campi_' + index).append('<option></option>');
  }
 }
 else 
 	alert(loc.getString("msg",9));
}

function insertHtmlTags1NewGroup()
{
  var divChilds = $('#html_tags__1 > div');
  var ct = divChilds.size()-1;
  if(ct<=3)
  {
  $('#html_tags__1').append('<div id="html_tags__1_group_' + ct + '"></div>');
  $('#html_tags__1_group_' + ct).append('<select id="html_tags__1_lista_nuovi_campi_' + ct 
  + '" onchange="select_lista_nuovi_campi_onChange(this);"></select>');
  $('select#Lista_campi option').each(
  function(){$('#html_tags__1_lista_nuovi_campi_' + ct).append('<option>' + this.text + '</option>');}
  );
  $('#html_tags__1_group_' + ct).append('&nbsp;<a href="#"  style="text-decoration:none;" ' +
  'onclick="select_lista_nuovi_campi_onChange(this);return false;">-></a>&nbsp;<select id="html_tags__1_lista_campi_' + 
  ct + '"><option></option></select>&nbsp;&nbsp;&nbsp;' +
 '<button id="html_tags__1_button_' + ct + 
 '" onclick="$(this).parent().remove();renumItemsIndexes($(\'#html_tags__1\'));">' + loc.getString('label','Cancella_chiave')+ '</button><br/><br/>');
 }
 else
 	alert(loc.getString('msg',8));
}

function insertHtmlTags2NewGroup()
{
  var divChilds = $('#html_tags__2 > div');
  $('#html_tags__2').append('<div id="html_tags__2_group_0"></div>');
  $('#html_tags__2_group_0').append('<select id="html_tags__2_lista_nuove_tabelle_0' +  
  '" onchange="form_inserimento_4_lista_nuove_tabelle_onChange()"></select>');
  var ct2 =0;
  $('select#Lista_tabelle option').each(function(){if(this.value != $('#Lista_tabelle option:selected').val())
  $('#html_tags__2_lista_nuove_tabelle_0').append('<option value="' + this.value + '">' + this.text + '</option>');});
  $('#html_tags__2_group_0').append('&nbsp;<a href="#" style="text-decoration:none;" onclick="form_inserimento_4_lista_nuove_tabelle_onChange();return false;">-></a>&nbsp;<select id="html_tags__2_lista_tabelle_0' + 
  '"></select>&nbsp;&nbsp;<span>Key:</span>&nbsp;<input type="text" size="10" id="external_key"></input>');
  $('#external_key').bind('change',function(){
  	var found=false;
  	var keyField=this;
  	var keyVal = $(keyField).val().replace(/\s*/g,'');
    var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
    if((keyVal.match(regExp)===null)&&(keyVal!=''))
    {
 	   alert(loc.getString('msg',45));
     keyField.value='';
 	   return false;
    }
  	$('#html_tags__2_lista_tabelle_0 option').each(
  	function()
  	{
  	 if(($(this).data('keyField')==keyVal)&&
  	 (this != $('#html_tags__2_lista_tabelle_0 option:selected').get(0)))
  	  found=true;	
  	});
  	if(! found)
  	$('#Lista_campi option').each(
  	function()
  	{
  	 if(($(this).text()==keyVal)&&($(this).text()!=''))
  	  found=true;	
  	});
  	if(found)
  	{
  		alert(loc.getString('msg',9));
  		$(this).val('');
  		return false;
  	}
  	if($('#html_tags__2_lista_tabelle_0 option:selected').text()!='')
  	$('#html_tags__2_lista_tabelle_0 option:selected').data('keyField',keyVal.replace(/\s*/g,''));
  	});
  $('#html_tags__2_lista_tabelle_0').bind('change',function()
  {
  	$('#external_key').val($('#html_tags__2_lista_tabelle_0 option:selected').data('keyField'));
  });
}


function form_inserimento_1_lista_tabelle_onChange()
{
 var tabId = $('select#Lista_tabelle option:selected').val();
 var ids=tabId;
 ajaxHandler.synServerCall('ajax_handler.php','getAllFieldsDefProps',ids,'xml',/CDATA/);
 ajaxHandler.serverCall('ajax_handler.php','getPkKeyField',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
}

function form_inserimento_1_submit_button_onClick()
{
 if($('select#Lista_tabelle option:selected').text().replace(/\s*/g,'')!='')
 {
 	$('#form__2_submit_button_id').get(0).onclick();
 	$('#form__4_submit_button_id').get(0).onclick();
  $('#form__3_submit_button_id').get(0).onclick();
  return false;
 }
 else
 {
 	alert(loc.getString('msg',11));
 	return false;
 }
}

function form_inserimento_1_reset_button_onClick()
{
	window.location.reload();
}

function form_inserimento_2_nuovo_campo_onChange(actObj)
{
 var item1=$('select#Lista_campi option:selected').text();
 var item2=actObj.value.replace(/\s*/g,'');
 if((item2=='')&&($('select#Lista_campi').data('pk')==item1))
 {
 	alert(loc.getString('msg',35));
 	actObj.value='';
 	return false;
 }
 var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
 if((item2.match(regExp)===null)&&(item2!=''))
 {
 	alert(loc.getString('msg',45));
  actObj.value='';
 	return false;
 }
 if((util.testTextInComboLabels('Lista_campi',item2))&&
 (item1 != item2) && (item2 != ''))
 {
 	alert(loc.getString('msg',9));
 	$actObj.value='';
 	return false;
 }
 var ids = $('select#Lista_tabelle option:selected').val() + ';' + actObj.value;
 ajaxHandler.synServerCall('ajax_handler.php','checkIfIsSuitableField',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/); 
 if(ajaxHandler.getOpByName('checkIfIsSuitableField').testResult == 'true')
 {
 	if(item1==$('select#Lista_campi').data('pk'))
 	 $('select#Lista_campi').data('pk',item2);
  $('select#Lista_campi option:selected').text(item2);
  var lista_campi = $('select#Lista_campi').get(0);
  $(lista_campi).next().remove();
  if(item2=='')
  {
   $('select#Lista_campi option:selected').data('tipo','undefined');
   $(lista_campi).after('&nbsp;<span id=\'tipo_campo_id\'>' + 
   'undefined'+ '</span>');
  }
  else
  {
   $('select#Lista_campi option:selected').data('tipo','STRING');
   $(lista_campi).after('&nbsp;<span id=\'tipo_campo_id\'>' + 
   'STRING'+ '</span>');
  }	
  if((item1=='')&&(item2!=''))
  {
 	 $('select#Lista_campi').append('<option></option>')
  }
 }
 else
 	alert(loc.getString('msg',32));
}

function form_inserimento_2_reset_button_onClick()
{
 var tabId = $('#Lista_tabelle option:selected').val();
 var ids = tabId;	
 if($('select#Lista_tabelle option:selected').text().replace(/\s*/g,'')!='')
 {
  ajaxHandler.synServerCall('ajax_handler.php','getFieldsDefProps',ids,'xml',/CDATA/);
  ajaxHandler.serverCall('ajax_handler.php','getPkKeyField',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 }
 else
 	 alert(loc.getString('msg',11));
  alert(loc.getString('msg',91));
 return false;
}

function form_inserimento_2_submit_button_onClick()
{
 var tab = $('#Lista_tabelle option:selected').val();
 var ids = tab;
 var ids2 = tab;
 var fieldsNum = $('select#Lista_campi option').size();
 if($('select#Lista_tabelle option:selected').text()=='')
 {
 	alert(loc.getString('msg',11));
  return false;
 }
 
 if($('select#Lista_campi').data('pk') == '')
 {
  alert(loc.getString('msg',34));
  return false;
 } 	
 	
 for(var i=0;i<=fieldsNum-2;i++)
 {
  var field=$('#Lista_campi :eq(' + i  + ')').text();
  if(field != '')
  {
   var tipo = $('#Lista_campi :eq(' + i  + ')').data('tipo').toUpperCase();
   ids = ids + ';' + field + ';' + tipo;
   ids2 = ids2 + ';' + field;
  }
 }
 
 var selectCtrl = $('#html_tags__2_lista_tabelle_0 option');
 selectCtrl.each(function()
 {
 	var field = $(this).data('keyField');
 	if(($(this).text()!='') && (! (field=='')))
 	{ 
 		ids2 = ids2 + ';' + field;
  }
 });
 
 //alert(ids);
 var ids1 = $('#Lista_tabelle option:selected').val() + ';' + $('select#Lista_campi').data('pk');
 ajaxHandler.synServerCall('ajax_handler.php','setPk',ids1,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefFieldsProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsConstsDef',ids2,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  alert(loc.getString('msg',92));
 return false;
}

function form_inserimento_2_lista_campi_onChange(actObj)
{
 $('input#pk').get(0).checked=false;
 $(actObj).next().remove();
 $(actObj).after('<span id=\'tipo_campo_id\'>' + 
 $('select#Lista_campi option:selected').data('tipo')+ '</span>');
 var keyField = $('select#Lista_campi').data('pk');
 var field = $('select#Lista_campi option:selected').text().replace(/\s*/g,'');
 if((keyField == field)&&(field!=''))
  $('input#pk').get(0).checked=true;
}

function form_inserimento_2_tipi_campo_onChange(actObj)
{
 if(actObj.value != 0)
 {
	var lista_campi = $('select#Lista_campi').get(0);
  $('select#Lista_campi option:selected').data('tipo',$('select#Tipi_campo option:selected').text());
  $(lista_campi).next().remove();
  $(lista_campi).after('<span id=\'tipo_campo_id\'>' + 
  $('select#Lista_campi option:selected').data('tipo')+ '</span>');
 }
}

 function form_inserimento_3_reset_button_onClick(actName)
 {
  if($('select#Lista_tabelle option:selected').text().replace(/\s*/g,'')=='')
  {
   alert(loc.getString('msg',11));
 	 return false;
  }
 	var tabId = $('#Lista_tabelle option:selected').val();
  var ids = tabId;
  ajaxHandler.serverCall('ajax_handler.php','getCandKeyFieldsProps',ids,'xml',/CDATA/);
  alert(loc.getString('msg',91));
  return false;
 }

function form_inserimento_3_submit_button_onClick()
{
 if($('select#Lista_tabelle option:selected').text().replace(/\s*/g,'')=='')
 {
 	alert(loc.getString('msg',11));
 	return false;
 }
 var tab = $('#Lista_tabelle option:selected').val();
 var ids = tab;
 var divChilds = $('#html_tags__1 > div');
 var ct = divChilds.size();
 var divChild = divChilds.eq(1);
 ids=ids + ';';
 for(var i=0;i<=ct-2;i++)
 {
  var selectChild = divChild.children().eq(2);
  var ct1 = selectChild.children().size();
  var optChild = selectChild.children().eq(0);
  for(var j=0;j<=ct1-1;j++)
  {
   ids = ids + optChild.text() + ':';
   optChild = optChild.next();
  } 
  divChild=divChild.next();
  ids=ids + ';';
 }
 //alert(ids);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefCandKeyFieldsProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  alert(loc.getString('msg',93));
 return false;
}

function form_inserimento_4_submit_button_onClick()
{
 if($('select#Lista_tabelle option:selected').text()=='')
 {
 	alert(loc.getString('msg',11));
 	return false;
 } 
 
 var breakFlag=false;
 var selectCtrl = $('#html_tags__2_lista_tabelle_0 option');
 selectCtrl.each(function()
 {
 	if(($(this).text()!='') && ($(this).data('keyField')==''))
 	{
 	 alert(loc.getString('msg',62) + $(this).text());
 	 breakFlag=true;
 	 return;
 	} 
 });
 if(breakFlag)
  return false;
 
 var tab = $('#Lista_tabelle option:selected').val();
 var tabName
 var ids = tab;
 ids=ids + ';';
 var ids2 = tab;
 
 var listaCampiSelectCtrl = $('#Lista_campi option');
 listaCampiSelectCtrl.each(function()
 {
 	var field = $(this).text().replace(/\s*/g,'');
 	if(field!='')
 	{ 
 		ids2 = ids2 + ';' + field;
  }
 });
 
 var selectCtrl = $('#html_tags__2_lista_tabelle_0 option');
 selectCtrl.each(function()
 {
 	var field = $(this).data('keyField');
 	if(($(this).text()!='') && (! (field=='')))
 	{ 
 		ids2 = ids2 + ';' + field;
  }
 });
 
 ct = selectCtrl.size();
 var optChild = selectCtrl.eq(0);
 for(var j=0;j<=ct;j++)
 {
  ids = ids + optChild.text() + ':';
  optChild = optChild.next();
 }
 ids = ids + ';';
 var optChild = selectCtrl.eq(0);
 for(var j=0;j<=ct;j++)
 {
  ids = ids + ((optChild.data('keyField')!=undefined)?(optChild.data('keyField')):('')) + ':';
  optChild = optChild.next();
 } 
 alert('setFieldsDefExtKeyFieldsProps:' + ids);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefWithoutExtKeys',tab,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefExtKeyFieldsProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsDef',tab,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 ajaxHandler.synServerCall('ajax_handler.php','setFieldsConstsDef',ids2,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 var button = $('#form_2__1_reset_button_id').get(0);
 button.onclick(); 
 ids = $('#Lista_tabelle option:selected').text();
 ids=ids + ';';
 var num1 = selectCtrl.length;
 var optChild = selectCtrl.eq(0);
 for(var k=0;k<=num1;k++)
 {
  ids = ids + optChild.text() + ';';
  optChild=optChild.next();
 }
 //alert('<<'+ ids+'>>');
 ajaxHandler.synServerCall('ajax_handler.php','set1NRelationsDefinitionProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  alert(loc.getString('msg',94));
 return false;
}

 function form_inserimento_4_reset_button_onClick(actName)
 {
  if($('select#Lista_tabelle option:selected').text().replace(/\s*/g,'')=='')
  {
   alert(loc.getString('msg',11));
 	 return false;
  }  
 	var tabId = $('#Lista_tabelle option:selected').val();
  var ids = tabId;
  ajaxHandler.serverCall('ajax_handler.php','getExtKeyFieldsProps',ids,'xml',/CDATA/);
  alert(loc.getString('msg',91));
  return false;
 }
 
 function form_inserimento_4_lista_nuove_tabelle_onChange()
{
 var item2=$('#html_tags__2_lista_tabelle_0 option:selected').text();
 var item1=$('#html_tags__2_lista_nuove_tabelle_0 option:selected').text();
 var tab = $('#Lista_tabelle option:selected').text();
 if(((! util.testTextInComboLabels('html_tags__2_lista_tabelle_0',item1))||(item1==''))) 
 {
  if(item1 !== '')
  {
   var ids = tab + ';' + item1;

   ajaxHandler.synServerCall('ajax_handler.php','checkIfIs1NRelationFatherOf',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);  
   if (ajaxHandler.getOpByName('checkIfIs1NRelationFatherOf').testResult == 'true')
   {
     alert(loc.getString('msg',20) + tab + loc.getString('msg',27) + item1 + 
     loc.getString('msg',28) + item1 + '.');
 	 }
 	 else
 	 {
 	  $('#html_tags__2_lista_tabelle_0 option:selected').text($('#html_tags__2_lista_nuove_tabelle_0 option:selected' ).text());
 	  if($('#html_tags__2_lista_tabelle_0 option:selected').data('keyField')!==undefined)
 	   $('#external_key').val($('#html_tags__2_lista_tabelle_0 option:selected').data('keyField'));
 	  else
 	   $('#html_tags__2_lista_tabelle_0 option:selected').data('keyField','');
 	  if((item2 == '')&&(item1 != ''))
 	  $('#html_tags__2_lista_tabelle_0').append('<option></option>');
   }
  }
  else
  {
 	 $("#html_tags__2_lista_tabelle_0 option:selected").text($("#html_tags__2_lista_nuove_tabelle_0 option:selected" ).text());
   $('#external_key').val('');
   $('#html_tags__2_lista_tabelle_0 option:selected').data('keyField','');
  } 	  	
 }
 else 
 	alert(loc.getString('msg',9));
}




 

