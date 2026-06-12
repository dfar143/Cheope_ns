 function OpGetConnection(actName)
 {
  this.name = actName;
  this.exec = function(actXmlMsg){
  //console.log(actXmlMsg);
  var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	var dbName = childs[0].childNodes[0].nodeValue.replace(/\s*/g,'');
 	//console.log(dbName);
  var dbs = new Array();
  var i=0;
  $('#Available_dbs option').each(function(){if($(this).text()!='')dbs[i++]=$(this).text();});
  var select = document.createElement('select');
  select.id='Available_dbs'; 
  $(select).change(function(){form_inserimento_1_available_dbs_onChange(this);});
  for(var k=0;k<=dbs.length-1;k++)
  {
  var option = document.createElement('option');
  option.value=k;
  option.innerHTML=dbs[k];
  if(dbs[k]==dbName)
   option.selected=true;
  select.appendChild(option)
  }	
  $('#form_2__1_col_item_Available_dbs select').remove();
  $('#form_2__1_col_item_Available_dbs').append(select);
 	var parsNames = childs[1].childNodes;
 	var parsValues = childs[2].childNodes;
 	var parsTypes = childs[3].childNodes;
 	var num = parsNames.length; 
 	for(var i=0;i<=num-1;i++)
 	{
 	var parType = parsTypes[i].childNodes[0].nodeValue;
 	var parName = parsNames[i].childNodes[0].nodeValue.replace(/_/g,' ');
 	var parValue = parsValues[i].childNodes[0].nodeValue;
 	if(parType=='@')
 	{
 	var label = document.createElement('label');
 	label.innerHTML=parName + '&nbsp;&nbsp;';
 	var textarea = document.createElement('textarea');
 	textarea.rows=5;
 	textarea.cols=40;
 	textarea.name = parName;
 	textarea.innerHTML = parValue;
 	$('#html_tags__0').append(label);
 	$('#html_tags__0').append(textarea);
 	$('#html_tags__0').append('<br/><br/>');
 	}
 	else
 	{
 	var label = document.createElement('label');
 	label.innerHTML=parName + '&nbsp;&nbsp;';
 	var input = document.createElement('input');
 	input.name = parName;
 	input.value = parValue;
 	input.size = parValue.length+10;
 	input.type = 'text';
 	$('#html_tags__0').append(label);
 	$('#html_tags__0').append(input);
 	$('#html_tags__0').append('<br/><br/>');
 	}
 	}
 	$('#html_tags__0').show();
  };
 }
 
 function OpGetDbOpPars(actName)
 {
  this.name = actName;
  this.exec = function(actXmlMsg){
  var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	var pars = childs[0].childNodes;
 	var parsTypes = childs[1].childNodes;
 	var num = pars.length; 
 	for(var i=0;i<=num-1;i++)
 	{
 	var parType = parsTypes[i].childNodes[0].nodeValue;
 	var par = pars[i].childNodes[0].nodeValue.replace(/_/g,' ');
 	if(parType=='@')
 	{
 	var label = document.createElement('label');
 	label.innerHTML=par + '&nbsp;&nbsp;';
 	var textarea = document.createElement('textarea');
 	textarea.name = par;
 	$('#container').append(label);
 	$('#container').append(textarea);
 	$('#container').append('<br/><br/>');
 	}
 	else
 	{
 	var label = document.createElement('label');
 	label.innerHTML=par + '&nbsp;&nbsp;';
 	var input = document.createElement('input');
 	input.name = par;
 	input.type = 'text';
 	$('#container').append(label);
 	$('#container').append(input);
 	$('#container').append('<br/><br/>');
 	}
 	}
};
 }
 
 function OpCreateConnectionsStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',89));};
 }
 
 function OpCreateQueriesStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',88));};
 }
 
 function OpSetConnection(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpCreateDbBinds(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',78));};
 }
 
 function OpCreateDbStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){alert(loc.getString('msg',12));};
 }
 
function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
};	
}

 function OpCheckIfConnectionIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }
 
  function OpFixDbXmlFiles(actName)
 {
	this.name=actName;
	this.exec = function(actXmlMsg){};
 }