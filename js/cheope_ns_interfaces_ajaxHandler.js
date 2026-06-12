 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
function OpGetDbItems(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
  $('select#obj option').remove(); 
 	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes; 
 	for(var i=0;i<=len-1;i++)
 	{$('#html_tags__24').append('<option value="' + 
 	childs[i].firstChild.nodeValue + '">' +  
 	childs[i].firstChild.nodeValue + '</option>');}
 	$('#html_tags__24').append('<option value=""></option>');
 };
}

function OpPostSendInterfaceData(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg)
	{
    };	
}

function OpGetParents(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){ 
 	var rootEl = actXmlMsg.documentElement;
	console.log(rootEl);
 	var field = document.getElementById('Genitori'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;	
 	for(var i=0;i<=len-1;i++)
 	{
 	var val=childs[i].firstChild.nodeValue; 
  var fieldOption = new Option(val,val,false,false);
  try{field.add(fieldOption);}catch(ex){field.add(fieldOption,null);} 
 	} 
 };
	
}

 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpGetBindNodeName(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpGetBindNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpGetTableFromAlias(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpCreatePreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 }
 
 function OpGetAllTableFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){setDataFieldsMenuItems(actXmlMsg)};
 }
 
 function OpGetAllAliasFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){setDataFieldsMenuItems(actXmlMsg)};
 }
 
 function OpGetAllQueryFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){setDataFieldsMenuItems(actXmlMsg)};
 }

 function OpGetAllModuleFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){setDataFieldsMenuItems(actXmlMsg)};
 }
 
function OpSetSessionActiveApp(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
}

function OpGetInterfaceIds(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 	 var rootEl = actXmlMsg.documentElement;
 	 var ids = rootEl.childNodes;
   this.results = new Array();
 	 var num = ids.length;
 	 for(var i=0;i<=num-1;i++)
 	 {
 	 	this.results[i] = ids[i].childNodes[0].nodeValue
 	 }
 	};
}