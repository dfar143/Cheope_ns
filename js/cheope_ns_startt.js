//var activeNode;

var forestCtrlCallBackFun= function(actPos)
{
 var currentNode = document.getElementById(actPos);
 var item = currentNode.childNodes[0].nodeValue.substring(2,currentNode.childNodes[0].nodeValue.length);
 var dest1 = document.getElementById('html_tags__6');
 dest1.childNodes[0].nodeValue=item;
}

function form_inserimento_1_nome_applicazione_onChange(actObj)
{
 if(util.testTextInComboLabels('Applicazioni',actObj.value))
 {
 	alert(loc.getString('msg',9));
 	$('#Nome_applicazione').val('');
 	return false;
 }	
 if(actObj.value.search(/!/)!=-1)
 {
 	alert(loc.getString('msg',76));
 	$('#Nome_applicazione').val('');
 	return false;
 }
}

function create_file()
{
 var item = document.getElementById('html_tag__0');
 var itemVal = item.value.replace(/\s*/g,'');
 if(itemVal == '')
  alert(loc.getString('msg',59));
 else
  ajaxHandler.serverCall('ajax_handler.php','createFile',itemVal,'text');
}

function rename_file()
{
 var item1 = document.getElementById('html_tags__6');
 var itemName = item1.childNodes[0].nodeValue.replace(/\s*/g,'');
 var item2 = document.getElementById('html_tag__1');
 var newItemName = item2.value.replace(/\s*/g,'');
 if((newItemName == '')||(itemName == ''))
  alert(loc.getString('msg',59));
 else
  ajaxHandler.serverCall('ajax_handler.php','renameFile',
  itemName + ';' + newItemName,'text');
 window.location.reload();
}

function check_valid_file_name()
{
 var item = document.getElementById('html_tags__6');
 var itemVal = item.childNodes[0].nodeValue.replace(/\s*/g,'');
 if((itemVal == '---')||(itemVal == ''))
 {
  alert(loc.getString('msg',59));
  return false;
 }
 return true;
}

function exec_delete()
{
 var item = document.getElementById('html_tags__6');
 var itemVal = item.childNodes[0].nodeValue.replace(/\s*/g,'');
 ajaxHandler.serverCall('ajax_handler.php','deleteFile',itemVal,'text');
}

function display_delete_confirm_dialog()
{
	if (check_valid_file_name())
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        Delete: function() {
          $( this ).dialog( "close" );
          exec_delete();
		  window.location.reload();
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
}

function form_inserimento_1_onSubmit()
{
	var newApp = $('#Nome_applicazione').get(0).value;
	var appsListOptionsObj = $('#Applicazioni').get(0).options;
	var found=false;
	for(var item in appsListOptionsObj)
	{
		if(appsListOptionsObj[item].label==newApp)
		{
			found=true;
			break;
		}
	}
	if(! found)
	{
	 ajaxHandler.synServerCall('ajax_handler.php','scanForItem',newApp,'text',/.*/);
	 var result = ajaxHandler.getOpByName('scanForItem').result; 
   if(result == 'true')
   {
    alert(loc.getString('msg',76));
    $('.spin').hide();
    return false; 
   }
  }
  return true;
}