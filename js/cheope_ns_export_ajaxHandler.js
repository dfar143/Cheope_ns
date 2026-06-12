 function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

 function OpExport(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	if(actXmlMsg !== 'true')
 	{
 	 alert(actXmlMsg);
   this.result=false;
  }
  else
  	this.result = true;
  };
 }
 