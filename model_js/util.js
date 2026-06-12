var util = function()
{

// function Comparator(actObj)
// {
//   this.object = actObj;
//   this.equals = function(actItem)
//   {
//        for (p in this.actObj) {
//            switch (typeof(this[p])) {
//            case 'object':
//                if (!this[p].equals(actItem[p])) {
//                    return false;
//                }
//                break;
//            case 'function':
//                if (typeof(actItem[p]) == 'undefined' || (p != 'equals' && this[p].toString() != actItem[p].toString())) {
//                    return false;
//                }
//                break;
//            default:
//                    return false;
//                }
//                if (this[p] != actItem[p]) {return false;
//            }
//        }
//
//        for (p in actItem) {
//            if (typeof(this[p]) == 'undefined') {
//                return false;
//            }
//        }
//		return true;
//
//   }
// };


 function Cloner(actObj)
 {
	this.obj = actObj;
	
	this.objCloneBuffer = new Array();
	
    this.is_array = function(actObj1) 
	{
     //console.log(actObj1);
     return Object.prototype.toString.call(actObj1) === "[object Array]";
    }
	
    this.in_array = function(actVal,actObj1)
    {
	 //console.log(actObj1);
     if(this.is_array(actObj1))
     {
      //console.log(actVal);
      var num = actObj1.length;
      for(var i=0;i<=num-1;i++)
	  {
//	   var comp = new util.comparator(actObj1[i]);
//       if(comp.equals(actVal) | (actObj1[i] === actVal))
       if(actObj1[i] === actVal)
	   {
		//console.log(actObj);
        return true;
	   }
	  }
     }    
     return false;
    }	
	
	this.clone = function(actItem)
	{
	 //console.log(this.objCloneBuffer);
	 if(this.in_array(actItem,this.objCloneBuffer))
	  return null;
     else
      this.objCloneBuffer.push(actItem);
 
     if (! actItem) 
     { return actItem; } // null, undefined values check

     var types = [ Number, String, Boolean], 
        result;

    // normalizing primitives if someone did new String('aaa'), or new Number('444');
     for(var index in types) 
     {
    	  var type = types[index];
        if (actItem instanceof type) 
        {
            result = type( actItem );
        }
     };
    
     if (typeof result == "undefined") 
     {
        if (Object.prototype.toString.call( actItem ) === "[object Array]") 
        {
            result = [];
			//console.log('X1');
			//console.log(actItem);
            for(var index in actItem) 
            { 
		        //console.log('z');
            	  var child = actItem[index];
                result[index] = this.clone( child );
            }
        } 
        else 
        	if (typeof actItem == "object") 
          {
            // testing that this is DOM
            if (actItem.nodeType && typeof actItem.cloneNode == "function") 
            {
                var result = actItem.cloneNode( true );    
            } 
            else if (! actItem.prototype) 
            { // check that this is a literal
                if (actItem instanceof Date) 
                {
                    result = new Date(actItem);
                } 
                else 
                {
                    // it is an object literal
                    result = {};
                    for (var i in actItem) 
                    {
						//console.log(actItem);
                        result[i] = this.clone( actItem[i] );
                    }
                }
            } 
            else 
            {
                // depending what you would like here,
                // just keep the reference, or create new object
                if (false && actItem.constructor) 
                {
                    // would not advice to do that, reason? Read below
                    result = new actItem.constructor();
                } 
                else 
                {
					//console.log('Z2');
                    result = {};
                    for (var i in actItem) 
                    {
                        result[i] = this.clone( actItem[i] );
                    }
                }
            }
        } 
        else 
        {
            result = actItem;
        }
     }
     return result;
  }
 };

 return {
 "removeAllOptionsFromSelect" : function(actSelect)
 {
 	var options = actSelect.options;
  for (opt in options)	
  {
  	actSelect.remove();
  }
  return actSelect;
}
,	
 "setFirstNodeValById":function(actId,actVal)
{
 var element = document.getElementById(actId);
 var firstNode = element.childNodes[0];
 firstNode.nodeValue = actVal;
}
,
"getNodeInnerTextById":function(actId)
{
 var element = document.getElementById(actId);
 return element.innerText;
}
,
"array_getPos":function(actVal,actArray)
{
 if(this.is_array(actArray))
 {
  var num = actArray.length;
  for(var i=0;i<=num-1;i++)
   if(actArray[i]==actVal)
    return i;
 }
 return false;
}
,
"in_array":function(actVal,actArray)
{
	if(this.is_array(actArray))
     {
      var num = actArray.length;
      for(var i=0;i<=num-1;i++)
 //      if(util.comparator(actArray[i]).equals(actVal) | (actArray[i] === actVal))
       if(actArray[i] === actVal)
	   {
        return true;
	   }
     }    
     return false;	
}
,
"is_array":function(actObj) {
     return Object.prototype.toString.call(actObj) === "[object Array]";
}
,
"is_object":function(actObj) {
    return Object.prototype.toString.call(actObj) === "[object Object]";
}
,
"count":function(actVar)
{
	var count=0;
	for(var prop in actVar)
	 count++;
	return count;
}
,
"is_array_of_array":function(actVar)
{ 
   var retVal = false;
   /*console.log('QQQQQQ1');
   console.log(actVar);
   console.log('QQQQQ2');*/
   if(this.is_array(actVar))
   {
   	for(var prop in actVar)
   	{
   		if(util.is_array(actVar[prop]))
   		 retVal=true;
   		else
   		{retVal=false;break;}
   	}
   }
   return retVal;
}
,
"arrayEmpty":function(actArray)
{
  if(! this.is_array(actArray))
   return false;
  while(actArray.length > 0)
   actArray.pop();
  return actArray;
}
,
"deleteSelectFieldContents":function(actId)
{
	var selectField = document.getElementById(actId);
	var num = selectField.length;
	for(var i=0;i<=num-1;i++)
	{
		selectField.remove(0);
	}
}
,
"extractLastItemFromString":function(actStr,actStrSep)
{
	var actStrItems = actStr.split(actStrSep);
	var actStrItem = actStrItems[actStrItems.length-1];
	return actStrItem;
}
,
"extractSuffixFromString":function(actStr,actStrSep)
{
	var actStrItems = actStr.split(actStrSep);
	var num =actStrItems.length;
	if(num>=1)
	 var str = actStrItems[0];
	for(var i=1;i<=num-2;i++)
	  str = str + actStrSep + actStrItems[i];
	return str;
}
,
"firstCharToUpperCase":function(actStr)
{
	return actStr.slice(0,1).toUpperCase() + actStr.slice(1,actStr.length);	
}
,
"setBgColorById":function(actId, actColor) 
{
 var o = document.getElementById(actId);
 o.style.backgroundColor = actColor;
}
,
"setBorderColorById":function(actId, actColor)
{
 var o = document.getElementById(actId);
 o.style.borderColor = actColor;
}
,
"setForeColorById":function(actId, actColor)
{
 var o = document.getElementById(actId);
 o.style.color = actColor;
}
,
"makeHex":function(r,g,b) 
{
    r = r.toString(16); if (r.length == 1) r = '0' + r;
    g = g.toString(16); if (g.length == 1) g = '0' + g;
    b = b.toString(16); if (b.length == 1) b = '0' + b;
    return "#" + r + g + b;
}
,
"testTextInComboLabels":function(actComboId,actText)
{
	var actCombo = document.getElementById(actComboId);
	var options = actCombo.options;
	var optionsNum = options.length;
	for(var i=0;i<=optionsNum-1;i++)
	{
	 var option = options[i];
	 if(option.text==actText)
	  return true;
	} 
	return false;
}
,
"ucFirst":function(actStr)
{
	var firstChar = actStr.substr(0,1);
	var strRest = actStr.substr(1);
	return firstChar.toUpperCase() + strRest;
}
,
"lcFirst":function(actStr)
{
	var firstChar = actStr.substr(0,1);
	var strRest = actStr.substr(1);
	return firstChar.toLowerCase() + strRest;	
}
,
"getUrlArgsValues":function(actStr)
{
 var args = Array();
 var j=0;
 var pairs = actStr.substring(1).split('&');
 for(var i=0;i<=pairs.length-1;i++)
 {
 	var pos = pairs[i].indexOf('=');
 	if(pos==-1) continue;
 	var argValue = pairs[i].substring(pos+1);
 	args[j++] = argValue;
 }
 return args;
}
,
"getUrlArgsKeyAndValues":function(actStr)
{
 var args = Array();
 var j=0;
 var pairs = actStr.substring(1).split('&');
 for(var i=0;i<=pairs.length-1;i++)
 {
 	var pos = pairs[i].indexOf('=');
 	if(pos==-1) continue;
 	var argValue = pairs[i].substring(pos+1);
 	var keyValue = pairs[i].slice(0,pos);
 	args[keyValue] = argValue;
 }
 return args;
}
,
"item_in_array_keys":function(actItem,actArray)
{
	for(var ind in actArray)
	{
		if(ind==actItem)
		 return true;
	}
	return false;
}
,
"is_string":function(actVar)
{
 var tipoVar = typeof actVar;
 if(tipoVar == "string")
  return true;
 else
 	return false;
}
,
"is_numeric":function(actVar)
{
 var tipoVar = typeof actVar;
 if(tipoVar == "number")
  return true;
 else
 	return false;
}
,
"array_is_numeric":function(actArray)
{
	for(var ind in actArray)
	{
		if( ! util.is_numeric(ind))
		 return false;
	}
	return true;
}
,
"itemInArrayKeys":function(actItem,actArray)
{
	var flag=false;
	for(var item in actArray)
	{
		if(item==actItem)
		 flag=true;
	}
	return flag;
}
,
"array_is_part_assoc":function(actArray)
{
	for(var ind in actArray)
	{
		if(util.is_string(ind))
		 return true;
	}
	return false;
}
,
"length":function(actObj)
{
 var ct=0;
 for(var key in actObj)
 {
 	ct++;
 }
 return ct;
}
,
"setSelectedItemToValue":function(actSelectCtrl,actSelectedItem,actVal)
{
	var options = actSelectCtrl.options;
	var optionsNum = options.length;
	for(var i=0;i<=optionsNum-1;i++)
	{
	 var option = options[i];
	 if(option.label==actSelectedItem)
	 {
	 	option.label=actVal;
	  break;
	 }
	} 
	actSelectCtrl.selectedIndex = i;
	return true;
}
,
"setSelectedItem":function(actSelectCtrl,actSelectedItem)
{
	var options = actSelectCtrl.options;
	var optionsNum = options.length;
	for(var i=0;i<=optionsNum-1;i++)
	{
	 var option = options[i];
	 if(option.label==actSelectedItem)
	  break;
	} 
	actSelectCtrl.selectedIndex = i;
	return true;
}
,
"getCookie":function(actName)
{
	var allcookies = document.cookie;
	if(allcookies=='') return false;
	var start = allcookies.indexOf(actName);
	if(start == -1) return false;
	start += actName.length + 1;
	var end = allcookies.indexOf(';',start);
	if(end == -1) end = allcookies.length;
	var cookieval = allcookies.substring(start,end);
	return cookieval;
}
,
"setCookie":function(actName,actVal,actHours,actDays)
{
 var cookieval = '';
 
 if(actHours)
  var expiration = new Date((new Date()).getTime() + actHours*3600000);
 else if(actDays)
 {
 	var	expiration = new Date((new Date()).getTime() + actDays*24*3600000);
 }
 else
 	expiration = null;
 	
 var cookie = actName + '=' + escape(actVal);
 if(expiration)
  cookie += '; expires=' + expiration.toUTCString();
 document.cookie = cookie;
 
 return true;
}
,
"cloner":function (actItem) 
 {
	return new Cloner(actItem);
 }
// "comparator":function(actItem)
// {
//	return new Comparator(actItem);
// }
}}();
