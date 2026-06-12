<?
namespace Cheope_ns\fw;

require_once("cheope_ns.const.php");
require_once("filesystem.def.php");

spl_autoload_register(function (string $actClassName)
{
	
	 $appDir = THIS_DIR;
	 
  if (file_exists($appDir . DIR_SEP . $actClassName . 
 	FILE_NAME_ELEMENTS_SEP . "class" . 
 	FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once ($actClassName . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE); 	
		
  $appDir = THIS_DIR . DIR_SEP . FRAMEWORK_DIR; 	
  	
  if (file_exists($appDir . DIR_SEP . $actClassName . 
 	FILE_NAME_ELEMENTS_SEP . "class" . 
 	FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once ($appDir . DIR_SEP . $actClassName . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE); 

	if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
	{
	 $appDir1 = $_SESSION[SESSION_VAR_ACTIVE_APP];
	 
 	 $appXmlDir1 = PREVIOUS_DIR . DIR_SEP . $appDir1 . DIR_SEP . 
   FRAMEWORK_DIR;
   $actClassName1 = str_replace(__NAMESPACE__,STRING_NULL,$actClassName);
   $actClassName2 = str_replace(STRING_BACKSLASH,STRING_NULL,$actClassName1);
  
   if(file_exists($appXmlDir1 . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
	 {	 
 	 require_once($appXmlDir1 . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);	 
	 }
	 
   $appDir2 = APPLICATION_NAME;
   
 	 $appXmlDir2 = PREVIOUS_DIR . DIR_SEP . $appDir2 . DIR_SEP . 
   FRAMEWORK_DIR;
   $actClassName1 = str_replace(__NAMESPACE__,STRING_NULL,$actClassName);
   $actClassName2 = str_replace(STRING_BACKSLASH,STRING_NULL,$actClassName1);
  
   if((file_exists($appXmlDir2 . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))&&($appDir2 !== $appDir1))
 	 require_once($appXmlDir2 . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);   
   
  }
  else
  { 	
   $appDir1 = APPLICATION_NAME;	
  	
 	 $appXmlDir1  = PREVIOUS_DIR . DIR_SEP . $appDir1 . DIR_SEP . 
   FRAMEWORK_DIR;
   $actClassName1 = str_replace(__NAMESPACE__,STRING_NULL,$actClassName);
   $actClassName2 = str_replace(STRING_BACKSLASH,STRING_NULL,$actClassName1);
  
   if(file_exists($appXmlDir1  . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE))
 	 require_once($appXmlDir1  . DIR_SEP . $actClassName2 . 
 	 FILE_NAME_ELEMENTS_SEP . "class" . 
 	 FILE_NAME_ELEMENTS_SEP . APP_LANGUAGE);
  }	 
 	 
});
  
?>