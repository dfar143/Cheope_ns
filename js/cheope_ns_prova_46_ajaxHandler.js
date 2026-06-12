 function OpOp6(actName)
 {
 	this.name = actName;
 	this.exec = new Function("actXmlMsg",
 	"alert(actXmlMsg);");
 }