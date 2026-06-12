function select_1_onChange(actObj)
{
 $('#Par1').get(0).value="1";
 document.forms['form_1'].submit();
}

function button_1_onClick()
{
 subModal.showPopWin('view_all_connections.php',500,400,
 function(actVar)
 {
 	if(actVar!=undefined)
  ajaxHandler.synServerCall('ajax_handler.php','copyConnectionToDbPars',actVar,'text',/CDATA/);
 },true);
}

function button_2_onClick()
{
 alert(loc.getString('msg',91));	 
}
