 
 function OpSetAllAliases(actName)
 {
  this.name = actName;
 	this.exec = function(actXmlMsg){
 alert('Modifica completata.')};
 }
 
 function OpViewAllAliasesOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllAliasesOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
 int.putData();};
 }
 
 function OpViewAllAliasesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewAllAliasesOp2');
 int.setDataSource(dataSource);};
 }
 
  function OpCheckIfTableExists(actName)
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
 
 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  this.result = actXmlMsg;};
 }

function OpUpdateBinds(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

function OpRenameAliasName(actName)
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
