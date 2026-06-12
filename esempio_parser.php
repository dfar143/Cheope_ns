<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "cheope_ns.fun.php");
require_once(FRAMEWORK_PATH . "php_arrays.def.php");
require_once(FRAMEWORK_PATH . "Parser.class.php");

date_default_timezone_set("Europe/Rome");
$start_time = date("H:i:s");

$itemStr = "array(0 => 'Ddata_1',
  1 => 'Ddata_2',)";

$lex = new Lexer_3("",$itemStr);
$lex->setRules($phpArraysDefRules);

$parser = new Parser($lex);
$parser->setGrammarRulesContainer($phpArraysDefGrRules);
if (! $parser->exec())
 echo $parser->getCurrentError();

echo "<br>";
$lex->dumpSymTable();
/*echo "<br>Items:<br>";

$tables = $parser->getListOfTokenAttr(PHP_ARRAYS_DEF_TOKEN_ATTR_KEY);
foreach($tables as $table)
{
	$tableName = $table->getLexema();
	echo $tableName . "<br>";
}

echo "<br>Nums:<br>";
$fields = $parser->getListOfTokenAttr(PHP_ARRAYS_DEF_TOKEN_ATTR_VAL);
foreach($fields as $field)
{
	$fieldName = $field->getLexema();
	echo $fieldName . "<br>";
}*/

/*$end_time = date("H:i:s");
$profiler->print_profile();

echo "<BR>" . $start_time . "<BR>" . $end_time;*/
?>