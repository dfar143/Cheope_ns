 function button_1_onClick()
 {
 	var ajaxOpFieldVal = $('#input_ajaxOp_id').val();
 	var ajaxOpIsJsonEnabledFieldVal = $('#input_ajaxOp_isJsonEnabled_id').get(0).checked;
 	if(ajaxOpFieldVal.replace(/\s*/g,'')=='')
 	{
   alert(loc.getString('msg',77));
   $('#input_ajaxOp_id').val('');
   return false;
 	} 
  var regExp = /^[A-Za-z]+[A-Za-z0-9_]*$/;
  if(ajaxOpFieldVal.match(regExp)===null)
  {
 	 alert(loc.getString('msg',45));
 	 $('#input_ajaxOp_id').val('');
 	 return false;
  }
 	var found=false;
 	$('#fields input[type=text]').each(function(){if($(this).val()==ajaxOpFieldVal)found=true});
 	if(found)
 	{
 	 alert(loc.getString('msg',9));
 	 $('#input_ajaxOp_id').val('');
 	 return false;
  }
  dndSource.insertNodes(false,[{fieldName:ajaxOpFieldVal,
  	isJsonEnabled:ajaxOpIsJsonEnabledFieldVal}]);
  dndSource.sync();
}

function button_2_onClick()
{
 var ids = '';
 var i = 0;
 
 $('#tbody_id > tr').each(function(){var ajaxOp = $(this).find('.ajaxOp').val(); 
 var isJsonEnabled = $(this).find('.ajaxOp_isJsonEnabled').get(0).checked;
 var ajaxOpStr = 'ajaxOp_' + i + '=' + ajaxOp;
 var isJsonEnabledStr = 'isJsonEnabledStr_' + i + '=' + isJsonEnabled;i++;
 ids = ids + '' + ajaxOpStr + '&' + isJsonEnabledStr + '&'});
 ajaxHandler.synServerPostCall('ajax_handler.php','setAllAjaxOps','',ids,'text',/[.]*\w[.]*/);
 alert(loc.getString('msg',91));
}

function input_ajaxOp_onChange(actObj)
{
 var num=0;
 var thisVal = $(actObj).val().replace(/\s*/g,'');;
 $('.ajaxOp').each(function(){if($(this).val().replace(/\s*/g,'')==thisVal)num++;});
 if(num>=2)
  alert(loc.getString('msg',9));		
}

function input_ajaxOp_class_onChange(actObj)
{
 var num=0;
 var thisVal = $(actObj).val().replace(/\s*/g,'');
 $('.ajaxOpClass').each(function(){if($(this).val().replace(/\s*/g,'')==thisVal)num++;});
 if(num>=2)
  alert(loc.getString('msg',9));		
}

function ajaxOp_button_onClick(actObj)
{
	var valueStr = util.ucFirst($(actObj).parent().parent().find('input[type=text]').val().replace(/\s*/g,''));
  var found = false;
  $('.ajaxOpClass').each(function(){if($(this).val().replace(/\s*/g,'')==valueStr)found=true;});
  if(! found)
  {
   dndSource1.insertNodes(false,[{fieldName:valueStr}]);
   dndSource1.sync();  
  }
}

function button_3_onClick()
{
 var ids = '';
 $('#tbody_class_id > tr').each(function(){var ajaxOpClass = $(this).find('.ajaxOpClass').val(); 
 ids = ids + ajaxOpClass + ';'});
 ajaxHandler.synServerCall('ajax_handler.php','setAllAjaxOpsClasses',ids,'text',/[.]*\w[.]*/);
  alert(loc.getString('msg',91));
}

function button_4_onClick()
{
 ajaxHandler.synServerCall('ajax_handler.php','generateAjaxOpsConfigurationFiles','','text',/[.]*\w[.]*/);
  alert(loc.getString('msg',91));
}

function button_5_onClick()
{
 ajaxHandler.synServerCall('ajax_handler.php','generateAjaxOpsClassesFiles','','text',/[.]*\w[.]*/);
  alert(loc.getString('msg',91));
}



