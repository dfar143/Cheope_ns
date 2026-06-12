<?
namespace Cheope_ns\fw;
header ("Content-type:text/xml");
//header ("Content-type:application/x-download");

require_once("root.const.php");
require_once(FRAMEWORK_PATH . "std_ns_reg.def.php");
require_once(FRAMEWORK_PATH . "Std_ajaxOps.class.php");
require_once(FRAMEWORK_PATH . "Std_ajax_handler.class.php");

define('AJAX_OP_CONTAINER_1',"ajaxOpContainer1");
define('AJAX_HANDLER_1',"ajaxHandler1");

$ajaxOpLocalization = Creator::create("AjaxOpLocalization",STRING_NULL);
//$ajaxOpLocalization = new AjaxOpLocalization();
$ajaxOpLocalization->setIsJsonEnabled(true);

$ajaxOps = Creator::create("AjaxOps_container",STRING_NULL,AJAX_OP_CONTAINER_1);
//$ajaxOps = new AjaxOps_container(AJAX_OP_CONTAINER_1);
$ajaxOps->add($ajaxOpLocalization);

$ajaxHandler = Creator::create("Std_ajax_handler",STRING_NULL,AJAX_HANDLER_1);
//$ajaxHandler = new Std_ajax_handler(AJAX_HANDLER_1);
$ajaxHandler->setOpsContainer($ajaxOps);
$ajaxHandler->putData();


?>