<?
namespace Cheope_ns\fw;
require_once("generic.const.php");


if (substr(PHP_OS, 0, 3) == 'WIN') {
    define(__NAMESPACE__ .  '\OS_WINDOWS', true);
    define(__NAMESPACE__ .  '\OS_UNIX',    false);
    define(__NAMESPACE__ .  '\OS',    'Windows');
} else {
    define(__NAMESPACE__ . '\OS_WINDOWS', false);
    define(__NAMESPACE__ .  '\OS_UNIX',    true);
    define(__NAMESPACE__ .  '\OS',    'Unix'); 
}

if(OS=="Windows")
{
 //define('DIR_SEP',STRING_BACKSLASH);
 // *****************
 // per evitare casini.
 // *****************
 define(__NAMESPACE__ .  '\DIR_SEP',STRING_SLASH);
}
elseif(OS=="Unix")
{
 define(__NAMESPACE__ .  '\DIR_SEP',STRING_SLASH);
} 

if(OS=="Windows")
{
 define(__NAMESPACE__ .  '\DEFAULT_LOGICAL_UNIT',"C"); 
 define(__NAMESPACE__ .  '\DEFAULT_FILESYSTEM_ROOT',namespace\DEFAULT_LOGICAL_UNIT . 
 STRING_COLON . namespace\DIR_SEP);
}
elseif(OS=="Unix")
{
 define(__NAMESPACE__ .  '\DEFAULT_FILESYSTEM_ROOT',namespace\DIR_SEP);
}

define(__NAMESPACE__ . '\THIS_DIR',STRING_POINT);
define(__NAMESPACE__ . '\PREVIOUS_DIR',STRING_POINT . STRING_POINT);
define(__NAMESPACE__ . '\FILE_NAME_ELEMENTS_SEP', STRING_POINT);

if(OS=="Windows")
{
define(__NAMESPACE__ . '\TTF_DIR',namespace\DEFAULT_FILESYSTEM_ROOT . "windows" . namespace\DIR_SEP . "fonts");
}


?>