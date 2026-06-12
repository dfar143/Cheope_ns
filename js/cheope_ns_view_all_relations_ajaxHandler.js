
 function OpViewAllRelationsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllRelationsOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
 	int.putData();};
 }
 
 function OpViewAllRelationsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewAllRelationsOp2');
 	int.setDataSource(dataSource);};
 }

 
 