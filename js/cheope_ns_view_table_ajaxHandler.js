 //
 // Richiede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 
 function OpGetFieldsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	var fields = childs[0].childNodes;
 	var fieldsTypes = childs[1].childNodes;
 	util.deleteSelectFieldContents('Lista_campi');
 	var num = fields.length;
 	k=0;
 	for(var i=0;i<=num-1;i++)
 	{
 	var elsItems = fields[i].childNodes[0].nodeValue.split('_'); 
 	var elName = elsItems[0];
 	$('#Lista_campi').append('<option></option>');
 	var num1 = elsItems.length;
 	for(var j=1;j<=num1-1;j++)
 	{elName = elName + '_' + elsItems[j];} 
 	$('#Lista_campi :eq(' + k + ')').text(elName);
 	var elType = fieldsTypes[i].childNodes[0].nodeValue;
 	$('#Lista_campi :eq(' + k + ')').data('tipo',elType);
 	k++;
 	}
 	$('#Lista_campi').append('<option></option>');
 	var lista_campi = $('select#Lista_campi').get(0);
 	$(lista_campi).next().remove();
  $(lista_campi).after('<span id="tipo_campo_id">' + 
 	$('select#Lista_campi option:selected').data(
  'tipo') + '</span>');
  $('input#pk').get(0).checked=false;
  };
 }
 
 
 function OpGetAllFieldsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	if(childs[0] != undefined){
 	var fields = childs[0].childNodes;
 	util.deleteSelectFieldContents('Lista_campi');
  $('#html_tags__2_group_0').remove();
 	
 	insertHtmlTags2NewGroup();
 
 	var groupSize1 = $('#html_tags__1_group_0 select').size();
 	var ct=0;
 	while(groupSize1 != 0)
 	{
  $('#html_tags__1_group_' + ct).remove();
  ct++;
 	groupSize1 = $('#html_tags__1_group_' + ct + ' select').size();
 	}
 	
 	var fieldsTypes = childs[1].childNodes;
 	var num = fields.length;
 	k=0;
 	$('#tipo_campo_id').html('');
 	for(var i=0;i<=num-1;i++)
 	{
 	var elName = fields[i].childNodes[0].nodeValue;
 	$('#Lista_campi').append('<option></option>');
 	$('#Lista_campi :eq(' + k + ')').text(elName);
 	var elType = fieldsTypes[i].childNodes[0].nodeValue;
 	$('#Lista_campi :eq(' + k + ')').data('tipo',elType);
 	if(k==0){$('#tipo_campo_id').html(elType)}
 	k++;
 	}
 	$('#Lista_campi').append('<option></option>');
 	
 	var candKeysFields = childs[2].childNodes;
 	var num2 = candKeysFields.length; 
 	//alert(num2);
 	for(var k=0;k<=num2-1;k++)
 	{
 	insertHtmlTags1NewGroup();
 	var candKey = candKeysFields[k].childNodes;
 	var num3 = candKey.length;
 	for(var l=0;l<=num3-1;l++)
 	{
 	var item = candKey[l].childNodes[0].nodeValue;
 	$('#html_tags__1_lista_campi_' + k).append('<option>' + item + '</option>');
 	}
 	}
 	var extKeysTables = childs[3].childNodes;
 	var extKeysFields = childs[4].childNodes;
 	var num3 = extKeysTables.length;
 	//alert(num3);
 	for(var l=0;l<=num3-1;l++)
 	{
 	 var keyField = extKeysFields[l].childNodes[0].nodeValue;
 	 var extTable = extKeysTables[l].childNodes[0].nodeValue;
 	 if(extTable!=null)
 	 {
 	 	if(l==0)
 	 	 $('#external_key').val(keyField);
 	  $('#html_tags__2_lista_tabelle_0').append('<option>' + extTable + '</option>');
 	  $('#html_tags__2_lista_tabelle_0 option:eq(' + l + ')').data('keyField',keyField);
 	 }
 	}
 	$('#html_tags__2_lista_tabelle_0').append('<option></option>');
 	}
 	else{
 	util.deleteSelectFieldContents('Lista_campi');
 	util.deleteSelectFieldContents('Tipi_campo');
  $('#html_tags__2_group_0').remove();
  $('#tipo_campo_id').html(''); 	
  $('#html_tags__1_group_0').remove();}
  $('input#pk').get(0).checked=false; 
  }; 	
 }
 
 function OpSetFieldsDefFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
 function OpSetFieldsDefCandKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
 function OpSetFieldsDefExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
 function OpSetRelationsDefinitionProps(actName) 
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }

 function OpSet1NRelationsDefinitionProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
  
 function OpGetCandKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	var groupSize1 = $('#html_tags__1_group_0 select').size();
 	var ct=0;
 	while(groupSize1 != 0)
 	{
  $('#html_tags__1_group_' + ct).remove();
  ct++;
 	groupSize1 = $('#html_tags__1_group_' + ct + ' select').size();
 	}
 	var candKeysFields = childs[0].childNodes;
 	var num2 = candKeysFields.length; 
 	alert(num2);
 	for(var k=0;k<=num2-1;k++)
 	{
 	insertHtmlTags1NewGroup();
 	var candKey = candKeysFields[k].childNodes[0].childNodes;
 	var num3 = candKey.length;
 	for(var l=0;l<=num3-1;l++)
 	{
 	var item = candKey[l].childNodes[0].nodeValue;
 	$('#html_tags__1_lista_campi_' + k).append('<option>' + item + '</option>');
 	}
 	}
  };
 }

 function OpGetExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
  $('#html_tags__2_group_0').remove();
 	insertHtmlTags2NewGroup();
 	var extKeysFields = childs[0].childNodes;
 	var num3 = extKeysFields.length;
 	alert(num3);
 	for(var l=0;l<=num3-1;l++)
 	{
 	if(extKeysFields[l].childNodes[0].nodeValue!=null)
 	{
 	var elType = extKeysFields[l].childNodes[0].nodeValue;
 	$('#html_tags__2_lista_tabelle_0').append('<option>' + elType + '</option>');
 	}
 	}
 	$('#html_tags__2_lista_tabelle_0').append('<option></option>'); 
 };
 }
 
 function OpGetPkKeyField(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	$('select#Lista_campi').data('pk',actXmlMsg);
 	if($('select#Lista_campi option:selected').text()==actXmlMsg)
  $('input#pk').get(0).checked=true;};
 }
 
 function OpSetPk(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpCheckIfIs1NRelationFatherOf(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIsSuitablePkKey(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  if(actTxtMsg=='false')alert(loc.getString('msg',37));}; 	
 }
 
 function OpCheckIfIsSuitableField(actName)
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
 
 function OpSqlSrvCreateTable(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  if(actXmlMsg!='true')alert(actXmlMsg);};
 }

  
 

 
 
 