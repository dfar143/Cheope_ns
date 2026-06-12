function button_1_onClick()
{
var postStr = 'setAllPagesTo=' + 
	encodeURIComponent($('#html_tags__12 option:selected').text()) + '&';
	postStr += 'setAllNodesTo=' + 
	encodeURIComponent($('#html_tags__15 option:selected').text()) + '&';
	var interfacesStr='interfaces=';
	$('#html_tags__8  input[type=text]').each(function(){
		interfacesStr += encodeURIComponent($(this).val()) + ';';
	});
  postStr += interfacesStr +  '&';
  var nodesStr = 'nodes=';
  $('#html_tags__8  select[type=nodo]').each(function(){
  	nodesStr += encodeURIComponent($(this).val()) + ';';
  	});
  postStr += nodesStr + '&';
  var pagesStr = 'pages=';
  $('#html_tags__8  select[type=pagina]').each(function(){
  	pagesStr += encodeURIComponent($(this).val()) + ';';
  	});
  postStr += pagesStr + '&';
  var oldInterfacesStr = 'oldInterfaces=';
  $('#html_tags__8  input[type=hidden]').each(function(){
  	oldInterfacesStr += encodeURIComponent($(this).val()) + ';';
  	});
  postStr += oldInterfacesStr + '&';
  var subEveryPage = "subEvery=" + $('#html_tag__0').get(0).checked;
  postStr += subEveryPage + '&';
  var deleteIntStr = 'deleteInts=';
  $('#html_tags__8 input[type=checkbox]').each(function(){
   if(this.checked)
    deleteIntStr += 'true' + ';';
   else
   	deleteIntStr += 'false' + ';'; 
  }); 
  postStr += deleteIntStr + '&';
 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);
 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 postStr  += "oldPage=" + pagePar + '&';
  
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];   
 postStr  += "oldNode=" + nodePar;
 //alert(postStr);
 //return true;
 ajaxHandler.synServerPostCall('ajax_handler.php',
 'setAllCatalogInterfaces','',postStr,'text',/[\s\._\:A-Za-z0-9;\-.\?<>\/]*/);
 $('#html_tags__8').empty(); 
 ajaxHandler.synServerCall('ajax_handler.php',
 'catalogOp2',pagePar + ';' + nodePar,'xml',/[\s\._\:A-Za-z0-9;\-.\?\<>\/]*/);
 var interface = interfacesContainer.getInterface('catalogOp1');
 interface.putData();
 //var selectTag = $('#html_tags__12').get(0);
 //console.log(selectTag);
 util.deleteSelectFieldContents('html_tags__12');
 //var selectTag2 = $('#html_tags__15').get(0);
 util.deleteSelectFieldContents('html_tags__15');
 var interface = interfacesContainer.getInterface('Op2');
 interface.putData();
 var interface = interfacesContainer.getInterface('Op3');
 interface.putData();
 var interface = interfacesContainer.getInterface('Op4');
 interface.putData();
 $('#html_tags__7').hide();
  alert(loc.getString('msg',91));
}

function display_exec_dialog(actInterfaceNew,actPostStr,actPagePar,actNodePar)
{
   fileNewLabel = "Modifica file " + actInterfaceNew;
   $(function(actInterfaceNew) {
	 
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        [fileNewLabel]: function() {
        //alert(postStr);
        //return true;
        ajaxHandler.synServerPostCall('ajax_handler.php',
       'setAllCatalogInterfaces','',actPostStr,'text',/[\s\._\:A-Za-z0-9;\-.\?<>\/]*/);
       $('#html_tags__8').empty(); 
       ajaxHandler.synServerCall('ajax_handler.php',
       'catalogOp2',actPagePar + ';' + actNodePar,'xml',/[\s\._\:A-Za-z0-9;\-.\?\<>\/]*/);
       var interface = interfacesContainer.getInterface('catalogOp1');
       interface.putData();
       //var selectTag = $('#html_tags__12').get(0);
       //console.log(selectTag);
       util.deleteSelectFieldContents('html_tags__12');
       //var selectTag2 = $('#html_tags__15').get(0);
       util.deleteSelectFieldContents('html_tags__15');
       var interface = interfacesContainer.getInterface('Op2');
       interface.putData();
       var interface = interfacesContainer.getInterface('Op3');
       interface.putData();
       var interface = interfacesContainer.getInterface('Op4');
       interface.putData();	
       $('#html_tags__7 input').get(0).checked=false;
       $('#html_tags__7').hide(); 
       alert(loc.getString('msg',91));	   
          $( this ).dialog( "close" );
		   window.location.reload();
         },
        Cancel: function() {

          $( this ).dialog( "close" );
        }
       }
     });
   });

}

function select_4_onChange(actObj)
{
 var page = $('#html_tags__2 option:selected').text();
 var intPage = 'catalog.php';
 var newLocation =  intPage + '?Page=' + page + '&Node=' + actObj.value;
 window.location = newLocation;
}

function select_1_onChange(actObj)
{
 var node = $('#html_tags__5 option:selected').text();
 var intPage = 'catalog.php';
 var newLocation =  intPage + '?Page=' +  actObj.value + '&Node=' + node;
 window.location = newLocation;
}

function select_pagina_id_onChange(actObj)
{
 var i=0;
 var found=false;
 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);

 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 var selectAllPagesStr = $('#html_tags__12').val().replace(/\s*/g,'');
 
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];
 var selectAllNodesStr = $('#html_tags__15').val().replace(/\s*/g,'');

 var page = actObj.value;
 var idItems = actObj.id.split("_");
 var idPos = idItems[2];
 var nodoId = "nodo_id_" + idPos;
 var node = $('#' + nodoId).val();
 var oldInterfaceId = "old_interface_name_" + idPos;
 var interfaceOld = $('#' + oldInterfaceId).val();
 var interfaceOldItems = interfaceOld.split('!');
 if(interfaceOldItems.length == 5)
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" + 
   interfaceOldItems[2] + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4];
 else
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" +
   (node=undefined?'':node) + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4] + "!" + interfaceOldItems[5];  

 ajaxHandler.synServerCall('ajax_handler.php','interfaceExists',interfaceNew,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if(ajaxHandler.getOpByName('interfaceExists').result=='true')
 {  
  alert("Attenzione l'interfaccia " + interfaceNew + " esiste già e verrà sovrascritta.");
 } 
 
 $('#catalog_tbody_id input[type=hidden]').each(function(){	
 if(! found)
 {
 var inputId = 'interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId1 = 'pagina_id_' + i;
 var selectStr1 = $('#' +  selectId1  + ' option:selected').text();
 var selectId2 = 'nodo_id_' + i;
 var selectStr2 = $('#' +  selectId2  + ' option:selected').text();
 var oldIntName = $('#old_interface_name_' + i).val();
 var newIntName = $('#interface_name_id_' + (i++)).val();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr1 != pagePar)||(selectStr2 != nodePar)||(selectAllPagesStr!=pagePar)||(selectAllNodesStr!=nodePar))
 {
  var items = inputVal.split('!');
  if((((items.length==6)||(items.length==5))&&((selectStr1!=pagePar)||(selectAllPagesStr!=pagePar)))
   &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if(((items.length==6)&&((selectStr2!=nodePar)||(selectAllNodesStr!=nodePar)))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if(((items.length==1)&&(oldIntName!=newIntName))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else
   $('#html_tags__7').hide();
  //$('#html_tags__7 input').get(0).checked=false;
 }
 else
  $('#html_tags__7').hide();
 	//$('#html_tags__7 input').get(0).checked=false;
 }
 }
 );
   if(! found)
   {
    $('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
   }
}

function select_nodo_id_onChange(actObj)
{
 var i=0;
 var found=false;

 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);
 
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];
 var selectAllNodesStr = $('#html_tags__15').val().replace(/\s*/g,'');
 
 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 var selectAllPagesStr = $('#html_tags__12').val().replace(/\s*/g,''); 
 
 //alert(actObj.value);
 var node = actObj.value;
 var idItems = actObj.id.split("_");
 var idPos = idItems[2];
 var paginaId = "pagina_id_" + idPos;
 var page = $('#' + paginaId).val();
 var oldInterfaceId = "old_interface_name_" + idPos;
 var interfaceOld = $('#' + oldInterfaceId).val();
 var interfaceOldItems = interfaceOld.split('!');
 if(interfaceOldItems.length == 5)
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" + 
   interfaceOldItems[2] + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4];
 else
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" +
   (node=undefined?'':node) + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4] + "!" + interfaceOldItems[5];  

 ajaxHandler.synServerCall('ajax_handler.php','interfaceExists',interfaceNew,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if(ajaxHandler.getOpByName('interfaceExists').result=='true')
 {  
  alert("Attenzione l'interfaccia " + interfaceNew + " esiste già e verrà sovrascritta.");
 } 
  
 $('#catalog_tbody_id input[type=hidden]').each(function(){	
 if(! found)
 {
 var inputId = 'interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId1 = 'nodo_id_' + i;
 var selectStr1 = $('#' +  selectId1  + ' option:selected').text();
 var selectId2 = 'pagina_id_' + i;
 var selectStr2 = $('#' +  selectId2  + ' option:selected').text();
 var oldIntName = $('#old_interface_name_' + i).val();
 var newIntName = $('#interface_name_id_' + (i++)).val();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr1!=nodePar)||(selectStr2!=pagePar)||(selectAllNodesStr!=nodePar)||(selectAllPagesStr!=pagePar))
 {
  var items = inputVal.split('!');
  if(((items.length==6)&&((selectStr1!=nodePar)||(selectAllNodesStr!=nodePar)))
   &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('AAA');
   found=true;
  }
  else if((((items.length==6)||(items.length==5))&&((selectStr2!=pagePar)||(selectAllPagesStr!=pagePar)))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('BBB');
   found=true;
  }
  else if(((items.length==1)&&(oldIntName!=newIntName))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('CCC');
   found=true;
  }
  else
  {
	$('#html_tags__7').hide();
    //$('#html_tags__7 input').get(0).checked=false;
  }
  }
 else
 {
   $('#html_tags__7').hide();
   //$('#html_tags__7 input').get(0).checked=false;
 }
 }}
 );
   if(! found)
   {
    $('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
   }
}

function display_exec_confirm_dialog(actInterfaceNew)
{
  var interfaceLabel = "Modifica interfaccia " + actInterfaceNew;	
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        [interfaceLabel]: function() {
          $( this ).dialog( "close" );
		  return true;
        },
        Cancel: function() {
          $( this ).dialog( "close" );
		  return false;
        }
      }
    });
  });
}

function select_set_all_pagine_onChange(actObj)
{
 var i=0;
 var found=false;
 /*console.log('Start');
 console.log($('.spin').get(0));*/
 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);
 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 var selectAllPagesStr = $('#html_tags__12').val().replace(/\s*/g,'');
 var thisSelectStr = $(actObj).val();
 
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];
 var selectAllNodesStr = $('#html_tags__15').val().replace(/\s*/g,''); 
 
 var page = actObj.value;
 //console.log(page);
 var node = $('#html_tags__15').val();
 //console.log(node);
 var i=0;
 var interfacesNew=new Array();

 $('#catalog_tbody_id tr').each(function(){
 var interfaceOld = $(this).find('input[type=hidden]').val();
 var interfaceOldItems = interfaceOld.split('!');
 if(interfaceOldItems.length == 5)
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" + 
   interfaceOldItems[2] + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4];
 else
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" +
   (node==undefined?'':node) + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4] + "!" + interfaceOldItems[5];  

 ajaxHandler.synServerCall('ajax_handler.php','interfaceExists',interfaceNew,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if(ajaxHandler.getOpByName('interfaceExists').result=='true')
 {  
  interfacesNew[i++]=interfaceNew;
  }}); 
  
  for (j=0;j<=interfacesNew.length-1;j++)
   alert("Attenzione l'interfaccia " + interfacesNew[j] + " esiste già e verrà sovrascritta."); 
 
 $('#catalog_tbody_id input[type=hidden]').each(function(){	
 
 if(! found)
 {
 var inputId = 'interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId1 = 'pagina_id_' + i;
 var selectId2 = 'nodo_id_' + i;
 var selectStr1 = $('#' +  selectId1  + ' option:selected').text();
 var selectStr2 = $('#' +  selectId2  + ' option:selected').text();
 var oldIntName = $('#old_interface_name_' + i).val();
 var newIntName = $('#interface_name_id_' + (i++)).val();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr1!=pagePar)||(selectStr2!=nodePar)||(selectAllNodesStr!=nodePar)||(selectAllPagesStr!=pagePar))
 {
  var items = inputVal.split('!');
  if((((items.length==6)||(items.length==5))&&((selectStr1!=pagePar)||(thisSelectStr!=pagePar)))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if(((items.length==6)&&((selectStr2!=nodePar)||(selectAllNodesStr!=nodePar)))
  	  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if(((items.length==1)&&(oldIntName!=newIntName))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))	
  {
   $('#html_tags__7').show();
   found=true;
  }
  else
  {
	 //$('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
  }
  // $('#html_tags__7 input').get(0).checked=false;
 }
 else
 {
	// $('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
 }
 //	$('#html_tags__7 input').get(0).checked=false;
 }});
   if(! found)
   {
    $('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
   }
   $('#button_apply').focus();
  // console.log('End');
}

function select_set_all_nodi_onChange(actObj)
{
 var i=0;
 var found=false;
 
 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];
 var selectAllNodesStr = $('#html_tags__15').val().replace(/\s*/g,''); 
 //console.log(selectAllNodesStr);
 var thisSelectStr = $(actObj).val();
 
 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 var selectAllPagesStr = $('#html_tags__12').val().replace(/\s*/g,'');  
 
 var node = actObj.value;
  //console.log(node);
 var page = $('#html_tags__12').val();
  //console.log(page);
 
 var i=0;
 var interfacesNew=new Array();
 $('#catalog_tbody_id tr').each(function(){
 var interfaceOld = $(this).find('input[type=hidden]').val();
 var interfaceOldItems = interfaceOld.split('!');
 if(interfaceOldItems.length == 5)
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" + 
   interfaceOldItems[2] + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4];
 else
   interfaceNew = interfaceOldItems[0] + "!" + (page==undefined?'':page) + "!" +
   (node==undefined?'':node) + "!" + interfaceOldItems[3] + "!" + interfaceOldItems[4] + "!" + interfaceOldItems[5];  

 ajaxHandler.synServerCall('ajax_handler.php','interfaceExists',interfaceNew,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if(ajaxHandler.getOpByName('interfaceExists').result=='true')
 {  
  interfacesNew[i++]=interfaceNew;
  }}); 
  
 for (j=0;j<=interfacesNew.length-1;j++)
   alert("Attenzione l'interfaccia " + interfacesNew[j] + " esiste già e verrà sovrascritta."); 
 
 i=0;
 $('#catalog_tbody_id input[type=hidden]').each(function(){	
 if(! found)
 {
 var inputId = 'interface_name_id_' + i;
 var inputVal = $('#' + inputId).val();
 var selectId1 = 'nodo_id_' + i;
 var selectStr1 = $('#' +  selectId1  + ' option:selected').text();
 var selectId2 = 'pagina_id_' + i;
 var selectStr2 = $('#' +  selectId2  + ' option:selected').text();
 var oldIntName = $('#old_interface_name_' + i).val();
 var newIntName = $('#interface_name_id_' + (i++)).val();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((selectStr1!=nodePar)||(selectStr2!=pagePar)||(thisSelectStr!=nodePar)||(selectAllPagesStr!=pagePar))
 {
  var items = inputVal.split('!');
  if(((items.length==6)&&((selectStr1!=nodePar)||(thisSelectStr!=nodePar)))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if((((items.length==6)||(items.length==5))&&((selectStr2!=pagePar)||(selectAllPagesStr!=pagePar)))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else if(((items.length==1)&&(oldIntName!=newIntName))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   found=true;
  }
  else
  {
	$('#html_tags__7').hide();
   //$('#html_tags__7 input').get(0).checked=false;
  }
 }
 else
 {
  $('#html_tags__7').hide();	 
 //$('#html_tags__7 input').get(0).checked=false;
 }
 }});
   if(! found)
   {
    $('#html_tags__7 input').get(0).checked=false;
	$('#html_tags__7').hide();
   }
   $('#button_apply').focus();
}

function label_edit_onClick(actPos)
{
	var intName = $('#old_interface_name_' + actPos).val();
	if(intName.replace(/\s*/g,'') != '')
 	 subModal.showPopWin('view_interface.php?Par=' + intName,
 	 700,400,function(actVar){},true);
  else
   alert(loc.getString('msg',56));
}

function anteprima_label_onClick(actPos,actActiveApp,actServerName,actDocRoot)
{
	var intName = $('#old_interface_name_' + actPos).val();
	if(intName.replace(/\s*/g,'') != '')
	{  
  var crEnabled = 1;
  var dojoEnabled = 1;
  var jqueryEnabled = 1;
  var dataPageEnabled = 1;

  intr = intName + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled ;
  ajaxHandler.synServerCall('ajax_handler.php','createPreview',intr,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  
  var dirName=actActiveApp;
  if(dirName!='')
    window.open('http://' + actServerName +
   '/' + actDocRoot + '/' + dirName +
   '/' + 'preview.php');
  }
  else
   alert(loc.getString('msg',56));  
  return false;	
}

function interface_onChange(actPos)
{
 var found=false;
 i=0;
 var parsValues = util.getUrlArgsKeyAndValues(window.location.search);
 
 var nodePar='';
 if(parsValues['node']!=undefined) nodePar = parsValues['node'];
 if(parsValues['nodo']!=undefined) nodePar = parsValues['nodo'];
 if(parsValues['Node']!=undefined) nodePar = parsValues['Node'];
 if(parsValues['Nodo']!=undefined) nodePar = parsValues['Nodo'];
 var selectAllNodesStr = $('#html_tags__15').val().replace(/\s*/g,'');
 
 var pagePar='';
 if(parsValues['page']!=undefined) pagePar = parsValues['page'];
 if(parsValues['pagina']!=undefined) pagePar = parsValues['pagina'];
 if(parsValues['Pagina']!=undefined) pagePar = parsValues['Pagina'];
 if(parsValues['Page']!=undefined) pagePar = parsValues['Page'];
 var selectAllPagesStr = $('#html_tags__12').val().replace(/\s*/g,''); 
// var oldIntName = $('#old_interface_name_' + actPos).val();
// var newIntName = $('#interface_name_id_' + actPos).val();
$('#catalog_tbody_id input[type=hidden]').each(function(){	
 if(! found)
 {
 //var inputId = 'interface_name_id_' + i;
 //var inputVal = $('#' + inputId).val();
 var selectId1 = 'nodo_id_' + i;
 var selectStr1 = $('#' +  selectId1  + ' option:selected').text();
 var selectId2 = 'pagina_id_' + i;
 var selectStr2 = $('#' +  selectId2  + ' option:selected').text();
 var oldIntName = $('#old_interface_name_' + i).val();
 var newIntName = $('#interface_name_id_' + (i++)).val();
 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 if((oldIntName!=newIntName)||(selectAllNodesStr!=nodePar)||(selectAllPagesStr!=pagePar))
 {
  var items = newIntName.split('!');
  if((items.length==6)&&(selectAllNodesStr!=nodePar)&&((selectAllNodesStr!=nodePar)||(selectStr1!=nodePar))
  (ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('AAA');
   found=true;
  }
  else if(((items.length==6)||(items.length==5))&&((selectAllPagesStr!=pagePar)||(selectStr2!=pagePar))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('BBB');
   found=true;
  }
  else if(((items.length==1)&&(oldIntName!=newIntName))
  &&(ajaxHandler.getOpByName('isInterfaceBusy').result=='true'))
  {
   $('#html_tags__7').show();
   //console.log('CCC');
   found=true;
  }
  else
  {
	$('#html_tags__7').hide();
    //$('#html_tags__7 input').get(0).checked=false;
  }
  }
 else
 {
   $('#html_tags__7').hide();
   //$('#html_tags__7 input').get(0).checked=false;
 }
 }}
 );
   if(! found)
  $('#html_tags__7 input').get(0).checked=false;

}

function delete_onClick(actPos)
{
	if($('#delete_' + actPos).get(0).checked)
	{
	 var intName = $('#interface_name_id__' + actPos).val();
	 var oldIntName = $('#old_interface_name_' + actPos).val();
	 ajaxHandler.synServerCall('ajax_handler.php','isInterfaceBusy',oldIntName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
	 if(ajaxHandler.getOpByName('isInterfaceBusy').result=='true')
	  alert(loc.getString('msg',74));
  }
}





