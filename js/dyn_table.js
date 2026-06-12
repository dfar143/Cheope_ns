// Il match fra i dati passati in loadTableValues come xmlDocument e i campi 
// della tabella avviene per nome di campo nell'header.

var dynTable = function()
{
	     var target;
	 
	 	   function getTarget()
	     {
	     	return target;
	     }
	 
	     function createRow(actTableId)
	     {
	     	 var tableId = getTarget();
         var tableRoot = document.getElementById(tableId);
         var tableElRows = tableRoot.childNodes[1].childNodes[0].childNodes[0];
         var tableElRow = document.createElement("tr");
         tableElRow.setAttribute("class","scrolling_table_rows");
         tableElRow = tableElRows.appendChild(tableElRow);
         return tableElRow;	     	
	     }
	     
	     function inHeaderRow(actEl,actRow)
	     {
	     	for(var i2=0;i2<actRow.childNodes.length;i2++)
	     	{
	     		if(actEl.tagName.toUpperCase()==actRow.childNodes[i2].childNodes[0].innerHTML.replace(/\s+$/,"").replace(/\s+/g,"_").toUpperCase())
	     		 return true;
	     	}
	     	return false;
	     }
	     
	     function createCols(actRowEl,actEl1,actHeaderRow,actWidth,actInd,actFontFamily,actFontSize)
	     {
	     	var tableId = getTarget();
	     	for(var i1=0;i1<actEl1.childNodes.length;i1++)
	     	{
	     	 var el2 = actEl1.childNodes[i1];
         if(inHeaderRow(el2,actHeaderRow))
         {
	     		var tableElCol = document.createElement("td");
	     		tableElCol.setAttribute("class","scrolling_table_columns");
	     		tableElCol.setAttribute("width",(actWidth)+"%");
	     		tableElCol=actRowEl.appendChild(tableElCol);
	     		tableElColDiv = document.createElement("div");
	     		tableElColDiv.setAttribute("id",tableId + '_field_' + el2.tagName + '_' + actInd);
	     	  var tableElColDiv = tableElCol.appendChild(tableElColDiv);
	     	 }
	     	}	     	
	     }
	     
return {
	      "setTarget":function(actTarget)
	      {
	      	target = actTarget;
	      },	
        "loadTableValues": function(actXmlDoc,actFontFamily,actFontSize)
        {
         var tableId = getTarget();
         var tableRoot = document.getElementById(tableId);	
         var tableRootHeaderRows = tableRoot.childNodes[0].childNodes[0].childNodes[0].childNodes[0];
         var rootEl = actXmlDoc.documentElement;     
         for(var i=0;i<rootEl.childNodes.length;i++)
         {
         	var el1 = rootEl.childNodes[i].childNodes[0];
         	var width = Math.ceil(100 / (tableRootHeaderRows.childNodes.length));
         	var rowEl = createRow(); 
         	createCols(rowEl,el1,tableRootHeaderRows,width,i,actFontFamily,actFontSize);            
          for(var j=0;j<tableRootHeaderRows.childNodes.length;j++)
          {
         	 var el2 = tableRootHeaderRows.childNodes[j].childNodes[0];
         	 var fieldName = el2.innerHTML.replace(/\s+$/,"").replace(/\s+/g,"_");
           for(var k=0;k<el1.childNodes.length;k++)
           {
           	var el3 = el1.childNodes[k];
           	if(el3.tagName.toUpperCase()==fieldName.toUpperCase())
           	{
             var tableEl = document.getElementById(tableId + '_field_' + fieldName + '_' + i);
             if(tableEl != null)
             {
              var newTextEl = document.createTextNode(el3.childNodes[0].nodeValue);
              tableEl.appendChild(newTextEl);
             }           	
           	}
           }
          }
         }
        },
        "deleteTableRows": function()
        {
         var tableId = getTarget();
         var tableRoot = document.getElementById(tableId);
         var tableElRows = tableRoot.childNodes[1];
         var tableElRows1 = tableElRows.childNodes[0];
         var tableElRows2 = tableElRows1.childNodes[0];
         var len1 = tableElRows2.childNodes.length;
      	 for(var i=0;i<len1;i++)
      	 {
      	 	var tableElRow = tableElRows2.childNodes[0];
      	 	tableElRows2.removeChild(tableElRow);
      	 }
        }
       };
                      
}();