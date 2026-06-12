<?
require_once("../src/Parser_grammar_rule.php");

define('A_GRAMMAR_RULE',"a");

class  Parser_grammar_rule_a
{


function __construct()
{
parent::__construct(A_GRAMMAR_RULE);
}

function init():void
{

}

function getTokensBufferPointer():string|int
{
$parser = $this->getParser();
$tokensBufferIter = $parser->getTokensBufferIterator();
return ($tokensBufferIter->pos());

}

function backtrack(int $actTokensBufferPointer):void
{
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
$res1 = $parser->match(Token::TYPE_DELIM,PHP_ARRAYS_TOKEN_VAL_WS);
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
$res2=true;
$res11=false;

$res11=$this->PHP_ARRAY();

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
$res22=false;
$res23=false;
$res24=false;
$res25=false;

$res21=$this->ITEM();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->SPACE();

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res23=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_ARROW);

if(!$res23)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res24=$this->SPACE();

if(!$res24)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res25=$this->PHP_ARRAY();

if(!$res25)
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

$res2=$res21 && $res22 && $res23 && $res24 && $res25;
}

$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function PHP_ARRAY():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;
$res16=false;
$res17=false;

$res11=$parser->match(Token::TYPE_RESERVED_WORD,PHP_ARRAYS_TOKEN_VAL_ARRAY);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SPACE();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_OPEN_PAR);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$this->SPACE();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$this->ITEMS_SEQ();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$this->SPACE();

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR);

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

if (! $res)
return false;
return true;
}

function ITEMS_SEQ():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res3=true;
$res11=false;
$res12=false;
$res13=false;

$res11=$this->ITEMS();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SPACE();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->NEXT_ITEM();

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

if(!$res1)
{
$res21=false;
$res22=false;
$res23=false;

$res21=$this->PHP_ARRAY();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->SPACE();

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res23=$this->NEXT_ITEM();

if(!$res23)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

$res2=$res21 && $res22 && $res23;
}

$res3=true;
$res=$res1 | $res2 | $res3;

if (! $res)
return false;
return true;
}

function ITEMS():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;

$res11=$this->ITEMS1();

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

$res21=$this->ITEMS2();

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

if (! $res)
return false;
return true;
}

function ITEMS1():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;

$res11=$this->ITEM();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SPACE();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_ARROW);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$this->SPACE();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$this->ITEM();

if(!$res15)
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

$res1=$res11 && $res12 && $res13 && $res14 && $res15;

if(!$res1)
{
$res21=false;
$res22=false;
$res23=false;
$res24=false;
$res25=false;

$res21=$this->ITEM();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->SPACE();

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res23=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_ARROW);

if(!$res23)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res24=$this->SPACE();

if(!$res24)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res25=$this->PHP_ARRAY();

if(!$res25)
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

$res2=$res21 && $res22 && $res23 && $res24 && $res25;
}

$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function ITEMS2():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$this->ITEM();

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

function ITEM():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res3=true;
$res4=true;
$res11=false;

$res11=$parser->match(Token::TYPE_LEXICAL_ELEMENT,PHP_ARRAYS_TOKEN_VAL_ITEM1);

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

$res21=$parser->match(Token::TYPE_LEXICAL_ELEMENT,PHP_ARRAYS_TOKEN_VAL_ITEM2);

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res2=$res21;
}


if(!$res2)
{
$res31=false;

$res31=$parser->match(Token::TYPE_LEXICAL_ELEMENT,PHP_ARRAYS_TOKEN_VAL_NUM);

if(!$res31)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res3=$res31;
}


if(!$res3)
{
$res41=false;

$res41=$parser->match(Token::TYPE_LEXICAL_ELEMENT,PHP_ARRAYS_TOKEN_VAL_CONST);

if(!$res41)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res4=$res41;
}

$res=$res1 | $res2 | $res3 | $res4;

if (! $res)
return false;
return true;
}

function NEXT_ITEM():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;
$res13=false;

$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,PHP_ARRAYS_TOKEN_VAL_VIRGOLA);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->SPACE();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->ITEMS_SEQ();

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
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

}
