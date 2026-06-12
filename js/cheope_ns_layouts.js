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

function pagine_onChange(actObj)
{
 var id = actObj.value;
 ajaxHandler.synServerCall('ajax_handler.php','getLayouts',id,'xml',/[0-9a-zA-Z_\-\<\>\?"\.\s\/]*/);
 ajaxHandler.synServerCall('ajax_handler.php','layoutsOp2',id,'xml',/[0-9a-zA-Z_\-\<\>\?"\.\s\/]*/);
 ajaxHandler.synServerCall('ajax_handler.php','layoutsOp1','','xml',/[0-9a-zA-Z_\-\<\>\?"\.\s\/]*/);
 var dndSource = new dojo.dnd.Source("tbody_id",{accept:[],copyOnly:true,
  	 creator:function(actItem,actHint)
  	 {
  	 var tr = document.createElement('tr');
  	 var num = $('#interfaces_table > tbody > tr').size();
  	 $(tr).attr('id', 'Row_id_' + num);
     var span = document.createElement('span');
     span.innerHTML = actItem.value;
     var td = document.createElement('td'); 
     var img = document.createElement('img');
     $(img).attr('width','49');
     $(img).attr('height','49');
     img.style.display="block";
     img.src='./img/' + actItem.type + '.gif'; 
     td.appendChild(img);
     td.appendChild(span);
     tr.appendChild(td);
     return {node: tr, data: actItem, type: 'text'};
  	 }
     });
 $("#tbody_id tr").each(function(){
  var currentTypeId=this.id;var interfaccia = $(this).find('span').text();
  var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]
  });
  pMenu.addChild(new dijit.MenuItem({label: 'Delete', 
  onClick:function(){$('#' + currentTypeId).remove();} 
 }));  
 pMenu.addChild(new dijit.MenuItem({label: 'Edit',
 onClick:function(){subModal.showPopWin('view_interface.php?Par=' + interfaccia,
 700,400,function(actVar){},true);}
 })); 
 pMenu.startup();});
 
 interfacesContainer.getInterface('Op10').putData();
}

function loadPars(actId,actPos)
{
 var pars = $('#' + actId).data('Pars');
 var pars1 = util.cloner().clone(pars);
 var parsArray = [];
 var i=0;
 $('#' + actId + '_' + actPos + '_' + 'tbody span').each(function(){
 	parsArray[i++] = $(this).text();
 });
 var style = $('#' + actId + '_' + actPos+ '_' + 'span_style').text();
 
 switch(actPos){
   case 'center':
  {pars1.center.container=parsArray;
  	pars1.center.style=style;}
  break;
  case 'left':
  {pars1.left.container=parsArray;
pars1.left.style=style;}
  break;  
  case 'right':
  {pars1.right.container=parsArray;
pars1.right.style=style;}
  break;
  case 'top':
  {pars1.top.container=parsArray;
pars1.top.style=style;}
  break;  
  case 'bottom':
  {pars1.bottom.container=parsArray;
pars1.bottom.style=style;}
  break;
  }
 $('#' + actId).data('Pars',pars1); 
 return;
}

function salva_layout_button_onClick()
{
	var postStr = "nome_interfaccia=" + $('#Layouts').val().replace(/\s*/g,'') + '&';
	postStr = postStr + 'pagina=' + $('#Pagine').val().replace(/\s*/g,'') + '&';
	var interfaceType = dijit.byId('html_tags__12').selectedChildWidget.domNode.id;
	postStr = postStr + 'type=' + interfaceType + '&';
	var interfaceOp = $('#Op').val().replace(/\s*/g,'');
	postStr = postStr + 'op=' + interfaceOp + '&';
	var interfaceNum = $('#Num').val().replace(/\s*/g,'');
	postStr = postStr + 'num=' + interfaceNum + '&';
	var interfaceShortName = $('#ShortName').val().replace(/\s*/g,'');
	postStr = postStr + 'shortName=' + interfaceShortName + '&';
	var  interfaceFree = ($('#checkBox_IFreeName').get(0).checked?'true':'false');
	postStr = postStr + 'checkBox_IFreeName=' + interfaceFree + '&';
	var withCont = $('#withContainer').get(0).checked;
	postStr = postStr +'withContainer=' + withCont + '&';
	var contStyle = $('#containerStyle').val();
	postStr = postStr + 'containerStyle=' + contStyle+ '&';
	var pars = $(dijit.byId('html_tags__12').selectedChildWidget.domNode).data('Pars');
	pars.left.style = $('#' + interfaceType + '_' + 'left' + '_' + 'span' + '_' + 'style' ).text(); 
	postStr = postStr + 'left_style=' + pars.left.style + '&';
	switch (interfaceType)
	{
	 case 'simple_layout':
	  postStr = postStr + 'bootstrapEnabled=true&bootstrapContainerType=container&';
	  break;
	 case 'two_columns_layout':
	  postStr = postStr + 'bootstrapEnabled=true&bootstrapContainerType=container&bootstrapViewPortSizeType=md&';
	  break;
	 case 'three_columns_layout':
	  postStr = postStr + 'bootstrapEnabled=true&bootstrapContainerType=container&bootstrapViewPortSizeType=md&';
	  break;
	 case 'tb_simple_layout':
	  postStr = postStr + 'bootstrapEnabled=true&bootstrapContainerType=container&';
	  break;
	 case 'tb_layout':
	  postStr = postStr + 'bootstrapEnabled=true&bootstrapContainerType=container&';
	  break;	  
	}
  var container = pars.left.container;
  var i;
  postStr = postStr + 'left_container=';
  for(i=0;i<=container.length-1;i++)
  {
  	if(i < container.length-1)
  	postStr = postStr + container[i] + ';';
  	else
  	postStr = postStr + container[i];
  }
  postStr = postStr + '&';
	pars.center.style = $('#' + interfaceType + '_' + 'center' + '_' + 'span' + '_' + 'style' ).text();
	postStr = postStr + 'center_style=' + pars.center.style + '&';
  var container = pars.center.container;
  var i;
  postStr = postStr + 'center_container=';
  for(i=0;i<=container.length-1;i++)
  {
  	if(i <=container.length-1)
  	postStr = postStr + container[i] + ';';
  	else
  	postStr = postStr + container[i];
  } 
  postStr = postStr + '&'; 
	pars.right.style = $('#' + interfaceType + '_' + 'right' + '_' + 'span' + '_' + 'style' ).text();
	postStr = postStr + 'right_style=' + pars.right.style + '&';
  var container = pars.right.container;
  var i;
  postStr = postStr + 'right_container=';
  for(i=0;i<=container.length-1;i++)
  {
  	if(i < container.length-1)
  	postStr = postStr + container[i] + ';';
  	else
  	postStr = postStr + container[i];
  } 
  postStr = postStr + '&';
	pars.top.style = $('#' + interfaceType + '_' + 'top' + '_' + 'span' + '_' + 'style' ).text();
	postStr = postStr + 'top_style=' + pars.top.style + '&';
  var container = pars.top.container;
  var i;
  postStr = postStr + 'top_container=';
  for(i=0;i<=container.length-1;i++)
  {
  	if(i <= container.length-1)
  	postStr = postStr + container[i] + ';';
  	else
  	postStr = postStr + container[i];
  } 
  postStr = postStr + '&';  
	pars.bottom.style = $('#' + interfaceType + '_' + 'bottom' + '_' + 'span' + '_' + 'style' ).text();
	postStr = postStr + 'bottom_style=' + pars.bottom.style + '&';
  var container = pars.bottom.container;
  var i;
  postStr = postStr + 'bottom_container=';
  for(i=0;i<=container.length-1;i++)
  {
  	if(i <= container.length-1)
  	postStr = postStr + container[i] + ';';
  	else
  	postStr = postStr + container[i];
  }  
  //alert(postStr);
	ajaxHandler.serverPostCall('ajax_handler.php','saveLayout','',postStr,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/]*/);
	alert(loc.getString('msg',91));
 }
 
 function create_preview()
 {
  var appl=$('#active_application_id').text().replace(/\s*/g,'');
 	var pagina = "preview";
 	var layoutPage = $('#Pagine option:selected').text();
 	var layout = dijit.byId('html_tags__12').selectedChildWidget.domNode.id;
 	var op = $('#Op').val().replace(/\s*/g,'');
 	var num = $('#Num').val().replace(/\s*/g,'');
 	var shortName = $('#ShortName').val().replace(/\s*/g,'');
 	if(num=='')
 	 num='0';
 	
 	var layoutFileName = $('#Layouts').val().replace(/\s*/g,'');
 	layoutFileNameItems = layoutFileName.split('.');
 	if(layoutFileNameItems.length==2)
 	 layoutSuffix = '.' + layoutFileNameItems[1];
 	else
 	 layoutSuffix = ''; 
 	
 	if(shortName=='')
   var intr= appl + '!' + layoutPage + '!' + layout + '!' + op + '!' + num + layoutSuffix;
  else
   var intr=shortName;
   
  var crEnabled;
  var dojoEnabled;
  var jqueryEnabled;
  var dataPageEnabled;
  
  crEnabled = 1;
  ajaxHandler.synServerCall('ajax_handler.php','dojoInPreview','','text',/[.]*\w[.]*/);
  var result = ajaxHandler.getOpByName('dojoInPreview').result;
  
  console.log(result);
  
  if(result=='true')
   var dojoEnabled = 1;
  else
   var dojoEnabled = 0;
  
  jqueryEnabled = 1;
  dataPageEnabled = 1;

  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled ;
  ajaxHandler.synServerCall('ajax_handler.php','createLayoutPreview',intr,'text',/CDATA/);
  return false;

}

function layouts_onChange(actObj)
{
	var layout = $(actObj).find('option:selected').text();
	if(layout.replace(/\s*/g,'')=='')
	{
	 $('#Op').val('');
	 $('#Num').val('0');
	 return false;
	} 
	var layoutItems = layout.split('!');
  if(layoutItems.length==1)
  {
   $('#ShortName').val(layout);
   $('#checkBox_IFreeName').get(0).checked=true;
   ajaxHandler.synServerCall('ajax_handler.php',
   'getFreeInterfaceCanonicalName',layout,'text',/[.]*\w[.]*/);
   var intName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
   var layoutItems = intName.split('!');
  }
 else
  {
	 $('#ShortName').val('');
	 $('#checkBox_IFreeName').get(0).checked = false;
  }
	$('#Op').val(layoutItems[3]);
	var layoutItems4Items = layoutItems[4].split('.');
	if(layoutItems4Items.length==2)
	 layoutItems4 = layoutItems4Items[0];
	else
		layoutItems4 = layoutItems[4];	
	$('#Num').val(layoutItems4);
	var ids = layout;
	ajaxHandler.synServerCall('ajax_handler.php','getLayout',ids,'xml',/CDATA/);	
	return true;
}