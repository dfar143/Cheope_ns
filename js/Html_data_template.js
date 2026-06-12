function Html_data_template(actOp,actNum)
{
	this.setOp(actOp);
	this.setNum(actNum);
	this.setType("Html_data_template");
	this.inheritData = true;
	this.setInheritData = function(actInheritData)
	{
		this.inheritData = actInheritData;
	}
	this.getInheritData = function()
	{
		return this.inheritData;
	}
	this.inheritDataFieldName = false;
	this.setInheritDataFieldName = function(actInheritDataFieldName)
	{
		this.inheritDataFieldName = actInheritDataFieldName;
	}
	this.getInheritDataFieldName = function()
	{
		return this.inheritDataFieldName;
	}
	this.htmlTemplate = "";
	this.setHtmlTemplate = function(actHtmlTemplate)
	{
		this.htmlTemplate = actHtmlTemplate;
	}
	this.getHtmlTemplate = function()
	{
		return this.htmlTemplate;
	}
	this.execOnlyOnFullDataSource = true;
	this.setExecOnlyOnFullDataSource= function(actExec)
	{
	 this.execOnlyOnFullDataSource = actExec;
	}
	this.getExecOnlyOnFullDataSource=function()
	{
	 return this.execOnlyOnFullDataSource;
	}	
	this.elabFields=function(actRow,actNum)
	{
		var dataFields = this.getDataFields();
		var num = this.getNum();
		var htmlTemplate = this.getHtmlTemplate();
		var fieldValue;
		var fieldValues;
    
		for(var i=0;i<=dataFields.length-1;i++)
		{
			var field = dataFields[i];
			if(actRow[field] !== undefined)
			{
			 fieldValue = actRow[field];
			}
			else
			{
				if(actRow !== undefined)
				 fieldValue = actRow;
				else
			   fieldValue = "";
			}

			fieldValues = this.getDataFieldsAllValues(field,fieldValue);
			
			if(util.is_array(fieldValues)&&(! util.is_array_of_array(fieldValues)))
			{
			 fieldValue = fieldValues[0];
			}
			else if(util.is_array_of_array(fieldValues))
			{
			 fieldValue = fieldValues.toString();	
			}
			else
		  {
			 fieldValue = fieldValues;
			}
	
			var domain = this.getDataFieldDomainByName(field);

			if(domain == Int_domain.FIELD_DOMAIN_OBJ)
			{
			 if(this.getInheritData())
			 {
			 	actRow["Count"] = actNum;
			  fieldValue.setDataSource(actRow) ;
			 }
			 if(this.getInheritDataFieldName())
			  fieldValue.setNum(num + "_" + actNum + "_" + field);
			 fieldValue.setEnableSendData(false);
			 fieldValue.putData();
			 var pattern = new RegExp("{" + field.toUpperCase() + "}","g");
			 htmlTemplate=htmlTemplate.replace(pattern,fieldValue.flush());
       htmlTemplate=htmlTemplate.replace(/\{COUNT\}/g,actNum);
			}
			else
		  {
		  	var pattern = new RegExp("{" + field.toUpperCase() + "}","g");
				htmlTemplate = htmlTemplate.replace(pattern,
				fieldValue);				 
        htmlTemplate=htmlTemplate.replace(/\{COUNT\}/g,actNum);
			}
		}
		return htmlTemplate;
	}
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
//
// Come dataSource vuole un array di array
//
	 var rows = this.getDataSource();
	 var dataSource = util.clone(rows);
	 var htmlTemplate = this.getHtmlTemplate();
	 var cssClass = this.getCssClass();
	 var intCode = this.getInterfaceId('');

	 if(rows !== undefined)
	 {
	 	if(! util.is_array(rows))
	 	{
	 		rowVal = new Array(rows);
	 		rows = new Array();
	 		rows[0] = rowVal;
	  }
	  else if(! util.is_array_of_array(rows))
	  {
	  	rows = new Array(rows);
	  }
	 }
	 else
	 	rows = new Array([]);

	 var htmlTemplateInstance='';
	 var execOnly = this.getExecOnlyOnFullDataSource();

//
// Serve ad evitare l'esecuzione quando il dataSource è vuoto;
//
	 	 
	 if((util.count(dataSource)>0)||((util.count(dataSource)==0) && (! execOnly)))
	 if(rows.length > 0)
	 {
	 	var j=0;
	 	for(var prop in rows)
	 	{
	 		var rowVal = rows[prop];
	 		var htmlTemplate = this.elabFields(rowVal,j);
	 		if(j==0)
	 		 htmlTemplateInstance = htmlTemplate;
	 		else
	 		 htmlTemplateInstance += "\n" + htmlTemplate;
	 		j++;
	 	}
	 }
	 else 
	 	htmlTemplateInstance = this.elabFields(rows,0);
	
	 htmlWriter.putGenericHtmlString(htmlTemplateInstance);
	 var enableSendData = this.getEnableSendData();
	 if(enableSendData)
	 {
	  var hookId = this.getHookId();
	  var domContainerItem = document.getElementById(hookId);
	  domContainerItem.innerHTML = htmlWriter.sendData();
	 }
	}
	
}

Html_data_template.prototype = new Html_data_interface('','','');
Html_data_template.prototype.constructor = Html_data_template.constructor;
