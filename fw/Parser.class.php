<?
namespace Cheope_ns\fw;
require_once("Lexer_3.class.php");
require_once("Tokens_container.class.php");
require_once("Parser_grammar_rules_container.class.php");
require_once("Creator.tra.php");

class Parser 
{
 use Creator;
 
 const NO_ERROR = STRING_NULL;
 const ERROR_1 = "Parser:Sintax error";
 const ERROR_3 = "Parser:No parse rules.";
 const ERROR_4 = "Parser:Ambigous grammar";
 const LOG_FILE = "parser_log.txt";		
	
// Lexer instance
 private $lex=null;
// Lexical rules array.
 private $lexRulesArray=array();
// Grammar rules container.
 private $grammarRulesContainer=null;
// Current error.
 private $error = Parser::NO_ERROR;
// Tokens buffer.
 private $tokensBuffer=null;
// Tokens buffer iterator.
 private $tokensBufferIterator=null;
 private $logEnabled = false;
// Log file.
 private $logFileName=self::LOG_FILE;
 private $enableLogOnFile=false;
// Execution results.
 private $results = array(); 
 
 function __construct(Lexer_3 $actLex)	
 {
  $this->setLex($actLex);
  $grammarRulesContainer = self::createParserGrammarRulesContainer();
  $this->setGrammarRulesContainer($grammarRulesContainer);
  $this->setCurrentError(STRING_NULL);
  $tokensBuf = Creator::create(getClassNameForCreate(Classes_info::TOKENS_CONTAINER_CLASS),STRING_NULL);
  $this->setTokensBuffer($tokensBuf);
  $tokensBufferIter = $tokensBuf->create();
  $this->setTokensBufferIterator($tokensBufferIter);
 }
 
 function setResults(array $actResults):void
 {
 	$this->results = $actResults; 
 }
 
 function getResults():array
 {
 	return $this->results;
 }
 
 function setLogEnabled(bool $actLogEnabled):void
 {
 	$this->logEnabled =$actLogEnabled;
 }
 
 function getLogEnabled():bool
 {
 	return $this->logEnabled;
 }
 
 function setLogFileName(string $actLogFileName):void
 {
 	$this->logFileName = $actLogFileName;
 }
 
 function getLogFileName():string
 {
 	return $this->logFileName;
 }
 
 function setEnableLogOnFile(bool $actEnableLogOnFile):void
 {
 	$this->enableLogOnFile = $actEnableLogOnFile;
 }
 
 function getEnableLogOnFile():bool
 {
 	return $this->enableLogOnFile;
 }
 
 function putLog(string $actLogInfo):void
 {
 	$logEnabled = $this->getLogEnabled();
 	if($logEnabled)
 	{
 	 $logOnFileEnabled = $this->getEnableLogOnFile();
 	 if($logOnFileEnabled)
 	 {
 	  $logFileName = $this->getLogFileName();
 	  if(isset($logFileName))
 	  {
 	   $handle = fopen($logFileName,"a+");
     fwrite($handle,$actLogInfo);
	   fwrite($handle,STRING_RETURN);
	   fwrite($handle,STRING_LINE_FEED);
 	   fclose($handle);
    }
   }
   else
    echo $actLogInfo . "<br/>";
  }
 }
 
 function setLex(Lexer_3 $actLex):void
 {
 	$this->lex = $actLex;
 }
 
 function getLex():Lexer_3
 {
 	return $this->lex;
 }
 
 function getCurrentError():string
 {
 	return $this->error;
 }
 
 function setCurrentError(string $actError):void
 {
 	$this->error = $actError;
 }
 	
 function setLexRulesArray(array $actLexRulesArray):void
 {
 	$this->lexRulesArray = $actLexRulesArray;
 }
 
 function getLexRulesArray():array
 {
 	return $this->lexRulesArray;
 }

 function setGrammarRulesContainer(Parser_grammar_rules_container $actGrammarRulesCont):void
 {
 	$this->grammarRulesContainer = $actGrammarRulesCont;
 }	
 	
 function getGrammarRulesContainer():Parser_grammar_rules_container
 {
 	 return $this->grammarRulesContainer;
 }
 
 function getTokensBuffer():Tokens_container
 {
 	return $this->tokensBuffer;
 }
 
 function setTokensBuffer(Tokens_container $actTokensBuffer):void
 {
 	$this->tokensBuffer = $actTokensBuffer;
 }
 
 function getTokensBufferIterator():Generic_iterator
 {
 	return $this->tokensBufferIterator;
 }
 
 function setTokensBufferIterator(Generic_iterator $actTokensIterator):void
 {
 	$this->tokensBufferIterator = $actTokensIterator;
 }
 
 
 function getCurrentToken():?Token
 {
 	$tokensBufferIter = $this->getTokensBufferIterator();
 	$token = $tokensBufferIter->current();
 	return $token;
 }
 
 function getNextToken():bool
 {
 	//$this->putLog("Entering getNextToken.");
 	$lex = $this->getLex();
 	$tokensBufferIter = $this->getTokensBufferIterator();
 	$tokensBufferIter->next();
  if($tokensBufferIter->hasMore())
 	{
 	 //$this->putLog("Token buffer has more.");
 	 return true;
 	}
 	else
 	{
 	 //$this->putLog("Token buffer at top.");
 	 //$this->putLog("Reading new token from lex.");
   if ($lex->nextToken())
 	 {
 	  $currentRule = $lex->getCurrentRule();
 	  $tokensBuf = $tokensBufferIter->getObj();
 	  $token = $currentRule->getCurrentToken();
 	  //$this->putLog("Next token val:" . $token->getVal());
 	  //$this->putLog("Next token type:" . $token->getType());
 	  $tokensBuf->add($token);
 	  $tokensBufferIter->end();
 	  //$this->putLog("Ending getNextToken OK.");
 	  return true;
 	 }
 	 else
 	 {
 	 	$tokensBuf = $tokensBufferIter->getObj();
 	 	if($lex->getCurrentError()==Lexer_3::ERROR_1)
 	 	{
 	 	 $tok = Lexer_3::createToken(null,null);
 	 	}
 	 	else
 	 	 $tok=null;
 	  $tokensBuf->add($tok);
 	  $tokensBufferIter->end();
 	  $this->setCurrentError($lex->getCurrentError());
 	  //$this->putLog("LEXER ERROR:" . $lex->getCurrentError());
 	  //$this->putLog("Ending getNextToken  NOT OK.");
 	  return false;
   }
  }
 }
 	
 function match(string $actType,string $actChar,string $actAttr=STRING_NULL):bool
 {
 //	$this->putLog("Entering match.");
 //	$this->putLog("Getting current token.");
 	$token = $this->getCurrentToken();
	if((is_null($token) | (! $token)))
 	{
 	 $this->setCurrentError(Lexer_3::ERROR_0);
 //	 $this->putLog("Current token NULL.");
 //	 $this->putLog("End of buffer reached.");
 //	 $this->putLog("Match FAILED."); 
/*	 $lookaheadRes = $this->getNextToken();
 	 if($lookaheadRes)
 	 {
 	 	$this->putLog("Next Token get.");
	 $token = $this->getCurrentToken();		
 	  return true;
 	 }
 	 else
 	 {
 	  $this->putLog("Lex error on getting next token.");
 	  return true;
   }	
     $token = $this->getCurrentToken(); */
 	 return false;
 	}
 	elseif(($token->getVal()===null)&&($token->getType()===null))
 	{
 	 $this->setCurrentError(Lexer_3::ERROR_1);
 //	 $this->putLog("Lexical error.");
 //	 $this->putLog("Match FAILED."); 	 
 	 return false; 		
 	}
 //	$this->putLog("Current token get.");
 //	$this->putLog("Matching token type:" . $actType);
 //	$this->putLog("Matching token char:" . $actChar);
 	$tokenVal = $token->getVal();
 	$tokenType = $token->getType();
	$lexema = $token->getLexema();
 //	$this->putLog("Current token type:" . $tokenType);
 //	$this->putLog("Current token char:" . $tokenVal);
 //	$this->putLog("Current token lexema:" . $lexema);
 	if(($tokenVal == $actChar)&&($tokenType == $actType))
 	{
 	 if ($actAttr != STRING_NULL)
 	 {
 //	 	$this->putLog("Setting attribute $actAttr.");
 	  $token->setAttribute($actAttr);
 	 }
 //	 $this->putLog("Match OK.");
 //	 $this->putLog("Getting next token.");
 	 $lookaheadRes = $this->getNextToken();
 	 if($lookaheadRes)
 	 {
 //	 	$this->putLog("Next Token get."); 
 	  return true;
 	 }
 	 else
 	 {
 //	  $this->putLog("Lex error on getting next token.");
 	  return true;
   }
  }
  else
  {
 //	 $this->putLog("Match FAILED."); 
   return false;
  }
 }
 
 // Flushes the current tokens buffer.
 //
 function flushTokensBuffer():void
 {
 	$tokensBuf = $this->getTokensBuffer();
 	$tokensBuf->setContents(array());
 }
 
 function createBufferIterator():Generic_iterator
 {
 	$tokensBuf = $this->getTokensBuffer();
 	$tokensBufferIter = $tokensBuf->create();
 	$tokensBufferIter->reset();
 	return $tokensBufferIter;
 }
 
 function createParserGrammarRulesContainer():Parser_grammar_rules_container
 {
 	$grammarRulesContainer = Creator::create(getClassNameForCreate(Classes_info::PARSER_GRAMMAR_RULES_CONTAINER_CLASS),STRING_NULL);
 	//$grammarRulesContainer = new Parser_grammar_rules_container();
 	return $grammarRulesContainer;
 }
 
 //
 // Returns all tokens with a given value 
 // from symbols table.
 //
 function getListOfTokenVal(string $actTokenVal):array
 {
 	$lex = $this->getLex();
 	$sym = $lex->getSymTable();
 	$tablesList = array();
 	$i=0;
 	foreach($sym as $ind=>$val)
 	{
 		$tok = $sym[$ind];
 		if($tok->getVal()==$actTokenVal)
 		{
 		 $tablesList[$i++] = $tok;
    }
  }
  return $tablesList;
 }

 //
 // Returns all tokens with a given attribute 
 // from symbols table.
 // 
 function getListOfTokenAttr(string $actTokenAttr):array
 {
 	$lex = $this->getLex();
 	$sym = $lex->getSymTable();
 	$tablesList = array();
 	$i=0;
 	foreach($sym as $ind=>$val)
 	{
 		$tok = $sym[$ind];
 		if($tok->getAttribute()==$actTokenAttr)
 		 $tablesList[$i++] = $tok;
  }
  return $tablesList;
 }
 
 
 //
 // Flushes the tokens buffer, creates new tokens buffer iterator,
 // gets next grammar rule...if there are more grammar rules: 
 // sets the current parser to grammar rule, sets next lex rules 
 // to current lexer, initialize the lexer, sets current error to
 // NO ERROR, gets next token.
 //
 function reInit():void
 {
//	 $this->putLog("Entering ReInit.");
 	$this->flushTokensBuffer();
  $tokensBuf = $this->getTokensBuffer();
  $tokensBufferIter = $tokensBuf->create();
  $this->setTokensBufferIterator($tokensBufferIter);
 	$grRules = $this->getGrammarRulesContainer();
 	$grRulesIter = $grRules->create();
 	$grRulesIter->next();
 	$grRule = $grRulesIter->current();
 	$lexRulesArray = $this->getLexRulesArray();
 	$lex = $this->getLex();
 	if($grRulesIter->hasMore())
 	{
 	 $grRule->setParser($this);
 	 $lexRules = next($lexRulesArray);
 	 if($lexRules)
 	 {
 	  $lex->setRules($lexRules);
 	  $lex->init();
 	  $lex->setCurrentError(Parser::NO_ERROR);
 	 }
 	 $this->setCurrentError(Parser::NO_ERROR);
 	 $this->getNextToken();
 	}
 }
 
 //
 // Execute parse process.
 // Returns true if the sentence satisfies all grammars
 // false on at least one error.
 //
 function exec():bool
 {
 	$results = array();
 	$lex = $this->getLex();
 	$lex->init();
 	$grRules = $this->getGrammarRulesContainer();
 	if (! is_null($grRules))
 	{
 	 $lexRulesArray = $this->getLexRulesArray();
 	 reset($lexRulesArray);
 	 $lexRules = current($lexRulesArray);
 	 if($lexRules)
 	  $lex->setRules($lexRules);
 	 $tokensBufferIter = $this->getTokensBufferIterator();
 	 $grRulesIter = $grRules->create();
 	 $grRulesIter->reset();
   $this->getNextToken();  
   while(($lex->getCurrentError()!=Lexer_3::NO_ERROR)&&
   ($grRulesIter->hasMore()))
   {
   	$lexError = $lex->getCurrentError();
  	$this->setCurrentError($lexError);
  	$grRule = $grRulesIter->current();
  	$grRule->setParser($this);
  	$grRuleName = $grRule->getName();
 // 	$this->putLog("Grammar rule name:" . $grRuleName);
 // 	$this->putLog($lexError);
  	$results[$grRuleName]=$lexError;	 	
    $this->reInit();
   }
 	 while($grRulesIter->hasMore())
 	 {
 	  $grRule = $grRulesIter->current();
 	  $grRule->setParser($this);
 	  $grRuleName = $grRule->getName();
 //	  $this->putLog("Grammar rule name:" . $grRuleName);
 	  if ($grRule->exec($this))
 	  {
 	   $tokensBufferIter->next();
 //	   $this->putLog("EXEC SUCCEDED...OK!");
 	   $error = $this->getCurrentError();
	   if(($error != Lexer_3::ERROR_0)||($tokensBufferIter->hasMore()))
 	   {
 	   	if(($error != Lexer_3::ERROR_0)&&($error != Lexer_3::NO_ERROR))
 	   	{
 //	   		$this->putLog($error);
 	   	}
 	   	else
 	   	{
 	   	 $this->setCurrentError(Parser::ERROR_4 . 
 	   	 STRING_SPACE . "or" . STRING_SPACE . Parser::ERROR_1);
 //	   	 $this->putLog('FAILED:Ambigous grammar or syntax error.');
 	    }
 	   }
 	   if($error==Lexer_3::ERROR_0)
 	    $this->setCurrentError(Parser::NO_ERROR); 
 	  }
 	  else
 	  {
 //	   $this->putLog("EXEC FAILED !");
 	   $error = $this->getCurrentError(); 
 	   if($error != Lexer_3::NO_ERROR)
 	   {
 //	    $this->putLog($error);
 	   }
 	   else
 	   {
 	    $this->setCurrentError(Parser::ERROR_1);
 //	    $this->putLog(Parser::ERROR_1);
 	   }
 	  }
 	  $results[$grRuleName] = $this->getCurrentError();
 	  $this->reInit();	   
 	 }
 	}
 	else
 	{
 	 $this->setCurrentError(Parser::ERROR_3);
 //	 $this->putLog(Parser::ERROR_3);
 	 $results[]=Parser::ERROR_3;
  }
  $this->setResults($results);
  if(in_array(PARSER::NO_ERROR,$results))
   return true;
  else
   return false;
 }	
}

?>