 
// function OpSetAllAliases(actName)
// {
//  this.name = actName;
// 	this.exec = new Function(actXmlMsg,
// 	alert('Modifica completata.'));
// }
 
 function OpViewTablesAndQueriesOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewTablesAndQueriesOp1');
 	int.setInheritData(false);
 	int.setExecOnlyOnFullDataSource(false);
  int.putData();};
 }
 
 function OpViewTablesAndQueriesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewTablesAndQueriesOp2');
 int.setDataSource(dataSource);};
 }
 
 function OpViewTablesAndQueriesOp3(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewTablesAndQueriesOp3');
  int.setDataSource(dataSource);};
 }
 
 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpSetAllTablesAndQueriesBinds(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpCreateDbStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){alert(loc.getString('msg',12));};
 }
 
 function OpCreateQueriesStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',88));};
 }
 
 function OpCreateConnectionsStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',89));};
 }
 
 function OpCreateDbBinds(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',78));};
 }
 
 function OpFixDbXmlFiles(actName)
 {
	this.name=actName;
	this.exec = function(actXmlMsg){};
 }
 
function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
};	
}

 function OpViewBindsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewBindsOp1');
 	int.setInheritData(false);
 	int.setExecOnlyOnFullDataSource(false);
  int.putData();};
 }
 
 function OpViewBindsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewBindsOp2');
 int.setDataSource(dataSource);};
 }
 
 
 function OpViewBindsOp3(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewBindsOp3');
  int.setDataSource(dataSource);};
 }
 
  function OpViewBindsOp4(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewBindsOp4');
  int.setDataSource(dataSource);};
 }
 
function OpSetAllBinds(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
};	
}

 function OpCheckIfNodeIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }