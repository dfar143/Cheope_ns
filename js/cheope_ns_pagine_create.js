function nome_pagina_onChange(actObj)
{
 var nomePagina=actObj.value;
 var selectEl = $('#Interfaccia_radice').get(0);
 var options = selectEl.options;
 var optionsNum = options.length;
 var option = options[0];
 var j=0;
 for(var i=1;i<=optionsNum;i++)
 {
 	var optionText = option.text;
  optionTextEls = optionText.split('!');
  var nomePaginaCorrente = optionTextEls[1];
  var option = options[i];
  if(nomePaginaCorrente!=nomePagina)
  {
  	options.remove(j);
  	i=i-1;
  	optionsNum = optionsNum-1;
  }
  else
   j=j+1;
 }
}

function form_inserimento_1_submit_button_onClick()
{
 if($('select#Nome_pagina option:selected').text().replace(/\s*/g,'')!='')
 {
 	var val1 = $('#Nome_pagina').get(0).value;
 	var val2 = $('#Interfaccia_radice').get(0).value;
 	var val2Items = val2.split('!');
 	
  if(val2Items.length==1)
  {
 	 var intName = val2;
   ajaxHandler.synServerCall('ajax_handler.php',
   'getFreeInterfaceCanonicalName',intName,'text');
   var intNameCanonical = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
   var val2Items = intNameCanonical.split('!');
  }  	
 	
 	var val3 = val2Items[1];
 	if(val1 !== val3)
  {
 	 alert(loc.getString('msg',15));
 	 return false;
  }
  if((val1=='')||(val3==''))
  {
 	 alert(loc.getString('msg',16));
 	 return false;
  }
  var intr = val2;
  var crEnabled;
  var dojoEnabled;
  var jqueryEnabled;
  var dataPageEnabled;
  var ajaxOpsHandlerEnabled;
  if($('#CREnabled').get(0).checked)
   crEnabled = 1;
  else crEnabled=0;
  if($('#DojoEnabled').get(0).checked)
   dojoEnabled = 1;
  else dojoEnabled=0;
  if($('#JQueryEnabled').get(0).checked)
   jqueryEnabled = 1;
  else jqueryEnabled=0;
  if($('#DataPageEnabled').get(0).checked)
   dataPageEnabled = 1;
  else dataPageEnabled=0;
  if($('#AjaxOpsHandlerEnabled').get(0).checked)
   ajaxOpsHandlerEnabled = 1;
  else ajaxOpsHandlerEnabled=0;
  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled + ';' + ajaxOpsHandlerEnabled;
  var postStr='AjaxOps=' + $('#AjaxOps').get(0).value;
  alert(intr);
  ajaxHandler.serverPostCall('ajax_handler.php','createPage',intr,postStr,'text');
  //var id = $('#AjaxOps').get(0).value;
  //if(id.replace(/\s*/g,'')!='')
  // ajaxHandler.serverCall('ajax_handler.php','addAjaxOpsFromPhpArray',id,'text');
  return false;
 }
 else
 {
 	alert(loc.getString('msg',17));
 	return false;
 }	
}