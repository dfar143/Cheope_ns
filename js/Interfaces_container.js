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
		this.interfaces = actInterfaces;
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