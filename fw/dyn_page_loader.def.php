<?
namespace Cheope_ns\fw;
require_once("Lex_rules_container.class.php");
require_once("Parser_grammar_rules_container.class.php");
require_once("Dyn_page_loader_parser_grammar_rules.class.php");
require_once("Creator_class.class.php");

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_WS',"ws");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_FSLASH',"fslash");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_PHP_OPEN_TAG',"php_open_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_PHP_CLOSE_TAG',"php_close_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_COMP_OPEN_TAG',"comp_open_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_COMP_CLOSE_TAG',"comp_close_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_TEXT',"text");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_TEXT1',"text1");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_TEXT2',"text2");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG',"html_open_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG',"html_close_tag");

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_ATTR_PHP_CODE',"Php_code");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TAG',"Html_tag");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_ATTR_COMP_CODE',"Comp_code");
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TOKEN_ATTR_HTML_TEXT',"Html_text");

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_RULE_NAME_SUFFIX',"rule");

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_WS_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_WS . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_FSLASH_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_FSLASH . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_PHP_OPEN_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_PHP_OPEN_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_PHP_CLOSE_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_PHP_CLOSE_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_COMP_OPEN_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_COMP_OPEN_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_COMP_CLOSE_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_COMP_CLOSE_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TEXT_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_TEXT1_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT1 . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_HTML_OPEN_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);
define(__NAMESPACE__ . '\DYN_PAGE_LOADER_HTML_CLOSE_TAG_RULE',namespace\DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG . namespace\DYN_PAGE_LOADER_RULE_NAME_SUFFIX);

$rule0=new Lex_rule("regola0");
$rule1=new Lex_rule("regola1");
$rule2=new Lex_rule("regola2");
$rule3=new Lex_rule("regola3");
$rule4=new Lex_rule("regola4");
$rule5=new Lex_rule("regola5");
$rule60=new Lex_rule("regola60");
$rule6=new Lex_rule("regola6");
$rule6_php=new Lex_rule("regola6_php");
$rule6_comp=new Lex_rule("regola6_comp");
$rule7=new Lex_rule("regola7");
$rule8=new Lex_rule("regola8");
$rule9=new Lex_rule("regola9");

$rule0->setRegexp("/^[\s\n\r]+/i");
$rule0->setTokenType(Token::TYPE_DELIM);
$rule0->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_WS);

$rule1->setRegexp("/^[\/]/i");
$rule1->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule1->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_FSLASH);

$rule2->setRegexp("/^<\?/i");
$rule2->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule2->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_PHP_OPEN_TAG);

$rule3->setRegexp("/^\?>/i");
$rule3->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule3->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_PHP_CLOSE_TAG);

$rule4->setRegexp("/^<@/i");
$rule4->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule4->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_COMP_OPEN_TAG);

$rule5->setRegexp("/^@>/i");
$rule5->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule5->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_COMP_CLOSE_TAG);

$rule6->setRegexp("/^[^<>]+/i");
$rule6->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule6->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

//$rule60->setRegexp("/^[^<>\/]+(?=\/)/Ui");
//$rule60->setTokenType(Token::TYPE_SPECIAL_ITEM);
//$rule60->setTokenVal(DYN_PAGE_LOADER_TOKEN_VAL_TEXT2);

$rule7->setRegexp("/^[^<>\/]+/i");
$rule7->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule7->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT1);

/*$rule6_php->setRegexp("/^([^\']*((\').*(\'))*[^\']*)*(?=\?>)/i");*/

$rule6_php->setRegexp("/^[^\b]+(?=\?>)/Ui");
$rule6_php->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule6_php->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

$rule6_comp->setRegexp("/^[^\b]+(?=@>)/Ui");
$rule6_comp->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule6_comp->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_TEXT);

$rule8->setRegexp("/^</i");
$rule8->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule8->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_HTML_OPEN_TAG);

$rule9->setRegexp("/^>/i");
$rule9->setTokenType(Token::TYPE_SPECIAL_ITEM);
$rule9->setTokenVal(namespace\DYN_PAGE_LOADER_TOKEN_VAL_HTML_CLOSE_TAG);

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_LEX_RULE_CONTAINER_0',"Contenitore_regole_0");

$dynPageLoaderDefRules=new Lex_rules_container(DYN_PAGE_LOADER_LEX_RULE_CONTAINER_0);
$dynPageLoaderDefRules->add($rule0);
$dynPageLoaderDefRules->add($rule1);
$dynPageLoaderDefRules->add($rule2);
$dynPageLoaderDefRules->add($rule3);
$dynPageLoaderDefRules->add($rule4);
$dynPageLoaderDefRules->add($rule5);
$dynPageLoaderDefRules->add($rule6);
//$dynPageLoaderDefRules->add($rule60);
$dynPageLoaderDefRules->add($rule7);
$dynPageLoaderDefRules->add($rule8);
$dynPageLoaderDefRules->add($rule9);

$dynPageLoaderRulesArray=array($dynPageLoaderDefRules);

define(__NAMESPACE__ . '\DYN_PAGE_LOADER_PARSER_GRAMMAR_RULE_CONTAINER_1',"Contenitore_regole_grammaticali_1");

$dynPageLoaderDefGrRule0=new Parser_grammar_rule_b();

$dynPageLoaderDefGrRules=new Parser_grammar_rules_container(DYN_PAGE_LOADER_PARSER_GRAMMAR_RULE_CONTAINER_1);
$dynPageLoaderDefGrRules->add($dynPageLoaderDefGrRule0);

?>