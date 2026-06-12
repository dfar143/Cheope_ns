var interfaces = function(){
	
function Html_writer(actStack)
{
 this.stack = actStack;
 this.setStack = function(actStack)
 {
 	this.stack = actStack;
 };
 this.getStack = function()
 {
 	return this.stack;
 };
 this.flushEnabled = true;
 this.setFlushEnabled = function(actFlushEnabled)
 {
 	this.flushEnabled = actFlushEnabled;
 };	
 this.getFlushEnabled = function()
 {
 	return this.flushEnabled;
 };
 this.getDumper = function()
 {
 	var objStack = this.getStack();
 	var dumper = objStack.getDumper();
 	return dumper;
 };
 this.setDumper = function(actDumper)
 {
 	var objStack = this.getStack();
 	objStack.setDumper(actDumper);
 };
 this.sendData = function()
 {
 	var objStack = this.getStack();
 	var flushEnabled = this.getFlushEnabled();
 	if (flushEnabled)
 	 return objStack.flush();
 	else
 	 return objStack.dump();
 };
 
 this.putGenericHtmlString = function(actStr,actClass)
 {
 	var objStack = this.getStack();
 	var str='';
 	if(actClass !== undefined)
 	 str = "<" + "span" + " class=" + "\"" + actClass + "\"" + 
 	 + ">" + actStr + "</span>";
 	else
 	 str = actStr;
 	 
 	objStack.push(str);
 }
 
  this.put = this.putGenericHtmlString;
}	

function Memory_dumper(actObj)
{
	this.obj = actObj;
	this.setObj = function(actObj){this.obj=actObj;};
	this.getObj = function(){return this.obj;};
	
	this.dump = function()
	{
	  var obj=this.getObj();
	  var str=obj.toString();
	  return str;
	};
}

// Domini dei campi

function Int_domain()
{
	this.name = '';
	this.setName = function(actName)
	{
		this.name = actName;
	};
	this.getName = function()
	{
		return this.name;
	};
	
	this.value = '';
	this.setValue = function(actValue)
	{
		this.value = actValue;
	};
	this.getValue = function()
	{
		return this.value;
	};	
	
	this.getAllValues = function()
	{
	 var value = this.getValue();
	 if (value != '')
		return value;
	 else
		return '';
	};
}

Int_domain.FIELD_DOMAIN_ATOMIC = "atomic";
Int_domain.FIELD_DOMAIN_SET = "set";
Int_domain.FIELD_DOMAIN_OBJ = "object";
Int_domain.FIELD_DOMAIN_FUNCTION = "function";
Int_domain.FIELD_DOMAIN_VAR = "var";

function Int_domain_atomic()
{
	this.setName(Int_domain.FIELD_DOMAIN_ATOMIC);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  fieldVal = actFieldVal;
	 }
	 return fieldVal;		
	};
}

Int_domain_atomic.prototype = new Int_domain();
Int_domain_atomic.prototype.constructor = Int_domain_atomic;

function Int_domain_set()
{
	this.setName(Int_domain.FIELD_DOMAIN_SET);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  alert('Errore nel valore del dominio:Int_domain_set.');
	 }
	 return fieldVal;		
	};
}

Int_domain_set.prototype = new Int_domain();
Int_domain_set.prototype.constructor = Int_domain_set;

function Int_domain_object()
{
	this.setName(Int_domain.FIELD_DOMAIN_OBJ);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(typeof fieldVal != 'object')
	 {
	  alert('Errore nel valore del dominio:Int_domain_object.');
	 }
	 return fieldVal;		
	};
}

Int_domain_object.prototype = new Int_domain();
Int_domain_object.prototype.constructor = Int_domain_object;

function Int_domain_function()
{
	this.setName(Int_domain.FIELD_DOMAIN_FUNCTION);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 if(fieldVal=='')
	 {
	  fieldVal = actFieldVal;
	 }
	 return fieldVal;		
	};
}

Int_domain_function.prototype = new Int_domain();
Int_domain_function.prototype.constructor = Int_domain_function;

function Int_domain_var()
{
	this.setName(Int_domain.FIELD_DOMAIN_VAR);
	
	this.getAllValues = function(actFieldVal)
	{
	 var fieldVal = this.getValue();
	 return fieldVal;		
	};
}

Int_domain_var.prototype = new Int_domain();
Int_domain_var.prototype.constructor = Int_domain_function;

// -------------

function Interfaces_container(actName)
{
	this.name = actName;
	this.setName=function(actName)
	{
	 this.name = actName;
	};
	this.interfaces = new Array();
	this.setInterfaces=function(actInterfaces)
	{
		var num = actInterfaces.length;
		for(var i=0;i<=num-1;i++)
		 this.interfaces[i] = actInterfaces[i];
	};
	this.getInterfaces = function()
	{
		return this.interfaces;
	};
	this.setElement = function(actItem,actPos)
	{
		var interfaces = this.getInterfaces();
		if((actPos<=interfaces.length)&&(actPos>=0))
		{
			interfaces[actPos] = actItem;
			return true;
		}
		else
			return false;
	};
	this.add = function(actItem)
	{
		var interfaces = this.getInterfaces();
		interfaces.push(actItem);
	};
	this.createIterator=function()
	{
		var iter = new Interfaces_iterator(this);
	};
	this.getInterface = function(actOp)
	{
		var interfaces = this.getInterfaces();
		for(var i=0;i<=interfaces.length-1;i++)
		{
			var op = interfaces[i].getOp();
			if(op==actOp)
			 return interfaces[i];
		}
		return false;
	};
	
}

function Interfaces_iterator(actObj)
{
	this.pointer=0;
	this.setPointer = function(actPointer)
	{
		this.pointer = actPointer;
	};
	this.getPointer = function()
	{
		return this.pointer;
	};
	this.obj==null;
	this.getObj = function()
	{
		return this.obj;
	};
	this.setObj = function(actObj)
	{
		this.obj = actObj;
	};
	this.setObj(actObj);
	this.last=function()
	{
		var obj = this.getObj();
		var ints = obj.getInterfaces();
		if(ints.length>0)
		{
		 this.setPointer(ints.length-1); 
		 return ints[ints.length-1]; 
		}
		else
		 return null;
	};
	this.first=function()
	{
		var obj = this.getObj();
		var ints = obj.getInterfaces();
		if(ints.length>0)
		{
		 this.setPointer(0); 
		 return ints[0]; 
		}
		else
		 return null;
	};
	this.previous=function()
	{
		var pointer = this.getPointer();
    var obj = this.getObj();
		var ints = obj.getInterfaces();
		if(pointer>0)
		{
		 this.setPointer(pointer--);
		 return ints[pointer];
		}
		else
			return null;
	};
	this.next=function()
	{
		var pointer = this.getPointer();
    var obj = this.getObj();
		var ints = obj.getInterfaces();
		if(pointer<ints.length)
		{
		 this.setPointer(pointer++);
		 return ints[pointer];
		}
		else
			return null;
	};
	this.current=function()
	{
		var pointer = this.getPointer();
    var obj = this.getObj();
		var ints = obj.getInterfaces();
		if(ints.length>0)
		{ 
		 return ints[pointer]; 
		}
		else
		 return null;
	};
	this.hasMore = function()
	{
		var pointer = this.getPointer();
    var obj = this.getObj();
		var ints = obj.getInterfaces();
		pointer++;
		if(pointer>ints.length-1)
		 return false;
		else
			return true;
	}
	
}

// Generic_interface

function Generic_interface(actOp,actType,actNum)
{
 this.op = actOp;
 this.getOp = function()
 {
 	return this.op;
 }
 this.setOp = function(actOp)
 {
 	this.op = actOp;
 } 
 
 this.type = actType;
 this.getType = function()
 {
 	return this.type;
 }
 this.setType = function(actType)
 {
 	this.type = actType;
 }
 
 this.num = actNum;
 this.getNum = function()
 {
 	return this.num;
 }
 this.setNum = function(actNum)
 {
 	this.num = actNum;
 }
 
 this.createStack = function()
 {
 	return common.createStack('');
 }
 
 this.stack = this.createStack();
 this.getStack = function()
 {
 	return this.stack;
 }
 this.setStack = function(actStack)
 {
 	this.stack = actStack;
 }
 
 this.createMemoryDumper = function()
 {
 	var obj = this.getStack();
 	return new Memory_dumper(obj);
 }
 this.stack.setDumper(this.createMemoryDumper());
 
 this.getInterfaceId = function(actSepChar)
 {
 	var num = this.getNum();
 	var op = this.getOp();
 	var type = this.getType();
 	return (type + actSepChar + op + actSepChar + num);
 }
 
 this.putData = function()
 {
 };
 
 this.toString = function()
 {
  var objStack = this.getStack();
  if(objStack !== 'undefined')
  {
   //console.log(objStack);	  
   oldStack = objStack.getCopy();
   objStack.erase();
   this.putData();
   var str = objStack.dump();
   this.setStack(oldStack);
   return str;
  }
  return '';
 }
 
 this.dump = function()
 {
 	var objStack = this.getStack();
 	var str = objStack.dump();
 	return str;
 }
 
 this.flush = function()
 {
 	var objStack = this.getStack();
	if(objStack !== 'undefined')
	{
 	 var str = objStack.dump();
 	 objStack.erase();
 	 return str;
    }
    return '';	
 }
 
 this.clone = function(actObj)
 {
 	var newObj = new Object();
  var obj;
  if(actObj === undefined)
  {
  	obj = this;
  }
  else
  	obj = actObj;
  
  for(var prop in obj)
  {
   if(typeof obj[prop] != 'object')	
 	   newObj[prop] = obj[prop];
 	 else
 	 {
    newObj[prop] = this.clone(obj[prop]);
   }
   newObj.constructor = obj.constructor;  	
  }
 	return newObj;
 }
}

 Generic_interface.translateXmlDataSource_inner = function(actEl)
 {
 	 if((typeof actEl == "object") && (actEl.nodeType !== 4)) 
 	 {
 	  var type = actEl.getAttribute('type');
 	  var aInd = actEl.getAttribute('id');
 	 }
 	 else 
 	 	type = '';
 	 var retVal = {};
 	 if(type=="array")
 	 {
 	  var records = new Array();
 	  for(var i=0;i<=actEl.childNodes.length-1;i++)
	  {
	 	 var el1 = actEl.childNodes[i];
	     var val = Generic_interface.translateXmlDataSource_inner(el1);
	   var id = val.id;
	   var value = val.value;	
	   records[id] = value;	  
	  }
	  retVal.value = records;
	  retVal.id = aInd;
	 }
	 else if(type=="scalar")
	 {
	 	var el1 = actEl.childNodes[0];
	 	var val = Generic_interface.translateXmlDataSource_inner(el1);
    retVal.value = val.value;
	 	retVal.id = aInd;
   }
   else
   {
   	retVal.value = actEl.nodeValue;
   	retVal.id = '';
   }
	 return retVal; 	
 } 


Generic_interface.translateXmlDataSource2 = function(actXmlDataSource)
{
	if((typeof actXmlDataSource == 'object')&&(actXmlDataSource != null))
	{	
	 var rootEl = actXmlDataSource.documentElement; 
	 var records = Generic_interface.translateXmlDataSource_inner(rootEl).value;
	}
	else
		records = actXmlDataSource;
	return records;
}

Generic_interface.translateXmlDataSource = function(actXmlDataSource)
{
	if((typeof actXmlDataSource == 'object')&&(actXmlDataSource != null))
	{	
	 var rootEl = actXmlDataSource.documentElement; 
	 var records = new Array();
	 for(var i=0;i<=rootEl.childNodes.length-1;i++)
	 {
	  var el1 = rootEl.childNodes[i];
	  var obj = new Array();
	  for(var j=0;j<=el1.childNodes.length-1;j++)
	  {
	   var el2 = el1.childNodes[j];
	   var id = el2.getAttribute('id');
		 obj[id]= el2.childNodes[0].nodeValue;
	  }
	  records[i] = obj;
	 }
	}
	else
		records = actXmlDataSource;
	return records;
}

//-----------------

// Html_formatted_interface

function Html_formatted_interface(actOp,actType,actNum)
{
	this.setOp(actOp);
	this.setType(actType);
	this.setNum(actNum);
	
	this.hookId = '';
	this.setHookId = function(actHookId)
	{
	 if(this.hookId !== undefined)
	 this.hookId = actHookId;	 
	}
	this.getHookId = function()
	{
		return this.hookId;
	}
	this.dispFields = null;
	this.setDispFields=function(actDispFields)
	{
		var num = actDispFields.length;
		for(var i=0;i<=num-1;i++)
		 this.dispFields[i] = actDispFields[i];
	};
	this.getDispFields = function()
	{
		return this.dispFields;
	};
	
	this.cssClass = '';
	this.setCssClass = function(actCssClass)
	{
	 this.cssClass = actCssClass;
	};
	this.getCssClass = function()
	{
	 return this.cssClass;
	};
	
	this.style = '';
	this.setStyle = function(actStyle)
	{
	 this.style = actStyle;
	};
	this.getStyle = function()
	{
	 return this.style;
	};
  
	this.enableSendData = true;
	this.setEnableSendData = function(actEnableSendData)
	{
		this.enableSendData = actEnableSendData;
	}
	this.getEnableSendData = function()
	{
		return this.enableSendData;
	}
	
	this.sendData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var enableSendData = this.getEnableSendData();
	 if(enableSendData)
	 {
	  var hookId = this.getHookId();
	  var domContainerItem = document.getElementById(hookId);
	  domContainerItem.innerHTML = htmlWriter.sendData();
	 }	
	}
	
	this.putData = function()
	{
	};
}

Html_formatted_interface.prototype = new Generic_interface('','','');
Html_formatted_interface.prototype.constructor = Html_formatted_interface;
Html_formatted_interface.prototype.htmlWriter = null;
Html_formatted_interface.createHtmlWriter = function(actStack)
{
	return new Html_writer(actStack);
};
Html_formatted_interface.prototype.setHtmlWriter = function(actHtmlWriter)
{
	this.htmlWriter = actHtmlWriter;
};
Html_formatted_interface.prototype.getHtmlWriter = function()
{
	return this.htmlWriter;
};
Html_formatted_interface.prototype.setHtmlWriter(Html_formatted_interface.createHtmlWriter(Html_formatted_interface.prototype.getStack()));

//-----------------

// Html_data_interface
// è necessario includere util.js
// per il corretto funzionamento della libreria.
//

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
		var num = actDataFields.length;
		var dataFields1 = new Array();
		for(var i=0;i<=num-1;i++)
		{
		 dataFields1.push(actDataFields[i]);
		}
		this.dataFields = dataFields1;
	 return true;
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
	  dataFields.push(actFieldName); 
	  var dataFieldsDomains = this.getDataFieldsDomains();
	  dataFieldsDomains.push(domainName);
	  var domObj = this.createDomainObj(domainName);
	  domObj.setValue(domainValue);
	  var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
	  dataFieldsDomainsObjs.push(domObj);
	  var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
	  dataFieldsDomainsValues.push(domainValue);
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
	 this.setDataFields(dataFields);
	 this.setDataFieldsDomains(dataFieldsDomains);
	 this.setDataFieldsDomainsValues(dataFieldsDomainsValues);
	};
	this.dataFieldsDomains = new Array();
  this.setDataFieldsDomains = function(actDataFieldsDomains)
  {
	//this.dataFieldsDomains = util.arrayEmpty(this.dataFieldsDomains);
	var dataFieldsDomains1 = new Array();
	var num1 = actDataFieldsDomains.length;
	for(var i=0;i<=num1-1;i++)
     dataFieldsDomains1.push(actDataFieldsDomains[i]);
    this.dataFieldsDomains = dataFieldsDomains1;
	
  	var dataFieldsDomainsObjs = new Array();
  	for(var i=0;i<=num1-1;i++)
  	{
  	 var domName = actDataFieldsDomains[i];
  	 var domObj = this.createDomainObj(domName);
  	 dataFieldsDomainsObjs.push(domObj);
  	}
  	this.setDataFieldsDomainsObjs(dataFieldsDomainsObjs);
	return true;
  };
  this.getDataFieldsDomains = function()
  {
  	return this.dataFieldsDomains;
  };
  this.getDataFieldDomainByPos = function(actPos)
  {
  	var fieldsDomains = this.getDataFieldsDomains();
  	if(actPos <= fieldsDomains.length-1)
  	 return fieldsDomains[actPos];
  	else
  	 return false;
  };
  this.setDataFieldDomainByPos = function(actPos,actVal)
  {
   var fieldsDomains = this.getDataFieldsDomains();
   var num = fieldsDomains.length;
   if(actPos > num)
	return false;
   var fieldsDomains1 = new Array();
   for(var i=0;i<=num-1;i++)
   {
    if(actPos == i)
    {
     fieldsDomains1.push(actVal);     
     var domObj = this.createDomainObj(actVal);
     this.setDataFieldDomainObjByPos(actPos,domObj);
     break;
    }
	fieldsDomains1.push(fieldsDomains[i]);
   }
   this.setDataFieldDomains(fieldsDomains1);
   return true;   
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
   var num1 = dataFieldsDomains.length;
   var dataFieldsDomains1 = new Array();
   var num = fields.length;
   if(num > num1)
	return false;
   for(var i=0;i<=num-1;i++)
   {
	  if (fields[i] == actFieldName)
	  {
	   dataFieldsDomains1.push(actVal);
	   var domObj = this.createDomainObj(actVal);
	   if(this.setDataFieldDomainObjByPos(i,domObj))
		  break;
		 else
		  return false;
	  }
	  else
	  {
	   dataFieldsDomains1.push(dataFieldsDomains[i]);
	   var domObj = this.createDomainObj(dataFieldsDomains[i]);
	   if(this.setDataFieldDomainObjByPos(i,domObj))
		  continue;
		 else
		  return false;	   
	  }
	}
	this.setDataFieldsDomains(dataFieldsDomains1);
	return true;  	
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
		//this.dataFieldsDomainsObjs = util.arrayEmpty(this.dataFieldsDomainsObjs);
		var dataFieldsDomainsObjs1 = new Array();
		var num = actDataFieldsDomainsObjs.length;
		for(var i=0;i<=num-1;i++)
		{
		 dataFieldsDomainsObjs1.push(actDataFieldsDomainsObjs[i]);
		}
		this.dataFieldsDomainsObjs = dataFieldsDomainsObjs1;
	return true;
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
    if (actPos <= dataFieldsDomainsObjs.length-1)
    {
     var dataFieldsDomainsObjs1 = new Array();
     var num = dataFieldsDomainsObjs.length;
     for(var i=0;i<=num-1;i++)
     {
	   if (i == actPos)
	    dataFieldsDomainsObjs1.push(actDomObj);
	   else
		dataFieldsDomainsObjs1.push(dataFieldsDomainsObjs[i]);
	 }
	 this.setDataFieldsDomainsObjs(dataFieldsDomainsObjs1);
	 return true;
    }
    else
	 return false;
  }
  this.setDataFieldDomainObjByName = function(actFieldName,actDomObj)
  {
   var fields = this.getDataFields();
   var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
     var num1 = dataFieldsDomainsObjs.length;
	 var dataFieldsDomainsObjs1 = new Array();	 
	 var num = fields.length;
	 if(num <= num1)
	 {
	  for(var i=0;i<=num-1;i++)
	  {
	   if (fields[i] == actFieldName)
	   {
	    dataFieldsDomainsObjs1.push(actDomObj);
	   }
	   else
		dataFieldsDomainsObjs1.push(dataFieldsDomainsObjs[i]);
	  }
	  this.setDataFieldsDomainsObjs(dataFieldsDomainsObjs1);
	  return true;
	 }
     else 
	  return false;	 
  }
  this.dataFieldsDomainsValues = new Array();
  this.getDataFieldsDomainsValues = function()
  {
  	return this.dataFieldsDomainsValues;
  }
  this.setDataFieldsDomainsValues = function(actDataFieldsDomainsValues)
  {
	var dataFieldsDomainsValues1 = new Array();
	var num1 = actDataFieldsDomainsValues.length;
	for(var i=0;i<=num1-1;i++)
  	 dataFieldsDomainsValues1.push(actDataFieldsDomainsValues[i]);
  	var dataFieldsDomainsObjs = this.getDataFieldsDomainsObjs();
  	var num2 = dataFieldsDomainsObjs.length;
	var dataFieldsDomainsObjs1 = new Array();
    if((num1>0)&&(num1<=num2))
    {	
     for(var i=0;i<=num1-1;i++)
  	 {
  		var domObj = dataFieldsDomainsObjs[i];
		if(domObj !== false)
	    {
  		 domObj.setValue(actDataFieldsDomainsValues[i]);
		 dataFieldsDomainsObjs1.push(domObj);
		}
		else
		 return false;
  	 }
	 this.dataFieldsDomainsValues = dataFieldsDomainsValues1;
	 this.setDataFieldsDomainsObjs(dataFieldsDomainsObjs1);
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
   if(actPos <= dataFieldsDomainsValues.length-1)
   {
	var dataFieldsDomainsValues1 = new Array(); 
    var num = dataFieldsDomainsValues.length;
    for(var i=0;i<=num-1;i++)
    {
	 if($actPos == i)
     {		 
      dataFieldsDomainsValues1[actPos] = actVal;
      var domObj = this.getDataFieldDomainObjByPos(actPos);
      if (domObj !== false)
      {
	   domObj.setValue(dataFieldsDomainsValues[actPos]);
	   this.setDataFieldDomainObjByPos(actPos,domObj);
	   return true;
      }
      else
       return false;
     }
	 else
	 {
	  dataFieldsDomainsValues1[i] = dataFieldsDomainsValues[i];	 
	 }    	 
    }
	this.setDataFieldsDomainsValues(dataFieldsDomainsValues1);
   }
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
   var dataFieldsDomainsValues = this.getDataFieldsDomainsValues();
   var dataFieldsDomainsValues1 = new Array();
   var num1 = fields.length;
   for(var i=0;i<=num1-1;i++)
   {
	if (fields[i] == actFieldName)
	{
     dataFieldsDomainsValues1.push(actVal);
     var domObj = this.getDataFieldDomainObjByPos(i);
     if(domObj !== false)
	 {
	  domObj.setValue(actVal);
      this.setDataFieldDomainObjByPos(i,domObj);
	  //dataFieldsDomainsValues1.push(dataFieldsDomainsValues[i]);
     }
	 else
	  return false;
    }
	else
	 dataFieldsDomainsValues1.push(dataFieldsDomainsValues[i]);
   }
   this.setDataFieldsDomainsValues(dataFieldsDomainsValues1);
   return true;
  }  
  this.dataFieldsLengths = new Array();
  this.getDataFieldsLengths = function()
  {
	return this.dataFieldsLengths;
  }
  this.setDataFieldsLengths = function(actDataFieldsLengths)
  {
   var dataFieldsLengths1 = new Array();
   //this.dataFieldsLengths = util.arrayEmpty(this.dataFieldsLengths);
   var num = actDataFieldsLengths.length;
   for(var i=0;i<=num-1;i++)
	dataFieldsLengths1.push(actDataFieldsLengths[i]);
   this.dataFieldsLengths = dataFieldsLengths1;
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
	 var fieldsLengths1 = new Array();
	 var num = fieldsLengths.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if(actPos == i)
	  {
	   fieldsLengths1.push(actVal);
       this.setDataFieldsLengths(fieldsLengths1);
       return true;	  
	  }
	  else
	   fieldsLengths1.push(fieldsLengths[i]);
	 }
	 this.setDataFieldsLengths(fieldsLengths1);
	 return false;
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
	 var dataFieldsLengths1 = new Array();
	 var num = fields.length;
	 for(var i=0;i<=num-1;i++)
	 {
	  if (fields[i] == actFieldName)
	  {
	   dataFieldsLengths1.push(actVal);
	   this.setDataFieldsLengths(dataFieldsLengths1);
	   return true;
	  }
	  else
	   dataFieldsLengths1.push(dataFieldsLengths[i]);
	 }
	 this.setDataFieldsLengths(dataFieldsLengths1);
	 return false;
  };
  this.dataSource = new Array();
  this.setDataSource = function(actDataSource)
  {
	var dataSource1 = new Array();
	//var num = actDataSource.length;
	for(var index in actDataSource)
	{
     Object.defineProperty(dataSource1,index,{value: actDataSource[index], writable: true,
                enumerable: true, configurable:true});	 
	}
	this.dataSource = dataSource1;
	return true;
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
  this.convertToKeysNumeric = function(actArray,actDefVal)
  {
 	 var newArray = new Array();
 	 var isPartAssoc = util.array_is_part_assoc(actArray);
 	 var isNumeric = util.array_is_numeric(actArray);	
 	 
 	 var dataFields = this.getDataFields();
 	 for(var ind in dataFields)
 	 {
 	 	if(util.item_in_array_keys(dataFields[ind],actArray))
 	 	 newArray[ind] = actArray[dataFields[ind]];
 	 	else 
 	 	{
 	 	 if(util.item_in_array_keys(ind,actArray))
 	 	 {
 	 	  newArray[ind] = actArray[ind];
 	 	 }
 	 	 else if (isPartAssoc || isNumeric)
 	 		 newArray[ind] = actDefVal;
 	 	} 	 	 	
 	 }
 	 return newArray;
  };
  this.getDataFieldsAllValues = function(actFieldName,actFieldVal)
  {
  	var domObj = this.getDataFieldDomainObjByName(actFieldName);
  	return domObj.getAllValues(actFieldVal);
  };
}

Html_data_interface.prototype = new Html_formatted_interface('','','');
Html_data_interface.prototype.constructor = Html_data_interface;

//------------------
// Html_data_template

function Html_data_template(actOp,actNum)
{	
	this.initialize = function(actOp1,actNum1)
	{
	  this.setOp(actOp1);
      this.setNum(actNum1);
      this.setType("Html_data_template");
      this.setDataSource(new Array());
      this.setDataFields(new Array());
      this.setDataFieldsDomains(new Array());
      this.setDataFieldsDomainsValues(new Array());
      this.setDataFieldsLengths(new Array());
      this.setPage('');
      this.setHookId('');
      this.setDispFields(new Array());
      this.setCssClass('');
      this.setStyle('');
	  var stack = new common.createStack();
	  stack.setDumper(this.createMemoryDumper());
      this.setStack(stack);
	  this.setHtmlWriter(new Html_writer(stack));
	  this.setEnableSendData(true);
	}
	
	this.inheritData = true;
	this.setInheritData = function(actInheritData)
	{
		this.inheritData = actInheritData;
	}
	this.getInheritData = function()
	{
		return this.inheritData;
	}
	this.inheritDataFieldName = false;
	this.setInheritDataFieldName = function(actInheritDataFieldName)
	{
		this.inheritDataFieldName = actInheritDataFieldName;
	}
	this.getInheritDataFieldName = function()
	{
		return this.inheritDataFieldName;
	}
	this.inheritCountFieldName = "Count";
	this.setInheritCountFieldName = function(actInheritCountFieldName)
	{
		this.inheritCountFieldName = actInheritCountFieldName;
	}
	this.getInheritCountFieldName = function()
	{
		return this.inheritCountFieldName;
	}
	this.htmlTemplate = "";
	this.setHtmlTemplate = function(actHtmlTemplate)
	{
		this.htmlTemplate = actHtmlTemplate;
	}
	this.getHtmlTemplate = function()
	{
		return this.htmlTemplate;
	}
	this.execOnlyOnFullDataSource = true;
	this.setExecOnlyOnFullDataSource= function(actExec)
	{
	 this.execOnlyOnFullDataSource = actExec;
	}
	this.getExecOnlyOnFullDataSource=function()
	{
	 return this.execOnlyOnFullDataSource;
	}	
	this.elabFields=function(actRow,actNum)
	{
		var dataFields = this.getDataFields();
		var domains = this.getDataFieldsDomains();
		var domainsValues = this.getDataFieldsDomains();
		var num = this.getNum();
		var htmlTemplate = this.getHtmlTemplate();
		var fieldValue;
		var fieldValues;
	
		for(var i=0;i<=dataFields.length-1;i++)
		{
			var field = dataFields[i];
			if(actRow[field] !== undefined)
			{
			 fieldValue = actRow[field];
			}
			else
			{
				if(actRow !== undefined)
				 fieldValue = actRow;
				else
			   fieldValue = "";
			}

			fieldValues = this.getDataFieldsAllValues(field,fieldValue);
			
			if(util.is_array(fieldValues)&&(! util.is_array_of_array(fieldValues)))
			{
			 fieldValue = fieldValues[0];
			}
			else if(util.is_array_of_array(fieldValues))
			{
			 fieldValue = fieldValues.toString();	
			}
			else
		  {
			 fieldValue = fieldValues;
			}
	
			var domain = this.getDataFieldDomainByName(field);
			if(domain == Int_domain.FIELD_DOMAIN_OBJ)
			{
			 if(this.getInheritData())
			 {
			 	var inhCountFieldName = this.getInheritCountFieldName();
                Object.defineProperty(actRow,inhCountFieldName,{value: actNum, writable: true,
                enumerable: true, configurable:true});				
			 	actRow[inhCountFieldName] = actNum;              
			  fieldValue.setDataSource(actRow);
			 }
			 if(this.getInheritDataFieldName())
			  fieldValue.setNum(num + "_" + actNum + "_" + field);
			  fieldValue.setEnableSendData(false);
         	  fieldValue.putData();
			 var pattern = new RegExp("{" + field.toUpperCase() + "}","g");
			 htmlTemplate = htmlTemplate.replace(pattern,fieldValue.flush());
       htmlTemplate = htmlTemplate.replace(/\{COUNT\}/g,actNum);
			}
			else
		  {		 
		  	var pattern = new RegExp("{" + field.toUpperCase() + "}","g");
				htmlTemplate = htmlTemplate.replace(pattern,fieldValue);					
        htmlTemplate = htmlTemplate.replace(/\{COUNT\}/g,actNum);
			}
		}
		return htmlTemplate;
	}
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
//
// Come dataSource vuole un array di array
//
	 var rows = this.getDataSource();
	 var dataSource = util.cloner().clone(rows);
	 var htmlTemplate = this.getHtmlTemplate();
	 var cssClass = this.getCssClass();
	 var intCode = this.getInterfaceId('');

	 if(rows !== undefined)
	 {
	 	if(! util.is_array(rows))
	 	{
	 		rowVal = new Array(rows);
	 		rows = new Array();
	 		rows[0] = rowVal;
	  }
	  else if(! util.is_array_of_array(rows))
	  {
	  	rows = new Array(rows);
	  }
	 }
	 else
	 	rows = new Array([]);
	 	 
	 var htmlTemplateInstance='';
	 var execOnly = this.getExecOnlyOnFullDataSource();
//
// Serve ad evitare l'esecuzione quando il dataSource (object) è vuoto
//
	 if(((util.count(dataSource)>0))
	     ||
	    ((util.count(dataSource)==0) && 
	    (! execOnly)))
	 if(rows.length > 0)
	 {
	 	var j=0;
	 	for(var prop in rows)
	 	{
	 		var rowVal = rows[prop];
	 		var htmlTemplate = this.elabFields(rowVal,j);
	 		if(j==0)
	 		 htmlTemplateInstance = htmlTemplate;
	 		else
	 		 htmlTemplateInstance += "\n" + htmlTemplate;
	 		j++;
	 	}
	 }
	 else 
	 	htmlTemplateInstance = this.elabFields(rows,0);

	 htmlWriter.putGenericHtmlString(htmlTemplateInstance);
	 var enableSendData = this.getEnableSendData();
	 if(enableSendData)
	 {
	  var hookId = this.getHookId();
	  if(hookId !== '')
	  {
	   var domContainerItem = document.getElementById(hookId);
	   domContainerItem.innerHTML = htmlWriter.sendData();
	  }
	 }
	}
	
}

Html_data_template.prototype = new Html_data_interface('','','');
Html_data_template.prototype.constructor = Html_data_template;

//------------------
// Javscript_fragment

function Javascript_fragment(actOp,actNum)
{	
  this.initialize = function(actOp1,actNum1)
  {
   this.setOp(actOp1);
   this.setNum(actNum1);
   this.setType('Javascript_fragment');
   this.setHookId('');
   this.setDispFields(new Array());
   this.setCssClass('');
   this.setStyle('');
   var stack = new common.createStack();
   stack.setDumper(this.createMemoryDumper());
   this.setStack(stack);
   this.setHtmlWriter(new Html_writer(stack));
  }

  this.javascriptFragment = "";
  this.setJavascriptFragment = function(actJavascriptFragment)
  {
	this.javascriptFragment = actJavascriptFragment;
  };
  this.getJavascriptFragment = function()
  {
	return this.javascriptFragment;
  }
  
  	this.putData=function()
	{
		var htmlWriter = this.getHtmlWriter();
		javascriptFragment=this.getJavascriptFragment();
		eval(javascriptFragment);
	  var enableSendData = this.getEnableSendData();
	  if(enableSendData)
	  {
	   var hookId = this.getHookId();
	   if(hookId !== '')
	   {
	    var domContainerItem = document.getElementById(hookId);
	    if(domContainerItem != null)
	     domContainerItem.innerHTML = htmlWriter.sendData();
		}
	  }
	}
}

Javascript_fragment.prototype = new Html_formatted_interface('','','');
Javascript_fragment.prototype.constructor = Javascript_fragment;

//------------------
// Javscript_data_fragment

function Javascript_data_fragment(actOp,actNum)
{	
  this.initialize = function(actOp1,actNum1)
  {
   this.setOp(actOp1);
   this.setNum(actNum1);
   this.setType('Javascript_data_fragment');
   this.setDataSource(new Array());
   this.setDataFields(new Array());
   this.setDataFieldsDomains(new Array());
   this.setDataFieldsDomainsValues(new Array());
   this.setDataFieldsLengths(new Array());
   this.setPage('');
   this.setHookId('');
   this.setDispFields(new Array());
   this.setCssClass('');
   this.setStyle('');
   var stack = new common.createStack();
   stack.setDumper(this.createMemoryDumper());
   this.setStack(stack);
   this.setHtmlWriter(new Html_writer(stack));
  }

  this.addSlashToFieldValue = true;
  this.setAddSlashToFieldValue = function(actAddSlash)
  {
  	this.addSlashToFieldValue = actAddSlash;
  } 
  
  this.getAddSlashToFieldValue = function()
  {
  	return this.addSlashToFieldValue;
  }   

	this.inheritData = true;
	this.setInheritData = function(actInheritData)
	{
		this.inheritData = actInheritData;
	}
	this.getInheritData = function()
	{
		return this.inheritData;
	}
	
	this.javascriptFragment = "";
	this.setJavascriptFragment = function(actJavascriptFragment)
	{
		this.javascriptFragment = actJavascriptFragment;
	};
	this.getJavascriptFragment = function()
	{
		return this.javascriptFragment;
	}
	
	this.putData=function()
	{
		var htmlWriter = this.getHtmlWriter();
//
// Come dataSource canonico vuole un array associativo ossia una funzione o un oggetto.
//
		var rows = this.getDataSource();
		var dataFields = this.getDataFields();
		var javascriptFragment = this.getJavascriptFragment();
		var row;

	 if(rows !== undefined)
	 {
	 	if(! ((typeof rows == 'object')||(typeof rows == 'function')))
	 	{
	 		row = new Array();
	 		row[0] = rows;
	  }
	  else
	   row=rows;
	 }
	 else
	 	row = new Array();
					
		var fieldValue;
		var fieldValues;
		
		for(var i=0;i<=dataFields.length-1;i++)
		{
			var field = dataFields[i];

			if(row[field] !== undefined)
			{
			 fieldValue = row[field];
			}
			else
			{
			  fieldValue = "";
			}
			
			fieldValues = this.getDataFieldsAllValues(field,fieldValue);		
			fieldValue = fieldValues;
			
			var domain = this.getDataFieldDomainByName(field);

      if(domain == Int_domain.FIELD_DOMAIN_OBJECT)			
			{
		   if(this.getInheritData())
		    fieldValue.setDataSource(row);
		   var num = fieldValue.getNum();
       fieldValue.setNum(num + "_" + actNum);
			 fieldValue.setEnableSendData(false);
		   fieldValue.putData();
		   javascriptFragment.replace("#" + field.toUpperCase() + "#",fieldValue.dump());		
			}
			else 
			if(domain == Int_domain.FIELD_DOMAIN_VAR)
		  {
		   eval("var " + field + " = fieldValue;");
			}
			else
		  {
		  	if(util.is_array(fieldValue))
		  	{
		  		var arrayDataStr = "Array(";
		  		for(var j=0;j<=fieldValue.length-1;j++)
		  		{
		  			var val = fieldValue[j];
		  			if(typeof val=="string")
		  			 arrayDataStr += "'" + val + "'";
		  			else
		  				if(typeof val=="number")
		  				 arrayDataStr += val;
		  		    else
		  		     alert("Errore nel valore dell' array.");
		  		     
		  		  if(j < fieldValue.length-1)
		  		   arrayDataStr += ",";
		  		}
		  		arrayDataStr += ")";
		  		var pattern = new RegExp("#" + field.toUpperCase() + "#","g");
		  		javascriptFragment=javascriptFragment.replace(pattern,arrayDataStr);
		  	}
		  	else
		  	{
		  	 var pattern = new RegExp("#" + field.toUpperCase() + "#","g");
		  	 if(this.getAddSlashToFieldValue() && (typeof fieldValue == "string"))
		  	  javascriptFragment=javascriptFragment.replace(pattern,
		  	  fieldValue.replace(/\\/g,'\\\\').replace(/'/g,'\\\'').replace(/"/g,'\"'));
		  	 else
			 {
          javascriptFragment=javascriptFragment.replace(pattern,
		  	  fieldValue);
			 }			  
		  	}
		  }
		}
//		console.log('AAA');
//		console.log(javascriptFragment);
//		console.log('BBB');
//		var op = this.getOp();
		eval(javascriptFragment);
	  var enableSendData = this.getEnableSendData();
	  if(enableSendData)
	  {
	   var hookId = this.getHookId();
	   if(hookId !== '')
	   {
	    var domContainerItem = document.getElementById(hookId);
	    if(domContainerItem != null)
	     domContainerItem.innerHTML = htmlWriter.sendData();
		}
	  }
	}
}

Javascript_data_fragment.prototype = new Html_data_interface('','','');
Javascript_data_fragment.prototype.constructor = Javascript_data_fragment;

//------------------

// Javascript_txtEditor

function Javascript_txtEditor(actOp,actNum)
{
	
  this.initialize = function(actOp1,actNum1)	
  {
   this.setOp(actOp1);
   this.setNum(actNum1);
   this.setType('Javascript_txtEditor');
   this.setHookId('');
   this.setDispFields(new Array());
   this.setCssClass('');
   this.setStyle('');
   this.setStack(new common.createStack('')); 
   var stack = new common.createStack();
   stack.setDumper(this.createMemoryDumper());
   this.setStack(stack);
   this.setHtmlWriter(new Html_writer(stack));
  }
	
	this.cols = 800;
	this.setCols = function(actCols)
	{
		this.cols = actCols;
	}
	this.getCols = function()
	{
		return this.cols; 
	}
	this.rows = 25;
	this.setRows = function(actRows)
	{
		this.rows = actRows;
	}
	this.getRows = function()
	{
		return this.rows;
	}
	this.fileName = '';
	this.getFileName = function()
	{
		return this.fileName;
	}
	this.setFileName = function(actFileName)
	{
	  this.fileName = actFileName;	
	}
	this.sendAjaxPage = 'ajax_handler.php';
	this.setSendAjaxPage = function(actSendAjaxPage)
	{
		this.sendAjaxPage = actSendAjaxPage;
	}
	this.getSendAjaxPage = function()
	{
		return this.sendAjaxPage;
	}
	this.sendAjaxOp = 'sendFile';
	this.setSendAjaxOp = function(actSendAjaxOp)
	{
		this.sendAjaxOp = actSendAjaxOp;
	}
	this.getSendAjaxOp = function()
	{
		return this.sendAjaxOp;
	}
  this.getAjaxPage = 'ajax_handler.php';
	this.setGetAjaxPage = function(actGetAjaxPage)
	{
		this.getAjaxPage = actGetAjaxPage;
	}
	this.getGetAjaxPage = function()
	{
		return this.getAjaxPage;
	}
	this.getAjaxOp = 'getFile';
	this.setGetAjaxOp = function(actGetAjaxOp)
	{
		this.getAjaxOp = actGetAjaxOp;
	}
	this.getGetAjaxOp = function()
	{
		return this.getAjaxOp;
	}
	this.sepChar = '';
	this.setSepChar=function(actSepChar)
	{
		this.sepChar = actSepChar;
  }
  this.getSepChar = function()
  {
  	return this.sepChar;
  }
	
	this.value = '';
	this.setValue = function(actValue)
	{
		this.value = actValue;
	}
	this.setValueToTextArea = function()
	{
	 var value = this.getValue();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textAreaEl = document.getElementById(intCode + '_' + 'textarea');
   textAreaEl.value = value;
	}	
	this.getValue = function()
	{
		return this.value;
	}
	this.getValueFromTextArea = function()
	{
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textAreaEl = document.getElementById(intCode + '_' + 'textarea');
   return textAreaEl.value;
	}
	this.textColor = 'black';
	this.setTextColor = function(actTextColor)
	{
		this.textColor = actTextColor;
	}
	this.getTextColor = function()
	{
	 return this.textColor;
	}
	this.ctrlColor = 'white';
	this.setCtrlColor = function(actCtrlColor)
	{
		this.ctrlColor = actCtrlColor;
	}
	this.getCtrlColor = function()
	{
	 return this.ctrlColor;
	}
	this.toolbarBorderColor = 'white';
	this.setToolbarBorderColor = function(actToolbarBorderColor)
	{
		this.toolbarBorderColor = actToolbarBorderColor;
	}
	this.getToolbarBorderColor = function()
	{
	 return this.toolbarBorderColor;
	}
	this.bodyBorderColor = 'white';
	this.setBodyBorderColor = function(actBodyBorderColor)
	{
		this.bodyBorderColor = actBodyBorderColor;
	}
	this.getBodyBorderColor = function()
	{
	 return this.bodyBorderColor;
	}
	this.buttonsBorderColor = 'white';
	this.setButtonsBorderColor = function(actButtonsBorderColor)
	{
		this.buttonsBorderColor = actButtonsBorderColor;
	}
	this.getButtonsBorderColor = function()
	{
	 return this.buttonsBorderColor;
	}
	this.toolbarBackgroundColor = 'white';
	this.setToolbarBackgroundColor = function(actToolbarBackgroundColor)
	{
		this.toolbarBackgroundColor = actToolbarBackgroundColor;
	}
	this.getToolbarBackgroundColor = function()
	{
	 return this.toolbarBackgroundColor;
	}
	this.bodyBackgroundColor = 'white';
	this.setBodyBackgroundColor = function(actBodyBackgroundColor)
	{
		this.bodyBackgroundColor = actBodyBackgroundColor;
	}
	this.getBodyBackgroundColor = function()
	{
	 return this.bodyBackgroundColor;
	}
	this.buttonsBackgroundColor = 'white';
	this.setButtonsBackgroundColor = function(actButtonsBackgroundColor)
	{
		this.buttonsBackgroundColor = actButtonsBackgroundColor;
	}
	this.getButtonsBackgroundColor = function()
	{
	 return this.buttonsBackgroundColor;
	}
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var opName = this.getOp();
	 var cssClass = this.getCssClass();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var fileName = this.getFileName();
   var value = this.getValue();
   var cols = this.getCols();
   var rows = this.getRows();
   var textColor = this.getTextColor();
   var ctrlColor = this.getCtrlColor();
   var toolbarBorderColor = this.getToolbarBorderColor();
   var bodyBorderColor = this.getBodyBorderColor();
   var buttonsBorderColor = this.getButtonsBorderColor();
   var toolbarBackgroundColor = this.getToolbarBackgroundColor();
   var bodyBackgroundColor = this.getBodyBackgroundColor();
   var buttonsBackgroundColor = this.getButtonsBackgroundColor();
   htmlWriter.putGenericHtmlString('<div class="' + cssClass + '" id="' + intCode + 
   '" style="' + 'width:100%;border:2px solid ' + ctrlColor + '">');
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'toolbar' + '" style="' + 
   'width:100%;border:1px solid ' + toolbarBorderColor + ';background-color:' + 
   toolbarBackgroundColor + ';' + '">');
   htmlWriter.putGenericHtmlString('<table>');
   htmlWriter.putGenericHtmlString('<tr>');
   htmlWriter.putGenericHtmlString('<td colspan="3"><label for="' + 
   intCode + '_' + 'filenameInputCtrl' + '" style="color:' + textColor + 
   '">Nome file:&nbsp;</label><input size="50" id="' + intCode + '_' +
   'fileNameInputCtrl' + '" type="text" name="' + intCode + '_' + 'fileNameInputCtrl' + 
   '" value="' + fileName +  '" onchange="' + 'Javascript_txtEditor.fileName=this.value;' + '"/></td>');
   htmlWriter.putGenericHtmlString('</tr>');
   htmlWriter.putGenericHtmlString('<tr>');
   htmlWriter.putGenericHtmlString('<td><label for="' + 
   intCode + '_' + 'findInputCtrl' + '" style="color:' + textColor + 
   '">Find:&nbsp;</label><input id="' + intCode + '_' +
   'findInputCtrl' + '" type="text" name="' + intCode + '_' + 'findInputCtrl' + 
   '" value=""/></td><td><label for="' + 
   intCode + '_' + 'replaceInputCtrl' + '" style="color:' + textColor + 
   '">Replace:&nbsp;</label><input id="' + intCode + '_' +
   'replaceInputCtrl' + '" type="text" name="' + intCode + '_' + 'replaceInputCtrl' + 
   '" value=""/></td><td>' +
   '<button onclick=" var findItem = document.getElementById(\'' + intCode + '_' + 
   'findInputCtrl' + '\').value;var replaceItem = document.getElementById(\'' +
    intCode + '_' + 
   'replaceInputCtrl' + '\').value; var subjectEl = document.getElementById(\'' + intCode + '_' + 
   'textarea' + '\');var subjectItem = subjectEl.value;var subjectItem2 = subjectItem.replace(findItem' +  
   ',replaceItem);subjectEl.value = subjectItem2;">apply</button></td>');
    htmlWriter.putGenericHtmlString('</tr>');
   htmlWriter.putGenericHtmlString('</table>');
   htmlWriter.putGenericHtmlString('</div>'); 
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'body' + '" style="' + 
   'width:100%;border:1px solid ' + bodyBorderColor + ';overflow:scroll;background-color:' + 
   bodyBackgroundColor + ';' + '">');
   htmlWriter.putGenericHtmlString('<textarea id="' + intCode + '_' + 
   'textarea' + '" rows="' + rows + '" cols="' + cols + '"></textarea>');
   htmlWriter.putGenericHtmlString('</div>');
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'Buttons" style="' + 
   'margin:0px;border:1px solid ' + buttonsBorderColor + ';background-color:' + 
   buttonsBackgroundColor + ';">');
   var sendAjaxPage = this.getSendAjaxPage();
   var sendAjaxOp = this.getSendAjaxOp();
   var getAjaxPage = this.getGetAjaxPage();
   var getAjaxOp = this.getGetAjaxOp();
   htmlWriter.putGenericHtmlString('<button id="' + intCode + '_' + 'sendButton' + 
   '" onclick="' + 
   'var textareaEl = document.getElementById(\'' + intCode + '_' + 'textarea' + '\');' + 
   'var value = textareaEl.value;' +
   'var inputEl = document.getElementById(\'' + intCode + '_' + 'fileNameInputCtrl' + '\');' +
   'var sendAjaxId = inputEl.value;;' + 
   'var valuePostStr = \'value=\' + value;' +
   'var opName = \'' + sendAjaxOp + '\';console.log(ajaxHandler);' + 
   'if(! ajaxHandler.getOpByName(\'' + opName + '\'));' +
   'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
   util.firstCharToUpperCase(sendAjaxOp) + '\' + \'(opName)\');' +
   'ajaxHandler.serverPostCall(\'' + sendAjaxPage + '\',\'' + sendAjaxOp + '\',sendAjaxId' + 
   ',' + 'valuePostStr,\'text\',/[\s\._\:A-Za-z0-9;\-\?\<\>\/]*/);' + 
   '">Send</button>' + 
   '<button id="' + intCode + '_' + 'getButton' + 
   '" onclick="' + 
   'var inputEl = document.getElementById(\'' + intCode + '_' + 'fileNameInputCtrl' + '\');' +
   'var getAjaxId = inputEl.value;' + 
   'var textareaEl = document.getElementById(\'' + intCode + '_' + 'textarea' + '\');' + 
   'var opName = \'' + getAjaxOp + '\';' + 
   'if(! ajaxHandler.getOpByName(\'' + opName + '\'))' +
   'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
   util.firstCharToUpperCase(getAjaxOp) + '\' + \'(opName)\');' +
   'ajaxHandler.serverCall(\'' + getAjaxPage + '\',\'' + getAjaxOp + '\',getAjaxId' + 
   ',\'text\',/[\s\._\:A-Za-z0-9;\-\?\<\>\/]*/);' + 
   '">Get</button>');
   htmlWriter.putGenericHtmlString('</div>'); 
   htmlWriter.putGenericHtmlString('</div>');     
   this.sendData();		
   this.setValueToTextArea();
	};
		
}
Javascript_txtEditor.prototype = new Html_formatted_interface('','','');
Javascript_txtEditor.prototype.constructor = Javascript_txtEditor;
Javascript_txtEditor.ajaxOp = new Function("actTxtAreaId","actTxt",
"{" + "var textAreaEl = document.getElementById(actTxtAreaId);" +
"textAreaEl.value = actTxt;" + "}");


//------------------
//------------------

// Javascript_ace_txtEditor

function Javascript_ace_txtEditor(actOp,actNum)
{
   this.initialize = function(actOp1,actNum1)
   {
    this.setOp(actOp1);
    this.setNum(actNum1);
    this.setType('Javascript_ace_txtEditor');
    this.setHookId('');
    this.setDispFields(new Array());
    this.setCssClass('');
    this.setStyle('');
    this.setStack(new common.createStack('')); 
	var stack = new common.createStack();
	stack.setDumper(this.createMemoryDumper());
    this.setStack(stack);
	this.setHtmlWriter(new Html_writer(stack));
   }	
	
	this.editorId = '';
	this.getEditorId= function()
	{
		return this.editorId;
	}
	this.setEditorId=function(actEditorId)
	{
		this.editorId = actEditorId;
	}	
	this.createEditor = function()
	{
		var editorId = this.getEditorId();
		return ace.edit(editorId);
	}
	
	this.editor = null;
  this.getEditor = function()
  {
  	return this.editor;
  } 
  this.setEditor=function(actEditor)
  {
  	this.editor = actEditor
  } 
	this.fileName = '';
	this.getFileName = function()
	{
		return this.fileName;
	}
	this.setFileName = function(actFileName)
	{
	  this.fileName = actFileName;	
	}
	this.fontSize = '10px';
	this.getFontSize = function()
	{
		return this.fontSize;
	}
	this.setFontSize = function(actFontSize)
	{
	  this.fontSize = actFontSize;	
	}
	this.height = '400px';
	this.getHeight = function()
	{
		return this.height;
	}
	this.setHeight = function(actHeight)
	{
	  this.height = actHeight;	
	}		
	this.keyboardHandler = 'windows';
	this.getKeyboardHandler = function()
	{
		return this.keyboardHandler;
	}
	this.setKeyboardHandler = function(actKeyboardHandler)
	{
	  this.keyboardHandler = actKeyboardHandler;	
	}		
	this.readOnly = false;
	this.getReadOnly = function()
	{
		return this.readOnly;
	}
	this.setReadOnly = function(actReadOnly)
	{
	  this.readOnly = actReadOnly;	
	}		
	this.showInvisibles = false;
	this.getShowInvisibles = function()
	{
		return this.showInvisibles;
	}
	this.setShowInvisibles = function(actShowInvisibles)
	{
	  this.showInvisibles = actShowInvisibles;	
	}		
	this.theme = 'monokai';
	this.getTheme = function()
	{
		return this.theme;
	}
	this.setTheme = function(actTheme)
	{
	  this.theme = 'ace/theme/' + actTheme;	
	}	
	this.mode = false;
	this.getMode = function()
	{
		return this.mode;
	}
	this.setMode = function(actMode)
	{
	  this.mode = 'ace/mode/' + actMode;	
	}			
	this.enableStatusBar = false;
	this.getEnableStatusBar = function()
	{
		return this.enableStatusBar;
	}
	this.setEnableStatusBar = function(actEnableStatusBar)
	{
	  this.enableStatusBar = actEnableStatusBar;	
	}
	this.enableOpBar = false;
	this.getEnableOpBar = function()
	{
		return this.enableOpBar;
	}
	this.setEnableOpBar = function(actEnableOpBar)
	{
	  this.enableOpBar = actEnableOpBar;	
	}
	
	this.sendAjaxPage = 'ajax_handler.php';
	this.setSendAjaxPage = function(actSendAjaxPage)
	{
		this.sendAjaxPage = actSendAjaxPage;
	}
	this.getSendAjaxPage = function()
	{
		return this.sendAjaxPage;
	}
	this.sendAjaxOp = 'sendFile';
	this.setSendAjaxOp = function(actSendAjaxOp)
	{
		this.sendAjaxOp = actSendAjaxOp;
	}
	this.getSendAjaxOp = function()
	{
		return this.sendAjaxOp;
	}
  this.getAjaxPage = 'ajax_handler.php';
	this.setGetAjaxPage = function(actGetAjaxPage)
	{
		this.getAjaxPage = actGetAjaxPage;
	}
	this.getGetAjaxPage = function()
	{
		return this.getAjaxPage;
	}
	this.getAjaxOp = 'getFile';
	this.setGetAjaxOp = function(actGetAjaxOp)
	{
		this.getAjaxOp = actGetAjaxOp;
	}
	this.getGetAjaxOp = function()
	{
		return this.getAjaxOp;
	}
	this.sepChar = '';
	this.setSepChar=function(actSepChar)
	{
		this.sepChar = actSepChar;
  }
  this.getSepChar = function()
  {
  	return this.sepChar;
  }
	
	this.value = '';
	this.setValue = function(actValue)
	{
   this.value=actValue;
	}
	this.setValueToEditor = function(actValue)
	{
	 if(actValue===undefined)
	  var value = this.getValue();
	 else
	 	var value = actValue;
	 var editor = this.getEditor();
	 editor.setValue(value);
	}	
	this.getValue = function()
	{
		return this.value;
	}
	this.getValueFromEditor = function()
	{
	 var editor = this.getEditor();
   return editor.getValue();
	}
	this.extCtrlManager = function(actEvent){};
	this.setExtCtrlManager = function(actExtCtrlManager)
	{
		this.extCtrlManager = actExtCtrlManager;
	}
	this.getExtCtrlManager=function()
	{
		return this.extCtrlManager;
	}
	this.buttonsBorderColor = 'white';
	this.setButtonsBorderColor = function(actButtonsBorderColor)
	{
		this.buttonsBorderColor = actButtonsBorderColor;
	}
	this.getButtonsBorderColor = function()
	{
	 return this.buttonsBorderColor;
	}
	this.buttonsBackgroundColor = 'white';
	this.setButtonsBackgroundColor = function(actButtonsBackgroundColor)
	{
		this.buttonsBackgroundColor = actButtonsBackgroundColor;
	}
	this.getButtonsBackgroundColor = function()
	{
	 return this.buttonsBackgroundColor;
	}
	this.textColor = 'black';
	this.setTextColor = function(actTextColor)
	{
		this.textColor = actTextColor;
	}
	this.getTextColor = function()
	{
	 return this.textColor;
	}
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textColor = this.getTextColor();
   var fileName = this.getFileName();
   var op = this.getOp();
   var fontSize = this.getFontSize();
   var buttonsBorderColor = this.getButtonsBorderColor();
   var buttonsBackgroundColor = this.getButtonsBackgroundColor();
   var fontSize = this.getFontSize();
   var height = this.getHeight();
   var keyboardHandler = this.getKeyboardHandler();
   var readOnly = this.getReadOnly();
   var showInvisibles = this.getShowInvisibles();
   var theme = this.getTheme();
   var style = this.getStyle();
   var mode = this.getMode();   
   var editor = this.createEditor();
   var editorId = this.getEditorId();
   var enableStatusBar = this.getEnableStatusBar();
   var enableOpBar = this.getEnableOpBar();
   editor.setFontSize(fontSize);
   editor.setKeyboardHandler(keyboardHandler);
   editor.setReadOnly(readOnly);
   editor.setShowInvisibles(showInvisibles);
   editor.setTheme(theme);
   editor.setStyle(style);
   editor.getSession().setMode(mode);
   this.setEditor(editor);
   var editorDiv = document.getElementById(editorId);
   editorDiv.style.height=height;
   if(enableStatusBar)
    htmlWriter.putGenericHtmlString('<div id="statusBar"></div>');
   if(enableOpBar)
   {
    htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'Buttons" style="' + 
    'color:' + textColor + ';' +
    'margin:0px;border:1px solid;height:35px;' + buttonsBorderColor + ';background-color:' + 
    buttonsBackgroundColor + ';">');
    var sendAjaxPage = this.getSendAjaxPage();
    var sendAjaxOp = this.getSendAjaxOp();
    var getAjaxPage = this.getGetAjaxPage();
    var getAjaxOp = this.getGetAjaxOp();
    htmlWriter.putGenericHtmlString('<button title="Send document" style="float:left;margin:5px 5px ;" id="' + intCode + '_' + 'sendButton' + 
    '" onclick="' + 
    'var value = interfacesContainer.getInterface(\'' + op + '\').getValueFromEditor();' +
    'var valuePostStr = \'value=\' + value;' +
    'var sendAjaxId = \'' + fileName + '\';' +  
    'var opName = \'' + sendAjaxOp + '\';' + 
    'if(! ajaxHandler.getOpByName(opName))' +
    'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
    util.firstCharToUpperCase(sendAjaxOp) + '\' + \'(opName)\');' +
    'ajaxHandler.serverPostCall(\'' + sendAjaxPage + '\',\'' + sendAjaxOp + '\',sendAjaxId' + 
    ',' + 'valuePostStr,\'text\',/[\s\._\:A-Za-z0-9;\-\?\<\>\/]*/);var sign=document.getElementById(\'modify_sign\');' +
    'sign.style.visibility=\'hidden\';' + 
    '">Send</button>' + 
    '<button title="Get document" style="float:left;margin:5px 5px;" id="' + intCode + '_' + 'getButton' + 
    '" onclick="' + 
    'var getAjaxId = \'' + fileName + '\';' +  
    'var opName = \'' + getAjaxOp + '\';' + 
    'if(! ajaxHandler.getOpByName(opName))' +
    'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
    util.firstCharToUpperCase(getAjaxOp) + '\' + \'(opName)\');' +
    'ajaxHandler.synServerCall(\'' + getAjaxPage + '\',\'' + getAjaxOp + '\',getAjaxId' + 
    ',\'text\',/[\s\._\:A-Za-z0-9;\-\?\<\>\/]*/);var sign=document.getElementById(\'modify_sign\');' +
    'sign.style.visibility=\'hidden\';var txtAceEditor = interfacesContainer.getInterface(\'' + op + 
    '\');txtAceEditor.getEditor().navigateTo(0,0);txtAceEditor.getExtCtrlManager()(\'get\');alert(\'ok\');' + 
    '">Get</button><div style="text-align:right;"><span style="margin-right:10px;visibility:hidden;" id="modify_sign">*</span>' +
    '<button title="resize" style="margin:5px 5px 0px 0px;" id="resizer_plus" onclick="' +
    'var editorId = \'' + editorId + '\';var editorDiv = document.getElementById(editorId);' +
    'var height = editorDiv.style.height.slice(0,-2);height=parseInt(height) + 10;' +
    'editorDiv.style.height=height + \'px\';">+</button>' +
    '<button title="resize" style="margin:5px 5px 0px 0px;" id="resizer_minus" onclick="' +
    'var editorId = \'' + editorId + '\';var editorDiv = document.getElementById(editorId);' +
    'var height = editorDiv.style.height.slice(0,-2);var initHeight = \'' + height + '\'.slice(0,-2);' +
    'var newHeight = parseInt(height) - 10;if(newHeight>=parseInt(initHeight))editorDiv.style.height=newHeight + \'px\';">-</button>' +
    '</div>'); 
    htmlWriter.putGenericHtmlString('</div>');
   }
   this.sendData();
   if(enableStatusBar)
   {
    var StatusBar = ace.require("ace/ext/statusbar").StatusBar;
    var statusBar = new StatusBar(editor, document.getElementById("statusBar"));    	
   }
   this.setValueToEditor();	
   var thisObj = this;
   if(enableOpBar)
   {
    editor.on('change',function(actObj){
    	var sign=document.getElementById('modify_sign');
    	sign.style.visibility='visible';thisObj.getExtCtrlManager()('change');});  
	 }
	};
}
Javascript_ace_txtEditor.prototype = new Html_formatted_interface('','','');
Javascript_ace_txtEditor.prototype.constructor = Javascript_ace_txtEditor;


//------------------

return {
"createHtmlWriter":function(actStack){
	var stack=null;
	if(actStack !== undefined) stack=actStack;
	return new Html_writer(stack);},
"createMemoryDumper":function(actObj){
 return new Memory_dumper(actObj);
 },
"createInterfacesContainer":function(actName){
	var name='';
	if(actName!==undefined)
	 name = actName;
	return new Interfaces_container(name);
},
"createHtmlDataTemplate":function(actOp,actNum){
 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;
 var htmlDataTemplate = new Html_data_template(op,num);
 var htmlDataTemplate1 = util.cloner().clone(htmlDataTemplate);
 htmlDataTemplate1.initialize(op,num);
 return htmlDataTemplate1;
},
"createJavascriptFragment":function(actOp,actNum){
	 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;
 var javascriptFragment = new Javascript_fragment(op,num);
 javascriptFragment.initialize(op,num);
 return javascriptFragment;

},
"createJavascriptDataFragment":function(actOp,actNum){
 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;

 /*console.log('jjj');
 Html_formatted_interface.prototype = new Generic_interface('','','');
 Html_formatted_interface.prototype.constructor = Html_formatted_interface;
 Html_data_interface.prototype = new Html_formatted_interface('','','');
 Html_data_interface.prototype.constructor = Html_data_interface;
 Javascript_data_fragment.prototype = new Html_data_interface('','','');
 Javascript_data_fragment.prototype.constructor = Javascript_data_fragment;*/
 var javascriptDataFragment = new Javascript_data_fragment(op,num);
 var javascriptDataFragment1 = util.cloner().clone(javascriptDataFragment);
 javascriptDataFragment1.initialize(op,num);
 return javascriptDataFragment1;
},
"Generic_interface":Generic_interface,
"createHtmlDataInterface":function(actOp,actType,actNum){
 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;
 if(actType !==undefined)
  type = actType;
 return new Html_data_interface(op,type,num);
},
"Html_data_interface":Html_data_interface,
"createJavascriptTxtEditor":function(actOp,actNum){
 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;
 var javascriptTxtEditor = new Javascript_txtEditor(op,num);
 javascriptTxtEditor.initialize(op,num);
 return javascriptTxtEditor;
},
"createJavascriptAceTxtEditor":function(actOp,actNum){
 var op='';
 var num=0;
 if(actOp!==undefined)
  op = actOp;
 if(actNum !==undefined)
  num = actNum;
 var javascriptAceEditor = new Javascript_ace_txtEditor(op,num);
 javascriptAceEditor.initialize(op,num);
 return javascriptAceEditor;
}

}	
}();