// Necessita dojo.js e jQuery.js, OpLocalization, ajaxHandler_jQuery.js

var tables = function(){
	
 var inputTables=[];	
 	
 return {
// 
// Metodo getter della proprietà privata inputTables
//
 	"getInputTables":function()
 	{
 		return inputTables;
 	},
//
// Metodo setter della proprietà privata inputTables
//
 	"setInputTables":function(actInputTables)
 	{
 		inputTables = actInputTables;
 	},
//
// Inizializza la proprietà privata inputTables leggendo il nome delle tabelle dal combo box "Lista_tabelle".
//
 	"initInputTables":function()
 	{
   var k=0;
   var inputTables=[];
   // La successiva istruzione utilizza 'option:not(:selected)' perchè la voce selezionata è sempre vuota.
   $('select#Lista_tabelle option:not(:selected)').each(function() 
 	  { 
 	   var table=$(this).text();
 	   inputTables[k++]=table; 
 	  }); 
 	 this.setInputTables(inputTables);
 	},
//
// Imposta la proprietà privata inputTables al valore delle tabelle esistenti (contenute nel combobox "Lista_tabelle") tralasciando le voci nulle e includendo quelle nuove aggiunte. 
//
 	"setExistingInputTables":function()
 	{
   var inputTables=[];
   var k=0;
   $('select#Lista_tabelle option:not(:selected)').each(function() 
 	  { 
 	   var table=$(this).text();
     if((table!='') && ($(this).data('new_table_name')=='*'))
 	    inputTables[k++]=table; 
 	  });
 	 this.setInputTables(inputTables); 
 	},
//
// Cancella tutti i controlli che mostrano le relazioni 1N.
//
	"remove1NRelationsControls":function(actXmlMsg)
	{
     var spanChilds = $('#html_tags__2 .tables');
     $('#html_tags__2 .tables').each(function(){
     var itemId = this.id;
     dijit.byId('checkBox_1N_id_' + itemId).destroyRecursive();
     dijit.byId('keyField_id_' + itemId).destroyRecursive();
     dijit.byId('button_id_' + itemId).destroyRecursive();
     });
     spanChilds.remove();
     var divChilds = $('#html_tags__2 > div');
     divChilds.remove();		
	},
//
// Cancella tutti i controlli che mostrano le relazioni MN.
//
	"removeMNRelationsControls":function(actXmlMsg)
    {
     var inputChilds = $('#html_tags__3 > input');
     var spanChilds = $('#html_tags__3 > span');
     var sepChilds = $('#html_tags__3 > br');
     inputChilds.remove();
     spanChilds.remove();
     sepChilds.remove();
    },	
//
// Cancella i controlli che mostrano le relazioni 1N e poi li ricrea impostando i checkbox sulla tabella selezionata in "Lista_tabelle".
//
 	"get1NRelations":function(actXmlMsg)
 	{
 	 var inputTables = this.getInputTables();
 	 var num1 = inputTables.length;
 	 if(actXmlMsg !== null) 
 	 {
 	  var rootEl = actXmlMsg.documentElement;
 	  var childs = rootEl.childNodes;
 	  var len = rootEl.childNodes.length;
    this.remove1NRelationsControls();
    for(var j=0;j<=num1-1;j++)
    { 
// 
// Da implementare: escludere dal ciclo le tabelle linkTables    	
//    	  	
     if(inputTables[j] != '') 
     {
     	$('#html_tags__2').append('<div style=\"float:left;color:black;border:1px dotted white;margin-left:5px;\" id="container_id_'
     	 + inputTables[j] + '"></div>');
      $('#container_id_' + inputTables[j]).append('<input id=checkBox_1N_id_' + 
       inputTables[j] + ' type=checkbox></input>');
        var checkBox = new dijit.form.CheckBox({
            name: 'checkBox_1_' + inputTables[j],
            value: '',
            onClick:checkBox_1N_onClick
        },
        'checkBox_1N_id_' + inputTables[j]);
         var dialog = new dijit.TooltipDialog({
            content: '<label style="color:black;" for="name">Key:</label>' +
            ' <input dojoType="dijit.form.TextBox" id="keyField_id_' + 
            inputTables[j] + '" onChange="input_keyField_onChange(this);">' +
            '</input><br>' + 
            '<button dojoType="dijit.form.Button" type="submit">Save</button>'
        });
        var button = new dijit.form.DropDownButton({
            label: 'Key',
            dropDown: dialog,
            id:'button_id_' + inputTables[j]
        });
        dojo.byId('container_id_' + inputTables[j]).appendChild(button.domNode);
        $('#container_id_' + inputTables[j]).data('keyField','');
      for(var k=0;k<=len-1;k++)
      {
       if((childs[k].childNodes[0]!=undefined)&&
       (inputTables[j]==childs[k].childNodes[0].nodeValue))
       {
        var ids = $('#Lista_tabelle option:selected').val();
       	dijit.byId('checkBox_1N_id_' + inputTables[j]).set('checked',true);
       	ajaxHandler.synServerCall('ajax_handler.php','getExtKeyFieldsProps',ids,'xml',/CDATA/);
       	var extKeyFieldsItems = ajaxHandler.getOpByName('getExtKeyFieldsProps').result;
       	var len1 = extKeyFieldsItems[0].length;
       	for(l=0;l<=len1-1;l++)
       	{
       	 var extKeyTable = extKeyFieldsItems[0][l];
       	 if(extKeyTable == inputTables[j])
       	 {
       	 	var extKeyField = extKeyFieldsItems[1][l];
       	 	dijit.byId('keyField_id_' + inputTables[j]).set('value',extKeyField);
       	  break; 
       	 }
       	}
       	$('#container_id_' + inputTables[j]).data('keyField',extKeyField);
       } 
      }
      $('#container_id_' + 
      inputTables[j]).append('<span class="tables" id="' + inputTables[j] + '" style="color:white;">' + 
      inputTables[j] + '</span>');
     }
    }
   }
  },
//
// Cancella i controlli che mostrano le relazioni MN e poi li ricrea impostando i checkbox sulla tabella selezionata in "Lista_tabelle".
//
 	"getMNRelations":function(actXmlMsg)
 	{
 	 var inputTables = this.getInputTables();
 	 var num1 = inputTables.length;
 	 if(actXmlMsg !== null) 
 	 {
 	  var rootEl = actXmlMsg.documentElement;
 	  var childs = rootEl.childNodes;
 	  var len = rootEl.childNodes.length;
    this.removeMNRelationsControls();
    for(var j=0;j<=num1-1;j++)
    { 
// 
// Da implementare: escludere dal ciclo le tabelle linkTables    	
//  
     if(inputTables[j] != '') 
     {
      $('#html_tags__3').append('<input id=checkBox_2_id_' + inputTables[j] + ' type=checkbox></input>');
      var inputEl=$('#checkBox_2_id_' + inputTables[j]);
      inputEl.bind('click',checkBox_MN_onClick);
      for(var k=0;k<=len-1;k++)
      {
       if((childs[k].childNodes[0]!=undefined)&&(inputTables[j]==childs[k].childNodes[0].nodeValue))
       {
        inputEl.get(0).checked=true;
        var inputElId = 'checkBox_2_id_' + inputTables[j];
        var targetTable = inputTables[j];
        var mainTable = $('select#Lista_tabelle option:selected').text();
        var ids = mainTable + ';' + targetTable;
        ajaxHandler.synServerCall('ajax_handler.php','checkIfExistMNRelationLinkTable',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
        var linkTableName = ajaxHandler.getOpByName('checkIfExistMNRelationLinkTable').testResult;  
        if (linkTableName != 'true') 
        {
          var msg = loc.getString('msg',25) + linkTableName;
          new dijit.Tooltip({connectId:inputElId,
          label:msg,position:'above'}) 
        }   
       }
      }
      $('#html_tags__3').append('<span class="tables">' + inputTables[j] + '</span>');
     }
    }
   }
	},
//
// Salva la tabella selezionata nel combo box "Lista_tabelle" aggiornando i file xml/php di configurazione (fra cui i binds).  
// Aggiorna i nomi delle altre tabelle (qualora siano cambiate).
//
 "save_tables":function(actXmlMsg)
 {
 var idsNum = $('#Lista_tabelle option').size();
 if(($('select#Lista_tabelle option[value=0]').text()=='')&&(idsNum<=1))
 {
  alert(loc.getString('msg',10));
  return false;
 }
 var ids='';
 if($('select#Lista_tabelle option[value=' + (idsNum-1) + ']').text()=='')
 {
  idsNum=idsNum-1;
 }
 var breakFlag=false;
 $('#html_tags__2 .tables').each(function()
 {
	var val = dijit.byId('keyField_id_' + $(this).text()).get('value');
	var checked = dijit.byId('checkBox_1N_id_' + $(this).text()).get('checked');
	if(checked && (val==''))
	{
		alert(loc.getString('msg',62) + $(this).text());
		breakFlag=true;
		return;
	}
 });
 if(breakFlag)
  return false;
 for(var i=0;i<=idsNum-1;i++)
 {
  console.log($('select#Lista_tabelle option[value=' + i + ']').text());
  ids = ids + $('select#Lista_tabelle option[value=' + i + ']').text() + ';';
 }
 var selTableName=$('select#Lista_tabelle option:selected').text();
 var findTableOrAliasUsed=false; 
 var buffer_1 = new Array();
 $('select#Lista_tabelle option').each(function(){
 	var oldName=$(this).data('table_name');
 	var newName=$(this).data('new_table_name');
 	if((oldName!==undefined) && (newName != '*') && (newName != '') && (newName!=oldName))
 	{
// Cambio nome alla tabella e rinomino tutti gli oggetti associati
 	 var ids = oldName + ';' + newName;
 	 ajaxHandler.synServerCall('ajax_handler.php','renameAllItems',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	 $(this).data('table_name',newName);
 	 $(this).data('new_table_name','*')
 	}
 	else if((newName=='')&&(newName!=oldName))
 	{
// Se la tabella è da cancellare controllo se il nodo di database associato è in uso. Se si, termino.
 	 var ids = oldName;
 	 ajaxHandler.synServerCall('ajax_handler.php','checkIfNodeIsUsed',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
 	 if(ajaxHandler.getOpByName('checkIfNodeIsUsed').testResult=='true')
 	 {
 	 	alert(loc.getString('msg',69));
 	  findTableOrAliasUsed=true;
 	  return false;	
 	 }
// Salvo il nome della tabella in un buffer.
	 buffer_1.push(oldName);
 	}
 });
 if(! findTableOrAliasUsed)
 {
  ajaxHandler.synServerCall('ajax_handler.php','setDbObjsDefProps',ids,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  ajaxHandler.synServerCall('ajax_handler.php','updateBinds','','text',/[\s\._\:A-Za-z0-9;\-]*/);
 // ajaxHandler.synServerCall('ajax_handler.php','createDbStruct','','text',/[\s\._\:A-Za-z0-9;\-]*/);
// Reimposta tutti i campi per ogni tabella, inizializza i campi per le tabelle nuove o rinominate, cancella i campi delle tabelle cancellate.
  ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefAllFieldsProps','','text',/[\s\._\:A-Za-z0-9;\-]*/); 
  var num = buffer_1.length;
  var deleted_tables = buffer_1[0];
  for(i=1;i<=num-1;i++)
  {
	deleted_tables += ';' + buffer_1[i];
  }
  //console.log('WWW1');
  ajaxHandler.synServerCall('ajax_handler.php','deleteRelationsDefs',deleted_tables,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  //console.log('WWWW2');
  if(selTableName != '')
  {  
   var ids=selTableName + ';';
   $('#html_tags__2 .tables').each(
   function(index){
  	var itemId = $(this).text();
    var checked = dijit.byId('checkBox_1N_id_' + itemId).get('checked');
    if(checked)	
    ids = ids + $(this).text() + ';';}
   );
// Imposta le relazioni 1N indicate nei check box, per la tabella selezionata nel combo box 'Lista_tabelle'.
   //alert("VVVV");
   ajaxHandler.synServerCall('ajax_handler.php','set1NRelationsDefinitionProps',ids,'text',/[\s\._\:A-Za-z;\-0-9]*/);
   //alert("WWWW");
   var selTablePos = $('select#Lista_tabelle option:selected').val();
   var ids1=selTablePos + ';';
   $('#html_tags__2 .tables').each(
   function(index){
  	var itemId =$(this).text();
    var checked = dijit.byId('checkBox_1N_id_' + itemId).get('checked');
    if(checked)	
  	ids1 = ids1 + $(this).text() + ':';
   }
   );
  
   ids1 = ids1 + ';';
   $('#html_tags__2 .tables').each(
   function(index){
  	var itemId =$(this).text();
  	var checked = dijit.byId('checkBox_1N_id_' + itemId).get('checked');
    if(checked)	
    {
     var keyField = dijit.byId('keyField_id_' + itemId).get('value');
  	 ids1 = ids1 + keyField + ':';
  	 ids2 = ids2 + ';' + keyField;
  	}
   }
   );
   // Rigenera i campi per la tabella selezionata (senza considerare i campi che possono essere diventati chiavi esterne).
   ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefWithoutExtKeys',selTablePos,'text',/[\s\._\:A-Za-z;\-0-9]*/);  
   // Imposta i campi chiave esterne per la tabella selezionata.
   ajaxHandler.synServerCall('ajax_handler.php','setFieldsDefExtKeyFieldsProps',ids1,'text',/[\s\._\:A-Za-z;\-0-9]*/);
   // Rigenera la lista di tutti i campi con le chiavi esterne per la tabella selezionata (perchè in fields_definition_def la lista dei 
   // campi comprende anche le chiavi esterne).
   ajaxHandler.synServerCall('ajax_handler.php','setFieldsDef',selTablePos,'text',/[\s\._\:A-Za-z;\-0-9]*/);


   var ids3=selTablePos;
   ajaxHandler.synServerCall('ajax_handler.php','getFieldsDefProps',ids3,'xml',/CDATA/);  
   var fields = ajaxHandler.getOpByName('getFieldsDefProps').result;
   var ids2 = selTablePos + ';' + fields[0];
   for(var ind in fields)
   {
  	if(ind!=0)
  	 ids2 = ids2 + ';' + fields[ind];
   }

   ajaxHandler.synServerCall('ajax_handler.php','setFieldsConstsDef',ids2,'text',/[\s\._\:A-Za-z;\-0-9]*/);
   
   var ids4=selTableName + ';';
   $('#html_tags__3 > input:checked + span').each(
     function(index)
     {
     ids4 = ids4 + $(this).text() + ';';
     }
   );
   ajaxHandler.synServerCall('ajax_handler.php','setMNRelationsDefinitionProps',ids4,'text',/[\s\._\:A-Za-z;\-0-9]*/);
  }
 }	
  // ajaxHandler.synServerCall('ajax_handler.php','fixDbXmlFiles','','text',/[\s\._\:A-Za-z0-9;\-]*/);
  // window.location.reload();
 alert('Modifica completata');
 return true;

 }
}
}();