function input_num_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[0-9]+[0-9]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function input_op_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
}

function shortName_onChange(actObj)
{
	var fieldVal = $(actObj).val().replace(/\s*/g,'');
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if((fieldVal.match(regExp) === null)&&(fieldVal !=''))
  {
 	 alert(loc.getString('msg',45));
 	 $(actObj).val('');
 	 return false;
 	}
  if(fieldVal=='')
  {
	 $('#CheckBox_IFreeName').get(0).checked=false;
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

function forms_onChange(actObj)
{
 var intName = $(actObj).val();
 var sMenu = $(actObj).find('option:selected').text();
 if(sMenu.replace(/\s*/g,'')=='')
 {
	$('#Op').val('');
	$('#Num').val('0');
	return false;
 }
 else
 {
 	ajaxHandler.synServerCall('ajax_handler.php','viewFormsSectionGridOp1',intName,'xml',/[.]*ind_records[.]*/);
  var intItems = sMenu.split('!');
  if(intItems.length==1)
  {
 	 var intName = sMenu;
   ajaxHandler.synServerCall('ajax_handler.php',
   'getFreeInterfaceCanonicalName',intName,'text',/[\s\._\:A-Za-z0-9;\-]*/);
   var intName = ajaxHandler.getOpByName('getFreeInterfaceCanonicalName').result;
   $('#ShortName').val(sMenu);
   $('#CheckBox_IFreeName').get(0).checked = true;
   var intItems = intName.split('!');
  }
  else
  {
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

function pagine_onChange(actObj)
{
 var id = actObj.value;
 ajaxHandler.synServerCall('ajax_handler.php','getFormSections',id,'xml',/[.]*ind_records[.]*/);
}

function open_ctrl_edit(actRow,actCol)
{
	subModal.showPopWin("edit_field_props.php?Par1=" +
	actCol + "&Par2=" + actRow,
	600,400,function(actObj){update_ctrl(actObj,actCol,actRow);
		dispatchCommonDataToCtrlsBuffer(actObj,actRow);},true);
}

function setBufferForRow(actBuffer,actBufferCommon,actTrig)
{
	if(actTrig)
	{
	 actBuffer.rowClass = actBufferCommon.rowClass;
	 actBuffer.rowStyle = actBufferCommon.rowStyle;
  }
  actBuffer.rowsClass = actBufferCommon.rowsClass;
  actBuffer.rowsStyle = actBufferCommon.rowsStyle;
  actBuffer.labelSpacerWidth = actBufferCommon.labelSpacerWidth;
  actBuffer.cellPadding = actBufferCommon.cellPadding;
  actBuffer.cellSpacing = actBufferCommon.cellSpacing;
  actBuffer.javascriptEnabled = actBufferCommon.javascriptEnabled;
  actBuffer.bootstrapEnabled = actBufferCommon.bootstrapEnabled;
  actBuffer.style = actBufferCommon.style;
  
  return actBuffer;	
}

function dispatchCommonDataToCtrlsBuffer(actObj,actRow)
{
// console.log(actObj);
 var buf_common = actObj['domain_common_buf'];
 var numRows = $('#gridView_id > div').size();
 var ctRow = 0;
 while(ctRow <= numRows-1)
 {
  $('#gridView_id #gridView_row_id_' +  ctRow +  ' > div').each(function(index)
  {
   var buf = $($(this).find('select').get(0)).data('buffer');
   if(ctRow == actRow)
    buf['domain_common_buf'] = setBufferForRow(buf['domain_common_buf'],buf_common,true);
   buf['domain_common_buf'] = setBufferForRow(buf['domain_common_buf'],buf_common,false);
   $($(this).find('select').get(0)).data('buffer',buf);      	
  }
  );
  ctRow++; 	
 }    		
}

function update_ctrl(actObj,actCol,actRow)
{
	$('#ctrl_id_' + actRow + '_' + actCol).
	data('buffer',actObj);
	var select =
	$('#ctrl_id_' + actRow + '_' + actCol).get(0);
	var domain = actObj.domain;
	var opts = select.options;
	var i=0;
	var num = opts.length;
	for(var i=0;i<=num-1;i++)
	{
		if(opts.item(i).label==domain)
		{		 
		 select.selectedIndex = i;
		 break;
	  }
	}
	return;
}

// Ritorna il buffer di default per ogni dominio.
//
function getDefaultsCtrlBuffer(actRow,actCol,actDomain)
{
	var buf = {};
	buf.name = "campo_" + actRow + "_" + actCol;
  buf.domain = actDomain;
  buf.domainValue = "";
  buf.fieldColStyle = "";
  buf.fieldColClass = "";
  buf.fieldLabel = "campo_" + actRow + "_" + actCol;
  buf.fieldStyle = "";
  buf.fieldType = "";
  buf.fieldLength = 10;
  buf.fieldStop = 10;
  buf.fieldHint = "";
  buf.fieldToolTip = "";
  buf.fieldEvents = ["",""];
  buf.fieldRegexp = "";
  buf.label = "";
  buf.fieldDirection = "";
  buf.fieldDefaultValue = "";
  buf.fieldMandatory = "";
  buf.fieldObjName = "";

 return buf;
}

//Ritorna il buffer completo.
function getCompleteCtrlBuffer(actRow,actCol,actDomain)
{
	var buf = {};	
	
	buf.name = "campo_" + actRow + "_" + actCol;
  buf.domain = actDomain;
  buf.domainValue = "";
  var buf1 = getDefaultsCommon();
  buf.rowClass = buf1.rowClass;
  buf.rowsClass = buf1.rowsClass;
  buf.rowStyle = buf1.rowStyle;
  buf.rowsStyle = buf1.rowsStyle;
  buf.labelSpacerWidth = buf1.labelSpacerWidth;
  buf.cellPadding = buf1.cellPadding;
  buf.cellSpacing = buf1.cellSpacing;
  buf.javascriptEnabled = buf1.javascriptEnabled;
  buf.bootstrapEnabled = buf1.bootstrapEnabled;
  buf.style = buf1.style;
  buf.fieldColStyle = "";
  buf.fieldColClass = "";
  buf.fieldLabel = "campo_" + actRow + "_" + actCol;
  buf.fieldStyle = "";
  buf.fieldType = "";
  buf.fieldLength = 10;
  buf.fieldStop = 10;
  buf.fieldHint = "";
  buf.fieldToolTip = "";
  buf.fieldEvents = ["",""];
  buf.fieldRegexp = "";
  buf.label = "";
  buf.fieldDirection = "";
  buf.fieldDefaultValue = "";
  buf.fieldMandatory = "";
  buf.fieldObjName = "";

 return buf;
}

// Ritorna i valori comuni di default per il buffer.
function getDefaultsCommon()
{
	var buf = {};
	
	buf.rowClass = "";
  buf.rowsClass = "";
  buf.rowStyle = "";
  buf.rowsStyle = "";
  buf.labelSpacerWidth = 1;
  buf.cellPadding = 0;
  buf.cellSpacing = 0;
  buf.javascriptEnabled = true;
  buf.bootstrapEnabled = true;
  buf.style = "";
  
  return buf;
}



// imposta i default per i buffers di dominio
//
function getDefaultsDomainBuffer(actRow,actCol)
{
 var domains = {};

 domains.domain = "atomic";
 var buf_atomic = getDefaultsCtrlBuffer(actRow,actCol,"atomic");
 domains.domain_atomic_buf = buf_atomic;
 var buf_atomic_static = getDefaultsCtrlBuffer(actRow,actCol,"atomic_static");
 domains.domain_atomic_static_buf = buf_atomic_static;
 var buf_set = getDefaultsCtrlBuffer(actRow,actCol,"set");
 domains.domain_set_buf = buf_set;
 var buf_check = getDefaultsCtrlBuffer(actRow,actCol,"check");
 domains.domain_check_buf = buf_check;
 var buf_radio = getDefaultsCtrlBuffer(actRow,actCol,"radio");
 domains.domain_radio_buf = buf_radio;
 var buf_multiple = getDefaultsCtrlBuffer(actRow,actCol,"multiple");
 domains.domain_multiple_buf = buf_multiple;
 var buf_password = getDefaultsCtrlBuffer(actRow,actCol,"password");
 domains.domain_password_buf = buf_password;
 var buf_file = getDefaultsCtrlBuffer(actRow,actCol,"file");
 domains.domain_file_buf = buf_file;
 var buf_hidden = getDefaultsCtrlBuffer(actRow,actCol,"hidden");
 domains.domain_hidden_buf = buf_hidden;
 var buf_none = getDefaultsCtrlBuffer(actRow,actCol,"none");
 domains.domain_none_buf = buf_none;
 var buf_object = getDefaultsCtrlBuffer(actRow,actCol,"object");
 domains.domain_object_buf = buf_object;
 var buf_common = getDefaultsCommon();
 domains.domain_common_buf = buf_common;
 return domains;
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
  ctrlOption1.innerHTML = 'atomic';
  ctrlOption1.label = 'atomic';
  ctrlOption1.value = 'atomic';
  var ctrlOption2 = document.createElement('option');
  ctrlOption2.innerHTML = 'atomic_static';
  ctrlOption2.label = 'atomic_static';
  ctrlOption2.value = 'atomic_static';
  var ctrlOption3 = document.createElement('option');
  ctrlOption3.innerHTML = 'set';
  ctrlOption3.label = 'set';
  ctrlOption3.value = 'set';
  var ctrlOption4 = document.createElement('option');
  ctrlOption4.innerHTML = 'check';
  ctrlOption4.label = 'check';
  ctrlOption4.value = 'check';
  var ctrlOption5 = document.createElement('option');
  ctrlOption5.innerHTML = 'radio';
  ctrlOption5.label = 'radio';
  ctrlOption5.value = 'radio';
  var ctrlOption6 = document.createElement('option');
  ctrlOption6.innerHTML = 'multiple';
  ctrlOption6.label = 'multiple';
  ctrlOption6.value = 'multiple';
  var ctrlOption7 = document.createElement('option');
  ctrlOption7.innerHTML = 'password';
  ctrlOption7.label = 'password';
  ctrlOption7.value = 'password';
  var ctrlOption8 = document.createElement('option');
  ctrlOption8.innerHTML = 'file';
  ctrlOption8.label = 'file';
  ctrlOption8.value = 'file';
  var ctrlOption9 = document.createElement('option');
  ctrlOption9.innerHTML = 'hidden';
  ctrlOption9.label = 'hidden';
  ctrlOption9.value = 'hidden';
  var ctrlOption10 = document.createElement('option');
  ctrlOption10.innerHTML = 'none';
  ctrlOption10.label = 'none';
  ctrlOption10.value = 'none';
  var ctrlOption11 = document.createElement('option');
  ctrlOption11.innerHTML = 'object';
  ctrlOption11.label = 'object';
  ctrlOption11.value = 'object';
  ctrlSelect.appendChild(ctrlOption1);
  ctrlSelect.appendChild(ctrlOption2);
  ctrlSelect.appendChild(ctrlOption3);
  ctrlSelect.appendChild(ctrlOption4);
  ctrlSelect.appendChild(ctrlOption5);
  ctrlSelect.appendChild(ctrlOption6);
  ctrlSelect.appendChild(ctrlOption7);
  ctrlSelect.appendChild(ctrlOption8);
  ctrlSelect.appendChild(ctrlOption9);
  ctrlSelect.appendChild(ctrlOption10);
  ctrlSelect.appendChild(ctrlOption11);
  ctrlSelect.onchange = function()
  {
  	$(this).data('buffer').domain = this.value;
  	$(this).data('buffer')["domain_" + this.value + "_buf"].domain = this.value;
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
  var bufObj = getDefaultsDomainBuffer(actRow,pos1);
  bufObj.domain = actSelectedItem;
  $('#ctrl_id_' + actRow + '_' + pos1).data('buffer',bufObj);
}

//
//
//
function setNameInCtrlBuffer(actBuf,actName)
{
 actBuf['domain_atomic_buf'].name = actName;
 actBuf['domain_atomic_static_buf'].name = actName;
 actBuf['domain_set_buf'].name = actName;
 actBuf['domain_check_buf'].name = actName;
 actBuf['domain_radio_buf'].name = actName;
 actBuf['domain_multiple_buf'].name = actName;
 actBuf['domain_password_buf'].name = actName;
 actBuf['domain_file_buf'].name = actName;
 actBuf['domain_hidden_buf'].name = actName;
 actBuf['domain_none_buf'].name = actName;
 actBuf['domain_object_buf'].name = actName;
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
   $(this).find('select').data('buffer',setNameInCtrlBuffer($(this).find('select').data('buffer'),name));   
   //$(this).find('select').data('buffer')['domain_' + domain + '_buf'].name = 
   //name;
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

function add_row_to_grid(actSelectedItem)
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
  ctrlOption1.innerHTML = 'atomic';
  ctrlOption1.label = 'atomic';
  ctrlOption1.value = 'atomic';
  var ctrlOption2 = document.createElement('option');
  ctrlOption2.innerHTML = 'atomic_static';
  ctrlOption2.label = 'atomic_static';
  ctrlOption2.value = 'atomic_static';
  var ctrlOption3 = document.createElement('option');
  ctrlOption3.innerHTML = 'set';
  ctrlOption3.label = 'set';
  ctrlOption3.value = 'set';
  var ctrlOption4 = document.createElement('option');
  ctrlOption4.innerHTML = 'check';
  ctrlOption4.label = 'check';
  ctrlOption4.value = 'check';
  var ctrlOption5 = document.createElement('option');
  ctrlOption5.innerHTML = 'radio';
  ctrlOption5.label = 'radio';
  ctrlOption5.value = 'radio';
  var ctrlOption6 = document.createElement('option');
  ctrlOption6.innerHTML = 'multiple';
  ctrlOption6.label = 'multiple';
  ctrlOption6.value = 'multiple';
  var ctrlOption7 = document.createElement('option');
  ctrlOption7.innerHTML = 'password';
  ctrlOption7.label = 'password';
  ctrlOption7.value = 'password';
  var ctrlOption8 = document.createElement('option');
  ctrlOption8.innerHTML = 'file';
  ctrlOption8.label = 'file';
  ctrlOption8.value = 'file';
  var ctrlOption9 = document.createElement('option');
  ctrlOption9.innerHTML = 'hidden';
  ctrlOption9.label = 'hidden';
  ctrlOption9.value = 'hidden';
  var ctrlOption10 = document.createElement('option');
  ctrlOption10.innerHTML = 'none';
  ctrlOption10.label = 'none';
  ctrlOption10.value = 'none';
  var ctrlOption11 = document.createElement('option');
  ctrlOption11.innerHTML = 'object';
  ctrlOption11.label = 'object';
  ctrlOption11.value = 'object';
  ctrlSelect.appendChild(ctrlOption1);
  ctrlSelect.appendChild(ctrlOption2);
  ctrlSelect.appendChild(ctrlOption3);
  ctrlSelect.appendChild(ctrlOption4);
  ctrlSelect.appendChild(ctrlOption5);
  ctrlSelect.appendChild(ctrlOption6);
  ctrlSelect.appendChild(ctrlOption7);
  ctrlSelect.appendChild(ctrlOption8);
  ctrlSelect.appendChild(ctrlOption9);
  ctrlSelect.appendChild(ctrlOption10);
  ctrlSelect.appendChild(ctrlOption11);
  ctrlSelect.onchange = function(){
  	$(this).data('buffer').domain = this.value;
  	$(this).data('buffer')["domain_" + this.value + "_buf"].domain = this.value;
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
  {add_column_to_grid_row(pos1,'atomic');};
  ctrlDiv.appendChild(ctrlDiv1);
  ctrlDiv.appendChild(ctrlSpan);
  ctrlDiv.appendChild(ctrlButton1);
  var bufObj = getDefaultsDomainBuffer(pos1,pos2);
  bufObj.domain = 'atomic';
  $('#ctrl_id_' + pos1 + '_' + pos2).data('buffer',bufObj);
}


//
// Funzione associata ad evento onclick dell'icona di cancellazione riga
// Nome esplicativo della funzionalità effettuata.
//
function delete_row(actRow)
{
	//console.log($('#gridView_id > div'));
  if(actRow>=0)
  {	  
   $('#gridView_row_id_' + actRow).remove();
   $('#delete_row_id_' + actRow).remove();
  }
  //console.log($('#gridView_id > div'));
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
  	 		add_column_to_grid_row(row,'atomic')
  	 	 };
  	 	ctCol++;
  	 });

  	 ctCol1=0;

  	 $(this).children('div').each(function(index){
  	 	//console.log($(this).get(0));
  	 $(this).get(0).id = 'gridView_column_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').get(0).id = 'gridView_ctrl_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('select').get(0).id = 'ctrl_id_' + ctRow1 + '_' + ctCol1;
     $(this).children('div').children('select').data('buffer').name = 'ctrl_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('button').get(0).id = 'open_ctrl_id_' + ctRow1 + '_' + ctCol1;
  	 $(this).children('div').children('img').get(0).id = 'delete_column_id_' + ctRow1 + '_' + ctCol1;
  	 domain = $('#ctrl_id_' + ctRow1 + '_' + ctCol1).data('buffer').domain;
  	 $('#ctrl_id_' + ctRow1 + '_' + ctCol1).data('buffer')['domain_' + domain + '_buf'].name = 
  	 'campo_' + ctRow1 + '_' + ctCol1;
  	 $('#open_ctrl_id_' + ctRow1 + '_' + ctCol1).get(0).onclick = function(){els = this.id.split('_');
  	 	var row = els[3];
  	 	var col = els[4];
  	 	open_ctrl_edit(row,col);};
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

function getRowClassPostStr()
{
 var rowClass = [];
 var dimY = detectDimY();
 for(i=0;i<=dimY-1;i++)
 {
  ctrlId = i + '_0';
 	rowClass[i] = $('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].rowClass;
 }
 return rowClass.toString();
}

function getRowStylePostStr()
{
 var rowStyle = [];
 var dimY = detectDimY();
 for(i=0;i<=dimY-1;i++)
 {
  ctrlId = i + '_0';
 	rowStyle[i] = $('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].rowStyle;
 }
 return rowStyle.toString();
}

function save_button_onClick()
{
	var postStr ='pagina=' + encodeURIComponent($('#Pagine').val().replace(/\s*/g,'')) + '&';
	var formVal = $('#Forms').val().replace(/\s*/g,'');
	postStr += 'forms=' + encodeURIComponent(formVal) + '&';
	var op = $('#Op').val().replace(/\s*/g,'');
	postStr += 'op=' + encodeURIComponent(op) + '&';
	var num = $('#Num').val().replace(/\s*/g,'');
	postStr += 'num=' + encodeURIComponent(num) + '&';
  var shortName = $('#ShortName').val().replace(/\s*/g,'');
  postStr += 'shortName=' + encodeURIComponent(shortName) + '&';
	var  interfaceFree = ($('#CheckBox_IFreeName').get(0).checked?'true':'false');
  postStr += 'checkBox_IFreeName=' + encodeURIComponent(interfaceFree) + '&';
  var ctrlId = getFirstCtrlIdIndex();
  completeGridWithNone();
  var domain = $('#ctrl_id_' + ctrlId).data('buffer').domain;
  if(ctrlId != null)
  {
   postStr += 'rowClass=' + encodeURIComponent(getRowClassPostStr()) + '&';  
   postStr += 'rowsClass=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].rowsClass) + '&';
   postStr += 'rowStyle=' + encodeURIComponent(getRowStylePostStr()) + '&';
   postStr += 'rowsStyle=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer' )["domain_common_buf"].rowsStyle) + '&';   
   postStr += 'cellPadding=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].cellPadding) + '&';
   postStr += 'cellSpacing=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].cellSpacing) + '&';
   postStr += 'labelSpacerWidth=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].labelSpacerWidth) + '&';
   postStr += 'javascriptEnabled=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].javascriptEnabled) + '&';
   postStr += 'bootstrapEnabled=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].bootstrapEnabled) + '&';
   postStr += 'style=' +
   encodeURIComponent($('#ctrl_id_' + ctrlId).data('buffer')["domain_common_buf"].style) + '&';
  }
  else
  {
   postStr += 'rowClass=&';
   postStr += 'rowsClass=&';
   postStr += 'rowStyle=&';
   postStr += 'rowsStyle=&';
   postStr += 'cellPadding=&';
   postStr += 'cellSpacing=&';
   postStr += 'labelSpacerWidth=1&';
   postStr += 'javascriptEnabled=true&';
   postStr += 'bootstrapEnabled=true&';
   postStr += 'style=&';
  }
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
  		var domain = $('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer').domain;
  		var buf = $('#ctrl_id_' + ctRow + '_' + ctCol).data('buffer')['domain_' + domain + '_buf'];
  		ct=0;
  		postStr += 'ctrlId_' + ctRec + '=ctrl_' + ctRow + '_' + ctCol + '&';
  		var numBufEls = util.length(buf);

  		for(var ind in buf)
  		{
  			var item = buf[ind];
  			if((util.is_array(item))||(util.is_object(item)))
		    {
  			 item1 = item.toString();
			// console.log("EEEEEEEEE1");
			// console.log(ind);
			// console.log(item);
			// console.log(item1);
			// console.log(util.is_object(item));
			// console.log("EEEEEEEEE2");
			}
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

 // console.log(postStr1);

  if(numRows > 0)
  {
	 ajaxHandler.synServerPostCall('ajax_handler.php','saveFormSection','',postStr1,'text');
  }
}

function button_form_section_preview_onClick(actObj)
{
 var appName = $('#active_application_id').text();
 var pagina = $('#Pagine').val();
 var op = $('#Op').val().replace(/\s*/g,'');
 var num = $('#Num').val().replace(/\s*/g,'');
 var shortName = $('#ShortName').val().replace(/\s*/g,'');
 var intName = $('#Forms').val().replace(/\s*/g,'');
 var intNameRegExp = /([A-Z][a-z_0-9]*)!([A-Za-z]?[a-z_0-9]*)!([A-Z]*[a-z_0-9]*)!([a-z][a-z_0-9]*)!([A-Z]?[a-z_0-9]*)!([0-9]+)/;
 var result = intName.match(intNameRegExp);
 if(result != null)
 {
 	var objName = result[3];  
 } 

 if(num=='')
 	num='0';

 	var formFileName = $('#Forms').val().replace(/\s*/g,'');
 	formFileNameItems = formFileName.split('.');
 	if(formFileNameItems.length==2)
 	 formSuffix = '.' + formFileNameItems[1];
 	else
 	 formSuffix = ''; 

 if((shortName=='')||(! $('#CheckBox_IFreeName').get(0).checked))
   var interfaccia=appName + '!' + pagina + '!' + objName + '!form_section!' + op +
   '!' + num + formSuffix;
 else
   interfaccia = shortName;

 var serverName = interfacesContainer.getInterface('Op2').getServerName();
 var docRoot = interfacesContainer.getInterface('Op2').getDocRoot();
 preview_exec(interfaccia,appName,serverName,docRoot);
 return;
}

function preview_exec(actInt,actActiveApp,actServerName,actDocRoot)
{
	var intr = actInt;
	if(intr.replace(/\s*/g,'')=='')
	{
		alert(loc.getString('msg',56));
		return false;
  }

  var crEnabled = 1;
  var dojoEnabled = 1;
  var jqueryEnabled = 1;
  var dataPageEnabled = 1;

  intr = intr + ';' + crEnabled + ';' + dojoEnabled + ';' +
  jqueryEnabled + ';' + dataPageEnabled ;
  ajaxHandler.synServerCall('ajax_handler.php','createPreview',intr,'text',/[.]*\w[.]*/);

  var dirName=actActiveApp;
  if(dirName!='')
    window.open('http://' + actServerName +
   '/' + actDocRoot + '/' + dirName +
   '/' + 'preview.php');

  return false;
}
