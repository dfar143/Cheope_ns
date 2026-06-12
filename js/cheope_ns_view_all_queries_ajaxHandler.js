
 function OpViewAllQueriesOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllQueriesOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpViewAllQueriesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewAllQueriesOp2');
  int.setDataSource(dataSource);};
 }
  
 function OpCheckIfIsDataSourceQuery(actName)
 {
  this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpSetAllQueries(actName)
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
 	this.exec = function(actXmlMsg){
  this.result = actXmlMsg;};
 }

 function OpCheckIfNodeIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }

 

 
 