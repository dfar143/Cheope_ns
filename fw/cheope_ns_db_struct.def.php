<?
// SEZIONE PRINCIPALE
// Require_onces
// REQUIRES ONCES SECTION
// require_once
namespace 
	 	Cheope_ns\fw;
require_once("Db_nodes_container.class.php");



// Defines
// DEFINES SECTION
// define
define(__NAMESPACE__ . '\REL_STRUCT',"Struct");



// Db_objects_definitions
// 
// 
$dbObjProva_3=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA_3);
$dbObjProva_4=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA_4);
$dbObjProva=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA);
$dbObjProva_2=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA_2);
$dbObjProva_6=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA_6);
$dbObjProva_3_prova_2=Creator::create("Db_node",STRING_NULL,TABELLA_PROVA_3_PROVA_2);



// Fields_definitions
// FIELDS DEFINITIONS SECTION
// fields_definition_0
$fields=array(FIELD_ID_PROVA_3,FIELD_CAMPO2,FIELD_DATA_7,FIELD_DATA_8,FIELD_DATA_5);
$dbObjProva_3->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_INTEGER,FIELD_TYPE_BOOLEAN,FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING);
$dbObjProva_3->setFieldsTypes($fieldsTypes);
$keyFields=array(FIELD_ID_PROVA_3);
$dbObjProva_3->setKeyFields($keyFields);
$candKeyFields=array();
$dbObjProva_3->setCandKeyFields($candKeyFields);
$extKeyFields=array();
$dbObjProva_3->setExtKeyFields($extKeyFields);

// fields_definition_1
$fields=array(FIELD_ID_PROVA_4);
$dbObjProva_4->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_INTEGER);
$dbObjProva_4->setFieldsTypes($fieldsTypes);
$keyFields=array(FIELD_ID_PROVA_4);
$dbObjProva_4->setKeyFields($keyFields);
$candKeyFields=array();
$dbObjProva_4->setCandKeyFields($candKeyFields);
$extKeyFields=array();
$dbObjProva_4->setExtKeyFields($extKeyFields);

// fields_definition_2
$fields=array(FIELD_ID_PROVA,FIELD_DATA_1,FIELD_DATA_2,FIELD_DATA_3,FIELD_DATA_4,FIELD_DATA_5,FIELD_ID_PROVA_2);
$dbObjProva->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_INTEGER,FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING);
$dbObjProva->setFieldsTypes($fieldsTypes);
$keyFields=array(FIELD_ID_PROVA);
$dbObjProva->setKeyFields($keyFields);
$candKeyFields=array(array(FIELD_DATA_1,FIELD_DATA_2));
$dbObjProva->setCandKeyFields($candKeyFields);
$extKeyFields=array(TABELLA_PROVA_2=>FIELD_ID_PROVA_2);
$dbObjProva->setExtKeyFields($extKeyFields);

// fields_definition_3
$fields=array(FIELD_ID_PROVA_2,FIELD_DATA_1,FIELD_DATA_2);
$dbObjProva_2->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_STRING);
$dbObjProva_2->setFieldsTypes($fieldsTypes);
$keyField=array(FIELD_ID_PROVA_2);
$dbObjProva_2->setKeyFields($keyField);
$candKeyFields=array();
$dbObjProva_2->setCandKeyFields($candKeyFields);
$extKeyFields=array();
$dbObjProva_2->setExtKeyFields($extKeyFields);

// fields_definition_4
$fields=array(FIELD_ID_PROVA_6,FIELD_DATA_6,FIELD_ID_PROVA_4);
$dbObjProva_6->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_STRING,FIELD_TYPE_STRING,FIELD_TYPE_INTEGER);
$dbObjProva_6->setFieldsTypes($fieldsTypes);
$keyField=array(FIELD_ID_PROVA_6);
$dbObjProva_6->setKeyFields($keyField);
$candKeyFields=array();
$dbObjProva_6->setCandKeyFields($candKeyFields);
$extKeyFields=array(TABELLA_PROVA_4=>FIELD_ID_PROVA_4);
$dbObjProva_6->setExtKeyFields($extKeyFields);

// fields_definition_5
$fields=array(FIELD_ID,FIELD_ID_PROVA_2,FIELD_ID_PROVA_3);
$dbObjProva_3_prova_2->setFields($fields);
$fieldsTypes=array(FIELD_TYPE_STRING,FIELD_TYPE_INTEGER,FIELD_TYPE_INTEGER);
$dbObjProva_3_prova_2->setFieldsTypes($fieldsTypes);
$keyField=array(FIELD_ID);
$dbObjProva_3_prova_2->setKeyFields($keyField);
$candKeyFields=array();
$dbObjProva_3_prova_2->setCandKeyFields($candKeyFields);
$extKeyFields=array();
$dbObjProva_3_prova_2->setExtKeyFields($extKeyFields);



// Relations_definitions
// RELATIONS DEFINITIONS SECTION
// Relation_definition_0
$entities=array();
$entities[ENT_FATHER]=TABELLA_PROVA_4;
$entities[ENT_SON]=TABELLA_PROVA_6;
$types=array();
$types[ENT_FATHER]=REL_1_N;
$types[ENT_SON]=REL_1_1;
$objRel1NProva_4Prova_6=Creator::create("Db_rel",STRING_NULL,$entities,REL_STRUCT);
$objRel1NProva_4Prova_6->setRelTypes($types);

// Relation_definition_1
$entities=array();
$entities[ENT_FATHER]=TABELLA_PROVA_2;
$entities[ENT_SON]=TABELLA_PROVA;
$types=array();
$types[ENT_FATHER]=REL_1_N;
$types[ENT_SON]=REL_1_1;
$objRel1NProva_2Prova=Creator::create("Db_rel",STRING_NULL,$entities,REL_STRUCT);
$objRel1NProva_2Prova->setRelTypes($types);

// Relation_definition_2
$entities=array();
$entities[ENT_FATHER]=TABELLA_PROVA_2;
$entities[ENT_SON]=TABELLA_PROVA_3;
$types=array();
$types[ENT_FATHER]=REL_M_N;
$types[ENT_SON]=REL_M_N;
$objRelMNProva_2Prova_3=Creator::create("Db_rel",STRING_NULL,$entities,REL_STRUCT);
$objRelMNProva_2Prova_3->setRelTypes($types);
$objRelMNProva_2Prova_3->setLinkTable("Prova_3_prova_2");

// Relation_definition_3
$entities=array();
$entities[ENT_FATHER]=TABELLA_PROVA_3;
$entities[ENT_SON]=TABELLA_PROVA_2;
$types=array();
$types[ENT_FATHER]=REL_M_N;
$types[ENT_SON]=REL_M_N;
$objRelMNProva_3Prova_2=Creator::create("Db_rel",STRING_NULL,$entities,REL_STRUCT);
$objRelMNProva_3Prova_2->setRelTypes($types);
$objRelMNProva_3Prova_2->setLinkTable("Prova_3_prova_2");



// Binding_relations_to_objects
// 
// 
$rels=array();
$rels[0]=$objRelMNProva_2Prova_3;
$rels[1]=$objRelMNProva_3Prova_2;
$dbObjProva_3->setRels($rels);

// 
$rels=array();
$rels[0]=$objRel1NProva_4Prova_6;
$dbObjProva_4->setRels($rels);

// 
$rels=array();
$rels[0]=$objRel1NProva_2Prova;
$dbObjProva->setRels($rels);

// 
$rels=array();
$rels[0]=$objRel1NProva_2Prova;
$rels[1]=$objRelMNProva_2Prova_3;
$rels[2]=$objRelMNProva_3Prova_2;
$dbObjProva_2->setRels($rels);

// 
$rels=array();
$rels[0]=$objRel1NProva_4Prova_6;
$dbObjProva_6->setRels($rels);

// 
$rels=array();
$dbObjProva_3_prova_2->setRels($rels);



// Structure_definitions
// STRUCTURE DEFINITION SECTION
// 
$dbObjProva_4->addSon($dbObjProva_6);
$dbObjProva_2->addSon($dbObjProva);
$dbObjProva_2->addSon($dbObjProva_3);
$dbObjProva_3->addSon($dbObjProva_2);



// Graph_definitions
// 
// 
$dbStructTree=Creator::create("Db_nodes_container",STRING_NULL,"Struttura_basedati_1");
$dbStructTree->add($dbObjProva_3);
$dbStructTree->add($dbObjProva_4);
$dbStructTree->add($dbObjProva);
$dbStructTree->add($dbObjProva_2);
$dbStructTree->add($dbObjProva_6);
$dbStructTree->add($dbObjProva_3_prova_2);



// Aliases_defines
// DEFINES SECTION
// 
define(__NAMESPACE__ . '\ALIAS_ALIAS_1',"Alias_1");



// Aliases_definitions
// 
// aliases_definition_0
$dbNode=$dbStructTree->getElementByAliasName(TABELLA_PROVA_3);

// aliases_definition_1

// aliases_definition_2
$dbNode=$dbStructTree->getElementByAliasName(TABELLA_PROVA);
$dbObjAlias_1=clone $dbNode;
$dbObjAlias_1->setAliasName(ALIAS_ALIAS_1);
$dbStructTree->add($dbObjAlias_1);

// aliases_definition_3

// aliases_definition_4

// aliases_definition_5



?>