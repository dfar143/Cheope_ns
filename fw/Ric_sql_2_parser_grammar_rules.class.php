<?
namespace Cheope_ns\fw;
require_once("Parser_grammar_rule.class.php");

define(__NAMESPACE__ . '\A_GRAMMAR_RULE',"a");

class  Parser_grammar_rule_a extends Parser_grammar_rule
{


function __construct()
{
parent::__construct(A_GRAMMAR_RULE);
}

function init():void
{

}

function getTokensBufferPointer():int|string
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
$res1 = $parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);
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

$res11=$this->SELECT2();

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

function SELECT2():bool
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
$res18=false;
$res19=false;
$res110=false;

$res11=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_SELECT);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->HLIST();

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_FROM);

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->TABLES_LIST();

if(!$res17)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res18=$this->WHERE_CLAUSE();

if(!$res18)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res19=$this->GROUPBY_CLAUSE();

if(!$res19)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res110=$this->ORDERBY_CLAUSE();

if(!$res110)
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

}

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16 && $res17 && $res18 && $res19 && $res110;
$res=$res1;

if (! $res)
return false;
return true;
}

function HLIST():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res3=true;
$res11=false;
$res12=false;

$res11=$this->FIELD_OBJ();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->HLIST1();

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

$res21=$this->FUN_CALL();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->HLIST1();

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

$res31=$parser->match(Token::TYPE_SPECIAL_ITEM,
RIC_SQL_2_TOKEN_VAL_STAR,RIC_SQL_2_TOKEN_ATTR_FIELD);

if(!$res31)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res3=$res31;
}

$res=$res1 | $res2 | $res3;

if (! $res)
return false;
return true;
}

function HLIST1():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_COMMA);

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
$res14=$this->HLIST();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function FUN_CALL():bool
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

$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_FUN_HEAD);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

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
$res14=$this->FIELD_OBJ1();

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
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

if(!$res16)
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

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16;
$res=$res1;

if (! $res)
return false;
return true;
}

function FIELD_OBJ1():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$parser->match(Token::TYPE_LEXICAL_ELEMENT,RIC_SQL_2_TOKEN_VAL_ITEM,RIC_SQL_2_TOKEN_ATTR_FIELD);

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

function FIELD():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$token = $parser->getCurrentToken();
$res11=$parser->match(Token::TYPE_LEXICAL_ELEMENT,RIC_SQL_2_TOKEN_VAL_ITEM,RIC_SQL_2_TOKEN_ATTR_FIELD);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->FIELD_POINT($token);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function FIELD_POINT(Token $actToken):bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;

$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_POINT);

if(!$res11)
{
$actToken->setAttribute(RIC_SQL_2_TOKEN_ATTR_FIELD);
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_LEXICAL_ELEMENT,RIC_SQL_2_TOKEN_VAL_ITEM,RIC_SQL_2_TOKEN_ATTR_FIELD);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function FIELD_OBJ():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->FIELD();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->ASFIELD_OBJ();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function ASFIELD_OBJ():bool
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

$res11=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_AS);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$this->FIELD_OBJ1();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function FIELD_LIST():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->FIELD();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->FIELD_LIST1();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function FIELD_LIST1():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_COMMA);

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
$res14=$this->FIELD_LIST();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function TABLE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$parser->match(Token::TYPE_LEXICAL_ELEMENT,RIC_SQL_2_TOKEN_VAL_ITEM,RIC_SQL_2_TOKEN_ATTR_TABLE);

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

function TABLES_LIST():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;

$res11=$this->TABLE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->TABLES_LIST1();

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
$res23=false;
$res24=false;
$res25=false;

$res21=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

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
$res23=$this->TABLES_LIST();

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
$res25=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

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

function TABLES_LIST1():bool
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
$res14=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_COMMA);

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
$res14=$this->TABLES_LIST_SIMPLE();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;

if(!$res1)
{
$res21=false;

$res21=$this->TABLES_LIST_CX1();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

$res2=$res21;
}

$res3=true;
$res=$res1 | $res2 | $res3;

if (! $res)
return false;
return true;
}

function TABLES_LIST_SIMPLE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->TABLE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->TABLES_LIST_SIMPLE1();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function TABLES_LIST_SIMPLE1():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_COMMA);

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
$res14=$this->TABLES_LIST_SIMPLE();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function TABLES_LIST_CX():bool
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
$res16=false;

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

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
$res14=$this->TABLES_LIST_CX1();

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
$res16=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

if(!$res16)
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

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16;

if(!$res1)
{
$res21=false;

$res21=$this->TABLES_LIST_CX1();

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

function TABLES_LIST_CX1():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->TABLES_LIST_CX1_INNER();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->TABLES_LIST_CX();

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

$res21=$this->SPACE();

if(!$res21)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res22=$this->TABLES_LIST_CX1_LEFT();

if(!$res22)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res23=$this->TABLES_LIST_CX();

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

function TABLES_LIST_CX1_INNER():bool
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

$res11=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_INNER);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_JOIN);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$this->TABLE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->ON_CLAUSE();

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

function TABLES_LIST_CX1_LEFT():bool
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

$res11=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_LEFT);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_JOIN);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$this->TABLE();

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res16)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res17=$this->ON_CLAUSE();

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

function OPS():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;

$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_OP);

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

$res21=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_STAR);

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

function NEXTEXPR2():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->OPS();

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
$res14=$this->EXPRITEM2();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function NEXTEXPR1():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_RELOP);

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
$res14=$this->EXPRITEM1();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function EXPRITEM():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res3=true;
$res4=true;
$res11=false;
$res12=false;
$res13=false;
$res14=false;
$res15=false;

$res11=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

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
$res13=$this->EXPRL();

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
$res15=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

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

$res21=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_NUM);

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

$res31=$this->FIELD();

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

$res41=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_SSTRING);

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

function EXPRITEM2():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->EXPRITEM();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->NEXTEXPR2();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function EXPRITEM1():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->EXPRITEM2();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->NEXTEXPR1();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function NEXTEXPRL():bool
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

$res11=$this->SPACE();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_SPECIAL_ITEM,RIC_SQL_2_TOKEN_VAL_LOGICALOP);

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
$res14=$this->EXPRL();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function EXPRL():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;
$res12=false;

$res11=$this->EXPRITEM1();

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$this->NEXTEXPRL();

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

$res1=$res11 && $res12;
$res=$res1;

if (! $res)
return false;
return true;
}

function ON_CLAUSE():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res2=true;
$res11=false;
$res12=false;
$res13=false;

$res11=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_ON);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$this->EXPRL();

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

function WHERE_CLAUSE():bool
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

//$res11=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);
$res11=$this->SPACE();
if(!$res11)
{
 $this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_WHERE);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$this->EXPRL();

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
}

}

}

}

$res1=$res11 && $res12 && $res13 && $res14;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function GROUPBY_CLAUSE()
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
$res16=false;

$res11=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_GROUP);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_BY);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$this->GROUPBY_CLAUSE1();

if(!$res16)
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

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function GROUPBY_CLAUSE1():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$this->FIELD_LIST();

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

function ORDERBY_CLAUSE():bool
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
$res16=false;

$res11=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res11)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res12=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_ORDER);

if(!$res12)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res13=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res13)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res14=$parser->match(Token::TYPE_RESERVED_WORD,RIC_SQL_2_TOKEN_VAL_BY);

if(!$res14)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res15=$parser->match(Token::TYPE_DELIM,RIC_SQL_2_TOKEN_VAL_WS);

if(!$res15)
{
$this->backtrack($localTokensBufferPointer);
}
else
{
$res16=$this->ORDERBY_CLAUSE1();

if(!$res16)
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

$res1=$res11 && $res12 && $res13 && $res14 && $res15 && $res16;
$res2=true;
$res=$res1 | $res2;

if (! $res)
return false;
return true;
}

function ORDERBY_CLAUSE1():bool
{
$parser = $this->getParser();
$lex = $parser->getLex();
$localTokensBufferPointer = $this->getTokensBufferPointer();

$res1=true;
$res11=false;

$res11=$this->FIELD_LIST();

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

}
