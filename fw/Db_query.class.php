<?
namespace Cheope_ns\fw;
 require_once("Db_node.class.php");
 require_once("Db_nodes_container.class.php");
 require_once("ric_sql_2.def.php");
 require_once("Creator.tra.php");

class Db_query extends Db_item
{
 const ERROR_1="Db_query:Errore nell'inserimento del grafo del database.";
 
 // Grafo del database.
 private $dbStruct=null;	
 private $lex=null;
 private $parser=null;
		
 function __construct(string $actName,Db_nodes_container $actDbStruct=null,
 Lex_rules_container $actRicSql2DefRules=null,
 Parser_grammar_rules_container $actRicSql2DefGrRules=null)
 {
 	parent::__construct($actName);
 	$this->setDbStruct($actDbStruct);
 	$lex = self::createLexer(STRING_NULL);
  $this->setLex($lex);
  $this->setParser(self::createParser($lex));
  $this->setParserRules($actRicSql2DefGrRules);
  $this->setLexRules($actRicSql2DefRules);
 }
	
 function setDbStruct(?Db_nodes_container $actDbStruct):void
 {
 	if(is_a($actDbStruct,Classes_info::DB_NODES_CONTAINER_CLASS) || is_null($actDbStruct))
 	 $this->dbStruct = $actDbStruct;
  else
   die(self::ERROR_1);
 }
 
 function getDbStruct():?Db_nodes_container
 {
 	return $this->dbStruct;
 }	
	
	//
	//Factory method
	static function createParser(Lexer_3 $actLex):Parser
	{
		return Creator::create(getClassNameForCreate(Classes_info::PARSER_CLASS),STRING_NULL,$actLex);
	}

	//
	//Factory method	
	static function createLexer(string $actFileName,string $actStr=STRING_NULL):Lexer_3
	{
		return Creator::create(getClassNameForCreate(Classes_info::LEXER_3_CLASS),STRING_NULL,$actFileName,$actStr);
	}
	
  function setLex(Lexer_3 $actLex):void
  {
  	$this->lex = $actLex;
  }
  
  function getLex():Lexer_3
  {
  	return $this->lex;
  }
  
  function setParser(Parser $actParser):void
  {
  	$this->parser = $actParser;
  }
  
  function getParser():Parser
  {
  	return $this->parser;
  }

	function setLexRules(?Lex_rules_container $actLexRules):void
	{
		$lex = $this->getLex();
		if(! is_null($actLexRules))
		 $lex->setRules($actLexRules);
	}
	
  function getLexRules():?Lex_rules_container
  {
  	$lex = $this->getLex();
  	return $lex->getRules();
  }
  
   function setParserRules(?Parser_grammar_rules_container $actParserRules):void
  {
  	$parser = $this->getParser();
	if(! is_null($actParserRules))
  	 $parser->setGrammarRulesContainer($actParserRules);
  }
  
  function getParserRules():?Parser_grammar_rules_container
  {
  	$parser = $this->getParser();
  	return $parser->getGrammarRulesContainer();
  }
	
 function setQueryStr(string $actQueryStr):void
 {
 	parent::setQueryStr($actQueryStr);

  $lex = $this->getLex();
  $lex->setItemStr($actQueryStr);
  $parser = $this->getParser();
  $parser->setLex($lex);
 //   $prof = new Profiler();
//	  $prof->start();
  if (! $parser->exec())
   exit($parser->getCurrentError());
//	$prof->end();
//	$prof->print_profile();
//	$prof->reset();
  $tokTables = $parser->getListOfTokenAttr(RIC_SQL_2_TOKEN_ATTR_TABLE); 
  $tables=array();
  foreach($tokTables as $ind=>$tokTable)
  {
   $tables[$ind] = $tokTable->getLexema();
  }
  $tokFields = $parser->getListOfTokenAttr(RIC_SQL_2_TOKEN_ATTR_FIELD);
  $fields=array();
  foreach($tokFields as $ind=>$tokField)
  {
   $fields[$ind] = $tokField->getLexema();
  }
  $dbStruct = $this->getDbStruct();
  $fieldsTypes = $this->getFieldsTypes(); 
  
  $aDbNodes = array();
  $i=0;
  foreach($tables as $table)
  {
  	$aDbNode = $dbStruct->getElementsByName($table);
  	if(isset($aDbNode[0]))
  	 $aDbNodes[$i++] = $aDbNode[0];	
  }
  
  $i=0;
  if(in_array(STRING_STAR,$fields))
  {
   $fields = array();
   foreach($aDbNodes as $dbNode)
   {
   	$dbNodeFields = $dbNode->getFields();
   	foreach($dbNodeFields as $dbNodeField)
   	{
   	 $fields[$i] = $dbNodeField;
   	 $fieldsTypes[$i++] = $dbNode->getFieldTypeByName($dbNodeField);
   	}
   } 	
  }
  else
  {
   foreach($fields as $field)
   {
   	$flag = false;
    foreach($aDbNodes as $dbNode)
    {
   	 if($dbNode->isFieldInFields($field))
   	 {
   	  $fieldsTypes[$i++] = $dbNode->getFieldTypeByName($field);
   	  $flag = true;
   	  break;
   	 }
    }
    if(! $flag)
     $fieldsTypes[$i++] = FIELD_TYPE_NONE;
   }
  }
  $this->setFields($fields); 
  $this->setFieldsTypes($fieldsTypes);
 }
 
 function getGeneralized():string|bool
 {
 	return false;
 }
 //
 // Query generica per le select generica.
 //
 function getAllDataByQuery():bool|int|string|array
 {
 	$dbOp = $this->getDbOp();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  $queryStr = $this->getQueryStr();
  ($defaultDbOps==true)?($res = getAllDataByQuery($queryStr)):
  ($res=$dbOp->getAllDataByQuery($queryStr));
  return $res; 
 }
 
 //
 // Query generica per INSERT,UPDATE,DELETE,CREATE e ALTER generiche .
 //
 function doQuery():void
 {
 	$dbOp = $this->getDbOp();
  $defaultDbOps = true;

  if(is_a($dbOp,Classes_info::GENERIC_DB_OP_CLASS))
   $defaultDbOps=false;
   
  $queryStr = $this->getQueryStr();
  try
  {
  ($defaultDbOps==true)?(doQuery($queryStr)):
  ($dbOp->doQuery($queryStr));
  }
  catch(\Exception $e)
  {
  	throw $e;
  }
 }
		
}
 
 
 
?>