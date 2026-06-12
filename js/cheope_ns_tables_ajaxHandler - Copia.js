 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 
 function OpSetDbObjDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
alert('Modifica completata.')};
 }
 
 function OpSetFieldsDefAllFieldsProps(actName)
 {
  this.name = actName;
 	this.exec = function(actXmlMsg){
  alert('Modifica completata.')};
 } 
 
 //
 // inputElsLabels è globale
 // impostato da checkIfTablesExist
 //
 function OpGet1NRelations(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 	 var num1 = inputElsLabels.length;
 	 if(actXmlMsg !== null) 
 	 {
 	  var rootEl = actXmlMsg.documentElement;
 	  var childs = rootEl.childNodes;
 	  var len = rootEl.childNodes.length;
    remove1NRelationsControls();
    for(var j=0;j<=num1-1;j++)
    { 
// 
// Da implementare: escludere dal ciclo le tabelle linkTables    	
//    	  	
     if(inputElsLabels[j] != '') 
     {
     	$('#html_tags__2').append('<div style=\"float:left;color:black;border:1px dotted white;margin-left:5px;\" id="container_id_'
     	 + inputElsLabels[j] + '"></div>');
      $('#container_id_' + inputElsLabels[j]).append('<input id=checkBox_1N_id_' + 
       inputElsLabels[j] + ' type=checkbox></input>');
        var checkBox = new dijit.form.CheckBox({
            name: 'checkBox_1_' + inputElsLabels[j],
            value: '',
            onClick:checkBox_1N_onClick
        },
        'checkBox_1N_id_' + inputElsLabels[j]);
         var dialog = new dijit.TooltipDialog({
            content: '<label style="color:black;" for="name">Key:</label>' +
            ' <input dojoType="dijit.form.TextBox" id="keyField_id_' + 
            inputElsLabels[j] + '" onChange="input_keyField_onChange(this);">' +
            '</input><br>' + 
            '<button dojoType="dijit.form.Button" type="submit">Save</button>'
        });
        var button = new dijit.form.DropDownButton({
            label: 'Key',
            dropDown: dialog,
            id:'button_id_' + inputElsLabels[j]
        });
        dojo.byId('container_id_' + inputElsLabels[j]).appendChild(button.domNode);
        $('#container_id_' + inputElsLabels[j]).data('keyField','');
      for(var k=0;k<=len-1;k++)
      {
       if((childs[k].childNodes[0]!=undefined)&&
       (inputElsLabels[j]==childs[k].childNodes[0].nodeValue))
       {
        var ids = $('#Lista_tabelle option:selected').val();
       	dijit.byId('checkBox_1N_id_' + inputElsLabels[j]).set('checked',true);
       	ajaxHandler.synServerCall('ajax_handler.php','getExtKeyFieldsProps',ids,'xml');
       	var extKeyFieldsItems = ajaxHandler.getOpByName('getExtKeyFieldsProps').result;
       	var len1 = extKeyFieldsItems[0].length;
       	for(l=0;l<=len1-1;l++)
       	{
       	 var extKeyTable = extKeyFieldsItems[0][l];
       	 if(extKeyTable == inputElsLabels[j])
       	 {
       	 	var extKeyField = extKeyFieldsItems[1][l];
       	 	dijit.byId('keyField_id_' + inputElsLabels[j]).set('value',extKeyField);
       	  break; 
       	 }
       	}
       	$('#container_id_' + inputElsLabels[j]).data('keyField',extKeyField);
       } 
      }
      $('#container_id_' + 
      inputElsLabels[j]).append('<span class="tables" id="' + inputElsLabels[j] + '" style="color:white;">' + 
      inputElsLabels[j] + '</span>');
     }
    }
   }
  }
 }
 
 //
 // inputElsLabels è globale
 // impostato da checkIfTablesExist
 //
 function OpGetMNRelations(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 	 var num1 = inputElsLabels.length;
 	 if(actXmlMsg !== null) 
 	 {
 	  var rootEl = actXmlMsg.documentElement;
 	  var childs = rootEl.childNodes;
 	  var len = rootEl.childNodes.length;
    removeMNRelationsControls();
    for(var j=0;j<=num1-1;j++)
    { 
// 
// Da implementare: escludere dal ciclo le tabelle linkTables    	
//  
     if(inputElsLabels[j] != '') 
     {
      $('#html_tags__3').append('<input id=checkBox_2_id_' + inputElsLabels[j] + ' type=checkbox></input>');
      var inputEl=$('#checkBox_2_id_' + inputElsLabels[j]);
      inputEl.bind('click',checkBox_MN_onClick);
      for(var k=0;k<=len-1;k++)
      {
       if((childs[k].childNodes[0]!=undefined)&&(inputElsLabels[j]==childs[k].childNodes[0].nodeValue))
       {
        inputEl.get(0).checked=true;
        var inputElId = 'checkBox_2_id_' + inputElsLabels[j];
        var targetTable = inputElsLabels[j];
        var mainTable = $('select#Lista_tabelle option:selected').text();
        var ids = mainTable + ';' + targetTable;
        ajaxHandler.synServerCall('ajax_handler.php','checkIfExistMNRelationLinkTable',ids,'text');
        var linkTableName = ajaxHandler.getOpByName('checkIfExistMNRelationLinkTable').testResult;  
        if (linkTableName != 'true') 
        {
          var msg = loc.getString('msg',25) + linkTableName;
          new dijit.Tooltip({connectId:inputElId,
          label:msg,position:'above'}) 
        }   
       }
      }
      $('#html_tags__3').append('<span class="tables">' + inputElsLabels[j] + '</span>');
     }
    }
   }
  }
 }
 
 
 function OpSet1NRelationsDefinitionProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  alert('Modifica completata.')};
 }
 
 
 function OpSetMNRelationsDefinitionProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  alert('Modifica completata.')};
 }
 
 function OpCheckIfIs1NRelationFather(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
  function OpCheckIfTableExists(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIsInRelation(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIs1NRelationFatherOf(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfExistMNRelationLinkTable(actName)
  {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpSetFieldsDef(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpSetFieldsDefWithoutExtKeys(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpSetFieldsDefExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
 function OpSetFieldsConstsDef(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpRenameAllItems(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

function OpUpdateBinds(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	};	
}

 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
 this.result = actTxtMsg;};
 }
 
 function OpGetExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	console.log(rootEl);
 	var childs0 = rootEl.childNodes[0];
 	var childs1 = rootEl.childNodes[1];
 	var extTables=new Array();
 	var extKeyFields = new Array();
 	var i=0;
 	var len = childs0.childNodes.length;
 	for(i=0;i<=len-1;i++)
 	{
 	 extTables[i]=childs0.childNodes[i].childNodes[0].nodeValue;
 	 extKeyFields[i] = childs1.childNodes[i].childNodes[0].nodeValue;
  }
  console.log(extTables);
  console.log(extKeyFields);
 	this.result = new Array(extTables,extKeyFields);}
 }
 
 function OpGetFieldsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes[0];
 	var fields=new Array();
 	var i=0;
 	var len = childs.childNodes.length;
 	for(i=0;i<=len-1;i++)
 	{
 	 fields[i]=childs.childNodes[i].childNodes[0].nodeValue;
  }
 	this.result = fields;}
 }
 
 function OpCheckIfNodeIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }
 
