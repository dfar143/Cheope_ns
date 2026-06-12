function form_inserimento_1_nome_pagina_onChange(actObj)
{
 var nomePagina = $('#Nome_pagina').get(0).value;
 var intPage = 'pagine_edit.php'; 
 var newLocation = intPage + '?Nome_pagina=';
 var newLocation = newLocation + actObj.value;
 window.location = newLocation;	
}

function form_inserimento_1_submit_button_onClick()
{
 var postStr = "Nome_interfaccia=&";
 var strVal=$('#nuovo_nome_pagina').get(0)===undefined?"":$('#nuovo_nome_pagina').get(0).value;
 var listaStr = strVal;
 if(listaStr=='')
  alert(loc.getString('msg',18));
 else
 {
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(strVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 return false;
  }
  postStr = postStr + 'Nome_pagina' + '=' + strVal + '&';
  var num = $('#html_tags__1 input:not([type=hidden])').size();
  $('#html_tags__1  input:not([type=hidden])').each(
  function(index)
  {
   var field = $(this).get(0);
   if(field.id!='nuovo_nome_pagina')
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
  var num = $('#html_tags__1 > textarea').length;
  $('#html_tags__1 > textarea').each(
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
 	var num1 = $(this).find('option:not(:empty)').length;
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
 console.log(postStr);
 ajaxHandler.serverPostCall('ajax_handler.php','postSendInterfaceData','_',postStr,'text',/[.]*\w[.]*/);
 var id = $('#ajaxOps').get(0).value;
 ajaxHandler.serverCall('ajax_handler.php','addAjaxOpsFromPhpArray',id,'text',/[.]*\w[.]*/);
 }
 alert(loc.getString("msg",91));
 return false;
}

function select_container_interfaces_onChange(actInd1,actInd2)
{
 var item1=$('#' + actInd2 + ' option:selected').text();
 var item2=$('#' + actInd1).val();
 alert(item2); 
 if((item1=='')&&(item2!=''))
 {$('#' + actInd2).append('<option></option>')}
 $('#' + actInd2 + ' option:selected').text(item2);
 $('#' + actInd2 + ' option:selected').val(item2);		
}

function select_container_templates_onChange(actInd1,actInd2)
{
 var item1=$('#' + actInd2).text();
 var item2=$('#' + actInd1).val();
 alert(item2); 
 if((item1 == '')&&(item2 != ''))
 {$('#' + actInd2).text('')}
 $('#' + actInd2).text(item2);
 $('#' + actInd2).val(item2);		
}

function checkbox_localization_onClick(actObj)
{
	//if(actObj.checked)
	 //$('#html_tags_dec__59').attr('style','display:block;');
	//else
	//$('#html_tags_dec__59').attr('style','display:none');		
}

function checkbox_bootstrap_onClick(actObj)
{
	//if(actObj.checked)
	//$('#html_tags_dec__59').attr('style','display:block;');
	//else
	//$('#html_tags_dec__59').attr('style','display:none');		
}

function checkbox_uiMaterial_onClick(actObj)
{
}


function button_container_onClick(actObj)
{
	var intName = $(actObj).parent().find('select').val();
	if(intName.replace(/\s*/g,'') != '')
 	 subModal.showPopWin('view_interface.php?Par=' + intName,700,400,function(actVar){},true);
  else
   alert(loc.getString('msg',56));
}

function button_template_structure_onClick(actObj)
{
	var intName = $(actObj).parent().find('input').val();
	if(intName.replace(/\s*/g,'') != '')
 	 subModal.showPopWin('view_interface.php?Par=' + intName,700,400,function(actVar){},true);
  else
   alert(loc.getString('msg',56));
}

function span_container_onClick(actObj)
{
	var pageName = ($('#Nome_pagina option:selected').text().replace(/\s*/g,'')=='Default')?(($('#nuovo_nome_pagina').val().replace(/\s*/g,'')=='')?'*':$('#nuovo_nome_pagina').val()):$('#Nome_pagina option:selected').text().replace(/\s*/g,'');
	if(pageName=="*")
	 alert(loc.getString('msg',82));
	else
	{
	var intName = $('#active_application_id').text() + '!' + 
	pageName + '!' + 'Html_page' + 
	'!' + $('#op').val() + '!' + $('#num').val();
	var selectObj0 = $(actObj).parent().find('select').get(0);
	var selectJQueryObj = $(selectObj0);
	var intContId = selectJQueryObj.attr('id');
	var intContName = intContId.replace(/InterfacesContainer/,'');
	var intCont = '';
	var i=0;
	selectJQueryObj.find('option').each(function(){if(i==0) 
	intCont=$(this).text(); else if($(this).text().replace(/\s*/g,'')!='') 
		intCont=intCont +';' + $(this).text(); i++;});
 	subModal.showPopWin('manage_interface_container.php?Interfaccia=' + 
 	intName + '&ContainerName=' + intContName + '&Contenuto=' + intCont,750,400,
 	function(actVar)
 	{if(actVar !== undefined){util.deleteSelectFieldContents(intContId);
 	 var items = actVar.split(';');
 	 for(var item in items){var option = document.createElement('option');
 	$(option).text(items[item]);selectJQueryObj.append(option);}
 	selectJQueryObj.append("<option></option>");}
 	 },true);
 	}
}
