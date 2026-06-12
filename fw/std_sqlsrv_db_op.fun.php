<?
namespace Std\fw;

 require_once("db.const.php");

function getConnectionInfo():array
{
 $sqlsrv_connectionInfo=array("UID"=>SQLSRV_USER,"PWD"=>SQLSRV_PASSWORD,"Database"=>SQLSRV_DB,"Encrypt"=>0);
 return $sqlsrv_connectionInfo;
}

// Controlla che il valore di chiave sia contenuto nella tabella
// Per ipotesi la chiave è numerica.
//
function testPresence(string $actTabName,string $actKeyField,int|string $actKeyVal):bool
{
 $query = "Select * from " . $actTabName . " where " .
 $actKeyField . " = " . $actKeyVal;
 $rows = getAllDataByQuery($query);
 $num = count($rows);
 if($num==0)
	return false;
 return true;
}

function testConnection():void
{
	$sqlsrv_connectionInfo =getConnectionInfo();
	
	$conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
  if(!$conn)
  {
  	$error = sqlsrv_errors();
  	$e = Creator::create("Exception",STRING_BACKSLASH,$error[0]['message']);
  	//$e = new \Exception($error[0]['message']);
    throw $e; 
  }	
	sqlsrv_close($conn);
}

function getMaxId(string $actTabName,string $actKeyField):int
{
	$sqlsrv_connectionInfo=getConnectionInfo();
	
	$conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  }
	
	$query = "select " . $actKeyField . " from " . $actTabName . " order by " . $actKeyField . " Desc";
	$result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_STATIC)) or 
	die("Errore in getMaxId-Query non valida.");
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

function deleteDbRow(string $actTab,string $actKey,int|string $actId):void
{

 $sqlsrv_connectionInfo=getConnectionInfo();	
	
 $query = "DELETE FROM " . $actTab . " WHERE " . 
 $actKey . "=" . $actId; 
 
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  }

 $result = sqlsrv_query($conn,$query) or die("Errore in deleteDbRow-Query non valida" );
 sqlsrv_free_stmt($result);
 sqlsrv_close($conn);	
 //return true;
}

function deleteDbRows(string $actTab,string $actField,string|int $actVal):int|false
{
	
 $sqlsrv_connectionInfo=getConnectionInfo();	
	
 if(is_string($actVal))
  $query = "DELETE FROM " . $actTab . " WHERE " . 
  $actField . "='" . $actVal . "'"; 
 else
  $query = "DELETE FROM " . $actTab . " WHERE " . 
  $actField . "=" . $actVal; 
 
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  }
 
 $result = sqlsrv_query($conn,$query) or die("Errore in deleteDbRows-Query non valida");
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
	
 $sqlsrv_connectionInfo=getConnectionInfo();	
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

 
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
 
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  } 
 
 $result = sqlsrv_query($conn,$query) or die("Errore in updateDbRow-Query non valida");

 sqlsrv_free_stmt($result);
 sqlsrv_close($conn);
 
 /*if(! $result)
 	return false;
 
 return true;	*/	
}

//
// Solo per Sql server
//
function insertDbRowGetIdentity(string $actTab,array $actRow,string &$actId):void
{
	
 $sqlsrv_connectionInfo=getConnectionInfo();	
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
 
 $query = $query . STRING_SEMICOLON . "select @@IDENTITY as Id" . STRING_SEMICOLON;
 
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
 
  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  }
 
 $result = sqlsrv_query($conn,$query) or die("Errore in insertDbRow-Query non valida");
 list ($actId) = sqlsrv_fetch_row($result,SQLSRV_FETCH_ASSOC);
 sqlsrv_free_stmt($result); 
 sqlsrv_close($conn);	
}

function insertDbRow(string $actTab,array $actRow):void
{
	
 $sqlsrv_connectionInfo=getConnectionInfo();
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
 
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
  }

 $result = sqlsrv_query($conn,$query) or die("Errore in insertDbRow-Query non valida");
 sqlsrv_free_stmt($result); 
 sqlsrv_close($conn);	
}

//
// Ritorna una colonna della tabella 
// col solo campo $actField ordinato per $actOrdField
//
function getAllOrdData(string $actTab,string $actOrdField,string $actField):array
{

 $sqlsrv_connectionInfo=getConnectionInfo();

$conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

  if(!$conn)
  {
   die(SQLSRV_CONNECTION_ERROR);
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
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or
 die("getAllOrdData:Query non valida.");

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
function getFilteredOrdData(string $actTab,string $actKeyField,int|string $actKeyValue,string $actOrdField,string $actField):array
{

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

  if(!$conn)
  {
    print_r(sqlsrv_errors()); 
   die(SQLSRV_CONNECTION_ERROR);
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
  $query = "select distinct * from " . $actTab . " order by " . $actOrdField . " asc";
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
 die("Errore in getFilteredOrdData-Query non valida ");
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
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
//
function getFilteredData(string $actTab,string|array $actKeyField,int|string|array $actKeyValue,string $actField):array
{

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
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
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or 
 die("Errore in getFilteredData-Query non valida ");

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
 $sqlsrv_connectionInfo=getConnectionInfo();
 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);	

 if(!$conn)
 {
  die(SQLSRV_CONNECTION_ERROR);
 }
 $result = sqlsrv_query($conn,$actQuery,array());
 if(! $result)
 {
  $error = sqlsrv_errors();
  $e = new \Exception($error[0]['message']);
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

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }
 $result = sqlsrv_query($conn,$actQuery,array()) or 
 die("Errore in getAllDataByQuery-Query non valida:" .
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

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }
 $result = sqlsrv_query($conn,$actQuery,$params) or 
 die("Errore in getAllDataByQuery-Query non valida");
 
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
// Ritorna un array contenente tutti i campi 
// per ogni riga dellla tabella.
// In pratica ritorna una tabella (array di array di cui 
// il primo indice conta i record ed il secondo i
// campi.
//
function getFilteredAllData(string $actTab,string|array $actKeyField,int|string|array $actKeyValue):array
{

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
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
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or die("Errore in getFilteredAllData-Query non valida");

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

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);
  
 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }

 $query = "select distinct * from " . $actTab ;
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or die("Errore in getAllData-Query non valida");
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

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }

 $query = "select distinct " . $actField . " from " . $actTab . 
 " order by " . $actField;
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_FORWARD)) or die("Errore in getAllData-Query non valida");
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
// Il campo chiave è 'ID'
function getUniqueData(string $actTab,string $actKeyField,int $actKeyValue,string $actField):string|int|bool
{

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }

  $query = "select * from " . $actTab . " where " . $actKeyField . " = " . (string)$actKeyValue;

 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_STATIC)) or die("Errore in getUniqueData-Query non valida");
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

 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
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
 $result = sqlsrv_query($conn,$query,array(),array('scrollable'=>SQLSRV_CURSOR_STATIC)) or die("Errore in getExtendedUniqueRow-Query non valida");
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


function createTable(string $actTableName,array $actFields,array $actFieldsTypes,
string $actPkField,array $actForeignKeys,array $actUniqueKeys):void
{
 $sqlsrv_connectionInfo=getConnectionInfo();

 $conn = sqlsrv_connect(SQLSRV_HOST,$sqlsrv_connectionInfo);

 if(!$conn)
 {
  print_r(sqlsrv_errors()); 
  die(SQLSRV_CONNECTION_ERROR);
 }
 
 $createStr = "CREATE TABLE " . $actTableName;
 $fieldsDefStr = STRING_NULL;
 $num = count($actFields);
 for($i=0;$i<=$num-1;$i++)
 {
 	if($i==0)
 	{
   $fieldsDef = $actFields[0] . STRING_SPACE . $actFieldsTypes[0];
   if(($actFieldsTypes[0]=="bigint")&&($actFields[0]==$actPkField))
    $fieldsDef = $fieldsDef . STRING_SPACE . "IDENTITY(1,1)";
   $fieldsDefStr = $fieldsDef; 
 	}
 	else
 	{
 	 $fieldsDef = $actFields[$i] . STRING_SPACE . $actFieldsTypes[$i]; 
   if(($actFieldsTypes[0]=="bigint")&&($actFields[$i]==$actPkField))
    $fieldsDef = $fieldsDef . STRING_SPACE . "AUTO_INCREMENT";
 	 $fieldsDefStr = $fieldsDefStr . STRING_COMMA . $fieldsDef;
  }
 }

 
 if($actPkField != STRING_NULL)
 {
  $pkConstraintStr = "CONSTRAINT" . STRING_SPACE . "pk" . 
  VAR_SEP . $actPkField . STRING_SPACE . "PRIMARY KEY" .
  STRING_SPACE . STRING_OPEN_PAR . $actPkField . STRING_CLOSE_PAR;
 }
 else
  $pkConstraintStr = STRING_NULL;
  
 $num1 = count($actForeignKeys);
 $j=0;
 $foreignKeyPre = "CONSTRAINT";
 foreach($actForeignKeys as $extTable=>$foreignKey)
 {
  $foreignKeyDef = $foreignKeyPre . STRING_SPACE . "fk" .
  VAR_SEP . $extTable . STRING_SPACE . "FOREIGN KEY" . 
 	STRING_SPACE . STRING_OPEN_PAR . $foreignKey . STRING_CLOSE_PAR .
 	STRING_SPACE . "REFERENCES" . STRING_SPACE . $extTable . STRING_OPEN_PAR .
 	$foreignKey . STRING_CLOSE_PAR;
 	if($j==0)
 	{
 		$foreignKeysStr = $foreignKeyDef;
 	}
 	else
 	 $foreignKeysStr = $foreignKeysStr . STRING_COMMA . $foreignKeyDef;
 	$j++;
 }
 
 $k=0;
 $num2 = count($actUniqueKeys);
 $uniqueKeyStr = STRING_NULL;
 foreach($actUniqueKeys as $ind=>$actKey)
 {
 	$keysSeq=STRING_NULL;
 	$l=0;
 	foreach($actKey as $ind2=>$val)
 	{
 		if($l==0)
 		{
 			$keySeq = $val;
 		}
 		else
 		{
 			$keySeq = $keySeq . STRING_COMMA . $val;
 		}
 		$l++;
 	}
 	$uniqueKeyDef = "CONSTRAINT"  . STRING_SPACE . "uc" . 
 		VAR_SEP . $actTableName . VAR_SEP . $k . STRING_SPACE .
 		"UNIQUE" . STRING_SPACE . STRING_OPEN_PAR . $keySeq . STRING_CLOSE_PAR;
 	if($k==0)
 	{
 		$uniqueKeyStr = $uniqueKeyDef; 
 	}
 	else
 	{
 	 $uniqueKeyStr = $uniqueKeyStr . STRING_COMMA . $uniqueKeyDef;
  }
  $k++;
 }
 
 $query = $createStr . STRING_SPACE . STRING_OPEN_PAR . 
 (($num > 0)?($fieldsDefStr):(STRING_NULL)) .
 (($actPkField != STRING_NULL)?(STRING_COMMA . $pkConstraintStr):(STRING_NULL)) . 
 (($num1 > 0)?(STRING_COMMA . $foreignKeysStr):(STRING_NULL)) .
 (($num2 > 0)?(STRING_COMMA . $uniqueKeyStr):(STRING_NULL)) . 
 STRING_CLOSE_PAR;
 
 $result = sqlsrv_query($conn,$query,array()) or 
 die("Errore in createTable-Query non valida");
 sqlsrv_free_stmt($result);
 sqlsrv_close($conn);
}

?>