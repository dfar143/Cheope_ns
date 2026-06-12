 function OpSqlServerImport(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	if(actXmlMsg!='true')alert(actXmlMsg);window.location.reload();
  };
 }
 
 function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
};	
}