<?
namespace Cheope_ns\fw;
 require_once("root.fun.php");
 

 session_start();

 require_once(FRAMEWORK_PATH . "cheope_ns_reg.def.php");
 //  die($_SESSION[SESSION_VAR_ACTIVE_APP]);
 require_once(FRAMEWORK_PATH . "cheope_ns.const.php");

 if(isset($_SESSION[SESSION_VAR_ACTIVE_APP]))
 require_root_modules($_SESSION[SESSION_VAR_ACTIVE_APP]);
 session_write_close();
?>