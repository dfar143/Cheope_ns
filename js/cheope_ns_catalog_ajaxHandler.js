 
 function OpCatalogOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('catalogOp2');
	//console.log('OOOOO1');
	//console.log(dataSource);
	//console.log('OOOOO2');
 int.setDataSource(dataSource);
 this.results=dataSource;};
 }
 
 
 function OpCatalogOp3(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
	//console.log(dataSource);
 	var int=interfacesContainer.getInterface('catalogOp3');
  int.setDataSource(dataSource);
  this.results=dataSource;};
 }
 
  function OpCatalogOp4(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('catalogOp4');
  int.setDataSource(dataSource);
  this.results=dataSource;};
 }
 
 function OpSetAllCatalogInterfaces(actName)
 {
 	this.name=actName;
 	this.exec = function(actTxtMsg)
 	{
 		if(actTxtMsg!="")
 		 alert(actTxtMsg);
 	}
 }
 
 function OpCreatePreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 }

 function OpGetInterfaceItemsNum(actName)
{
	this.name = actName;
	this.exec = function(actTxtMsg){this.result=actTxtMsg;
	};	
}

 function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	};	
}

 function OpIsInterfaceBusy(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){this.result=actTxtMsg;};
 }
 
  function OpInterfaceExists(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){this.result=actTxtMsg;};
 }