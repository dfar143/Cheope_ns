var ajaxHandler = function(){
	
 var opContainer=null;
 	
 function initRequest(url) 
 {
  if (window.XMLHttpRequest) 
  {
   return new XMLHttpRequest();
  } 
  else if (window.ActiveXObject) 
  {
   return new ActiveXObject("Microsoft.XMLHTTP");
  }
  else
  	return false;
 }
 
 function getOpByName(actOp)
 {
 	for(var i=0;i<=opContainer.length-1;i++)
 	 if(opContainer[i].name==actOp)
 	  return opContainer[i];
 }
 
 function execOp(actOp,actMsg)
 {
 	var op = getOpByName(actOp);
 	op.exec(actMsg);
 }

 return {
 "getOpByName":function(actOp){return getOpByName(actOp);},
 "setOpContainer":function(actOpContainer){opContainer=actOpContainer;},
 "getOpContainer":function(){return opContainer;},
 "addOp":function(actOpFun){if(typeof actOpFun == 'object')opContainer[opContainer.length]=actOpFun;
 	else alert(loc.getMsg('msg',0));},
 "serverCall":function(actPage,actOp,actId,actType) 
 {
	var urlst = actPage;
	if (actOp != null)
	  urlst = urlst + '?' + actOp + '=' + actId; 
  var req = initRequest(urlst);
  if(req)
  {
   req.onreadystatechange = function() 
   {
    if (req.readyState == 4) 
    {
     if (req.status == 200) 
     {
     	alert(req.responseText);
      execOp(actOp,((actType.toLowerCase()=="text")||(actType=""))?req.responseText:req.responseXML);
     } 
     else 
     {
      alert(loc.getString('msg',1) + req.status);
     }
    }
   };
   req.open("GET", urlst, true);
   req.send(null);
   return true;
  }
  else
  	return false;
 },
 
 // Syncronized Server call
 "synServerCall":function(actPage,actOp,actId,actType) 
 {
 	var flag=true;
	var urlst = actPage;
	if (actOp != null)
	  urlst = urlst + '?' + actOp + '=' + escape(actId);
  var req = initRequest(urlst);
  if(req)
  {
   req.onreadystatechange = function() 
   {
    if ((req.readyState == 4)&&(flag)) 
    {
     if (req.status == 200) 
     {  
      alert(req.responseText);
      flag=false;
     	execOp(actOp,((actType.toLowerCase()=="text")||(actType==""))?req.responseText:req.responseXML);
     }      
     else 
     {   
     	alert(loc.getString('msg',1) + req.status);
     }
    }
   };
   // 'false' non funziona su firefox
   req.open("GET", urlst, false);
   req.send(null);
   if((navigator.appName=='Netscape')&&(flag))
   {
    if (req.readyState == 4) 
    {
     if (req.status == 200) 
     {
      flag=false;
      alert(req.responseText);
      execOp(actOp,((actType.toLowerCase()=="text")||(actType==""))?req.responseText:req.responseXML);
     } 
     else 
     {
      alert(loc.getString('msg',1) + req.status);
     }
    }  
   }
   return true;
  }
  else
  	return false;
 },
 "synServerPostCall":function(actPage,actOp,actId,actPostData,actType)
 {
 	var flag=true;
	var urlst = actPage;
	if (actOp != null)
	  urlst = urlst + '?' + actOp + '=' + actId; 
  var req = initRequest(urlst);
  if(req)
  {
   req.onreadystatechange = function() 
   {
    if ((req.readyState == 4)&&(flag)) 
    {
     if (req.status == 200) 
     {  
      alert(req.responseText);
      flag=false;
     	execOp(actOp,((actType.toLowerCase()=="text")||(actType==""))?req.responseText:req.responseXML);
     }      
     else 
     {   
     	alert(loc.getMsg('msg',1) + + req.status);
     }
    }
   };
   // 'false' non funziona su firefox
   req.open("POST", urlst, false);
   req.setRequestHeader("content-type", "application/x-www-form-urlencoded");
   req.send(actPostData);
   if((navigator.appName=='Netscape')&&(flag))
   {
    if (req.readyState == 4) 
    {
     if (req.status == 200) 
     {
     	alert('aaa2');
     	alert(req.responseText);
     	alert('aaa2');
     	flag=false;
      execOp(actOp,((actType.toLowerCase()=="text")||(actType==""))?req.responseText:req.responseXML);
     } 
     else 
     {
      alert(loc.getString('msg',1) + req.status);
     }
    }  
   }
   return true;
  }
  else
  	return false;
 },
 "serverPostCall":function(actPage,actOp,actId,actPostData,actType)
 {
	var urlst = actPage;
	if ((actOp != null)&&(actOp!=''))
	  urlst = urlst + '?' + actOp + '=' + actId;
	alert(urlst);  
  var req = initRequest(urlst);
  if(req)
  {
   req.onreadystatechange = function() 
   {
   	if (req.readyState == 4) 
    {
     if (req.status == 200) 
     {
      alert(req.responseText);
      execOp(actOp,((actType.toLowerCase()=="text")||(actType==""))?req.responseText:req.responseXML);
     } 
     else 
     {
      alert(loc.getString('msg',1) + req.status);
     }
    }
   };
   req.open("POST", urlst,true);
   req.setRequestHeader("content-type", "application/x-www-form-urlencoded");
   req.send(actPostData);
   return true;
  }
  else
  	return false;
 }
};
}();

