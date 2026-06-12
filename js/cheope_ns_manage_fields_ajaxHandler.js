 
 function OpManageFieldsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('manageFieldsOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpManageFieldsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=true;
 	var rootEl = actXmlMsg.documentElement;
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('manageFieldsOp2');
  int.setDataSource(dataSource);};
 }
 
 function getValuesFromXml(actXmlMsg)
 {
	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes[0].childNodes;
 	var len = childs.length;
 	var values = new Array();
 	for(var i=0;i<=len-1;i++)
 	{
   values[i]=childs[i].childNodes[0].nodeValue; 
  }
  return values;
 }
 
function OpGetAllInterfacesOfPage(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
  var rootEl = actXmlMsg.documentElement; 	
 	var childs = rootEl.childNodes;
 	var len = childs.length;
 	var values = new Array();
 	for(var i=0;i<=len-1;i++)
 	{
   values[i]=childs[i].childNodes[0].nodeValue; 
  }
  this.result = values;
 };
}

 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }

 function OpGetAllTableFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result = getValuesFromXml(actXmlMsg);};
 }
 
 function OpGetAllAliasFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result = getValuesFromXml(actXmlMsg);};
 }
 
 function OpGetAllQueryFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result = getValuesFromXml(actXmlMsg);};
 }

 function OpGetAllModuleFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result = getValuesFromXml(actXmlMsg);};
 }
 
 function OpGetAllBindFields(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result = getValuesFromXml(actXmlMsg);};
 }
 
 function OpFilterParentsInterfacesFiles(actName)
 {
 	this.name = actName;
	this.exec = function(actXmlMsg){
  var rootEl = actXmlMsg.documentElement; 	
 	var childs = rootEl.childNodes;
 	var len = childs.length;
 	var values = new Array();
 	for(var i=0;i<=len-1;i++)
 	{
   values[i]=childs[i].childNodes[0].nodeValue; 
  }
  this.result = values;
 };
 }