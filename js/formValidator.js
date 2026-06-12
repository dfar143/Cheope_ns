function FormValidator()
{

var dataFields=null;
this.getDataFields = function(){return dataFields;};
this.setDataFields = function(actDataFields){dataFields = actDataFields;};

var dataFieldsTypes=null;
this.getDataFieldsTypes = function(){return dataFieldsTypes;};
this.setDataFieldsTypes = function(actDataFieldsTypes){dataFieldsTypes = actDataFieldsTypes;};

var mandatoryDataFields=null;
this.getMandatoryDataFields=function(){return mandatoryDataFields;};
this.setMandatoryDataFields=function(actMandatoryDataFields){mandatoryDataFields=actMandatoryDataFields};

var stringDataFieldsRegexps=null;
this.getStringDataFieldsRegexps = function(){ return stringDataFieldsRegexps;};
this.setStringDataFieldsRegexps = function(actStringDataFieldsRegexps){stringDataFieldsRegexps=actStringDataFieldsRegexps};

function adjust(actFieldName)
{
	var items = actFieldName.split("_");
	var newName = "";
	if(items.length>0)
	 newName=items[0];
	else
	 return actFieldName; 
	for(var i=1;i<=items.length-1;i++)
	{
	  newName = newName + ' ' + items[i];
	}
	return newName;
}

function getDataFieldTypeByName(actName)
{
 if(dataFieldsTypes != null)
 {
  var i=0;
  var num1 = dataFields.length;
  while(i <= num1-1)
  {
   if(dataFields[i]==actName)
	  return dataFieldsTypes[i];
	 i++;
  }
 }
 else
 	return "";
}

function testIntegerFormat(actData)
{
 var regExp = /^(-)?[0-9]+$/;
 var res = actData.match(regExp);
 if (res==null)
  return false;
 else
  return true;
}

function testFloatFormat(actData)
{
 var regExp = /^(-)?(([0-9])+)(\.([0-9]{1,2}))?$/;
 var res = actData.match(regExp);
 if (res==null)
  return false;
 else
  return true;
}

function testIpFormat(actData)
{
 if(actData == null)
  return true;

 var regExp = /^((([1|2])?([0-9])?[0-9])\.){1,3}(([1|2])?([0-9])?[0-9])?$/;
 var res = actData.match(regExp);
 if (res==null)
  return false;
	
 var items = actData.split("."); 
 
 var classa = items[0];
 if((items[1] !== undefined)&&(items[1] != ""))
  var classb = items[1];
 else
  var classb=0;
 if ((items[2] !== undefined)&&(items[2] != ""))
  var classc = items[2];
 else
  var classc=0;
 if ((items[3] !== undefined)&&(items[3] != ""))
  var classd = items[3];
 else
  var classd=0;
	
  if((classa>=0)&&(classa<=255))
   if((classb>=0)&&(classb<=255))
	  if((classc>=0)&&(classc<=255))
	   if((classd>=0)&&(classd<=255))
		  return true;

  return false;
}

function testDataFormat(actData)
{
 var regExp = /^([0|1|2|3]?[0-9])\/([0|1]?[0-9])\/([1|2][0|9][0-9][0-9])$/;
 var res = actData.match(regExp);
 if (res==null)
  return false

 var items = actData.split("/",3); 	
 var day = parseInt(items[0],10);
 var month = parseInt(items[1],10);
 var year = parseInt(items[2],10);
 
 var monthEval = false;
 switch(month)
 {
  case 1:
	  if((day>=1)&&(day<=31))
		 monthEval = true;
		break;
	case 2:
	 if((day>=1)&&(day<=28))	 
	   monthEval = true;
   break;
  case 3:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break;
  case 4:
	 if((day>=1)&&(day<=30))	 
	   monthEval = true;
   break;	
  case 5:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break;	
  case 6:
	 if((day>=1)&&(day<=30))	 
	   monthEval = true;
   break;
  case 7:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break;
  case 8:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break; 
  case 9:
	 if((day>=1)&&(day<=30))	 
	   monthEval = true;
   break;
  case 10:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break;  
  case 11:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break; 
  case 12:
	 if((day>=1)&&(day<=31))	 
	   monthEval = true;
   break;  
  default:
    return false;
 }	
 
 if ((year>=1900)&&(year<=2050)&& monthEval)
  return true;
 else
  return false;	
}

function testStringFormat(actData)
{
	if ((actData.indexOf('?') != -1)||(actData.indexOf('=') != -1)
	||(actData.indexOf('&') != -1))
	 return false;
	else
	 return true;
}

function testRegexp(actData,actRegexp)
{
	var regexp = new RegExp('^' + actRegexp + '$',"g");
	return regexp.test(actData);
}


// Funzione di validazione da richiamare on submit.
// Controlla solo il riempimento dei campi obbligatori;
this.evalForm = function(actForm)
{
 var i=0;
 var mandatoryDataFields = this.getMandatoryDataFields();
 var numMandatoryDataFields = mandatoryDataFields.length;
 var dataFields = this.getDataFields();
 if(numMandatoryDataFields>0)
 {
  var num = numMandatoryDataFields;
  while(i <= num - 1)
  {
   var fieldName = mandatoryDataFields[i];
   if(actForm[fieldName] !== undefined)
   {
    var value = actForm[fieldName].value;
    var disabled = actForm[fieldName].disabled;  
	 }
	 else
	 	disabled=true;
	
	 var len = $('input[name=' + fieldName + ']:radio').length;

	 if(! disabled)
	 if(len>0)
	 {
	 	var checkedFlag=false;
    $('input[name=' + fieldName + ']:radio').each(
    function(actInd){if($(this).get(0).checked)checkedFlag=true;}
    );    
    if(! checkedFlag)
    { 
     if(loc!==undefined)   
	    alert(loc.getString('msg',2) + ' ' + adjust(fieldName) + loc.getString('msg',3));
	   else
	   	alert('Il campo' + ' ' + adjust(fieldName) + ' \xE8 obbligatorio.');
	   //actForm[fieldName].focus(); 
 	   return false;
 	  }
	 }
	 else if (value == '')
	 {
     if(loc!==undefined)   
	    alert(loc.getString('msg',2) + ' ' + adjust(fieldName) + loc.getString('msg',3));
	   else
	   	alert('Il campo' + ' ' + adjust(fieldName) + ' \xE8 obbligatorio.');
	  actForm[fieldName].focus(); 
 	  return false;
	 }	
	 i++;
  }
 }
 return true;
}

//
// Controlla che i campi data siano nel formato giusto.
// Funzione da richiamare su onchange del singolo campo.
//
this.evalField=function(actField)
{
 var fieldValue = actField.value;
 var fieldName = actField.name;
 var stringDataFieldsRegexps = this.getStringDataFieldsRegexps();

  if((stringDataFieldsRegexps!=null)&&(stringDataFieldsRegexps[actField.name]!==undefined))
  {
 	 if(! testRegexp(actField.value,stringDataFieldsRegexps[actField.name]))
   {
   	if(loc!==undefined)
   	 alert(loc.getString('msg',4));
   	else
   	 alert("Formato non valido.");
   	return false;
   }
  }
  else
  {
   var type = getDataFieldTypeByName(fieldName); 
   if (type=="Date")
   {
    if (! testDataFormat(fieldValue))
	  {
   	if(loc!==undefined)
   	 alert(loc.getString('msg',5));
   	else
   	 alert("Formato data non valido.");
     return false;
	  }
   }
   else if(type=="String")
   {
 	  if (! testStringFormat(fieldValue))
 	  {
   	if(loc!==undefined)
   	 alert(loc.getString('msg',4));
   	else
   	 alert("Formato non valido.");
 		 return false;
 	  }
   }
   else if(type=="Integer")
   {
    if (! testIntegerFormat(fieldValue))
	  {
   	if(loc!==undefined)
   	 alert(loc.getString('msg',6));
   	else
   	 alert("Formato campo numerico non valido.");
	   return false;
	  }
   }
   else if(type=="Float")
   { 
	  if (! testFloatFormat(fieldValue))
	  {
   	if(loc!==undefined)
   	 alert(loc.getString('msg',6));
   	else
   	 alert("Formato campo numerico non valido.");
	   return false;
	  }  
   } 
   else if(type=="")
   {
 	  return true;
   }
  }
 return true;
}

}
