function Html_data_interface(actOp,actType,actNum)
{
	this.setOp(actOp);
	this.setType(actType);
	this.setNum(actNum);
	
	this.page = '';
	this.getPage = function()
	{
		return this.page;
	}
	this.setPage = function(actPage)
	{
		this.page = actPage;
	}

	this.dataFields = new Array();
	this.getDataFields = function()
	{
		return this.dataFields;
	};
	this.setDataFields = function(actDataFields)
	{
		this.dataFields = actDataFields;
	};
	this.addField=function(actFieldName,actDomainValue,actDomainName)
	{
	 var dataFields = this.getDataFields();
	 var domainName;
	 var domainValue;
   if(actDomainName===undefined)
//
// Provo a indovinare il
// dominio a partire dal valore
//	 
   {
   	if(util.is_array(actDomainValue))
   	 domainName = 'set';
   	else if((typeof actDomainValue)=='object')
   	 domainName = 'object';
   	else if(((typeof actDomainValue)=='string')||((typeof actDomainValue)=='number'))
   	 domainName = 'atomic';    	 
   }
   else
   	domainName = actDomainName;
   domainValue = actDomainValue;	 
   if(! util.in_array(actFieldName,dataFields))
	 { 
	  dataFields[dataFields.length]=actFieldName; 
	  var dataFieldsDomains = this.getDataFieldsDomains();
	  dataFieldsDomains[dataFieldsDomains.length] = domainName;
	  var domObj = this.createDomainObj(domainName);
	  domObj.setValue(domainValue);
	  var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	  dataFieldsDomainsObjs[dataFieldsDomainsObjs.length] = domObj;
	  var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	  dataFieldsDomainsValues[dataFieldsDomainsValues.length] = domainValue;
	 }
	 else
	 {
	 	var dataFieldPos = util.array_getPos(actFieldName,dataFields);
	  dataFields[dataFieldPos]=actFieldName; 
	  var dataFieldsDomains = this.getDataFieldsDomains();
	  dataFieldsDomains[dataFieldPos] = domainName;
	  var domObj = this.createDomainObj(domainName);
	  domObj.setValue(domainValue);
	  var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	  dataFieldsDomainsObjs[dataFieldPos] = domObj;
	  var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	  dataFieldsDomainsValues[dataFieldPos] = domainValue;	 	
	 }
	};
	this.dataFieldsDomains = new Array();
  this.setDataFieldsDomains = function(actDataFieldsDomains)
  {
  	this.dataFieldsDomains = actDataFieldsDomains;
  	var num1 = actDataFieldsDomains.length;
  	var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
  	var num2 = dataFieldsDomainsObjs.length;
  	dataFieldsDomainsObjs = new Array();
  	for(var i=0;i<=num1-1;i++)
  	{
  	 var domName = this.dataFieldsDomains[i];
  	 var domObj = this.createDomainObj(domName);
  	 dataFieldsDomainsObjs[i] = domObj;
  	}
  	this.setDataFieldsDomainsObjs(dataFieldsDomainsObjs);
  };
  this.getDataFieldsDomains = function()
  {
  	return this.dataFieldsDomains;
  };
  this.getDataFieldDomainByPos = function(actPos)
  {
  	var fieldsDomains = this.getDataFieldsDomains();
  	if(actPos<=fieldsDomains.length-1)
  	 return fieldsDomains[actPos];
  	else
  	 return false;
  };
  this.setDataFieldDomainByPos = function(actPos,actVal)
  {
   var fieldsDomains = this.getDataFieldsDomains();
	 fieldsDomains[actPos] = actVal;
	 var domObj = this.createDomainObj(actVal);
   this.setDataFieldDomainObjByPos(actPos,domObj);  	
  }; 
  this.getDataFieldDomainByName = function(actFieldName)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomains = this.getDataFieldsDomains();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if ((fields[i] == actFieldName)&&(dataFieldsDomains[i] !== undefined))
	  {
	   return dataFieldsDomains[i];
	  }
	 }
	 return false;  	
  };
  this.setDataFieldDomainByName = function(actFieldName,actVal)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomains = this.getDataFieldsDomains();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if (fields[i] == actFieldName)
	  {
	   dataFieldsDomains[i] = actVal;
	   var domObj = this.createDomainObj(actVal);
	   if(this.setDataFieldDomainObjByName(actFieldName,domObj))
		  return true;
		 else
		 	return false;
	  }
	 }
	 return false;  	
  };

	this.dataFieldsDomainsObjs = new Array();
	this.createDomainObj = function(actDomName)
	{
		var objConstructorName = "Int_domain_" + actDomName;
		var domObj = eval("new " + objConstructorName + "();");
		return domObj;
	}
	this.getDataFieldsDomainsObjs = function()
	{
		return this.dataFieldsDomainsObjs;
	}
	this.setDataFieldsDomainsObjs = function(actDataFieldsDomainsObjs)
	{
		this.dataFieldsDomainsObjs = actDataFieldsDomainsObjs;
  }
  this.getDataFieldDomainObjByPos = function(actPos)
  {
   var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	 if (actPos <= dataFieldsDomainsObjs.length-1)
	  return dataFieldsDomainsObjs[actPos];
	 else
	  return false;  	
  }
  this.getDataFieldDomainObjByName = function(actFieldName)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if ((fields[i] == actFieldName)&&(dataFieldsDomainsObjs[i] !== undefined))
	  {
	   return dataFieldsDomainsObjs[i];
	  }
	 }
	 return false; 	
  }
  this.setDataFieldDomainObjByPos = function(actPos,actDomObj)
  {
   var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
 	 dataFieldsDomainsObjs[actPos] = actDomObj;  	
  }
  this.setDataFieldDomainObjByName = function(actFieldName,actDomObj)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if (fields[i] == actFieldName)
	  {
	   dataFieldsDomainsObjs[i] = actDomObj;
		 return true;
	  }
	 }
	 return false;  	
  }
	this.dataFieldsDomainsValues = new Array();
  this.getDataFieldsDomainsValues = function()
  {
  	return this.dataFieldsDomainsValues;
  }
  this.setDataFieldsDomainsValues = function(actDataFieldsDomainsValues)
  {
  	this.dataFieldsDomainsValues = actDataFieldsDomainsValues;
  	var num1 = this.dataFieldsDomainsValues.length;
  	var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
  	var num2 = dataFieldsDomainsObjs.length;
    if((num1>0)&&(num1<=num2))
    {
     for(var i=0;i<=num1-1;i++)
  	 {
  		var domObj = this.getDataFieldDomainObjByPos(i);
  		domObj.setValue(this.dataFieldsDomainsValues[i]);
  	 }
  	 return true;  	 	
  	}
  	else
  	 return false;
  }
  this.getDataFieldDomainValueByPos = function(actPos)
  {
   var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	 if (actPos <= dataFieldsDomainsValues.length-1)
	  return dataFieldsDomainsValues[actPos];
	 else
	  return false;
  }
  this.setDataFieldDomainValueByPos = function(actPos,actVal)
  {
   var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
   dataFieldsDomainsValues[actPos] = actVal;
	 var domObj = this.getDataFieldDomainObjByPos(actPos);
	 if (domObj !== false)
	 {
		 domObj.setValue(dataFieldsDomainsValues[actPos]);
		 return true;
   }
   else
    return false;
  }
  this.getDataFieldDomainValueByName = function(actFieldName)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if ((fields[i] == actFieldName)&&(dataFieldsDomainsValues[i] !== undefined))
	   return dataFieldsDomainsValues[i];
	 }
	 return false; 	
  }
  this.setDataFieldDomainValueByName = function(actFieldName,actVal)
  {
   var fields = this.getDataFields();
	 var dataFieldsDomains = this.getDataFieldsDomains();
	 var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	 var num1 = fields.length;

	  for(var i=0;i<=num1-1;i++)
	  {
	   if (fields[i] == actFieldName)
	   {
		  dataFieldsDomainsValues[i] = actVal;
		  var domObj = this.getDataFieldDomainObjByPos(i);
		  if(domObj !== false)
		   domObj.setValue(actVal);		 
		  else
		   return false;
		  return true;
		 }
	  }
  }
  
	this.dataFieldsLengths = new Array();
	this.getDataFieldsLengths = function()
	{
		return this.dataFieldsLengths;
	}
	this.setDataFieldsLengths = function(actDataFieldsLengths)
	{
		this.dataFieldsLengths = actDataFieldsLengths;
	};
	this.getDataFieldLengthByPos = function(actPos)
	{
   var fieldsLengths = this.getDataFieldsLengths();
	 if (actPos <= fieldsLengths.length-1)
	  return fieldsLengths[actPos];
	 else
	  return false;		
	};
	this.setDataFieldLengthByPos = function(actPos,actVal)
	{
   var fieldsLengths = this.getDataFieldsLengths();
	 fieldsLengths[actPos] = actVal;		
	};
	this.getDataFieldLengthByName = function(actFieldName)
	{
   var fields = this.getDataFields();
	 var dataFieldsLengths = this.getDataFieldsLengths();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if (fields[i] == actFieldName)
	   if (dataFieldsLengths[i] !== undefined)
	    return dataFieldsLengths[i];
		 else
		  return false;
	 }
	 return false;
	};
	this.setDataFieldLengthByName = function(actFieldName,actVal)
  {
   var fields = this.getDataFields();
	 var dataFieldsLengths = this.getDataFieldsLengths();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if (fields[i] == actFieldName)
	   dataFieldsLengths[i]=actVal;
	 }
	 return false;
  };
  this.dataSource = new Array();
  this.setDataSource = function(actDataSource)
  {
  	this.dataSource = actDataSource;
  };	
  this.getDataSource = function()
  {
   return this.dataSource;
  };
  this.isFieldInDataFields = function(actField)
  {
  	var dataFields = this.getDataFields();
  	for(var i=0;i<=dataFields.length-1;i++)
  	{
  		var field = dataFields[i];
  		if(actField==field)
  			return true;
  	}
  	return false;
  };
  this.getDataFieldsAllValues = function(actFieldName,actFieldVal)
  {
  	var domObj = this.getDataFieldDomainObjByName(actFieldName);
  	return domObj.getAllValues(actFieldVal);
  };
  this.convertToKeysNumeric = function(actArray,actDefVal)
  {
 	 var newArray = new Array();
 	 var isPartAssoc = util.array_is_part_assoc(actArray);
 	 var isNumeric = util.array_is_numeric(actArray);	
 	 
 	 var dataFields = this.getDataFields();
 	 for(var ind in dataFields)
 	 {
 	 	if(util.item_in_array_keys(dataFields[ind],actArray))
 	 	{
 	 	 newArray[ind] = actArray[dataFields[ind]];
 	 	}
 	 	else if(util.item_in_array_keys(ind,actArray))
 	 		newArray[ind] = actArray[ind];
 	 	else if(isPartAssoc || isNumeric)
 	 		newArray[ind] = actDefVal; 	 	 	
 	 }
 	 return newArray;
  };  	
 };
}

Html_data_interface.prototype = new Html_formatted_interface('','','');
Html_data_interface.prototype.constructor = Html_data_interface.constructor;
