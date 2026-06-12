/**
 * COMMON DHTML FUNCTIONS
 * These are handy functions I use all the time.
 *
 * By Seth Banks (webmaster at subimage dot com)
 * http://www.subimage.com/
 *
 * Up to date code can be found at http://www.subimage.com/dhtml/
 *
 * This code is free for you to use anywhere, just keep this comment block.
 */

/**
 * X-browser event handler attachment and detachment
 * TH: Switched first true to false per http://www.onlinetools.org/articles/unobtrusivejavascript/chapter4.html
 *
 * @argument obj - the object to attach event to
 * @argument evType - name of the event - DONT ADD "on", pass only "mouseover", etc
 * @argument fn - function to call
 */
var common=function(){

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
  return util.cloner(this);
 }
 
}

var eventStack=new Stack('');

return {
"createStack":function(actStackName){
	var stackName='';
	if(actStackName!==undefined)
	 stackName = actStackName;
	 return new Stack(stackName);
},
"addEvent":function(obj, evType, fn){
 if (obj.addEventListener){
    obj.addEventListener(evType, fn, false);
    return true;
 } else if (obj.attachEvent){
    var r = obj.attachEvent("on" + evType, fn);
    return r;
 } else {
    return true;
 }
}
,
"setEventStack":function(actEventStack){eventStack=actEventStack;},
"getEventStack":function(){return eventStack;}
,
"addEventStack":function(){
	var fn;
	var fun=new Array();
	var i=0;
  
  var eventStack=this.getEventStack();
  
	while((fn = eventStack.pop())!==undefined)
	{
		fun[i] = fn;
		i++;
	}
	
	var fun2 = function()
	{
   	for(var i=fun.length-1;i>=0;i--)
//   for(var i=0;i<=fun.length-1;i++)
	  {
	  	fun[i]();
	  }
	};
  this.addEvent(window,'load',fun2);
  return true;
}
,
"removeEvent":function(obj, evType, fn, useCapture){
  if (obj.removeEventListener){
    obj.removeEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.detachEvent){
    var r = obj.detachEvent("on" + evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
	return true;
  }
}
}
}();
/**
 * Code below taken from - http://www.evolt.org/article/document_body_doctype_switching_and_more/17/30655/
 *
 * Modified 4/22/04 to work with Opera/Moz (by webmaster at subimage dot com)
 *
 * Gets the full width/height because it's different for most browsers.
 */
function getViewportHeight() {
	if (window.innerHeight!=window.undefined) return window.innerHeight;
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientHeight;
	if (document.body) return document.body.clientHeight; 

	return window.undefined; 
}
function getViewportWidth() {
	var offset = 17;
	var width = null;
	if (window.innerWidth!=window.undefined) return window.innerWidth; 
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientWidth; 
	if (document.body) return document.body.clientWidth; 
}

/**
 * Gets the real scroll top
 */
function getScrollTop() {
	if (self.pageYOffset) // all except Explorer
	{
		return self.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop)
		// Explorer 6 Strict
	{
		return document.documentElement.scrollTop;
	}
	else if (document.body) // all other Explorers
	{
		return document.body.scrollTop;
	}
}
function getScrollLeft() {
	if (self.pageXOffset) // all except Explorer
	{
		return self.pageXOffset;
	}
	else if (document.documentElement && document.documentElement.scrollLeft)
		// Explorer 6 Strict
	{
		return document.documentElement.scrollLeft;
	}
	else if (document.body) // all other Explorers
	{
		return document.body.scrollLeft;
	}
}
