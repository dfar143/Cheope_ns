<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "filesystem.fun.php");

$actItems = array('bbb');
$actReplacingStr = "****";
echo getcwd();
array_replace_in_file_content(getcwd() . STRING_BACKSLASH . 
"temp.txt",$actItems,$actReplacingStr);

echo "done";
?>