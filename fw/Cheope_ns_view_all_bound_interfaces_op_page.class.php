<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");

date_default_timezone_set("Europe/Rome");
define('DEFAULT_PAGE_NAME',"view_all_bound_interfaces");
define('THIS_PAGE',"view_all_bound_interfaces.php");

class Cheope_ns_view_all_bound_interfaces_op_page extends Cheope_ns_page
{
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum=0);
	$this->isASessionPage=true;
 }
 
  function putLinkTags():void
 {
 	parent::putLinkTags();
  putLinkTag(STRING_NULL,CLIENT_STYLE_SHEET_PATH . DIR_SEP . 
  DEFAULT_PAGE_NAME . STYLE_SHEET_FILE_POSTFIX);
 }
 
 function putClientScriptIncludeCode():void
 {
  $htmlWriter = $this->getHtmlWriter();
  $interfaces = $this->getInterfacesContainer();
  parent::putClientScriptIncludeCode(); 
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
 	
  if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
  {     
   $int_iter = $interfaces->create();
   $int = $int_iter->last();
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