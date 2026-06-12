<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

class Ldap 
{
 private $uri = STRING_NULL;
 private $connection = null;
 private $dn = STRING_NULL;
 private $password = STRING_NULL;
 private $entry=array();
 
 function __construct(string $actUri=STRING_NULL)
 {
  $this->setUri($actUri);
 }
 
 function openUri(string $actUri=STRING_NULL,int $actPort=389): LDAP\Connection|false
 {
  if($actUri==STRING_NULL)
   $actUri = $this->getUri();	  
  $connection = ldap_connect($actUri , $actPort);
  if($connection)
   $this->setConnection($connection);	  
  return $connection;
 }
 
 function close():void
 {
  $connection = $this->getConnection();
  ldap_close($connection);  
 }
 
 function setEntry(array $actEntry):void
 {
  $this->entry = $actEntry;
 }
 
 function getEntry():array
 {
  return $this->entry;
 }
 
 function setDn(string $actDn):void
 {
   $this->dn = $actDn;
 }
 
 function getDn():string
 {
  return $this->dn;
 }
 
 function setPassword(string $actPassword):void
 {
  $this->password = $actPassword;
 }
 
 function getPassword():string
 {
  return $this->password;
 }
 
 function setConnection(LDAP\Connection $actConnection):void
 {
  $this->connection = $actConnection;
 }
 
 function getConnection():LDAP\Connection
 {
  return $this->connection;
 }

 function setUri(string $actUri):void
 {
  $this->uri = $actUri;
 }
 
 function getUri():string
 {
  return $this->uri;
 }
 
 function bind(?string $actDn=null,?string $actPassword=null):bool
 {
   $connection = $this->getConnection();
   $this->setPassword($actPassword);
   $this->setDn($actDn);
   return ldap_bind($connection,$actDn,$actPassword);
 }
 
 function unbind():bool
 {
  $connection = $this->getConnection();
  return ldap_unbind($connection);
 }
 
 function add(array $actEntry):bool
 {
  $dn = $this->getDn();
  $ldap = $this->getConnection();
  $this->setEntry($actEntry);
  return ldap_add($ldap,$dn,$actEntry);
 }
 
 function delete():bool
 {
  $dn = $this->getDn();
  $ldap = $this->getConnection();
  return ldap_delete($ldap,$dn);
 }
 
 function modify(array $actValues):bool
 {
  $dn = $this->getDn();
  $ldap = $this->getConnection();
  return ldap_modify($ldap,$dn,$actValues);
 }
  
 function search(string $actBase,string $actFilter,array $actAttributes):LDAP\Result|array|false
 {
  $ldap = $this->getConnection();
  $result = ldap_search($ldap,$actBase,$actFilter,$actAttributes);
  if(($result)&&(! is_array($result)))
	$result = array($result);
  return $result;
 }
 
 function parse(\LDAP\Result $actResult,int &$actErrorCode,string &$actMatchedDn,string &$ErrorMsg,array &$actReferrals):bool
 {
  $ldap = $this->getConnection();
  return ldap_parse_result($ldap,$actResult,$actErrorCode,
  $actMatchedDn,
  $actErrorMsg,
  $actReferrals);
 }

 
}


?>