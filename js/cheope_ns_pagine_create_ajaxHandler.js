 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //

function OpCreatePage(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){alert(actXmlMsg);};
	
}


function OpAddAjaxOpsFromPhpArray(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

function OpGetAllInterfacesOfPage(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Interfaccia_radice'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Interfaccia_radice');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + childs[i].firstChild.nodeValue + 
  '">' + childs[i].firstChild.nodeValue + '</option>')
 	}
 };
}

function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
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