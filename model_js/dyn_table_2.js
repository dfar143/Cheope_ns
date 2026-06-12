// Il match fra i dati passati in loadTableValues come xmlDocument e i campi 
// della tabella avviene per posizione.

var dynTable = function()
{
	     function createRow(actTableId)
	     {
         var tableRoot = document.getElementById(actTableId);
         var tableElRows = tableRoot.childNodes[1].childNodes[0].childNodes[0];
         var tableElRow = document.createElement("tr");
         tableElRow.setAttribute("class","scrolling_table_rows");
         tableElRow=tableElRows.appendChild(tableElRow);
         return tableElRow;	     	
	     }
	     
	     function createCols(actTableId,actRowEl,actEl1)
	     {
	     	for(var i=0;i<actEl1.childNodes.length;i++)
	     	{
	     		var el2 = actEl1.childNodes[i];
	     		var tableElCol = document.createElement("td");
	     		tableElCol.setAttribute("class","scrolling_table_columns");
	     		tableElCol=actRowEl.appendChild(tableElCol);
	     		var tableElColDiv = document.createElement("div");
	     		tableElColDiv.setAttribute("id",actTableId + '_field_' + el2.tagName + '_' + i);	     		
	     	  tableElColDiv = tableElCol.appendChild(tableElColDiv);
	     	}	     	
	     }
	     
	     function insertValues(actTableId,actEl1)
	     {
         for(var j=0;j<actEl1.childNodes.length;j++)
         {
          var el2 = actEl1.childNodes[j];
          var tableEl = document.getElementById(actTableId + '_field_' + el2.tagName + '_' + j);
          var newTextEl = document.createTextNode(el2.text);
          tableEl.appendChild(newTextEl);
         }
	     }
	     
return {	
        "loadTableValues": function(actXmlDoc,actTableId)
        {             
         var rootEl = actXmlDoc.documentElement;
         for(var i=0;i<rootEl.childNodes.length;i++)
         {
          var el1 = rootEl.childNodes[i];
          for(var j=0;j<el1.childNodes.length;j++)
          {
           var el2 = el1.childNodes[j];
           var tableEl = document.getElementById(actTableId + '_field_' + el2.tagName + '_' + i);
           if(tableEl != null)
           {
            var tableElText = tableEl.childNodes[0];
            tableEl.removeChild(tableElText);
            var newTextEl = document.createTextNode(el2.text);
            tableEl.appendChild(newTextEl);
           }
           else
           {
            var rowEl = createRow(actTableId);
            createCols(actTableId,rowEl,el1);
            insertValues(actTableId,el1);
            }
           }
          }
        },
        "deleteTableRows": function(actTableId)
        {
         var tableRoot = document.getElementById(actTableId);
         var tableElRows = tableRoot.childNodes[1].childNodes[0].childNodes[0];
         var len1 = tableElRows.childNodes.length;
      	 for(var i=0;i<len1;i++)
      	 {
      	 	var tableElRow = tableElRows.childNodes[0];
      	 	tableElRows.removeChild(tableElRow);
      	 }
        },
        "createXmlDoc": function()
        {
	        var xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
	        var rootEl = xmlDoc.createElement("records");
	        xmlDoc.appendChild(rootEl);
	        var el=xmlDoc.createElement("record");
	        var rootEl = xmlDoc.documentElement;
	        rootEl.appendChild(el);
	        var el1 = xmlDoc.createElement("Id_prova");
	        el.appendChild(el1);
	        var el1Text = xmlDoc.createTextNode("1");
	        el1.appendChild(el1Text);
	        var el1 = xmlDoc.createElement("Data_1");
	        el.appendChild(el1);
	        var el1Text = xmlDoc.createTextNode("VALUE");
	        el1.appendChild(el1Text);
	        return xmlDoc;
        },
        "displayTable" : function(actTableId)
                         {
                         	var tableRoot = document.getElementById(actTableId);
                         	var tableEl = tableRoot.childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[1].childNodes[0];
                         	alert(tableEl.innerHTML);
                         }
       };
                      
}();