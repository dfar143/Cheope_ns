// Il match fra i dati passati in loadTableValues come xmlDocument e i campi 
// della tabella avviene per nome di campo nell'header.

var dynSheet = function()
{
	     var target;
	 
	 	   function getTarget()
	     {
	     	return target;
	     }
	     
return {
	      "setTarget":function(actTarget)
	      {
	      	target = actTarget;
	      },
	      "loadSheetValues": function(actXmlDoc,actFontFamily,actFontSize)
	      {
         var sheetId = getTarget();
         var rootEl = actXmlDoc.documentElement;
         var el1 = rootEl;
         var sheetRoot = document.getElementById(sheetId);
         var sheetElRows = sheetRoot.childNodes[0].childNodes[0];
         var len1 = sheetElRows.childNodes.length;
      	 for(var i=0;i<len1;i++)
      	 {
      	 	var sheetElRow = sheetElRows.childNodes[i];
      	 	var len2 = sheetElRow.childNodes.length;
      	 	for(var j=0;j<len2;j++)
      	 	{
      	 	 var sheetElCol = sheetElRow.childNodes[j];
      	 	 var sheetDiv = sheetElCol.childNodes[1];     	 	 
      	 	 var sheetSpanLabelB = sheetDiv.childNodes[0];
      	 	 var sheetSpanLabel = sheetSpanLabelB.childNodes[0];
         	 var fieldName = sheetSpanLabel.innerHTML.replace(/:/," ").replace(/\s+$/,"").replace(/\s+/g,"_");
           for(var k=0;k<el1.childNodes.length;k++)
           {
           	var el3 = el1.childNodes[k];
           	if(el3.tagName.toUpperCase()==fieldName.toUpperCase())
           	{
           	 var elSheetSpanValue = document.createElement('span');
           	 sheetDiv.appendChild(elSheetSpanValue);
             var newTextEl = document.createTextNode(el3.childNodes[0].nodeValue);
             elSheetSpanValue.appendChild(newTextEl);
            }
           }
      	  }
      	 }
	      },
        "deleteSheetRow": function()
        {
         var sheetId = getTarget();
         var sheetRoot = document.getElementById(sheetId);
         var sheetElRows = sheetRoot.childNodes[0].childNodes[0];
         var len1 = sheetElRows.childNodes.length;
      	 for(var i=0;i<len1;i++)
      	 {
      	 	var sheetElRow = sheetElRows.childNodes[i];
      	 	var len2 = sheetElRow.childNodes.length;
      	 	for(var j=0;j<len2;j++)
      	 	{
      	 	 var sheetElCol = sheetElRow.childNodes[j];
      	 	 var sheetSpan = sheetElCol.childNodes[1];
      	 	 var sheetVal = sheetSpan.childNodes[1];
      	 	 sheetSpan.removeChild(sheetVal);
      	  }
      	 }
        }
       };
                      
}();