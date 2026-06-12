<?
// SEZIONE PRINCIPALE
namespace Cheope_ns\fw;
// Require_onces
// 
// 
require_once("odbc.const.php");
require_once("sql_server.const.php");



// Db type consts
// 
// 
define(__NAMESPACE__ . '\ODBC',"odbc");
define(__NAMESPACE__ . '\SQLSRV',"sqlsrv");



// Active db
define(__NAMESPACE__ . '\ACTIVE_DB',namespace\ODBC);

// Odbc consts
// 
// 
define(__NAMESPACE__ . '\ODBC_USER',"");
define(__NAMESPACE__ . '\ODBC_PASSWORD',"");
define(__NAMESPACE__ . '\ODBC_CONNECTION_STRING',"DRIVER=Microsoft Access Driver (*.mdb, *.accdb);DBQ=E:\Docuff\php8\scripts\Cheope_ns\Cheope_ns_prova.mdb;UserCommitSync=Yes");
define(__NAMESPACE__ . '\ODBC_DSN',"");
define(__NAMESPACE__ . '\ODBC_CONNECTION_ERROR',"Odbc:Impossibile connettersi al database. Ritentare piu' tardi.");



// Sqlsrv consts
// 
// 
define(__NAMESPACE__ . '\SQLSRV_USER',"sa");
define(__NAMESPACE__ . '\SQLSRV_PASSWORD',"userroot");
define(__NAMESPACE__  . '\SQLSRV_HOST',"DANIELE-PC\SQLEXPRESS");
define(__NAMESPACE__ . '\SQLSRV_DB',"Cheope");
define(__NAMESPACE__ . '\SQLSRV_PORT',"");
define(__NAMESPACE__ . '\SQLSRV_CONNECTION_ERROR',"Sqlsrv:Impossibile connettersi al database. Ritentare piu' tardi.");




?>