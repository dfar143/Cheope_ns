<?
namespace Cheope_ns\fw;
require_once("PhpMsgsGen.class.php");
require_once("generic.fun.php");
require_once("Classes_info.class.php");
require_once("Creator.tra.php");

$phpMsgsGen = Creator::create(getClassNameForCreate(Classes_info::PHPMSGSGEN_CLASS),STRING_NULL,"php_locale");
$phpMsgsGen->setLocale("EN");
$phpMsgsGen->setDir(THIS_DIR . DIR_SEP . JSON_SUFFIX);
$phpMsgsGen->constsGenExec("msg");
$phpMsgsGen->constsGenExec("label");

?>