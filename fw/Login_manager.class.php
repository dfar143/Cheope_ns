<?
namespace Cheope_ns\fw;

require_once("root.const.php");
require_once("Ldap.class.php");
require_once("Creator.tra.php");
require_once("Xml_serializer.class.php");
require_once("filesystem.def.php");

class Login_manager 
{
 use Creator;	
	
 const LDAP_SERVER_URL='ldap://SEDVRADDCC001W6.sedi-direzioni.group';
 const DNS_DOMAIN = 'sedi-direzioni.group';
 
 private $username=STRING_NULL;
 private $password=STRING_NULL;
 private $ldapObj=null;
 private $fileUsersNames=STRING_NULL;
 
 function __construct(string $actUserName,string $actPassword)
 {
  $this->setUserName($actUserName);
  $this->setPassword($actPassword);
  $ldapObj = Creator::create("Ldap",STRING_NULL,self::LDAP_SERVER_URL);
  $ldapObj->setPassword($actPassword);
  $this->setLdap($ldapObj);  
 }
 
 function setLdap(Ldap $actDapObj):void
 {
	$this->ldapObj = $actDapObj;
 }	 
 
 function getLdap():Ldap
 {
	return $this->ldapObj;
 }
 
 function setFileUsersNames(string $actUsersNames):void
 {
	$this->usersNames = $actUsersNames; 
 }
 
 function getFileUsersNames():string
 {
	return $this->usersNames;
 }
 
 function setUserName(string $actUserName):void
 {
	$this->userName = $actUserName;
 }

 function getUserName():string
 {
	return $this->userName;
 }
 
 function setPassword(string $actPassword):void
 {
   $this->password = $actPassword;
 }
 
 function getPassword():string
 {
  return $this->password;
 }
 
 function getIdUtenteFromCredentials(string $actUserName,string $actPassword):string|bool
 {
  $usersParFile = CLIENT_PAR_FILE_PATH . DIR_SEP . XML_DIR . DIR_SEP . $this->getFileUsersNames();		 
  $xmlSerializer = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$usersParFile);
  $xmlSerializer->setDir(STRING_NULL);
  $xmlSerializer->loadData();
  $items = $xmlSerializer->getItems();
  $usersItems = $items["users"];
  foreach($usersItems as $userItem)
  {
   if((trim($userItem["user"])==$actUserName)&&(trim($userItem["password"])==$actPassword))
   {
	unset($xmlSerializer);
	return $userItem["id_utente"];
   }
  }
  return false;  
 }
 
  function testLogin():bool
 {
   $userName1 = $this->getUserName();
   $userName2 = $userName1 . STRING_AT . self::DNS_DOMAIN;
   $password = $this->getPassword();
   $ldap = $this->getLdap();
   $ldap->openUri();
   $ldapBind = @$ldap->bind($userName2,$password);
   if($ldapBind)
   {
    $ldap->close();
    return true;
   }
   else
   {
	$ldap->close();
 	$usersParFile = CLIENT_PAR_FILE_PATH . DIR_SEP . XML_DIR . DIR_SEP . $this->getFileUsersNames();		 
    $xmlSerializer = Creator::create(str_replace(__NAMESPACE__ . STRING_BACKSLASH,STRING_NULL,Classes_info::XML_SERIALIZER_CLASS),STRING_NULL,$usersParFile);
 	$xmlSerializer->setDir(STRING_NULL);
    $xmlSerializer->loadData();
 	$items = $xmlSerializer->getItems();
 	$usersItems = $items["users"];
	foreach($usersItems as $userItem)
	{
	 if((trim($userItem["user"])==$userName1)&&(trim($userItem["password"])==$password))
 	 {
	  unset($xmlSerializer);
	  return true;
	 }
    } 
    return false;	
   }
  }
}


?>