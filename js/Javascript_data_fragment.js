function Javascript_data_fragment(actOp,actNum)
{
	this.setOp(actOp);
	this.setNum(actNum);
	this.setType("Javascript_data_fragment");	

  this.addSlashToFieldValue = true;
  this.setAddSlashToFieldValue = function(actAddSlash)
  {
  	this.addSlashToFieldValue = actAddSlash;
  } 
  
  this.getAddSlashToFieldValue = function()
  {
  	return this.addSlashToFieldValue;
  }   

	this.inheritData = true;
	this.setInheritData = function(actInheritData)
	{
		this.inheritData = actInheritData;
	}
	this.getInheritData = function()
	{
		return this.inheritData;
	}
	
	this.javascriptFragment = "";
	this.setJavascriptFragment = function(actJavascriptFragment)
	{
		this.javascriptFragment = actJavascriptFragment;
	};
	this.getJavascriptFragment = function()
	{
		return this.javascriptFragment;
	}
	
	this.putData=function()
	{
		var htmlWriter = this.getHtmlWriter();
//
// Come dataSource canonico vuole un array associativo ossia una funzione o un oggetto.
//
		var rows = this.getDataSource();
		var dataFields = this.getDataFields();
		var javascriptFragment = this.getJavascriptFragment();
		var row;

	 if(rows !== undefined)
	 {
	 	if(! ((typeof rows == 'object')||(typeof rows == 'function')))
	 	{
	 		row = new Array();
	 		row[0] = rows;
	  }
	  else
	   row=rows;
	 }
	 else
	 	row = new Array();
					
		var fieldValue;
		var fieldValues;
		
		for(var i=0;i<=dataFields.length-1;i++)
		{
			var field = dataFields[i];

			if(row[field] !== undefined)
			{
			 fieldValue = row[field];
			}
			else
			{
			  fieldValue = "";
			}
			
			fieldValues = this.getDataFieldsAllValues(field,fieldValue);		
			fieldValue = fieldValues;
			
			var domain = this.getDataFieldDomainByName(field);

      if(domain == Int_domain.FIELD_DOMAIN_OBJECT)			
			{
		   if(this.getInheritData())
		    fieldValue.setDataSource(row);
		   var num = fieldValue.getNum();
       fieldValue.setNum(num + "_" + actNum);
			 fieldValue.setEnableSendData(false);
		   fieldValue.putData();
		   javascriptFragment.replace("#" + field.toUpperCase() + "#",fieldValue.dump());		
			}
			else 
			if(domain == Int_domain.FIELD_DOMAIN_VAR)
		  {
		   eval("var " + field + " = fieldValue;");
			}
			else
		  {
		  	if(util.is_array(fieldValue))
		  	{
		  		var arrayDataStr = "Array(";
		  		for(var j=0;j<=fieldValue.length-1;j++)
		  		{
		  			var val = fieldValue[j];
		  			if(typeof val=="string")
		  			 arrayDataStr += "'" + val + "'";
		  			else
		  				if(typeof val=="number")
		  				 arrayDataStr += val;
		  		    else
		  		     alert("Errore nel valore dell' array.");
		  		     
		  		  if(j < fieldValue.length-1)
		  		   arrayDataStr += ",";
		  		}
		  		arrayDataStr += ")";
		  		var pattern = new RegExp("#" + field.toUpperCase() + "#","g");
		  		javascriptFragment=javascriptFragment.replace(pattern,arrayDataStr);
		  	}
		  	else
		  	{
		  	 var pattern = new RegExp("#" + field.toUpperCase() + "#","g");
		  	 if(this.getAddSlashToFieldValue() && (typeof fieldValue == "string"))
		  	  javascriptFragment=javascriptFragment.replace(pattern,
		  	  fieldValue.replace(/\\/g,'\\\\').replace(/'/g,'\\\'').replace(/"/g,'\"'));
		  	 else
          javascriptFragment=javascriptFragment.replace(pattern,
		  	  fieldValue);		  	 	
		  	}
		  }
		}
		eval(javascriptFragment);
	  var enableSendData = this.getEnableSendData();
	  if(enableSendData)
	  {
	   var hookId = this.getHookId();
	   if(hookId != '')
	   {
	    var domContainerItem = document.getElementById(hookId);
	    if(domContainerItem != null)
	     domContainerItem.innerHTML = htmlWriter.sendData();
		}
	  }
	}
}

Javascript_data_fragment.prototype = new Html_data_interface('','','');