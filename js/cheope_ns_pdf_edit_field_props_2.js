function addXCoord(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_xcoord = document.createElement('div');
 div_label_xcoord.id = 'div_label_xcoord_id';
 $('#' + actId).append(div_label_xcoord);
 var label_xcoord = document.createElement('label');
 label_xcoord.innerHTML = 'XCoord';
 label_xcoord.id = 'label_xcoord_id';
 $('#label_xcoord').attr('for','input_xcoord_id');
 $('#div_label_xcoord_id').append(label_xcoord);
 $('#div_label_xcoord_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_xcoord_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_xcoord_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_xcoord_id').append(input);
 $('#input_xcoord_id').data('info','xCoord');
 $('#input_xcoord_id').addClass('props');
 return; 	
}

function addYCoord(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_ycoord = document.createElement('div');
 div_label_ycoord.id = 'div_label_ycoord_id';
 $('#' + actId).append(div_label_ycoord);
 var label_ycoord = document.createElement('label');
 label_ycoord.innerHTML = 'YCoord';
 label_ycoord.id = 'label_ycoord_id';
 $('#label_ycoord').attr('for','input_ycoord_id');
 $('#div_label_ycoord_id').append(label_ycoord);
 $('#div_label_ycoord_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_ycoord_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_ycoord_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_ycoord_id').append(input);
 $('#input_ycoord_id').data('info','yCoord');
 $('#input_ycoord_id').addClass('props');
 return; 	
}

function addHeight(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_height = document.createElement('div');
 div_label_height.id = 'div_label_height_id';
 $('#' + actId).append(div_label_height);
 var label_height = document.createElement('label');
 label_height.innerHTML = 'Height';
 label_height.id = 'label_height_id';
 $('#label_height').attr('for','input_height_id');
 $('#div_label_height_id').append(label_height);
 $('#div_label_height_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_height_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_height_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_height_id').append(input);
 $('#input_height_id').data('info','height');
 $('#input_height_id').addClass('props');
 return; 	
}

function addFont(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_font = document.createElement('div');
 div_label_font.id = 'div_label_font_id';
 $('#' + actId).append(div_label_font);
 var label_font = document.createElement('label');
 label_font.innerHTML = 'Font';
 label_font.id = 'label_font_id';
 $('#label_font').attr('for','input_font_id');
 $('#div_label_font_id').append(label_font);
 $('#div_label_font_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_font_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_font_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_font_id').append(input);
 $('#input_font_id').data('info','font');
 $('#input_font_id').addClass('props');
 return; 	
}

function addFontStyle(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_fontStyle = document.createElement('div');
 div_label_fontStyle.id = 'div_label_fontStyle_id';
 $('#' + actId).append(div_label_fontStyle);
 var label_fontStyle = document.createElement('label');
 label_fontStyle.innerHTML = 'FontStyle';
 label_fontStyle.id = 'label_fontStyle_id';
 $('#label_fontStyle').attr('for','input_fontStyle_id');
 $('#div_label_fontStyle_id').append(label_fontStyle);
 $('#div_label_fontStyle_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_fontStyle_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_fontStyle_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_fontStyle_id').append(input);
 $('#input_fontStyle_id').data('info','fontStyle');
 $('#input_fontStyle_id').addClass('props');
 return; 	
}

function addFontSize(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_fontSize = document.createElement('div');
 div_label_fontSize.id = 'div_label_fontSize_id';
 $('#' + actId).append(div_label_fontSize);
 var label_fontSize = document.createElement('label');
 label_fontSize.innerHTML = 'FontSize';
 label_fontSize.id = 'label_fontSize_id';
 $('#label_fontSize').attr('for','input_fontSize_id');
 $('#div_label_fontSize_id').append(label_fontSize);
 $('#div_label_fontSize_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_fontSize_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_fontSize_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_fontSize_id').append(input);
 $('#input_fontSize_id').data('info','fontSize');
 $('#input_fontSize_id').addClass('props');
 return; 	
}

function addLabelName(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_labelName = document.createElement('div');
 div_label_labelName.id = 'div_label_labelName_id';
 $('#' + actId).append(div_label_labelName);
 var label_labelName = document.createElement('label');
 label_labelName.innerHTML = 'LabelName';
 label_labelName.id = 'label_labelName_id';
 $('#label_labelName').attr('for','input_labelName_id');
 $('#div_label_labelName_id').append(label_labelName);
 $('#div_label_labelName_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_labelName_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_labelName_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_labelName_id').append(input);
 $('#input_labelName_id').data('info','labelName');
 $('#input_labelName_id').addClass('props');
 return; 	
}

function addWidth(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_width = document.createElement('div');
 div_label_width.id = 'div_label_width_id';
 $('#' + actId).append(div_label_width);
 var label_width = document.createElement('label');
 label_width.innerHTML = 'Width';
 label_width.id = 'label_width_id';
 $('#label_width').attr('for','input_width_id');
 $('#div_label_width_id').append(label_width);
 $('#div_label_width_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_width_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_width_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_width_id').append(input);
 $('#input_width_id').data('info','width');
 $('#input_width_id').addClass('props');
 return; 	
}

function addFileName(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_fileName = document.createElement('div');
 div_label_fileName.id = 'div_label_fileName_id';
 $('#' + actId).append(div_label_fileName);
 var label_fileName = document.createElement('label');
 label_fileName.innerHTML = 'FileName';
 label_fileName.id = 'label_fileName_id';
 $('#label_fileName').attr('for','input_fileName_id');
 $('#div_label_fileName_id').append(label_fileName);
 $('#div_label_fileName_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_fileName_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_fileName_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_fileName_id').append(input);
 $('#input_fileName_id').data('info','fileName');
 $('#input_fileName_id').addClass('props');
 return; 	
}

function addFileType(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_fileType = document.createElement('div');
 div_label_fileType.id = 'div_label_fileType_id';
 $('#' + actId).append(div_label_fileType);
 var label_fileType = document.createElement('label');
 label_fileType.innerHTML = 'FileType';
 label_fileType.id = 'label_fileType_id';
 $('#label_fileType').attr('for','input_fileType_id');
 $('#div_label_fileType_id').append(label_fileType);
 $('#div_label_fileType_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_fileType_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_fileType_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_fileType_id').append(input);
 $('#input_fileType_id').data('info','fileType');
 $('#input_fileType_id').addClass('props');
 return; 	
}

function updateInfoBuf(actId,actBuf)
{
 $('#' + actId + ' .props').each(function(){
 	var nomeCtrl = $(this).data('info');
 	if((nomeCtrl !== undefined) && (util.itemInArrayKeys(nomeCtrl,actBuf)))
 	{
 	 actBuf[nomeCtrl] = $(this).data('value');
 	}
 	});
 	return actBuf;
}

function getIntBufFromGlobalBuffer(actBuffer)
{
	var intType = actBuffer.type;
	var buf = actBuffer[intType + '_buf'];
	//console.log(buf);
	return buf;	
}

// Riempie il buffer 'value' associato ai campi dati.
//
function loadCtrlsFromBuf(actId,actBuffer)
{
	//console.log(actBuffer);
	var buf = getIntBufFromGlobalBuffer(actBuffer);
	//console.log(intType);
  $('#' + actId + ' .props').each(function(){
  var nomeCtrl = $(this).data('info');	
 	if(nomeCtrl !== undefined) 
 	{ 	     
 	 if(! util.is_array(buf[nomeCtrl])) 	     
 	  $(this).get(0).value = buf[nomeCtrl];
 	 $(this).data('value',buf[nomeCtrl]);
 	}
 	});
}

// Riempie un buffer con il buffer 'value' di ogni campo
// e poi lo salva nel buffer globale.
//
function saveFieldsProps()
{
 var global_buf = window.returnVal;
 var intType = global_buf.type;
 var buf1 = global_buf[intType + '_buf'];
 var buf2 = updateInfoBuf('html_tags__0',buf1);
 //console.log('---');
   console.log(buf2.labelName); 
 //console.log('---');
 global_buf[intType + '_buf'] = buf2;
 window.returnVal = global_buf;
 return;
}






