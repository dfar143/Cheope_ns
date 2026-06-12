<?
// SEZIONE PRINCIPALE
// Queries_require_onces
// REQUIRES ONCES SECTION
// require_once
namespace 
	 	Cheope_ns\fw;
require_once("Queries_container.class.php");



// Queries_defines
// DEFINES SECTION
// define
define(__NAMESPACE__ . '\CONTENITORE_QUERIES_1',"Contenitore_queries_1");
define(__NAMESPACE__ . '\QUERY_Q_PROVA_1',"Q_prova_1");
define(__NAMESPACE__ . '\QUERY_Q_PROVA_4',"Q_prova_4");
define(__NAMESPACE__ . '\QUERY_Q_PROVA_2',"Q_prova_2");



// Queries_definitions
// 
// Definizione delle queries
$queryStr="select * from Prova";
$dbQueryQ_prova_1=Creator::create("Db_query",STRING_NULL,QUERY_Q_PROVA_1,$dbStructTree,$ricSql2DefRules,$ricSql2DefGrRules);
$dbQueryQ_prova_1->setQueryStr($queryStr);
$queryStr="select * from Prova_4";
$dbQueryQ_prova_4=Creator::create("Db_query",STRING_NULL,QUERY_Q_PROVA_4,$dbStructTree,$ricSql2DefRules,$ricSql2DefGrRules);
$dbQueryQ_prova_4->setQueryStr($queryStr);
$queryStr="select data_1 as ggg,data_2 from Prova_2";
$dbQueryQ_prova_2=Creator::create("Db_query",STRING_NULL,QUERY_Q_PROVA_2,$dbStructTree,$ricSql2DefRules,$ricSql2DefGrRules);
$dbQueryQ_prova_2->setQueryStr($queryStr);



// Queries_container_definition
// 
// 
$dbQueriesContainer=Creator::create("Queries_container",STRING_NULL,CONTENITORE_QUERIES_1);
$dbQueriesContainer->add($dbQueryQ_prova_1);
$dbQueriesContainer->add($dbQueryQ_prova_4);
$dbQueriesContainer->add($dbQueryQ_prova_2);



?>