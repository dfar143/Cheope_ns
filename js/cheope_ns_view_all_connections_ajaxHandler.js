
 function OpViewAllConnectionsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllConnectionsOp1');
 	int.setInheritData(false);
 	int.setExecOnlyOnFullDataSource(false);
 int.putData();};
 }
 
 function OpViewAllConnectionsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg);
 	var int=interfacesContainer.getInterface('viewAllConnectionsOp2');
 int.setDataSource(dataSource);};
 }
 
 
 