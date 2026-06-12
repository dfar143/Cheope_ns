<?
namespace Cheope_ns\fw;
require_once("generic.const.php");
require_once("Lex_rules_container.class.php");
require_once("Token.class.php");
require_once("Creator.tra.php");

class Lexer_3
{
 use Creator;
 
 const NO_ERROR=STRING_NULL;
 const ERROR_0="Lexer_3:End of buffer.";
 const ERROR_1="Lexer_3:Lexical error.";
 const ERROR_2="Lexer_3:Rules not set.";
// const ERROR_3="Error in Lexer_3.setBuf: the argument must be an array.";
 const ERROR_4="Error in Lexer_3.init:Cannot load data.";
 const LOG_FILE="lexer_log.txt";
 
 private $fileName;
 private $itemStr;
 private $matchedStr;
 private $matchingStr;
 private $gBuf = array();
 private $symTable = array();
 // Rules container array. 
 private $rules=null;
 private $currentRule=null;
 private $currentError;
 private $logEnabled = false;
// Log file.
 private $logFileName=self::LOG_FILE;
 private $enableLogOnFile=false;
 
 // Execution sequence: 
 // $lex->setRules($rules);
 // $lex->init();
 // $lex->exec();
 
 function __construct(string $actFileName=STRING_NULL,string $actItemStr=STRING_NULL)
 {
 	$this->setFileName($actFileName);
 	$this->setItemStr($actItemStr);
 }
 
 static function createToken(?string $actType=STRING_NULL,?string $actVal=STRING_NULL):Token
 {
 	return Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL,$actType,$actVal);
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
    echo $actLogInfo . HTML_TAG_INIT_CHAR . 
    SEP_TAG . 
    STRING_SLASH . HTML_TAG_END_CHAR;
  }
 }
 
 
 function getItemStr():string
 {
 	return $this->itemStr;
 }
 
 function setItemStr(string $actItemStr):void
 {
 	$this->itemStr = $actItemStr;
 }
 
 function getMatchedStr():string
 {
 	return $this->matchedStr;
 }
 
 function setMatchedStr(string $actMatchedStr):void
 {
 	$this->matchedStr = $actMatchedStr;
 }
 
 function getMatchingStr():string
 {
 	return $this->matchingStr;
 }
 
 function setMatchingStr(string $actMatchingStr):void
 {
 	$this->matchingStr = $actMatchingStr;
 }
 
 function setFileName(string $actFileName):void
 {
 	 $this->fileName = $actFileName;
 }
 
 function getFileName():string
 {
 	return $this->fileName;
 }
 
 function setBuf(array $actBuf):void
 {
 //	if(is_array($actBuf))
 	 $this->gBuf = $actBuf;
 //	else
 //	 die(self::ERROR_3);
 }
 
 function getBuf():array
 {
 	return $this->gBuf;
 }
 
 function setRules(Lex_rules_container $actRules):void
 {
 	$this->rules = $actRules;
 }
 
 function getRules():Lex_rules_container
 {
 	return $this->rules;
 }
 
 function setCurrentRule(Lex_rule $actRule):void
 {
 	$this->currentRule = $actRule;
 }
 
 function getCurrentRule():Lex_rule
 {
 	return $this->currentRule;
 }
 
 function setCurrentError(string $actError):void
 {
 	$this->currentError = $actError;
 }
 
 function getCurrentError():string
 {
 	return $this->currentError;
 }
 
 function loadReservedWords(array $actReservedWords):void
 {
 	foreach($actReservedWords as $reservedWord)
 	{
 	 $token = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL,Token::TYPE_RESERVED_WORD,$reservedWord);
 	 $token->setLexema(strtolower($reservedWord));
 	 $this->installToken($token);
  }
 }
 
 function loadSpecialItems(array $actSpecialItems):void
 {
 	foreach($actSpecialItems as $specialItem)
 	{
 	 $token = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL,Token::TYPE_SPECIAL_ITEM,$specialItem);
 	 $token->setLexema(strtolower($specialItem));
 	 $this->installToken($token);
  }
 }
 
 function init():void
 {
 	 $fileName = $this->getFileName();
 	 if ($fileName != STRING_NULL)
 	 {
 	 	$gBuf = file($fileName);
 	  if(! $gBuf)
 	  {
     die(self::ERROR_4);
    }
    else
     $this->setBuf($gBuf);
   }
   else
   {
   	$gBuf = array($this->getItemStr());
   	$this->setBuf($gBuf);
   }
   $this->setMatchedStr(STRING_NULL);
   $gBuf = $this->getBuf();
   $this->setMatchingStr(implode(STRING_NULL,$gBuf));
   $this->setCurrentError(STRING_NULL);
 }
 
 function getSymTable():array
 {
 	return $this->symTable;
 }
 
 function setSymTable(array $actSymTable):void
 {
 	$this->symTable = $actSymTable;
 }
 
 function dumpSymTable():void
 {
 	$symTable = $this->getSymTable();
 	foreach($symTable as $ind => $token)
 	{
 		echo $ind . STRING_COLON . $token->getType() . STRING_SPACE . $token->getVal() . 
 		STRING_SPACE . $token->getAttribute() . STRING_SPACE . 
 		$token->getLexema() . HTML_TAG_INIT_CHAR . 
    SEP_TAG . 
    STRING_SLASH . HTML_TAG_END_CHAR;
 	}
 }
 
 function flushSymTable():void
 {
 	$this->setSymTable(array());
 }
 
// La funziona ritorna una stringa , ma non sempre. A volte non torna niente.
//
 function installToken(Token $actToken)
 {
 	$tokenActLexema = $actToken->getLexema();
 	$tokenActVal = $actToken->getVal();
 	$tokenActType = $actToken->getType();
 	foreach($this->symTable as $ind => $token)
 	{
 	 $tokenLexema = $token->getLexema();
 	 $tokenVal = $token->getVal(); 
 	 
 	 if(($tokenActType == Token::TYPE_RESERVED_WORD) 
 	 || ($tokenActType == Token::TYPE_SPECIAL_ITEM)
 	 || ($tokenActType == Token::TYPE_DELIM))
 	 {
 	  if($tokenVal==$tokenActVal)
 	   return $ind;
 	 } 
 	 else
 	  if (($tokenVal==$tokenActVal)&&($tokenActLexema==$tokenLexema))
 	   return $ind;
 	}
 	$this->pushToken($actToken);
 }
 
 function pushToken(Token $actToken):void
 {
 	$this->symTable[] = $actToken;
 }
 
 function popToken():Token
 {
 	return array_pop($this->symTable);
 }
 
 function getToken(string $actTokenVal):Token
 {
 	foreach($symTable as $token)
 	{
 		if($token->val==$actTokenVal)
 		 return $token;
  }
  return false;
 }
 
 function getTokenByLexema(string $actTokenLexema):Token|bool
 {
 	$symTable = $this->getSymTable();
 	foreach($symTable as $token)
 	{
 		if($token->getLexema()==$actTokenLexema)
 		 return $token;
 	}
 	return false;
 }
 
 function nextToken():bool
 {
 	$rules = $this->getRules();
 	$rules_iter = $rules->create();
 	$rules_iter->reset();
 	$rule = $rules_iter->current();
 	$this->setCurrentRule($rule);
 //	$this->putLog("Rule:" . $rule->getName());
 	if($rules_iter->hasMore())
 	{	  	 
 	 while(true)
 	 {
 	 	$matchedStr = $this->getMatchedStr();
 //	 	$this->putLog("Matched string:" . $matchedStr);
 	  $matchingStr = $this->getMatchingStr();
 //	  $this->putLog("Matching string:" . $matchingStr);
      $this->setCurrentError(self::NO_ERROR);
 	  while(($matchingStr=str_right($matchingStr,strlen($matchingStr)-strlen($matchedStr)))!==false)
 	  {
 	 	 $this->setMatchingStr($matchingStr); 	 	  	   
         //$this->putLog("Matching string:" . ord($matchingStr));																	  
 	 	 while($rules_iter->hasMore())
 	 	 { 	  	 
 	 	  if((($matchedStr = $rule->execMatch($matchingStr))!==false)?true:false)
 	 	  {
 	 	   $this->setMatchedStr($matchedStr);
 	 	   $disp = strlen($matchedStr);
 	// 	   $this->putLog("Just Matched string:" . $matchedStr);
 	 	 	 $this->installToken($rule->getCurrentToken());
 	 	   return true;
 	 	  }
 	 	  $rules_iter->next();
 	 	  $rule = $rules_iter->current();
 	 	  if($rules_iter->hasMore())
 	 	  {
 	 	   $this->setCurrentRule($rule);
 	//     $this->putLog("Rule:" . $rule->getName());
 	 	  }
 	 	 }
 	   $this->setCurrentError(self::ERROR_1);
	//   $this->putLog(self::ERROR_1);
 	   return false; 	 	 
 	 	}
 	  if(strlen($matchingStr)==0)
 	  {
 	   $this->setCurrentError(self::ERROR_0);
 	   return false;
 	  }
 	 }  	
 	}
  else
  {
 	 $this->setCurrentError(self::ERROR_2);
 	 return false;
  }
 }
 
 function exec():void
 {
 // $this->putlog("Start.");
 	while($this->nextToken())
 	{}
 // $this->putlog("End.");
  $this->dumpSymTable();
 }
 
} 


?>