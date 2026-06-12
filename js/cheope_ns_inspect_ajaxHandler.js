function OpGetAllInterfacesOfPage(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Interfacce'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Interfacce');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
  {
   selectField.append('<option value="' + childs[i].firstChild.nodeValue + '">' + childs[i].firstChild.nodeValue + '</option>')
 	}
 };
}

function OpGetParents(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){ 
 	var rootEl = actXmlMsg.documentElement;
 	var field = document.getElementById('Genitori'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes; 
 	for(var i=0;i<=len-1;i++)
 	{
 	var val=childs[i].firstChild.nodeValue; 
  var fieldOption = new Option(val,val,false,false);
  try{field.add(fieldOption);}catch(ex){field.add(fieldOption,null);} 
 	} 
 };
}

function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

 function OpCreatePreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg !='') alert(actXmlMsg);};
 }
 
 function OpDojoInPreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=actXmlMsg;};
 }
