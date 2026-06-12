function OpTestDir(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	if(actXmlMsg==''){alert(loc.getString('msg',30));
	window.location.reload(true);}
	else{items = actXmlMsg.split(';');
	window.location.href = items[0] + '?' + 
	'command' + '=' + 'changeDir' + '&' + 
'dir' + '=' + items[1];}};
}

function OpLogEnable(actName)
{
 this.name=actName;
 this.exec = function(actXmlMsg){
 }
}

function OpUnblockApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	//alert(actXmlMsg);
	if(actXmlMsg==1){var el=document.getElementById('sbloccaApp');
	el.style.fontStyle='normal';el.firstChild.nodeValue='';
 }};	
}

function OpDeleteFile(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 //alert(actXmlMsg);
 window.location.reload();};	
}

function OpCreateFile(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
 //alert(actXmlMsg);
 window.location.reload();};	
}

function OpRenameFile(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
  //alert(actXmlMsg);
  window.location.reload();};	
}

function OpSetSessionActiveApp(actName)
{
	this.name = actName;
	this.exec = function(actXmlMsg){
	};	
}

function OpScanForItem(actName)
{
	this.name = actName;
	this.exec = function(actTxtMsg)
	{this.result = actTxtMsg;};
}