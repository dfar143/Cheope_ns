<?
namespace Cheope_ns\fw;
require_once("Generic_db_op.class.php");
require_once("sql_server.const.php");
require_once("Creator.tra.php");

class Sqlsrv_db_op extends Generic_db_op
{
	use Creator;
	
	const ERROR_1 = "Sqlsrv_db_op:Impossibile connettersi al database. Ritentare più tardi.";
	const ERROR_2 = "Sqlsrv_db_op:Errore in insertDbRowGetIdentity-Query non valida.";
	const ERROR_3 = "Sqlsrv_db_op:Errore in getAllDataByQuery-Query non valida.";
	
	private $host=STRING_NULL;
	private $db=STRING_NULL;
	private $connectionInfo=array();
	private $connectionError=self::ERROR_1;
	
  function __construct(string $actUser,string $actPassword,
  string $actHost,string $actDb,string $actPort=STRING_NULL)
	{
		parent::__construct($actUser,$actPassword);
	  $this->setHost($actHost);
	  $this->setDb($actDb);
	  $this->setConnectionInfoByPars($actUser,$actPassword,$actDb);
	}
	
	function setConnectionError(string $actConnectionError):void
	{
		$this->connectionError = $actConnectionError;
	}
	
	function getConnectionError():string
	{
		return $this->connectionError;
	}
	
	function setHost(string $actHost):void
	{
		$this->host = $actHost;
	}
	
	function getHost():string
	{
		return $this->host;
	}
	
	function setDb(string $actDb):void
	{
		$this->db = $actDb;
	}
	
	function getDb():string
	{
		return $this->db;
	}
	
	function setConnectionInfo(array $actConnectionInfo):void
	{
		$this->connectionInfo = $actConnectionInfo;
	}	
	
	function getConnectionInfo():array
	{
		return $this->connectionInfo;
	}
	
	function setConnectionInfoByPars(string $actUser,string $actPassword,string $actDb):void
	{
		$connInfo = $this->getConnectionInfo();
		$connInfo["UID"] = $actUser;
		$connInfo["PWD"] = $actPassword;
		$connInfo["Database"] = $actDb;
		$this->setConnectionInfo($connInfo);
	}

 function testConnection():void
 {
	$sqlsrv_connectionInfo = $this->getConnectionInfo();
	 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

     if(!$conn)
     {
  	  $error = sqlsrv_errors();
  	  $e = Creator::create("Exception",STRING_BACKSLASH,$error[0]['message']);
      throw $e; 
     }
	sqlsrv_close($conn);	 

 }
	
// Controlla che il valore di chiave sia contenuto nella tabella
// Per ipotesi la chiave è numerica.
//
 function testPresence(string $actTabName,string $actKeyField,int|string $actKeyVal):bool
 {
  $query = "Select * from " . $actTabName . " where " .
  $actKeyField . " = " . $actKeyVal;
  $rows = $this->getAllDataByQuery($query);
  $num = count($rows);
  if($num==0)
	 return false;
  return true;
 }
	
 function getMaxId(string $actTabName,string $actKeyField):int
 {
	$sqlsrv_connectionInfo=$this->getConnectionInfo();
	$host = $this->getHost();
	
	$conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }
	
	$query = "select " . $actKeyField . " from " . $actTabName . 
	" order by " . $actKeyField . " Desc";
	$result = sqlsrv_query($conn,$query,array(),
	array('scrollable'=>SQLSRV_CURSOR_STATIC)) or 
	die(Generic_db_op::ERROR_1 . print_r(sqlsrv_errors()));

	$num_results = sqlsrv_num_rows($result);
	$maxId =0;
	if($num_results >0)
	{
	 $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
   $maxId = $row[$actKeyField];
	}
  sqlsrv_free_stmt($result);
	sqlsrv_close($conn);
	return $maxId;
 }

//
// Il campo $actKey deve contenere il nome del campo chiave.
// La chiave deve essere numerica.
//
 function deleteDbRow(string $actTab,string $actKey,int|string $actId):void
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	
	
  $query = "DELETE FROM " . $actTab . " WHERE " . 
  $actKey . "=" . $actId; 
 
  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  $result = sqlsrv_query($conn,$query) or 
  die(Generic_db_op::ERROR_2 . print_r(sqlsrv_errors()));
  sqlsrv_free_stmt($result);
  sqlsrv_close($conn);	
 }

 function deleteDbRows(string $actTab,string $actField,string|int $actVal):int|false
 {
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	
	
  if(is_string($actVal))
   $query = "DELETE FROM " . $actTab . " WHERE " . 
   $actField . "='" . $actVal . "'"; 
  else
   $query = "DELETE FROM " . $actTab . " WHERE " . 
   $actField . "=" . $actVal; 
 
  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }
 
  $result = sqlsrv_query($conn,$query) or 
  die(Generic_db_op::ERROR_3 . print_r(sqlsrv_errors()));
  $rowsAffected = sqlsrv_rows_affected($result);
  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);
  return $rowsAffected;	
 }

//
// $actRow deve contenere il valore della chiave principale
// (supposta atomica)
//
 function updateDbRow(string $actTab,string $actKeyField,array $actRow):void
 {		
	
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	
  $cols='';
  $i=0;
  foreach($actRow as $fieldName => $fieldValue)
  {
 // La riga successiva solo per 
 // Sql server.
 //
   if ($fieldName != $actKeyField)
   if($i==0)
	 {
	  if(is_null($fieldValue))
		 $cols = $fieldName . "=" . 'NULL';
	  elseif (is_string($fieldValue))
	   $cols = $fieldName . "=" . "'" . $fieldValue . "'";
	  else
	   $cols = $fieldName . "=" . $fieldValue;
	  $i++;
	 } 
	 else
	 {
	  if(is_null($fieldValue))
		 $cols = $cols . "," . $fieldName . "=" . 'NULL';
	  elseif (is_string($fieldValue))
     $cols = $cols . "," . $fieldName . "=" . "'" . $fieldValue . "'";
	  else
	   $cols = $cols . "," . $fieldName . "="  . $fieldValue;
	 }
  }	
 
  $actId = $actRow[$actKeyField];
  $query = "UPDATE " .
         strtolower($actTab) . " SET " . $cols . 
        " WHERE " . $actKeyField . " = " . $actId ;

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);
 
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  } 
 
  $result = sqlsrv_query($conn,$query) or 
  die(Generic_db_op::ERROR_4 . 
  print_r(sqlsrv_errors()));
  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);
 }

//
// Solo per Sql server
//
function insertDbRowGetIdentity(string $actTab,array $actRow,int|string &$actId):void
{
	
 $sqlsrv_connectionInfo=$this->getConnectionInfo();
 $host = $this->getHost();	
 $cols='';
 $vals='';	
 $i=0;
 foreach($actRow as $fieldName => $fieldValue)
 {
  if($i==0)
	{
	 $cols = $fieldName;
	 if(is_null($fieldValue))
	   $vals = 'NULL';
	 elseif(is_string($fieldValue))
	   $vals = "'" . $fieldValue . "'";
	 else
	   $vals = $fieldValue;
	 $i++;	 
	} 
	else
	{
   $cols = $cols . "," . $fieldName;
	 if(is_null($fieldValue))
	   $vals = $vals . "," . 'NULL';
   elseif(is_string($fieldValue))
     $vals = $vals . "," . "'" . $fieldValue . "'";
	 else
	   $vals = $vals . "," . $fieldValue;
	}
 }	
 
 $query = "INSERT " .
        " INTO " . strtolower($actTab) . " (" . $cols . ")" .
        " VALUES (" . $vals . ")";  
 
 $query = $query . STRING_SEMICOLON . "select @@IDENTITY as Id" . 
 STRING_SEMICOLON;
 
 $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);
 
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }
 
  $result = sqlsrv_query($conn,$query) or 
  die(Genric_db_op::ERROR_2 . print_r(sqlsrv_errors()));
  list ($actId) = sqlsrv_fetch_row($result,SQLSRV_FETCH_ASSOC);
  sqlsrv_free_stmt($result);  
  sqlsrv_close($conn);
 }


 function insertDbRow(string $actTab,array $actRow):void
 {
	
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	
  $cols='';
  $vals='';	
  $i=0;
  foreach($actRow as $fieldName => $fieldValue)
  {
   if($i==0)
	 {
	  $cols = $fieldName;
	  if(is_null($fieldValue))
	   $vals = 'NULL';
	  elseif(is_string($fieldValue))
	   $vals = "'" . $fieldValue . "'";
	  else
	   $vals = $fieldValue;
	  $i++;	 
	 }  
	 else
	 {
    $cols = $cols . "," . $fieldName;
	  if(is_null($fieldValue))
	   $vals = $vals . "," . 'NULL';
    elseif(is_string($fieldValue))
     $vals = $vals . "," . "'" . $fieldValue . "'";
	  else
	   $vals = $vals . "," . $fieldValue;
	 }
  }	
 
  $query = "INSERT " .
        " INTO " . strtolower($actTab) . 
        " (" . $cols . ")" .
        " VALUES (" . $vals . ")";  
 
  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  $result = sqlsrv_query($conn,$query) or 
  die(Generic_db_op::ERROR_5 . 
  print_r(sqlsrv_errors()));
  sqlsrv_free_stmt($result);  
  sqlsrv_close($conn);	
 }

//
// Ritorna una colonna della tabella 
// col solo campo $actField ordinato per $actOrdField
//
 function getAllOrdData(string $actTab,string $actOrdField,string $actField):array
 {
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   die($this->getConnectionError());
  }

  $actOrd = " order by ";
  if (! is_array($actOrdField))
   $actOrd = $actOrd . $actOrdField;
  else
  {
   $num = count($actOrdField);
   $i=0;
   if ($num>1)
   for($i=0;$i<=$num-1;$i++)
   {
    if ($i < $num - 1)
     $actOrd = $actOrd . $actOrdField[$i] . ",";
   }

   $actOrd = $actOrd . $actOrdField[$num-1];
  } 

  $query = "select * from " . $actTab . $actOrd;
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) 
  or die(Generic_db_op::ERROR_6 . 
  print_r(sqlsrv_errors()));

  $row=array();
  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  {
   $row[] = $rRow[$actField];
  } 

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

//
// Ritorna un array contenente i valori del campo $actField
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
// I dati vengono ordinate in base all'argomento $actOrdField e filtrati in
// base ai valori $actKeyValue delle chiavi $actKeyField
// 
 function getFilteredOrdData(string $actTab,string $actKeyField,int|string
 $actKeyValue,string $actOrdField,string $actField):array
 {
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
    print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  if($actKeyValue != STRING_NULL)
  {
   if (is_string($actKeyValue))
   {
    $query = "select distinct * from " . $actTab . " where " . $actKeyField . 
    " = '" . $actKeyValue . "' order by " . $actOrdField . " asc";
   }
   else
   {
    $query = "select distinct * from " . $actTab . " where " . $actKeyField . 
    " = " . $actKeyValue . " order by " . $actOrdField . " asc";
   }
  }
  else
   $query = "select distinct * from " . $actTab . 
   " order by " . $actOrdField . " asc";

  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
  die(Generic_db_op::ERROR_7 . 
  print_r(sqlsrv_errors()));
  $row = array();

  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  {
   $row[] = $rRow[$actField];
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

//
// Ritorna un array contenente i valori del campo $field
// per ogni riga dellla tabella filtrata.
// In pratica ritorna una colonna della tabella.
//
 function getFilteredData(string $actTab,string|array $actKeyField,
 int|string|array $actKeyValue,string $actField):array
 {
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	
 
  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  if (! is_array($actKeyField))
  {
   if (is_string($actKeyValue))
   {
    $whereClause = $actKeyField . " = '" . $actKeyValue . "'";
   }
   else
   {
    $whereClause = $actKeyField . " = " . $actKeyValue;
   }
  }
  else
  {
   if (is_string($actKeyValue[0]))
    $whereClause = "(" . $actKeyField[0] . " = '" . $actKeyValue[0] . "')";
   else
    $whereClause = "(" . $actKeyField[0] . " = " . $actKeyValue[0] . ")";
	
   $num = count($actKeyField);
   for($i=1;$i<=$num-1;$i++)
   {
    if (is_string($actKeyValue[$i]))
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = '" . $actKeyValue[$i] . "')"; 
    else
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = " . $actKeyValue[$i] . ")";  
   }
  }
  
  $query = "select * from " . $actTab . " where (" . $whereClause . ")";
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
  die(Generic_db_op::ERROR_8 . 
  print_r(sqlsrv_errors()));
  $num = sqlsrv_num_rows($result);

  $row = array();

  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  {
   $row[] = $rRow[$actField];
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

//
// esegue una query generica;
//
  function doQuery(string $actQuery):void
  {
   $sqlsrv_connectionInfo=$this->getConnectionInfo();
   $host = $this->getHost();	

   $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   die($this->getConnectionError());
  }
  $result = sqlsrv_query($conn,$actQuery,array(),
  array('scrollable'=>SQLSRV_CURSOR_STATIC));
  if(! $result)
  {
   $error = sqlsrv_errors();
   $e = Creator::create("Exception",STRING_BACKSLASH,$error[0]['message']);
	 sqlsrv_close($conn);
	 throw $e; 
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);
 }


//
// Ritorna tutti i dati (array di array)
// da una query specificata come argomento.
 function getAllDataByQuery(string $actQuery):array|int|string|bool
 {
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors());
   die($this->getConnectionError()); 
  }
  $result = sqlsrv_query($conn,$actQuery,array()) or 
  die(Generic_db_op::ERROR_9 .
  print_r(sqlsrv_errors(),true));

  $rowsAffected = sqlsrv_rows_affected($result);
 
  if($rowsAffected < 0)
  {
   $row = array();
   $i=0;
   $rRow=true;

   while(! is_null($rRow))
   {
   $rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
   $newRow = array();
   if(is_array($rRow))
   {
    foreach($rRow as $ind=>$val)
    {
   	 if(is_a($val,"DateTime"))
   	 {
   	  $timeStamp = $val->getTimestamp();
   	  $newVal = date(SQL_SERVER_DATE_FORMAT,$timeStamp);
   	 }
   	 else
   	  $newVal = $val;
   	 $newRow[$ind]=$newVal;
    }
    $row[$i++] = $newRow;
   }
   }
   $res=$row;
  }
  elseif($rowsAffected==0)
  {
 	 $res=array();
  }
  else
  {
 	 $res=$rowsAffected;
  }
  sqlsrv_free_stmt($result);
  sqlsrv_close($conn);

  return $res;
 }

//
// Ritorna tutti i dati (array di array)
// da una query specificata come argomento con parametri.
 function getAllDataByQueryWithParams(string $actQuery,array $params):array|int|string|false
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }
  $result = sqlsrv_query($conn,$actQuery,$params) or
  die(self::ERROR_3 .
  print_r(sqlsrv_errors(),true));

 $rowsAffected = sqlsrv_rows_affected($result);

 if($rowsAffected < 0)
 {
  $row = array();
  $i=0;
  $rRow=true;

  while(! is_null($rRow)) 
  {
   $rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
   $newRow = array();
   if(is_array($rRow))
   {
    foreach($rRow as $ind=>$val)
    {
   	 if(is_a($val,"DateTime"))
   	 {
   	  $timeStamp = $val->getTimestamp();
   	  $newVal = date(SQL_SERVER_DATE_FORMAT,$timeStamp);
   	 }
   	 else
   	  $newVal = $val;
   	 $newRow[$ind]=$newVal;
    }
    $row[$i++] = $newRow;
   }
  }
  $res=$row;
 }
 else
  $res=$rowsAffected;
  
  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);
  return $res;
 }

//
// Ritorna un array contenente tutti i campi 
// per ogni riga dellla tabella.
// In pratica ritorna una tabella (array di array di cui 
// il primo indice conta i record ed il secondo i
// campi.
//
 function getFilteredAllData(string $actTab,string|array $actKeyField,string|int|array $actKeyValue):array
 {
 
  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();	

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  if (! is_array($actKeyField))
  {
   if (is_string($actKeyValue))
   {
    $whereClause = $actKeyField . " = '" . $actKeyValue . "'";
   }
   else
   {
    $whereClause = $actKeyField . " = " . $actKeyValue;
   }
  }
  else
  {
   if (is_string($actKeyValue[0]))
    $whereClause = "(" . $actKeyField[0] . " = '" . $actKeyValue[0] . "')";
   else
    $whereClause = "(" . $actKeyField[0] . " = " . $actKeyValue[0] . ")";
	
   $num = count($actKeyField);
   for($i=1;$i<=$num-1;$i++)
   {
    if (is_string($actKeyValue[$i]))
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = '" . $actKeyValue[$i] . "')"; 
    else
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = " . $actKeyValue[$i] . ")";  
   }
  }
  
  $query = "select * from " . $actTab . " where (" . $whereClause . ")";
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
  die(Generic_db_op::ERROR_10 . print_r(sqlsrv_errors()));
  $num = sqlsrv_num_rows($result);

  $row = array();

  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  {
   $row[] = $rRow;
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

//
// Ritorna un array contenente i valori del campo $actField
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
//
 function getAllData(string $actTab,string $actField):array
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);
  
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  $query = "select distinct * from " . $actTab ;
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
  die(Generic_db_op::ERROR_11 . print_r(sqlsrv_errors()));
  $row=array();

  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  { 
   $row[] = $rRow[$actField];
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

 function getDistinctAllData(string $actTab,string $actField):array
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();

  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  $query = "select distinct " . $actField . " from " . $actTab . 
  " order by " . $actField;
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
  die(Generic_db_op::ERROR_12 . print_r(sqlsrv_errors()));
  $row=array();

  while($rRow = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
  {
   $row[] = $rRow[$actField];
  }

  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);

  return $row;
 }

//
// Ritorna il valore di un campo da una riga unica della tabella in base 
// alla chiave 
// passata come argomento.
// La chiave deve essere numerica.
//
 function getUniqueData(string $actTab,string $actKeyField,int $actKeyValue,string $actField):string|int|bool
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();

 $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }
 
  $query = "select * from " . $actTab . " where " . $actKeyField . " = " . (string)$actKeyValue;

  $result = sqlsrv_query($conn,$query,
  array(),array('scrollable'=>SQLSRV_CURSOR_STATIC)) or 
  die(Generic_db_op::ERROR_13 . print_r(sqlsrv_errors()));
  $num_results = sqlsrv_num_rows($result);
  $row = array();

  if($num_results==1)
  {
   $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);
   $res = $row[$actField];
  }
  elseif($num_results==0)
   $res = STRING_NULL;
 
  sqlsrv_free_stmt($result); 
  sqlsrv_close($conn);
 
  if($num_results > 1)
   return false;
 
  return $res;
 }

//
// Ritorna una riga unica della tabella in base 
// alla chiave 
// passata come argomento.
// La chiave in generale è un vettore.
//
 function getExtendedUniqueRow(string $actTab,string|array $actKeyField,int|string|array $actKeyValue):array|false
 {

  $sqlsrv_connectionInfo=$this->getConnectionInfo();
  $host = $this->getHost();
	
  $conn = sqlsrv_connect($host,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die($this->getConnectionError());
  }

  if (! is_array($actKeyField))
  {
   if (is_string($actKeyValue))
   {
    $whereClause = $actKeyField . " = '" . $actKeyValue . "'";
   }
   else
   {
    $whereClause = $actKeyField . " = " . $actKeyValue;
   }
  }
  else
  {
   if (is_string($actKeyValue[0]))
    $whereClause = "(" . $actKeyField[0] . " = '" . $actKeyValue[0] . "')";
   else
    $whereClause = "(" . $actKeyField[0] . " = " . $actKeyValue[0] . ")";
	
   $num = count($actKeyField);
   for($i=1;$i<=$num-1;$i++)
   {
    if (is_string($actKeyValue[$i]))
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = '" . $actKeyValue[$i] . "')"; 
    else
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = " . $actKeyValue[$i] . ")";  
   }
  }
  
  $query = "select * from " . $actTab . " where (" . $whereClause . ")";
  $result = sqlsrv_query($conn,$query,array(),
  array('scrollable'=>SQLSRV_CURSOR_STATIC)) or 
  die(Generic_db_op::ERROR_14 . print_r(sqlsrv_errors()));
  $num_results = sqlsrv_num_rows($result);
  $row=array();

  if($num_results==1)
   $row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC);

  sqlsrv_free_stmt($result);  
  sqlsrv_close($conn);
 
  if($num_results > 1)
   return false;
 
  return $row;
 }

}


?>