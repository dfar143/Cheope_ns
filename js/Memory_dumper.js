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