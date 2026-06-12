 function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

 function OpExportChanges(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	if(actXmlMsg!='true')
 	{
 	 alert(actXmlMsg);
   this.result=false;
  }
  else
  	this.result = true;
    alert(loc.getString('msg',44));
  };

 }
 
 function OpPagesInterfacesExportChanges(actName)
 {
 	this.name=actName;
 	this.exec = function(actXmlMsg){alert(loc.getString('msg',44));};
 }
 
 