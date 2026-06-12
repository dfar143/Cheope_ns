function button_1_onClick()
{
	var ids = window.parent.$('#Query_body').val();
//	alert(ids);
	ajaxHandler.serverCall('ajax_handler.php','exportQueryToCsv',ids,'text');
}