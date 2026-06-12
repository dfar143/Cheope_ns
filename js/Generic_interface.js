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
 	return common.createStack();
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
 	var stack = this.getStack();
  oldStack = stack.getCopy();
  stack.erase();
  this.putData();
  var str = stack.dump();
  this.setStack(oldStack);
  return str;
 }
 
 this.dump = function()
 {
 	var stack = this.getStack();
 	var str = stack.dump();
 	return str;
 }
 
 this.flush = function()
 {
 	var stack = this.getStack();
 	var str = stack.dump();
 	stack.erase();
 	return str;	
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


