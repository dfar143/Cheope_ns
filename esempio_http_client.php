<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Http_client.class.php");

$httpClientObj = new Http_client();
$httpClientObj->setTarget("http://localhost:81/Scripts/Cheope_ns/prova_1.php");
$page=$httpClientObj->get();
$pageItems = preg_split("/\r\n\r\n/",$page);
echo $pageItems[1];



?>