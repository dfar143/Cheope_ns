function addNameField(actId)
{
 var br0 = document.createElement('br');
 $('#' + actId).append(br0);
 var div_label_name = document.createElement('div');
 div_label_name.id = 'div_label_name_id';
 $('#' + actId).append(div_label_name);
 var label_name = document.createElement('label');
 label_name.innerHTML = 'Name';
 label_name.id = 'label_name_id';
 $('#label_name').attr('for','input_name_id');
 $('#div_label_name_id').append(label_name);
 $('#div_label_name_id').attr('style','width:100px;float:left;');
 var div_input = document.createElement('div');
 div_input.id = 'div_input_name_id';
 $('#' + actId).append(div_input);
 var input = document.createElement('input');
 input.id = 'input_name_id';
 input.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#div_input_name_id').append(input);
 $('#input_name_id').data('info','name');
 $('#input_name_id').addClass('props');
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

function saveSectionInfoIntoSectionDomainBuf(actId)
{
 var domain = $('#select_domain_id').data('value');
 var buf1 = $('#' + actId).data(domain);
 var buf2 = updateInfoBuf(actId,buf1);
 $('#' + actId).data(domain,buf2);
}

function loadSectionCtrlsFromSectionDomainBuf(actId,actDomain)
{
	var buf = $('#' + actId).data(actDomain);
	var domain = buf.domain;
  $('#' + actId + ' .props').each(function(){
  var nomeCtrl = $(this).data('info');	
 	if(nomeCtrl !== undefined) 
 	{
 		
 	 if(nomeCtrl == 'fieldEvents')
 	 {
 	 	var select = $(this).get(0);
 	 	var opts = select.options;
 	 	var firstOpt = opts.item(0);
 	 	var vals = buf[nomeCtrl];
 	 	if(vals.length==0)
 	 	{
 	 	 var option = document.createElement('option');
 	   option.value = '';
 	   option.label = '';
 	   option.text = '';
     select.add(option,firstOpt);  	 	 
 	 	}
 	 	else
 	 	{
 	 	 for (var val in vals)
 	 	 {
 	 	 	var option = document.createElement('option');
      if((vals[val]==undefined) || (vals[val].length == 0))
      {
 	     option.value = '';
 	     option.label = '';
 	     option.text = '';
       select.add(option,firstOpt); 
      }
      else
      {
 	 	   option.label = vals[val];
 	 	   option.value = vals[val];
 	 	   option.text = vals[val];
 	 		 select.add(option,firstOpt);
 	 	  }
     }
 	  }
 	 	select.selectedIndex = 0;
 	 	$(this).data('value',vals);
 	 }
 	 else 
 	 	if(nomeCtrl == 'fieldType')
 	  {
 	 	 var select = $(this).get(0);
     var val = buf[nomeCtrl];
     var opts = select.options;
     var num = opts.length;
     for (var i=0;i<=num-1;i++)
     {
     	var option = opts.item(i); 
    	if(option.label==val)
    	{
    	 select.selectedIndex = i;
    	 break;
    	}
     } 
     $(this).data('value',val);	 	
 	  }
 	  else
 	   if(nomeCtrl == 'label')
 	   {
 	 	   var select = $(this).get(0);
 	 	   var opts = select.options;
 	 	   var firstOpt = opts.item(0);
 	 	   var vals = buf[nomeCtrl];
 	 	   if(vals.length==0)
 	 	   {
 	 	    var option = document.createElement('option');
 	      option.value = '';
 	      option.label = '';
 	      option.text = '';
        select.add(option,firstOpt);  	 	 
 	 	   }
 	 	   else
 	 	   {
 	 	    for (var val in vals)
 	 	    {
 	 	 	   var option = document.createElement('option');
         if((vals[val]==undefined) || (vals[val].length == 0))
         {
 	        option.value = '';
 	        option.label = '';
 	        option.text = '';
          select.add(option,firstOpt); 
         }
         else
         {
 	 	      option.label = vals[val];
 	 	      option.value = vals[val];
 	 	      option.text = vals[val];
 	 		    select.add(option,firstOpt);
 	 	     }
 	 	    } 
 	 	   }	  		
 	   }
 	   else
 	    if(nomeCtrl == 'fieldDirection')
 	    {
 	 	   var select = $(this).get(0);
 	 	   var opts = select.options;
 	 	   var firstOpt = opts.item(0);
 	 	   var vals = buf[nomeCtrl];
 	 	   if(vals.length==0)
 	 	   {
 	 	    var option = document.createElement('option');
 	      option.value = '';
 	      option.label = '';
 	      option.text = '';
        select.add(option,firstOpt);  	 	 
 	 	   }
 	 	   else
 	 	   {
 	 	    for (var val in vals)
 	 	    {
 	 	 	   var option = document.createElement('option');
         if((vals[val]==undefined) || (vals[val].length == 0))
         {
 	        option.value = '';
 	        option.label = '';
 	        option.text = '';
          select.add(option,firstOpt); 
         }
         else
         {
 	 	      option.label = vals[val];
 	 	      option.value = vals[val];
 	 	      option.text = vals[val];
 	 		    select.add(option,firstOpt);
 	 	     }
 	 	    } 
 	 	   }	  		
 	    }
 	    else 	   	
 	     if((nomeCtrl == 'domainValue')&&((domain == 'set')||(domain =='multiple')||(domain=='radio')))
 	  	 {
 	 	   var select = $(this).get(0);
 	 	   var opts = select.options;
 	 	   var firstOpt = opts.item(0);
 	 	   var vals = buf[nomeCtrl];
 	 	   if(vals.length==0)
 	 	   {
 	 	    var option = document.createElement('option');
 	      option.value = '';
 	      option.label = '';
 	      option.text = '';
        select.add(option,firstOpt);  	 	 
 	 	   }
 	 	   else
 	 	   {
 	 	    for (var val in vals)
 	 	    {
 	 	 	   var option = document.createElement('option');
         if((vals[val]==undefined) || (vals[val].length == 0))
         {
 	        option.value = '';
 	        option.label = '';
 	        option.text = '';
          select.add(option,firstOpt); 
         }
         else
         {
 	 	      option.label = vals[val];
 	 	      option.value = vals[val];
 	 	      option.text = vals[val];
 	 		    select.add(option,firstOpt);
 	 	     }
 	 	    }
 	  	 }
 	  	 }
 	    
 	  if(! util.is_array(buf[nomeCtrl])) 
 	   $(this).get(0).value = buf[nomeCtrl];
 	  $(this).data('value',buf[nomeCtrl]);
 	}
 	});	
}

function getDomainBufFromGlobalBuffer(actBuffer)
{
	var domain = actBuffer.domain;
	var buf = actBuffer['domain_' + domain + '_buf'];
	//console.log(buf);
	return buf;	
}

function getCommonBufFromGlobalBuffer(actBuffer)
{
	var buf = actBuffer['domain_common_buf'];
	//console.log(buf);
	return buf;	
}

function loadSectionCtrlsFromBuf(actId,actBuffer)
{
	//console.log(actBuffer);
	var buf = getDomainBufFromGlobalBuffer(actBuffer);
	var domain = actBuffer.domain;
	//console.log(buf);
  $('#' + actId + ' .props').each(function(){
  var nomeCtrl = $(this).data('info');	
 	if(nomeCtrl !== undefined) 
 	{
 		
 	 if(nomeCtrl == 'fieldEvents')
 	 {
 	 	var select = $(this).get(0);
 	 	var opts = select.options;
 	 	var firstOpt = opts.item(0);
 	 	var vals = buf[nomeCtrl];
	 	if(vals.length==0)
 	 	{
 	 	 var option = document.createElement('option');
 	   option.value = '';
 	   option.label = '';
 	   option.text = '';
     select.add(option,firstOpt);  	 	 
 	 	}
 	 	else
 	 	{
 	 	 for (var val in vals)
 	 	 { 
 	 	 	var option = document.createElement('option');
      if((vals[val]==undefined) || (vals[val].length == 0))
      {
 	     option.value = '';
 	     option.label = '';
 	     option.text = '';
       select.add(option,firstOpt); 	
      }
      else
      { 
 	 	   option.label = vals[val];
 	 	   option.value = vals[val];
 	 	   option.text = vals[val];
 	 		 select.add(option,firstOpt);
 	 	  }
 	 	 }
 	  }
 	 	$(this).data('value',vals);
 	 }
 	 else 
 	 	if(nomeCtrl == 'fieldType')
 	  {
 	 	 var select = $(this).get(0);
     var val = buf[nomeCtrl];
     var opts = select.options;
     //console.log('AAA');
     //console.log(opts.item(0));
     //console.log('BBB');
     var num = opts.length;
     for (var i=0;i<=num-1;i++)
     {
     	var option = opts.item(i); 
    	if(option.label==val)
    	{
    	 select.selectedIndex = i;
    	 break;
    	}
     } 
     $(this).data('value',val); 	 	
 	  } 
 	  else 
 	  if(nomeCtrl == 'fieldMandatory')
 	  {
 	 	 var select = $(this).get(0);
     var val = buf[nomeCtrl];
     var opts = select.options;
     var num = opts.length;
     for (var i=0;i<=num-1;i++)
     {
     	var option = opts.item(i); 
    	if(option.label==val)
    	{
    	 select.selectedIndex = i;
    	 break;
    	}
     } 
     $(this).data('value',val); 	 	
 	  }
    else
 	   if(nomeCtrl == 'fieldDirection')
 	   {
 	 	  var select = $(this).get(0);
      var val = buf[nomeCtrl];
      var opts = select.options;
      var num = opts.length;
      for (i=0;i<=num-1;i++)
      {
     	 var option = opts.item(i); 
    	 if(option.label==val)
    	 {
    	  select.selectedIndex = i;
    	  break;
    	 }
      } 
      $(this).data('value',val); 	 	
 	   }
 	   else
      if(nomeCtrl == 'label')
      {
 	 	  var select = $(this).get(0);
 	 	  var opts = select.options;
 	 	  var firstOpt = opts.item(0);
 	 	  var vals = buf[nomeCtrl];
	 	  if(vals.length==0)
 	 	  {
 	 	   var option = document.createElement('option');
 	     option.value = '';
 	     option.label = '';
 	     option.text = '';
       select.add(option,firstOpt);  	 	 
 	 	  }
 	 	  else
 	 	  {
 	 	   for (var val in vals)
 	 	   { 
 	 	 	  var option = document.createElement('option');
        if((vals[val]==undefined) || (vals[val].length == 0))
        {
 	       option.value = '';
 	       option.label = '';
 	       option.text = '';
         select.add(option,firstOpt); 	
        }
        else
        { 
 	 	     option.label = vals[val];
 	 	     option.value = vals[val];
 	 	     option.text = vals[val];
 	 		   select.add(option,firstOpt);
 	 	    }
 	 	   }
 	 	  }     	
      }
 	    else
 	     if((nomeCtrl == 'domainValue')&&((domain == 'set')||(domain =='multiple')||(domain=='radio')))
 	     {  
 	 	   var select = $(this).get(0);
 	 	   var opts = select.options;
 	 	   var firstOpt = opts.item(0);
 	 	   var vals = buf[nomeCtrl];
	 	   if(util.count(vals)==0)
 	 	   {
 	 	    var option = document.createElement('option');
 	      option.value = '';
 	      option.label = '';
 	      option.text = '';
        select.add(option,firstOpt);  	 	 
 	 	   }
 	 	   else
 	 	   {
 	 	    for (var val in vals)
 	 	    { 
 	 	 	   var option = document.createElement('option');
         if((vals[val]==undefined) || (vals[val].length == 0))
         {
 	        option.value = '';
 	        option.label = '';
 	        option.text = '';
          select.add(option,firstOpt); 	
         }
         else
         {   
 	 	      option.label = vals[val];
 	 	      option.value = vals[val];
 	 	      option.text = vals[val];
 	 		    select.add(option,firstOpt);
 	 	     }
 	 	    }  
 	     }
 	 	   $(this).data('value',vals);
 	     }
 	     
 	    if(! util.is_array(buf[nomeCtrl])) 	     
 	     $(this).get(0).value = buf[nomeCtrl];
 	    $(this).data('value',buf[nomeCtrl]);
 	     
 	 }
 	});
}

function getCommonBuffer(actId)
{
 return $('#' + actId).data('common');	
}


function loadCommonsCtrlsFromCommonBuf(actId,actBuffer)
{
	var buf = actBuffer['domain_common_buf'];
	//console.log(buf);
  $('#' + actId + ' .props').each(function(){
  var nomeCtrl = $(this).data('info');    	
 	if((nomeCtrl !== undefined) && (util.itemInArrayKeys(nomeCtrl,buf))) 
 	{
 	  $(this).get(0).value = buf[nomeCtrl];
 	  $(this).data('value',buf[nomeCtrl]);
 	}
 });
}

function getDefaultCommon()
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
  buf.style = "";
  
  return buf;	
}

function getDefaultBuffer()
{
	var buf = {};

	buf.name = "";
  buf.domain = "";
  buf.domainValue = "";   
  buf.fieldColStyle = "";
  buf.fieldColClass = "";
  buf.fieldLabel = "";
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


function saveBufIntoSectionDomainBuf(actId,actBuffer)
{
 var buf = getDomainBufFromGlobalBuffer(actBuffer);
 //console.log(buf);
 $('#' + actId).data(actBuffer.domain,buf);
}

function saveBufIntoCommonBuf(actId,actBuffer)
{
 var buf = getCommonBufFromGlobalBuffer(actBuffer);
 $('#' + actId).data('common',buf);
}

function setDefaultCommonBuf(actId)
{
	var buf = getDefaultCommon();
	$('#' + actId).data('common',buf);
}

function setDefaultSectionDomainBufs(actId)
{
	var buf1 = getDefaultBuffer();
	var buf2 = getDefaultBuffer();
	var buf3 = getDefaultBuffer();
	var buf4 = getDefaultBuffer();
	var buf5 = getDefaultBuffer();
	var buf6 = getDefaultBuffer();
	var buf7 = getDefaultBuffer();
	var buf8 = getDefaultBuffer();
	var buf9 = getDefaultBuffer();
	var buf10 = getDefaultBuffer();
	var buf11 = getDefaultBuffer();
  
  $('#' + actId).data('atomic',buf1);
  $('#' + actId).data('atomic_static',buf2);
  $('#' + actId).data('set',buf3);
  $('#' + actId).data('check',buf4);
  $('#' + actId).data('radio',buf5);
  $('#' + actId).data('multiple',buf6);
  $('#' + actId).data('password',buf7);
  $('#' + actId).data('file',buf8);
  $('#' + actId).data('hidden',buf9);
  $('#' + actId).data('none',buf10); 
  $('#' + actId).data('object',buf11);  
}

function changeDomainValueCtrl(actValue,actDefVal)
{
 if($('#select_domainValue_id').get(0) !== undefined)
  $('#select_domainValue_id').detach();
 else
 	$('#input_domainValue_id').detach();
 	
 $('#label_domainValue_id').detach();
 
 if ((actValue=="radio")||(actValue=="set")||(actValue=="multiple"))
 {	  
 	var select_domainValue = document.createElement('select');
 	select_domainValue.id = 'select_domainValue_id';
 	var label_domainValue = document.createElement('label');
 	  label_domainValue.id = 'label_domainValue_id';
    label_domainValue.innerHTML = 'DomainValue  ';
    $('#label_domainValue').attr('for','select_domain');
    $('#div_label_domainValue_id').append(label_domainValue);
    var div_input_domainValue_id = $('#div_input_domainValue_id').get(0);

    if(div_input_domainValue_id !== undefined)   
    { 
     $(div_input_domainValue_id).append(select_domainValue);
     $(div_input_domainValue_id).attr('id','div_select_domainValue_id');
    }
    else
    {
     $('#div_select_domainValue_id').append(select_domainValue);
    }

    $(select_domainValue).data('info','domainValue');
    $(select_domainValue).addClass('props');
 
    var option_0 = document.createElement('option');
    option_0.label = '';
    option_0.value = '';
    option_0.text = '';
    var option_1 = document.createElement('option');
    option_1.label = '';
    option_1.value = '';
    option_1.text = '';
    select_domainValue.add(option_0,null);
    select_domainValue.add(option_1,option_0);
    $(select_domainValue).attr('multiple',true); 
    
    select_domainValue.onclick = function(actObj)
    {
 	   $('#html_tags__5').data('activeOption',actObj);
 	   var divPopup = $('#html_tags__5').get(0);
 	
 	   $('#div_select_domainValue_id').append(divPopup); 
 	   var oldDivStyle = $(divPopup).attr('style');	 	
 	
 	   $(divPopup).attr('style',
 	   'position:fixed;left:400px;top:110px;' +
 	   'background-color:white;border:1px solid black;' +
 	   'width:180px;height:110px;overflow:auto;');
 	
 	   $('#textarea_1').get(0).style.display = 'inline';
 	   //console.log(actObj0.srcElement.label);
 	   
 	   var opt = 
 	   ((actObj.srcElement !== undefined)?actObj.srcElement:actObj.target);
 	   
 	   if(opt.label !== undefined)
 	    $('#textarea_1').get(0).value = opt.label;
     $(button1).attr('style','display:inline;');
     $(button2).attr('style','display:inline;');
     $(button3).attr('style','display:inline;');
    };   
  
    var select_domainValue_onchange = function()
    {
    	var select_domainValue = $('#select_domainValue_id').get(0);
 	    var opts = select_domainValue.options;
 	    var events = [];
 	    var num = opts.length;
 	    var i=0;
 	    for(var j=0;j<=num-1;j++)
 	    {
 	     if(opts.item(j).value !== undefined)
 	     {
        events[i] = opts.item(j).value;
        i++;
 	     }
 	    }
 	    $(select_domainValue).data('value',events);
 	    saveFieldsProps();
    };
   
    var select_domainValue_add = function(actVal)
    {
 	   var select_domainValue = $('#select_domainValue_id').get(0);
 	   var opts = select_domainValue.options;
 	   var events = [];
 	   var i=0;
 	   var num = opts.length;
 	   for(var j=0;j<=num-1;j++)
 	   {
 	    if(opts.item(j).value !== undefined)
 	    {
       events[i] = opts.item(j).value;
       i++;
 	    }
 	   }
 	   events[i] = actVal;
 	   var option = document.createElement('option');
 	   option.value = actVal;
 	   option.label = actVal;
 	   option.text = actVal;
 	   select_domainValue.add(option,null);
 	   $(select_domainValue).data('value',events);
 	   saveFieldsProps(); 	
    };
 
    var select_domainValue_del = function()
    {
 	   var select_domainValue = $('#select_domainValue_id').get(0);
 	   var ind = select_domainValue.selectedIndex;
 	   select_domainValue.remove(ind);
    };
 
    select_domainValue.onchange = select_domainValue_onchange;
 
    if($('#textarea_1').get(0).style.display == 'none')
    {
     var button1 = document.createElement('button');
     button1.innerHTML = 'ok.';
     button1.id = 'buttonOk';
     button1.onclick = function(){
 	   var actObj0 = $('#html_tags__5').data('activeOption');
 	   var opt = ((actObj0.srcElement)?actObj0.srcElement:actObj0.target);
 	   opt.label = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	   opt.value = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	   opt.text = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	   
 	   select_domainValue_onchange();
 	   };
     $('#html_tags__5').append(button1);
     $(button1).attr('style','display:none;'); 
 
     var button2 = document.createElement('button');
     button2.innerHTML = loc.getString('msg',83);
     button2.id = 'buttonAdd';
     button2.onclick = function(actObj1){
 	   var textAreaVal = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	   select_domainValue_add(textAreaVal);
 	   };
     $('#html_tags__5').append(button2);
     $(button2).attr('style','display:none;');  	

     var button3 = document.createElement('button');
     button3.innerHTML = loc.getString('msg',84);
     button3.id = 'buttonDel';
     button3.onclick = function(actObj1){
 	   select_domainValue_del();
 	  };
    $('#html_tags__5').append(button3);
    $(button3).attr('style','display:none;'); 
   }             	  
 }
 else
 { 	
  $('#html_tags__5').attr('style','display:none;');
  var label_domainValue = document.createElement('label');
  label_domainValue.innerHTML = 'DomainValue  ';
  label_domainValue.id = 'label_domainValue_id';
  var input_domainValue = document.createElement('input');
  input_domainValue.id = 'input_domainValue_id';
  div_input_domainValue_id = $('#div_input_domainValue_id').get(0);

  if(div_input_domainValue_id !== undefined)   
  { 
   $(div_input_domainValue_id).append(input_domainValue);
   $('#div_input_domainValue_id').attr('id','div_select_domainValue_id');
  }
  else
  {
   $('#div_select_domainValue_id').append(input_domainValue);
  }   
   
  $(input_domainValue).attr('value',actDefVal);
  $(input_domainValue).data('value',actDefVal);
  $(input_domainValue).data('info','domainValue');
  $(input_domainValue).addClass('props'); 
          
  $('#label_domainValue').attr('for','input_domainValue_id');
  $('#div_label_domainValue_id').append(label_domainValue);
  var div_label_domainValue = $('#div_label_domainValue_id').get(0);
  var div_select_domainValue = $('#div_select_domainValue_id').get(0);
  if (div_select_domainValue !== undefined)
   div_select_domainValue.id = 'div_input_domainValue_id';
  input_domainValue.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	};  
 }	
}

function addDomainField(actId,actDomain)
{
 var domain = actDomain;
 var br1 = document.createElement('br'); 
 $('#' + actId).append(br1); 
 var div_label_domain = document.createElement('div');
 div_label_domain.id = 'div_label_domain_id';
 var label_domain = document.createElement('label');
 label_domain.innerHTML = 'Domain  ';
 label_domain.id = 'label_domain_id';
 var div_select = document.createElement('div');
 div_select.id = 'div_select_id'; 
 var select = document.createElement('select');
 select.id = 'select_domain_id';
 var option_0 = document.createElement('option');
 option_0.label = 'atomic';
 option_0.value = 'atomic';
 option_0.text = 'atomic';
 var selectedIndex;
 if(domain == 'atomic') selectedIndex=0;
 var option_1 = document.createElement('option');
 option_1.label = 'atomic_static';
 option_1.value = 'atomic_static';
 option_1.text = 'atomic_static';
 if(domain == 'atomic_static') selectedIndex=1;
 var option_2 = document.createElement('option');
 option_2.label = 'set';
 option_2.value = 'set';
 option_2.text = 'set';
 if(domain == 'set') selectedIndex=2;
 var option_3 = document.createElement('option');
 option_3.label = 'check';
 option_3.value = 'check';
 option_3.text = 'check';
 if(domain == 'check') selectedIndex=3;
 var option_4 = document.createElement('option');
 option_4.label = 'radio';
 option_4.value = 'radio';
 option_4.text = 'radio';
 if(domain == 'radio') selectedIndex=4;
 var option_5 = document.createElement('option');
 option_5.label = 'multiple';
 option_5.value = 'multiple';
 option_5.text = 'multiple';
 if(domain == 'multiple') selectedIndex=5;
 var option_6 = document.createElement('option');
 option_6.label = 'password';
 option_6.value = 'password';
 option_6.text = 'password';
 if(domain == 'password') selectedIndex=6;
 var option_7 = document.createElement('option');
 option_7.label = 'file';
 option_7.value = 'file';
 option_7.text = 'file';
 if(domain == 'file') selectedIndex=7;
 var option_8 = document.createElement('option');
 option_8.label = 'hidden';
 option_8.value = 'hidden';
 option_8.text = 'hidden';
 if(domain == 'hidden') selectedIndex=8;
 var option_9 = document.createElement('option');
 option_9.label = 'none';
 option_9.value = 'none';
 option_9.text = 'none';
 if(domain == 'none') selectedIndex=9;
 var option_10 = document.createElement('option');
 option_10.label = 'object';
 option_10.value = 'object';
 option_10.text = 'object';
 if(domain == 'object') selectedIndex=10;
 select.add(option_10,null); 
 select.add(option_9,option_10);
 select.add(option_8,option_9);
 select.add(option_7,option_8);
 select.add(option_6,option_7); 
 select.add(option_5,option_6);
 select.add(option_4,option_5);
 select.add(option_3,option_4);
 select.add(option_2,option_3);
 select.add(option_1,option_2);
 select.add(option_0,option_1);
 select.selectedIndex = selectedIndex;
 select.onchange = function(){	
 	if(this.value == 'object')
 	{
   var objVal = $('#select_fieldObjName_id').attr('value');
 	}  	 	
 	else
 	 objVal = '';
 	changeDomainValueCtrl(this.value,objVal);
 	window.returnVal.domain = this.value;
 	saveSectionInfoIntoSectionDomainBuf('div_domainDip_id');
 	var defaultBuffer = getDefaultBuffer();
 	changeSectionCtrls('div_domainDip_id',this.value,defaultBuffer);
 	loadSectionCtrlsFromSectionDomainBuf('div_domainDip_id',this.value);
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 $('#' + actId).append(div_label_domain);
 $('#' + actId).append(div_select);
 $('#div_select_id').append(select); 
 $('#div_label_domain_id').append(label_domain);
 $('#div_label_domain_id').attr('style','width:100px;float:left;');
 $('#label_domain').attr('for','label_domain_id');
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_domain_id').addClass('props');
 $('#select_domain_id').data('info','domain');
 $('#select_domain_id').data('value',domain);
 return;
}

function changeSectionCtrls(actSectionId,actDomain,actBuffer)
{
  $('#' + actSectionId).children().detach();
  var divPopup0 = $('#html_tags__3').get(0);
  if(divPopup0 === undefined)
  {
   divPopup0 = document.createElement('div');
   divPopup0.id = 'html_tags__3';
   $('#html_tags__1').append(divPopup0);
   var textArea_0 = document.createElement('textarea');
   textArea_0.id = 'textarea_0';
   $(divPopup0).append(textArea_0);
   $('#textarea_0').attr('style','width:170px;height:80px;display:none;');
   $('#html_tags__5').attr('style','display:none;');
  }
  var divPopup1 = $('#html_tags__5').get(0);
  if(divPopup1 === undefined)
  {
   divPopup1 = document.createElement('div');
   divPopup1.id = 'html_tags__5';
   $('#html_tags__1').append(divPopup1);
   var textArea_1 = document.createElement('textarea');
   textArea_1.id = 'textarea_1';
   $(divPopup1).append(textArea_1);
   $('#textarea_1').attr('style','width:170px;height:80px;display:none;');
   $('#html_tags__3').attr('style','display:none;');
  }
  var domain = actDomain;
	switch(domain)
	{
	 case 'atomic':
	 {
    addFieldType(actSectionId);
    addFieldStyle(actSectionId);
    addFieldLength(actSectionId);
    addFieldStop(actSectionId);
    addFieldHint(actSectionId);
    addFieldToolTip(actSectionId); 
    addFieldEvents(actSectionId);
    addFieldRegexp(actSectionId);
    addFieldDefaultValue(actSectionId);
    addFieldMandatory(actSectionId);
    break;    
	 }
	 case 'atomic_static':
	 {
    addFieldType(actSectionId);
    addFieldStyle(actSectionId);
    addFieldToolTip(actSectionId);
    addFieldEvents(actSectionId);
    break;
	 }
	 case 'set':
	 {
    addFieldStyle(actSectionId); 
    addFieldStop(actSectionId);
    addFieldHint(actSectionId);
    addFieldToolTip(actSectionId);
    addFieldEvents(actSectionId);
    addFieldRegexp(actSectionId); 
    addFieldDefaultValue(actSectionId);  
    addFieldMandatory(actSectionId);
    break;
	 }
	 case 'check':
	 {
    addFieldStyle(actSectionId); 
    addFieldEvents(actSectionId);
    addFieldLength(actSectionId);
    addFieldToolTip(actSectionId);
    break;
	 }
	 case 'radio':
	 {
    addFieldStyle(actSectionId);
    addFieldEvents(actSectionId); 
    addFieldDefaultValue(actSectionId);
    addLabel(actSectionId);
    addFieldDirection(actSectionId);
    break; 	 	
	 }
	 case 'multiple':
	 {
    addFieldStyle(actSectionId);
    addFieldEvents(actSectionId);
    addFieldDefaultValue(actSectionId);
    addFieldLength(actSectionId);
    addFieldToolTip(actSectionId);
    break;
	 }
	 case 'password':
	 {
    addFieldStyle(actSectionId);
    addFieldEvents(actSectionId);
    addFieldDefaultValue(actSectionId);
    addFieldLength(actSectionId);
    addFieldToolTip(actSectionId);
    addFieldType(actSectionId);
    addFieldStop(actSectionId);
    addFieldRegexp(actSectionId); 
    addFieldMandatory(actSectionId);
    break;
	 }
	 case 'file':
	 {
    addFieldStyle(actSectionId);
    addFieldEvents(actSectionId); 
    addFieldDefaultValue(actSectionId);
    addFieldLength(actSectionId);
    addFieldToolTip(actSectionId);
    addFieldType(actSectionId);
    addFieldStop(actSectionId);
    addFieldMandatory(actSectionId);
    break;
	 }
	 case 'hidden':
	 {
    addFieldEvents(actSectionId);
    break;
	 }
	 case 'none':
	 {
	 	break;
	 }
	 case 'object':
	 {
	 	addFieldStyle(actSectionId);
	 	addFieldObjName(actSectionId,actBuffer.fieldObjName);
	 	break;
	 }
  }
}

function addDomainValueFieldSelect(actId)
{
 var div_label_domainValue = document.createElement('div');
 div_label_domainValue.id = 'div_label_domainValue_id';
 var label_domainValue = document.createElement('label');
 label_domainValue.innerHTML = 'DomainValue  ';
 label_domainValue.id = 'label_domainValue_id';
 var div_select_domainValue = document.createElement('div');
 div_select_domainValue.id = 'div_select_domainValue_id';
 var select_domainValue = document.createElement('select');
 select_domainValue.id = 'select_domainValue_id'; 
 $('#' + actId).append(div_label_domainValue);
 $('#' + actId).append(div_select_domainValue);
 $('#div_label_domainValue_id').append(label_domainValue);
 $('#div_select_domainValue_id').append(select_domainValue);
 $('#label_domainValue').attr('for','select_domainValue_id');
 $('#div_label_domainValue_id').attr('style','width:100px;float:left;'); 
 $('#label_domainValue').attr('for','select_domain');
 $(select_domainValue).attr('multiple',true);
  
 select_domainValue.onclick = function(actObj)
 {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
 	$('#html_tags__5').data('activeOption',actObj);
 	var divPopup = $('#html_tags__5').get(0);
 	
 	$('#div_select_domainValue_id').append(divPopup); 
 	var oldDivStyle = $(divPopup).attr('style');	 	
 	
 	$(divPopup).attr('style',
 	'position:fixed;left:400px;top:110px;' +
 	'background-color:white;border:1px solid black;' +
 	'width:180px;height:110px;overflow:auto;');
 	
 	$('#textarea_1').get(0).style.display = 'inline';
 	var option = this.options.item(this.selectedIndex);
 	if(option.label !== undefined)
 	 $('#textarea_1').get(0).value = option.label;
  $(button1).attr('style','display:inline;');
  $(button2).attr('style','display:inline;');
  $(button3).attr('style','display:inline;');
 };   
  
 var select_domainValue_onchange = function()
 {
 	var select_domainValue = $('#select_domainValue_id').get(0);
 	var opts = $('#select_domainValue_id').get(0).options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_domainValue).data('value',events);
 	saveFieldsProps();
 };
 
 var select_domainValue_add = function(actVal)
 {
 	var select_domainValue = $('#select_domainValue_id').get(0);
 	var opts = select_domainValue.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	events[i] = actVal;
 	var option = document.createElement('option');
 	option.value = actVal;
 	option.label = actVal;
 	option.text = actVal;
 	select_domainValue.add(option,null);
 	$(select_domainValue).data('value',events);
 	saveFieldsProps(); 	
 }
 
 var select_domainValue_del = function()
 {
 	var select_domainValue = $('#select_domainValue_id').get(0);
 	var ind = select_domainValue.selectedIndex;
 	select_domainValue.remove(ind);
 	var opts = select_domainValue.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_domainValue).data('value',events);
 	saveFieldsProps();
 }
 
 select_domainValue.onchange = select_domainValue_onchange;
 
 var button1 = document.createElement('button');
 button1.innerHTML = 'ok.';
 button1.id = 'buttonOk';
 button1.onclick = function(){
 	 var obj0 = $('#html_tags__5').data('activeOption');
 	 var option = ((obj0.srcElement !== undefined)?obj0.srcElement:obj0.target);
 	 option.label = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	 option.value = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	 option.text = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	 $(select_domainValue).click();
 	 select_domainValue_onchange();
 	 };
 $('#html_tags__5').append(button1);
 $(button1).attr('style','display:none;'); 
 
 var button2 = document.createElement('button');
 button2.innerHTML = loc.getString('msg',83);
 button2.id = 'buttonAdd';
 button2.onclick = function(actObj1){
 	 var textAreaVal = $('#textarea_1').get(0).value.replace(/\n/g,"");
 	 select_domainValue_add(textAreaVal);
 	 };
 $('#html_tags__5').append(button2);
 $(button2).attr('style','display:none;');  	

 var button3 = document.createElement('button');
 button3.innerHTML = loc.getString('msg',84);
 button3.id = 'buttonDel';
 button3.onclick = function(actObj1){
 	 select_domainValue_del();
 	 };
 $('#html_tags__5').append(button3);
 $(button3).attr('style','display:none;');  	
 	 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#select_domainValue_id').addClass('props');
 $('#select_domainValue_id').data('info','domainValue'); 
}
 
 
function addDomainValueFieldInput(actId)
{
 var div_label_domainValue = document.createElement('div');
 div_label_domainValue.id = 'div_label_domainValue_id';
 var label_domainValue = document.createElement('label');
 label_domainValue.innerHTML = 'DomainValue  ';
 label_domainValue.id = 'label_domainValue_id';
 var div_input_domainValue = document.createElement('div');
 div_input_domainValue.id = 'div_input_domainValue_id';
 var input_domainValue = document.createElement('input');
 input_domainValue.id = 'input_domainValue_id'; 
 $('#' + actId).append(div_label_domainValue);
 $('#' + actId).append(div_input_domainValue);
 $('#div_label_domainValue_id').append(label_domainValue);
 $('#div_input_domainValue_id').append(input_domainValue);
 $('#label_domainValue').attr('for','input_domainValue_id');
 $('#div_label_domainValue_id').attr('style','width:100px;float:left;'); 
 $('#label_domainValue').attr('for','select_domain');
 input_domainValue.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	};
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_domainValue_id').addClass('props');
 $('#input_domainValue_id').data('info','domainValue');
 return;
}  

function addFieldColClass(actId)
{
 var div_label_fieldColClass = document.createElement('div');
 div_label_fieldColClass.id = 'div_label_fieldColClass_id';
 var label_fieldColClass = document.createElement('label');
 label_fieldColClass.innerHTML = 'FieldColClass  ';
 label_fieldColClass.id = 'label_fieldColClass_id';
 var div_input_fieldColClass = document.createElement('div');
 div_input_fieldColClass.id = 'div_input_fieldColClass_id'; 
 var input_fieldColClass = document.createElement('input');
 input_fieldColClass.id = 'input_fieldColClass_id';
 $('#' + actId).append(div_label_fieldColClass);
 $('#' + actId).append(div_input_fieldColClass);
 $('#div_label_fieldColClass_id').append(label_fieldColClass);
 $('#div_input_fieldColClass_id').append(input_fieldColClass);
 $('#label_fieldColClass').attr('for','input_fieldColClass_id');
 $('#div_label_fieldColClass_id').attr('style','width:100px;float:left;');
 input_fieldColClass.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 var br1= document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldColClass_id').addClass('props');
 $('#input_fieldColClass_id').data('info','fieldColClass');
 return; 
}

function addRowClassField(actId)
{
 var div_label_rowClass = document.createElement('div'); 
 div_label_rowClass.id = 'div_label_rowClass_id'; 
 var label_rowClass = document.createElement('label'); 
 label_rowClass.innerHTML = 'RowClass  '; 
 label_rowClass.id = 'label_rowClass_id'; 
 var div_input_rowClass = document.createElement('div'); 
 div_input_rowClass.id = 'div_input_rowClass_id'; 
 var input_rowClass = document.createElement('input');
 input_rowClass.id = 'input_rowClass_id';
 $('#' + actId).append(div_label_rowClass);
 $('#' + actId).append(div_input_rowClass);
 $('#div_label_rowClass_id').append(label_rowClass);
 $('#div_input_rowClass_id').append(input_rowClass);
 $('#label_rowClass').attr('for','input_rowClass_id');
 $('#div_label_rowClass_id').attr('style','width:100px;float:left;');
 input_rowClass.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_rowClass_id').addClass('props');
 $('#input_rowClass_id').data('info','rowClass');
 return;
}

function addRowsClassField(actId)
{
 var div_label_rowsClass = document.createElement('div'); 
 div_label_rowsClass.id = 'div_label_rowsClass_id'; 
 var label_rowsClass = document.createElement('label'); 
 label_rowsClass.innerHTML = 'RowsClass  '; 
 label_rowsClass.id = 'label_rowsClass_id'; 
 var div_input_rowsClass = document.createElement('div'); 
 div_input_rowsClass.id = 'div_input_rowsClass_id'; 
 var input_rowsClass = document.createElement('input');
 input_rowsClass.id = 'input_rowsClass_id';
 $('#' + actId).append(div_label_rowsClass);
 $('#' + actId).append(div_input_rowsClass);
 $('#div_label_rowsClass_id').append(label_rowsClass);
 $('#div_input_rowsClass_id').append(input_rowsClass);
 $('#label_rowsClass').attr('for','input_rowsClass_id');
 $('#div_label_rowsClass_id').attr('style','width:100px;float:left;');
 input_rowsClass.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_rowsClass_id').addClass('props');
 $('#input_rowsClass_id').data('info','rowsClass');
 return;
}

function addRowStyleField(actId)
{
 var div_label_rowStyle = document.createElement('div'); 
 div_label_rowStyle.id = 'div_label_rowStyle_id'; 
 var label_rowStyle = document.createElement('label'); 
 label_rowStyle.innerHTML = 'RowStyle  '; 
 label_rowStyle.id = 'label_rowStyle_id'; 
 var div_input_rowStyle = document.createElement('div'); 
 div_input_rowStyle.id = 'div_input_rowStyle_id'; 
 var input_rowStyle = document.createElement('input');
 input_rowStyle.id = 'input_rowStyle_id';
 $('#' + actId).append(div_label_rowStyle);
 $('#' + actId).append(div_input_rowStyle);
 $('#div_label_rowStyle_id').append(label_rowStyle);
 $('#div_input_rowStyle_id').append(input_rowStyle);
 $('#label_rowStyle').attr('for','input_rowStyle_id');
 $('#div_label_rowStyle_id').attr('style','width:100px;float:left;');
 input_rowStyle.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_rowStyle_id').addClass('props');
 $('#input_rowStyle_id').data('info','rowStyle');
 return;
}

function addRowsStyleField(actId)
{
 var div_label_rowsStyle = document.createElement('div'); 
 div_label_rowsStyle.id = 'div_label_rowsStyle_id'; 
 var label_rowsStyle = document.createElement('label'); 
 label_rowsStyle.innerHTML = 'RowsStyle  '; 
 label_rowsStyle.id = 'label_rowsStyle_id'; 
 var div_input_rowsStyle = document.createElement('div'); 
 div_input_rowsStyle.id = 'div_input_rowsStyle_id'; 
 var input_rowsStyle = document.createElement('input');
 input_rowsStyle.id = 'input_rowsStyle_id';
 $('#' + actId).append(div_label_rowsStyle);
 $('#' + actId).append(div_input_rowsStyle);
 $('#div_label_rowsStyle_id').append(label_rowsStyle);
 $('#div_input_rowsStyle_id').append(input_rowsStyle);
 $('#label_rowsStyle').attr('for','input_rowsStyle_id');
 $('#div_label_rowsStyle_id').attr('style','width:100px;float:left;');
 input_rowsStyle.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_rowsStyle_id').addClass('props');
 $('#input_rowsStyle_id').data('info','rowsStyle');
 return;
}

function addLabelSpacerWidthField(actId)
{
 var div_label_labelSpacerWidth = document.createElement('div');
 div_label_labelSpacerWidth.id = 'div_label_labelSpacerWidth_id'; 
 var label_labelSpacerWidth = document.createElement('label');
 label_labelSpacerWidth.innerHTML = 'LabelSpacerWidth  ';
 label_labelSpacerWidth.id = 'label_labelSpacerWidth_id'; 
 var div_input_labelSpacerWidth = document.createElement('div'); 
 div_input_labelSpacerWidth.id = 'div_input_labelSpacerWidth_id';   
 var input_labelSpacerWidth = document.createElement('input'); 
 input_labelSpacerWidth.id = 'input_labelSpacerWidth_id'; 
 $('#' + actId).append(div_label_labelSpacerWidth);
 $('#' + actId).append(div_input_labelSpacerWidth);
 $('#div_label_labelSpacerWidth_id').append(label_labelSpacerWidth); 
 $('#div_input_labelSpacerWidth_id').append(input_labelSpacerWidth);
 $('#label_labelSpacerWidth').attr('for','input_labelSpacerWidth_id');
 $('#div_label_labelSpacerWidth_id').attr('style','width:110px;float:left;');
 input_labelSpacerWidth.onchange = function(){
	if(this.value=='')
	{
	 alert(loc.getString('msg',2) + loc.getString('msg',3));
	 this.value=1;
	 return false;
	}
 	$(this).data('value',this.value);
 	saveFieldsProps();};   
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_labelSpacerWidth_id').addClass('props');
 $('#input_labelSpacerWidth_id').data('info','labelSpacerWidth');
 return;
}

function addCellPaddingField(actId)
{
 var div_label_cellPadding = document.createElement('div');
 div_label_cellPadding.id = 'div_label_cellPadding_id';
 var label_cellPadding = document.createElement('label');
 label_cellPadding.innerHTML = 'CellPadding  ';
 label_cellPadding.id = 'label_cellPadding_id';
 var div_input_cellPadding = document.createElement('div');
 div_input_cellPadding.id = 'div_input_cellPadding_id';  
 var input_cellPadding = document.createElement('input');
 input_cellPadding.id = 'input_cellPadding_id';
 $('#' + actId).append(div_label_cellPadding);
 $('#' + actId).append(div_input_cellPadding);
 $('#div_label_cellPadding_id').append(label_cellPadding);
 $('#div_input_cellPadding_id').append(input_cellPadding);
 $('#label_cellPadding').attr('for','input_cellPadding_id');
 $('#div_label_cellPadding_id').attr('style','width:110px;float:left;');
 input_cellPadding.onchange = function(){
	if(this.value=='')
	{
	 alert(loc.getString('msg',2) + loc.getString('msg',3));
	 this.value=0;
	 return false;
	}
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_cellPadding_id').addClass('props');
 $('#input_cellPadding_id').data('info','cellPadding');
 return;
}

function addCellSpacingField(actId)
{
 var div_label_cellSpacing = document.createElement('div');
 div_label_cellSpacing.id = 'div_label_cellSpacing_id';
 var label_cellSpacing = document.createElement('label');
 label_cellSpacing.innerHTML = 'CellSpacing  ';
 label_cellSpacing.id = 'label_cellSpacing_id';
 var div_input_cellSpacing = document.createElement('div');
 div_input_cellSpacing.id = 'div_input_cellSpacing_id';  
 var input_cellSpacing = document.createElement('input');
 input_cellSpacing.id = 'input_cellSpacing_id';
 $('#' + actId).append(div_label_cellSpacing);
 $('#' + actId).append(div_input_cellSpacing);
 $('#div_label_cellSpacing_id').append(label_cellSpacing);
 $('#div_input_cellSpacing_id').append(input_cellSpacing);
 $('#label_cellSpacing').attr('for','input_cellSpacing_id');
 $('#div_label_cellSpacing_id').attr('style','width:110px;float:left;');
 input_cellSpacing.onchange = function(){
	if(this.value=='')
	{
	 alert(loc.getString('msg',2) + loc.getString('msg',3));
	 this.value=0;
	 return false;
	}
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_cellSpacing_id').addClass('props');
 $('#input_cellSpacing_id').data('info','cellSpacing');
 return;
}

function addStyleField(actId)
{
 var div_label_style = document.createElement('div');
 div_label_style.id = 'div_label_style_id';
 var label_style = document.createElement('label');
 label_style.innerHTML = 'Style  ';
 label_style.id = 'label_style_id';
 var div_input_style = document.createElement('div');
 div_input_style.id = 'div_input_style_id';  
 var input_style = document.createElement('input');
 input_style.id = 'input_style_id';
 $('#' + actId).append(div_label_style);
 $('#' + actId).append(div_input_style);
 $('#div_label_style_id').append(label_style);
 $('#div_input_style_id').append(input_style);
 $('#label_style').attr('for','input_style_id');
 $('#div_label_style_id').attr('style','width:110px;float:left;');
 input_style.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_style_id').addClass('props');
 $('#input_style_id').data('info','style');
 return;
}

function addColStyleField(actId)
{
 var div_label_fieldColStyle = document.createElement('div');
 div_label_fieldColStyle.id = 'div_label_fieldColStyle_id';
 var label_fieldColStyle = document.createElement('label');
 label_fieldColStyle.innerHTML = 'FieldColStyle  ';
 label_fieldColStyle.id = 'label_fieldColStyle_id';
 var div_input_fieldColStyle = document.createElement('div');
 div_input_fieldColStyle.id = 'div_input_fieldColStyle_id';  
 var input_fieldColStyle = document.createElement('input');
 input_fieldColStyle.id = 'input_fieldColStyle_id';
 $('#' + actId).append(div_label_fieldColStyle);
 $('#' + actId).append(div_input_fieldColStyle);
 $('#div_label_fieldColStyle_id').append(label_fieldColStyle);
 $('#div_input_fieldColStyle_id').append(input_fieldColStyle);
 $('#label_fieldColStyle').attr('for','input_fieldColStyle_id');
 $('#div_label_fieldColStyle_id').attr('style','width:110px;float:left;');
 input_fieldColStyle.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldColStyle_id').addClass('props');
 $('#input_fieldColStyle_id').data('info','fieldColStyle');
 return;	
}

function addFieldLabel(actId)
{
 var div_label_fieldLabel = document.createElement('div');
 div_label_fieldLabel.id = 'div_label_fieldLabel_id';
 var label_fieldLabel = document.createElement('label');
 label_fieldLabel.innerHTML = 'FieldLabel  ';
 label_fieldLabel.id = 'label_fieldLabel_id';
 var div_input_fieldLabel = document.createElement('div');
 div_input_fieldLabel.id = 'div_input_fieldLabel_id';  
 var input_fieldLabel = document.createElement('input');
 input_fieldLabel.id = 'input_fieldLabel_id';
 $('#' + actId).append(div_label_fieldLabel);
 $('#' + actId).append(div_input_fieldLabel);
 $('#div_label_fieldLabel_id').append(label_fieldLabel);
 $('#div_input_fieldLabel_id').append(input_fieldLabel);
 $('#label_fieldLabel').attr('for','input_fieldLabel_id');
 $('#div_label_fieldLabel_id').attr('style','width:110px;float:left;');
 input_fieldLabel.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldLabel_id').addClass('props');
 $('#input_fieldLabel_id').data('info','fieldLabel');
 return; 
}

function addFieldType(actId)
{
 var div_label_fieldType = document.createElement('div');
 div_label_fieldType.id = 'div_label_fieldType_id';
 var label_fieldType = document.createElement('label');
 label_fieldType.innerHTML = 'FieldType  ';
 label_fieldType.id = 'label_fieldType_id';
 var div_select_fieldType = document.createElement('div');
 div_select_fieldType.id = 'div_select_fieldType_id';
 var select_fieldType = document.createElement('select');
 select_fieldType.id = 'select_fieldType_id';
 var option_0 = document.createElement('option');
 option_0.label = 'Integer';
 option_0.value = 'Integer';
 option_0.text = 'Integer';
 var selectedIndex;
 var option_1 = document.createElement('option');
 option_1.label = 'Float';
 option_1.value = 'Float';
 option_1.text = 'Float';
 var option_2 = document.createElement('option');
 option_2.label = 'String';
 option_2.value = 'String';
 option_2.text = 'String';
 var option_3 = document.createElement('option');
 option_3.label = 'Date';
 option_3.value = 'Date';
 option_3.text = 'Date';
 var option_4 = document.createElement('option');
 option_4.label = 'Ip';
 option_4.value = 'Ip';
 option_4.text = 'Ip';
 var option_5 = document.createElement('option');
 option_5.label = 'Boolean';
 option_5.value = 'Boolean';
 option_5.text = 'Boolean';
 var option_6 = document.createElement('option');
 option_6.label = 'Big_string';
 option_6.value = 'Big_string';
 option_6.text = 'Big_string';
 select_fieldType.add(option_6,null); 
 select_fieldType.add(option_5,option_6); 
 select_fieldType.add(option_4,option_5);
 select_fieldType.add(option_3,option_4);
 select_fieldType.add(option_2,option_3);
 select_fieldType.add(option_1,option_2);
 select_fieldType.add(option_0,option_1);
 select_fieldType.selectedIndex = selectedIndex;
 select_fieldType.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 $('#' + actId).append(div_label_fieldType);
 $('#' + actId).append(div_select_fieldType);
 $('#div_select_fieldType_id').append(select_fieldType); 
 $('#div_label_fieldType_id').append(label_fieldType);
 $('#div_label_fieldType_id').attr('style','width:100px;float:left;');
 $('#label_fieldType_id').attr('for','label_fieldType_id');  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#select_fieldType_id').addClass('props'); 
 $('#select_fieldType_id').data('info','fieldType');
 $('#select_fieldType_id').data('value',''); 
 return;
}

function addFieldStyle(actId)
{
 var div_label_fieldStyle = document.createElement('div');
 div_label_fieldStyle.id = 'div_label_fieldStyle_id';
 var label_fieldStyle = document.createElement('label');
 label_fieldStyle.innerHTML = 'FieldStyle  ';
 label_fieldStyle.id = 'label_fieldStyle_id';
 var div_input_fieldStyle = document.createElement('div');
 div_input_fieldStyle.id = 'div_input_fieldStyle_id'; 
 var input_fieldStyle = document.createElement('input');
 input_fieldStyle.id = 'input_fieldStyle_id';
 $('#' + actId).append(div_label_fieldStyle);
 $('#' + actId).append(div_input_fieldStyle);
 $('#div_label_fieldStyle_id').append(label_fieldStyle);
 $('#div_input_fieldStyle_id').append(input_fieldStyle);
 $('#label_fieldStyle').attr('for','input_fieldStyle_id');
 $('#div_label_fieldStyle_id').attr('style','width:110px;float:left;');
 input_fieldStyle.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};  
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_fieldStyle_id').addClass('props');
 $('#input_fieldStyle_id').data('info','fieldStyle');
 $('#input_fieldStyle_id').data('value','');
 return; 
}

function addFieldLength(actId)
{
 var div_label_fieldLength = document.createElement('div');
 div_label_fieldLength.id = 'div_label_fieldLength_id';
 var label_fieldLength = document.createElement('label');
 label_fieldLength.innerHTML = 'FieldLength  ';
 label_fieldLength.id = 'label_fieldLength_id';
 var div_input_fieldLength = document.createElement('div');
 div_input_fieldLength.id = 'div_input_fieldLength_id';
 var input_fieldLength = document.createElement('input');
 input_fieldLength.id = 'input_fieldLength_id';
 $('#' + actId).append(div_label_fieldLength);
 $('#' + actId).append(div_input_fieldLength);
 $('#div_label_fieldLength_id').append(label_fieldLength);
 $('#div_input_fieldLength_id').append(input_fieldLength);
 $('#label_fieldLength').attr('for','input_fieldLength_id');
 $('#div_label_fieldLength_id').attr('style','width:110px;float:left;');
 input_fieldLength.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_fieldLength_id').addClass('props');
 $('#input_fieldLength_id').data('info','fieldLength');
 $('#input_fieldLength_id').data('value',10);
 return; 
}

function addFieldStop(actId)
{
 var div_label_fieldStop = document.createElement('div');
 div_label_fieldStop.id = 'div_label_fieldStop_id';
 var label_fieldStop = document.createElement('label');
 label_fieldStop.innerHTML = 'FieldStop  ';
 label_fieldStop.id = 'label_fieldStop_id';
 var div_input_fieldStop = document.createElement('div');
 div_input_fieldStop.id = 'div_input_fieldStop_id'; 
 var input_fieldStop = document.createElement('input');
 input_fieldStop.id = 'input_fieldStop_id';
 $('#' + actId).append(div_label_fieldStop);
 $('#' + actId).append(div_input_fieldStop);
 $('#div_label_fieldStop_id').append(label_fieldStop);
 $('#div_input_fieldStop_id').append(input_fieldStop);
 $('#label_fieldStop').attr('for','input_fieldStop_id');
 $('#div_label_fieldStop_id').attr('style','width:110px;float:left;');
 input_fieldStop.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_fieldStop_id').addClass('props');	
 $('#input_fieldStop_id').data('info','fieldStop');
 $('#input_fieldStop_id').data('value',10);
 return;
}

function addFieldHint(actId)
{
 var div_label_fieldHint = document.createElement('div');
 div_label_fieldHint.id = 'div_label_fieldHint_id';
 var label_fieldHint = document.createElement('label');
 label_fieldHint.innerHTML = 'FieldHint  ';
 label_fieldHint.id = 'label_fieldHint_id';
 var div_input_fieldHint = document.createElement('div');
 div_input_fieldHint.id = 'div_input_fieldHint_id';  
 var input_fieldHint = document.createElement('input');
 input_fieldHint.id = 'input_fieldHint_id';
 $('#' + actId).append(div_label_fieldHint);
 $('#' + actId).append(div_input_fieldHint);
 $('#div_label_fieldHint_id').append(label_fieldHint);
 $('#div_input_fieldHint_id').append(input_fieldHint);
 $('#label_fieldHint').attr('for','input_fieldHint_id');
 $('#div_label_fieldHint_id').attr('style','width:110px;float:left;');
 input_fieldHint.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldHint_id').addClass('props');
 $('#input_fieldHint_id').data('info','fieldHint');
 $('#input_fieldHint_id').data('value','');
 return;
}

function addFieldDirection(actId)
{
 var div_label_fieldDirection = document.createElement('div');
 div_label_fieldDirection.id = 'div_label_fieldDirection_id';
 var label_fieldDirection = document.createElement('label');
 label_fieldDirection.innerHTML = 'FieldDirection  ';
 label_fieldDirection.id = 'label_fieldDirection_id';
 var div_select_fieldDirection = document.createElement('div');
 div_select_fieldDirection.id = 'div_select_fieldDirection_id';  
 var select_fieldDirection = document.createElement('select');
 select_fieldDirection.id = 'select_fieldDirection_id';
 var option_0 = document.createElement('option');
 option_0.label = 'H';
 option_0.value = 'H';
 option_0.text = 'H';
 var option_1 = document.createElement('option');
 option_1.label = 'V';
 option_1.value = 'V';
 option_1.text = 'V';
 select_fieldDirection.add(option_1,null);
 select_fieldDirection.add(option_0,option_1);
 select_fieldDirection.selectedIndex = 0;
 $('#' + actId).append(div_label_fieldDirection);
 $('#' + actId).append(div_select_fieldDirection);
 $('#div_select_fieldDirection_id').append(select_fieldDirection); 
 $('#div_label_fieldDirection_id').append(label_fieldDirection);
 $('#div_label_fieldDirection_id').attr('style','width:100px;float:left;');
 $('#label_fieldDirection_id').attr('for','label_fieldDirection_id');
 select_fieldDirection.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};   
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_fieldDirection_id').addClass('props');
 $('#select_fieldDirection_id').data('info','fieldDirection');
 $('#select_fieldDirection_id').data('value','true');
 return;
 return;	
}

function addFieldToolTip(actId)
{
 var div_label_fieldToolTip = document.createElement('div');
 div_label_fieldToolTip.id = 'div_label_fieldToolTip_id';
 var label_fieldToolTip = document.createElement('label');
 label_fieldToolTip.innerHTML = 'FieldToolTip  ';
 label_fieldToolTip.id = 'label_fieldToolTip_id';
 var div_input_fieldToolTip = document.createElement('div');
 div_input_fieldToolTip.id = 'div_input_fieldToolTip_id'; 
 var input_fieldToolTip = document.createElement('input');
 input_fieldToolTip.id = 'input_fieldToolTip_id';
 $('#' + actId).append(div_label_fieldToolTip);
 $('#' + actId).append(div_input_fieldToolTip);
 $('#div_label_fieldToolTip_id').append(label_fieldToolTip);
 $('#div_input_fieldToolTip_id').append(input_fieldToolTip);
 $('#label_fieldToolTip').attr('for','input_fieldToolTip_id');
 $('#div_label_fieldToolTip_id').attr('style','width:110px;float:left;');
 input_fieldToolTip.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldToolTip_id').addClass('props');
 $('#input_fieldToolTip_id').data('info','fieldToolTip');
 $('#input_fieldToolTip_id').data('value','');
 return;
}

function saveFieldEventsValuesInFieldEventsBuf(actObj)
{
 	var opts = $('#select_fieldEvents_id').get(0).options;
 	var events = [];
  events[0] = opts.item(0).label;
  events[1] = opts.item(1).label;
 	$(this).data('value',events);
}

function addFieldEvents(actId)
{	
 var div_label_fieldEvents = document.createElement('div');
 div_label_fieldEvents.id = 'div_label_fieldEvents_id';
 var label_fieldEvents = document.createElement('label');
 label_fieldEvents.innerHTML = 'FieldEvents  ';
 label_fieldEvents.id = 'label_fieldEvents_id';
 var div_select_fieldEvents = document.createElement('div');
 div_select_fieldEvents.id = 'div_select_fieldEvents_id'; 
 var select_fieldEvents = document.createElement('select');
 select_fieldEvents.id = 'select_fieldEvents_id';

 select_fieldEvents.onclick = function(actObj)
 {
 	$('#html_tags__3').data('activeOption',actObj);
 	var divPopup = $('#html_tags__3').get(0);
 	
 	$('#div_select_fieldEvents_id').append(divPopup); 
 	var oldDivStyle = $(divPopup).attr('style');	 	
 	
 	$(divPopup).attr('style',
 	'position:fixed;left:400px;top:0px;' +
 	'background-color:white;border:1px solid black;' +
 	'width:180px;height:110px;overflow:auto;');
 	
 	$('#textarea_0').get(0).style.display = 'inline';
 	var option = this.options.item(this.selectedIndex); 	
 	if(option.label != undefined)
 	 $('#textarea_0').get(0).value = option.label;
  $(button1).attr('style','display:inline;');
  $(button2).attr('style','display:inline;');
  $(button3).attr('style','display:inline;');
 }; 
 
 var select_fieldEvents_onchange = function()
 {
 	var select_fieldEvents = $('#select_fieldEvents_id').get(0);
 	var opts = $('#select_fieldEvents_id').get(0).options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_fieldEvents).data('value',events);
 	saveFieldsProps();
 };
 
 var select_fieldEvents_add = function(actVal)
 {
 	var select_fieldEvents = $('#select_fieldEvents_id').get(0);
 	var opts = select_fieldEvents.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	events[i] = actVal;
 	var option = document.createElement('option');
 	option.value = actVal;
 	option.label = actVal;
 	option.text = actVal;
 	select_fieldEvents.add(option,null);
 	$(select_fieldEvents).data('value',events);
 	saveFieldsProps(); 	
 }
 
 var select_fieldEvents_del = function()
 {
 	var select_fieldEvents = $('#select_fieldEvents_id').get(0);
 	var ind = select_fieldEvents.selectedIndex;
 	select_fieldEvents.remove(ind);
 	var opts = select_fieldEvents.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_fieldEvents).data('value',events);
 	saveFieldsProps();
 } 
 	
 select_fieldEvents.onchange = select_fieldEvents_onchange;
 	
 $('#' + actId).append(div_label_fieldEvents);
 $('#' + actId).append(div_select_fieldEvents);
 
 var button1 = document.createElement('button');
 button1.innerHTML = 'ok.';
 button1.id = 'buttonOk';
 button1.onclick = function(actObj1){
 	 var obj0 = $('#html_tags__3').data('activeOption');
   var option = ((obj0.srcElement !== undefined)?obj0.srcElement:obj0.target);
 	 option.label = $('#textarea_0').get(0).value.replace(/\n/g,"");
 	 option.value = $('#textarea_0').get(0).value.replace(/\n/g,"");
 	 option.text = $('#textarea_0').get(0).value.replace(/\n/g,"");
 	 select_fieldEvents_onchange();
 	 };
 $('#html_tags__3').append(button1);
 $(button1).attr('style','display:none;'); 
 
 var button2 = document.createElement('button');
 button2.innerHTML = loc.getString('msg',83);
 button2.id = 'buttonAdd';
 button2.onclick = function(actObj1){
 	 var textAreaVal = $('#textarea_0').get(0).value.replace(/\n/g,"");
 	 select_fieldEvents_add(textAreaVal);
 	 };
 $('#html_tags__3').append(button2);
 $(button2).attr('style','display:none;');  	

 var button3 = document.createElement('button');
 button3.innerHTML = loc.getString('msg',84);
 button3.id = 'buttonDel';
 button3.onclick = function(actObj1){
 	 select_fieldEvents_del();
 	 };
 $('#html_tags__3').append(button3);
 $(button3).attr('style','display:none;');  
 
 $('#div_label_fieldEvents_id').append(label_fieldEvents);
 $('#div_select_fieldEvents_id').append(select_fieldEvents);
 $(select_fieldEvents).attr('multiple',true);
 $('#label_fieldEvents').attr('for','select_fieldEvents_id');
 $('#div_label_fieldEvents_id').attr('style','width:110px;float:left;');
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_fieldEvents_id').addClass('props');
 $('#select_fieldEvents_id').data('info','fieldEvents');
 $('#select_fieldEvents_id').data('value','');
 return; 
}

function addFieldRegexp(actId)
{
 var div_label_fieldRegexp = document.createElement('div');
 div_label_fieldRegexp.id = 'div_label_fieldRegexp_id';
 var label_fieldRegexp = document.createElement('label');
 label_fieldRegexp.innerHTML = 'FieldRegexp  ';
 label_fieldRegexp.id = 'label_fieldRegexp_id';
 var div_input_fieldRegexp = document.createElement('div');
 div_input_fieldRegexp.id = 'div_input_fieldRegexp_id';  
 var input_fieldRegexp = document.createElement('input');
 input_fieldRegexp.id = 'input_fieldRegexp_id';
 $('#' + actId).append(div_label_fieldRegexp);
 $('#' + actId).append(div_input_fieldRegexp);
 $('#div_label_fieldRegexp_id').append(label_fieldRegexp);
 $('#div_input_fieldRegexp_id').append(input_fieldRegexp);
 $('#label_fieldRegexp').attr('for','input_fieldRegexp_id');
 $('#div_label_fieldRegexp_id').attr('style','width:110px;float:left;');
 input_fieldRegexp.onchange = function()
 {$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#input_fieldRegexp_id').addClass('props');
 $('#input_fieldRegexp_id').data('info','fieldRegexp');
 $('#input_fieldRegexp_id').data('value','');
 return;
}

function addFieldDefaultValue(actId)
{
 var div_label_fieldDefaultValue = document.createElement('div');
 div_label_fieldDefaultValue.id = 'div_label_fieldDefaultValue_id';
 var label_fieldDefaultValue = document.createElement('label');
 label_fieldDefaultValue.innerHTML = 'FieldDefaultValue  ';
 label_fieldDefaultValue.id = 'label_fieldDefaultValue_id';
 var div_input_fieldDefaultValue = document.createElement('div');
 div_input_fieldDefaultValue.id = 'div_input_fieldDefaultValue_id';  
 var input_fieldDefaultValue = document.createElement('input');
 input_fieldDefaultValue.id = 'input_fieldDefaultValue_id';
 $('#' + actId).append(div_label_fieldDefaultValue);
 $('#' + actId).append(div_input_fieldDefaultValue);
 $('#div_label_fieldDefaultValue_id').append(label_fieldDefaultValue);
 $('#div_input_fieldDefaultValue_id').append(input_fieldDefaultValue);
 $('#label_fieldDefaultValue').attr('for','input_fieldDefaultValue_id');
 $('#div_label_fieldDefaultValue_id').attr('style','width:110px;float:left;');
 input_fieldDefaultValue.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1); 
 $('#input_fieldDefaultValue_id').addClass('props');
 $('#input_fieldDefaultValue_id').data('info','fieldDefaultValue');
 $('#input_fieldDefaultValue_id').data('value','');
 return;	
}

function addFieldMandatory(actId)
{
 var div_label_fieldMandatory = document.createElement('div');
 div_label_fieldMandatory.id = 'div_label_fieldMandatory_id';
 var label_fieldMandatory = document.createElement('label');
 label_fieldMandatory.innerHTML = 'FieldMandatory  ';
 label_fieldMandatory.id = 'label_fieldMandatory_id';
 var div_select_fieldMandatory = document.createElement('div');
 div_select_fieldMandatory.id = 'div_select_fieldMandatory_id';  
 var select_fieldMandatory = document.createElement('select');
 select_fieldMandatory.id = 'select_fieldMandatory_id';
 var option_0 = document.createElement('option');
 option_0.label = 'true';
 option_0.value = 'true';
 option_0.text = 'true';
 var option_1 = document.createElement('option');
 option_1.label = 'false';
 option_1.value = 'false';
 option_1.text = 'false';
 select_fieldMandatory.add(option_1,null);
 select_fieldMandatory.add(option_0,option_1);
 select_fieldMandatory.selectedIndex = 0;
 $('#' + actId).append(div_label_fieldMandatory);
 $('#' + actId).append(div_select_fieldMandatory);
 $('#div_select_fieldMandatory_id').append(select_fieldMandatory); 
 $('#div_label_fieldMandatory_id').append(label_fieldMandatory);
 $('#div_label_fieldMandatory_id').attr('style','width:100px;float:left;');
 $('#label_fieldMandatory_id').attr('for','label_fieldMandatory_id');
 select_fieldMandatory.onchange = function(){
 	$(this).data('value',this.value);
 	saveFieldsProps();};   
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_fieldMandatory_id').addClass('props');
 $('#select_fieldMandatory_id').data('info','fieldMandatory');
 $('#select_fieldMandatory_id').data('value','true');
 return;
}

function addLabel(actId)
{
 var div_label_label = document.createElement('div');
 div_label_label.id = 'div_label_label_id';
 var label_label = document.createElement('label');
 label_label.innerHTML = 'Label  ';
 label_label.id = 'label_label_id';
 var div_select_label = document.createElement('div');
 div_select_label.id = 'div_select_label_id';  
 var select_label = document.createElement('select');
 select_label.id = 'select_label_id';
 $('#' + actId).append(div_label_label);
 $('#' + actId).append(div_select_label);
 $('#div_label_label_id').append(label_label);
 $('#div_select_label_id').append(select_label);
 $('#label_label').attr('for','select_label_id');
 $('#div_label_label_id').attr('style','width:110px;float:left;');
 $(select_label).attr('multiple',true);
 
 select_label.selectedIndex = 0; 
 
 select_label.onclick = function()
 {
 	$('#html_tags__7').data('activeOption',this);
 	var divPopup = $('#html_tags__7').get(0);
 	
 	$('#div_select_label_id').append(divPopup); 
 	var oldDivStyle = $(divPopup).attr('style');	 	
 	
 	$(divPopup).attr('style',
 	'position:fixed;left:400px;top:220px;' +
 	'background-color:white;border:1px solid black;' +
 	'width:180px;height:110px;overflow:auto;');
 	
 	$('#textarea_2').get(0).style.display = 'inline';
 	var option = this.options.item(this.selectedIndex); 
 	if(option.label !== undefined)
 	 $('#textarea_2').attr('value', option.label);
  $(button1).attr('style','display:inline;');
  $(button2).attr('style','display:inline;');
  $(button3).attr('style','display:inline;');
 };  
 
 var select_label_onchange = function(actObj)
 {
 	var select_label = $('#select_label_id').get(0);
 	var opts = $('#select_label_id').get(0).options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_label).data('value',events);
 	saveFieldsProps();
 };
 
 var select_label_add = function(actVal)
 {
 	var select_label = $('#select_label_id').get(0);
 	var opts = select_label.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;  
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	events[i] = actVal;
 	var option = document.createElement('option');
 	option.value = actVal;
 	option.label = actVal;
 	option.text = actVal;
 	select_label.add(option,null);
 	$(select_label).data('value',events);
 	saveFieldsProps(); 	
 }
 
 var select_label_del = function()
 {
 	var select_label = $('#select_label_id').get(0);
 	var ind = select_label.selectedIndex;
 	select_label.remove(ind);
 	var opts = select_label.options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value !== undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_label).data('value',events);
 	saveFieldsProps();
 } 
  
 select_label.onchange = function(){
 	var select_label = $('#select_label_id').get(0);
 	var opts = $('#select_label_id').get(0).options;
 	var events = [];
 	var i=0;
 	var num = opts.length;
 	for(var j=0;j<=num-1;j++)
 	{
 	 if(opts.item(j).value != undefined)
 	 {
    events[i] = opts.item(j).value;
    i++;
 	 }
 	}
 	$(select_label).data('value',events);
 	saveFieldsProps();
 	}; 
 	
 var button1 = document.createElement('button');
 button1.innerHTML = 'ok.';
 button1.id = 'buttonOk';
 button1.onclick = function(actObj1){
 	 var select = $('#html_tags__7').data('activeOption');
 	 var option = select.options.item(select.selectedIndex);
 	 option.label = $('#textarea_2').get(0).value.replace(/\n/g,"");
 	 option.value = $('#textarea_2').get(0).value.replace(/\n/g,"");
 	 option.text = $('#textarea_2').get(0).value.replace(/\n/g,"");
 	 $(select).click();
 	 select_label_onchange();
 	 };
 $('#html_tags__7').append(button1);
 $(button1).attr('style','display:none;'); 
 
 var button2 = document.createElement('button');
 button2.innerHTML = loc.getString('msg',83);
 button2.id = 'buttonAdd';
 button2.onclick = function(actObj1){
 	 var textAreaVal = $('#textarea_2').attr('value').replace(/\n/g,"");
 	 select_label_add(textAreaVal);
 	 };
 $('#html_tags__7').append(button2);
 $(button2).attr('style','display:none;');  	

 var button3 = document.createElement('button');
 button3.innerHTML = loc.getString('msg',84);
 button3.id = 'buttonDel';
 button3.onclick = function(actObj1){
 	 select_label_del();
 	 };
 $('#html_tags__7').append(button3);
 $(button3).attr('style','display:none;');  	
 	
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_label_id').addClass('props');
 $('#select_label_id').data('info','label');
 $('#select_label_id').data('value','');
 return;
}

function addFieldObjName(actId,actObjName)
{
 var div_label_fieldObjName = document.createElement('div');
 div_label_fieldObjName.id = 'div_label_fieldObjName_id';
 var label_fieldObjName = document.createElement('label');
 label_fieldObjName.innerHTML = 'FieldObjName  ';
 label_fieldObjName.id = 'label_fieldObjName_id';
 var div_select_fieldObjName = document.createElement('div');
 div_select_fieldObjName.id = 'div_select_fieldObjName_id';  
 var select_fieldObjName = document.createElement('select');
 select_fieldObjName.id = 'select_fieldObjName_id';
 var option0 = document.createElement('option');
 option0.text = '';
 option0.value = '';
 option0.label = '';
 $('#' + actId).append(div_label_fieldObjName);
 $('#' + actId).append(div_select_fieldObjName);
 $('#div_label_fieldObjName_id').append(label_fieldObjName);
 $('#div_select_fieldObjName_id').append(select_fieldObjName);
 $(select_fieldObjName).append(option0);
 $('#label_fieldObjName').attr('for','select_fieldObjName_id');
 $('#div_label_fieldObjName_id').attr('style','width:110px;float:left;');
 select_fieldObjName.onchange = function(){
 	$('#input_domainValue_id').attr('value',this.value);
 	$('#input_domainValue_id').data('value',this.value);
 	$(this).data('value',this.value);
 	saveFieldsProps();
 	}; 
 var br1 = document.createElement('br');
 $('#' + actId).append(br1);
 $('#select_fieldObjName_id').addClass('props');
 $('#select_fieldObjName_id').data('info','fieldObjName');
 $('#select_fieldObjName_id').data('value','');
 var pageName = window.parent.$('#Pagine').attr('value');
 ajaxHandler.synServerCall('ajax_handler.php','getAllInterfacesOfPage',pageName,'xml',/CDATA/); 
 var opts = $('#select_fieldObjName_id').get(0).options;
 var num = opts.length;
 for(var j=0;j<=num-1;j++)
 {
 	if(opts.item(j)==actObjName)
 	{
 	 select_fieldObjName.selectedIndex = j;
 	 break;
 	}
 }
 return;
}

function saveFieldsProps()
{
 var buf1 = new Object(); 
 var buf2 = new Object();
 var buf1 = getDefaultBuffer();
 var buf2 = getDefaultCommon();
 var buf3 = updateInfoBuf('html_tags__0',buf1);
 var buf4 = updateInfoBuf('html_tags__0',buf2);
 var global_buf = window.returnVal;
 var domain = global_buf.domain;
 global_buf['domain_' + domain + '_buf'] = buf3;
 global_buf['domain_common_buf'] = buf4;
 window.returnVal = global_buf;
 return;
}






