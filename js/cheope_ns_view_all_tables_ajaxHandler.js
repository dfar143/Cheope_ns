 
 function OpDeleteRelationsDefs(actName)
 {
	this.name = actName;
	this.exec = function(actXmlMsg)
	{
	// alert('Modifica completata');
	}
 }
 
 function OpSetDbObjsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  //alert('Modifica completata.')
  };
 }
 
 function OpSetFieldsDefAllFieldsProps(actName)
 {
  this.name = actName;
 	this.exec = function(actXmlMsg){
  //alert('Modifica completata.')
  };
 }
 
 function OpViewAllTablesOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllTablesOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpViewAllTablesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewAllTablesOp2');
  int.setDataSource(dataSource);};
 }
 
 function OpCheckIfIs1NRelationFather(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIs1NRelation(actName)
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
 
 function OpCheckIfAliasExists(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
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

 
 