 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 function OpOp1(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"console.log(actXmlMsg);var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg);" + 
 	"var int=interfacesContainer.getInterface('Op1');" + 
 	"int.setDataSource(dataSource);int.setInheritData(false);" +
 	"int.setExecOnlyOnFullDataSource(false);int.putData();");
 }
 
 function OpOp2(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg);" + 
 	"var int=interfacesContainer.getInterface('Op2');" + 
 	"int.setDataSource(dataSource);");
 }
 
  function OpOp3(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg);" + 
 	"var int=interfacesContainer.getInterface('Op3');" + 
 	"int.setDataSource(dataSource);");
 }
