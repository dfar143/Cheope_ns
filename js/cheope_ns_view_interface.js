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
	 $('#checkBox_IFreeName').get(0).checked=false;
  }
}


function checkbox_iFreeName_onClick(actObj)
{
	if($(actObj).get(0).checked)
	{
		if($('#shortName').val().replace(/\s*/g,'')=='')
		{
		 alert(loc.getString('msg',66));
		 $(actObj).get(0).checked=false;
	  }
	}
}

function form_inserimento_1_submit_button_onClick()
{
 var interfaccia=$('#Lista_interfacce').get(0).value.replace(/\s*/g,'');
 var intItems = interfaccia.split('!');
 if(intItems.length==1)
 {
  ajaxHandler.synServerCall('ajax_handler.php',
  'getFreeInterfaceCanonicalName',interfaccia,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  var intName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
  var intItems = intName.split('!');
 }
 var nomePagina = intItems[1];
 if(nomePagina==undefined)
  nomePagina = '';
 if($('#Lista_interfacce').get(0) != undefined){
 var listaStr = interfaccia;
 if(listaStr=='')
 {
  alert(loc.getString('msg',23));
 }
 else
 {
 	var postStr = "Nome_interfaccia=" + encodeURIComponent(listaStr) + '&';
  postStr = postStr + 'Nome_pagina=' + encodeURIComponent(nomePagina) + '&';
  var num = $('#html_tags__0 input').not('[type="hidden"]').size();
  $('#html_tags__0  input').not('[type="hidden"]').each(
  function(index)
  {
   var field = $(this).get(0);
   if(index < num-1)
   {
  	postStr = postStr + field.id + '=' + 
  	encodeURIComponent(
  	(field.type=='checkbox')?((field.checked)?'true':'false'):field.value) + '&';
   }
   else
   {
   	postStr = postStr + field.id + '=' + 
  	encodeURIComponent(
  	(field.type=='checkbox')?((field.checked)?'true':'false'):field.value)
   }
  }); 
  var num = $('#html_tags__0 > textarea').size();
  $('#html_tags__0 > textarea').each(
  function(index)
  {
   var vid=$(this).get(0).id; 
   var typeStr = vid.substr(0,1);
   if(typeStr=='@')
   {
    if(index==0)
     postStr = postStr + '&';
    if(index < num-1)
    {
     postStr = postStr + $(this).get(0).id + 
     '=' + encodeURIComponent($(this).get(0).value) + '&';
    }
    else
    {
     postStr = postStr + $(this).get(0).id + '=' + 
     encodeURIComponent($(this).get(0).value)
    }
   }
   else 
   {
    if(index==0)
     postStr = postStr + '&';
    if(index < num-1)
    {
     postStr = postStr + '#' + $(this).get(0).id + 
     '=' + encodeURIComponent($(this).get(0).value) + '&';
    }
    else
    {
     postStr = postStr + '#' + $(this).get(0).id + '=' + 
     encodeURIComponent($(this).get(0).value)
    }
   }
  }
 );
 $('.container').each(function(index)
 {
 	var thisId = this.id;
 	var num1 = $(this).find('option:not(:empty)').size();
 	if(num1 > 0)
 	{
  $(this).find('option:not(:empty)').each(
  function(index)
  {
 	 if(index==0)
 	  postStr = postStr + '&|' + thisId + '=';
   if(index < num1-1)
   {
    postStr = postStr + encodeURIComponent($(this).text()) + ';'
   }
   else
   {
    postStr = postStr + encodeURIComponent($(this).text());
   }
  }
  );
 }
 else
 {
 	postStr = postStr + '&|' + thisId + '=';
 }
 });
  ajaxHandler.synServerPostCall('ajax_handler.php','postSendInterfaceData','_',postStr,'text',/[\s\._\:A-Za-z0-9;\-!\/]*/);
  alert(loc.getString('msg',91));
 }
 return false;
}
var nomeApp = intItems[0];
var objName;
if($('#obj').size()==1)
 objName = $('#obj').val();
if((objName=='OBJ_NONE')||(objName==undefined))
 objName='';
var intType = $('#type').val();
var intOp = $('#op').val();
var intNum = $('#num').val();
var intShortName = $('#shortName').val();
if(intShortName == '')
 var interfacciaSavedName = nomeApp + '!' + nomePagina + 
 (($('#obj').get(0)!=undefined)?('!' +
 objName):('')) + '!' + intType + '!' + intOp + '!' + intNum;
else
 var interfacciaSavedName = intShortName;
window.returnVal = interfacciaSavedName; 
return false;
}

function lista_interfacce_onChange(actObj)
{
 var nomeInterfaccia = actObj.value;
 var nomeInterfacciaItems = nomeInterfaccia.split("!");
 var nomePagina = nomeInterfacciaItems[1];
 var intPage = 'view_interface.php';
 newLocation = intPage + '?Par=';
 var newLocation= newLocation + actObj.value;
 window.location = newLocation;
}


function select_container_interfaces_onChange(actInd1,actInd2)
{
 var item1=$('#' + actInd2 + ' option:selected').text();
 var item2=$('#select_' + actInd1).val();
 alert(item2); 
 if((item1=='')&&(item2!=''))
 {$('#' + actInd2).append('<option></option>')}
 $('#' + actInd2 + ' option:selected').text(item2);
 $('#' + actInd2 + ' option:selected').val(item2);		
}