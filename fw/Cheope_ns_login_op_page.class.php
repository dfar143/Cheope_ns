<?
namespace Cheope_ns\fw;
require_once("Cheope_ns_page.class.php");

define('DEFAULT_PAGE_NAME',"login");
define('THIS_PAGE',"login.php");


class Cheope_ns_login_op_page extends Cheope_ns_page
{
 
 const PASSWORD_LENGTH = 8;
 const USERNAME_LENGTH = 8;
 
 function __construct($actNum=STRING_NULL) 
 {
  parent::__construct(DEFAULT_PAGE_NAME,OP_NONE,$actNum);
	$this->isASessionPage=true;
 }
 
 function putActiveApp():void
 {
 }
 
 // Metodo per visualizzazione intestazione pagina.
 function putHeader():void
 {
 	$htmlWriter = $this->getHtmlWriter();
  $htmlWriter->putGenericHtmlString("<div class=\"header\">" . 
  LABEL_NOME_APPLICAZIONE . 
  "</div>");
 }
 
 function putClientScriptIncludeCode():void
 {
	$interfaces = $this->getInterfacesContainer();
	$int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
 	if(isset($_POST[FIELD_USER]) && isset($_POST[FIELD_PASSWORD]))
 	{
 		if((strlen($_POST[FIELD_USER])>=self::USERNAME_LENGTH)&&
 		(strlen($_POST[FIELD_PASSWORD])>=self::PASSWORD_LENGTH))
	  {
 		 $usersParFile =  CLIENT_PAR_FILE_PATH . DIR_SEP . XML_FILE_USERS; 		
 		 $xmlSerializer1 = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$usersParFile);
 		 $xmlSerializer1->setDir(STRING_NULL);
 		 $xmlSerializer1->loadData();
 		 $items = $xmlSerializer1->getItems();
 		 $usersItems = $items["users"];
		 
 		 $num1 = count($usersItems);
 		 $int->setText(MSG_8);
 		 $int->setSequenceStrings(array(STRING_NULL,MSG_8));
 		 for($i=0;$i<=$num1-1;$i++)
 		 {
 		 	$item = $usersItems[$i];
 		 	if((trim($item[strtolower(FIELD_USER)])==$_POST[FIELD_USER])&&
 		 	(trim($item[strToLower(FIELD_PASSWORD)])==$_POST[FIELD_PASSWORD]))
 		 	{
 		   $_SESSION[SESSION_VAR_USER] = $_POST[FIELD_USER];
 		   $_SESSION[SESSION_VAR_PASSWORD] = $_POST[FIELD_PASSWORD];
 		   $_SESSION[SESSION_VAR_ACTIVE_APP] = STRING_NULL;
 		   $int->setText(MSG_7);
 		   $int->setSequenceStrings(array(STRING_NULL,MSG_7));
 		   $int->setGesPage(PAGE_STARTT);
		   break;		
		   }			   		   
 		  }	
 	  }
 	  else
 	  {
 	   $int->setText(MSG_6);
 	   $int->setSequenceStrings(array(STRING_NULL,MSG_6));
 	  }
 	}
 	else
 	{
 	 unset($_SESSION[SESSION_VAR_ACTIVE_APP]);
 	 unset($_SESSION[SESSION_VAR_USER]);
 	 unset($_SESSION[SESSION_VAR_PASSWORD]);
 	}
 	parent::putClientScriptIncludeCode();
 }
 
 function putBody():void
 {
 	$interfaces = $this->getInterfacesContainer(); 	
 	$int_iter = $interfaces->create();
 	if(isset($_POST[FIELD_USER]) && isset($_POST[FIELD_PASSWORD]))
 	{
	 $int = $interfaces->getInterface(OBJ_NONE,OP_NONE,Interfaces_info::INT_TEMP_MSG,NUM_0);
	 $int->putData();
	}
	else
	{		
 	 $int = $int_iter->last();
   $int->putData();  
  }
 }
 
  
}
?>