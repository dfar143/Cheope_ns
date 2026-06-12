 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 function OpGetFile(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"alert(actXmlMsg);" +
 	"var intCode=JavascriptTxtEditorOp41.getInterfaceId('');alert(intCode);" +
 	"var textAreaEl = document.getElementById(intCode + '_' + 'textarea');textAreaEl.value=decodeURI(actXmlMsg);");
 }
 
  function OpOp4(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"var int=interfacesContainer.getInterface('Op4');" +
 	"int.setValue(actXmlMsg);" +
 	"int.putData();");
 }
 
 function OpSendFile(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg","if(actXmlMsg)alert('Salvataggio riuscito.');" +
 	"else alert('Salvataggio fallito.');");	
 }