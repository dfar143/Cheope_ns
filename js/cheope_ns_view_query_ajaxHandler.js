 
 function OpGetQuery(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement; 
 	var childs = rootEl.childNodes;
 	$('select#Lista_queries option:selected').text(childs[0].childNodes[0].nodeValue);
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

 
 function OpCreateDbBinds(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpCheckIfIsDataSourceQuery(actName)
 {
  this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
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
  this.result = acttxtMsg;};
 }