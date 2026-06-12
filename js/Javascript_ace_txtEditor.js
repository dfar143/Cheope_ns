//
// Necessita la preventiva inclusione di Html_formatted_interface.js
//

//------------------

// Javascript_ace_txtEditor

function Javascript_ace_txtEditor(actOp,actNum)
{
	this.setOp(actOp);
	this.setType('Javascript_ace_txtEditor');
	this.setNum(actNum);
	
	this.editorId = '';
	this.getEditorId= function()
	{
		return this.editorId;
	}
	this.setEditorId=function(actEditorId)
	{
		this.editorId = actEditorId;
	}	
	this.createEditor = function()
	{
		var editorId = this.getEditorId();
		return ace.edit(editorId);
	}
	
	this.editor = null;
  this.getEditor = function()
  {
  	return this.editor;
  } 
  this.setEditor=function(actEditor)
  {
  	this.editor = actEditor
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
	this.fontSize = '10px';
	this.getFontSize = function()
	{
		return this.fontSize;
	}
	this.setFontSize = function(actFontSize)
	{
	  this.fontSize = actFontSize;	
	}
	this.height = '400px';
	this.getHeight = function()
	{
		return this.height;
	}
	this.setHeight = function(actHeight)
	{
	  this.height = actHeight;	
	}		
	this.keyboardHandler = 'windows';
	this.getKeyboardHandler = function()
	{
		return this.keyboardHandler;
	}
	this.setKeyboardHandler = function(actKeyboardHandler)
	{
	  this.keyboardHandler = actKeyboardHandler;	
	}		
	this.readOnly = false;
	this.getReadOnly = function()
	{
		return this.readOnly;
	}
	this.setReadOnly = function(actReadOnly)
	{
	  this.readOnly = actReadOnly;	
	}		
	this.showInvisibles = false;
	this.getShowInvisibles = function()
	{
		return this.showInvisibles;
	}
	this.setShowInvisibles = function(actShowInvisibles)
	{
	  this.showInvisibles = actShowInvisibles;	
	}		
	this.theme = 'monokai';
	this.getTheme = function()
	{
		return this.theme;
	}
	this.setTheme = function(actTheme)
	{
	  this.theme = 'ace/theme/' + actTheme;	
	}	
	this.mode = false;
	this.getMode = function()
	{
		return this.mode;
	}
	this.setMode = function(actMode)
	{
	  this.mode = 'ace/mode/' + actMode;	
	}			
	this.enableStatusBar = false;
	this.getEnableStatusBar = function()
	{
		return this.enableStatusBar;
	}
	this.setEnableStatusBar = function(actEnableStatusBar)
	{
	  this.enableStatusBar = actEnableStatusBar;	
	}
	this.enableOpBar = false;
	this.getEnableOpBar = function()
	{
		return this.enableOpBar;
	}
	this.setEnableOpBar = function(actEnableOpBar)
	{
	  this.enableOpBar = actEnableOpBar;	
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
   this.value=actValue;
	}
	this.setValueToEditor = function(actValue)
	{
	 if(actValue===undefined)
	  var value = this.getValue();
	 else
	 	var value = actValue;
	 var editor = this.getEditor();
	 editor.setValue(value);
	}	
	this.getValue = function()
	{
		return this.value;
	}
	this.getValueFromEditor = function()
	{
	 var editor = this.getEditor();
   return editor.getValue();
	}
	this.extCtrlManager = function(actEvent){};
	this.setExtCtrlManager = function(actExtCtrlManager)
	{
		this.extCtrlManager = actExtCtrlManager;
	}
	this.getExtCtrlManager=function()
	{
		return this.extCtrlManager;
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
	this.buttonsBackgroundColor = 'white';
	this.setButtonsBackgroundColor = function(actButtonsBackgroundColor)
	{
		this.buttonsBackgroundColor = actButtonsBackgroundColor;
	}
	this.getButtonsBackgroundColor = function()
	{
	 return this.buttonsBackgroundColor;
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
	
	this.putData = function()
	{
	 var htmlWriter = this.getHtmlWriter();
	 var sepChar = this.getSepChar();
   var intCode = this.getInterfaceId(sepChar);
   var textColor = this.getTextColor();
   var fileName = this.getFileName();
   var op = this.getOp();
   var fontSize = this.getFontSize();
   var buttonsBorderColor = this.getButtonsBorderColor();
   var buttonsBackgroundColor = this.getButtonsBackgroundColor();
   var fontSize = this.getFontSize();
   var height = this.getHeight();
   var keyboardHandler = this.getKeyboardHandler();
   var readOnly = this.getReadOnly();
   var showInvisibles = this.getShowInvisibles();
   var theme = this.getTheme();
   var style = this.getStyle();
   var mode = this.getMode();   
   var editor = this.createEditor();
   var editorId = this.getEditorId();
   var enableStatusBar = this.getEnableStatusBar();
   var enableOpBar = this.getEnableOpBar();
   editor.setFontSize(fontSize);
   editor.setKeyboardHandler(keyboardHandler);
   editor.setReadOnly(readOnly);
   editor.setShowInvisibles(showInvisibles);
   editor.setTheme(theme);
   editor.setStyle(style);
   editor.getSession().setMode(mode);
   this.setEditor(editor);
   var editorDiv = document.getElementById(editorId);
   editorDiv.style.height=height;
   if(enableStatusBar)
    htmlWriter.putGenericHtmlString('<div id="statusBar"></div>');
   if(enableOpBar)
   {
    htmlWriter.putGenericHtmlString('<div id="' + intCode + '_' + 'Buttons" style="' + 
    'color:' + textColor + ';' +
    'margin:0px;border:1px solid;height:35px;' + buttonsBorderColor + ';background-color:' + 
    buttonsBackgroundColor + ';">');
    var sendAjaxPage = this.getSendAjaxPage();
    var sendAjaxOp = this.getSendAjaxOp();
    var getAjaxPage = this.getGetAjaxPage();
    var getAjaxOp = this.getGetAjaxOp();
    htmlWriter.putGenericHtmlString('<button title="Send document" style="float:left;margin:5px 5px ;" id="' + intCode + '_' + 'sendButton' + 
    '" onclick="' + 
    'var value = interfacesContainer.getInterface(\'' + op + '\').getValueFromEditor();' +
    'var valuePostStr = \'value=\' + value;' +
    'var sendAjaxId = \'' + fileName + '\';' +  
    'var opName = \'' + sendAjaxOp + '\';' + 
    'if(! ajaxHandler.getOpByName(opName))' +
    'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
    util.firstCharToUpperCase(sendAjaxOp) + '\' + \'(opName)\');' +
    'ajaxHandler.serverPostCall(\'' + sendAjaxPage + '\',\'' + sendAjaxOp + '\',sendAjaxId' + 
    ',' + 'valuePostStr,\'text\');var sign=document.getElementById(\'modify_sign\');' +
    'sign.style.visibility=\'hidden\';' + 
    '">Send</button>' + 
    '<button title="Get document" style="float:left;margin:5px 5px;" id="' + intCode + '_' + 'getButton' + 
    '" onclick="' + 
    'var getAjaxId = \'' + fileName + '\';' +  
    'var opName = \'' + getAjaxOp + '\';' + 
    'if(! ajaxHandler.getOpByName(opName))' +
    'ajaxHandler.getOpContainer()[ajaxHandler.getOpContainer().length]= eval(\'new Op\' + \'' + 
    util.firstCharToUpperCase(getAjaxOp) + '\' + \'(opName)\');' +
    'ajaxHandler.synServerCall(\'' + getAjaxPage + '\',\'' + getAjaxOp + '\',getAjaxId' + 
    ',\'text\');var sign=document.getElementById(\'modify_sign\');' +
    'sign.style.visibility=\'hidden\';var txtAceEditor = interfacesContainer.getInterface(\'' + op + 
    '\');txtAceEditor.getEditor().navigateTo(0,0);txtAceEditor.getExtCtrlManager()(\'get\');' + 
    '">Get</button><div style="text-align:right;"><span style="margin-right:10px;visibility:hidden;" id="modify_sign">*</span>' +
    '<button title="resize" style="margin:5px 5px 0px 0px;" id="resizer_plus" onclick="' +
    'var editorId = \'' + editorId + '\';var editorDiv = document.getElementById(editorId);' +
    'var height = editorDiv.style.height.slice(0,-2);height=parseInt(height) + 10;' +
    'editorDiv.style.height=height + \'px\';">+</button>' +
    '<button title="resize" style="margin:5px 5px 0px 0px;" id="resizer_minus" onclick="' +
    'var editorId = \'' + editorId + '\';var editorDiv = document.getElementById(editorId);' +
    'var height = editorDiv.style.height.slice(0,-2);var initHeight = \'' + height + '\'.slice(0,-2);' +
    'var newHeight = parseInt(height) - 10;if(newHeight>=parseInt(initHeight))editorDiv.style.height=newHeight + \'px\';">-</button>' +
    '</div>'); 
    htmlWriter.putGenericHtmlString('</div>');
   }
   this.sendData();
   if(enableStatusBar)
   {
    var StatusBar = ace.require("ace/ext/statusbar").StatusBar;
    var statusBar = new StatusBar(editor, document.getElementById("statusBar"));    	
   }
   this.setValueToEditor();	
   var thisObj = this;
   if(enableOpBar)
   {
    editor.on('change',function(actObj){
    	var sign=document.getElementById('modify_sign');
    	sign.style.visibility='visible';thisObj.getExtCtrlManager()('change');});  
	 }
	};
}
Javascript_ace_txtEditor.prototype = new Html_formatted_interface('','','');
Javascript_ace_txtEditor.prototype.constructor = Javascript_ace_txtEditor.constructor;


//------------------
