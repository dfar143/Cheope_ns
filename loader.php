<?
namespace Cheope_ns\fw;
require_once("root.const.php");
require_once(FRAMEWORK_PATH . "Cheope_ns_dyn_page_loader.class.php");
require_once(FRAMEWORK_PATH . "Interfaces_container.class.php");



define('LOADER_ERROR_1',"Specificare il parametro <par> nell'URL.");

// $interfacesContainer è globale.

if(isset($_GET['par']))
{
 $fileName = $_GET['par'];
 if($fileName != STRING_NULL)
 {
  $interfacesContainer = new Interfaces_container(CONTENITORE_GLOBALE_INTERFACCE);
  $dynPageLoader = new Cheope_ns_dyn_page_loader(STRING_NULL,0);
  $dynPageLoader->setFileName($fileName);
  $dynPageLoader->putData();
 }
 else
 {
 	die(LOADER_ERROR_1);
 }
}
else
 die(LOADER_ERROR_1);


?>