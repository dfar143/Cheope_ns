function interfacce_onChange(actObj)
{
 var nomeInterfaccia = actObj.value;
 var nomeInterfacciaItems = nomeInterfaccia.split("!");
 var nomePagina = nomeInterfacciaItems[1];
 var intPage = 'inspect.php';
 newLocation = intPage + '?interfaccia=';
 var newLocation = newLocation + actObj.value;
 window.location = newLocation;
}

function genitori_onChange(actObj)
{
 var nomePagina = $('#Genitori').get(0).value;
 var items = nomePagina.split('!');
 nomePagina = items[1];
 var intPage = 'inspect.php';
 newLocation = intPage + '?interfaccia=';
 var newLocation= newLocation + actObj.value;
 window.location = newLocation;
}

function transformChild(actJQueryNode)
{
	var rootNode = actJQueryNode.get(0);
	var textNode = rootNode.childNodes[0];
	var nextMenu = rootNode.childNodes[1];
	var id = nextMenu.id;
	var anchorNode = document.createElement('a');
	anchorNode.href = textNode.nodeValue;
	anchorNode.appendChild(textNode);
	rootNode.replaceChild(anchorNode,rootNode.childNodes[0]);
	rootNode.appendChild(nextMenu);
  transformMenu(id);
}

function transformMenu(actId)
{
	$('#' + actId + '> li').each(function()
	{
		var curNode = this;
	var rootNode = $(curNode).get(0);
	var textNode = rootNode.childNodes[0];
	var nextMenu = rootNode.childNodes[1];
	if(nextMenu != undefined)
	{
	 var id = $(nextMenu).attr('id');
	 var anchorNode = document.createElement('a');
	 anchorNode.href = 'inspect.php?interfaccia=' + textNode.nodeValue;
	 anchorNode.id = actId + '_' + textNode.nodeValue;
	 anchorNode.appendChild(textNode);
	 rootNode.replaceChild(anchorNode,rootNode.childNodes[0]);
	 rootNode.appendChild(nextMenu);
   transformMenu(id);
  }
});
}

function preview_exec(actInt,actActiveApp,actServerName,actDocRoot)
{
	//alert(actInt);
	var intr = actInt;
	if(intr.replace(/\s*/g,'')=='')
	{
		alert(loc.getString('msg',56));
		return false;
  }
  
  var crEnabled = 1;
  ajaxHandler.synServerCall('ajax_handler.php','dojoInPreview','','text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/<>\?]*/);
  var result = ajaxHandler.getOpByName('dojoInPreview').result;
  
  //console.log(result);
  
  if(result=='true')
   var dojoEnabled = 1;
  else
   var dojoEnabled = 0;
  
  var jqueryEnabled = 1;
  var dataPageEnabled = 1;

  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' + 
  jqueryEnabled + ';' + dataPageEnabled ;
  ajaxHandler.synServerCall('ajax_handler.php','createPreview',intr,'text',/[\s\._\:A-Za-z0-9;\-!\/=%&\/<>\?]*/);
  
  var dirName=actActiveApp;
  if(dirName!='')
    window.open('http://' + actServerName +
   '/' + actDocRoot + '/' + dirName +
   '/' + 'preview.php');
  
  return false;	
}
