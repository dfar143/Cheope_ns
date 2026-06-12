function OpTestConnection(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	if(actXmlMsg=='')
 	 alert(loc.getString('msg',33));
 	else
 		console.log(actXmlMsg);
  }
}

function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

function OpCopyConnectionToDbPars(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var activeDb = actXmlMsg;$('#select_1 option').each(function(){
	if($(this).text()==activeDb)this.selected=true;});
	 $('#Par1').get(0).value='1';document.forms['form_1'].submit();
	};
}