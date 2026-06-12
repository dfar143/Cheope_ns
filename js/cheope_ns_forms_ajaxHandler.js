 function OpGetFormSections(actName)
 {
	this.name = actName;
	this.exec = function(actXmlMsg){
	var rootEl = actXmlMsg.documentElement;
 	var selectField = $('#Forms'); 	
	var len = rootEl.childNodes.length;
 	var childs = rootEl.childNodes;
 	util.deleteSelectFieldContents('Forms');
 	selectField.append('<option selected value=""></option>');
 	for(var i=0;i<=len-1;i++)
 	{
  selectField.append('<option value="' + 
  childs[i].firstChild.nodeValue + '">' + 
  childs[i].firstChild.nodeValue + '</option>')
 	}
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
 
 // imposta i default per un buffer
 //
 function getDefaultsForCtrlBuffer_forms_ajaxHandler()
 {
	var buf = {};
	
	buf.name = "";
  buf.domain = "atomic";
  buf.domainValue = "";
  buf.fieldColClass = "";   
  buf.fieldColStyle = "";
  buf.fieldLabel = "";
  buf.fieldStyle = "";
  buf.fieldType = "";
  buf.fieldLength = 10;
  buf.fieldStop = 10;
  buf.fieldHint = "";
  buf.fieldToolTip = "";
  buf.fieldEvents = [];
  buf.fieldRegexp = "";
  buf.label = "";
  buf.fieldDirection = "",
  buf.fieldDefaultValue = "";
  buf.mandatoryField = "";
  
  return buf;
 }
 
 // imposta i default per i valori comuni di un buffer
 //
 function getDefaultsCommonForCtrlBuffer_forms_ajaxHandler()
 {
	var buf = {};
	
	buf.rowsStyle = "";
  buf.rowsClass = "";
  buf.rowsStyles = new Array();
  buf.rowsClasses = new Array();
  buf.labelSpacerWidth = 1;
  buf.cellPadding = 0;
  buf.cellSpacing = 0;
  buf.javascriptEnabled = true;
  buf.style = "";   
  
  return buf;
 } 
 
 
 
// imposta i default per i buffers di dominio
//
function getDefaultsDomainBuffer_forms_ajaxHandler()
{
 var domains = {};
 
 var actRow = 0;
 var actCol = 0;
 
 domains.domain = "atomic";
 var buf_atomic = getDefaultsCtrlBuffer(actRow,actCol,"atomic");
 domains.domain_atomic_buf = buf_atomic;
 var buf_atomic_static = getDefaultsCtrlBuffer(actRow,actCol,"atomic_static");
 domains.domain_atomic_static_buf = buf_atomic_static;
 var buf_set = getDefaultsCtrlBuffer(actRow,actCol,"set");
 domains.domain_set_buf = buf_set;
 var buf_check = getDefaultsCtrlBuffer(actRow,actCol,"check");
 domains.domain_check_buf = buf_check; 
 var buf_radio = getDefaultsCtrlBuffer(actRow,actCol,"radio");
 domains.domain_radio_buf = buf_radio;
 var buf_multiple = getDefaultsCtrlBuffer(actRow,actCol,"multiple");
 domains.domain_multiple_buf = buf_multiple;
 var buf_password = getDefaultsCtrlBuffer(actRow,actCol,"password");
 domains.domain_password_buf = buf_password;
 var buf_file = getDefaultsCtrlBuffer(actRow,actCol,"file");
 domains.domain_file_buf = buf_file;
 var buf_hidden = getDefaultsCtrlBuffer(actRow,actCol,"hidden");
 domains.domain_hidden_buf = buf_hidden;
 var buf_none = getDefaultsCtrlBuffer(actRow,actCol,"none");
 domains.domain_none_buf = buf_none;
 var buf_object = getDefaultsCtrlBuffer(actRow,actCol,"object");
 domains.domain_object_buf = buf_object;
 var buf_common = getDefaultsCommon();
 domains.domain_common_buf = buf_common;
  
 return domains;
}

 
 function OpViewFormsSectionGridOp1(actName)
 {
 	this.name = actName;
 	this.exec = function(actXmlMsg)
 	{
	  var rootEl = actXmlMsg.documentElement;
 	  var childs = rootEl.childNodes;	  
    var gridDimX = childs[3].firstChild.nodeValue;
    var gridDimY = childs[4].firstChild.nodeValue;

    var htmlDataInterfaceObj = interfaces.createHtmlDataInterface('','','0');
    
    var rowsStylesLen = childs[5].childNodes.length;
    var rowsStyles1 = new Array();
    for(var i=0;i<=rowsStylesLen-1;i++)
    {
    	var ind = childs[5].childNodes[i].attributes[1].value;
    	rowsStyles1[ind] = childs[5].childNodes[i].firstChild.nodeValue;
    } 
    var rowsStyles = rowsStyles1; 
    var rowsClassesLen = childs[6].childNodes.length;
    var rowsClasses1 = new Array();
    for(var i=0;i<=rowsClassesLen-1;i++)
    {
    	var ind = childs[6].childNodes[i].attributes[1].value;
    	rowsClasses1[ind] = childs[6].childNodes[i].firstChild.nodeValue;
    } 
    var rowsClasses = rowsClasses1;      
  
    var rowsStyle = childs[7].firstChild.nodeValue;
    var rowsClass = childs[8].firstChild.nodeValue;
    var labelSpacerWidth = childs[9].firstChild.nodeValue;
    var cellPadding = childs[10].firstChild.nodeValue;
    var cellSpacing = childs[11].firstChild.nodeValue;
    var javascriptEnabled = childs[12].firstChild.nodeValue;
    var style = childs[13].firstChild.nodeValue;   

    $('#gridView_id > div').detach();
    $('#gridView_id > img').detach();

    add_row_to_grid();
    add_column_to_grid_row(1,'atomic');
        
    var dataFieldsLen = childs[14].childNodes.length;
    var dataFields1 = new Array();
    var i=0;
    for(var i=0;i<=dataFieldsLen-1;i++)
    {
    	var ind = childs[14].childNodes[i].attributes[1].value;
    	dataFields1[ind] = childs[14].childNodes[i].firstChild.nodeValue;
    }
    htmlDataInterfaceObj.setDataFields(dataFields1);
    var dataFields = dataFields1;
    
    var dataFieldsDomainsLen = childs[15].childNodes.length;
    var dataFieldsDomains1 = new Array();
    for(var i=0;i<=dataFieldsDomainsLen-1;i++)
    {
    	var ind = childs[15].childNodes[i].attributes[1].value;
    	dataFieldsDomains1[ind] = childs[15].childNodes[i].firstChild.nodeValue;
    } 
    var dataFieldsDomains = htmlDataInterfaceObj.convertToKeysNumeric(dataFieldsDomains1,""); 
           
    var dataFieldsDomainsValuesLen = childs[16].childNodes.length;
    var dataFieldsDomainsValues1 = new Object();
    var typeFlag = false;
  
    //console.log(childs[13]);
    //console.log(childs[13].childNodes[0]);
    //console.log(childs[13].childNodes[0].type);
    //console.log(childs[13].childNodes[0].childNodes);
  
    for(var i=0;i<=dataFieldsDomainsValuesLen-1;i++)
    {
    	var dataFieldDomainsValues = new Array();
    	var ind = childs[16].childNodes[i].attributes[1].value;
    	var type = childs[16].childNodes[i].attributes[0].value;
		//console.log(type);
    	if(type == "array")
    	{
    	 typeFlag = true;
       dataFieldDomainsValuesLen = childs[16].childNodes[i].childNodes.length;
       //var dataFieldDomainsValues = new Object();
       for(var j=0;j<=dataFieldDomainsValuesLen-1;j++)
       {
      	ind1 = childs[16].childNodes[i].childNodes[j].attributes[1].value;
      	dataFieldDomainsValues[ind1] = childs[16].childNodes[i].childNodes[j].firstChild.nodeValue;     	
       }
       dataFieldsDomainsValues1[ind] = dataFieldDomainsValues;
      }
      else
      {
       dataFieldsDomainsValues1[ind] = childs[16].childNodes[i].firstChild.nodeValue; 	
      }
    }

    if(typeFlag)
     var dataFieldsDomainsValues = htmlDataInterfaceObj.convertToKeysNumeric(dataFieldsDomainsValues1,""); 
    else
     var dataFieldsDomainsValues = dataFieldsDomainsValues1;

    //console.log("WWWWWWWWWWWWWWWWWWWWWWW");
    //console.log(dataFieldsDomainsValues);
	//console.log("WWWWWWWWWWWWWWWWWWWWWWW");

    var fieldsColStylesLen = childs[17].childNodes.length;
    var fieldsColStyles1 = new Array();
    for(var i=0;i<=fieldsColStylesLen-1;i++)
    {
    	var ind = childs[17].childNodes[i].attributes[1].value;    	
    	fieldsColStyles1[ind] = childs[17].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsColStyles = htmlDataInterfaceObj.convertToKeysNumeric(fieldsColStyles1,""); 

    var fieldsColClassesLen = childs[18].childNodes.length;
    var fieldsColClasses1 = new Array();
    for(var i=0;i<=fieldsColClassesLen-1;i++)
    {
    	var ind = childs[18].childNodes[i].attributes[1].value;    	
    	fieldsColClasses1[ind] = childs[18].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsColClasses = htmlDataInterfaceObj.convertToKeysNumeric(fieldsColClasses1,""); 

    var fieldsStylesLen = childs[19].childNodes.length;
    var fieldsStyles1 = new Array();
    for(var i=0;i<=fieldsStylesLen-1;i++)
    {
    	var ind = childs[19].childNodes[i].attributes[1].value;    	
    	fieldsStyles1[ind] = childs[19].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsStyles = htmlDataInterfaceObj.convertToKeysNumeric(fieldsStyles1,""); 
       
    var fieldsLabelsLen = childs[20].childNodes.length;
    var fieldsLabels1 = new Array();
    for(var i=0;i<=fieldsLabelsLen-1;i++)
    {
    	var ind = childs[20].childNodes[i].attributes[1].value;
    	fieldsLabels1[ind] = childs[20].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsLabels = htmlDataInterfaceObj.convertToKeysNumeric(fieldsLabels1,""); 
    
    var fieldsTypesLen = childs[21].childNodes.length;
    var fieldsTypes1 = new Array();
    for(var i=0;i<=fieldsTypesLen-1;i++)
    {
    	var ind = childs[21].childNodes[i].attributes[1].value;
    	fieldsTypes1[ind] = childs[21].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsTypes = htmlDataInterfaceObj.convertToKeysNumeric(fieldsTypes1,"");     
        
    var fieldsStopsLen = childs[22].childNodes.length;
    var fieldsStops1 = new Array();
    for(var i=0;i<=fieldsStopsLen-1;i++)
    {
    	var ind = childs[22].childNodes[i].attributes[1].value;
    	fieldsStops1[ind] = childs[22].childNodes[i].firstChild.nodeValue;
    }
    var fieldsStops = htmlDataInterfaceObj.convertToKeysNumeric(fieldsStops1,"");    
     
    var fieldsLengthsLen = childs[23].childNodes.length;
    var fieldsLengths1 = new Array();
    for(var i=0;i<=fieldsLengthsLen-1;i++)
    {
    	var ind = childs[23].childNodes[i].attributes[1].value;
    	fieldsLengths1[ind] = childs[23].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsLengths = htmlDataInterfaceObj.convertToKeysNumeric(fieldsLengths1,"");    
    
    var mandatoryFieldsLen = childs[24].childNodes.length;
    var mandatoryFields1 = new Array();
    for(var i=0;i<=mandatoryFieldsLen-1;i++)
    {
    	var ind = childs[24].childNodes[i].attributes[1].value;
    	mandatoryFields1[ind] = childs[24].childNodes[i].firstChild.nodeValue;
    }
    var mandatoryFields = htmlDataInterfaceObj.convertToKeysNumeric(mandatoryFields1,"");    
    
    var fieldsDefaultValuesLen = childs[25].childNodes.length;
    var fieldsDefaultValues1 = new Array();
    for(var i=0;i<=fieldsDefaultValuesLen-1;i++)
    {
    	var ind = childs[25].childNodes[i].attributes[1].value;
    	fieldsDefaultValues1[ind] = childs[25].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsDefaultValues = htmlDataInterfaceObj.convertToKeysNumeric(fieldsDefaultValues1,"");    
    
    var fieldsHintsLen = childs[26].childNodes.length;
    var fieldsHints1 = new Array();
    for(var i=0;i<=fieldsHintsLen-1;i++)
    {
    	var ind = childs[26].childNodes[i].attributes[1].value;
    	fieldsHints1[ind] = childs[26].childNodes[i].firstChild.nodeValue;
    }
    var fieldsHints = htmlDataInterfaceObj.convertToKeysNumeric(fieldsHints1,"");       
        
    var fieldsEventsLen = childs[27].childNodes.length;
    var fieldsEvents1 = new Object();
    for(var i=0;i<=fieldsEventsLen-1;i++)
    {
    	var fieldEvents = new Array();
    	var ind = childs[27].childNodes[i].attributes[1].value;
    	fieldEventsLen = childs[27].childNodes[i].childNodes.length;
    	for(var j=0;j<=fieldEventsLen-1;j++)
    	{
    		var ind1 = childs[27].childNodes[i].childNodes[j].attributes[1].value;
    		fieldEvents[ind1] = childs[27].childNodes[i].childNodes[j].firstChild.nodeValue;
    	}
    	fieldsEvents1[ind] = fieldEvents;
    }   
    var fieldsEvents = htmlDataInterfaceObj.convertToKeysNumeric(fieldsEvents1,"");
    
    var fieldsRegexpsLen = childs[28].childNodes.length;
    var fieldsRegexps1 = new Array();
    for(var i=0;i<=fieldsRegexpsLen-1;i++)
    {
    	var ind = childs[28].childNodes[i].attributes[1].value;
    	fieldsRegexps1[ind] = childs[28].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsRegexps = htmlDataInterfaceObj.convertToKeysNumeric(fieldsRegexps1,"");    

    var labelsLen1 = childs[29].childNodes.length;
	//console.log(childs[29].childNodes.length);
    var labels1 = new Object();
    for(var i=0;i<=labelsLen1-1;i++)
    {
    	var labels2 = new Array();
    	var ind = childs[29].childNodes[i].attributes[1].value;
    	labelsLen2 = childs[29].childNodes[i].childNodes.length;
		//console.log(labelsLen);
    	var nodeType = childs[29].childNodes[i].childNodes[0].nodeType;
		//console.log(nodeType);
		//console.log(childs[29].childNodes[i].childNodes);
		//console.log(childs[29].childNodes[i].childNodes[0]);
    	if(nodeType !== 4)
    	{
    	 for(var j=0;j<=labelsLen2-1;j++)
    	 {
    		var ind1 = childs[29].childNodes[i].childNodes[j].attributes[1].value;
    		labels2[ind1] = childs[29].childNodes[i].childNodes[j].firstChild.nodeValue;
    	 }   
		 //console.log(labels2);
    	 labels1[ind] = labels2; 		
    	}
    	else
    	{
       labels1[ind] = childs[29].childNodes[i].firstChild.nodeValue;
      }
    } 
    //console.log(childs[29]);	
    var labels = htmlDataInterfaceObj.convertToKeysNumeric(labels1,""); 
    var fieldsTooltipsLen = childs[30].childNodes.length;
    var fieldsToolTips1 = new Array();
    for(var i=0;i<=fieldsTooltipsLen-1;i++)
    {
    	var ind = childs[30].childNodes[i].attributes[1].value;
    	fieldsToolTips1[ind] = childs[30].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsToolTips = htmlDataInterfaceObj.convertToKeysNumeric(fieldsToolTips1,"");   

    var fieldsDirectionsLen = childs[31].childNodes.length;
    var fieldsDirections1 = new Array();
    for(var i=0;i<=fieldsDirectionsLen-1;i++)
    {
    	var ind = childs[31].childNodes[i].attributes[1].value;
    	fieldsDirections1[ind] = childs[31].childNodes[i].firstChild.nodeValue;
    } 
    var fieldsDirections = htmlDataInterfaceObj.convertToKeysNumeric(fieldsDirections1,"");   

    //
    // Estrazione dati oggetti controllo
    //
    var ctrl = [];
    var ctrlCommon = []; 
    
    for(var ind in dataFields)
    {
    	var bufCommonDefault = getDefaultsCommonForCtrlBuffer_forms_ajaxHandler();
    	ctrlCommon[ind] = bufCommonDefault;
    	ctrlCommon[ind].rowStyle = rowsStyles[ind];
    	ctrlCommon[ind].rowClass = rowsClasses[ind];
    	ctrlCommon[ind].rowsStyle = rowsStyle;
    	ctrlCommon[ind].rowsClass = rowsClass;
    	ctrlCommon[ind].labelSpacerWidth = labelSpacerWidth;
    	ctrlCommon[ind].cellPadding = cellPadding;
    	ctrlCommon[ind].cellSpacing = cellSpacing;
    	ctrlCommon[ind].javascriptEnabled = javascriptEnabled;
    	ctrlCommon[ind].style = style;
    	var bufDefault = getDefaultsForCtrlBuffer_forms_ajaxHandler();
    	ctrl[ind] = bufDefault;
    	ctrl[ind].name = dataFields[ind];
    	var domain = dataFieldsDomains[ind];
    	ctrl[ind].domain = domain;
    	var domainValue = dataFieldsDomainsValues[ind];
      ctrl[ind].domainValue = domainValue;
      if(domain == 'object')
       ctrl[ind].fieldObjName = domainValue;
      else
       ctrl[ind].fieldObjName = '';      
      var fieldColStyle = fieldsColStyles[ind];
      ctrl[ind].fieldColStyle = fieldColStyle;
      var fieldLabel = fieldsLabels[ind];
      ctrl[ind].fieldLabel = fieldLabel;
      
      var fieldStyle = fieldsStyles[ind];
      var fieldType = fieldsTypes[ind];
      var fieldLength = fieldsLengths[ind];
      var fieldStop = fieldsStops[ind];
      var fieldHint = fieldsHints[ind];
      var fieldToolTip = fieldsToolTips[ind];
      var fieldEvents = fieldsEvents[ind];
      var fieldRegexp = fieldsRegexps[ind];
      var fieldDefaultValue = fieldsDefaultValues[ind]; 
      var mandatoryField = mandatoryFields[ind];
      var label = labels[ind];
      var fieldDirection = fieldsDirections[ind];
        
    	switch(domain)
    	{
    		case "atomic":
         ctrl[ind].fieldType = fieldType;
         ctrl[ind].fieldStyle = fieldStyle;
         ctrl[ind].fieldLength = fieldLength;
         ctrl[ind].fieldStop = fieldStop;
         ctrl[ind].fieldHint = fieldHint;
         ctrl[ind].fieldToolTip = fieldToolTip;
         ctrl[ind].fieldEvents = fieldEvents;
         ctrl[ind].fieldRegexp = fieldRegexp;
         ctrl[ind].fieldDefaultValue = fieldDefaultValue;
         ctrl[ind].mandatoryField = mandatoryField;
    		 break;
    		case "atomic_static":
    		 ctrl[ind].fieldType = fieldType;
    		 ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldToolTip = fieldToolTip;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		break;
    		case "set":
    		 ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		 ctrl[ind].fieldDefaultValue = fieldDefaultValue;
         ctrl[ind].fieldStop = fieldStop;
         ctrl[ind].fieldHint = fieldHint;
         ctrl[ind].fieldToolTip = fieldToolTip;
         ctrl[ind].fieldRegexp = fieldRegexp;
         ctrl[ind].mandatoryField = mandatoryField;
    		break;
    		case "check":
   		   ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		 ctrl[ind].fieldLength = fieldLength;
         ctrl[ind].fieldToolTip = fieldToolTip;
    		break;
    		case "radio":
    		 ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		 ctrl[ind].fieldDefaultValue = fieldDefaultValue;
    		 ctrl[ind].label = label;
    		 ctrl[ind].fieldToolTip = fieldToolTip;
    		 ctrl[ind].fieldDirection = fieldDirection;
    		break;
    		case "multiple":
   		   ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
         ctrl[ind].fieldDefaultValue = fieldDefaultValue;
    		 ctrl[ind].fieldLength = fieldLength;
         ctrl[ind].fieldToolTip = fieldToolTip;
    		break;
        case "password":
    		 ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		 ctrl[ind].fieldDefaultValue = fieldDefaultValue;
    		 ctrl[ind].fieldLength = fieldLength;
    		 ctrl[ind].fieldType = fieldType;
         ctrl[ind].fieldStop = fieldStop;
         ctrl[ind].fieldToolTip = fieldToolTip;
         ctrl[ind].fieldRegexp = fieldRegexp;
         ctrl[ind].mandatoryField = mandatoryField;
        break;
        case "file":
   		   ctrl[ind].fieldStyle = fieldStyle;
    		 ctrl[ind].fieldEvents = fieldEvents;
    		 ctrl[ind].fieldDefaultValue = fieldDefaultValue;
    		 ctrl[ind].fieldLength = fieldLength;
    		 ctrl[ind].fieldType = fieldType;
         ctrl[ind].fieldStop = fieldStop;
         ctrl[ind].fieldToolTip = fieldToolTip;
         ctrl[ind].mandatoryField = mandatoryField;
        break;
        case "hidden":
         ctrl[ind].fieldEvents = fieldEvents;
        break;
        case "none":
        break;
    	}
    }       
       
    var x=0;
    var y=0;
    i=1; 
    var domainBuf = getDefaultsDomainBuffer_forms_ajaxHandler();
    domainBuf.domain = ctrl[0].domain;
    var domain = domainBuf.domain;
    ctrlCommon[0].rowStyle = rowsStyles[0];
    ctrlCommon[0].rowClass = rowsClasses[0];
    domainBuf["domain_common_buf"] = ctrlCommon[0];
    domainBuf["domain_" + domain + "_buf"] = ctrl[0];
    $('#ctrl_id_0_0').data('buffer',domainBuf);
	//console.log(domainBuf);
    util.setSelectedItem($('#ctrl_id_0_0').get(0),ctrl[0].domain);
    while(i<=dataFieldsLen-1)
    { 
     if(x>=gridDimX-1)
     {
     	add_row_to_grid(ctrl[i].domain);      
      y++;
      x=0;
      var domainBuf = getDefaultsDomainBuffer_forms_ajaxHandler();
      domainBuf.domain = ctrl[i].domain;
      var domain = domainBuf.domain;
      ctrlCommon[i].rowStyle = rowsStyles[y];
      ctrlCommon[i].rowClass = rowsClasses[y];      
      domainBuf["domain_common_buf"] = ctrlCommon[i];
      domainBuf["domain_" + domain + "_buf"] = ctrl[i];
      $('#ctrl_id_' + y + '_' + x).data('buffer',domainBuf);
	  console.log(domainBuf);
     	util.setSelectedItem($('#ctrl_id_' + y + '_' + x).get(0),ctrl[i].domain);
      i++;
     }
     else
     {
      add_column_to_grid_row(y,ctrl[i].domain);
      x++;
      var domainBuf = getDefaultsDomainBuffer_forms_ajaxHandler();
      domainBuf.domain = ctrl[i].domain;
      var domain = domainBuf.domain;
      domainBuf["domain_" + domain + "_buf"] = ctrl[i];
      ctrlCommon[i].rowStyle = rowsStyles[y];
      ctrlCommon[i].rowClass = rowsClasses[y]; 
      domainBuf["domain_common_buf"] = ctrlCommon[i];
      $('#ctrl_id_' + y + '_' + x).data('buffer',domainBuf);
	  //console.log(domainBuf);
      util.setSelectedItem($('#ctrl_id_' + y + '_' + x).get(0),ctrl[i].domain);
      i++;
     }
    }                         
 	} 	
 }
 
 
 function OpSaveFormSection(actName)
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
 
 
 