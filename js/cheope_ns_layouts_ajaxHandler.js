function OpGetLayouts(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Layouts'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Layouts');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + childs[i].firstChild.nodeValue + '">' + 
  childs[i].firstChild.nodeValue + '</option>')
 	}
 };
}

 function OpLayoutsOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var int=interfacesContainer.getInterface('layoutsOp1');
 	int.setExecOnlyOnFullDataSource(false);
 	int.setInheritData(false);
  int.putData();};
 }
 
 function OpLayoutsOp2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource(actXmlMsg); 
 	var int=interfacesContainer.getInterface('layoutsOp2');
 int.setDataSource(dataSource);};
 }
 
 function OpSaveLayout(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 }
 
 function OpCreateLayoutPreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
 }
 
 function OpGetLayout(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	var rootEl = actXmlMsg.documentElement;
	var intType = rootEl.getElementsByTagName('ind_type').item(0).childNodes[0].nodeValue;
 	switch(intType){
 	case 'simple_layout':
  var tempSimple = interfacesContainer.getInterface('TempGetLayout');
  tempSimple.setDataFieldDomainValueByName('Layout','simple_layout');
  tempSimple.setDataFieldDomainValueByName('Pos','center');
  if(! tempSimple.isFieldInDataFields('rootEl'))
  tempSimple.addField('rootEl',rootEl,'var');
  else 
  tempSimple.setDataFieldDomainValueByName('rootEl',rootEl);
  tempSimple.putData();
 	break;
 	
 	case 'two_columns_layout':
  var tempTwoColumnsLeft = interfacesContainer.getInterface('TempGetLayout');
  tempTwoColumnsLeft.setDataFieldDomainValueByName('Layout','two_columns_layout');
  tempTwoColumnsLeft.setDataFieldDomainValueByName('Pos','left');
  if(! tempTwoColumnsLeft.isFieldInDataFields('rootEl'))
  tempTwoColumnsLeft.addField('rootEl',rootEl,'var');
  else 
  tempTwoColumnsLeft.setDataFieldDomainValueByName('rootEl',rootEl);
  tempTwoColumnsLeft.putData();
  tempTwoColumnsLeft.setDataFieldDomainValueByName('Pos','right');
  tempTwoColumnsLeft.putData();
 	break;

 	case 'three_columns_layout':
  var tempTwoColumns = interfacesContainer.getInterface('TempGetLayout');
  tempTwoColumns.setDataFieldDomainValueByName('Layout','three_columns_layout');
  tempTwoColumns.setDataFieldDomainValueByName('Pos','left');
  if(! tempTwoColumns.isFieldInDataFields('rootEl'))
  tempTwoColumns.addField('rootEl',rootEl,'var');
  else 
  tempTwoColumns.setDataFieldDomainValueByName('rootEl',rootEl);
  tempTwoColumns.putData();
  tempTwoColumns.setDataFieldDomainValueByName('Pos','center');
  tempTwoColumns.putData();
  tempTwoColumns.setDataFieldDomainValueByName('Pos','right');
  tempTwoColumns.putData();
 	break;

 	case 'tb_layout':
  var tempTB = interfacesContainer.getInterface('TempGetLayout');
  tempTB.setDataFieldDomainValueByName('Layout','tb_layout');
  tempTB.setDataFieldDomainValueByName('Pos','top');
  if(! tempTB.isFieldInDataFields('rootEl'))
  tempTB.addField('rootEl',rootEl,'var');
  else 
  tempTB.setDataFieldDomainValueByName('rootEl',rootEl);
  tempTB.putData();
  tempTB.setDataFieldDomainValueByName('Pos','bottom');
  tempTB.putData();
 	break;
 	
  case 'tb_simple_layout':
  var tempTBSimple = interfacesContainer.getInterface('TempGetLayout');
  tempTBSimple.setDataFieldDomainValueByName('Layout','tb_simple_layout');
  tempTBSimple.setDataFieldDomainValueByName('Pos','top');
  if(! tempTBSimple.isFieldInDataFields('rootEl'))
  tempTBSimple.addField('rootEl',rootEl,'var');
  else 
  tempTBSimple.setDataFieldDomainValueByName('rootEl',rootEl);
  tempTBSimple.putData();
  tempTBSimple.setDataFieldDomainValueByName('Pos','center');
  tempTBSimple.putData();
  tempTBSimple.setDataFieldDomainValueByName('Pos','bottom');
  tempTBSimple.putData();
 	break;
 	
 	} 
  };
 }

function OpSetSessionActiveApp(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){};
}

 function OpGetFreeInterfaceCanonicalName(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		this.result = actXmlMsg;
 	}
 }
 
 function OpDojoInPreview(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){this.result=actXmlMsg;};
 }