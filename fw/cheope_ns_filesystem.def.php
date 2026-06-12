<?
namespace Cheope_ns\fw;
require_once("filesystem.const.php");
require_once("filesystem.def.php");

if(OS=="Windows")
{
 define(__NAMESPACE__ . '\FILES_LOGICAL_UNIT',"C");
 define(__NAMESPACE__ . '\DOCS_LOGICAL_UNIT',"C"); 
 define(__NAMESPACE__ . '\FILESYSTEM_FILES_ROOT',namespace\FILES_LOGICAL_UNIT . 
 STRING_COLON . DIR_SEP);
 define(__NAMESPACE__ . '\FILESYSTEM_DOCS_ROOT',namespace\DOCS_LOGICAL_UNIT . 
 STRING_COLON . DIR_SEP);
}
elseif(OS=="Unix")
{
 define(__NAMESPACE__ . '\FILESYSTEM_FILES_ROOT',DIR_SEP);
 define(__NAMESPACE__ . '\FILESYSTEM_DOCS_ROOT',DIR_SEP); 
}
?>