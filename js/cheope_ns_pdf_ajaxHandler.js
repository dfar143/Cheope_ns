 function OpDeleteFile2(actName)
 {
  this.name = actName;
 	this.exec = function(actTxtMsg)
 	{
 	 return;
 	}
 }
 
 function OpCreatePdf(actName)
 {
  this.name = actName;
 	this.exec = function(actTxtMsg)
 	{	
 	 alert(loc.getString('msg',64));
 	 return;
 	}
 }
 
 function OpGetFreeInterfaceCanonicalName(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		this.result = actXmlMsg;
 	}
 }
 
 
 function OpGetPredInterfaces(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
	 var rootEl = actXmlMsg.documentElement;
 	 var childs = rootEl.childNodes;
 	 var predInts = new Array();
 	 var i = 0;
 	 var len = childs.length;
 	 for(var i=0;i<=len-1;i++)
 	 {
 	 	predInt = childs.item(i).firstChild.nodeValue;
 	 	predInts[i] = predInt;
 	 } 
 	 $('#html_tags__7').data('pred_interfaces',predInts);
 	 return;
  }
 }
 
 function OpFileExists(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 		this.testResult = actXmlMsg;
 	}
 }
 
 function OpGetPredInterfaces2(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
 	//console.log(actXmlMsg);
 	var dataSource=interfaces.Generic_interface.translateXmlDataSource2(actXmlMsg);
 	/*console.log('HHHH1');
	console.log(dataSource);
	console.log('HHHH2');*/
 	var int=interfacesContainer.getInterface('getPredInterfaces2');
 	int.setExecOnlyOnFullDataSource(true);
  int.setDataSource(dataSource); 	
  return;
  }
 }
 
 function OpGetFpdfIntProps(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 	//console.log('000');
 	var dataSource = interfaces.Generic_interface.translateXmlDataSource2(actXmlMsg);
 	this.testResult = dataSource;
 	//console.log('ZZZ');
 	//console.log(dataSource);
 	//console.log('ZZZ');
 	}
 }
 
 function OpGetObjTypeByShortName(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){
 		 this.testResult = actXmlMsg;
 	}
 } 
 

 function OpGetPdfTemplates(actName)
 {
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Templates'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Templates');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + 
  childs[i].firstChild.nodeValue + '">' + 
  childs[i].firstChild.nodeValue + '</option>')
 	}
  };
 } 
 
 // imposta i default per un buffer
 //
 function getDefaultsForCtrlBuffer_templates_ajaxHandler(actIntType)
 {
	var buf = {};
	
	var appName = $("#active_application_id").text().replace(/\s*/g,'');
	
  buf.type = actIntType;
  buf.shortName = '';
  buf.appName = appName;
  buf.num = "0";
  buf.op = "";
  buf.pageName = "";
  
  switch(actIntType)
  {
  case "none":
	     buf.dataFields = "";
         buf.dataFieldsDomains = "";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
		 buf.type = "fpdf_field_h";
         break;  
   case "fpdf_field_h" :
	       buf.dataFields = "";
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
         break;
   case "fpdf_field_v" :
	       buf.dataFields = "";
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
         break;
   case "fpdf_img" :
         buf.void1 = "";
         buf.void2 = "";
         buf.void3 = "";
         buf.void4 = "";
         buf.void5 = "";    
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.width = "100";
         buf.fileName = "";
         buf.fileType = "";
         buf.void6 = "";
         buf.void7 = "";
         break;
   case "fpdf_txt" :
	       buf.dataFields = "";
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.width = "100";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.void1 = "";
         buf.void2 = "";
         break;
  case "fpdf_field_template" :
	       buf.dataFields = "";
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "15";
         buf.width = "0";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.align = 'L';
         buf.template = "";
         break;
  }
 buf.tempField = "";
 return buf;
 }
  
  
// imposta i default per gli oggetti
//
function getDefaultsObjBuffer_templates_ajaxHandler()
{
 var objs = {};
 
 var actRow = 0;
 var actCol = 0;
 
 var buf_fpdf_field_h = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_h");
 objs.fpdf_field_h_buf = buf_fpdf_field_h;
 var buf_fpdf_field_v = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_v");
 objs.fpdf_field_v_buf = buf_fpdf_field_v;
 var buf_fpdf_img = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_img");
 objs.fpdf_img_buf = buf_fpdf_img;
 var buf_fpdf_txt = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_txt");
 objs.fpdf_txt_buf = buf_fpdf_txt; 
 var buf_fpdf_field_template = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_template");
 objs.fpdf_field_template_buf = buf_fpdf_field_template;
 var buf_fpdf_field_none = getDefaultsCtrlBuffer(actRow,actCol,"none");
 objs.none_buf = buf_fpdf_field_none; 
 return objs;
}
 
 function OpViewPdfTemplateGridOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
	  var rootEl = actXmlMsg.documentElement;
	  /*console.log('AAAAAA1');
	  console.log(rootEl);
	  console.log('AAAAAA2');*/
 	  var childs = rootEl.childNodes;	 
    var gridDimX = childs[1].firstChild.nodeValue;
    var gridDimY = childs[2].firstChild.nodeValue;
    
    $('#gridView_id > div').detach();
    $('#gridView_id > img').detach();

    add_row_to_grid();
    add_column_to_grid_row(1,'none');
      
    var htmlDataInterfaceObj = interfaces.createHtmlDataInterface('','','0');
        
    var dataFieldsLen = childs[3].childNodes.length;
    var dataFields1 = new Array();
    var i=0;
    for(var i=0;i<=dataFieldsLen-1;i++)
    {
    	var ind = childs[3].childNodes[i].attributes[1].value;
    	dataFields1[ind] = childs[3].childNodes[i].firstChild.nodeValue;
    }
    htmlDataInterfaceObj.setDataFields(dataFields1);
    var dataFields = dataFields1; 

    //console.log(dataFields);
    
    var dataFieldsDomainsLen = childs[4].childNodes.length;
    var dataFieldsDomains1 = new Array();
    for(var i=0;i<=dataFieldsDomainsLen-1;i++)
    {
    	var ind = childs[4].childNodes[i].attributes[1].value;
    	dataFieldsDomains1[ind] = childs[4].childNodes[i].firstChild.nodeValue;
    } 
    var dataFieldsDomains = htmlDataInterfaceObj.convertToKeysNumeric(dataFieldsDomains1,""); 
           
    var dataFieldsDomainsValuesLen = childs[5].childNodes.length;
    var dataFieldsDomainsValues1 = new Object();
  //
  // Estrae per ogni interfaccia come valore del dominio, tutte le proprietà della stessa
  //
    var intProps = new Object();
    for(var i=0;i<=dataFieldsDomainsValuesLen-1;i++)
    {
    	var dataFieldDomainsValues = new Array();
    	var ind = childs[5].childNodes[i].attributes[1].value;
    	var type = childs[5].childNodes[i].attributes[0].value;
    	var nomeInt = childs[5].childNodes[i].firstChild.nodeValue;
    	//console.log('AAA');
      //console.log(nomeInt);
      //console.log('BBB');
    	if(nomeInt.replace(/\s*/g,'') !== '')
    	{
    	 ajaxHandler.synServerCall('ajax_handler.php','getFpdfIntProps',nomeInt,'xml',/CDATA/);
    	 intProps[ind] = ajaxHandler.getOpByName('getFpdfIntProps').testResult;
    	 //console.log(ind); 
    	 //console.log(intProps[ind]);  	
      }
      else
       intProps[ind] = {};
      dataFieldsDomainsValues1[ind] = nomeInt; 	
    }
    //console.log('BBB1');
    //console.log(intProps);

    var dataFieldsDomainsValues = htmlDataInterfaceObj.convertToKeysNumeric(dataFieldsDomainsValues1,""); 
    //console.log('KKKKK1');
    //console.log(dataFieldsDomainsValues);
    //console.log('KKKKK2');
    //
    // Estrazione dati oggetti controllo
    //
    var ctrl = [];
	//console.log(dataFields)
    for(var ind in dataFields)
    {       
      var domain = dataFieldsDomains[ind];
      var domainValue = dataFieldsDomainsValues[ind];
     // console.log("AAA");
	 // console.log(domainValue);
	 // console.log(ind);
	 // console.log("AAA");
	  if(domainValue.replace(/\s*/g,'') !== '')
      {
       ajaxHandler.synServerCall('ajax_handler.php','getObjTypeByShortName',domainValue,'text',/[\s\._\:A-Za-z0-9;\-]*/);
       var intType = ajaxHandler.getOpByName('getObjTypeByShortName').testResult;
      }
      else
      	intType = 'none';

      ctrl[ind] = {};	
      	
      var intShortName = domainValue;
	  if(ind==0)
		var firstElShortName = intShortName;
      ctrl[ind] = getDefaultsForCtrlBuffer_templates_ajaxHandler(intType);
      ctrl[ind].tempField = dataFields[ind]; 
      //console.log('BBB');
      //console.log(intShortName);
      //console.log('BBB');	  
      ctrl[ind].shortName = intShortName;  
      ctrl[ind].type = intType;
      
     //console.log(intProps);
      
     for(var item in intProps[ind])
      {
      	if(util.is_array(intProps[ind][item]))
      	{
      	 var i=0;
      	 for(var item1 in intProps[ind][item])
      	 {
      	 	if(i==0)
      	 	 ctrl[ind][item] = intProps[ind][item][item1];
      	 	else
      	   ctrl[ind][item] = ctrl[ind][item] + '#' + intProps[ind][item][item1];
      	  i++;
      	 }
      	}
      	else
      	 ctrl[ind][item] = intProps[ind][item];        
	  }	  
      if((ctrl[ind].dataFields !== undefined)&&(ctrl[ind].dataFields.replace(/\s*/g,'') == ''))
       ctrl[ind].dataFields = dataFields[ind];       
    }       
    /*alert('WWWWWWWW1');  
    console.log(ctrl);
    alert('WWWWWWWW2');	*/
    var x=0;
    var y=0;
    i=1; 
    var objBuf = getDefaultsObjBuffer_templates_ajaxHandler();
    //console.log(ctrl)
    objBuf.type = ((ctrl.length !== 0)?(ctrl[0].type):(''));
	//console.log(ctrl.length);
	//console.log(ctrl[0].shortName);
    objBuf.shortName = ((ctrl.length !== 0)?(ctrl[0].shortName):(''));
    var type = objBuf.type;
    objBuf[type + '_buf'] = ctrl[0];
    $('#ctrl_id_0_0').data('buffer',objBuf);  
    //console.log(ctrl[0].shortName);
    util.setSelectedItem($('#ctrl_id_0_0').get(0),
    ((objBuf.shortName=='none')?'none':( (objBuf.shortName=='')?firstElShortName:objBuf.shortName)));
    while(i<=dataFieldsLen-1)
    { 
     if(x>=gridDimX-1)
     {
     	add_row_to_grid();   
      y++;
      x=0;
      var objBuf = getDefaultsObjBuffer_templates_ajaxHandler();
      objBuf.type = ctrl[i].type;
      objBuf.shortName = ctrl[i].shortName;
      var type = objBuf.type;  
      objBuf[type + '_buf'] = ctrl[i];
      if(((type=='fpdf_field_h')||(type=='fpdf_field_v')||(type=='fpdf_txt')||(type=='fpdf_field_template')) && (objBuf[type + '_buf'].dataFields == ''))      
       objBuf[type + '_buf'].dataFields = "campo_" + y + '_' + x;
      objBuf[type + '_buf'].tempField = 
      ((objBuf[type + '_buf'].tempField == '')?("campo_" + y + '_' + x):objBuf[type + '_buf'].tempField);
      $('#ctrl_id_' + y + '_' + x).data('buffer',objBuf);
     	util.setSelectedItem($('#ctrl_id_' + y + '_' + x).get(0),
     	((ctrl[i].shortName=='none')?'none':ctrl[i].shortName));
      i++;
     }
     else
     {
      add_column_to_grid_row(y,ctrl[i].shortName);
      x++;
      var objBuf = getDefaultsObjBuffer_templates_ajaxHandler();
      objBuf.type = ctrl[i].type;
      objBuf.shortName = ctrl[i].shortName;
      var type = objBuf.type;
      objBuf[type + "_buf"] = ctrl[i];
      if(((type=='fpdf_field_h')||(type=='fpdf_field_v')||(type=='fpdf_txt')||(type=='fpdf_field_template')) && 
      (objBuf[type + '_buf'].dataFields == ''))      
       objBuf[type + '_buf'].dataFields = "campo_" + y + '_' + x;
      objBuf[type + '_buf'].tempField = 
      ((objBuf[type + '_buf'].tempField == '')?("campo_" + y + '_' + x):objBuf[type + '_buf'].tempField);
      $('#ctrl_id_' + y + '_' + x).data('buffer',objBuf);
      util.setSelectedItem($('#ctrl_id_' + y + '_' + x).get(0),
      ((ctrl[i].shortName=='none')?'none':ctrl[i].shortName));
      //alert('JJJJ');
      //console.log();
      i++;
     }
    }                         
 	} 	
 }
 
 function OpSavePdfTemplate(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg){alert(loc.getString('msg',13));};
 }
 
 function OpSetSessionActiveApp(actName)
 {
	this.name = actName;
	this.exec = function(actXmlMsg)
 {  	
 };	
 }
 
  function OpCreatePreview(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 };	
}


 
 
 