function Stack(actName)
{
 this.name = actName;
 this.setName = function(actName){this.name = actName;};
 this.getName = function(){return this.name;};
 this.dumper = null;
 
 this.setDumper = function(actDumper)
 {this.dumper=actDumper};
 
 this.getDumper = function()
 {
 	return this.dumper;
 };
 
 this.contents = new Array();
 
 this.setContents = function(actContents)
 {if(typeof(actContents)=='object')
 	 this.contents = actContents;
 	else
 	 alert('Errore in Stack.setContents');};
 this.getContents = function(){return this.contents;};
 
 this.inn = function(actVal)
 {
 	var contents = this.getContents();
 	var found = false;
 	for(var i=0;i<=contents.length-1;i++)
 	{
 		if(contents[i]==actVal)
 		{
 		 found=true;
 		 break;
 	  }
 	}
 	return found;
 }
 
 this.push = function(actData)
 {var contents = this.getContents();
 	contents.push(actData);};
 
 this.pop = function()
 {var contents = this.getContents();
 	return contents.pop();};
 	
 this.toString = function()
 {
 	var contents = this.getContents();
 	return contents.join('');
 };
 
 this.dump = function()
 {
 	var dumper = this.getDumper();
 	dumper.setObj(this);
 	return dumper.dump();
 }
 
 this.flush = function()
 {
 	var dumper = this.getDumper();
 	dumper.setObj(this);
 	var str = dumper.dump();
 	this.erase();
 	return str;
 }
 
 this.erase = function()
 {
 	var contents = this.getContents();
 	var item='';
 	while(item != undefined)
 	 item=contents.pop();
 }
 
 this.getCopy = function()
 {
  return util.cloner().clone(this);
 }
 
}