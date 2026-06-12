//
// La versione forestCtrlX <X> indica il tipo di forest che può essere 
// di tipo strutturato con html ul o ol , oppure semplice (figli di html p) 
//

var forestCtrl = function(){

 var rootId;
 var mouseEvent;
 var itemClass;
 var rootItemHtmlType;
 var subItemsHtmlType;
 var callBackFun;
 var currentNode;
 var objName;
 
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
  },   
 "putMenu":function()
 {
 	var rootItemHtmlType = this.getRootItemHtmlType();
 	var rootId = this.getRootId();
  var mouseEvent = this.getMouseEvent();
  var objName = this.getObjName();
  var root = document.getElementById(rootId);
  for(var i=0;i<=eval(rootId + '_' + 'nVet') - 1;i++)
  {
   var newNode = document.createElement(rootItemHtmlType);
   if(rootItemHtmlType=='a')
   if (eval(rootId + '_' + 'par' + '_' + i) == '#')
    newNode.setAttribute('href','#');
   else
    newNode.setAttribute('href',eval(rootId + '_' + 'par' + '_' + i));
   newNode.setAttribute('id', rootId + '_' + i);
   itemClass = this.getItemClass();
   newNode.setAttribute('class',itemClass); 
   var newTextNode = document.createTextNode(eval(rootId + '_' + 'label' + '_' + i));
   newNode.appendChild(newTextNode);
   var navAppName = navigator.appName;
   if((navAppName=='Netscape')||(navAppName=='Opera'))
   {
    newNode.addEventListener(mouseEvent,
   function(event){eval(objName + '.trigMenu(event)')},false);	
   }
   root.appendChild(newNode);
   var newSepNode = document.createElement('br');	
   root.appendChild(newSepNode);
  }
 },
 
 
 "trigMenu":function(actEvent)
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var subItemsHtmlType = this.getSubItemsHtmlType();
  var mouseEvent = this.getMouseEvent();
  var objName = this.getObjName();
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


var forestCtrl2 = function(){

 var rootId;
 var mouseEvent;
 var itemClass;
 var rootItemHtmlType;
 var subItemsHtmlType;
 var callBackFun;
 var currentNode;
 var objName;
 var openImg;
 var closeImg;
 var imgDir;
 
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
  },
  "openImg":"",
 "setOpenImg" : function(actOpenImg)
  {
  	openImg = actOpenImg;
  },
 "getOpenImg" : function()
  {
  	return openImg;
  },
 "setCloseImg" : function(actCloseImg)
  {
  	closeImg = actCloseImg;
  },
 "getCloseImg" : function()
  {
  	return closeImg;
  },
 "setImgDir" : function(actImgDir)
  {
  	imgDir = actImgDir;
  },
 "getImgDir" : function()
  {
  	return imgDir;
  },
  "isLeaf" : function(actId)
 {
 	var rootId = this.getRootId();
  var nPos = actId.substring(rootId.length+1,actId.length);
  try
  {
   var vetOp = eval(rootId + '_' + 'labels'+ '_' + nPos);
   return false;
  }
  catch(excp)
  {
  	return true;
  }
 },
 "putMenu":function()
 {
 	var rootItemHtmlType = this.getRootItemHtmlType();
 	var subItemsHtmlType = this.getSubItemsHtmlType();
 	var rootId = this.getRootId();
  var mouseEvent = this.getMouseEvent();
  var objName = this.getObjName();
  var openImg = this.getOpenImg();
  var closeImg = this.getCloseImg();
  var imgDir = this.getImgDir();
  var root = document.getElementById(rootId);
  var lNode = document.createElement(rootItemHtmlType);
  lNode.setAttribute("id",rootId + '_' + rootItemHtmlType);
  lNode.setAttribute("class",'root');
  for(var i=0;i<=eval(rootId + '_' + 'nVet') - 1;i++)
  {
   var newLiNode = document.createElement('li');
   var newLNode = document.createElement(rootItemHtmlType);
   var newNode = document.createElement(subItemsHtmlType);
   if(subItemsHtmlType=='a')
   if (eval(rootId + '_' + 'par' + '_' + i) == '#')
    newNode.setAttribute('href','#');
   else
    newNode.setAttribute('href',eval(rootId + '_' + 'par' + '_' + i));
   newNode.setAttribute('id', rootId + '_' + i + '_' + 'label');
   newLNode.setAttribute('id', rootId + '_' + i + '_' + rootItemHtmlType);
   newLNode.setAttribute('class',itemClass); 
   var newTextNode = document.createTextNode(eval(rootId + '_' + 'label' + '_' + i));
   newNode.appendChild(newTextNode);
   var newImgNode = document.createElement('img');
   newImgNode.setAttribute('src',imgDir + '/' + openImg);
   newImgNode.setAttribute('id',rootId + '_' + i);
   var navAppName = navigator.appName;
   if((navAppName=='Netscape')||(navAppName=='Opera'))
   {
    newImgNode.addEventListener(mouseEvent,
   function(event){eval(objName + '.trigMenu(event)')},false);	
   }
   newLiNode.appendChild(newImgNode);
   newLiNode.appendChild(newNode);
   newLiNode.appendChild(newLNode);
   lNode.appendChild(newLiNode);
  }
  root.appendChild(lNode);
 },
 
 
 "trigMenu":function(actEvent)
 {
 	var rootId = this.getRootId();
 	var rootItemHtmlType = this.getRootItemHtmlType();
  var subItemsHtmlType = this.getSubItemsHtmlType();
  var mouseEvent = this.getMouseEvent();
  var itemClass = this.getItemClass();  
  var objName = this.getObjName();
  var openImg = this.getOpenImg();
  var closeImg = this.getCloseImg();
  var imgDir = this.getImgDir();
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
     var rootImg = document.getElementById(pos);
     var rootImgSrcAttr = rootImg.getAttribute('src');
     if(root.childNodes.length == 0)
     {
     	if(rootImgSrcAttr == imgDir + '/' + openImg)
     	 rootImg.setAttribute('src',imgDir + '/' + closeImg);
     	else
     	 rootImg.setAttribute('src',imgDir + '/' + openImg);
      for (var i=0;i<=vetOp.length-1;i++)
      {
       var newRootId = pos + '_' + i;
       var newLiNode = document.createElement('li');
       var newNode = document.createElement(subItemsHtmlType);
       newNode.setAttribute('id',newRootId + '_' + 'label');
       if(subItemsHtmlType=='a')
       {
        newNode.setAttribute('href',vetOpGes[i]);
        newNode.setAttribute('target','_self');
       }
       newNode.setAttribute('class',itemClass);
       var newTextNode = document.createTextNode(vetOp[i]);
       newNode.appendChild(newTextNode);
       if(! this.isLeaf(newRootId))
       {
        var newImgNode = document.createElement('img');
        newImgNode.setAttribute('src',imgDir + '/' + openImg);
        newImgNode.setAttribute('id',newRootId);
        if((navigator.appName=='Netscape') ||(navigator.appName=='Opera'))
        {
         newImgNode.addEventListener(mouseEvent,
         function(event){eval(objName + '.trigMenu(event)')},false);
        }
        newLiNode.appendChild(newImgNode);
       }
       newLiNode.appendChild(newNode);
       var newLNode = document.createElement(rootItemHtmlType);
       newLNode.setAttribute('id', newRootId + '_' + rootItemHtmlType);
       newLNode.setAttribute('class',itemClass);
       newLiNode.appendChild(newLNode);        	
       root.appendChild(newLiNode);
       this.setCurrentNode(newNode);
      }
     }
     else
     {
     	if(rootImgSrcAttr == imgDir + '/' + openImg)
     	 rootImg.setAttribute('src',imgDir + '/' + closeImg);
     	else
     	 rootImg.setAttribute('src',imgDir + '/' + openImg);
      removeAllChilds(root,0);
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

