<?
namespace Cheope_ns\fw;

require_once("cheope_ns_generic.const.php");
require_once("http.const.php");

define(__NAMESPACE__ . '\HOST_NAME',"it000c0007");
define(__NAMESPACE__ . '\REPOSITORY_VIRTUAL_PATH',"repository");
define(__NAMESPACE__ . '\REPOSITORY_COMPLETE_VIRTUAL_PATH', namespace\HOST_NAME . 
URL_SEP . namespace\REPOSITORY_VIRTUAL_PATH);
define(__NAMESPACE__ . '\REPOSITORY_URL', HTTP_PREFIX . 
namespace\REPOSITORY_COMPLETE_VIRTUAL_PATH);
define(__NAMESPACE__ . '\APPLICATION_VIRTUAL_PATH',APPLICATION_NAME);
define(__NAMESPACE__ . '\APPLICATION_COMPLETE_VIRTUAL_PATH',namespace\HOST_NAME . 
URL_SEP . namespace\APPLICATION_VIRTUAL_PATH);
define(__NAMESPACE__ . '\APPLICATION_URL',HTTP_PREFIX . 
namespace\APPLICATION_COMPLETE_VIRTUAL_PATH);

?>