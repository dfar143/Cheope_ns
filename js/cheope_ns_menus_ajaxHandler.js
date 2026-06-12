function OpSetSessionActiveApp(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
}

function OpInterfaceExists(actName)
{
 	this.name = actName;
 	this.exec = function(actTxtMsg)
 	{
 		this.result = actTxtMsg;
 	}	
}

function OpTestIntFormat(actName)
{
 this.name=actName;
 this.exec=function(actXmlMsg){
	 this.result = actXmlMsg;
	 if(this.result=="false")
	  this.result=false;
     else
	  this.result=true;
 };
}

function OpGetSingleMenus(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Single_menus'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Single_menus');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + childs[i].firstChild.nodeValue + '">' + childs[i].firstChild.nodeValue + '</option>')
 	}
 };
}

function OpGetMultiMenus(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Multi_menus'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Multi_menus');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
 	{
   selectField.append('<option value="' + childs[i].firstChild.nodeValue + '">' + childs[i].firstChild.nodeValue + '</option>')
 	}
 };
}
 
 function OpViewSingleMenuFieldsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewSingleMenuFieldsOp1');
 	 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
 int.putData();
 		};
 } 
 
 function OpViewSingleMenuFieldsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewSingleMenuFieldsOp2');
 	int.setExecOnlyOnFullDataSource(true);
 int.setDataSource(dataSource);};
 }
 
 function OpViewMultiMenuFieldsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewMultiMenuFieldsOp1');
 	 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
 int.putData();
 		};
 } 
 
 function OpViewMultiMenuFieldsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg);
 	//console.log(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewMultiMenuFieldsOp2');
 	int.setExecOnlyOnFullDataSource(true);
  int.setDataSource(dataSource);};
 }
 
 function OpSetSingleMenu(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 } 
 
 function OpSetMultiMenu(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 } 

function OpCreatePreview(actName)
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
 
  function OpFilterParentsInterfacesFiles(actName)
 {
 	this.name = actName;
	this.exec = function(actXmlMsg){
  var rootEl = actXmlMsg.documentElement; 
 	var childs = rootEl.childNodes;
 	var len = childs.length;
 	var values = new Array();
 	values[0] = '';
 	for(var i=1;i<=len-1;i++)
 	{
   values[i]=childs[i].childNodes[0].nodeValue; 
  }
  this.result = values;
 };
 }
 
function OpGetAllInterfacesOfPage(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
  var rootEl = actXmlMsg.documentElement; 	
 	var childs = rootEl.childNodes;
 	var len = childs.length;
 	var values = new Array();
 	for(var i=0;i<=len-1;i++)
 	{
   values[i]=childs[i].childNodes[0].nodeValue; 
  }
  this.result = values;
 };
}

function OpFileExists(actName)
{
	this.name = actName;
	this.exec = function(actTxtMsg)
	{
    this.testResult = actTxtMsg;
	};
}

 function OpDojoInPreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=actXmlMsg;};
 }