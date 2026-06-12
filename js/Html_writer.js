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
 	var stack = this.getStack();
 	var dumper = stack.getDumper();
 	return dumper;
 };
 this.setDumper = function(actDumper)
 {
 	var stack = this.getStack();
 	stack.setDumper(actDumper);
 };
 this.sendData = function()
 {
 	var stack = this.getStack();
 	var flushEnabled = this.getFlushEnabled();
 	if (flushEnabled)
 	 return stack.flush();
 	else
 	 return stack.dump();
 };
 
 this.putGenericHtmlString = function(actStr,actClass)
 {
 	var stack = this.getStack();
 	var str='';
 	if(actClass !== undefined)
 	 str = "<" + "span" + " class=" + "\"" + actClass + "\"" + 
 	 + ">" + actStr + "</span>";
 	else
 	 str = actStr;
 	 
 	stack.push(str);
 }
 
  this.put = this.putGenericHtmlString;
 
}