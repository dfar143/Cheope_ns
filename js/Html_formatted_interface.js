//
// Necessita la preventiva inclusione di interfaces.Generic_interface.js
//
function Html_formatted_interface(actOp,actType,actNum)
{
	this.setOp(actOp);
	this.setType(actType);
	this.setNum(actNum);
	
	this.hookId = '';
	this.setHookId = function(actHookId)
	{
	 this.hookId = actHookId;	
	}
	this.getHookId = function()
	{
		return this.hookId;
	}
	this.dispFields = null;
	this.setDispFields=function(actDispFields)
	{
		this.dispFields = actDispFields;
	};
	this.getDispFields = function()
	{
		return this.dispFields;
	};
	
	this.cssClass = '';
	this.setCssClass = function(actCssClass)
	{
	 this.cssClass = actCssClass;
	};
	this.getCssClass = function()
	{
	 return this.cssClass;
	};
  
	this.enableSendData = true;
	this.setEnableSendData = function(actEnableSendData)
	{
		this.enableSendData = actEnableSendData;
	}
	this.getEnableSendData = function()
	{
		return this.enableSendData;
	}
	
	this.sendData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var enableSendData = this.getEnableSendData();
	 if(enableSendData)
	 {
	  var hookId = this.getHookId();
	  var domContainerItem = document.getElementById(hookId);
	  domContainerItem.innerHTML = htmlWriter.sendData();
	 }	
	}
	
	this.putData = function()
	{
	};
}

Html_formatted_interface.prototype = new Generic_interface('','','');
Html_formatted_interface.prototype.constructor = Html_formatted_interface.constructor;
Html_formatted_interface.prototype.htmlWriter = null;
Html_formatted_interface.createHtmlWriter = function()
{
	return new Html_writer();
};
Html_formatted_interface.prototype.setHtmlWriter = function(actHtmlWriter)
{
	this.htmlWriter = actHtmlWriter;
};
Html_formatted_interface.prototype.getHtmlWriter = function()
{
	return this.htmlWriter;
};
Html_formatted_interface.prototype.setHtmlWriter(Html_formatted_interface.createHtmlWriter());
Html_formatted_interface.prototype.getHtmlWriter().setStack(Html_formatted_interface.prototype.getStack());