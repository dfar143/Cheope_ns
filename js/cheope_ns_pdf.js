function shortName_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',8));
 	 $(actObj).val('');
 	 return false;
 	}
}

function templates_onChange(actObj)
{
 var intName = $(actObj).val();
 var template = $(actObj).find('option:selected').text();
 if(template.replace(/\s*/g,'')=='')
 {
	$('#Op').val('');
	$('#Num').val('0');
	return false;
 }
 else
 {
 	ajaxHandler.synServerCall('ajax_handler.php','viewPdfTemplateGridOp1',intName,'xml',/CDATA/);
  var intItems = template.split('!');
  if(intItems.length==1)
  {
   var intName = template
   ajaxHandler.synServerCall('ajax_handler.php',
   'getFreeInterfaceCanonicalName',intName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
   var intName1 = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
   $('#ShortName').val(intName);
   $('#CheckBox_IFreeName').get(0).checked = true;
   var intItems = intName1.split('!');
  }
  else
  {
   intName1 = intName;
	 $('#ShortName').val('');
	 $('#CheckBox_IFreeName').get(0).checked = false;
  }
  var tipoInterfaccia = intItems[3];
  $('#Op').val(intItems[4]);
   
  intNumItems = intItems[5].split('.');
  if(intNumItems.length==2)
   var num = intNumItems[0];
  else
 	 var num = intNumItems[0];
 
  $('#Num').val(num);
 }
}

function checkbox_IFreeName_onClick(actObj)
{
	if($(actObj).get(0).checked)
	{
		if($('#ShortName').val().replace(/\s*/g,'')=='')
		{
		 alert(loc.getString('msg',66));
		 $(actObj).get(0).checked=false;
	  }
	}
}

function pagine_onChange(actObj)
{
 var id = actObj.value;
 ajaxHandler.synServerCall('ajax_handler.php','getPdfTemplates',id,'xml',/[.]*ind_records[.]*/);
}

function open_ctrl_edit(actRow,actCol)
{
	subModal.showPopWin("edit_field_props_2.php?Par1=" +
	actCol + "&Par2=" + actRow,
	600,400,function(actObj){update_ctrl(actObj,actCol,actRow);
	},true);
}

function setBufferForRow(actBuffer,actBufferCommon)
{
  actBuffer.xCoord = actBufferCommon.xCoord;
  actBuffer.yCoord = actBufferCommon.yCoord;
  actBuffer.height = actBufferCommon.height;
  actBuffer.fontSize = actbufferCommon.fontSize;
  
  return actBuffer;	
}


function update_ctrl(actObj,actCol,actRow)
{
	$('#ctrl_id_' + actRow + '_' + actCol).
	data('buffer',actObj);
	return;
}

// Ritorna il buffer di default per un tipo specifico di campo predefinito, data riga e colonna.
//
function getDefaultsCtrlBuffer(actRow,actCol,actIntType)
{
	var buf = {};
	
	var appName = $("#active_application_id").text().replace(/\s*/g,'');
	
  buf.type = actIntType;
  buf.shortName = '';
  buf.appName = appName;
  buf.num = "0";
  buf.op = "";
  buf.pageName = "";
    
  switch(actIntType)
  {
   case "none":
	     buf.dataFields = "";
         buf.dataFieldsDomains = "";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
		 buf.type = "fpdf_field_h";
         break;   
   case "fpdf_field_h" :
	       buf.dataFields = "campo_" + actRow + "_" + actCol;
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
         break;
   case "fpdf_field_v" :
	       buf.dataFields = "campo_" + actRow + "_" + actCol;
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.labelName = "";
         buf.void1 = "";
         buf.void2 = "";
         break;
   case "fpdf_img" :
         buf.void1 = "";
         buf.void2 = "";
         buf.void3 = "";
         buf.void4 = "";
         buf.void5 = "";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50"; 
         buf.width = "100";
         buf.fileName = "";
         buf.fileType = "";
         buf.void6 = "";
         buf.void7 = ""; 
         break;
   case "fpdf_txt" :
	       buf.dataFields = "campo_" + actRow + "_" + actCol;
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "50";
         buf.width = "100";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.void1 = "";
         buf.void2 = "";
         break;
  case "fpdf_field_template" :
	       buf.dataFields = "campo_" + actRow + "_" + actCol;
         buf.dataFieldsDomains = "atomic";
         buf.dataFieldsDomainsValues = "";
         buf.obj = "OBJ_NONE";
         buf.xCoord = "0";
         buf.yCoord = "0";
         buf.height = "15";
         buf.width = "0";
         buf.font = "";
         buf.fontStyle = "";
         buf.fontSize = "10";
         buf.align = 'L';
         buf.template = "";
         break;
  }

 buf.tempField = "campo_" + actRow + "_" + actCol;
 return buf;
}


// Prende i dati di default per le proprietà di un generico template.
function getTemplateDefaults(actShortName)
{
	var templateProps = {};
	
	templateProps['op'] = '';
	templateProps['type'] = 'fpdf_template';
	templateProps['num'] = '0';
	templateProps['shortName'] = actShortName;
	templateProps['obj'] = 'OBJ_NONE';
  templateProps['gridDimX'] = '0';
  templateProps['gridDimY'] = '0';
  templateProps['fileName'] = 'template.pdf';
	
	return templateProps;
}


// imposta i default per i buffers per l'oggetto campo data riga e colonna
//
function getDefaultsObjBuffer(actRow,actCol)
{
 var objs = {};

 var buf_fpdf_field_h = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_h");
 objs.fpdf_field_h_buf = buf_fpdf_field_h;
 var buf_fpdf_field_v = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_v");
 objs.fpdf_field_v_buf = buf_fpdf_field_v;
 var buf_fpdf_img = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_img");
 objs.fpdf_img_buf = buf_fpdf_img;
 var buf_fpdf_txt = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_txt");
 objs.fpdf_txt_buf = buf_fpdf_txt;
 var buf_fpdf_field_template = getDefaultsCtrlBuffer(actRow,actCol,"fpdf_field_template");
 objs.fpdf_field_template_buf = buf_fpdf_field_template;
 var buf_fpdf_field_none = getDefaultsCtrlBuffer(actRow,actCol,"none");
 objs.none_buf = buf_fpdf_field_none;
 return objs;
}

//
// Rinomina tutti i nomi dei campi a partire da quello
// indicato dall'argomento.
function renameAllFieldsFromThis(actFieldInd)
{

}


//
// Calcola l'indice del controllo in base a riga e colonna
//
function getCtrlBufInd(actRow)
{
	var index = 0;
 	for(var i=0;i<=actRow;i++)
 	{
 	 index = index + $('#gridView_id #gridView_row_id_' + i + ' > div').size();
 	}
 	return index;
}

/*function setPredInterfaces(actRow,actCol)
{
 	ajaxHandler.synServerCall('ajax_handler.php','getPredInterfaces2','','xml');
 	var intPred = interfacesContainer.getInterface('getPredInterfaces2');
 	var dataSource = intPred.getDataSource();
 	intPred.setEnableSendData(true);
 	var id = 'ctrl_id_' + actRow + '_' + actCol;
 	intPred.setHookId(id);
 	intPred.putData();
}*/  


//
// Funzione associata ad evento onclick del tasto di aggiunta nuovo controllo nella singola riga
// Nome esplicativo della funzionalità effettuata.
//
function add_column_to_grid_row(actRow,actSelectedItem)
{
	var col = $('#gridView_id #gridView_row_id_' + actRow + ' > div').size() - 1;
	var ctrlSep = $('#gridView_id #gridView_row_id_' + actRow +
	' #sep_id_' + actRow + '_' + col).get(0);
	var pos1 = ++col;
	var ctrlDiv1 = document.createElement('div');
	ctrlDiv1.id = 'gridView_column_id_' + actRow + '_' + pos1;
	//ctrlDiv1.style.height = '40px';
	ctrlDiv1.style.float = 'left';
	var ctrlDiv2 = document.createElement('div');
	ctrlDiv2.id = 'gridView_ctrl_id_' + actRow + '_' + pos1;
	//ctrlDiv2.style.float = 'left';
	ctrlDiv2.style.border = '1px solid white';
	var ctrlSelect = document.createElement('select');
	ctrlSelect.id = 'ctrl_id_' + actRow + '_' + pos1;
  var ctrlOption1 = document.createElement('option');
  ctrlOption1.innerHTML = 'none';
  ctrlOption1.label = 'none';
  ctrlOption1.value = 'none';
  ctrlSelect.appendChild(ctrlOption1);
  var pred_interfaces = $('#html_tags__7').data('pred_interfaces');
	for(var item in pred_interfaces)
	{
		var option = document.createElement('option');
		var optVal = pred_interfaces[item];
		option.label = optVal;
		option.text = optVal;
		if(optVal !== 'none')
		ctrlSelect.appendChild(option);
	}
  ctrlSelect.onchange = function()
  {
    ajaxHandler.synServerCall('ajax_handler.php','getObjTypeByShortName',this.value,'text',/[\s\._\:A-Za-z0-9;\-]*/);
    var intType = ajaxHandler.getOpByName('getObjTypeByShortName').testResult;
    var bufLoader = interfacesContainer.getInterface('LoadBuffer');
    
    var id = $(this).get(0).id;
  	var els;
  	els = id.split('_');
  	var row = els[2];
  	var col = els[3];      
     
    bufLoader.setDataFieldDomainValueByName('Row',row + '');
    bufLoader.setDataFieldDomainValueByName('Col',col + '');
    bufLoader.setDataFieldDomainValueByName('Int',this.value);
    bufLoader.putData();
  	$(this).data('buffer')[intType + '_buf'].shortName = this.value;
  	$(this).data('buffer')[intType + '_buf'].type = intType;
  	$(this).data('buffer')[intType + '_buf'].tempField = 'campo_' + row + '_' + col; 	
    $(this).data('buffer').type = intType;
    $(this).data('buffer').shortName = this.value;
  };
  if(actSelectedItem !== null)
  {
   util.setSelectedItem(ctrlSelect,actSelectedItem);
  }
  ctrlDiv2.appendChild(ctrlSelect);
  var ctrlBr = document.createElement('br');
  ctrlDiv2.appendChild(ctrlBr);
  var ctrlButton = document.createElement('button');
  ctrlButton.innerHTML = 'Edit';
  ctrlButton.onclick = function(){open_ctrl_edit(actRow,pos1);};
  ctrlButton.id = 'open_ctrl_id_' + actRow + '_' + pos1;
  ctrlDiv2.appendChild(ctrlButton);
  var ctrlImg = document.createElement('img');
  ctrlImg.src = './img/close_green.gif';
  ctrlImg.title = 'Delete control';
  ctrlImg.id = 'delete_column_id_' + actRow + '_' + pos1;
  ctrlImg.onclick = function(){delete_ctrl(actRow,pos1);};
  ctrlDiv2.appendChild(ctrlImg);
  ctrlDiv1.appendChild(ctrlDiv2);
  $(ctrlSep).after(ctrlDiv1);
  var ctrlSep1 = document.createElement('span');
  ctrlSep1.innerHTML = '&nbsp;-&nbsp;';
  ctrlSep1.id = 'sep_id_' + actRow + '_' + pos1;
  ctrlSep1.style.float = 'left';
  if(col <= 0)
  {
   $('#gridView_id #gridView_row_id_' + actRow).append(ctrlDiv1);
  }
  $(ctrlDiv1).after(ctrlSep1);
  var bufObj = getDefaultsObjBuffer(actRow,pos1);
  bufObj.type = 'fpdf_field_h';
  bufObj.shortName = 'none';
  bufObj[bufObj.type + '_buf'].shortName = 'none';
  bufObj[bufObj.type + '_buf'].tempField = 'campo_' + actRow + '_' + pos1;
  $('#ctrl_id_' + actRow + '_' + pos1).data('buffer',bufObj);
}

//
//
//
function setNameInCtrlBuffer(actBuf,actName)
{
 actBuf['fpdf_field_h_buf'].name = actName;
 actBuf['fpdf_field_v_buf'].name = actName;
 actBuf['fpdf_img_buf'].name = actName;
 actBuf['fpdf_txt_buf'].name = actName;
 actBuf['fpdf_field_template_buf'].name = actName;
 actBuf['none_buf'].name = actName;
 return actBuf;
}

//
//
//
function setDataFieldsInCtrlBuffer(actBuf,actName)
{
 var found = actBuf['fpdf_field_h_buf'].dataFields.search(/campo_[0-9]+_[0-9]+/);
 if(found !== -1)
  actBuf['fpdf_field_h_buf'].dataFields = actName;
 var found = actBuf['fpdf_field_v_buf'].dataFields.search(/campo_[0-9]+_[0-9]+/);
 if(found !== -1)
  actBuf['fpdf_field_v_buf'].dataFields = actName;
 var found = actBuf['fpdf_txt_buf'].dataFields.search(/campo_[0-9]+_[0-9]+/);
 if(found !== -1)
  actBuf['fpdf_txt_buf'].dataFields = actName;
 var found = actBuf['fpdf_field_template_buf'].dataFields.search(/campo_[0-9]+_[0-9]+/);
 if(found !== -1)
  actBuf['fpdf_field_template_buf'].dataFields = actName;
 var found = actBuf['none_buf'].dataFields.search(/campo_[0-9]+_[0-9]+/);
 if(found !== -1)
  actBuf['none_buf'].dataFields = actName;
 return actBuf;
}


//
// Funzione associata ad evento onclick dell'icona di cancellazione del singolo controllo
// Nome esplicativo della funzionalità effettuata.
//
function delete_ctrl(actRow,actCol)
{
	if(actCol > 0)
	{
	 $('#gridView_id #gridView_row_id_' + actRow + ' #gridView_column_id_' + actRow + '_' + actCol).detach();
	 $('#gridView_id #gridView_row_id_' + actRow + ' #sep_id_' + actRow + '_' + actCol).detach();
	 var col;
   $('#gridView_id #gridView_row_id_' + actRow + ' > div').each(
   function(index){
   $(this).find('div').get(0).id = 'gridView_ctrl_id_' + actRow + '_' + index;
   $(this).find('select').get(0).id = 'ctrl_id_' + actRow + '_' + index;
   var domain = $(this).find('select').data('buffer').domain;
   var name = 'campo_' + actRow + '_' + index;
   $(this).find('select').data('buffer',setDataFieldsInCtrlBuffer($(this).find('select').data('buffer'),name));     
   $(this).find('img').get(0).onclick = function(){
   delete_ctrl(actRow,index);};
   $(this).find('img').get(0).id = 'delete_column_id_' + actRow + '_' + index;
   $(this).get(0).id = 'gridView_column_id_' + actRow + '_' + index});
   
   $('#gridView_id #gridView_row_id_' + actRow + ' > span').each(
   function(index){$(this).get(0).id = 'sep_id_' + actRow + '_' + index});
   
   $('#gridView_id #gridView_row_id_' + actRow +  
   ' > div').each(
   function(index){$(this).find('button').get(0).id = 'open_ctrl_id_' + actRow + '_' + index;
   	$(this).find('button').get(0).onclick = function(){open_ctrl_edit(actRow,index)}});
  }
 }

function add_row_to_grid()
{
	var row = $('#gridView_id > div').size() - 1;
	var row1 = row;
	var pos1 = ++row;

	var ctrlDiv = document.createElement('div');
	ctrlDiv.id = 'gridView_row_id_' + pos1;
	ctrlDiv.style.margin_left = '15px';
	ctrlDiv.style.border = '1px dotted white';
	ctrlDiv.style.height = '50px';
	ctrlDiv.style.padding = '5px';
	ctrlDiv.style.overflow = 'auto';
  var ctrlImg = document.createElement('img');
  ctrlImg.src = './img/close.gif';
  ctrlImg.title = 'Delete row';
  ctrlImg.style.float = 'left';
  ctrlImg.id = 'delete_row_id_' + pos1;
  ctrlImg.onclick = function(){delete_row(pos1);};
  if(pos1 > 0)
   $('#gridView_id > #gridView_row_id_' + row1).after(ctrlImg);
  else
  {
   $('#gridView_id').append(ctrlImg);
  }

  $(ctrlImg).after(ctrlDiv);

  var pos2 = 0;
  var ctrlDiv1 = document.createElement('div');
	ctrlDiv1.id = 'gridView_column_id_' + pos1 + '_' + pos2;
	ctrlDiv1.height = '40px';
	ctrlDiv1.style.float = 'left';

	var ctrlDiv2 = document.createElement('div');
  ctrlDiv2.id = 'gridView_ctrl_id_' + pos1 + '_' + pos2;
  ctrlDiv2.style.border = '1px solid white';

	var ctrlSelect = document.createElement('select');
	ctrlSelect.id = 'ctrl_id_' + pos1 + '_' + pos2;
  var ctrlOption1 = document.createElement('option');
  ctrlOption1.innerHTML = 'none';
  ctrlOption1.label = 'none';
  ctrlOption1.value = 'none';
  ctrlSelect.appendChild(ctrlOption1);
  var pred_interfaces = $('#html_tags__7').data('pred_interfaces');
	for(var item in pred_interfaces)
	{
		var option = document.createElement('option');
		var optVal = pred_interfaces[item];
		option.label = optVal;
		option.text = optVal;
		if(optVal !== 'none')
		ctrlSelect.appendChild(option);
	}
  ctrlSelect.onchange = function(){
    ajaxHandler.synServerCall('ajax_handler.php','getObjTypeByShortName',this.value,'text',/[\s\._\:A-Za-z0-9;\-]*/);
    var intType = ajaxHandler.getOpByName('getObjTypeByShortName').testResult;
    var bufLoader = interfacesContainer.getInterface('LoadBuffer');
    
    var id = $(this).get(0).id;
  	var els;
  	els = id.split('_');
  	var row = els[2];
  	var col = els[3];     
    
    bufLoader.setDataFieldDomainValueByName('Row',row + '');
    bufLoader.setDataFieldDomainValueByName('Col',col + '');
    bufLoader.setDataFieldDomainValueByName('Int',this.value);
    bufLoader.putData();
  	$(this).data('buffer')[intType + '_buf'].shortName = this.value;
    $(this).data('buffer')[intType + '_buf'].type = intType;
    $(this).data('buffer')[intType + '_buf'].tempField = 'campo_' + row + '_' + col;
    $(this).data('buffer').type = intType;
    $(this).data('buffer').shortName = this.value;    
  	};
  ctrlDiv2.appendChild(ctrlSelect);
  var ctrlBr = document.createElement('br');
  ctrlDiv2.appendChild(ctrlBr);
  var ctrlButton = document.createElement('button');
  ctrlButton.innerHTML = 'Edit';
  ctrlButton.onclick = function(){open_ctrl_edit(pos1,pos2);};
  ctrlButton.id = 'open_ctrl_id_' + pos1 + '_' + pos2;
  ctrlDiv2.appendChild(ctrlButton);
  var ctrlImg = document.createElement('img');
  ctrlImg.src = './img/close_green.gif';
  ctrlImg.title = 'Delete control';
  ctrlImg.id = 'delete_column_id_' + pos1 + '_' + pos2;
  ctrlImg.onclick = function(){delete_ctrl(pos1,pos2);};
  ctrlDiv2.appendChild(ctrlImg);
  ctrlDiv1.appendChild(ctrlDiv2);
  var ctrlSpan = document.createElement('span');
  ctrlSpan.innerHTML = '&nbsp;-&nbsp;';
  ctrlSpan.id = 'sep_id_' + pos1 + '_' + pos2;
  ctrlSpan.style.float = 'left';
  var ctrlButton1 = document.createElement('button');
  ctrlButton1.type = 'button';
  ctrlButton1.id = 'ctrl_add_column_button_id_' + pos2;
  ctrlButton1.innerHTML = ' + ';
  ctrlButton1.onclick = function()
  {add_column_to_grid_row(pos1,'none');};
  ctrlDiv.appendChild(ctrlDiv1);
  ctrlDiv.appendChild(ctrlSpan);
  ctrlDiv.appendChild(ctrlButton1);
  var bufObj = getDefaultsObjBuffer(pos1,pos2);
  bufObj.type = 'fpdf_field_h';
  bufObj.shortName = 'none';
  bufObj[bufObj.type + '_buf'].tempField = 'campo_' + pos1 + '_' + pos2;
  bufObj[bufObj.type + '_buf'].shortName = 'none';
  $('#ctrl_id_' + pos1 + '_' + pos2).data('buffer',bufObj);
}


//
// Funzione associata ad evento onclick dell'icona di cancellazione riga
// Nome esplicativo della funzionalità effettuata.
//
function delete_row(actRow)
{
	//console.log($('#gridView_id > div'));
  if(actRow>0)
  {
   $('#gridView_row_id_' + actRow).remove();
   $('#delete_row_id_' + actRow).remove();
  //console.log($('#gridView_id > div'));
  }
  var ctRow0=0;
  $('#gridView_id > img').each(function(index)
  {
   if(ctRow0 >= actRow)
   {
    $(this).get(0).onclick = function (){
  	 	var els;
  	 	els = this.id.split('_');
  	 	var row = els[3];
    	delete_row(row);
    	};
    $(this).get(0).id = 'delete_row_id_' + ctRow0;
   }
   ctRow0++;
  });
  ctRow1=0;
  $('#gridView_id > div').each(function(index){
  	//alert(ctRow);
  	if(ctRow1 >= actRow)
  	{
  	 //alert(ctRow);
  	 var ctCol=0;
  	 $(this).get(0).id = 'gridView_row_id_' + ctRow1;
  	 $(this).children('span').each(function(index){
  	 $(this).get(0).id = 'sep_id_' + ctRow1 + '_' + ctCol;
  	 ctCol++;
  	 });
  	 ctCol=0;
  	  $(this).children('button').each(function(index){
  	 	$(this).get(0).id = 'ctrl_add_column_button_id_' + ctRow1;
  	 	$(this).get(0).onclick = function()
  	 	 {
  	 	  var els;
  	 	  els = this.id.split('_');
  	 	  var row = els[5];
  	 		add_column_to_grid_row(row,'none')
  	 	 };
  	 	ctCol++;
  	 });

  	 ctCol1=0;

  	 $(this).children('div').each(function(index){
  	 	//console.log($(this).get(0));
  	 $(this).get(0).id = 'gridView_column_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').get(0).id = 'gridView_ctrl_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('select').get(0).id = 'ctrl_id_' + ctRow1 + '_' + ctCol1;  
     var intType = $(this).children('div').children('select').data('buffer').type;
     if((intType=='fpdf_field_h')||(intType=='fpdf_field_v')||
     (intType=='fpdf_txt')||(intType=='fpdf_field_template'))      
      $(this).children('div').children('select').data('buffer')[intType + '_buf'].dataFields = 
      'campo_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('button').get(0).id = 'open_ctrl_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('img').get(0).id = 'delete_column_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('img').get(0).onclick =
  	 function(){
  	 	var els;
  	 	els = this.id.split('_');
  	 	var row = els[3];
  	 	var col = els[4];
  	 	delete_ctrl(row,col);};
      ctCol1++;
     });
    }
    ctRow1++;
  });
}

function getFirstCtrlIdIndex()
{
 var ctrlIdIndex = null;
 var flag = false;
 $('#gridView_id > div').each(
 function(index)
 {
  $(this).children('div').each(function(index)
  {
   if(! flag)
   {
    var ctrlId = $(this).children('div').children('select').get(0).id;
    ctrlIdIndex = ctrlId.substr(8,ctrlId.length-1);
    flag=true;
   }
  }
  )
 }
)
return ctrlIdIndex;
}

function detectMaxDimX()
{
 var numRows = $('#gridView_id > div').size();
 var ctRow = 0;
 var numCol1 = 0;
 while(ctRow <= numRows-1)
 {
  numCol = $('#gridView_id #gridView_row_id_' +  ctRow +  ' > div').size();
  if(numCol > numCol1)
   numCol1 = numCol;
  ctRow++;
 }
 return numCol1;
}

function detectDimY()
{
	var numRows = $('#gridView_id > div').size();
	return numRows;
}

function detectCurDimX(actY)
{
  var numCol = $('#gridView_id #gridView_row_id_' +  actY +  ' > div').size();
  return numCol;
}

function completeGridWithNone()
{
	var maxDimX = detectMaxDimX();
	var dimY = detectDimY();
	var cty=0;
	while(cty <= dimY-1)
	{
		var currDimX = detectCurDimX(cty);
		var ctx = currDimX;
		while(ctx <= maxDimX-1)
		{
			add_column_to_grid_row(cty,'none');
			ctx++;
		}
		cty++;
	}
}


function save_button_onClick()
{
 	var postStr = 'pagina=' + encodeURIComponent($('#Pagine').val().replace(/\s*/g,'')) + '&';
	var formVal = $('#Templates').val().replace(/\s*/g,'');
	postStr += 'templates=' + encodeURIComponent(formVal) + '&';
	var op = $('#Op').val().replace(/\s*/g,'');
	postStr += 'op=' + encodeURIComponent(op) + '&';
	var num = $('#Num').val().replace(/\s*/g,'');
	postStr += 'num=' + encodeURIComponent(num) + '&';
  var shortName = $('#ShortName').val().replace(/\s*/g,'');
  postStr += 'shortName=' + encodeURIComponent(shortName) + '&';
	var  interfaceFree = ($('#CheckBox_IFreeName').get(0).checked?'true':'false');
  postStr += 'checkBox_IFreeName=' + encodeURIComponent(interfaceFree) + '&';
  var ctrlId = getFirstCtrlIdIndex();
  //console.log(ctrlId);
  completeGridWithNone();

  var numRows = $('#gridView_id > div').size();
  var ctRow = 0;
  var ctRec = 0;
  while(ctRow <= numRows-1)
  {
  	var ctCol = 0;
    var numCol = $('#gridView_id #gridView_row_id_' +  ctRow +  ' > div').size();
  	$('#gridView_id #gridView_row_id_' +  ctRow +  ' > div').each(
  	function(index)
  	{
  		var type = $('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer').type;
		//console.log('aaa');
		//console.log(ctRow);
		//console.log(ctCol);
		//console.log($('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer'));
		//console.log(type);
		//console.log('bbb');
		var shortName = $('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer').shortName;
  		
  		if((type !== 'none')&&(shortName !== 'none'))
  		 var buf = $('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer')[type + '_buf'];
  		else 
		{
  		 var buf = getDefaultsCtrlBuffer(ctRow,ctCol,'none');
		 buf.shortName = shortName;
		}
		
		//console.log('hhhh');
		//console.log(buf);
		//console.log('hhhh');
		
  		ct=0;
  		postStr += 'ctrlId_' + ctRec + '=ctrl_' + ctRow + '_' + ctCol + '&';
  		var numBufEls = util.length(buf);
        //console.log(buf); 
		//console.log('mmmm');
		//console.log(numBufEls);
		//console.log('mmmm');
 
  		for(var ind in buf)
  		{
  			var item = buf[ind];
  			if(util.is_array(item))
  			 item1 = item.toString();
  			else
  			 item1 = item;
//
// Sotto l'ipotesi che il carattere = non sarà mai contenuto nel valore dell'attributo
//
  		 if((ct >= numBufEls - 1)&&(ctCol > numCol - 1))
  		  postStr += 'attr_' + ctRec + '_' +  ct + '=' + encodeURIComponent(item1);
  		 else
  		  postStr += 'attr_' + ctRec + '_' +  ct + '=' + encodeURIComponent(item1) + '&';
  		 ct++;
  		}
  		ctRec++;
  		ctCol++;
  	});
   ctRow++;
  }
//  alert(postStr);

  var postStrLen = postStr.length;
  var lastChar = postStr.substr(postStrLen-1,postStrLen-1);
  if(lastChar=='&')
   postStr1 = postStr.substr(0,postStrLen-1);
  else
 	 postStr1 = postStr;

  console.log(postStr1);

  if(numRows > 0)
  {
	 ajaxHandler.synServerPostCall('ajax_handler.php','savePdfTemplate','',postStr1,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  }
}

function button_template_section_preview_onClick(actObj)
{
 var appName = $('#active_application_id').text().replace(/\s*/g,'');
 var pagina = $('#Pagine').val();
 var op = $('#Op').val().replace(/\s*/g,'');
 var num = $('#Num').val().replace(/\s*/g,'');
 var shortName = $('#ShortName').val().replace(/\s*/g,'');
 var intName = $('#Templates').val().replace(/\s*/g,'');
 var intNameRegExp = /([A-Z][a-z_0-9]*)!([A-Za-z]?[a-z_0-9]*)!([A-Z]?[a-z_0-9]*)!([a-z][a-z_0-9]*)!([A-Z]?[a-z_0-9]*)!([0-9]+)/;
 var objName='';
 var result = intName.match(intNameRegExp);
 if(result != null)
 {
 	var objName = result[3];  
 } 

 if(num=='')
 	num='0';

 	var templateFileName = $('#Templates').val().replace(/\s*/g,'');
 	templateFileNameItems = templateFileName.split('.');
 	if(templateFileNameItems.length==2)
 	 templateSuffix = '.' + templateFileNameItems[1];
 	else
 	 templateSuffix = ''; 

 if((shortName=='')||(! $('#CheckBox_IFreeName').get(0).checked))
   var interfaccia=appName + '!' + pagina + '!' + objName + '!fpdf_template!' + op +
   '!' + num + templateSuffix;
 else
   interfaccia = shortName;	
  
  //console.log('BBB');
  ajaxHandler.synServerCall('ajax_handler.php','deleteFile2','doc.pdf','text',/[\s\._\:A-Za-z0-9;\-]*/);
  //console.log('CCC');
  ajaxHandler.synServerCall('ajax_handler.php','createPdf',interfaccia,'text',/[\s\._\:A-Za-z0-9;\-]*/);
  //ajaxHandler.synServerCall('ajax_handler.php','createPdf',interfaccia,'text',/[]*/);


 return;
}
