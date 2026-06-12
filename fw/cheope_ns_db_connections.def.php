<?
// SEZIONE PRINCIPALE
// Connections_require_onces
// REQUIRES ONCES SECTION
// require_once
namespace 
	 	Cheope_ns\fw;
require_once("Db_ops_container.class.php");



// Connections_defines
// DEFINES SECTION
// define
define(__NAMESPACE__ . '\CONTENITORE_CONNECTIONS_1',"Contenitore_connections_1");
define(__NAMESPACE__ . '\CONNECTION_C_PROVA_1A',"C_prova_1a");
define(__NAMESPACE__ . '\CONNECTION_C_HOME',"C_home");
define(__NAMESPACE__ . '\CONNECTION_C_PROVA_3',"C_prova_3");
define(__NAMESPACE__ . '\CONNECTION_C_PROVA_2',"C_prova_2");



// Connections_definitions
// Definizione delle connections
// Connection_0
$user="";
$password="";
$connection_string="DRIVER=Microsoft Access Driver (*.mdb, *.accdb);DBQ=E:\Docuff\php8\scripts\Cheope_ns\Cheope_ns_prova.mdb;UserCommitSync=Yes";
$dsn="";
$dbConnectionC_prova_1a=Creator::create("Odbc_db_op",STRING_NULL,$user,$password,$connection_string,$dsn);
$dbConnectionC_prova_1a->setName(CONNECTION_C_PROVA_1A);

// Connection_2
$user="sa";
$password="userroot";
$host="DANIELE-PC\SQLEXPRESS";
$db="Cheope";
$port="";
$dbConnectionC_home=Creator::create("Sqlsrv_db_op",STRING_NULL,$user,$password,$host,$db,$port);
$dbConnectionC_home->setName(CONNECTION_C_HOME);

// Connection_3
$user="SPdb_usr";
$password="SPdb.usr";
$host="10.209.17.248";
$db="Spdb";
$port="";
$dbConnectionC_prova_3=Creator::create("Sqlsrv_db_op",STRING_NULL,$user,$password,$host,$db,$port);
$dbConnectionC_prova_3->setName(CONNECTION_C_PROVA_3);

// Connection_3
$user="";
$password="";
$connection_string="DRIVER=Microsoft Access Driver (*.mdb, *.accdb);DBQ=E:\Docuff\php8\scripts\Cheope_ns\Cheope_ns_prova.mdb;UserCommitSync=Yes";
$dsn="";
$dbConnectionC_prova_2=Creator::create("Odbc_db_op",STRING_NULL,$user,$password,$connection_string,$dsn);
$dbConnectionC_prova_2->setName(CONNECTION_C_PROVA_2);



// Connections_container_definition
// 
// 
$dbConnectionsContainer=Creator::create("Db_ops_container",STRING_NULL,CONTENITORE_CONNECTIONS_1);
$dbConnectionsContainer->add($dbConnectionC_prova_1a);
$dbConnectionsContainer->add($dbConnectionC_home);
$dbConnectionsContainer->add($dbConnectionC_prova_3);
$dbConnectionsContainer->add($dbConnectionC_prova_2);



?>