 
 function OpGetQuery(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement; 
 	var childs = rootEl.childNodes;
 	//console.log(childs[1].childNodes[0].nodeValue);
 	$('select#Lista_queries option:selected').text(childs[0].childNodes[0].nodeValue);
  // $('textarea#Query_body').text(childs[1].childNodes[0].nodeValue);
  $('textarea#Query_body').text(childs[1].childNodes[0].nodeValue);
  if(childs[2].childNodes[0].nodeValue=='true')$('#isDataSource').get(0).checked=true;
  else $('#isDataSource').get(0).checked=false;};
 }
 
 function OpSetQuery(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpCreateDbStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){alert(loc.getString('msg',12));};
 }
 
 function OpCreateQueriesStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',88));};
 }
 
 function OpCreateDbBinds(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',78));};
 }
 
 function OpCheckIfIsDataSourceQuery(actName)
 {
  this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

function OpUpdateBinds(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}

 function OpGetNodeType(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.result = actTxtMsg;};
 }
 
 function OpCheckIfNodeIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }
 
   function OpFixDbXmlFiles(actName)
 {
	this.name=actName;
	this.exec = function(actXmlMsg){};
 }
 