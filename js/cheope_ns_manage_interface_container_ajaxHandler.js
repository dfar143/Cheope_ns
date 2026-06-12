
 function OpManageOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('manageOp1');
 	int.setInheritData(false);
 	int.setExecOnlyOnFullDataSource(false);
  int.putData();};
 }
 
 function OpManageOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('manageOp2');
  int.setDataSource(dataSource);};
 }
 
 function OpGetNamedInterfacesContainer(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	//console.log(rootEl);
  var tempGetInterface = interfacesContainer.getInterface('TempGetInterface');
  if(! tempGetInterface.isFieldInDataFields('rootEl'))
  tempGetInterface.addField('rootEl',rootEl,'var');
  else 
  tempGetInterface.setDataFieldDomainValueByName('rootEl',rootEl);
  tempGetInterface.putData();}; 
 }
 
 function OpGetContainer(actName)
 {
  this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('getContainer');
  int.putData();};
 }
 
 function OpGetFreeInterfaceCanonicalName(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		this.result = actXmlMsg;
 	}
 }