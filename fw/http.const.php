<?
namespace Cheope_ns\fw;

require_once("generic.const.php");

define(__NAMESPACE__ . '\URL_SEP',STRING_SLASH);
define(__NAMESPACE__ . '\HTTP_PREFIX', "http" . STRING_COLON . 
namespace\URL_SEP . namespace\URL_SEP);
define(__NAMESPACE__ . '\URL_PARS_START',STRING_QUESTION_MARK);
define(__NAMESPACE__ . '\URL_PAR_EQUAL',STRING_EQUAL);
define(__NAMESPACE__ . '\URL_PARS_DIV',STRING_AMPERSEND);
define(__NAMESPACE__ . '\HTTP_ROOT',namespace\HTTP_PREFIX . 
(isset($_SERVER["SERVER_NAME"])?$_SERVER["SERVER_NAME"]:STRING_NULL));
define(__NAMESPACE__ . '\HTTP_PORT',"81");
define(__NAMESPACE__ . '\HTTP_1_0',"HTTP/1.0");
define(__NAMESPACE__ . '\HTTP_1_1',"HTTP/1.1");

?>