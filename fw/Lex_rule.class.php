<?
namespace Cheope_ns\fw;
require_once("generic.fun.php");
require_once("Token.class.php");
require_once("Creator.tra.php");

class Lex_rule
{
	private $name=STRING_NULL;
	private $regexp=STRING_NULL;
	private $currentToken=null;
	private $tokenType=STRING_NULL;
	private $tokenVal=STRING_NULL;
	private $currentLexema=STRING_NULL;

	function __construct(string $actName)
	{
		$this->setName($actName);
	}
	
	function setName(string $actName):void
	{
		$this->name = $actName;
	}
	
	function getName():string
	{
		return $this->name;
	}
	
	function setRegexp(string $actRegexp):void
	{
		$this->regexp = $actRegexp;
	}
	
	function getRegexp():string
	{
		return $this->regexp;
	}
	
	function getTokenType():string
	{
		return $this->tokenType;
	}
	
	function setTokenType(string $actTokenType):void
	{
		$this->tokenType = $actTokenType;
	}
	
	function getTokenVal():string
	{
		return $this->tokenVal;
	}
	
	function setTokenVal(string $actTokenVal):void
	{
		$this->tokenVal = $actTokenVal;
	}
	
	function getCurrentToken():Token
	{
		return $this->currentToken;
	}
	
	function setCurrentToken(Token $actToken):void
	{
		$this->currentToken = $actToken;
	}
		
	function getCurrentLexema():string
	{
		return $this->currentLexema;
	}
	
	function setCurrentLexema(string $actLexema):void
	{
		$this->currentLexema = $actLexema;
	}
	
	function createToken():Token
	{
		return Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
	}
	
	function execMatch(string $actStr):string|bool
	{
		$regexp = $this->getRegexp();
		$this->setCurrentLexema($actStr);
		$arrayOfMatches = array();
		if ($matchedStr = preg_match($regexp,$actStr,$arrayOfMatches))
		{
			$token = $this->createToken();
			$type = $this->getTokenType();
			$token->setType($type); 
		  $val = $this->getTokenVal();
			$token->setVal($val);
			$token->setLexema($arrayOfMatches[0]);
			$this->setCurrentToken($token);
			return $arrayOfMatches[0];			
		}
		else
		 return false;
	}	
}

?>