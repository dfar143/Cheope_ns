 
 function checkIfIsInCandidates(actTable,actField)
 {
 	ajaxHandler.synServerCall('ajax_handler.php','getCandKeyFieldsProps',actTable,'xml');
 	var candKeys = ajaxHandler.getOpByName('getCandKeyFieldsProps').result;
  for(var ind in candKeys)
  {
  	if(actField==candKeys[ind])
  	 return true;
  }
 	return false;
 }
 
 function button_1_onClick(actObj,actPos)
 {
 	var inputFieldVal = util.ucFirst(($('#input_field_id').val().toLowerCase()));
 	if(inputFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',36));
   return false;
 	} 
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(inputFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
   $('#input_field_id').focus();
 	 return false;
  }
 	var found=false;
 	$('#fields_table input').each(function(){if(this.value==inputFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 return false;
  }
 	var ids=actPos + ';' + inputFieldVal;
  ajaxHandler.synServerCall('ajax_handler.php','checkIfIsSuitableField',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/); 
  if(ajaxHandler.getOpByName('checkIfIsSuitableField').testResult == 'false')
  {
   alert(loc.getString('msg',32));
   return false;
  } 	
	
 	var typeText = $('#type_field_id option:selected').text(); 
  dndSource.insertNodes(false,[{fieldName:inputFieldVal,fieldType:typeText}]);
  dndSource.sync();
  var num = $('#fields_table > tbody > tr').size()-1;
  var currentTypeId = 'Type_id_' + num;
  var pMenu = new dijit.Menu({targetNodeIds: [currentTypeId]});
  pMenu.addChild(new dijit.MenuItem({label: 'BIG_STRING',
  onClick:function(){$('#' + currentTypeId).text('BIG_STRING');}})); 
  pMenu.addChild(new dijit.MenuItem({label: 'BOOLEAN',
  onClick:function(){$('#' + currentTypeId).text('BOOLEAN');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'DATE',
  onClick:function(){$('#' + currentTypeId).text('DATE');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'FLOAT',
  onClick:function(){$('#' + currentTypeId).text('FLOAT');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'INTEGER',
  onClick:function(){$('#' + currentTypeId).text('INTEGER');}}));
  pMenu.addChild(new dijit.MenuItem({label: 'STRING',
  onClick:function(){$('#' + currentTypeId).text('STRING');}}));
  pMenu.startup(); 
  var currentSpanId = 'Pk_id_' + num;
  var currentObj = $('#' + currentSpanId);
  var pMenu = new dijit.Menu({targetNodeIds: [currentSpanId]});
  pMenu.addChild(new dijit.MenuItem({
  label: 'set_unset_pk',onClick:function(){
  var currentCount = num;
  var spanPk = currentObj.text();
  if(spanPk.replace(/\s*/g,'')=='---')
  {
   $('#' + currentSpanId).text('PK');
   $('#fields_table span').each(function(){var currentObj=$(this);
   if(currentObj.get(0).id != currentSpanId){currentObj.text('---');}});
  }
  else
  { 
   currentObj.text('---');
  };
  }}
  )); 
  pMenu.startup();   
 }
 
 function button_2_onClick(actObj,actPos)
 {
  var ids = actPos;
  var selectCtrl1 = window.parent.document.getElementById('Lista_tabelle');
  var selectCtrl2 = window.parent.document.getElementById('html_tags__2_lista_tabelle_0');
  var selectCtrlOptions1 = selectCtrl1.options;
  var selectCtrlOptions2 = selectCtrl2.options;  
  var ids2 = selectCtrlOptions1[selectCtrl1.selectedIndex].value + '';
  var fieldsNum = $('#fields_table > tbody > tr').size()-1;
  var pkPos='';
  var pkKey='';
  $('#fields_table span').each(
  function(){
  	if($(this).text()=='PK')
  	{
  	 pkPos=this.id.split('_')[2];
  	 pkKey=$('#Name_id_' + pkPos).val();
  	}
  	});
	
	//console.log(pkPos);
	//console.log(pkKey);
	//return false;
	
  	if(pkPos!=='')
  	{
  		$('#fields_table input').each(function()
  		{
  		 var field=$(this).val().replace(/\s*/g,'');
  		 var pos = this.id.split('_')[2];
       ids = ids + ';' + field + ';' + 
       $('#Type_id_' + pos).text().toUpperCase(); 		 
  		});
			
       $('#fields_table input').each(function()
       {
 		 var field=$(this).val().replace(/\s*/g,'');
       ids2 = ids2 + ';' + field;
       });		

 //     var selectCtrl = window.parent.document.getElementById('html_tags__2_lista_tabelle_0 option');
 //     var selectCtrlOptions = window.parent.document.getElementById('html_tags__2_lista_tabelle_0').options;
//	  console.log(selectCtrlOptions);

      var num = selectCtrlOptions2.length;
      for(var i=0;i<=num-1;i++)
      {
	   var option = selectCtrlOptions2[i];
 	   var field = window.parent.$(option).data('keyField');
 	   if(($(option).text()!='') && (! (field=='')))
 	   { 
 		ids2 = ids2 + ';' + field;
       }
      };
	   
	   //console.log(ids2);
	   
     ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefFieldsProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
	 ajaxHandler.synServerCall('ajax_handler.php','setFieldsConstsDef',ids2,'text',/[\s\._\:A-Za-z0-9;\-]*/);
     ids = actPos + ';' + pkKey;
     //alert(ids); 
     ajaxHandler.synServerCall('ajax_handler.php','setPk',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  	}
    else
    {
     alert(loc.getString('msg',34));
     return false;
    }
	 alert(loc.getString('msg',91));
  }