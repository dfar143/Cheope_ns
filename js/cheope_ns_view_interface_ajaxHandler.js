 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
function OpGetDbItems(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
  $('select#obj option').remove(); 
 	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes; 
 	for(var i=0;i<=len-1;i++)
 	{$('#html_tags__24').append('<option value="' +  
 	childs[i].firstChild.nodeValue + '">' +  
 	childs[i].firstChild.nodeValue + '</option>');}
 $('#html_tags__24').append('<option value=""></option>');};
}

function OpPostSendInterfaceData(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg)
	{
	};
	
}

 function OpGetFreeInterfaceCanonicalName(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		this.result = actXmlMsg;
 	}
 }