var ajaxHandler = function(){
	
 var opContainer=null;
 var encodedQueryStr=false;
 var pattern="";
 
 function getOpByName(actOp)
 {
 	for(var i=0;i<=opContainer.length-1;i++)
 	 if(opContainer[i].name==actOp)
 	  return opContainer[i];
 	return false;
 }
 
 function execOp(actOp,actMsg)
 {
 	var op = getOpByName(actOp);
 	op.exec(actMsg);
 }

 return {
 "getPattern":function(){return pattern;},
 "setPattern":function(actPattern){pattern = actPattern;},	 
 "getEncodeQueryStr":function(){return encodedQueryStr;},
 "setEncodeQueryStr":function(actQueryStr){encodedQueryStr = actQueryStr;},
 "getOpByName":function(actOp){return getOpByName(actOp);},
 "setOpContainer":function(actOpContainer){opContainer=actOpContainer;},
 "getOpContainer":function(){return opContainer;},
 "addOp":function(actOpFun){if(typeof actOpFun == 'object')opContainer[opContainer.length]=actOpFun;
 	else alert(loc.getMsg('msg',0));},
 "serverCall":function(actPage,actOp,actId,actType,actPattern) 
 {
	var parStr = actOp + '=' + actId;
	urlst = "./" + actPage;
	$.get(urlst,parStr,function(actObjData,actStatus,actJqObj1)
	{
	 //var pattern = /(.)*array(.)*/;
	 var pattern = actPattern;
	 var result = actJqObj1.responseText.match(pattern);
	 console.log(pattern);
	 console.log(actJqObj1.responseText);
	 console.log(actOp);
	 console.log(result);
	 if(((result==null)||(result[0] == ''))&&(actJqObj1.responseText != ''))
	  alert(actJqObj1.responseText);
	 execOp(actOp,actObjData);return true;},actType).fail(function(actJqObj)
	{alert('Http status:' + actJqObj.status + ' - ' + 'Response:' + actJqObj.responseText);return true;});
 },
 
 // Syncronized Server call
 "synServerCall":function(actPage,actOp,actId,actType,actPattern) 
 {
	var urlst = "./" + actPage;
	var parStr = actOp + '=' + actId;
	$.ajax({url:urlst,data:parStr,
		success:function(actObjData,actStatus,actJqObj1)
  {
	 //var pattern = /[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*array[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\s\w\/ A-Za-z0-9]*/;
	 var pattern = actPattern;
	 var result = actJqObj1.responseText.match(pattern);
	 console.log(pattern);
	 console.log(actJqObj1.responseText);
	 console.log(actOp);
	 console.log(result);
	 if(((result==null)||(result[0] == ''))&&(actJqObj1.responseText != ''))
	  alert(actJqObj1.responseText);
   //alert(actOp);
   execOp(actOp,actObjData);
   return true;},
   dataType:actType,async:false}).fail(function(actJqObj)
	{alert('Http status:' + actJqObj.status + ' - ' + 'Response:' + actJqObj.responseText);return true;});
 },
 "synServerPostCall":function(actPage,actOp,actId,actPostData,actType,actPattern)
 {
 	var flag=true;
	var urlst = "./" + actPage + "?" + actOp + '=' + actId;
  $.ajax({type:"POST",url:urlst,data:actPostData,success:function(actObjData,actStatus,actJqObj1)
  {
	  var pattern = actPattern;
	 //var pattern = /[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\/ A-Za-z0-9]*array[\.%&\*!':,"\?\-_><\[\]#@\(\)\$\/ A-Za-z0-9]*/;
	 var result = actJqObj1.responseText.match(pattern);
	 console.log(pattern);
	 console.log(actJqObj1.responseText);
	 console.log(actOp);
	 console.log(result);
	 if(((result==null)||(result[0] == ''))&&(actJqObj1.responseText != ''))
	  alert(actJqObj1.responseText);
  execOp(actOp,actObjData);return true;},dataType:actType,async:false}).fail(function(actJqObj,actStatus,actJqObj1)
	{alert('Http status:' + actJqObj.status + ' - ' + 'Response:' + actJqObj.responseText);actOp.result=false;return true;});
 },
 "serverPostCall":function(actPage,actOp,actId,actPostData,actType,actPattern)
 {
	var urlst = "./" + actPage + "?" + actOp + '=' + actId;
	$.post(urlst,actPostData,function(actObjData,actStatus,actJqObj1)
	{
	 //var pattern = /(.)*array(.)*/;
	 var pattern = actPattern;
	 var result = actJqObj1.responseText.match(pattern);
	 console.log(pattern);
	 console.log(actJqObj1.responseText);
	 console.log(actOp);
	 console.log(result);
	 if(((result==null)||(result[0] == ''))&&(actJqObj1.responseText != ''))
	  alert(actJqObj1.responseText);
	 execOp(actOp,actObjData);return true;},actType).fail(function(actJqObj)
	{alert('Http status:' + actJqObj.status + ' - ' + 'Response:' + actJqObj.responseText);return true;});
 }
};
}();

