//
// Necessita la preventiva inclusione di Html_formatted_interface.js
//
function Javascript_txtEditor(actOp,actNum)
{
	this.setOp(actOp);
	this.setType('Javascript_txtEditor');
	this.setNum(actNum);
	
	this.cols = 800;
	this.setCols = function(actCols)
	{
		this.cols = actCols;
	}
	this.getCols = function()
	{
		return this.cols; 
	}
	this.rows = 25;
	this.setRows = function(actRows)
	{
		this.rows = actRows;
	}
	this.getRows = function()
	{
		return this.rows;
	}
	this.fileName = '';
	this.getFileName = function()
	{
		return this.fileName;
	}
	this.setFileName = function(actFileName)
	{
	  this.fileName = actFileName;	
	}
	this.sendAjaxPage = 'ajax_handler.php';
	this.setSendAjaxPage = function(actSendAjaxPage)
	{
		this.sendAjaxPage = actSendAjaxPage;
	}
	this.getSendAjaxPage = function()
	{
		return this.sendAjaxPage;
	}
	this.sendAjaxOp = 'sendFile';
	this.setSendAjaxOp = function(actSendAjaxOp)
	{
		this.sendAjaxOp = actSendAjaxOp;
	}
	this.getSendAjaxOp = function()
	{
		return this.sendAjaxOp;
	}
  this.getAjaxPage = 'ajax_handler.php';
	this.setGetAjaxPage = function(actGetAjaxPage)
	{
		this.getAjaxPage = actGetAjaxPage;
	}
	this.getGetAjaxPage = function()
	{
		return this.getAjaxPage;
	}
	this.getAjaxOp = 'getFile';
	this.setGetAjaxOp = function(actGetAjaxOp)
	{
		this.getAjaxOp = actGetAjaxOp;
	}
	this.getGetAjaxOp = function()
	{
		return this.getAjaxOp;
	}
	this.sepChar = '';
	this.setSepChar=function(actSepChar)
	{
		this.sepChar = actSepChar;
  }
  this.getSepChar = function()
  {
  	return this.sepChar;
  }
	
	this.value = '';
	this.setValue = function(actValue)
	{
		this.value = actValue;
	}
	this.setValueToTextArea = function()
	{
	 var value = this.getValue();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textAreaEl = document.getElementById(intCode + '_' + 'textarea');
   textAreaEl.value = value;
	}	
	this.getValue = function()
	{
		return this.value;
	}
	this.getValueFromTextArea = function()
	{
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textAreaEl = document.getElementById(intCode + '_' + 'textarea');
   return textAreaEl.value;
	}
	this.textColor = 'black';
	this.setTextColor = function(actTextColor)
	{
		this.textColor = actTextColor;
	}
	this.getTextColor = function()
	{
	 return this.textColor;
	}
	this.ctrlColor = 'white';
	this.setCtrlColor = function(actCtrlColor)
	{
		this.ctrlColor = actCtrlColor;
	}
	this.getCtrlColor = function()
	{
	 return this.ctrlColor;
	}
	this.toolbarBorderColor = 'white';
	this.setToolbarBorderColor = function(actToolbarBorderColor)
	{
		this.toolbarBorderColor = actToolbarBorderColor;
	}
	this.getToolbarBorderColor = function()
	{
	 return this.toolbarBorderColor;
	}
	this.bodyBorderColor = 'white';
	this.setBodyBorderColor = function(actBodyBorderColor)
	{
		this.bodyBorderColor = actBodyBorderColor;
	}
	this.getBodyBorderColor = function()
	{
	 return this.bodyBorderColor;
	}
	this.buttonsBorderColor = 'white';
	this.setButtonsBorderColor = function(actButtonsBorderColor)
	{
		this.buttonsBorderColor = actButtonsBorderColor;
	}
	this.getButtonsBorderColor = function()
	{
	 return this.buttonsBorderColor;
	}
	this.toolbarBackgroundColor = 'white';
	this.setToolbarBackgroundColor = function(actToolbarBackgroundColor)
	{
		this.toolbarBackgroundColor = actToolbarBackgroundColor;
	}
	this.getToolbarBackgroundColor = function()
	{
	 return this.toolbarBackgroundColor;
	}
	this.bodyBackgroundColor = 'white';
	this.setBodyBackgroundColor = function(actBodyBackgroundColor)
	{
		this.bodyBackgroundColor = actBodyBackgroundColor;
	}
	this.getBodyBackgroundColor = function()
	{
	 return this.bodyBackgroundColor;
	}
	this.buttonsBackgroundColor = 'white';
	this.setButtonsBackgroundColor = function(actButtonsBackgroundColor)
	{
		this.buttonsBackgroundColor = actButtonsBackgroundColor;
	}
	this.getButtonsBackgroundColor = function()
	{
	 return this.buttonsBackgroundColor;
	}
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var cssClass = this.getCssClass();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var fileName = this.getFileName();
   var value = this.getValue();
   var cols = this.getCols();
   var rows = this.getRows();
   var textColor = this.getTextColor();
   var ctrlColor = this.getCtrlColor();
   var toolbarBorderColor = this.getToolbarBorderColor();
   var bodyBorderColor = this.getBodyBorderColor();
   var buttonsBorderColor = this.getButtonsBorderColor();
   var toolbarBackgroundColor = this.getToolbarBackgroundColor();
   var bodyBackgroundColor = this.getBodyBackgroundColor();
   var buttonsBackgroundColor = this.getButtonsBackgroundColor();
   htmlWriter.putGenericHtmlString('<div class="' + cssClass + '" id="' + intCode + 
   '" style="' + 'width:100%;border:2px solid ' + ctrlColor + '">');
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'toolbar' + '" style="' + 
   'width:100%;border:1px solid ' + toolbarBorderColor + ';background-color:' + 
   toolbarBackgroundColor + ';' + '">');
   htmlWriter.putGenericHtmlString('<table>');
   htmlWriter.putGenericHtmlString('<tr>');
   htmlWriter.putGenericHtmlString('<td colspan="3"><label for="' + 
   intCode + '_' + 'filenameInputCtrl' + '" style="color:' + textColor + 
   '">Nome file:&nbsp;</label><input size="50" id="' + intCode + '_' +
   'fileNameInputCtrl' + '" type="text" name="' + intCode + '_' + 'fileNameInputCtrl' + 
   '" value="' + fileName +  '" onchange="' + 'Javascript_txtEditor.fileName=this.value;' + '"/></td>');
   htmlWriter.putGenericHtmlString('</tr>');
   htmlWriter.putGenericHtmlString('<tr>');
   htmlWriter.putGenericHtmlString('<td><label for="' + 
   intCode + '_' + 'findInputCtrl' + '" style="color:' + textColor + 
   '">Find:&nbsp;</label><input id="' + intCode + '_' +
   'findInputCtrl' + '" type="text" name="' + intCode + '_' + 'findInputCtrl' + 
   '" value=""/></td><td><label for="' + 
   intCode + '_' + 'replaceInputCtrl' + '" style="color:' + textColor + 
   '">Replace:&nbsp;</label><input id="' + intCode + '_' +
   'replaceInputCtrl' + '" type="text" name="' + intCode + '_' + 'replaceInputCtrl' + 
   '" value=""/></td><td>' +
   '<button onclick=" var findItem = document.getElementById(\'' + intCode + '_' + 
   'findInputCtrl' + '\').value;var replaceItem = document.getElementById(\'' +
    intCode + '_' + 
   'replaceInputCtrl' + '\').value; var subjectEl = document.getElementById(\'' + intCode + '_' + 
   'textarea' + '\');var subjectItem = subjectEl.value;var subjectItem2 = subjectItem.replace(findItem' +  
   ',replaceItem);subjectEl.value = subjectItem2;">apply</button></td>');
    htmlWriter.putGenericHtmlString('</tr>');
   htmlWriter.putGenericHtmlString('</table>');
   htmlWriter.putGenericHtmlString('</div>'); 
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'body' + '" style="' + 
   'width:100%;border:1px solid ' + bodyBorderColor + ';overflow:scroll;background-color:' + 
   bodyBackgroundColor + ';' + '">');
   htmlWriter.putGenericHtmlString('<textarea id="' + intCode + '_' + 
   'textarea' + '" rows="' + rows + '" cols="' + cols + '"></textarea>');
   htmlWriter.putGenericHtmlString('</div>');
   htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'Buttons" style="' + 
   'margin:0px;border:1px solid ' + buttonsBorderColor + ';background-color:' + 
   buttonsBackgroundColor + ';">');
   var sendAjaxPage = this.getSendAjaxPage();
   var sendAjaxOp = this.getSendAjaxOp();
   var getAjaxPage = this.getGetAjaxPage();
   var getAjaxOp = this.getGetAjaxOp();
   htmlWriter.putGenericHtmlString('<button id="' + intCode + '_' + 'sendButton' + 
   '" onclick="' + 
   'var textareaEl = document.getElementById(\'' + intCode + '_' + 'textarea' + '\');' + 
   'var value = textareaEl.value;' +
   'var inputEl = document.getElementById(\'' + intCode + '_' + 'fileNameInputCtrl' + '\');' +
   'var sendAjaxId = inputEl.value;' + 
   'var valuePostStr = \'value=\' + value;' +
   'var opName = \'' + sendAjaxOp + '\';' + 
   'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
   util.firstCharToUpperCase(sendAjaxOp) + '\' + \'(opName)\');' +
   'ajaxHandler.serverPostCall(\'' + sendAjaxPage + '\',\'' + sendAjaxOp + '\',sendAjaxId' + 
   ',' + 'valuePostStr,\'text\',/[\s\._\:A-Za-z0-9;\-\?\/<>]*/);' + 
   '">Send</button>' + 
   '<button id="' + intCode + '_' + 'getButton' + 
   '" onclick="' + 
   'var inputEl = document.getElementById(\'' + intCode + '_' + 'fileNameInputCtrl' + '\');' +
   'var getAjaxId = inputEl.value;' + 
   'var textareaEl = document.getElementById(\'' + intCode + '_' + 'textarea' + '\');' + 
   'var opName = \'' + getAjaxOp + '\';' + 
   'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
   util.firstCharToUpperCase(getAjaxOp) + '\' + \'(opName)\');' +
   'ajaxHandler.serverCall(\'' + getAjaxPage + '\',\'' + getAjaxOp + '\',getAjaxId' + 
   ',\'text\',/[\s\._\:A-Za-z0-9;\-\?\/<>]*/);' + 
   '">Get</button>');
   htmlWriter.putGenericHtmlString('</div>'); 
   htmlWriter.putGenericHtmlString('</div>');     
   this.sendData();		
   this.setValueToTextArea();
	};
		
}
Javascript_txtEditor.prototype = new Html_formatted_interface('','','');
Javascript_txtEditor.prototype.constructor = Javascript_txtEditor.constructor;
Javascript_txtEditor.ajaxOp = new Function("actTxtAreaId","actTxt",
"{" + "var textAreaEl = document.getElementById(actTxtAreaId);" +
"textAreaEl.value = actTxt;" + "}");
