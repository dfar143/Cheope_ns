 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //

function OpCreatePage(actName)
{
	this.name = actName;
	this.exec = new Function("actXmlMsg","alert(actXmlMsg);");
	
}

function OpGetAjaxOps(actName)
{
	this.name = actName;
	this.exec = new Function("actXmlMsg","alert(actXmlMsg);");
	
}