 function OpSetFieldsConstsDef(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }

 function OpGetCandKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes;
 	var fields = [];
 	var m=0;
 	var candKeysFields = childs[0].childNodes;
 	var num2 = candKeysFields.length;
	for(var k=0;k<=num2-1;k++)
 	{
 	 var candKey = candKeysFields[k].childNodes;
 	 var num3 = candKey.length;
 	 for(var l=0;l<=num3-1;l++)
 	 {
 	  var item = candKey[l].childNodes[0].nodeValue; 
    if (! util.in_array(item,fields))
     fields[m++]=item;
   }
  }
  this.result = fields;
  }
 } 
 
 function OpCheckIfIsSuitablePkKey(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
 this.testResult = actTxtMsg;};
 }
 
 function OpViewAllFieldsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('viewAllFieldsOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpViewAllFieldsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('viewAllFieldsOp2');
  int.setDataSource(dataSource);};
 }
 
 function OpSetFieldsDefFieldsProps(actName)
 {
 	this.name=actName;
 	this.exec = function(actXmlMsg){};
 }
 
 function OpSetPk(actName)
 {
 	this.name=actName;
 	this.exec = function(actXmlMsg){};
 } 
 
 function OpCheckIfIsSuitableField(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
 this.testResult = actTxtMsg;};
 }

 
 