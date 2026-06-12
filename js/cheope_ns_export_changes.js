function export_changes_view_list(actObj)
{
}

function label_edit_onClick(actTab,actPos)
{
	var intName = $('#simple_table__' + actTab + '_field_id_Name_' + actPos).text();
	switch(actTab)
	{
		case '1':{var dir = 'fw';break;}
		case '2':{var dir='xml';break;}
		case '3':var dir='interfaces';
	}
	if(intName.replace(/\s*/g,'') != '')
 	 subModal.showPopWin('view_module.php?Par=../' + 
 	 $('#active_application_id').text() + '/' + dir + '/' + intName,
 	 700,400,function(actVar){},true);
  else
   alert(loc.getString('msg',56));
}

function button_1_onClick(actPage)
{
	var subDir1 = $(".selected_tab > div").get(0).innerHTML;
	
	if($('#App_override_check').get(0) !== undefined)
	{
   if($('#App_override_check').get(0).checked)
	  override = '1';
	 else
	  override = '0';
	}
	else
		override = '0';
		
	$("#simple_table__" + actPage + "_tbody_id > tr").each(function()
	{
	 var page = $(this).find(".simple_table_column_Name > div").get(0).innerHTML;
   var export_changes_obj=$(this).find(".simple_table_column_Export_changes > div").get(0);    
	 var checkbox_obj = $(this).find(".simple_table_column_Check input").get(0); 
	 var appls = $(export_changes_obj).data('Appls');
	 if(checkbox_obj.checked)
	 {
	   if(appls[0]!=undefined)
	    var ids = page + ';' + subDir1 + ';' + override + ';' + appls[0];
	   else
	  	var ids = page + ';' + subDir1 + ';' + override;
	  	
	   for(var i=1;i<=appls.length-1;i++)
	   {
	   	if(appls[i]!=undefined)
	  	 ids = ids + ';' + appls[i];
	   }
	  console.log(ids);
 	  ajaxHandler.synServerCall("ajax_handler.php","exportChanges",ids,"text",/[.]*\w[.]*/);
	 }
	});
	var appls1 = $('#html_tags__8').val();
  var page1 = $('#html_tags__6').val();
  subDir1 = subDir1.substring(1,subDir1.length-1);
	if((subDir1=='interfaces')&&(page1!==''))
	{
		var ids1 = page1;
		if($('#html_tag__4').get(0).checked)
		 ids1 = ids1 + ';' + '1';
		else
			ids1 = ids1 + ';' + '0';
		for(var i=0;i<=appls1.length-1;i++)
		{
			ids1 = ids1 + ';' + appls1[i];
		} 
		ajaxHandler.synServerCall("ajax_handler.php","pagesInterfacesExportChanges",ids1,"text",/[.]*\w[.]*/);
	}
}