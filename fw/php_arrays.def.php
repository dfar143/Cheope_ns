<?
namespace Cheope_ns\fw;
require_once("Lex_rules_container.class.php");
require_once("Parser_grammar_rules_container.class.php");
require_once("Php_arrays_parser_grammar_rules.class.php");

define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_ARRAY',"array");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_ARROW',"arrow");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_OPEN_PAR',"open_par");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR',"close_par");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_VIRGOLA',"virgola");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_WS',"ws");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_ITEM1',"item1");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_ITEM2',"item2");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_NUM',"num");
define(__NAMESPACE__ . '\PHP_ARRAYS_TOKEN_VAL_CONST',"const");


define(__NAMESPACE__ . '\PHP_ARRAYS_RULE_NAME_SUFFIX',"rule");

define(__NAMESPACE__ . '\PHP_ARRAYS_ARRAY_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_ARRAY . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_ARROW_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_ARROW . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_OPEN_PAR_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_OPEN_PAR . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_CLOSE_PAR_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_VIRGOLA_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_VIRGOLA . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_WS_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_WS . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_ITEM1_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_ITEM1 . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_ITEM2_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_ITEM2 . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_NUM_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_NUM . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\PHP_ARRAYS_CONST_RULE',namespace\PHP_ARRAYS_TOKEN_VAL_CONST . namespace\PHP_ARRAYS_RULE_NAME_SUFFIX);

$phpArraysRule0=new Lex_rule("regola0");
$phpArraysRule1=new Lex_rule("regola1");
$phpArraysRule2=new Lex_rule("regola2");
$phpArraysRule3=new Lex_rule("regola3");
$phpArraysRule4=new Lex_rule("regola4");
$phpArraysRule5=new Lex_rule("regola5");
$phpArraysRule6=new Lex_rule("regola6");
$phpArraysRule7=new Lex_rule("regola7");
$phpArraysRule8=new Lex_rule("regola8");
$phpArraysRule9=new Lex_rule("regola9");

$phpArraysRule0->setRegexp("/^[Aa]rray/i");
$phpArraysRule0->setTokenType(Token::TYPE_RESERVED_WORD);
$phpArraysRule0->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_ARRAY);

$phpArraysRule1->setRegexp("/^=>/i");
$phpArraysRule1->setTokenType(Token::TYPE_SPECIAL_ITEM);
$phpArraysRule1->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_ARROW);

$phpArraysRule2->setRegexp("/^\(/i");
$phpArraysRule2->setTokenType(Token::TYPE_SPECIAL_ITEM);
$phpArraysRule2->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_OPEN_PAR);

$phpArraysRule3->setRegexp("/^\)/i");
$phpArraysRule3->setTokenType(Token::TYPE_SPECIAL_ITEM);
$phpArraysRule3->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_CLOSE_PAR);

$phpArraysRule4->setRegexp("/^,/i");
$phpArraysRule4->setTokenType(Token::TYPE_SPECIAL_ITEM);
$phpArraysRule4->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_VIRGOLA);

$phpArraysRule5->setRegexp("/^[\s]+/i");
$phpArraysRule5->setTokenType(Token::TYPE_DELIM);
$phpArraysRule5->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_WS);

$phpArraysRule6->setRegexp("/^'(?:[^'\\\\]|(?:\\\\\\\\)|(?:\\\\\\\\)*\\\\.{1})*'/i");
$phpArraysRule6->setTokenType(Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule6->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_ITEM1);

$phpArraysRule7->setRegexp("/^\"(?:[^\"\\\\]|(?:\\\\\\\\)|(?:\\\\\\\\)*\\\\.{1})*\"/i");
$phpArraysRule7->setTokenType(Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule7->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_ITEM2);

$phpArraysRule8->setRegexp("/^[0-9][0-9]*/i");
$phpArraysRule8->setTokenType(Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule8->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_NUM);

$phpArraysRule9->setRegexp("/^[A-Z@_]+/");
$phpArraysRule9->setTokenType(Token::TYPE_LEXICAL_ELEMENT);
$phpArraysRule9->setTokenVal(namespace\PHP_ARRAYS_TOKEN_VAL_CONST);

define(__NAMESPACE__ . '\PHP_ARRAYS_LEX_RULE_CONTAINER_0',"Contenitore_regole_0");

$phpArraysDefRules=new Lex_rules_container(namespace\PHP_ARRAYS_LEX_RULE_CONTAINER_0);
$phpArraysDefRules->add($phpArraysRule0);
$phpArraysDefRules->add($phpArraysRule1);
$phpArraysDefRules->add($phpArraysRule2);
$phpArraysDefRules->add($phpArraysRule3);
$phpArraysDefRules->add($phpArraysRule4);
$phpArraysDefRules->add($phpArraysRule5);
$phpArraysDefRules->add($phpArraysRule6);
$phpArraysDefRules->add($phpArraysRule7);
$phpArraysDefRules->add($phpArraysRule8);
$phpArraysDefRules->add($phpArraysRule9);

$phpArraysRulesArray=array($phpArraysDefRules);

define(__NAMESPACE__ . '\PHP_ARRAYS_PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$phpArraysDefGrRule0=new Parser_grammar_rule_b();

$phpArraysDefGrRules=new Parser_grammar_rules_container(namespace\PHP_ARRAYS_PARSER_GRAMMAR_RULE_CONTAINER_1);
$phpArraysDefGrRules->add($phpArraysDefGrRule0);

?>