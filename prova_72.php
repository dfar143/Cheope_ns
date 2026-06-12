<?
namespace Cheope_ns\fw;
require_once("root.def.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_pop3Mail.class.php");

$pop3 = new Cheope_ns_pop3Mail();
$pop3->setHost('box.tin.it');
$pop3->setPort(110);
$pop3->setUser('daniele.farinotti');
$pop3->setPass('ac90poik');
$pop3->setFolder('INBOX'); 

$conn= $pop3->pop3_login();
print_r($pop3->pop3_stat($conn));

?>