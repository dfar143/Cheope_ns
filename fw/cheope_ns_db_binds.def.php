<?
// SEZIONE PRINCIPALE
// Binds_require_onces
// REQUIRES ONCES SECTION
// require_once
namespace 
	 	Cheope_ns\fw;
require_once("Db_items_container.class.php");



// Nodes_and_queries_binds
// TABLES AND QUERIES BINDS SECTION
// Bind_0
$dbNode=$dbStructTree->getElementByAliasName(TABELLA_PROVA_3);
$dbConn=$dbConnectionsContainer->getDbOp(CONNECTION_C_PROVA_1A);
$dbNode->setDbOp($dbConn);

// Bind_1
$dbQuery=$dbQueriesContainer->getQuery(QUERY_Q_PROVA_1);
$dbConn=$dbConnectionsContainer->getDbOp(CONNECTION_C_HOME);
$dbQuery->setDbOp($dbConn);

// Bind_2
$dbQuery=$dbQueriesContainer->getQuery(QUERY_Q_PROVA_2);
$dbConn=$dbConnectionsContainer->getDbOp(CONNECTION_C_PROVA_3);
$dbQuery->setDbOp($dbConn);



// Binds_defines
// DEFINES SECTION
// 
define(__NAMESPACE__ . '\CONTENITORE_BINDS_1',"Binds_container_1");
define(__NAMESPACE__ . '\BINDING_BIND_1',"Bind_1");
define(__NAMESPACE__ . '\BINDING_BIND_2',"Bind_2");



// Binds
// BINDS SECTION
// Bind_0
$dbNodeProva_3=$dbStructTree->getElementByAliasName(TABELLA_PROVA_3);
$dbBindBind_1=clone $dbNodeProva_3;
$dbBindBind_1->setAliasName(BINDING_BIND_1);
$dbConn=$dbConnectionsContainer->getDbOp(CONNECTION_C_PROVA_2);
$dbBindBind_1->setDbOp($dbConn);
$dbStructTree->add($dbBindBind_1);

// Bind_1
$dbNodeProva_2=$dbStructTree->getElementByAliasName(TABELLA_PROVA_2);
$dbBindBind_2=clone $dbNodeProva_2;
$dbBindBind_2->setAliasName(BINDING_BIND_2);
$dbConn=$dbConnectionsContainer->getDbOp(CONNECTION_C_PROVA_2);
$dbBindBind_2->setDbOp($dbConn);
$dbStructTree->add($dbBindBind_2);



// Binds_container
// BINDS CONTAINER SECTION
// 
$dbBindsContainer=Creator::create("Db_items_container",STRING_NULL,CONTENITORE_BINDS_1);
$dbBindsContainer->add($dbBindBind_1);
$dbBindsContainer->add($dbBindBind_2);



?>