function OpJavascriptInjection()
{
	var op="";
	var num="";
	
	this.name = 'javascriptInjection';
	this.setOp = function(actOp){op=actOp};
	this.getOp = function(){return op};
	this.setNum = function(actNum){num=actNum};
	this.getNum = function(){return num};
	this.getPar = function(){var op1 = this.getOp();var num1 = this.getNum();return op1 + '_' + num1};
	this.exec = function(actJInCode){};
}