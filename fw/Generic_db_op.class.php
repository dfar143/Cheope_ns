<?
namespace Cheope_ns\fw;
require_once("generic.const.php");

abstract class Generic_db_op 
{
	const ERROR_1 = "Generic_db_op:Errore in getMaxId-Query non valida:";
	const ERROR_2 = "Generic_db_op:Errore in deleteDbRow-Query non valida:";
	const ERROR_3 = "Generic_db_op:Errore in deleteDbRows-Query non valida:";
	const ERROR_4 = "Generic_db_op:Errore in updateDbRow-Query non valida:";
	const ERROR_5 = "Generic_db_op:Errore in insertDbRow-Query non valida:";
	const ERROR_6 = "Generic_db_op:Errore in getAllOrdData-Query non valida:";
	const ERROR_7 = "Generic_db_op:Errore in getFilteredOrdData-Query non valida:";
	const ERROR_8 = "Generic_db_op:Errore in getFilteredData-Query non valida:";
	const ERROR_9 = "Generic_db_op:Errore in getAllDataByQuery-Query non valida:";
	const ERROR_10 = "Generic_db_op:Errore in getFilteredAllData-Query non valida:";
	const ERROR_11 = "Generic_db_op:Errore in getAllData-Query non valida:";
	const ERROR_12 = "Generic_db_op:Errore in getDistinctAllData-Query non valida:";
	const ERROR_13 = "Generic_db_op:Errore in getUniqueData-Query non valida:";
	const ERROR_14 = "Generic_db_op:Errore in getExtendedUniqueRow-Query non valida:";
	
	private $name = STRING_NULL;
	protected $user = STRING_NULL;
	protected $password = STRING_NULL;
	
	function __construct(string $actUser,string $actPassword)
	{
		$this->setUser($actUser);
		$this->setPassword($actPassword);
	}
	
	function getName():string
	{
		return $this->name;
	}
	
	function setName(string $actName):void
	{
	 $this->name = $actName;
	}
	
	function setUser(string $actUser):void
	{
		$this->user=$actUser;
	}
	
	function getUser():string
	{
		return $this->user;
	}
	
	function setPassword(string $actPassword):void
	{
		$this->password=$actPassword;
	}
	
	function getPassword():string
	{
		return $this->password;
	}	
	
	abstract function testConnection():void;
	
	abstract function testPresence(string $actTabName,string $actKeyField,int|string $actKeyVal):bool;
	
	abstract function getMaxId(string $actTabName,string $actKeyField):int;
	
	abstract function deleteDbRow(string $actTab,string $actKey,string|int $actId):void;
	
	abstract function deleteDbRows(string $actTab,string $actKey,string|int $actVal):int|false;	
	
	abstract function updateDbRow(string $actTab,string $actKeyField,array $actRow):void;
	
	abstract function insertDbRow(string $actTab,array $actRow):void;
	
	abstract function getAllOrdData(string $actTab,string $actOrdField,string $actField):array;
	
	abstract function getFilteredOrdData(string $actTab,string $actKeyField,
	int|string $actKeyValue,string $actOrdField,string $actField):array;
	
	abstract function getFilteredData(string $actTab,string|array $actKeyField,int|string|array $actKeyValue,string $actField):array;
	
	abstract function getAllDataByQuery(string $actQuery):array|int|string|bool;
	
	abstract function doQuery(string $actQueryStr):void;
	
	abstract function getFilteredAllData(string $actTab,string|array $actKeyField,int|string|array $actKeyValue):array;

  abstract function getAllData(string $actTab,string $actField):array;
  
  abstract function getDistinctAllData(string $actTab,string $actField):array;
  
  abstract function getUniqueData(string $actTab,string $actKeyField,int $actKeyValue,string $actField):string|int|bool;
  
  abstract function getExtendedUniqueRow(string $actTab,string|array $actKeyField,int|string|array $actKeyValue):array|false;
  
}

?>