function button_1_onClick(actObj)
{
 var i=0;
 var j=0;
 var result=true;
 var filesDistinct = $('#Tutti_files_checkBox_id').get(0).checked;
 var deleteOldFiles = $('#Delete_old_files_checkBox_id').get(0).checked;
 var exportEnvironment = $('#Export_environment_checkBox_id').get(0).checked;
 var deleteOldEnvironment = $('#Delete_old_environment_checkBox_id').get(0).checked;
 if(filesDistinct)
  filesDistinct='true';
 else
 	 filesDistinct = 'false';
 if(deleteOldFiles)
  deleteOldFiles='true';
 else
 	 deleteOldFiles = 'false';
 if(exportEnvironment)
  exportEnvironment='true';
 else
 	 exportEnvironment = 'false';
 if(deleteOldEnvironment)
  deleteOldEnvironment='true';
 else
 	 deleteOldEnvironment = 'false';
  
 $('#simple_table__1 input').each(function(){
 	if(this.checked)
 	{
 	 var fileNameId = 'simple_table__1_field_id_Name_' + i;
 	 var dirId = 'simple_table__1_field_id_Dir_' + i;
 	 fileName = $('#' + fileNameId).text();
 	 dir = $('#' + dirId).text();
 	 if(j==0)
 	  ajaxHandler.synServerCall('ajax_handler.php','export',dir + ';' + 
 	  fileName + ';' + filesDistinct + ';' + deleteOldFiles + ';' + 
 	  exportEnvironment + ';' + deleteOldEnvironment,"text",/[.]*\w[.]*/);
 	 else
 	  ajaxHandler.synServerCall('ajax_handler.php','export',dir + ';' + 
 	  fileName + ';' + filesDistinct + ';' + 'false' + ';' + 
 	  'false' + ';' + 'false',"text",/[.]*\w[.]*/);
 	   	 	
 	 if (ajaxHandler.getOpByName('export').result==false)
 	  result=false;
 	 j++;
 	}
 	i++;
 	});

 	if(result)
 	 alert(loc.getString('msg',64));
}

function button_exec_onClick(actObj)
{
	var pageName = $(actObj).parent().parent().parent().find('.simple_table_column_Name > div').text();
  var appName = $('#active_application_id').text();

  var serverName = interfacesContainer.getInterface('Op1').getServerName();
  var docRoot = interfacesContainer.getInterface('Op1').getDocRoot();

  window.open('http://' + serverName +
   '/' + docRoot + '/' + appName +
   '/' + appName + '/' + pageName);  
}

function checkBox_esporta_tutti_i_files_distinti_onClick()
{ 
 $(function() {
  $( '#dialog-confirm' ).dialog({
    resizable: false,
    height:180,
    modal: true,
    buttons: {
    'Continue': function() {
 
				$( this ).dialog( 'close' );
                },
    'Cancel': function() {
     $( "#Tutti_files_checkBox_id" ).get(0).checked=false;
     $( this ).dialog( 'close' );
     }
     }
    });
 }); 
}

function checkBox_cancella_vecchi_files_onClick()
{ 
 $(function() {
  $( '#dialog-confirm-2' ).dialog({
    resizable: false,
    height:180,
    modal: true,
    buttons: {
    'Continue': function() {
				$( this ).dialog( 'close' );
                },
    'Cancel': function() {
     $( "#Delete_old_files_checkBox_id" ).get(0).checked=false;
     $( this ).dialog( 'close' );
     }
     }
    });
 }); 
}

function checkBox_esporta_ambiente_onClick()
{ 
 $(function() {
  $( '#dialog-confirm-3' ).dialog({
    resizable: false,
    height:180,
    modal: true,
    buttons: {
    'Continue': function() {
				$( this ).dialog( 'close' );
                },
    'Cancel': function() {
     $( "#Export_environment_checkBox_id" ).get(0).checked=false;
     $( this ).dialog( 'close' );
     }
     }
    });
 }); 
}

function checkBox_cancella_vecchio_ambiente_onClick()
{ 
 $(function() {
  $( '#dialog-confirm-4' ).dialog({
    resizable: false,
    height:180,
    modal: true,
    buttons: {
    'Continue': function() {
				$( this ).dialog( 'close' );
                },
    'Cancel': function() {
     $( "#Delete_old_environment_checkBox_id" ).get(0).checked=false;
     $( this ).dialog( 'close' );
     }
     }
    });
 }); 
}

function button_1_display_dialog()
{ 
 $(function() {
  $( '#dialog-confirm-5' ).dialog({
    resizable: false,
    height:180,
    modal: true,
    buttons: {
    'Continue': function() {
				$( this ).dialog( 'close' );
				$('.spin').show();
				button_1_onClick();
				$('.spin').hide();
                },
    'Cancel': function() {
       $( this ).dialog( 'close' );
     }
     }
    });
 }); 
}