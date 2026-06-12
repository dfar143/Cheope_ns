//
// La versione treeCtrlX <X> indica il tipo di tree che può essere 
// di tipo strutturato con html ul o ol , oppure semplice (figli di html p) 
//

function TreeCtrl(actRootId,actMouseEvent,actItemClass,
actSubItemsHtmlType,actRootItemHtmlType,actCallBackFun)
{
 var rootId = actRootId;
 this.setRootId = function(actRootId)
 {rootId = actRootId}
 this.getRootId = function(){return rootId}
 var mouseEvent = actMouseEvent;
 this.setMouseEvent = function(actMouseEvent)
 {mouseEvent = actMouseEvent}
 this.getMouseEvent = function(){return mouseEvent}
 var itemClass = actItemClass; 	
 this.setItemClass = function(actItemClass)
 {itemClass = actItemClass}
 this.getItemClass = function(){return itemClass}
 var subItemsHtmlType = actSubItemsHtmlType;
 this.setSubItemsHtmlType = function(actSubItemsHtmlType)
 {subItemsHtmlType = actSubItemsHtmlType}
 this.getSubItemsHtmlType = function(){return subItemsHtmlType}
 var rootItemHtmlType = actRootItemHtmlType;
 this.setRootItemHtmlType = function(actRootItemHtmlType)
 {rootItemHtmlType = actRootItemHtmlType}
 this.getRootItemHtmlType = function(){return rootItemHtmlType}
 var callBackFun = actCallBackFun;
 this.setCallBackFun = function(actCallBackFun){callBackFun = actCallBackFun}
 this.getCallBackFun = function(){return callBackFun}
 var currentNode = undefined;
 this.setCurrentNode = function(actCurrentNode){currentNode = actCurrentNode}
 this.getCurrentNode = function(){return currentNode}	

 function callBackFun(actPos)
 {
 	alert('callBackFun_' + actPos);
 }
	
 function removeAllChilds(actRoot,actDeep)
 {
  var deep = actDeep;
  var root = actRoot;
  for(var i=0;i<=root.childNodes.length-1;i++)
  {
   var node = root.childNodes[i];
   var ddeep = deep + 1;
   removeAllChilds(node,ddeep);
   if((deep==0) && (node.nodeName=='#text'))
   {
    continue;
   }
   else
   {
    root.removeChild(node);
    i--;
   }
  }
 }
 
 this.putMenu = function()
 {
 	var rootId = this.getRootId();
  var rootItemHtmlType = this.getRootItemHtmlType();
 	var callBackFun = this.getCallBackFun();
  var root = document.getElementById(rootId);
  var newNode = document.createElement(rootItemHtmlType);
  if(rootItemHtmlType=='a')
  if (eval(rootId + '_' + 'par') == '#')
   newNode.setAttribute('href','#');
  else
   newNode.setAttribute('href',eval(rootId + '_' + 'par'));
  newNode.setAttribute('id', rootId + '_0');
  itemClass = this.getItemClass();
  newNode.setAttribute('class',itemClass); 
  var newTextNode = document.createTextNode(eval(rootId + '_' + 'label'));
  newNode.appendChild(newTextNode);
  var navAppName = navigator.appName;
  if((navAppName=='Netscape')||(navAppName=='Opera'))
  {
   var mouseEvent = this.getMouseEvent();
   var thisTreeObj = this;
   newNode.addEventListener(mouseEvent,
   function(event){thisTreeObj.trigMenu(event)},false);	
  }
  root.appendChild(newNode);
  var newSepNode = document.createElement('br');	
  root.appendChild(newSepNode);
 }
 
 this.trigMenu = function(actEvent)
 {
 	var rootId = this.getRootId();
 	var subItemsHtmlType = this.getSubItemsHtmlType();
 	var mouseEvent = this.getMouseEvent();
 	var itemClass = this.getItemClass();
 	var callBackFun = this.getCallBackFun();
  if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
  {
   var pos=actEvent.currentTarget.id;
   actEvent.stopPropagation();
  }
  else
  {
   var pos = event.srcElement.id;
  } 
  try
  {
   if (pos.indexOf(actRootId)>=0)
   {
   	var nPos = pos.substring(rootId.length+1,pos.length);
   	if(nPos != '')
   	{
     var vetOp = eval(rootId + '_' + 'labels'+ '_' + nPos);
     var vetOpGes = eval(rootId + '_' + 'urls' + '_' + nPos);
     var root = document.getElementById(pos);
     if(root.hasChildNodes())
     {
      if(root.childNodes.length == 1)
      {
       for (var i=0;i<=vetOp.length-1;i++)
       {
        var newRootId = pos + '_' + i;
        var newNode = document.createElement(subItemsHtmlType);
        newNode.setAttribute('id',newRootId);
        if(subItemsHtmlType=='a')
        {
         newNode.setAttribute('href',vetOpGes[i]);
         newNode.setAttribute('target','_self');
        }
        newNode.setAttribute('class',itemClass);
        var newTextNode = document.createTextNode(vetOp[i]);
        var newSepNode = document.createElement('br');
        root.appendChild(newSepNode);
        newNode.appendChild(newTextNode);
        if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
        {
         var thisTreeObj = this;
         newNode.addEventListener(mouseEvent,
         function(event){thisTreeObj.trigMenu(event)},false);
        }
        root.appendChild(newNode);
       }
      }
      else
      {
       removeAllChilds(root,0);
      }
     }
    }
   }
  }
  catch(excp)
  {
  	if(callBackFun !==undefined)
  	callBackFun(pos);
  }
 }
   	
}

function TreeCtrl2(actRootId,actMouseEvent,actItemClass,
actSubItemsHtmlType,actRootItemHtmlType,actCallBackFun)
{
 var rootId = actRootId;
 this.setRootId = function(actRootId)
 {rootId = actRootId}
 this.getRootId = function(){return rootId}
 var mouseEvent = actMouseEvent;
 this.setMouseEvent = function(actMouseEvent)
 {mouseEvent = actMouseEvent}
 this.getMouseEvent = function(){return mouseEvent}
 var itemClass = actItemClass; 	
 this.setItemClass = function(actItemClass)
 {itemClass = actItemClass}
 this.getItemClass = function(){return itemClass}
 var subItemsHtmlType = actSubItemsHtmlType;
 this.setSubItemsHtmlType = function(actSubItemsHtmlType)
 {subItemsHtmlType = actSubItemsHtmlType}
 this.getSubItemsHtmlType = function(){return subItemsHtmlType}
 var rootItemHtmlType = actRootItemHtmlType;
 this.setRootItemHtmlType = function(actRootItemHtmlType)
 {rootItemHtmlType = actRootItemHtmlType}
 this.getRootItemHtmlType = function(){return rootItemHtmlType}
 var callBackFun = actCallBackFun;
 this.setCallBackFun = function(actCallBackFun){callBackFun = actCallBackFun}
 this.getCallBackFun = function(){return callBackFun}

 
 function callBackFun(actPos)
 {
 	alert('callBackFun_' + actPos);
 }	
	
 function removeAllChilds(actRoot,actDeep)
 {
  var deep = actDeep;
  var root = actRoot;
  for(var i=0;i<=root.childNodes.length-1;i++)
  {
   var node = root.childNodes[i];
   var ddeep = deep + 1;
   removeAllChilds(node,ddeep);
   if((deep==0) && (node.nodeName=='#text'))
   {
    continue;
   }
   else
   {
    root.removeChild(node);
    i--;
   }
  }
 }

 this.putMenu=function()
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
 	var callBackFun = this.getCallBackFun();
  var root = document.getElementById(rootId);
  if((rootItemHtmlType != 'ul')&&(rootItemHtmlType != 'ol'))
   return;
  var ulNode = document.createElement(rootItemHtmlType);
  ulNode.setAttribute('class','root'); 
  var liNode = document.createElement('li');
  var spanNode = document.createElement('span');
  var newTextNode = document.createTextNode(eval(rootId + '_' + 'label'));
  spanNode.appendChild(newTextNode);
  spanNode.setAttribute('id', rootId + '_0');
  liNode.appendChild(spanNode);
  var navAppName = navigator.appName;
  if((navAppName=='Netscape')||(navAppName=='Opera'))
  {
   var mouseEvent = this.getMouseEvent();
   var thisTreeObj = this;
   spanNode.addEventListener(mouseEvent,
   function(event){thisTreeObj.trigMenu(event)},false);	
  }
  var ulNode2 = document.createElement(rootItemHtmlType);
  ulNode2.setAttribute('id', rootId + '_0' + '_' + rootItemHtmlType);
  itemClass = this.getItemClass();
  ulNode2.setAttribute('class',itemClass);
  liNode.appendChild(ulNode2);
  ulNode.appendChild(liNode);  
  root.appendChild(ulNode);
 }
 
 this.trigMenu=function(actEvent)
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
 	var subItemsHtmlType = this.getSubItemsHtmlType();
 	var mouseEvent = this.getMouseEvent();
 	var itemClass = this.getItemClass();
 	var callBackFun = this.getCallBackFun();
 	
  if(navigator.appName=='Netscape')
  {
   var pos=actEvent.currentTarget.id;
   actEvent.stopPropagation();
  }
  else
  {
   var pos = event.srcElement.id;
  } 
  try
  {
   if (pos.indexOf(rootId)>=0)
   {
   	var nPos = pos.substring(rootId.length+1,pos.length);
   	if(nPos != '')
   	{
     var vetOp = eval(rootId + '_' + 'labels'+ '_' + nPos);
     var vetOpGes = eval(rootId + '_' + 'urls' + '_' + nPos);
     var root = document.getElementById(pos + '_' + rootItemHtmlType);
     if(root.childNodes.length == 0)
     {
      for (var i=0;i<=vetOp.length-1;i++)
      {
       var newRootId = pos + '_' + i;
       var liNode = document.createElement('li');
       var newNode = document.createElement(subItemsHtmlType);
       if(subItemsHtmlType=='a')
       {
        newNode.setAttribute('href',vetOpGes[i]);
        newNode.setAttribute('target','_self');
       }
       var newTextNode = document.createTextNode(vetOp[i]);
       newNode.appendChild(newTextNode);
       newNode.setAttribute('id', newRootId);
       if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
       {
       	var thisTreeObj = this;
        newNode.addEventListener(mouseEvent,
        function(event){thisTreeObj.trigMenu(event)},false);
       }
       liNode.appendChild(newNode);
       var ulNode = document.createElement(rootItemHtmlType);
       ulNode.setAttribute('id', newRootId + '_' + rootItemHtmlType);
       ulNode.setAttribute('class',itemClass);
       liNode.appendChild(ulNode);        	
       root.appendChild(liNode);
      }
     }
     else
     {
      removeAllChilds(root,0);
     }
    }
   }
  }
  catch(excp)
  {
  	if(callBackFun !==undefined)
  	callBackFun(pos);
  }
 }  
  	
}

var treeCtrl = function(){

 var rootId;
 var mouseEvent;
 var itemClass;
 var rootItemHtmlType;
 var subItemsHtmlType;
 var callBackFun;
 var currentNode;
 var objName;
 var mainLabel;
 
 function removeAllChilds(actRoot,actDeep)
 {
  var deep = actDeep;
  var root = actRoot;
  for(var i=0;i<=root.childNodes.length-1;i++)
  {
   var node = root.childNodes[i];
   var ddeep = deep + 1;
   removeAllChilds(node,ddeep);
   if((deep==0) && (node.nodeName=='#text'))
   {
    continue;
   }
   else
   {
    root.removeChild(node);
    i--;
   }
  }
 }

return {
 "setRootId":function(actRootId)
 {
 	rootId = actRootId;
 }
 ,
 "getRootId":function()
 {
 	return rootId;
 }
 ,
 "setMouseEvent":function(actMouseEvent)
 {
 	mouseEvent = actMouseEvent;
 },
 "getMouseEvent":function()
 {
 	return mouseEvent;
 },
 "getRootItemHtmlType":function()
 {
 	return rootItemHtmlType;
 },
 "setRootItemHtmlType":function(actRootItemHtmlType)
 {
 	rootItemHtmlType = actRootItemHtmlType;
 },
 "getSubItemsHtmlType":function()
 {
 	return subItemsHtmlType;
 },
 "setSubItemsHtmlType":function(actSubItemsHtmlType)
 {
 	subItemsHtmlType = actSubItemsHtmlType;
 },
 "getItemClass":function()
 {
 	return itemClass;
 },
 "setItemClass":function(actItemClass)
 {
 	itemClass = actItemClass;
 },
 "setCallBackFun":function(actCallBackFun)
	{
	 callBackFun = actCallBackFun;
  },
 "getCallBackFun":function()
	{
	 return callBackFun;
  },  
 "setCurrentNode":function(actCurrentNode)
	{
	 currentNode = actCurrentNode;
  },
 "getCurrentNode":function()
	{
	 return currentNode;
  }, 
  "setObjName" : function(actObjName)
  {
  	objName = actObjName;
  },
  "getObjName":function()
  {
  	return objName;
  }
  ,
  "setMainLabel" : function(actMainLabel)
  {
  	mainLabel = actMainLabel;
  },
  "getMainLabel":function()
  {
  	return mainLabel;
  }
  , 
 "putMenu":function()
 {
/* 	var rootItemHtmlType = this.getRootItemHtmlType();
 	var rootId = this.getRootId();
	var mainLabel = this.getMainLabel();
  var root = document.getElementById(rootId);
  var newNode = document.createElement(rootItemHtmlType);
  if(rootItemHtmlType=='a')
  if (eval(rootId + '_' + 'par' + '_' + '0') == '#')
   newNode.setAttribute('href','#');
  else
   newNode.setAttribute('href',eval(rootId + '_' + 'par' + '_' + '0'));
  newNode.setAttribute('id', rootId + '_0');
  itemClass = this.getItemClass();
  newNode.setAttribute('class',itemClass); 
  var newTextNode = document.createTextNode(mainLabel);
  newNode.appendChild(newTextNode);
  var navAppName = navigator.appName;
  if((navAppName=='Netscape')||(navAppName=='Opera'))
  {
   mouseEvent = this.getMouseEvent();
   var objName = this.getObjName();
   newNode.addEventListener(mouseEvent,
   function(event){eval(objName + '.trigMenu(event)')},false);	
  }
  root.appendChild(newNode);
  var newSepNode = document.createElement('br');	
  root.appendChild(newSepNode);*/
	var rootId = this.getRootId();
	var mainLabel = this.getMainLabel();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var root = document.getElementById(rootId);
  //if((rootItemHtmlType != 'ul')&&(rootItemHtmlType != 'ol'))
  // return;
  var ulNode = document.createElement(rootItemHtmlType);
  ulNode.setAttribute('class','root'); 
  var liNode = document.createElement('li');
  var spanNode = document.createElement('span');
  var newTextNode = document.createTextNode(mainLabel);
  spanNode.appendChild(newTextNode);
  spanNode.setAttribute('id', rootId + '_0');
  liNode.appendChild(spanNode);
  var navAppName = navigator.appName;
  if((navAppName=='Netscape')||(navAppName=='Opera'))
  {
   var mouseEvent = this.getMouseEvent();
   var objName = this.getObjName();
   spanNode.addEventListener(mouseEvent,
   function(event){eval(objName + '.trigMenu(event)')},false);	
  }
  var ulNode2 = document.createElement(rootItemHtmlType);
  ulNode2.setAttribute('id', rootId + '_0' + '_' + rootItemHtmlType);
  itemClass = this.getItemClass();
  ulNode2.setAttribute('class',itemClass);
  liNode.appendChild(ulNode2);
  ulNode.appendChild(liNode);  
  root.appendChild(ulNode);
 },
 
 
 "trigMenu":function(actEvent)
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var subItemsHtmlType = this.getSubItemsHtmlType();
  var mouseEvent = this.getMouseEvent();
  var objName = this.getObjName();
  if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
  {
   var pos=actEvent.currentTarget.id;
   actEvent.stopPropagation();
  }
  else
  {
   var pos = event.srcElement.id;
  } 
  try
  {
   if (pos.indexOf(rootId)>=0)
   {
   	var nPos = pos.substring(rootId.length+1,pos.length);
   	if(nPos != '')
   	{
     var vetOp = eval(rootId + '_' + 'labels'+ '_' + nPos);
     var vetOpGes = eval(rootId + '_' + 'urls' + '_' + nPos);
     var root = document.getElementById(pos);
     if(root.hasChildNodes())
     {
      if(root.childNodes.length == 1)
      {
       for (var i=0;i<=vetOp.length-1;i++)
       {
        var newRootId = pos + '_' + i;
        var newNode = document.createElement(subItemsHtmlType);
        newNode.setAttribute('id',newRootId);
        if(subItemsHtmlType=='a')
        {
         newNode.setAttribute('href',vetOpGes[i]);
         newNode.setAttribute('target','_self');
        }
        newNode.setAttribute('class',itemClass);
        var newTextNode = document.createTextNode(vetOp[i]);
        var newSepNode = document.createElement('br');
        root.appendChild(newSepNode);
        newNode.appendChild(newTextNode);
        if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
        {
         newNode.addEventListener(mouseEvent,
         function(event){eval(objName + '.trigMenu(event)')},false);
        }
        root.appendChild(newNode);
        this.setCurrentNode(newNode);
       }
      }
      else
      {
       removeAllChilds(root,0);
      }
     }
    }
   }
  }
  catch(excp)
  {
  	callBackFun = this.getCallBackFun();
  	if(callBackFun !==undefined)
  	callBackFun(pos);
  }
 }
};
}();

var treeCtrl2 = function(){

 var rootId;
 var mouseEvent;
 var itemClass;
 var rootItemHtmlType;
 var subItemsHtmlType;
 var callBackFun;
 var currentNode;
 var objName;
 var mainLabel;
 
 function removeAllChilds(actRoot,actDeep)
 {
  var deep = actDeep;
  var root = actRoot;
  for(var i=0;i<=root.childNodes.length-1;i++)
  {
   var node = root.childNodes[i];
   var ddeep = deep + 1;
   removeAllChilds(node,ddeep);
   if((deep==0) && (node.nodeName=='#text'))
   {
    continue;
   }
   else
   {
    root.removeChild(node);
    i--;
   }
  }
 }

return {
 "setRootId":function(actRootId)
 {
 	rootId = actRootId;
 }
 ,
 "getRootId":function()
 {
 	return rootId;
 }
 ,
 "setMouseEvent":function(actMouseEvent)
 {
 	mouseEvent = actMouseEvent;
 },
 "getMouseEvent":function()
 {
 	return mouseEvent;
 },
 "getRootItemHtmlType":function()
 {
 	return rootItemHtmlType;
 },
 "setRootItemHtmlType":function(actRootItemHtmlType)
 {
 	rootItemHtmlType = actRootItemHtmlType;
 },
 "getSubItemsHtmlType":function()
 {
 	return subItemsHtmlType;
 },
 "setSubItemsHtmlType":function(actSubItemsHtmlType)
 {
 	subItemsHtmlType = actSubItemsHtmlType;
 },
 "getItemClass":function()
 {
 	return itemClass;
 },
 "setItemClass":function(actItemClass)
 {
 	itemClass = actItemClass;
 },
 "setCallBackFun":function(actCallBackFun)
	{
	 callBackFun = actCallBackFun;
  },
 "getCallBackFun":function()
	{
	 return callBackFun;
  }, 
 "currentNode":"", 
 "setCurrentNode":function(actCurrentNode)
	{
	 this.currentNode = actCurrentNode;
  },
 "getCurrentNode":function()
	{
	 return this.currentNode;
  }, 
  "setObjName" : function(actObjName)
  {
  	objName = actObjName;
  },
  "getObjName":function()
  {
  	return objName;
  }
  ,
  "setMainLabel" : function(actMainLabel)
  {
  	mainLabel = actMainLabel;
  },
  "getMainLabel":function()
  {
  	return mainLabel;
  }
  ,
 "putMenu":function()
 {
 	var rootId = this.getRootId();
	var mainLabel = this.getMainLabel();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var root = document.getElementById(rootId);
  if((rootItemHtmlType != 'ul')&&(rootItemHtmlType != 'ol'))
   return;
  var ulNode = document.createElement(rootItemHtmlType);
  ulNode.setAttribute('class','root'); 
  var liNode = document.createElement('li');
  var spanNode = document.createElement('span');
  var newTextNode = document.createTextNode(mainLabel);
  spanNode.appendChild(newTextNode);
  spanNode.setAttribute('id', rootId + '_0');
  liNode.appendChild(spanNode);
  var navAppName = navigator.appName;
  if((navAppName=='Netscape')||(navAppName=='Opera'))
  {
   var mouseEvent = this.getMouseEvent();
   var objName = this.getObjName();
   spanNode.addEventListener(mouseEvent,
   function(event){eval(objName + '.trigMenu(event)')},false);	
  }
  var ulNode2 = document.createElement(rootItemHtmlType);
  ulNode2.setAttribute('id', rootId + '_0' + '_' + rootItemHtmlType);
  itemClass = this.getItemClass();
  ulNode2.setAttribute('class',itemClass);
  liNode.appendChild(ulNode2);
  ulNode.appendChild(liNode);  
  root.appendChild(ulNode);
 },
 
 "trigMenu":function(actEvent)
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var subItemsHtmlType = this.getSubItemsHtmlType();
  var mouseEvent = this.getMouseEvent();
  var objName = this.getObjName();
  var itemClass = this.getItemClass();
  if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
  {
   var pos=actEvent.currentTarget.id;
   actEvent.stopPropagation();
  }
  else
  {
   var pos = event.srcElement.id;
  } 
  try
  {
   if (pos.indexOf(rootId)>=0)
   {
   	var nPos = pos.substring(rootId.length+1,pos.length);
   	if(nPos != '')
   	{
     var vetOp = eval(rootId + '_' + 'labels'+ '_' + nPos);
     var vetOpGes = eval(rootId + '_' + 'urls' + '_' + nPos);
     var root = document.getElementById(pos + '_' + rootItemHtmlType);
     if(root.childNodes.length == 0)
     {
      for (var i=0;i<=vetOp.length-1;i++)
      {
       var newRootId = pos + '_' + i;
       var liNode = document.createElement('li');
       var newNode = document.createElement(subItemsHtmlType);
       if(subItemsHtmlType=='a')
       {
        newNode.setAttribute('href',vetOpGes[i]);
        newNode.setAttribute('target','_self');
       }
       var newTextNode = document.createTextNode(vetOp[i]);
       newNode.appendChild(newTextNode);
       newNode.setAttribute('id', newRootId);
       if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
       {
        newNode.addEventListener(mouseEvent,
        function(event){eval(objName + '.trigMenu(event)')},false);
       }
       liNode.appendChild(newNode);
       var ulNode = document.createElement(rootItemHtmlType);
       ulNode.setAttribute('id', newRootId + '_' + rootItemHtmlType);
       ulNode.setAttribute('class',itemClass);
       liNode.appendChild(ulNode);        	
       root.appendChild(liNode);
       this.setCurrentNode(newNode);
      }
     }
     else
     {
      removeAllChilds(root,0);
     }
    }
   }
  }
  catch(excp)
  {
 // 	alert(pos);
  	var callBackFun = this.getCallBackFun();
  	if(callBackFun !==undefined)
  	callBackFun(pos);
  }
 }
};
}();

