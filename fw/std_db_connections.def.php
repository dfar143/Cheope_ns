<?
namespace Std\fw;
// SEZIONE PRINCIPALE
// Connections_require_onces
// REQUIRES ONCES SECTION
// require_once

require_once("Db_ops_container.class.php");


// Connections_defines
// DEFINES SECTION
// define
define('STD_CONTENITORE_CONNECTIONS_1',"Contenitore_connections_1");


// Connections_definitions
// Definizione delle connections
// Connection_0


// Connections_container_definition
// 
// 
$dbConnectionsContainer=Creator::create("Db_ops_container",STRING_NULL,STD_CONTENITORE_CONNECTIONS_1);



?>