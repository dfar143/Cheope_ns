<?
namespace Cheope_ns\fw;

require_once("root.const.php");
require_once("Xml_serializer.class.php");
require_once("Classes_info.class.php");
require_once("cheope_ns_filesystem.const.php");

class Profiles_manager 
{
 use Creator;	
	
 const PROFILES_FILE_NAME = 'profiles';
 const PROFILES_USERS_LINK_FILE_NAME = 'users_profiles';
	
 private $idUtente=-1;
 
 function __construct(int $actIdUtente=-1)
 {
  $this->setIdUtente($actIdUtente);
 }
 
 function setIdUtente(int $actIdUtente):void
 {
  $this->idUtente = $actIdUtente;
 }
 
 function getIdUtente():int
 {
	return $this->idUtente;
 }
 
 function getUserIdProfiles(int $actIdUtente=-1):array
 {
   if($actIdUtente==-1)
    $idUtente = $this->getIdUtente();
   else
	$idUtente = $actIdUtente;

  	$profilesUsersFile = CLIENT_PAR_FILE_PATH . DIR_SEP . XML_DIR . DIR_SEP . self::PROFILES_USERS_LINK_FILE_NAME . FILE_NAME_ELEMENTS_SEP . XML_ACRONYM;		 
    $xmlSerializer = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$profilesUsersFile);
 	$xmlSerializer->setDir(STRING_NULL);
    $xmlSerializer->loadData();
 	$items = $xmlSerializer->getItems();
 	$usersProfilesItems = $items["users_profiles"]; 
	$usersIdProfiles = array();
	$ct=0;
    foreach($usersProfilesItems as $userProfile)
	{
	  if($userProfile["id_utente"] == $idUtente)
       $usersIdProfiles[$ct++]=$userProfile["id_profilo"];		  
	}
    return $usersIdProfiles;
 }
 
 function getUserProfileName(int $actIdProfilo):string
 {
  	$profilesFile = CLIENT_PAR_FILE_PATH . DIR_SEP . XML_DIR . DIR_SEP . self::PROFILES_FILE_NAME . FILE_NAME_ELEMENTS_SEP . XML_ACRONYM;		 
    $xmlSerializer = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$profilesFile);
 	$xmlSerializer->setDir(STRING_NULL);
    $xmlSerializer->loadData();
 	$items = $xmlSerializer->getItems();
 	$usersProfiles = $items["profiles"];  
    foreach($userProfile as $usersProfiles)
    {
	 if($userProfile["Id_profilo"] == $actIdProfilo)
	  return $userProfile["profilo"]; 
	}	
    return STRING_NULL;	
 }
 
}


?>