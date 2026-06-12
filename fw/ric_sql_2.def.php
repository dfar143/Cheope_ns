<?
namespace Cheope_ns\fw;
require_once("Lex_rules_container.class.php");
require_once("Parser_grammar_rules_container.class.php");
require_once("Ric_sql_2_parser_grammar_rules.class.php");


define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_SELECT',"select");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_FROM',"from");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_INNER',"inner");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_JOIN',"join");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_LEFT',"left");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_ON',"on");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_WHERE',"where");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_ORDER',"order");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_BY',"by");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_GROUP',"group");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_AS',"as");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_LIKE',"like");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_STAR',"star");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_FUN_HEAD',"fun_head");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_NUM',"num");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_LOGICALOP',"logicalop");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_OP',"op");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_RELOP',"relop");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_ITEM',"item");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_WS',"ws");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_COMMA',"comma");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_POINT',"point");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_OPEN_PAR',"open_par");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_CLOSE_PAR',"close_par");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_VAL_SSTRING',"sstring");

define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_ATTR_FIELD',"field");
define(__NAMESPACE__ . '\RIC_SQL_2_TOKEN_ATTR_TABLE',"table");

define(__NAMESPACE__ . '\RIC_SQL_2_RULE_NAME_SUFFIX',"rule");

define(__NAMESPACE__ . '\RIC_SQL_2_SELECT_RULE',namespace\RIC_SQL_2_TOKEN_VAL_SELECT . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_FROM_RULE',namespace\RIC_SQL_2_TOKEN_VAL_FROM . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_INNER_RULE',namespace\RIC_SQL_2_TOKEN_VAL_INNER . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_JOIN_RULE',namespace\RIC_SQL_2_TOKEN_VAL_JOIN . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_LEFT_RULE',namespace\RIC_SQL_2_TOKEN_VAL_LEFT . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_ON_RULE',namespace\RIC_SQL_2_TOKEN_VAL_ON . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_WHERE_RULE',namespace\RIC_SQL_2_TOKEN_VAL_WHERE . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_ORDER_RULE',namespace\RIC_SQL_2_TOKEN_VAL_ORDER . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_BY_RULE',namespace\RIC_SQL_2_TOKEN_VAL_BY . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_GROUP_RULE',namespace\RIC_SQL_2_TOKEN_VAL_GROUP . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_AS_RULE',namespace\RIC_SQL_2_TOKEN_VAL_AS . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_LIKE_RULE',namespace\RIC_SQL_2_TOKEN_VAL_LIKE . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_STAR_RULE',namespace\RIC_SQL_2_TOKEN_VAL_STAR . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_FUN_HEAD_RULE',namespace\RIC_SQL_2_TOKEN_VAL_FUN_HEAD . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_NUM_RULE',namespace\RIC_SQL_2_TOKEN_VAL_NUM . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_LOGICALOP_RULE',namespace\RIC_SQL_2_TOKEN_VAL_LOGICALOP . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_OP_RULE',namespace\RIC_SQL_2_TOKEN_VAL_OP . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_RELOP_RULE',namespace\RIC_SQL_2_TOKEN_VAL_RELOP . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_ITEM_RULE',namespace\RIC_SQL_2_TOKEN_VAL_ITEM . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_WS_RULE',namespace\RIC_SQL_2_TOKEN_VAL_WS . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_COMMA_RULE',namespace\RIC_SQL_2_TOKEN_VAL_COMMA . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_POINT_RULE',namespace\RIC_SQL_2_TOKEN_VAL_POINT . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_OPEN_PAR_RULE',namespace\RIC_SQL_2_TOKEN_VAL_OPEN_PAR . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_CLOSE_PAR_RULE',namespace\RIC_SQL_2_TOKEN_VAL_CLOSE_PAR . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\RIC_SQL_2_SSTRING_RULE',namespace\RIC_SQL_2_TOKEN_VAL_SSTRING . namespace\RIC_SQL_2_RULE_NAME_SUFFIX);
//}

$ricSql2Rule0 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola0");
$ricSql2Rule1 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola1");
$ricSql2Rule2 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola2");
$ricSql2Rule3 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola3");
$ricSql2Rule4 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola4");
$ricSql2Rule5 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola5");
$ricSql2Rule6 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola6");
$ricSql2Rule7 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola7");
$ricSql2Rule8 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola8");
$ricSql2Rule9 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola9");
$ricSql2Rule10 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola10");
$ricSql2Rule11 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola11");
$ricSql2Rule12 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola12");
$ricSql2Rule13 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola13");
$ricSql2Rule14 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola14");
$ricSql2Rule15 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola15");
$ricSql2Rule16 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola16");
$ricSql2Rule17 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola17");
$ricSql2Rule18 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola18");
$ricSql2Rule19 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola19");
$ricSql2Rule20 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola20");
$ricSql2Rule21 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola21");
$ricSql2Rule22 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola22");
$ricSql2Rule23 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola23");
$ricSql2Rule24 = Creator::create(getClassNameForCreate(Classes_info::LEX_RULE_CLASS),STRING_NULL,"regola24");

$ricSql2Rule0->setRegexp("/^SELECT\b/i");
$ricSql2Rule0->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule0->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_SELECT);

$ricSql2Rule1->setRegexp("/^FROM\b/i");
$ricSql2Rule1->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule1->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_FROM);

$ricSql2Rule2->setRegexp("/^INNER\b/i");
$ricSql2Rule2->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule2->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_INNER);

$ricSql2Rule3->setRegexp("/^JOIN\b/i");
$ricSql2Rule3->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule3->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_JOIN);

$ricSql2Rule4->setRegexp("/^LEFT\b/i");
$ricSql2Rule4->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule4->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_LEFT);

$ricSql2Rule5->setRegexp("/^ON\b/i");
$ricSql2Rule5->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule5->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_ON);

$ricSql2Rule6->setRegexp("/^WHERE\b/i");
$ricSql2Rule6->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule6->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_WHERE);

$ricSql2Rule7->setRegexp("/^ORDER\b/i");
$ricSql2Rule7->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule7->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_ORDER);

$ricSql2Rule8->setRegexp("/^BY\b/i");
$ricSql2Rule8->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule8->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_BY);

$ricSql2Rule9->setRegexp("/^GROUP\b/i");
$ricSql2Rule9->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule9->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_GROUP);

$ricSql2Rule10->setRegexp("/^AS\b/i");
$ricSql2Rule10->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule10->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_AS);

$ricSql2Rule11->setRegexp("/^LIKE(?=(\b)|(\())/i");
$ricSql2Rule11->setTokenType(Token::TYPE_RESERVED_WORD);
$ricSql2Rule11->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_LIKE);

$ricSql2Rule12->setRegexp("/^[\*]/");
$ricSql2Rule12->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule12->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_STAR);

$ricSql2Rule13->setRegexp("/^(count|avg|sum)(?=\()/i");
$ricSql2Rule13->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule13->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_FUN_HEAD);

$ricSql2Rule14->setRegexp("/^-?\d+(\.\d+)?/");
$ricSql2Rule14->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule14->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_NUM);

$ricSql2Rule15->setRegexp("/^AND(?=(\b)|(\())|OR(?=(\b)|(\())/i");
$ricSql2Rule15->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule15->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_LOGICALOP);

$ricSql2Rule16->setRegexp("/^[\+\-\/]/i");
$ricSql2Rule16->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule16->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_OP);

$ricSql2Rule17->setRegexp("/^(<>|<=|>=|>|<|=)/i");
$ricSql2Rule17->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule17->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_RELOP);

$ricSql2Rule18->setRegexp("/^[A-Za-z][A-Za-z0-9_]*/");
$ricSql2Rule18->setTokenType(Token::TYPE_LEXICAL_ELEMENT);
$ricSql2Rule18->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_ITEM);

$ricSql2Rule19->setRegexp("/^[\s]+/");
$ricSql2Rule19->setTokenType(Token::TYPE_DELIM);
$ricSql2Rule19->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_WS);

$ricSql2Rule20->setRegexp("/^,/");
$ricSql2Rule20->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule20->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_COMMA);

$ricSql2Rule21->setRegexp("/^\./");
$ricSql2Rule21->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule21->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_POINT);

$ricSql2Rule22->setRegexp("/^\(/");
$ricSql2Rule22->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule22->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_OPEN_PAR);

$ricSql2Rule23->setRegexp("/^\)/");
$ricSql2Rule23->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule23->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_CLOSE_PAR);

$ricSql2Rule24->setRegexp("/^(\"[a-zA-Z0-9_,:\.;\\\|!\$\/\(\)=\?\^\[\]@#]*\")|('[a-zA-Z0-9_,:\.;\\\|!\$\/\(\)=\?\^\[\]@#\s]*')/");
$ricSql2Rule24->setTokenType(Token::TYPE_SPECIAL_ITEM);
$ricSql2Rule24->setTokenVal(namespace\RIC_SQL_2_TOKEN_VAL_SSTRING);

define(__NAMESPACE__ . '\RIC_SQL_2_LEX_RULE_CONTAINER_0',"Contenitore_regole_0");

$ricSql2DefRules=Creator::create(getClassNameForCreate(Classes_info::LEX_RULES_CONTAINER_CLASS),STRING_NULL,namespace\RIC_SQL_2_LEX_RULE_CONTAINER_0);
$ricSql2DefRules->add($ricSql2Rule0);
$ricSql2DefRules->add($ricSql2Rule1);
$ricSql2DefRules->add($ricSql2Rule2);
$ricSql2DefRules->add($ricSql2Rule3);
$ricSql2DefRules->add($ricSql2Rule4);
$ricSql2DefRules->add($ricSql2Rule5);
$ricSql2DefRules->add($ricSql2Rule6);
$ricSql2DefRules->add($ricSql2Rule7);
$ricSql2DefRules->add($ricSql2Rule8);
$ricSql2DefRules->add($ricSql2Rule9);
$ricSql2DefRules->add($ricSql2Rule10);
$ricSql2DefRules->add($ricSql2Rule11);
$ricSql2DefRules->add($ricSql2Rule12);
$ricSql2DefRules->add($ricSql2Rule13);
$ricSql2DefRules->add($ricSql2Rule14);
$ricSql2DefRules->add($ricSql2Rule15);
$ricSql2DefRules->add($ricSql2Rule16);
$ricSql2DefRules->add($ricSql2Rule17);
$ricSql2DefRules->add($ricSql2Rule18);
$ricSql2DefRules->add($ricSql2Rule19);
$ricSql2DefRules->add($ricSql2Rule20);
$ricSql2DefRules->add($ricSql2Rule21);
$ricSql2DefRules->add($ricSql2Rule22);
$ricSql2DefRules->add($ricSql2Rule23);
$ricSql2DefRules->add($ricSql2Rule24);

$ricSql2RulesArray=array($ricSql2DefRules);

if(! defined(__NAMESPACE__ . '\RIC_SQL_2_PARSER_GRAMMAR_RULE_CONTAINER_1'))
define(__NAMESPACE__ . '\RIC_SQL_2_PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$ricSql2DefGrRule0=Creator::create("Parser_grammar_rule_a",STRING_NULL);

$ricSql2DefGrRules=Creator::create(getClassNameForCreate(Classes_info::PARSER_GRAMMAR_RULES_CONTAINER_CLASS),STRING_NULL,namespace\RIC_SQL_2_PARSER_GRAMMAR_RULE_CONTAINER_1);
$ricSql2DefGrRules->add($ricSql2DefGrRule0);

?>