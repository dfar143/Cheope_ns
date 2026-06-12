 //
 // Richede l'inclusione 
 // preventiva di ajaxHandler.js
 //
 function OpGetFile(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	alert(actXmlMsg);
 	var int = interfacesContainer.getInterface('Op4'); 
 	var intCode=int.getInterfaceId('');
 	alert(intCode);
  int.setValueToEditor(decodeURI(actXmlMsg));
  };
 }
 
 function OpOp4(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('Op4');
 	int.setValue(actXmlMsg);
  int.putData();};
 }
 
 function OpSendFile(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg)alert(loc.getString('msg',13));
 	else alert(loc.getString('msg',14));};	
 }
 