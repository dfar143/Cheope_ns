 function OpDeleteRelationsDefs(actName)
 {
	this.name = actName;
	this.exec = function(actXmlMsg)
	{
	// alert('Modifica completata');
	}
 }

 //
 // Richede l'inclusione 
 // preventiva di ajaxFormHandler.js
 //
 
 function OpSetDbObjsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
//alert('Modifica completata.')
};
 }
 
 function OpSetFieldsDefAllFieldsProps(actName)
 {
  this.name = actName;
 	this.exec = function(actXmlMsg){
 // alert('Modifica completata.')
 };
 } 
 
 //
 // inputElsLabels è globale
 // impostato da checkIfTablesExist
 //
 function OpGet1NRelations(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		tables.get1NRelations(actXmlMsg);
 	}
 }
 
 //
 // inputElsLabels è globale
 // impostato da checkIfTablesExist
 //
 function OpGetMNRelations(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		tables.getMNRelations(actXmlMsg);
  }
 }
 
 
 function OpSet1NRelationsDefinitionProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 // alert('Modifica completata.')
 };
 }
 
 
 function OpSetMNRelationsDefinitionProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
//  alert('Modifica completata.')
};
 }
 
 function OpCheckIfIs1NRelationFather(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfTableExists(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIs1NRelation(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIsInRelation(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfIs1NRelationFatherOf(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpCheckIfExistMNRelationLinkTable(actName)
  {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
  this.testResult = actTxtMsg;};
 }
 
 function OpSetFieldsDef(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpSetFieldsDefWithoutExtKeys(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpSetFieldsDefExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
 }
 
 function OpSetFieldsConstsDef(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  };
 }
 
 function OpRenameAllItems(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
  }
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
 
 function OpGetPkKeyByTableName(actName)
 {
 	this.name = actName;
 	this.exec = function(actTxtMsg){
 this.result = actTxtMsg;};
 }
 
 function OpGetExtKeyFieldsProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	//console.log(rootEl);
 	var childs0 = rootEl.childNodes[0];
 	var childs1 = rootEl.childNodes[1];
 	var extTables=new Array();
 	var extKeyFields = new Array();
 	var i=0;
 	var len = childs0.childNodes.length;
 	for(i=0;i<=len-1;i++)
 	{
 	 extTables[i]=childs0.childNodes[i].childNodes[0].nodeValue;
 	 extKeyFields[i] = childs1.childNodes[i].childNodes[0].nodeValue;
  }
  //console.log(extTables);
  //console.log(extKeyFields);
 	this.result = new Array(extTables,extKeyFields);}
 }
 
 function OpGetFieldsDefProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
 	var childs = rootEl.childNodes[0];
 	var fields=new Array();
 	var i=0;
 	var len = childs.childNodes.length;
 	for(i=0;i<=len-1;i++)
 	{
 	 fields[i]=childs.childNodes[i].childNodes[0].nodeValue;
  }
 	this.result = fields;}
 }
 
 function OpCheckIfNodeIsUsed(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		this.testResult=actXmlMsg;
 	}
 }
 
 function OpCreateDbStruct(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){if(actXmlMsg=='true')alert(loc.getString('msg',12));};
 }
 
    function OpFixDbXmlFiles(actName)
 {
	this.name=actName;
	this.exec = function(actXmlMsg){};
 }
