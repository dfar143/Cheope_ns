 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 function OpGetScrollData(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"dynTable.deleteTableRows();" + 
  "dynTable.loadTableValues(actXmlMsg,'Arial','10pt');");
 }
 
 function OpGetSheetData(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"dynSheet.deleteSheetRow();" + 
  "dynSheet.loadSheetValues(actXmlMsg,'Arial','10pt');");
 }
