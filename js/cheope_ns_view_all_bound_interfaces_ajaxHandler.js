 
 function OpViewBoundInterfacesOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewBoundInterfacesOp2');
 int.setDataSource(dataSource);};
 }
 
 function OpViewBoundInterfacesOp3(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewBoundInterfacesOp3');
  int.setDataSource(dataSource);
  this.results = dataSource};
 }
 
 function OpSetAllBoundInterfaces(actName)
 {
 	this.name=actName;
 	this.exec = function(actXmlMsg)
 	{
		if(actXmlMsg!="")
 		 alert(actXmlMsg);
 	}
 }
 
  function OpIsInterfaceBusy(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){this.result=actTxtMsg;};
 }