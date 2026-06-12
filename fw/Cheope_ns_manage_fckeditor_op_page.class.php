<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"manage_fckeditor");
define('THIS_PAGE',"manage_fckeditor.php");

class Cheope_ns_manage_fckeditor_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
 	parent::putLinkTags();
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  parent::putClientScriptIncludeCode();
  /*if(! isset($_GET[PAR]))
  {
   $interfaces->deleteItem(1);
  }*/
 }
   

 function putActiveApp():void
 {
 }
 
 function putHeader():void
 {
 }

 function putBody():void
 {
 	
 	$interfaces = $this->getInterfacesContainer();
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]) && $_SESSION[SESSION_VAR_ACTIVE_APP]!=STRING_NULL)
  {     
   $int_iter = $interfaces->create();
   $int_iter->reset();
   $int_iter->next();
   $int = $int_iter->current();
   if(isset($_GET[PAR]))
   {
    $val = $_GET[PAR];
	$int->setValue($val);
    $int_iter->reset();
    $int = $int_iter->current();

   }
   else
   {
	$int->setValue($_GET['FCKEditor__1']);
    $int_iter->reset();
    $int = $int_iter->current();


   }
    $int->putData();
  } 
  else
  {
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
   $int->putData();
  }
 }
}
?>