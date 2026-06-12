 
 function OpManageAjaxOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('manageAjaxOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpManageAjaxOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=true;
 	var rootEl = actXmlMsg.documentElement;
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('manageAjaxOp2');
  int.setDataSource(dataSource);};
 }
 
  function OpManageAjaxClassesOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('manageAjaxClassesOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpManageAjaxClassesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=true;
 	var rootEl = actXmlMsg.documentElement;
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('manageAjaxClassesOp2');
  int.setDataSource(dataSource);};
 }
 
function OpSetSessionActiveApp(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
}

function OpSetAllAjaxOps(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){};	
}

function OpSetAllAjaxOpsClasses(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',79));};	
}

function OpGenerateAjaxOpsConfigurationFiles(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',80));};
}

function OpGenerateAjaxOpsClassesFiles(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',81));};
}