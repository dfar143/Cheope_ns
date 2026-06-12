function form_inserimento_1_reset_button_onClick()
{
 window.location.reload();
 //alert(loc.getString('msg',91));
}

function input_keyField_onChange(actObj)
{
	var ct=0;
	var newVal = actObj.value.replace(/\s*/g,'');
	var idItems = actObj.id.split('_');
 	var tableName = idItems[2];
 	for(var l=3;l<=idItems.length-1;l++)
 	 tableName = tableName + '_' + idItems[l];
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((newVal.match(regExp) === null)&&(newVal !=''))
  {
 	 alert(loc.getString('msg',45));
   dijit.byId('keyField_id_' + tableName).set('value','');
 	 return false;
  } 
  dijit.byId('keyField_id_' + tableName).set('value',newVal);
	var table;
	var id = actObj.id;
	var breakFlag=false;
	$('#html_tags__2 .tables').each(function()
	{
		var val = dijit.byId('keyField_id_' + $(this).text()).get('value');
		if((newVal==val)&&(val!=''))
		 ct++;
		if(ct>1)
		{
			breakFlag=true;
			return false;
		} 
	}
	);
	if(breakFlag)
	{
	 alert(loc.getString('msg',9));
	 dijit.byId('keyField_id_' + tableName).set('value','');
  }
  ajaxHandler.synServerCall('ajax_handler.php','getPkKeyByTableName',tableName,'text',/[.]*\w[.]*/);
  var res = ajaxHandler.getOpByName('getPkKeyByTableName').result;
  if((res !== newVal)&&(newVal !== ''))
  {
	alert(loc.getString('msg',90));
	dijit.byId('keyField_id_' + tableName).set('value',res);
	return false;
  }
  else if ((res !== newVal)&&(newVal == ''))
  {
	dijit.byId('keyField_id_' + tableName).set('value',newVal);
	return false;
  }
  var ids = $('select#Lista_tabelle').val();
  ajaxHandler.synServerCall('ajax_handler.php','getFieldsDefProps',ids,'xml',/[.]*\w[.]*/);
  var fields = ajaxHandler.getOpByName('getFieldsDefProps').result;
  for (var ind in fields)
  {
  	if(fields[ind]==newVal)
  	{
	   alert(loc.getString('msg',9));
	   $('#' + id).get(0).value='';
	   return false;
	  }
  }
}

function checkBox_1N_onClick()
{
 	  if(this.checked) 
 	  {
 	   var thisInputChild = this; 
 	   var id = this.id;
 	   var idItems = id.split('_');
 	   var tableName = idItems[3];
 	   for(var l=4;l<=idItems.length-1;l++)
 	    tableName = tableName + '_' + idItems[l];
 	   var breakFlag=false;
     $('#html_tags__3 input[type="checkbox"]').each(function(){
      var inputChild = this; 
 	    inputChildTableName = $(this).next().text();
      if((tableName == inputChildTableName)&&(inputChild.checked))
      {
       alert(loc.getString('msg',29));
       thisInputChild.checked=false;
       breakFlag=true;
       return;
      }
     });
     if(breakFlag)
      return false;
     var targetTable = tableName;
     var mainTable = $('select#Lista_tabelle option:selected').text();
     var ids = mainTable + ';' + targetTable;
     ajaxHandler.synServerCall('ajax_handler.php','checkIfIs1NRelationFatherOf',ids,'text',/[.]*\w[.]*/);   
     if (ajaxHandler.getOpByName('checkIfIs1NRelationFatherOf').testResult == 'true')
     {
       alert(mainTable + loc.getString('msg',27) + targetTable + loc.getString('msg',28) + 
       targetTable + '.');
       this.checked=false;
     }
 	  }
 }
 
function checkBox_MN_onClick()
{
	  var idItems = this.id.split('_');
 	  var tableName = idItems[3];
 	  for(var l=4;l<=idItems.length-1;l++)
 	   tableName = tableName + '_' + idItems[l];
 	  if(this.checked) 
 	  {
 	   var thisInputChild = this; 
 	   var id = this.id;
 	   var breakFlag=false;
     $('#html_tags__2 .tables').each(function(){
     var spanChild = this; 
     var spanTableName=this.id;
     var inputChild = dijit.byId('checkBox_1N_id_' + spanTableName);
     if((tableName == spanTableName)&&(inputChild.get('checked')))
     {
       alert(loc.getString('msg',26));
       thisInputChild.checked=false;
       breakFlag=true;
       return;
     }
     });
     if(breakFlag)
      return false;
     var targetTable = tableName;
     var mainTable = $('select#Lista_tabelle option:selected').text();
     var ids = mainTable + ';' + targetTable;
     ajaxHandler.synServerCall('ajax_handler.php','checkIfIs1NRelationFatherOf',ids,'text',/[.]*\w[.]*/);
     if (ajaxHandler.getOpByName('checkIfIs1NRelationFatherOf').testResult == 'true') 
     { 
      alert(mainTable + loc.getString('msg',27) + targetTable + loc.getString('msg',28) + 
      targetTable + '.');
      this.checked=false;
     }
    }
 	 }
 
function form_inserimento_1_nuova_tabella_onChange(actObj)
{		
 var selTab = util.ucFirst(actObj.value.replace(/\s*/g,''));
 var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
 if((selTab.match(regExp) === null)&&(selTab !=''))
 {
 	alert(loc.getString('msg',45));
  actObj.value='';
 	return false;
 }
 if(selTab != '')
 if((util.testTextInComboLabels('Lista_tabelle',selTab))&&
 ($('#Lista_tabelle option:selected').text() != selTab))
 {
  alert(loc.getString('msg',9));
  actObj.value='';
  return false;
 } 
 ajaxHandler.synServerCall('ajax_handler.php','getNodeType',selTab,'text',/[.]*\w[.]*/);
 var typeText = ajaxHandler.getOpByName('getNodeType').result; 
 if(typeText=='Query')
 {
 	alert(loc.getString('msg',53));
 	actObj.value='';
 	return false;
 }
 else if(typeText=='Alias')
 {
 	alert(loc.getString('msg',54));
 	actObj.value='';
 	return false;
 }
 else if(typeText=='Bind')
 {
 	alert(loc.getString('msg',71));
 	actObj.value = '';
 	return false;
 } 

 var oldTab = $('select#Lista_tabelle option:selected').text();
 
 var ids = oldTab;
 ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',ids,'text',/[.]*\w[\.]*/);
 if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
 {
 	alert(loc.getString('msg',69));
 	return false;	
 }
 
 $('select#Lista_tabelle option:selected').data('new_table_name',selTab);  	
 $('select#Lista_tabelle option:selected').text(selTab);
 
 if(selTab=='')
 {
 	ajaxHandler.synServerCall('ajax_handler.php','checkIfIsInRelation',oldTab,'text',/[.]*\w[.]*/);
 	if(ajaxHandler.getOpByName('checkIfIsInRelation').testResult=='true')
 	{
 		alert(loc.getString('msg',20));
 		$('select#Lista_tabelle option:selected').text(oldTab);
 		return false;
 	}
 }
// window.location.reload();
 form_inserimento_1_submit_button_onClick();
 window.location.reload();
// form_inserimento_1_lista_tabelle_onChange($('select#Lista_tabelle').get(0));
}

function form_inserimento_1_lista_tabelle_onChange(actObj)
{
   var tableName = $(actObj).find('option:selected').text();
   tables.remove1NRelationsControls();
   tables.removeMNRelationsControls();
   if(tableName != '')
   { 
    var numVociNull=0;
    $('select#Lista_tabelle option').each(function(index){if($(this).text()=='')numVociNull++});
    if(numVociNull==0)
    {
     var num= $('select#Lista_tabelle option').size();
     $('select#Lista_tabelle option:last').after('<option value="' + num + '"></option>');   
    }
    var ids = tableName;
 	  ajaxHandler.synServerCall('ajax_handler.php','checkIfTableExists',tableName,'text',/[.]*\w[.]*/);
 	  if(ajaxHandler.getOpByName('checkIfTableExists').testResult=='true')
 	  {
     tables.setExistingInputTables();
     ajaxHandler.synServerCall('ajax_handler.php','get1NRelations',ids,'xml',/[.]*\w[.]*/);
     ajaxHandler.synServerCall('ajax_handler.php','getMNRelations',ids,'xml',/[.]*\w[.]*/);
    }
    else
    {
     tables.setExistingInputTables();
     var inputTables = tables.getInputTables();
     var num1 = inputTables.length;
     for(var j=0;j<=num1-1;j++)
     {
// 
// Da implementare: escludere dal ciclo le tabelle linkTables    	
//   
//      if(inputTables[j] != '') 
//      {     
       $('#html_tags__2').append('<div style=\"float:left;color:black;border:1px dotted white;margin-left:5px;\" id="container_id_'
     	 + inputTables[j] + '"></div>');
       $('#container_id_' + inputTables[j]).append('<input id=checkBox_1N_id_' + 
       inputTables[j] + ' type=checkbox></input>');
       var checkBox = new dijit.form.CheckBox({
            name: "checkBox_1_" + inputTables[j],
            value: "",
            onclick:checkBox_1N_onClick
        },
        "checkBox_1N_id_" + inputTables[j]);
       var dialog = new dijit.TooltipDialog({
            content: '<label style="color:black;" for="name">Key:</label>' +
            ' <input dojoType="dijit.form.TextBox" id="keyField_id_' + 
            inputTables[j] + '" onChange="input_keyField_onChange(this);">' +
            '</input><br>' +  
            '<button dojoType="dijit.form.Button" type="submit">Save</button>'
        });
       var button = new dijit.form.DropDownButton({
            label: "Key",
            dropDown: dialog,
            id:'button_id_' + inputTables[j]
        });
       dojo.byId('container_id_' + inputTables[j]).appendChild(button.domNode);
        $('#container_id_' + inputTables[j]).append('<span class="tables" id="' + 
        inputTables[j] + '" style="color:white;">' + 
        inputTables[j] + '</span>');
     
       $('#html_tags__3').append('<input id="checkBox_2_id_' + inputTables[j] +
      '" type="checkbox"></input>');
       $('#html_tags__3').append('<span class="tables">' + inputTables[j] + '</span>');
//      }
     }
    }  
   }

}

function form_inserimento_1_submit_button_onClick()
{
 return tables.save_tables();

}

function button_2_onClick(actObj)
{
 subModal.showPopWin('view_all_tables.php',500,400,function(actVar){$('#form_2__1_reset_button_id').get(0).onclick();},true);
}

function button_3_onClick(actObj)
{
 subModal.showPopWin('view_all_relations.php',500,400,function(actVar){},true);
}

function button_4_onClick(actObj)
{
 var nodeName = $('#Lista_tabelle option:selected').text();
 var popWinPage = 'view_all_bound_interfaces.php' + '?Node=' + nodeName;  
 subModal.showPopWin(popWinPage,600,400,function(actVar){},true);
}

function form_inserimento_1_button_aliases_onClick()
{
 var tablePos = $('select#Lista_tabelle option:selected').val();
 var tableName = $('select#Lista_tabelle option:selected').text();
 if(tableName != '')
 {
 	 ajaxHandler.synServerCall('ajax_handler.php','checkIfTableExists',tableName,'text',/true/);
 	 if(ajaxHandler.getOpByName('checkIfTableExists').testResult=='true')
    subModal.showPopWin('view_all_aliases.php?Par=' + tablePos,500,400,function(actVar){},true);
   else
   	alert(loc.getString('msg',58));
 }
 else
 	alert(loc.getString('msg',10));
}

function display_exec_confirm_dialog(actObj)
{
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        "Continue": function() {
        	actObj.testResult='true';
          $( this ).dialog( "close" );       
        },
        Cancel: function() {
        	actObj.testResult='false';
          $( this ).dialog( "close" );
        }
      }
    });
  });
 }