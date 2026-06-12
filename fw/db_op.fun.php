<?
namespace Cheope_ns\fw;
 require_once("db.const.php");
 require_once("Creator_class.class.php");

function getDsn():string
{
 (ODBC_DSN==STRING_NULL)?
 (
	(ODBC_CONNECTION_STRING==STRING_NULL)?(die(ODBC_FUNCTION_GETDSN_ERROR_1)):($dsn=ODBC_CONNECTION_STRING)
  ):
  ( 
  $dsn=ODBC_DSN
  );
  return $dsn;
}

function testConnection():void
{
  $dsn=getDsn();
   $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
   if(!$odbcConnId)
   {
  	$e = Creator_class::create("Exception",STRING_BACKSLASH,ODBC_CONNECTION_ERROR);
    throw $e; 
   }
   odbc_close($odbcConnId); 
}

// Controlla che il valore di chiave sia contenuto nella tabella
// Per ipotesi la chiave è numerica.
//
function testPresence(string $actTabName,string $actKeyField,string|int $actKeyVal):bool
{
 $query = "Select * from " . $actTabName . " where " .
 $actKeyField . " = " . $actKeyVal;
 $rows = getAllDataByQuery($query);
 $num = count($rows);
 if($num==0)
	return false;
 return true;
}


function getMaxId(string $actTabName,string $actKeyField):int
{
  $dsn=getDsn();
  $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
	if (!$odbcConnId)
	{
	 die(ODBC_CONNECTION_ERROR);
	}
	$query = "select " . $actKeyField . " from " . $actTabName . " order by " . $actKeyField . " Desc";
	$result = odbc_exec($odbcConnId,$query) or 
	die(ODBC_FUNCTION_GETMAXID_ERROR_1 . odbc_error());

  $colnum = odbc_num_fields($result);

  for($i=1;$i<=$colnum;$i++)
   $fieldNames[$i] = odbc_field_name($result,$i);

	$maxId =0;
  if (odbc_fetch_row($result))
  {
   for ($i = 1;$i <= $colnum; $i++)
    $row[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
   $maxId = $row[$actKeyField];
	}
	odbc_close($odbcConnId);
	return $maxId;
}

function deleteDbRow(string $actTab,string $actKey,string|int $actId):void
{
 $dsn=getDsn();
 $query = "DELETE FROM " . $actTab . " WHERE " . 
 $actKey . "=" . $actId; 
 
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_DELETEDBROW_ERROR_1 . odbc_error());
 odbc_close($odbcConnId);	
 //return true;
}

function deleteDbRows(string $actTab,string $actField,string|int $actVal):int|false
{
 $dsn=getDsn();
 if(is_string($actVal))
  $query = "DELETE FROM " . $actTab . " WHERE " . 
  $actField . "='" . $actVal . "'"; 
 else
  $query = "DELETE FROM " . $actTab . " WHERE " . 
  $actField . "=" . $actVal; 
	 
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_DELETEDBROWS_ERROR_1 . odbc_error());
 $numRows = odbc_num_rows($result);
 odbc_close($odbcConnId);	
 return $numRows;
}


//
// $actRow deve contenere il valore della chiave principale
// (supposta atomica)
//
function updateDbRow(string $actTab,string $actKeyField,array $actRow):void
{
 $dsn=getDsn();
 $i=0;
 $cols='';
 foreach($actRow as $fieldName => $fieldValue)
 {
 // La riga successiva solo per 
 // Sql server.
 //
  if ($fieldName != $actKeyField)
  if($i==0)
	{
//	 if (! is_numeric($fieldName))
//	 {
	  if (is_string($fieldValue))
	   $cols = $fieldName . "=" . "'" . $fieldValue . "'";
	  elseif(is_null($fieldValue))
		 $cols = $fieldName . "=" . "''";
		else
	   $cols = $fieldName . "=" . $fieldValue;
	  $i++;
  // }
	} 
	else
	{
//	 if (! is_numeric($fieldName))
//	 {
	  if (is_string($fieldValue))
     $cols = $cols . "," . $fieldName . "=" . "'" . $fieldValue . "'";
	  elseif(is_null($fieldValue))
		 $cols = $cols . "," . $fieldName . "=" . "''";
	  else
	   $cols = $cols . "," . $fieldName . "="  . $fieldValue;
//	 }
	}
 }	
 
 $actId = $actRow[$actKeyField];
 $query = "UPDATE " .
         strtolower($actTab) . " SET " . $cols . 
        " WHERE " . $actKeyField . " = " . $actId ;
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_UPDATEDBROW_ERROR_1 . odbc_error());
 odbc_close($odbcConnId);	

 //return true;		
}

function insertDbRow(string $actTab,array $actRow):void
{
 $dsn=getDsn();
 $i=0;
 $cols='';
 $vals='';
 foreach($actRow as $fieldName => $fieldValue)
 {
  if($i==0)
	{
	 $cols = $fieldName;
	 if(is_string($fieldValue))
	 {
	  $vals = "'" . $fieldValue . "'";
	 }
	 else
	  $vals = $fieldValue;
//	 else
//	  $vals = "'" . $fieldValue . "'";
	 $i++;
	} 
	else
	{
	 $cols = $cols . "," . $fieldName;
	 if(is_string($fieldValue))
	 {
    $vals = $vals . "," . "'" . $fieldValue . "'";
	 }
	 else
	   $vals = $vals . "," .  $fieldValue;
//	 else
//	   $vals = $vals . "," . "'" . $fieldValue . "'";
	}
 }	
 
 $query = "INSERT " .
        " INTO " . strtolower($actTab) . " (" . $cols . ")" .
        " VALUES (" . $vals . ")";

 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_INSERTDBROW_ERROR_1 . odbc_error());
 odbc_close($odbcConnId);	
 //return true;
}

//
// Ritorna una colonna della tabella 
// col solo campo $actField ordinato per $actOrdField
//
function getAllOrdData(string $actTab,string $actOrdField,string $actField):array
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
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
 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_GETALLORDDATA_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $rRow=array();
 $row=array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow[$actField];
 }

 odbc_close($odbcConnId);

 return $row;
}


//
// Ritorna un array contenente i valori del campo $actField
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
// I dati vengono ordinate in base all'argomento $actOrdField e filtrati in
// base ai valori $actKeyValue delle chiavi $actKeyField
//
function getFilteredOrdData(string $actTab,string $actKeyField,string|int $actKeyValue,string $actOrdField,string $actField):array
{
	//echo "PPPPP" . $actKeyField . "PPPPP";
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
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

  //echo $query;
 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_GETFILTEREDORDDATA_ERROR_1 . odbc_error());
  //die($query);

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);
 
 $row = array();
 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow[$actField];
 }

 odbc_close($odbcConnId);

 return $row;
}

//
// Ritorna un array contenente i valori del campo $field
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
//
function getFilteredData(string $actTab,string|array $actKeyField,string|int|array $actKeyValue,string $actField):array
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 if (! is_array($actKeyField))
 {
  if (! is_numeric($actKeyValue))
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
    if (! is_numeric($actKeyValue[$i]))
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = '" . $actKeyValue[$i] . "')"; 
    else
     $whereClause = $whereClause . " AND " . 
	   "(" . $actKeyField[$i] . " = " . $actKeyValue[$i] . ")";  
   }
 }
  
 $query = "select * from " . $actTab . " where (" . $whereClause . ")";
 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETFILTEREDDATA_ERROR_1 . odbc_error());
 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);
 
 $row = array();
 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow[$actField];
 }

 odbc_close($odbcConnId);

 return $row;
}

//
// esegue una query generica;
//
function doQuery(string $actQuery):void
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 
 if (!$odbcConnId)
 {
  die(ODBC_CONNECTION_ERROR);
 }
 
 $query = $actQuery;
 $result = odbc_exec($odbcConnId,$query); 

 if(! $result)
 {
  $error = odbc_error();
  $e = Creator_class::create("Exception",STRING_BACKSLASH,$error);
	odbc_close($odbcConnId);
	throw $e; 
 }
 odbc_close($odbcConnId);
 //return $result;
}

//
// Ritorna tutti i dati (array di array)
// da una query specificata come argomento.
function getAllDataByQuery(string $actQuery):array|int|string|bool
{
 $dsn=getDsn();
 
 
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }
 
 $query = $actQuery;
// echo $actQuery;
 
 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETALLDATABYQUERY_ERROR_1 
  . odbc_error());
 
 
 $colnum = odbc_num_fields($result);
 $numRows = odbc_num_rows($result);

 if($colnum > 0)
 {
  for($i=1;$i<=$colnum;$i++)
  {
   $fieldNames[$i] = odbc_field_name($result,$i);
   $fieldTypes[$i] = odbc_field_type($result,$i);
  }
  
  $row = array();
  $rRow = array();
  $j=0;

  while(odbc_fetch_row($result))
  {
   for ($i = 1;$i <= $colnum; $i++)
   {
   	if(($fieldTypes[$i] == "INTEGER")||($fieldTypes[$i] == "COUNTER"))
     $rRow[$fieldNames[$i]] = (int)odbc_result($result, $fieldNames[$i]);
    elseif($fieldTypes[$i] == "BIT")
     $rRow[$fieldNames[$i]] = (bool)odbc_result($result, $fieldNames[$i]);
    else
     $rRow[$fieldNames[$i]] = odbc_result($result,$fieldNames[$i]);
   }
   $row[$j++] = $rRow;
  }
  $res=$row;
 }
 else
  $res = $numRows;

 odbc_close($odbcConnId);
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
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
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
 $result = odbc_exec($odbcConnId,$query) or 
 die(ODBC_FUNCTION_GETFILTEREDALLDATA_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $row = array();
 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow;
 }

 odbc_close($odbcConnId);
 return $row;
}

//
// Ritorna un array contenente i valori del campo $actField
// per ogni riga dellla tabella.
// In pratica ritorna una colonna della tabella.
//
function getAllData(string $actTab,string $actField):array
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $query = "select distinct * from " . $actTab ;
 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETALLDATA_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $row = array();
 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow[$actField];
 }

 odbc_close($odbcConnId);
 return $row;
}

function getDistinctAllData(string $actTab,string $actField):array
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $query = "select distinct " . $actField . " from " . $actTab . 
 " order by " . $actField;
 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETDISTINCTALLDATA_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $row = array();
 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $row[$j++] = $rRow[$actField];
 }

 odbc_close($odbcConnId);
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
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
 }

 $query = "select * from " . $actTab . " where " . $actKeyField . " = " . (string)$actKeyValue;

 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETUNIQUEDATA_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $j++;
 }
 
 odbc_close($odbcConnId);
 
 if($j==0)
  return STRING_NULL;
 elseif($j==1)
  return $rRow[$actField];
 elseif($j > 1)
  return false;
 
}

//
// Ritorna una riga unica della tabella in base 
// alla chiave 
// passata come argomento.
// La chiave in generale è un vettore.
//
function getExtendedUniqueRow(string $actTab,string|array $actKeyField,string|int|array $actKeyValue):array|false
{
 $dsn=getDsn();
 $odbcConnId = odbc_connect($dsn,ODBC_USER,ODBC_PASSWORD);
 if (!$odbcConnId)
 {
	 die(ODBC_CONNECTION_ERROR);
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
 $result = odbc_exec($odbcConnId,$query) or die(ODBC_FUNCTION_GETEXTENDEDUNIQUEROW_ERROR_1 . odbc_error());

 $colnum = odbc_num_fields($result);

 for($i=1;$i<=$colnum;$i++)
  $fieldNames[$i] = odbc_field_name($result,$i);

 $rRow = array();
 $j=0;

 while(odbc_fetch_row($result))
 {
  for ($i = 1;$i <= $colnum; $i++)
   $rRow[$fieldNames[$i]] = odbc_result($result, $fieldNames[$i]);
  $j++;
 }
 
 odbc_close($odbcConnId);
 
 if($j > 1)
  return false;
 
 return $rRow;
}

?>