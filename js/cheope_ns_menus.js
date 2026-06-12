function input_num_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[0-9]+[0-9]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function input_op_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function shortName_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
  if(fieldVal=='')
  {
	 $('#CheckBox_IFreeName').get(0).checked=false;
  }
}

function checkbox_IFreeName_onClick(actObj)
{
	if($(actObj).get(0).checked)
	{
		if($('#ShortName').val().replace(/\s*/g,'')=='')
		{
		 alert(loc.getString('msg',66));
		 $(actObj).get(0).checked=false;
	  }
	}
}

function input_multi_num_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[0-9]+[0-9]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function input_multi_op_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function multi_shortName_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
  if(fieldVal=='')
  {
	 $('#Multi_checkBox_IFreeName').get(0).checked=false;
  }
}

function multi_checkbox_IFreeName_onClick(actObj)
{
	if($(actObj).get(0).checked)
	{
		if($('#Multi_shortName').val().replace(/\s*/g,'')=='')
		{
		 alert(loc.getString('msg',66));
		 $(actObj).get(0).checked=false;
	  }
	}
}


function sMenu_field_input_onChange(actObj)
{
	$(actObj).val(actObj.value);
}

function sMenu_page_input_onChange(actObj)
{
	$(actObj).val(actObj.value);
}

function sMenu_par_input_onChange(actObj)
{
	$(actObj).val(actObj.value);
}

function mMenu_field_input_onChange(actObj)
{
	$(actObj).val(actObj.value);
}

function mMenu_page_input_onChange(actObj)
{
	$(actObj).val(actObj.value);
}

function mMenu_subMenu_textarea_onChange(actObj)
{
	$(actObj).get(0).innerHTML=actObj.value;
}

function pagine_onChange(actObj,actMenuType)
{
 var id = actObj.value;
 if(actMenuType=='single')
 {
  ajaxHandler.synServerCall('ajax_handler.php','getSingleMenus',id,'xml',/[.]*ind_records[.]*/);
  interfacesContainer.getInterface('Op4').putData();
 }
 else if(actMenuType=='multi')
 {
 	ajaxHandler.synServerCall('ajax_handler.php','getMultiMenus',id,'xml',/[.]*ind_records[.]*/);
  interfacesContainer.getInterface('Op5').putData();
 }
}

function single_level_menu_onChange(actObj)
{
 var intName = $(actObj).val();
 if(intName.replace(/\s*/g,'') !== '')
 {
  ajaxHandler.synServerCall('ajax_handler.php','testIntFormat',intName,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
  var result = ajaxHandler.getOpByName('testIntFormat').result;
  if(! result)
  {
	alert(loc.getString('msg',4));
	return true;
  }
  ajaxHandler.synServerCall('ajax_handler.php','viewSingleMenuFieldsOp2',intName,'xml',/[.]*ind_records[.]*/);
  var int1 = interfacesContainer.getInterface('viewSingleMenuFieldsOp1');
  int1.setExecOnlyOnFullDataSource(false);
  int1.setInheritData(false);
  int1.putData();
  var int2 = interfacesContainer.getInterface('viewSingleMenuFieldsOp3');
  int2.putData();
 }
 var sMenu = $(actObj).find('option:selected').text();
 if(sMenu.replace(/\s*/g,'')=='')
 {
	$('#Op').val('');
	$('#Num').val('0');
	$('#Tipo_menu option').get(0).selected=true;	
	return true;
 } 
 var intItems = sMenu.split('!');
 if(intItems.length==1)
 {
 	var intName = sMenu;
  ajaxHandler.synServerCall('ajax_handler.php',
  'getFreeInterfaceCanonicalName',intName,'text');
  var intName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
  $('#ShortName').val(sMenu);
  $('#CheckBox_IFreeName').get(0).checked=true;
  var intItems = intName.split('!');
 } 
 else
 {
	$('#ShortName').val('');
	$('#CheckBox_IFreeName').get(0).checked=false;
 }  
 var tipoInterfaccia = intItems[3];
 $('#Op').val(intItems[4]);
 
 intNumItems = intItems[5].split('.');
 if(intNumItems.length==2)
  var num = intNumItems[0];
 else
 	var num = intNumItems[0];
 
 $('#Num').val(num);
 $('#Tipo_menu option').each(function(){if(this.value==tipoInterfaccia)this.selected=true});
}

function multi_level_menu_onChange(actObj)
{
 var intName = $(actObj).val();
 if(intName.replace(/\s*/g,'')!=='')
 {
 ajaxHandler.synServerCall('ajax_handler.php','viewMultiMenuFieldsOp2',intName,'xml',/[.]*ind_records[.]*/);
 var int1 = interfacesContainer.getInterface('viewMultiMenuFieldsOp1');
 int1.setExecOnlyOnFullDataSource(false);
 int1.setInheritData(false);
 int1.putData();
 var int2 = interfacesContainer.getInterface('viewMultiMenuFieldsOp3');
 int2.putData();
 } 
 var sMenu = $(actObj).find('option:selected').text();
 if(sMenu.replace(/\s*/g,'')=='')
 {
	$('#Multi_op').val('');
	$('#Multi_num').val('0');
	return false;
 } 
 var intItems = sMenu.split('!');
 if(intItems.length==1)
 {
 	var intName = sMenu;
  ajaxHandler.synServerCall('ajax_handler.php',
  'getFreeInterfaceCanonicalName',intName,'text');
  var intName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
  $('#Multi_shortName').val(sMenu);
  $('#Multi_checkBox_IFreeName').get(0).checked=true;
  var intItems = intName.split('!');
 } 
 else
 {
	$('#Multi_shortName').val('');
	$('#Multi_checkBox_IFreeName').get(0).checked=false;
 }
 var intPage = intItems[1];
 $('#Multi_op').val(intItems[4]);

 intNumItems = intItems[5].split('.');
 if(intNumItems.length==2)
  var num = intNumItems[0];
 else
 	var num = intNumItems[0];
 
 $('#Multi_num').val(num);

 ajaxHandler.synServerCall('ajax_handler.php','getAllInterfacesOfPage',window.intPage,'xml',/[.]*ind_records[.]*/); 
 var interfaces = ajaxHandler.getOpByName('getAllInterfacesOfPage').result;
 var num = interfaces.length;
 var intList = 'sourceInt' + '=' + intName + '&';
 for(j=0;(j<=num-1);j++)
  if(interfaces[j] != intName)
  intList = intList + 'int_' + j +  '=' + interfaces[j] + '&';
 ajaxHandler.synServerPostCall('ajax_handler.php','filterParentsInterfacesFiles','',intList,'xml',/[.]*ind_records[.]*/);
 var interfaces = ajaxHandler.getOpByName('filterParentsInterfacesFiles').result;
// console.log(interfaces);
 util.deleteSelectFieldContents('html_input_ctrl__6_Array_submenu');
 for(ind in interfaces)
 {
 	$('#html_input_ctrl__6_Array_submenu').append('<option value="' + interfaces[ind] +
 	'">' + interfaces[ind] + '</option>');
 }
 
}

 function button_add_voice_to_single_onClick()
 {
 	var inputVoiceVal = $('#input_voice_to_single_id').val();
 	if(inputVoiceVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',65));
   return false;
 	} 
  var regExp = /^[A-Za-z0-9אשעלט_\.\:\*\%\$\&\+\-\£\/\\\!\=\s\@]+[A-Za-z0-9אשעלט_\'\"\s\=\.\:\!\?\@\#\$\&\*\\\%\+\-\£\/\|]*$/;
  if(inputVoiceVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_voice_to_single_id').focus();
 	 return false;
  }
 	var inputPageVal = $('#input_page_to_single_id').val();
  var regExp = /^[A-Za-z0-9אשעלט_\s\/\?\=\!\:\.\@\#\\[\]\%\$\&\*\+\-]*$/;
  if(inputPageVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_page_to_single_id').focus();
 	 return false;
  }
 	var inputParVal = $('#input_par_to_single_id').val();
  var regExp = /^[A-Za-z0-9אשעלט_\s\/\?\=\!\:\.\@\#\\[\]\%\$\&\*\+\-]*$/;
  if(inputParVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_par_to_single_id').focus();
 	 return false;
  }
 	var voiceText = $('#input_voice_to_single_id').val(); 
 	var pageText = $('#input_page_to_single_id').val();
    var parText = $('#input_par_to_single_id').val();	
  dndSource.insertNodes(false,[{voice:voiceText,page:pageText,par:parText}]);
  dndSource.sync();
 }
 
 function button_add_voice_to_multi_onClick()
 {
 	var inputVoiceVal = $('#input_voice_to_multi_id').val();
 	if(inputVoiceVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',65));
   return false;
 	} 
  var regExp = /^[A-Za-z0-9אשעלט_\.\:\*\%\$\&\+\-\£\/\\\!\=\s\@]+[A-Za-z0-9אשעלט_\'\"\s\=\.\:\!\?\@\#\$\&\*\\\%\+\-\£\/\|]*$/;
  if(inputVoiceVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_voice_to_multi_id').focus();
 	 return false;
  }
 	var inputPageVal = $('#input_page_to_multi_id').val();
  var isObjectRadioChecked = $('#html_input_ctrl__5_Choose_submenu_Object').get(0).checked;
  var isArrayRadioChecked = $('#html_input_ctrl__5_Choose_submenu_Array').get(0).checked;
  if(isObjectRadioChecked)
   submenuText = $('#html_input_ctrl__6_Array_submenu').val();
  else if(isArrayRadioChecked)
  	submenuText = $('#html_tags__45').val();
  else
  	submenuText = '';
 	var voiceText = $('#input_voice_to_multi_id').val(); 
 	var pageText = $('#input_page_to_multi_id').val(); 
  dndSourceMulti.insertNodes(false,[{voice:voiceText,page:pageText,submenu:submenuText}]);
  dndSourceMulti.sync();
 }
 
 function button_apply_to_single_onClick()
 {
 	var intName = $('#Single_menus').val().replace(/\s*/g,'');
 	var op = $('#Op').val().replace(/\s*/g,'');
 	var num = $('#Num').val().replace(/\s*/g,'');
 	var type = $('#Tipo_menu').val().replace(/\s*/g,'');
 	var page = $('#Pagine').val();
 	var ids = 'IntName=' + intName + '&Page=' + page + '&Op=' + op + 
 	'&Type=' + type + '&Num=' + num + '&';
	var interfaceShortName = $('#ShortName').val().replace(/\s*/g,'');
	ids = ids + 'ShortName=' + interfaceShortName + '&';
	var  interfaceFree = ($('#CheckBox_IFreeName').get(0).checked?'true':'false');
	ids = ids + 'CheckBox_IFreeName=' + interfaceFree + '&';
 	var i=0; 
 	$('#tbody_id tr').each(function(){
 	ids = ids + 'LineNum=' + i + '&';
 	var voice = $(this).find('.Voices').val();
 	var page = $(this).find('.Pages').val();
	var par = $(this).find('.Pars').val();
 	ids = ids + 'Voice_' + i + '=' + voice + '&';
 	ids = ids + 'Page_' + i + '=' + ((page != '')?page:'*') + '&';
	ids = ids + 'Par_' + i + '=' + ((par != '')?par:'*') + '&';
 	i++;
 	});
	
	//ajaxHandler.synServerCall('ajax_handler.php','interfaceExists','',intName,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
	//console.log('NNN');
	if ((interfaceFree == 'true')&&(interfaceShortName != ''))
	{
		//console.log('MMM');
		//console.log(interfaceShortName);
		ajaxHandler.synServerCall('ajax_handler.php','interfaceExists',interfaceShortName,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
		//console.log(ajaxHandler.getOpByName('interfaceExists').result);
		if (ajaxHandler.getOpByName('interfaceExists').result=='true')
	    {
		 ajaxHandler.synServerCall('ajax_handler.php','getFreeInterfaceCanonicalName',interfaceShortName,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
         var intCanonicalName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result.split(/!/);
		 //console.log(intCanonicalName);
		 var intType = intCanonicalName[3];
		 if(intType != $('#Tipo_menu').val())
		 {
		  alert(loc.getString('msg',95));
          return false;
         }		  
		}
	}
 			 
 	ajaxHandler.synServerPostCall('ajax_handler.php',
 	'setSingleMenu','',ids,'text',/[0-9]*/);
	alert(loc.getString('msg',91));
 } 
 
 function button_apply_to_multi_onClick()
 {
 	var intName = $('#Multi_menus').val().replace(/\s*/g,'');
 	var op = $('#Multi_op').val().replace(/\s*/g,'');
 	var num = $('#Multi_num').val().replace(/\s*/g,'');
 	var type ='nLevels_menu';
 	var page = $('#Multi_pagine').val();
 	var ids = 'IntName=' + intName + '&Page=' + page + '&Op=' + op + 
 	'&Type=' + type + '&Num=' + num + '&';
	var interfaceShortName = $('#Multi_shortName').val().replace(/\s*/g,'');
	ids = ids + 'ShortName=' + interfaceShortName + '&';
	var  interfaceFree = ($('#Multi_checkBox_IFreeName').get(0).checked?'true':'false');
	ids = ids + 'CheckBox_IFreeName=' + interfaceFree + '&';
 	var i=0; 
 	$('#m_tbody_id tr').each(function(){
 	ids = ids + 'LineNum=' + i + '&';
 	var voice = $(this).find('.Voices').val();
 	if(voice=='undefined')
 	 voice='';
 	var url = $(this).find('.Pages').val();
 	if(url=='undefined')
 	 url='';
 	var subMenu = $(this).find('.SubMenus').val();
 	if(subMenu=='undefined')
 	 subMenu='';
 	ids = ids + 'Voice_' + i + '=' + voice + '&';
 	ids = ids + 'Url_' + i + '=' + ((url != '')?url:'*') + '&';
 	ids = ids + 'SubMenu_' + i + '=' + subMenu + '&';
 	i++;
 	});
	//console.log(ids);
 	ajaxHandler.synServerPostCall('ajax_handler.php',
 	'setMultiMenu','',ids,'text',/[0-9]*/);
	alert(loc.getString('msg',91));
 } 
 
 function button_test_preview_onClick(actObj)
 {
  var appName = $('#active_application_id').text();
  var pagina = $('#Pagine').val();
  var op=$('#Op').val().replace(/\s*/g,'');
  var type=$('#Tipo_menu').val().replace(/\s*/g,'');
  var num = $('#Num').val().replace(/\s*/g,'');
 	var shortName = $('#ShortName').val().replace(/\s*/g,'');
 	
 	if(num=='')
 	 num='0';

 	var menuFileName = $('#Single_menus').val().replace(/\s*/g,'');
 	menuFileNameItems = menuFileName.split('.');
 	if(menuFileNameItems.length==2)
 	 menuSuffix = '.' + menuFileNameItems[1];
 	else
 	 menuSuffix = '';
 	 
 	if((shortName=='')||(! $('#CheckBox_IFreeName').get(0).checked))	 
   var interfaccia=appName + '!' + pagina + '!!' + type + '!' + op + 
   '!' + num + menuSuffix;
  else
   interfaccia = shortName;
  
  var serverName = interfacesContainer.getInterface('Op2').getServerName();
  var docRoot = interfacesContainer.getInterface('Op2').getDocRoot();
  preview_exec(interfaccia,appName,serverName,docRoot); 	
 }
 
 function button_edit_onClick(actObj)
 {
  var appName = $('#active_application_id').text();
  var pagina = $('#Pagine').val();
  var op=$('#Op').val().replace(/\s*/g,'');
  var type=$('#Tipo_menu').val().replace(/\s*/g,'');
  var num = $('#Num').val().replace(/\s*/g,'');
 	var shortName = $('#ShortName').val().replace(/\s*/g,'');
 	
 	if(num=='')
 	 num='0';
 	 
 	if((shortName=='')||(! $('#CheckBox_IFreeName').get(0).checked))	 
   var interfaccia=appName + '!' + pagina + '!!' + type + '!' + op + 
   '!' + num;
  else
   interfaccia = shortName;
 	subModal.showPopWin('view_interface.php?Par=' + interfaccia,
  700,400,function(actVar){},true);
 }
 
 function button_multi_test_preview_onClick(actObj)
 {
  var appName = $('#active_application_id').text();
  var pagina = $('#Multi_pagine').val();
  var op=$('#Multi_op').val().replace(/\s*/g,'');
  var num = $('#Multi_num').val().replace(/\s*/g,'');
 	var shortName = $('#Multi_shortName').val().replace(/\s*/g,'');
 	
 	if(num=='')
 	 num='0';

 	var menuFileName = $('#Multi_menus').val().replace(/\s*/g,'');
 	menuFileNameItems = menuFileName.split('.');
 	if(menuFileNameItems.length==2)
 	 menuSuffix = '.' + menuFileNameItems[1];
 	else
 	 menuSuffix = '';
 	 
 	if((shortName=='')||(! $('#Multi_checkBox_IFreeName').get(0).checked))	 
   var interfaccia=appName + '!' + pagina + '!!nLevels_menu!' + op + 
   '!' + num + menuSuffix;
  else
   interfaccia = shortName;
     
  var serverName = interfacesContainer.getInterface('Op2').getServerName();
  var docRoot = interfacesContainer.getInterface('Op2').getDocRoot();
  preview_exec(interfaccia,appName,serverName,docRoot); 	
 }

 
function preview_exec(actInt,actActiveApp,actServerName,actDocRoot)
{
	var intr = actInt;
	if(intr.replace(/\s*/g,'')=='')
	{
		alert(loc.getString('msg',56));
		return false;
  }
  
  var crEnabled = 1;
  
  ajaxHandler.synServerCall('ajax_handler.php','dojoInPreview','','text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
  var result = ajaxHandler.getOpByName('dojoInPreview').result;
  
  if(result=='true')
   var dojoEnabled = 1;
  else
   var dojoEnabled = 0;
  
  var jqueryEnabled = 1;
  var dataPageEnabled = 1;

  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled ;
  ajaxHandler.synServerCall('ajax_handler.php','createPreview',intr,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
  
  var dirName=actActiveApp;
  if(dirName!='')
    window.open('http://' + actServerName +
   '/' + actDocRoot + '/' + dirName +
   '/' + 'preview.php');
  
  return false;	
}