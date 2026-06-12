function OpGetAllInterfacesOfPage(actName)
{
 	this.name = actName;
 	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#select_fieldObjName_id'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('select_fieldObjName_id');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + childs[i].firstChild.nodeValue + 
  '">' + childs[i].firstChild.nodeValue + '</option>')
 	}
  }
}