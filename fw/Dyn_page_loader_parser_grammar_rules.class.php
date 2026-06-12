<?
namespace Cheope_ns\fw;
require_once("Parser_grammar_rule.class.php");
require_once("Creator.tra.php");

define('B_GRAMMAR_RULE',"b");

class  Parser_grammar_rule_b extends Parser_grammar_rule
{
 use Creator;	
	
var $texts=array();

function __construct()
{
parent::__construct(B_GRAMMAR_RULE);
}

function getTexts():array
{
	return $this->texts;
}

function setTexts(array $actTexts):void
{
	$this->texts = $actTexts;
}

function pushText(Token $actToken):void
{
 $texts = $this->getTexts();
  $texts[] = $actToken;
  $this->setTexts($texts);	
}

function init():void
{

}

function getTokensBufferPointer():int
{
$parser = $this->getParser();
$tokensBufferIter = $parser->getTokensBufferIterator();
return ($tokensBufferIter->pos());

}

function backtrack(int $actTokensBufferPointer):void
{
//$parser = $this->getParser();
//$parser->putLog("BACKTRACK");
//$parser->putLog("TokensBufferPointer:" . $actTokensBufferPointer);
$parser = $this->getParser();
$tokensBufferIter = $parser->getTokensBufferIterator();
$tokensBufferIter->reset();
$i=0;
while($i <= $actTokensBufferPointer-1)
{
 $tokensBufferIter->next();
 $i++;
}

}

function space():bool
{
$parser = $this->getParser();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$res1 = $parser->match(Token::TYPE_DELIM,DYN_PAGE_LOADER_TOKEN_VAL_WS);
if(! $res1)
$this->backtrack($localTokensBufferPointer);
$res2 = true;
$res = $res1 || $res2;
if(! $res)
return false;
return true;

}

function exec():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$this->SECTIONS();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;
$res=$res1;

if (! $res)
return false;
return true;
}

function SECTIONS():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering SECTIONS...");
$res1=true;
$res2=true;
$res11=false;
$res12=false;

$tok = $parser->getCurrentToken();
$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TEXT);
$this->pushText($tok);
$res12=$this->CODE();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;

if(!$res1)
{
$res21=false;

$res21=$this->CODE();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res2=$res21;
}

$res=$res1 | $res2;
$parser->putLog("Exiting SECTIONS...");
if (! $res)
return false;
$parser->putLog("Recognize SECTIONS...");
return true;
}

function PHP_CODE():bool
{
global $rule6_php;
global $rule6;

$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering PHP_CODE...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$rules = $lex->getRules();
$rules->setElement($rule6_php,6);
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_PHP_OPEN_TAG);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->SPACE();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok = $parser->getCurrentToken();
$rules->setElement($rule6,6);
$res14=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
 $nTok = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
//$nTok = new Token();
$nTok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_PHP_CODE);
$lexema = $tok->getLexema();
$nTok->setLexema($lexema);
$this->pushText($nTok);
$res15=$this->SPACE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_PHP_CLOSE_TAG);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->SPACE();

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

}

}

}
$rules->setElement($rule6,6);
$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17;
$res=$res1;
$parser->putLog("Exiting PHP_CODE...");
if (! $res)
return false;
$parser->putLog("Recognize PHP_CODE...");
return true;
}

function HTML_CODE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering HTML_CODE...");
$res1=true;
$res2=true;
$res11=false;

$res11=$this->HTML_TAG_OPEN_CLOSE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res1=$res11;

if(!$res1)
{
$res21=false;

$res21=$this->HTML_TAG_STANDALONE();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res2=$res21;
}

$res=$res1 | $res2;
$parser->putLog("Exiting HTML_CODE...");
if (! $res)
return false;
$parser->putLog("Recognize HTML_CODE...");
return true;
}

function HTML_TAG_OPEN_CLOSE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering HTML_TAG_OPEN_CLOSE...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;

$res11=$this->HTML_CODE_START();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SECTIONS();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->HTML_CODE_END();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

$res1=$res11 && $res12 && $res13;
$res=$res1;
$parser->putLog("Exiting HTML_TAG_OPEN_CLOSE...");
if (! $res)
return false;
$parser->putLog("Recognize HTML_TAG_OPEN_CLOSE...");
return true;
}


function HTML_TAG_STANDALONE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering HTML_TAG_STANDALONE...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;
$res18=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->SPACE();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok = $parser->getCurrentToken();
$res14=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT1);
if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_FSLASH);

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
//$nTok = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
$nTok = new Token();
$nTok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TAG);
$lexema = $tok->getLexema();
$lexema = STRING_OPEN_ANGLE_BRACKET . $lexema . DYN_PAGE_LOADER_TOKEN_VAL_FSLASH . STRING_CLOSE_ANGLE_BRACKET;
$nTok->setLexema($lexema);
$this->pushText($nTok);
$res16=$this->SPACE();

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG);

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res18=$this->SPACE();

if(!$res18)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17 && $res18;
$res=$res1;

if (! $res)
return false;
return true;
}

function HTML_CODE_START():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering HTML_CODE_START...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->SPACE();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok = $parser->getCurrentToken();
$res14=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
	$nTok = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
//$nTok = new Token();
$nTok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TAG);
$lexema = $tok->getLexema();
$lexema = STRING_OPEN_ANGLE_BRACKET . $lexema . STRING_CLOSE_ANGLE_BRACKET;
$nTok->setLexema($lexema);
$this->pushText($nTok);
$res15=$this->SPACE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->SPACE();

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17;
$res=$res1;
$parser->putLog("Exiting HTML_CODE_START...");
if (! $res)
return false;
$parser->putLog("Recognize HTML_CODE_START...");
return true;
}

function HTML_CODE_END():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering HTML_CODE_END...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;
$res18=false;
$res19=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->SPACE();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_FSLASH);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$this->SPACE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok = $parser->getCurrentToken();
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
	$nTok = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
//$nTok = new Token();
$nTok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TAG);
$lexema = $tok->getLexema();
$lexema = STRING_OPEN_ANGLE_BRACKET . STRING_SLASH . $lexema . STRING_CLOSE_ANGLE_BRACKET;
$nTok->setLexema($lexema);
$this->pushText($nTok);
$res17=$this->SPACE();

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res18=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG);

if(!$res18)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res19=$this->SPACE();

if(!$res19)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

}

}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17 && $res18 && $res19;
$res=$res1;
$parser->putLog("Exiting HTML_CODE_END...");
if (! $res)
return false;
$parser->putLog("Recognize HTML_CODE_END...");
return true;
}

function COMP_CODE():bool
{
global $rule6_comp;
global $rule6;

$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering COMP_CODE...");
$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$rules = $lex->getRules();
$rules->setElement($rule6_comp,6);
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_COMP_OPEN_TAG);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->SPACE();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$tok = $parser->getCurrentToken();
$rules->setElement($rule6,6);
$res14=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
	$nTok = Creator::create(getClassNameForCreate(Classes_info::TOKEN_CLASS),STRING_NULL);
//nTok = new Token();
$nTok->setAttribute(DYN_PAGE_LOADER_TOKEN_ATTR_COMP_CODE);
$lexema = $tok->getLexema();
$nTok->setLexema($lexema);
$this->pushText($nTok);
$res15=$this->SPACE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,DYN_PAGE_LOADER_TOKEN_VAL_COMP_CLOSE_TAG);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->SPACE();

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

}

}

}
$rules->setElement($rule6,6);
$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17;
$res=$res1;
$parser->putLog("Exiting COMP_CODE...");
if (! $res)
return false;
$parser->putLog("Recognize COMP_CODE...");
return true;
}

function CODE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();
$parser->putLog("Entering CODE...");
$res1=true;
$res2=true;
$res3=true;
$res4=true;
$res11=false;
$res12=false;

$res11=$this->HTML_CODE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SECTIONS();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;

if(!$res1)
{
$res21=false;
$res22=false;

$res21=$this->PHP_CODE();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->SECTIONS();

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res2=$res21 && $res22;
}


if(!$res2)
{
$res31=false;
$res32=false;

$res31=$this->COMP_CODE();

if(!$res31)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res32=$this->SECTIONS();

if(!$res32)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res3=$res31 && $res32;
}

$res4=true;
$res=$res1 | $res2 | $res3 | $res4;
$parser->putLog("Exiting CODE...");
if (! $res)
return false;
$parser->putLog("Recognize CODE...");
return true;
}

}
